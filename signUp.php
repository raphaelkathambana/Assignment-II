<?php

require_once 'User.php';
require_once 'autoload.php';

//check if form was submitted
if (isset($_POST['register'])) {
    //get form data
    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    //create user object
    $user = new User();
    //save user
    $result = $user->save($name, $email, $password);
    //check if user was saved
    if ($result) {
        // create session
        $user->setId($user->getIdFromDb());
        session_start();
        $_SESSION['user'] = $user;
        //redirect to index with query string
        header('Location: index.php?message=Registration Successful');
    } else {
        //redirect to index with query string
        header('Location: register.php?message=Invalid Credentials');
    }
    exit();
}