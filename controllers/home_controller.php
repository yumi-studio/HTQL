<?php
include 'controllers/base_controller.php';
include_once 'database.php';
include_once 'models/Account.php';
// include 'models/account.php';
class HomeController extends BaseController{
    public function __construct()
    {
        $this->folder = "home";
    }
    public function profile(){
        $data = Account::get($_SESSION['id']);
        $this->render('profile',$data);
    }
    public function login(){
        if(isset($_SESSION['status'])){
            header('location: ?controller=home&action=employee');
        }else{
            $this->render('login');
        }
    }
    public function logout(){
        unset($_SESSION['status']);
        header('location: ?controller=home&action=login');
    }
    public function identify(){
        if(isset($_POST['btnLogin'])){
            $username = $_POST['txtUsername'];
            $password = $_POST['txtPassword'];
            $query = "SELECT TOP 1 id,name,status,branch_id FROM account WHERE username=:u AND password=:p";
            $stmt = DB::getInstance()->prepare($query);
            $stmt->bindParam(':u',$username);
            $stmt->bindParam(':p',$password);
            $stmt->execute();
            if($stmt->execute()){
                $row=$stmt->fetch(PDO::FETCH_ASSOC);
                // if($row['password']==$password){
                $_SESSION['name']=$row['name'];
                $_SESSION['status']=$row['status'];
                $_SESSION['id']=$row['id'];
                $_SESSION['branch_id']=$row['branch_id'];
                if($row['status']==0 || $row['status']==1){
                    header('location: ?controller=home&action=employee');
                }else{
                    header('location: ?controller=account&action=view');
                }
            }else{
                header('location: ?controller=account&action=login');
            }
        }else{
            header('location: ?controller=account&action=login');
        }
    }
    public function employee(){
        $this->render('employee');
    }
}
?>
