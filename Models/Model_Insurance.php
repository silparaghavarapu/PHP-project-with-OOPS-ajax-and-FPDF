<?php
require_once LIBPATH.'database.php';
class Model_Insurance extends Dbh{
    
    public function setInsurance()
    {
        // echo "inside function<br>";
        $sql="insert into insurance (Insurance_Name,insurance_plan,Modified_By,Modified_date) values ('".$_POST['Insurance_name']."','".$_POST['Insurance_plan']."','".$_SESSION['empid']."','".Date("Y/m/d")."')";
        // $results=$this->connect()->query($sql);
        //echo $this->connect()->query($sql)."<br>";
        if ($this->connect()->query($sql) === TRUE) {
            
            $_POST['path']="mainpage";
        } else {
            echo "Error: " . $sql . "<br>" . $this->connect()->error;
        }
    }
    protected function getInsurance()
    {
        $getsql="select * from insurance";
        $result=$this->connect()->query($getsql);
        $data="";
        if($result<> null)
        {
            while($row=$result->fetch_assoc()){
                $data[]=$row;
                
            }
            return $data;
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $this->connect()->error;
            $_SESSION['error']=$this->connect()->error;
        }
        
    }
    protected function getInsurancedetailsbyid()
    {
        $getsql="select * from insurance  where Insurance_ID=".$_SESSION['insuranceid'];
        $result=$this->connect()->query($getsql);
        $data="";
        if($result<> null)
        {
            while($row=$result->fetch_assoc()){
                $data[]=$row;
                
            }
            return $data;
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $this->connect()->error;
            $_SESSION['error']=$this->connect()->error;
        }
        
    }
    protected function DelRecordInsurance()
    {
        $getsql="insert into history_insurance (Insurance_ID,Insurance_Name,insurance_plan,Modified_By,Modified_date,Update_type) select Insurance_ID,Insurance_Name,insurance_plan,Modified_By,Modified_date,'Delete' as update_type from insurance where Insurance_ID=".$_SESSION['insuranceid'];
        $results=$this->connect()->query($getsql);
        $delsql="DELETE from insurance where Insurance_ID=".$_SESSION['insuranceid'];
        $result=$this->connect()->query($delsql);
        $data="";
        if($result<> null)
        {
            while($row=$result->fetch_assoc()){
                $data[]=$row;
                
            }
            return $data;
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $this->connect()->error;
            $_SESSION['error']=$this->connect()->error;
        }
        
    }
    protected function getUpdateInsurance()
    {
        $data="";
        if($_POST['Insurance_name']<>$_POST['Insurance_name1'] || $_POST['Insurance_plan']<>$_POST['Insurance_plan1'])
        {
        
        $getsql="insert into history_insurance (Insurance_ID,Insurance_Name,insurance_plan,Modified_By,Modified_date,Update_type) select Insurance_ID,Insurance_Name,insurance_plan,Modified_By,Modified_date,'Modify' as update_type from insurance where Insurance_ID=".$_SESSION['insuranceid'];
        $results=$this->connect()->query($getsql);
        $updatesql="update insurance set Insurance_Name='".$_POST['Insurance_name']."',insurance_plan='".$_POST['Insurance_name']."',Modified_By='".$_SESSION['empid']."',Modified_date='".Date("Y/m/d")."' where Insurance_ID=".$_SESSION['insuranceid'];
        $result=$this->connect()->query($updatesql);
        if($result<> null)
        {
            while($row=$result->fetch_assoc()){
                $data[]=$row;
                
            }
            return $data;
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $this->connect()->error;
            $_SESSION['error']=$this->connect()->error;
        }
        }
        return $data;
    }
    protected function getInsurances($f,$l)
    {
        $getsql="select b.rowcount,insurance.*  from insurance  INNER JOIN ( SELECT COUNT(*) as rowcount FROM insurance) b LIMIT ".$f.",".$l;
        $result=$this->connect()->query($getsql);
        $data="";
        if($result<> null)
        {
            while($row=$result->fetch_assoc()){
                $data[]=$row;
                
            }
            return $data;
        }
        else
        {
            echo "Error: " . $getsql . "<br>" . $this->connect()->error;
            $_SESSION['error']=$this->connect()->error;
        }
        
    }
    protected function getInsuranceid($id,$f,$l)
    {
        $getsql="select b.rowcount,insurance.* from insurance INNER JOIN ( SELECT COUNT(*) as rowcount FROM insurance) b where Insurance_ID=".$id." LIMIT ".$f.",".$l;
        $result=$this->connect()->query($getsql);
        $data="";
        if($result<> null)
        {
            while($row=$result->fetch_assoc()){
                $data[]=$row;
                
            }
            return $data;
        }
        else
        {
            echo "Error: " . $getsql . "<br>" . $this->connect()->error;
            $_SESSION['error']=$this->connect()->error;
        }
        
    }
}