<?php
include_once "database.php";
class Project{
    public static function getAllProject($mode=0,$reg=0){
        $path = "";
        $path2 = "";
        if($reg==0){
            $path2 = "WHERE project.id IN (SELECT distinct project_id from register where account_id={$_SESSION['id']})";
        }else{
            $path2 = "WHERE project.id NOT IN (SELECT distinct project_id from register where account_id={$_SESSION['id']})";
        }

        switch ($mode) {
            case 0:
                $path="SELECT * FROM project ".$path2." order by name ASC";
                break;
            case 1:
                $path="SELECT * FROM project ".$path2." order by name DESC";
                break;
            case 2:
                $path="SELECT * FROM project ".$path2." order by start DESC";
                break;
            case 3:
                $path="SELECT * FROM project ".$path2." order by location ASC";
                break;
            case 4:
                if($reg==0){
                    $path="select project.*,X.*
                    from project,register,(select project_id,count(account_id) as counter
                                from register
                                group by project_id) as X
                    where register.project_id=X.project_id and project.id=register.project_id and register.account_id={$_SESSION['id']}
                    order by x.counter";
                }else{
                    $path="select project.*,X.*
                    from project,register,(select project_id,count(account_id) as counter
                                from register
                                group by project_id) as X
                    where register.project_id=X.project_id and project.id<>register.project_id and register.account_id={$_SESSION['id']}
                    order by x.counter";
                }
                
                break;
            default:
                $path="SELECT * FROM project order by id DESC ".$path2;
                break;
        }

        $stmt=DB::getInstance()->prepare($path);
        $project = array();
        $registed = array();
        if($stmt->execute()){
            $project = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $query2="SELECT project_id from register where account_id={$_SESSION['id']}";
            $stmt2=DB::getInstance()->prepare($query2);
            if($stmt2->execute()){
                $registed = $stmt2->fetchAll(PDO::FETCH_ASSOC);
            }
        }else{
        }
        return array(
            'project'=>$project,
            'registed'=>$registed,
            'admin'=> $_SESSION['status']==0?true:false
        );
    }

    public static function getData($id){
        $sql = "SELECT * FROM project WHERE id=$id";
        $stmt = DB::getInstance()->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public static function getMember($id)
    {
        $query="SELECT username from account,register where account.id=register.account_id and project_id={$id}";
        $stmt=DB::getInstance()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function register($pid,$regis)
    {
        if(isset($pid,$regis)){
            $uid=$_SESSION['id'];
            $query="INSERT INTO register (account_id,project_id) VALUES (:a,:p)";
            $query2="DELETE FROM register WHERE project_id={$pid} AND account_id={$uid}";
            if($_GET['regis']=='true'){
                // echo $query;
                $stmt=DB::getInstance()->prepare($query);
                $stmt->bindParam(":a",$uid);
                $stmt->bindParam(":p",$pid);
                $stmt->execute();
            }else{
                // echo $query2;
                $stmt=DB::getInstance()->prepare($query2);
                $stmt->execute();
            }
        }
    }
    public function update($data)
    {
        $query = "UPDATE project set name=?,location=?,description=?,start=?,finish=? where id={$data['pid']}";
        $stmt= DB::getInstance()->prepare($query);
        $stmt->bindParam(1,$data['pname']);
        $stmt->bindParam(2,$data['ploc']);
        $stmt->bindParam(3,$data['pdesc']);
        $stmt->bindParam(4,$data['pstart']);
        $stmt->bindParam(5,$data['pend']);
        $stmt->execute();
    }
    public function create($data)
    {
        $query = "INSERT into project(name,location,description,start,finish) values(?,?,?,?,?)";
        $stmt= DB::getInstance()->prepare($query);
        $stmt->bindParam(1,$data['pname']);
        $stmt->bindParam(2,$data['ploc']);
        $stmt->bindParam(3,$data['pdesc']);
        $stmt->bindParam(4,$data['pstart']);
        $stmt->bindParam(5,$data['pend']);
        $stmt->execute();
    }
}
?>