<?php
include_once "database.php";
class Salary{
    public static function create($id,$money){
        $query="INSERT into salary(account_id,fixed_salary) values({$id},{$money})";
        $stmt = DB::getInstance()->prepare($query);
        $stmt->execute();
    }
    public static function update($data){
        extract($data);
        if(isset($bonus,$fines)){
            $query = "UPDATE salary SET bonus=$bonus,fines=$fines where id=$id";
            $stmt=DB::getInstance()->prepare($query);
            $stmt->execute();
        }else{
            $query = "UPDATE salary SET fixed_salary=$fixed_salary where id=$id";
            $stmt=DB::getInstance()->prepare($query);
            $stmt->execute();
        }
    }
    public static function getSalary($id){
        $query="SELECT * from salary where account_id={$_SESSION['id']}";
        $stmt=DB::getInstance()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }
    public static function getAllSalary(){
    $query2 = "SELECT salary.id as sid,name,fixed_salary,bonus,fines from salary,account where account.id=salary.account_id and account.status<>0 ".($_SESSION['status']==1?"and account.status<>1":"").($_SESSION['status']==0?"":" and account.branch_id={$_SESSION['branch_id']}");
        $stmt2=DB::getInstance()->prepare($query2);
        $stmt2->execute();
        $row = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        return $row;
    }
}
?>