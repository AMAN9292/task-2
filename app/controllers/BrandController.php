<?php
require_once __DIR__ . '/../models/Brand.php';

class BrandController {

    private $model;

    public function __construct(){
        $this->model = new BrandModel();
    }

    //brand List
    // public function index(){
    //     $brands = $this->model->getAllBrand();
    //     include __DIR__ . '/../views/brand_list.php';
    // }

    //new
    public function index(){
    $brands = $this->model->getBrandWithProductCount();
    include __DIR__ . '/../views/brand_list.php';
}

    //create brand Form
    public function create(){
        $errors = [];
        include __DIR__ . '/../views/brand_form.php';
    }

    //store
    public function store(){

        $errors = [];

        if(empty($_POST['br_name'])){
            $errors['br_name'] = "Brand name required";
        }

        if(!empty($errors)){
            include __DIR__ . '/../views/brand_form.php';
            return;
        }

        $this->model->insertBrand($_POST, $_FILES);

        header("Location: brand.php");
        exit;
    }

      //EDIT form
    public function edit(){
        $id = $_GET['id'];

        // get single brand
        $brand = $this->model->getBrandById($id);

        $errors = [];

        include __DIR__ . '/../views/brand_edit.php';
    }

    // UPDATE function
    public function update()
{
    $id = $_GET['id'];

    $brand = $this->model->getBrandById($id);
    $old_image = $brand['image'];

    $errors = [];

    if(empty($_POST['br_name'])){
        $errors['br_name'] = "Brand name required";
    }

    if(!empty($errors)){
        include __DIR__ . '/../views/brand_edit.php';
        return;
    }

    $this->model->updateBrand($id, $_POST, $_FILES, $old_image);

    header("Location: brand.php");
    exit;
}



    //brand delete
    public function delete(){
        $id = $_GET['id'];
        $this->model->deleteBrand($id);

        header("Location: brand.php");
        exit;
    }

    
}