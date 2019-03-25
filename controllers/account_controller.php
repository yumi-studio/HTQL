<?php
include_once 'controllers/base_controller.php';
include_once 'models/Account.php';
class AccountController extends BaseController{
    public function __construct(){
        $this->folder = "account";
    }
    public function getall(){
        $result = Account::getAllAccount();
        print_r(json_encode($result));
    }
    public function getdata(){
        if(isset($_POST['id'])){
            $result = Account::get($_POST['id']);
            print_r(json_encode($result));
        }
    }
    public function search(){
        $q = isset($_POST['q'])?$_POST['q']:"";
        $result = Account::getByName($q);
        print_r(json_encode($result));
    }
    public function view(){
        $id = $_GET['id'];
        $data = Account::get($id);
        $this->render('view',$data);
    }
    public function create(){
        Account::create($_POST);
    }
    public function update(){
        Account::update($_POST);
    }
    public function delete(){
        if(isset($_SESSION['status'],$_POST['id'])){
            Account::delete($_SESSION['status'],$_POST['id']);
        }
    }
}
?>