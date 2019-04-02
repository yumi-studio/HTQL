<?php
include "controllers/base_controller.php";
include "models/Salary.php";
class SalaryController extends BaseController{
    public function __construct(){
        $this->folder='salary';
    }
    public function view(){
        $data = Salary::getSalary($_SESSION['id']);
        $this->render('view',$data);
    }
    public function list(){
        $data = array();
        $data['salaries']= Salary::getAllSalary();
        $this->render('list',$data);
    }
    public function update()
    {
        if (isset($_SESSION['status']) && $_SESSION['status']!=2) {
            Salary::update($_POST);
        } else {
            
        }
        
    }
}
?>