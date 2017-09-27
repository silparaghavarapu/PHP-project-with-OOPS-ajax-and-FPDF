<?php
include "libs/database.php";
class Model_Employees extends Dbh{
    
    public function setEmployees()
    {
       // echo "inside function<br>";
        $sql="insert into employee (Name,UserName,Email_id,password) values ('".$_POST['name']."','".$_POST['username']."','".$_POST['email']."','".$_POST['password']."')";
       // $results=$this->connect()->query($sql);
        //echo $this->connect()->query($sql)."<br>";
        if ($this->connect()->query($sql) === TRUE) {
           
            $_POST['path']="login";
        } else {
            echo "Error: " . $sql . "<br>" . $this->connect()->error;
        }
    }
    public function getEmployees()
    {
        $getsql="select Emp_id,Name from employee where UserName='".$_POST['Username']."' AND password='".$_POST['password']."'";
        //echo "query ". $getsql."<br>";
        $result=$this->connect()->query($getsql);
        if($result<> null)
        {
            $row=$result->fetch_assoc();
            //echo $row['Name'];
            $_SESSION['username']=$row['Name'];
            $_SESSION['empid']=$row['Emp_id'];
            return $row;
        }
        else 
        {
            echo "Error: " . $sql . "<br>" . $this->connect()->error;
            $_SESSION['error']=$this->connect()->error;
        }
    }
    
}
