<?php
require_once '../libs/database.php';
class Model_Transac extends Dbh{
    protected function getTransaction($id)
    {
       // $id="65";
        $getsql="SELECT insurance.Insurance_Name,insurance.insurance_plan,insurance.Insurance_ID FROM insurance INNER JOIN transaction ON insurance.Insurance_ID=transaction.Insurance_ID AND transaction.Shop_ID=".$id;
        $result=$this->connect()->query($getsql);
        if($result<> null)
        {
            while($rows=$result->fetch_assoc()){
                $data[]=$rows;
                
            }
            return $data;
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $this->connect()->error;
            $_SESSION['error']=$this->connect()->error;
        }
        
    }
    protected function getMemberDocument($id)
    {
        $getsql="SELECT * from members where Member_ID=".$id;
        echo $getsql;
        $result=$this->connect()->query($getsql);
        if($result<> null)
        {
            while($rows=$result->fetch_assoc()){
                $datas[]=$rows;
                
            }
            return $datas;
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $this->connect()->error;
            $_SESSION['error']=$this->connect()->error;
        }
    }
}