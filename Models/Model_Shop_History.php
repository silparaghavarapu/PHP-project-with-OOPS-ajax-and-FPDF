<?php
require_once LIBPATH.'database.php';
class Model_Shop_History extends Dbh{
    
    protected function getShops($f,$l)
    {
        $getsql="SELECT history_shop.*, b.rowcount FROM `history_shop` INNER JOIN ( SELECT COUNT(*) as rowcount FROM history_shop) b LIMIT  ".$f.",".$l;
        $result=$this->connect()->query($getsql);
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
    protected function getShop()
    {
        $getsql="SELECT * FROM `shop`";
        $result=$this->connect()->query($getsql);
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
    
    protected function getShopByID($id,$f,$l)
    {
        $getsql="select history_shop.*,0 as rowcount from history_shop where Shop_ID=".$id." Limit ".$f.",".$l;
        $data="";
        $result=$this->connect()->query($getsql);
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
  
    protected function ShopeHistoryID($id)
    {
        $getsql="select * from history_shop where id=".$id;
        $data="";
        $result=$this->connect()->query($getsql);
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
    protected function getTransactionamountByID($Sid,$Tid)
    {
        $getsql="SELECT * from history_transaction where history_shop_Id=".$Sid." AND Insurance_ID=".$Tid;
        $result=$this->connect()->query($getsql);
        $data="";
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
    protected function ShopeHistoryDelID($Sid)
    {
        $getsql="Delete from history_transaction where history_shop_Id=".$Sid;
        $result=$this->connect()->query($getsql);
        $sql="Delete from history_shop where id=".$Sid;
        $results=$this->connect()->query($sql);
        return $results;
    }
    
}