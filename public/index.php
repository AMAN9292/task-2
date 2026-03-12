<?php

session_start();
require_once "../app/config/database.php";

$module = $_GET['module'] ?? 'auth';
$action = $_GET['action'] ?? 'index';
$allowed_modules = ['auth', 'admin'];

if (!in_array($module, $allowed_modules)) {
    die("Invalid module");
}

// Auth module 
if ($module === 'auth') {

    require_once "../app/controllers/AuthController.php";
    $auth = new AuthController();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $auth->login();
    } else {
        if ($action === 'logout') { $auth->logout(); }
        else {
            if (isset($_SESSION['admin'])) { header("Location: index.php?module=admin"); exit; }
            include "../app/views/login.php";
        }
    }
}

//Admin module
elseif ($module === 'admin') {

    if (!isset($_SESSION['admin'])) {
        header("Location: index.php?module=auth");
        exit;
    }

    require_once "../app/controllers/AdminController.php";
    $controller = new AdminController();

    switch ($action) {
        case 'products':       
            $controller->products();      
            break;
        case 'product_create': 
            $controller->productCreate(); 
            break;
        case 'product_store':  
            $controller->productStore();  
            break;
        case 'product_edit':   
            $controller->productEdit();   
            break;
        case 'product_update': 
            $controller->productUpdate(); 
            break;
        case 'product_delete': 
            $controller->productDelete(); 
            break;
        case 'brands':         
            $controller->brands();        
            break;
        case 'brand_create':   
            $controller->brandCreate();   
            break;
        case 'brand_store':    
            $controller->brandStore();    
            break;
        case 'brand_edit':     
            $controller->brandEdit();     
            break;
        case 'brand_update':   
            $controller->brandUpdate();   
            break;
        case 'brand_delete':   
            $controller->brandDelete();   
            break;
        case 'users':          
            $controller->users();         
            break;
        case 'user_create':
            $controller->userCreate();
            break;
        case 'user_store':
            $controller->userStore();
            break;
        case 'user_edit':
            $controller->userEdit();
            break;
        case 'user_update':
            $controller->userUpdate();
            break;
        case 'user_delete':    
            $controller->userDelete();    
            break;
        default:               
        $controller->dashboard();
    }
}
