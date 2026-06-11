<?php
session_start();
require_once("./db.php");

unset($_SESSION['errors']);

$username = trim($_POST['username']);
$email = trim($_POST['email']);
$password = trim($_POST['password']);
$confirmPassword = trim($_POST['confirmPassword']);

$errors = [];

if(!isset($username) || !strlen($username)){
    $errors['username'] = 'Please Enter a valid username';
} else if(strlen($username) < 3){
    $errors['username'] = "Username should be at least 3 character long.";
}


if(!isset($email) || !strlen($email)){
    $errors['email'] = 'Please Enter a valid email';
} else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    $errors['email'] = "Email is invalid";
}

if(!isset($password) || !strlen($password)){
    $errors['password'] = 'Please Enter a valid password';
} else if(strlen($password) < 8){
    $errors['password'] = "Password should be at least 8 character long.";
}

if(!isset($confirmPassword) || !strlen($confirmPassword)){
    $errors['confirmPassword'] = 'Please confirm password';
} else if($password !== $confirmPassword){
  $errors['confirmPassword'] = "Confirm Password does not match password.";
}

if(count($errors)){
    $_SESSION['errors'] = $errors;
    unset($_POST['password']);
    unset($_POST['confirmPassword']);
    $_SESSION['inputs'] = $_POST;
    header("Location: ../register.php");
} else {

    $SQL = "SELECT `id`, `username` FROM users WHERE username = ? LIMIT 1;";
    $statement = mysqli_prepare($connection, $SQL);
    if(!$statement) {
        $_SESSION['error'] = "SQL Error: ".mysqli_error($connection);
        return header("Location: ../");
    }
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);

    $results = mysqli_stmt_get_result($statement);
    $existingUser = mysqli_fetch_assoc($results);
    mysqli_stmt_close($statement);
    
    if($existingUser){
        $errors['username'] = "Username is already taken!";
    } 

    $SQL = "SELECT `id`,`email` FROM users WHERE email = ? LIMIT 1;";
    $statement = mysqli_prepare($connection, $SQL);
    mysqli_stmt_bind_param($statement, 's', $email);
    mysqli_stmt_execute($statement);
    $results = mysqli_stmt_get_result($statement);
    $existingUser = mysqli_fetch_assoc($results);
    mysqli_stmt_close($statement);
    if($existingUser){
        $errors['email'] = "Email is already taken!";
    } else{
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $last_login_at = null;

        // Register User
        $SQL = "INSERT INTO `users`(`username`, `email`, `password`, `last_login_at`) VALUES (?,?,?,?);";
        $statement = mysqli_prepare($connection, $SQL);
        mysqli_stmt_bind_param($statement, 'ssss', $username, $email, $hashedPassword, $last_login_at);
    if(mysqli_stmt_execute($statement)){
        echo "<h1>Registration Successful!</h1>";
    } else{
        echo "<h1>Registration Failed!</h1>";
    }
    mysqli_stmt_close($statement); 
    exit();
    }
    

    
if(count($errors)){
    $_SESSION['errors'] = $errors;
    unset($_POST['password']);
    unset($_POST['confirmPassword']);
    $_SESSION['inputs'] = $_POST;
    header("Location: ../register.php");
}
}