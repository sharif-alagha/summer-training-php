<?php
require_once 'db.php';

function getAdminInfo($username) {
    $db = new DB();

    $sql = "select * from admin where username = '$username'";

    $result = $db->conn->query($sql);
    
    $admin = $result->fetch_all(MYSQLI_ASSOC);

    return $admin;
}

function checkLogin($username, $password) {
    $db = new DB();

    $sql = "select * from admin where username = '$username' and password = '$password'";

    $result = $db->conn->query($sql);
    
    $admin = $result->fetch_all(MYSQLI_ASSOC);

    return empty($admin) ? false : true;
}

function getAllCustomers()
{
    $db = new DB();

    $sql = "select * from customer";

    $result = $db->conn->query($sql);

    $customers = $result->fetch_all(MYSQLI_ASSOC);

    return $customers;
}

function addCustomer()
{
    $path = null;

    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        if ($_FILES['image']['type'] == 'image/jpeg') {
            $name = uniqid();
            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $path = "uploads/$name.$ext";

            move_uploaded_file($_FILES['image']['tmp_name'], $path);
        }
    }

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConf = $_POST['password_confirmation'];

    $db = new DB();

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "insert into customer (first_name, last_name, email, password, image_path) values ('$fname', '$lname', '$email', '$password', '$path')";

    $db->conn->query($sql);

    return $db->conn->affected_rows;
}

function getCustomerById($id)
{
    $db = new DB();

    $sql = "select * from customer where id = '$id'";

    $result = $db->conn->query($sql);

    $customer = $result->fetch_all(MYSQLI_ASSOC);

    return $customer;
}

function editCustomer()
{
    $id = $_POST['id'];
    $fname = htmlentities($_POST['fname']);
    $lname = htmlentities($_POST['lname']);
    $email = htmlentities($_POST['email']);
    $password = $_POST['password'];
    $passwordConf = $_POST['password_confirmation'];

    $db = new DB();

    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "update customer set first_name = '$fname', last_name = '$lname', email = '$email', password = '$password' where id = $id";

    $db->conn->query($sql);

    return $db->conn->affected_rows;
}

function deleteCustomer()
{
    $id = $_POST['id'];

    $db = new DB();

    $sql = "delete from customer where id = $id";

    $db->conn->query($sql);

    return $db->conn->affected_rows;
}
