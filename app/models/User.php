<?php
class UserModel
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserByEmail($email)
    {
        $email = mysqli_real_escape_string($this->conn, $email);
        return mysqli_query($this->conn, "SELECT * FROM users WHERE email='$email'");
    }

    public function getUserById($id)
    {
        $id = mysqli_real_escape_string($this->conn, $id);
        $res = mysqli_query($this->conn, "SELECT * FROM users WHERE id='$id'");
        return mysqli_fetch_assoc($res);
    }
   //create function
    public function createUser($firstname, $lastname, $email, $password, $role = 'user')
    {
        $firstname = mysqli_real_escape_string($this->conn, $firstname);
        $lastname = mysqli_real_escape_string($this->conn, $lastname);
        $email = mysqli_real_escape_string($this->conn, $email);
        $role = mysqli_real_escape_string($this->conn, $role);

        $hash = password_hash($password, PASSWORD_BCRYPT);

        mysqli_query(
            $this->conn,
            "INSERT INTO users (firstname,lastname,email,password,role)
     VALUES ('$firstname','$lastname','$email','$hash','$role')"
        );

        return mysqli_insert_id($this->conn);
    } 
    //update function
    public function updateUser($data)
    {
        $id = mysqli_real_escape_string($this->conn, $data['id']);
        $firstname = mysqli_real_escape_string($this->conn, $data['firstname']);
        $lastname = mysqli_real_escape_string($this->conn, $data['lastname']);
        $email = mysqli_real_escape_string($this->conn, $data['email']);
        $role = mysqli_real_escape_string($this->conn, $data['role']);

        // agar password change nahi karna
        if (empty($data['password'])) {

            mysqli_query(
                $this->conn,
                "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', role='$role' WHERE id='$id'"
            );

        } else {

            // password update karna
            $hash = password_hash($data['password'], PASSWORD_BCRYPT);
            $hash = mysqli_real_escape_string($this->conn, $hash);

            mysqli_query(
                $this->conn,
                "UPDATE users SET firstname='$firstname', lastname='$lastname', email='$email', password='$hash', role='$role' WHERE id='$id'"
            );
        }

        return true;
    }

    public function getAllUsers()
    {
        // $res = mysqli_query($this->conn,
        //     "SELECT id, firstname, lastname, email, role, created_at FROM users ORDER BY id DESC");
        $res = mysqli_query($this->conn,"SELECT * FROM users ORDER BY id DESC");
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    public function countUsers()
    {
        $res = mysqli_query($this->conn, "SELECT COUNT(*) as total FROM users");
        $row = mysqli_fetch_assoc($res);
        return $row['total'];
    }

    public function deleteUser($id)
    {
        $id = mysqli_real_escape_string($this->conn, $id);

        mysqli_query($this->conn, "DELETE FROM users WHERE id='$id'");

        return true;
    }
}
?>