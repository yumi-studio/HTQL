<?php
$controlList = array(
    'home'=>['index','login','logout','identify','employee','profile'],
    'account'=>['identify','list','getall','getdata','search','view','create','update','delete'],
    'project'=>['list','getall','getproject','view','update','delete','sort','member','register','create'],
    'salary'=>['view','list','update']
);

if(!array_key_exists($controller,$controlList) || !in_array($action,$controlList[$controller])){
    $controller = 'page';
    $action = 'error';
}

include_once "controllers/".$controller."_controller.php";
$klass = str_replace("_","",ucwords($controller,"_"))."Controller";
$controller = new $klass;
$controller->$action();
?>