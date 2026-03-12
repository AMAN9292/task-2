<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/Brand.php';
require_once __DIR__ . '/../models/User.php';

class AdminController
{
    private $productModel;
    private $brandModel;
    private $userModel;

    public function __construct()
    {
        global $conn;
        $this->productModel = new ProductModel($conn);
        $this->brandModel = new BrandModel($conn);
        $this->userModel = new UserModel($conn);
    }

    // Dashboard start

    public function dashboard()
    {
        $totalProducts = $this->productModel->countProducts();
        $totalBrands = $this->brandModel->countBrands();
        $totalUsers = $this->userModel->countUsers();
       

        include __DIR__ . '/../views/admin/dashboard.php';
    }

    //Products

    public function products()
    {
        $products = $this->productModel->getAllProducts();
        include __DIR__ . '/../views/admin/product_list.php';
    }

    public function productCreate()
    {
        $errors = [];

        $brand = mysqli_fetch_all($this->brandModel->getAllBrand(), MYSQLI_ASSOC);

        include __DIR__ . '/../views/admin/product_form.php';
    }
    public function productStore()
    {
        $errors = [];

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
        if (empty($_POST['brand_id'])) {
            $errors['brand_id'] = "Brand is required";
        }
        if (empty($_FILES['product_image']['name'])) {
            $errors['product_image'] = "Image is required";
        }

        if (!empty($errors)) {

            $brand = mysqli_fetch_all($this->brandModel->getAllBrand(), MYSQLI_ASSOC);

            include __DIR__ . '/../views/admin/product_form.php';
            return;
        }

        $this->productModel->insertProduct($_POST, $_FILES);
        $_SESSION['success'] = "Product added successfully!";
        header("Location: /product_admin/public/index.php?module=admin&action=products");
        exit;
    }

    public function productEdit()
    {
        $id = $_GET['id'];
        $product = $this->productModel->getProductById($id);
        $brand = mysqli_fetch_all($this->brandModel->getAllBrand(), MYSQLI_ASSOC);
        $errors = [];
        include __DIR__ . '/../views/admin/product_edit.php';
    }

    public function productUpdate()
    {
        $this->productModel->updateProduct($_POST, $_FILES);
        $_SESSION['success'] = "Product updated successfully!";
        header("Location: /product_admin/public/index.php?module=admin&action=products");
        exit;
    }

    public function productDelete()
    {
        $id = $_GET['id'];
        $this->productModel->deleteProduct($id);
        $_SESSION['success'] = "Product deleted successfully!";
        header("Location: /product_admin/public/index.php?module=admin&action=products");
        exit;
    }

    // Brands 

    public function brands()
    {
        $brands = mysqli_fetch_all($this->brandModel->getAllBrand(), MYSQLI_ASSOC);
        include __DIR__ . '/../views/admin/brand_list.php';
    }


    public function brandCreate()
    {
        $errors = [];
        include __DIR__ . '/../views/admin/brand_form.php';
    }

    public function brandStore()
    {
        $errors = [];

        if (empty($_POST['br_name'])) {
            $errors['br_name'] = "Brand name is required";
        }

        if (!empty($errors)) {
            include __DIR__ . '/../views/admin/brand_form.php';
            return;
        }

        $this->brandModel->insertBrand($_POST, $_FILES);
        $_SESSION['success'] = "Brand added successfully!";
        header("Location: /product_admin/public/index.php?module=admin&action=brands");
        exit;
    }

    public function brandEdit()
    {
        $id = $_GET['id'];
        $brand = $this->brandModel->getBrandById($id);
        $errors = [];
        include __DIR__ . '/../views/admin/brand_edit.php';
    }

    public function brandUpdate()
    {
        $this->brandModel->updateBrand($_POST, $_FILES);
        $_SESSION['success'] = "Brand updated successfully!";
        header("Location: /product_admin/public/index.php?module=admin&action=brands");
        exit;
    }

    public function brandDelete()
    {
        $id = $_GET['id'];
        $this->brandModel->deleteBrand($id);
        $_SESSION['success'] = "Brand deleted successfully!";
        header("Location: /product_admin/public/index.php?module=admin&action=brands");
        exit;
    }

    //Users

    public function users()
    {
        $users = $this->userModel->getAllUsers();
        include __DIR__ . '/../views/admin/user_list.php';
    }
    public function userCreate()
    {
        $errors = [];
        include __DIR__ . '/../views/admin/register.php';
    }
    public function userStore()
    {
        $this->userModel->createUser(
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['email'],
            $_POST['password'],
            $_POST['role']
        );

        $_SESSION['success'] = "User added successfully!";
        header("Location: /product_admin/public/index.php?module=admin&action=users");
        exit;
    }
    public function userEdit()
    {
        $id = $_GET['id'];
        $user = $this->userModel->getUserById($id);
        $errors = [];
        include __DIR__ . '/../views/admin/user_edit.php';
    }

    public function userUpdate()
    {
        $this->userModel->updateUser($_POST);

        $_SESSION['success'] = "User updated successfully!";
        header("Location: /product_admin/public/index.php?module=admin&action=user");
        exit;
    }
    public function userDelete()
    {
        $id = $_GET['id'];
        $result = $this->userModel->deleteUser($id);
        if ($result) {
            $_SESSION['success'] = "User deleted successfully!";
        } else {
            $_SESSION['error'] = "Cannot delete an admin account.";
        }
        header("Location: /product_admin/public/index.php?module=admin&action=users");
        exit;
    }
}
