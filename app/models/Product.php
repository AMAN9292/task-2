<?php
require_once __DIR__ . '/../config/database.php';

class ProductModel
{

    // select all data for view

  public function getAllProducts()
{
    global $conn;

    $data = mysqli_query($conn, "
        SELECT p.*, b.br_name 
        FROM db_product p
        LEFT JOIN brand b ON p.brand_id = b.id
    ");

    return $data;
}
    //get single data when edit form use

    public function getProductById($id)
    {
        global $conn;
        $res = mysqli_query($conn, "SELECT * FROM db_product WHERE id='$id'");
        return mysqli_fetch_assoc($res);
    }

    //Insert data query

    public function insertProduct($post, $files)
    {
        global $conn;

        $product_name = $post['product_name'];
        $price = $post['price'];
        $description = $post['description'];
        $status = $post['status'];
        $brand_id = $post['brand_id'];


        //insert data first 
        $sql = "INSERT INTO db_product(product_name,price,description,status,brand_id) VALUES('$product_name','$price','$description','$status','$brand_id')";
        mysqli_query($conn, $sql);

        //get id
        $id = mysqli_insert_id($conn);


        //image code
        if (!empty($files['product_image']['name'])) {

            $filename = $files['product_image']['name'];
            $tmp = $files['product_image']['tmp_name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);

            $product_name_clean = str_replace(" ", "_", strtolower($product_name));
            $new_image = $id . "_img_" . $product_name_clean . "." . $ext;

            move_uploaded_file($tmp, __DIR__ . "/../../public/uploads/" . $new_image);

            mysqli_query($conn, "UPDATE db_product SET product_image='$new_image' WHERE id='$id'");
        }

        return true;

    }


    //update query
    public function updateProduct($post, $files)
    {

        global $conn;

        $id = $post['id'];
        $product_name = $post['product_name'];
        $price = $post['price'];
        $description = $post['description'];
        $status = $post['status'];
        $brand_id=$post['brand_id'];
        $old_image = $post['old_image'];

        $update_fields = [];

        // text fields update
        if ($product_name != '') {
            $update_fields[] = "product_name='$product_name'";
        }
        if ($price != '') {
            $update_fields[] = "price='$price'";
        }
        if ($description != '') {
            $update_fields[] = "description='$description'";
        }
        if ($status != '') {
            $update_fields[] = "status='$status'";
        }
        if ($brand_id != '') {
    $update_fields[] = "brand_id='$brand_id'";
}

        //image update start
        if (!empty($files['product_image']['name'])) {

            $filename = $files['product_image']['name'];
            $tmp = $files['product_image']['tmp_name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            $product_name_clean = str_replace(" ", "_", strtolower($product_name));

            // new image name
            $product_image = $id . "_img_" . $product_name_clean . time() . "." . $ext;

            // correct upload path
            $uploadPath = __DIR__ . "/../../public/uploads/" . $product_image;

            // upload file
            move_uploaded_file($tmp, $uploadPath);

            // delete old image
            if (!empty($old_image)) {
                $oldPath = __DIR__ . "/../../public/uploads/" . $old_image;
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // add to update fields
            $update_fields[] = "product_image='$product_image'";
        }

        //final update query
        if (!empty($update_fields)) {
            $sql = "UPDATE db_product SET " . implode(", ", $update_fields) . " WHERE id='$id'";
            mysqli_query($conn, $sql);
        }

        return true;
    }
    //Delete query
    public function deleteProduct($id)
    {
        global $conn;

        //get image name and delet in the database
        $res = mysqli_query($conn, "SELECT product_image FROM db_product WHERE id='$id'");
        $data = mysqli_fetch_assoc($res);


        //delete image in to folder
        if ($data && $data['product_image'] != '') {
            $path = __DIR__ . "/../../public/uploads/" . $data['product_image'];

            if (file_exists($path)) {
                unlink($path);
            }
        }
        //delete row
        mysqli_query($conn, "DELETE FROM db_product WHERE id='$id'");
        return true;
    }

}

?>