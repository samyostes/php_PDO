
<?php
include 'PDOconnect.php';
class Users{
    public $link;
    protected $fname,$sname,$age,$id;
    
    public function __construct(){
        $db_con= new dbConnection();
        $this->link=$db_con->connect();
           }


    function addUser($fname=false,$sname=false,$age=false){

          $pre=$this->link->prepare("INSERT INTO users (fname,sname,age) VALUES (?,?,?)");
          $pa=array($fname,$sname,$age);
          $pre->execute($pa);

          $counts=$pre->rowCount();
          return $counts;
     }


public function getUser($sel=false){

   //fetch one row;
$statement = $this->link->prepare("select *from users");
$statement->execute();
  
$userInfo=$statement->fetchALL(PDO::FETCH_ASSOC);

foreach($userInfo as $info){
    echo $info["fname"]." ".$info["sname"]." aged ".$info["age"]."<br>";
}

}

  
public function updateInfo($fname=false,$sname=false,$age=false, $id=false){
    $sql = "UPDATE users SET 
            fname = :fn, 
            age = :age, 
            sname= :sn
            WHERE id = :id";
$stmt = $this->link->prepare($sql);                                  
$stmt->bindParam(':fn', $this->fname, PDO::PARAM_STR);       
$stmt->bindParam(':age', $this->age, PDO::PARAM_INT); 
$stmt->bindParam(':sn', $this->sname, PDO::PARAM_STR); 
$stmt->bindParam(':id', $this->id, PDO::PARAM_STR);    
  
$stmt->execute();
}

}

 $user= new Users();
 $user>addUser("Lady","Gaga",35);
 $user->getUser();






?>
