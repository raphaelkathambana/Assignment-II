<?php
include_once 'User.php';
require_once 'autoload.php';
//check if form was submitted
if (isset($_POST['login'])) {
    //get form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    //create user object
    $user = new User();
    //save user
    $result = $user->signIn($email, $password);
    //check if user exists
    if ($result) {
        if (password_verify($password, $result[0]->getPassword())) {
            $user->setName($result[0]->username);
            $user->setCreatedAt($result[0]->getCreatedAt());
            $user->setUpdatedAt($result[0]->getUpdatedAt());
            $user->setId($result[0]->getId());
            // create session
            session_start();
            $_SESSION['user'] = $user;
            //redirect to index with query string
            header('Location: index.php?message=Login Successful');
        } else {
            //redirect to index with query string
            header('Location: login.php?message=Wrong Password');
        }
    } else {
        //redirect to index with query string
        header('Location: login.php?message=Invalid Credentials');
    }
}