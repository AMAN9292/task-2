<?php
require_once __DIR__ . '/../config/database.php';

class BrandModel
{
  //global connection use by constructer

  private $conn;
  public function __construct($conn)
  {
    $this->conn = $conn;
  }



  //Show query for all brands data
  public function getAllBrand()
  {
    return mysqli_query($this->conn, "SELECT b.*, COUNT(p.id) AS total_products FROM brand b LEFT JOIN db_product p ON p.brand_id = b.id GROUP BY b.id");
  }

  public function countBrands()
  {
    $res = mysqli_query($this->conn, "SELECT COUNT(*) as total FROM brand");
    $row = mysqli_fetch_assoc($res);
    return $row['total'];
  }

  //Insert query for brand
  public function insertBrand($post, $files)
  {
    
    $br_name = $post['br_name'];
    mysqli_query($this->conn, "INSERT INTO brand(br_name) VALUES('$br_name')");
    $id = mysqli_insert_id($this->conn);

    if (!empty($files['br_image']['name'])) {
      $filename = $files['br_image']['name'];
      $tmp = $files['br_image']['tmp_name'];

      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $newName = "brand_" . $id . "_" . time() . "." . $ext;

      move_uploaded_file($tmp, __DIR__ . "/../../public/uploads/" . $newName);

      mysqli_query($this->conn, "UPDATE brand SET image= '$newName' WHERE id='$id'");
    }
    return true;
  }
  //brand id
  public function getBrandById($id)
  {
  
    $id = mysqli_real_escape_string($this->conn, $id);
    $res = mysqli_query($this->conn, "SELECT * FROM brand WHERE id='$id'");
    return mysqli_fetch_assoc($res);
  }
  //Brand Update query
  public function updateBrand($post, $files)
  {
    $id = $post['id'];
    $old_image = $post['old_image'] ?? '';
    

    $update_fields = [];

    // Brand Name
    if (!empty($post['br_name'])) {
      $br_name = mysqli_real_escape_string($this->conn, $post['br_name']);
      $update_fields[] = "br_name='$br_name'";
    }

    // Image Upload
    if (!empty($files['br_image']['name'])) {

      $filename = $files['br_image']['name'];
      $tmp = $files['br_image']['tmp_name'];
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
      mysqli_query($this->conn, $sql);
    }

    return true;
  }



  //Delete query function for brand
  public function deleteBrand($id)
  {
    

    $res = mysqli_query($this->conn, "SELECT image FROM brand WHERE id='$id'");
    $data = mysqli_fetch_assoc($res);

    if ($data && $data['image'] != '') {
      $path = __DIR__ . "/../../public/uploads/" . $data['image'];
      if (file_exists($path)) {
        unlink($path);
      }
    }

    mysqli_query($this->conn, "DELETE FROM brand WHERE id='$id'");
  }
  //Product count display in brand

  // public function getBrandWithProductCount()
  // {

  //   $sql = "SELECT b.*, COUNT(p.id) AS total_products FROM brand b LEFT JOIN db_product p ON p.brand_id = b.id GROUP BY b.id";

  //   return mysqli_query($this->conn, $sql);
  // }
}

?>