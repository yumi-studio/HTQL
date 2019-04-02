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
        if (isset($_SESSION['status']) && $_SESSION['status']==0) {
            if(isset($_POST['mode']) and $_POST['mode']==2){
                Project::update($_POST);
                echo "Updated!";
            }
        } else {
            echo "Required Admin Permission";
        }
        
        
    }
    public function create()
    {
        if (isset($_SESSION['status']) && $_SESSION['status']==0) {
            if(isset($_POST['mode']) and $_POST['mode']==1){
                Project::create($_POST);
                echo "Created!";
            }else{
                echo "Wrong mode";
            }
        } else {
            echo "Required Admin Permission";
        }
         
        
    }
    public function delete()
    {
        if(isset($_SESSION['status']) & $_SESSION['status']==0){
            if(isset($_POST['id'])){
                $result = Project::delete($_POST['id']);
                switch ($result) {
                    case 1:
                        # code...
                        echo "Đã xóa dự án";
                        break;
                    case 0:
                        # code...
                        echo "Xóa dự án thất bại";
                        break;
                    default:
                        # code...
                        echo "đã xảy ra lỗi";
                        break;
                }
            }else{
                echo "id undefined";
            }
        }else{
            echo "Bạn không đủ quyền hạn để thực hiện hành vi này";
        }
    }
}
?>