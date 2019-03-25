<?php
session_start();
define("rootPath","http://localhost/HTQL/");
if(isset($_GET['controller'])){
    $controller = $_GET['controller'];
    if(isset($_GET['action'])){
        $action = $_GET['action'];
    }else{
        header('location: index.php');
    }
}else{
    if(isset($_SESSION['status'])){
        $controller = "home";
        $action = "profile";
    }else{
        $controller = "home";
        $action = "login";
        $_GET['lang']='vn';
    }
}
include "route.php";
?>