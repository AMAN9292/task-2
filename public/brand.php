<?php
require_once __DIR__ . '/../app/controllers/BrandController.php';

$controller = new BrandController();

$action = $_GET['action'] ?? 'index';

switch($action){
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'update':
        $controller->update();
        break;
    case 'delete':
        $controller->delete();
        break;
    default:
        $controller->index();

}