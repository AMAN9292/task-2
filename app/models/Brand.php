<?php
require_once __DIR__ . '/../config/database.php';

class BrandModel
{
//Show query for all brands data
  public function getAllBrand()
  {
    global $conn;
    return mysqli_query($conn, "SELECT * FROM brand");
  }

  //Insert query for brand
  public function insertBrand($post, $files)
  {
    global $conn;
    $br_name = $post['br_name'];
    mysqli_query($conn, "INSERT INTO brand(br_name) VALUES('$br_name')");
    $id = mysqli_insert_id($conn);

    if (!empty($files['image']['name'])) {
      $filename = $files['image']['name'];
      $tmp = $files['image']['tmp_name'];

      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $newName = "brand_" . $id . "_" . time() . "." . $ext;

      move_uploaded_file($tmp, __DIR__ . "/../../public/uploads/" . $newName);

      mysqli_query($conn, "UPDATE brand SET image= '$newName' WHERE id='$id'");
    }
    return true;
  }
  //brand id
public function getBrandById($id)
{
    global $conn;
    $id = mysqli_real_escape_string($conn, $id);
    $res = mysqli_query($conn, "SELECT * FROM brand WHERE id='$id'");
    return mysqli_fetch_assoc($res);
}
  //Brand Update query
  public function updateBrand($id, $post, $files, $old_image)
{
    global $conn;

    $update_fields = [];

    // Brand Name
    if (!empty($post['br_name'])) {
        $br_name = mysqli_real_escape_string($conn, $post['br_name']);
        $update_fields[] = "br_name='$br_name'";
    }

    // Image Upload
    if (!empty($files['image']['name'])) {

        $filename = $files['image']['name'];
        $tmp = $files['image']['tmp_name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        $brand_name_clean = str_replace(" ", "_", strtolower($post['br_name']));

        // $brand_image = $id . "_brand_" . $brand_name_clean . time() . "." . $ext;
        $brand_image = "brand_" . $id . "_" . time() . "." . $ext;
        $uploadPath = __DIR__ . "/../../public/uploads/" . $brand_image;

        move_uploaded_file($tmp, $uploadPath);

        // delete old image
        if (!empty($old_image)) {
            $oldPath = __DIR__ . "/../../public/uploads/" . $old_image;
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $update_fields[] = "image='$brand_image'";
    }

    // update query
    if (!empty($update_fields)) {
        $sql = "UPDATE brand SET " . implode(", ", $update_fields) . " WHERE id='$id'";
        mysqli_query($conn, $sql);
    }

    return true;
}



  //Delete query function for brand
  public function deleteBrand($id)
  {
    global $conn;

    $res = mysqli_query($conn, "SELECT image FROM brand WHERE id='$id'");
    $data = mysqli_fetch_assoc($res);

    if ($data && $data['image'] != '') {
      $path = __DIR__ . "/../../public/uploads/" . $data['image'];
      if (file_exists($path)) {
        unlink($path);
      }
    }

    mysqli_query($conn, "DELETE FROM brand WHERE id='$id'");
  }
  //Product count display in brand
  
public function getBrandWithProductCount()
{
    global $conn;

    $sql = "
        SELECT b.*, COUNT(p.id) AS total_products
        FROM brand b
        LEFT JOIN db_product p ON p.brand_id = b.id
        GROUP BY b.id
    ";

    return mysqli_query($conn, $sql);
}
}

?>