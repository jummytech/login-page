<?php
function has_error(): ?string{
    return isset($_SESSION['error']);
}
function error(): ?string{
    if(!isset($_SESSION['error'])){
        return null;
    }

    $error = $_SESSION['error'];
    unset($_SESSION['error']);
    return $error;
}


function errors(string $key): ?string{
    if(!isset($_SESSION['errors'])){
        return null;
    }

    $errors = $_SESSION['errors'];
    if(!is_array($errors)){
        unset($_SESSION['errors']);
        return $errors;
    }
    
    if(array_key_exists($key, $errors)){
        unset($_SESSION['errors'][$key]);
        return $errors[$key];
    }
    
    return null;
}

function input(string $key): ?string{
    if(!isset($_SESSION['inputs'])){
        return null;
    }

    $inputs = $_SESSION['inputs'];

    if(array_key_exists($key, $inputs)){
        unset($_SESSION['inputs'][$key]);
        $value = $inputs[$key];
        return trim($value)==""?"":$value;
    }
    
    return null;
}