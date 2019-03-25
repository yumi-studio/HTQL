<?php
include "controllers/base_controller.php";
include "models/Project.php";
class ProjectController extends BaseController{
    public function __construct() {
        $this->folder = 'project';
    }
    public function list()
    {
        $this->render('list');
    }
    public function sort()
    {
        $data = Project::getAllProject($_POST['mode'],$_POST['reg']);
        print_r(json_encode($data));
    }
    public function getproject()
    {
        $data = Project::getData($_POST['id']);
        print_r(json_encode($data));
    }
    public function member()
    {
        $data = Project::getMember($_POST['id']);
        print_r(json_encode($data));
    }
    public function register()
    {
        Project::register($_GET['id'],$_GET['regis']);
        header("location: ?controller=project&action=list");
    }
    public function update()
    {
        if(isset($_POST['mode']) and $_POST['mode']==2){
            Project::update($_POST);
        }
    }
    public function create()
    {
        if(isset($_POST['mode']) and $_POST['mode']==1){
            Project::create($_POST);
        }
    }
    public function delete()
    {
        # code...
    }
}
?>