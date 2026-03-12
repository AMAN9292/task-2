<?php
require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private $model;

    public function __construct()
    {
        global $conn;
        $this->model = new UserModel($conn);
    }

    public function login()
    {
        $email    = $_POST['email']    ?? '';
        $password = $_POST['password'] ?? '';

        $result = $this->model->getUserByEmail($email);
        $user   = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {

            if (($user['role'] ?? '') !== 'admin') {
                $_SESSION['login_error'] = "Access denied. Admin accounts only.";
                header("Location: index.php?module=auth");
                exit;
            }

            $_SESSION['admin']      = $user['id'];
            $_SESSION['admin_email'] = $user['email'];
            $_SESSION['admin_name']  = $user['firstname'] . ' ' . $user['lastname'];
            $_SESSION['success']    = "Welcome back, " . $user['firstname'] . "!";
            header("Location: index.php?module=admin");
            exit;

        } else {
            $_SESSION['login_error'] = "Invalid email or password.";
            header("Location: index.php?module=auth");
            exit;
        }
    }

    public function logout()
    {
        session_destroy();
        header("Location: index.php?module=auth");
        exit;
    }
}
