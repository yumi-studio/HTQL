<?php
include_once 'database.php';
include_once 'models/Salary.php';
class Account{
    public static function getAllAccount(){
        switch ($_SESSION['status']) {
            case '0':
                # code...
                $query="SELECT account.* FROM account LEFT JOIN branch ON branch.id={$_SESSION['branch_id']} WHERE status<>0 ORDER BY account.branch_id";
                break;
            case '1':
                $query="SELECT account.* FROM account LEFT JOIN branch ON branch.id={$_SESSION['branch_id']} WHERE status<>0 AND branch_id={$_SESSION['branch_id']} ORDER BY account.branch_id";
            default:
                # code...
                break;
        }
        
        $stmt=DB::getInstance()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
    public static function get($id){
        $query="SELECT * FROM account where id={$id}";
        $stmt=DB::getInstance()->prepare($query);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public static function getByName($q){
        $query="SELECT * FROM account where name like '%{$q}%'";
        $stmt=DB::getInstance()->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    public static function create($data){
        extract($data);
        switch ($role) {
            case '1':
                $roletxt='Giám đốc';
                $money=10000;
                break;
            case '2':
                $roletxt='Nhân viên';
                $money=2000;
                break;
            default:
                break;
        }
        if(isset($btnadd) && $btnadd==1){
            // Them vao bang account
            $query="INSERT into account(username,password,name,address,email,phone,branch_id,position,status) values(:a,:b,:c,:d,:e,:f,:g,:h,:i)";
            $stmt=DB::getInstance()->prepare($query);
            $stmt->bindParam(':a',$username);
            $stmt->bindParam(':b',$password);
            $stmt->bindParam(':c',$name);
            $stmt->bindParam(':d',$address);
            $stmt->bindParam(':e',$email);
            $stmt->bindParam(':f',$phone);
            $stmt->bindParam(':g',$branch);
            $stmt->bindParam(':h',$roletxt);
            $stmt->bindParam(':i',$role);
            $stmt->execute();
            
            // Chon account id moi them vao
            $query="SELECT top 1 id FROM account order by created_at desc";
            $stmt=DB::getInstance()->prepare($query);
            $stmt->execute();
            $row=$stmt->fetch(PDO::FETCH_ASSOC);

            Salary::create($row['id'],$money);
        }
    }
    public static function update($data){
        extract($data);
        switch ($role) {
            case '1':
                $roletxt='Giám đốc';
                $money=10000;
                break;
            case '2':
                $roletxt='Nhân viên';
                $money=2000;
                break;
            default:
                break;
        }
        if(isset($btnupdate) && $btnupdate==2){
            $query="UPDATE account set username=?,password=?,name=?,address=?,email=?,
                phone=?,branch_id=?,position=?,status=? where id=$id";
            $stmt=DB::getInstance()->prepare($query);
            $stmt->bindParam(1,$username);
            $stmt->bindParam(2,$password);
            $stmt->bindParam(3,$name);
            $stmt->bindParam(4,$address);
            $stmt->bindParam(5,$email);
            $stmt->bindParam(6,$phone);
            $stmt->bindParam(7,$branch);
            $stmt->bindParam(8,$roletxt);
            $stmt->bindParam(9,$role);
            $stmt->execute();

            $saldata = array(
                'id'=>$id,
                'fixed_salary'=>$money
            );
            Salary::update($saldata);
        }
    }
    public static function delete($status,$id){
        if($status==0 || $status==1){
            $query="DELETE FROM account WHERE id = {$id}";
            $stmt = DB::getInstance()->prepare($query);
            $stmt->execute();
        }
    }
    public static function updateAvatar($image){
        $imgstr = "ava".$_SESSION['id'].".".(explode(".",$image['name'])[1]);
        move_uploaded_file($image['tmp_name'],"assets/image/avatar/".$imgstr);
        header("location: ?controller=home&action=profile");
    }
}
?>