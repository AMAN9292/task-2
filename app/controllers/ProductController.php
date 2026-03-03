<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';  

class ProductController
{
    private $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }

    //index
    public function index()
    {
        $products = $this->model->getAllProducts();
        include __DIR__ . '/../views/product_list.php';
    }
    //create form
    public function create()
    {
        $errors = [];
        //brand code
        $brandModel = new BrandModel();
    $brand = mysqli_fetch_all($brandModel->getAllBrand(), MYSQLI_ASSOC);
        include __DIR__ . '/../views/product_form.php';
    }

    // Storing data and validation
    public function store()
    {
        $errors = [];

        // validation
        if (empty($_POST['product_name'])) {
            $errors['product_name'] = "Name is required";
        }

        if (empty($_POST['price'])) {
            $errors['price'] = "Price is required";
        }

        if (empty($_POST['description'])) {
            $errors['description'] = "Description is required";
        }

        if (empty($_POST['status'])) {
            $errors['status'] = "Status is required";
        }
        if(empty($_POST['brand_id'])){
            $errors['brand_id']="Brand id is required";
        }

        if (empty($_FILES['product_image']['name'])) {
            $errors['product_image'] = "Image required";
        }

        // if validation fails
        if (!empty($errors)) {
            include __DIR__ . '/../views/product_form.php';
            return;
        }

        // insert using model
        $this->model->insertProduct($_POST, $_FILES);

        header("Location: index.php");
        exit;
    }

    //edit form

    public function edit()
    {
        $id = $_GET['id'];
        $product = $this->model->getProductById($id);

        //brand model load code
         require_once __DIR__ . '/../models/Brand.php';
    $brandModel = new BrandModel();
    $brand = mysqli_fetch_all($brandModel->getAllBrand(), MYSQLI_ASSOC);

        $errors = [];

        include __DIR__ . '/../views/product_edit.php';
    }

    //update function
    public function update()
    {
        
        $this->model->updateProduct(post: $_POST, files: $_FILES);
        header("Location: index.php");
        exit;
    }

    
    // Delete function
    public function delete()
    {
        $id = $_GET['id'];
        $this->model->deleteProduct($id);

        header("Location: index.php");
        exit;
    }
}