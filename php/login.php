<?php
session_start();
require_once("./db.php");

unset($_SESSION['errors']);

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$errors = [];
if(!isset($username) || !strlen($username)){
    $errors['username'] = 'Please Enter a valid username';
}  else if(strlen($username) < 3){
    $errors['username'] = "Username should be at least 3 character long.";
}

if(!isset($password) || !strlen($password)){
    $errors['password'] = 'Please Enter a valid password';
} else if(strlen($password) < 8){
    $errors['password'] = "Password should be at least 8 character long.";
} 



if(count($errors)){
    $_SESSION['errors'] = $errors;
    unset($_POST['password']);
    $_SESSION['inputs'] = $_POST;
    header("Location: ../");
} else {
    $SQL = "SELECT `id`, `email`, `username`, `password` FROM users WHERE username = ? LIMIT 1;";
    $statement = mysqli_prepare($connection, $SQL);
    if($statement){
        mysqli_stmt_bind_param($statement, "s", $username);
        mysqli_stmt_execute($statement);

        $results = mysqli_stmt_get_result($statement);

        if ($user = mysqli_fetch_assoc($results)){
            if(password_verify($password, $user['password'])){

                echo "Login Successful!";
                print("
                <h2>User Details</h2>
                <b>Id: </b>{$user['id']}<br/>
                <b>Username: </b>{$user['username']}<br/>
                <b>Email: </b>{$user['email']}
                ");
            } else {
                $errors['password'] = "Password is incorrect!";
            }
        } else{
            $_SESSION['error'] = "No user with the username & password exist!";
            header("Location: ../");
        }
    
        mysqli_stmt_close($statement);

    } else {
        $_SESSION['error'] = "SQL Error: ".mysqli_error($connection);
        header("Location: ../");
    }

}