<?php

class Model_Members extends Dbh{
    
    public function setMembers()
    {
        
        
        
        
       /* if (  _FILES['Document']['name']<>NULL)
        {
            $tmp_doc_name= _FILES['Document']['tmp_name'];
          //  $fp= fopen($tmp_doc_name,'r');
            $file_size= _FILES['Document']['size'];
           // $document=fread($fp,$file_size);
           $document=  file _get_contents( _FILES['Document']['tmp_name']);
            $file_type= _FILES['Document']['type'];
         //   $document = addslashes($document);
          //  fclose($fp);
          echo $document;
            
        }*/
        
        $document="";
        $file_type="";
        $file_size=0;
        
        if ($_FILES['Document']['name']<>NULL)
        {
            $document=MEMBERSUPLOAD.$_POST['Last_name']."_".$_FILES['Document']['name'];
            //echo "<br>new path".$file_path;
            $file_type= $_FILES['Document']['type'];
            $file_size= $_FILES['Document']['size'];
            move_uploaded_file($_FILES['Document']['tmp_name'], $document);
            
        }
        $image_size=0;
        $image_type="";
        $image="";
        if($_FILES['image_upload']['name']<>NULL)
        {
           //$tmp_img_name=$_FILES['image_upload']['name'];
           //$fp_img=fopen($tmp_img_name,'r');
            $image_size=$_FILES['image_upload']['size'];
            $image_type=$_FILES['image_upload']['type'];
           //fclose($fp_img);
           $image = addslashes(file_get_contents($_FILES['image_upload']['tmp_name']));
           
        }
        if(isset($_POST['Hire_date']))
           $hire_date=str_replace("-","/",$_POST['Hire_date']);
        if($hire_date=="")
           $hire_date="0000/00/00";
        if(isset($_POST['Termination_date']) )
           $termination_date=str_replace("-","/",$_POST['Termination_date']);
        if($termination_date=="")
           $termination_date="0000/00/00";
        if(isset($_POST['DOB']))
           $dob=str_replace("-","/",$_POST['DOB']);
        if($dob=="")
           $dob="0000/00/00";
           $sql="insert into members (photo_path,photo_size,photo_type,First_Name,sex,Business_Phone,Home_phone,Last_Name,Mobile_phone,SSN,DOB,Hire_Date,Email_id,Termination_Date,Shop_ID,Insurance_ID,Attachment_path,Attachment_size,Attachment_type,Address,City,State,Zip,Note,Modified_by,Modified_date) values ('".$image."','".$image_size."','".$image_type."','".$_POST['First_name']."','".$_POST['sex']."','".$_POST['Business_phone']."','".$_POST['Home_phone']."','".$_POST['Last_name']."','".$_POST['Mobile_phone']."','".$_POST['Ssn']."','".$_POST['DOB']."','".$hire_date."','".$_POST['Email_id']."','".$termination_date."','".$_POST['shop_id']."','".$_POST['insurance_id']."','".$document."','".$file_size."','".$file_type."','".$_POST['Address']."','".$_POST['City']."','".$_POST['State']."','".$_POST['Zip']."','".$_POST['note']."','".$_SESSION['empid']."','".Date("Y/m/d")."')";
        //   echo $sql;
           
           $results=$this->connect()->query($sql);
          // echo "<br> results :".$results;
           return $results;
                        
    }                                     
    
    public function setUpdateMembers()
    {
        
        if(isset($_POST['Hire_date']))
            $hire_date=str_replace("-","/",$_POST['Hire_date']);
        if($hire_date=="")
            $hire_date="0000/00/00";
        if(isset($_POST['Termination_date']) )
            $termination_date=str_replace("-","/",$_POST['Termination_date']);
        if($termination_date=="")
            $termination_date="0000/00/00";
        if(isset($_POST['DOB']))
            $dob=str_replace("-","/",$_POST['DOB']);
        if($dob=="")
            $dob="0000/00/00";
        if(isset($_POST['Hire_date1']))
            $hire_date1=str_replace("-","/",$_POST['Hire_date1']);
        if($hire_date1=="")
            $hire_date1="0000/00/00";
        if(isset($_POST['Termination_date1']) )
            $termination_date1=str_replace("-","/",$_POST['Termination_date1']);
        if($termination_date1=="")
            $termination_date1="0000/00/00";
        if(isset($_POST['DOB1']))
            $dob1=str_replace("-","/",$_POST['DOB1']);
        if($dob1=="")
            $dob1="0000/00/00";
       
        if($_POST['First_name']<>$_POST['First_name1'] || $_POST['sex']<>$_POST['sex1'] || $_POST['Business_phone']<>$_POST['Business_phone1'] || $_POST['Home_phone']<>$_POST['Home_phone1'] || $_POST['Last_name']<>$_POST['Last_name1'] || $_POST['Mobile_phone']<>$_POST['Mobile_phone1'] || $_POST['Ssn']<>$_POST['Ssn1'] || $dob<>$dob1 || $_POST['Email_id']<>$_POST['Email_id1'] || $_POST['insurance_id']<>$_POST['insurance_id1'] || $_POST['Address']<>$_POST['Address1'] || $_POST['City']<>$_POST['City1'] || $_POST['State']<>$_POST['State1'] || $_POST['Zip']<>$_POST['Zip1'] || $_POST['note']<>$_POST['note1'] || $_FILES['image_upload']['name']<>NULL || $_FILES['Document']['name']<>NULL || $hire_date<>$hire_date1 || $termination_date<>$termination_date1)
        {
            $getsql="insert into history_members (Member_ID,photo_path,photo_size,photo_type,First_Name,sex,Business_Phone,Home_phone,Last_Name,Mobile_phone,SSN,DOB,Hire_Date,Email_id,Termination_Date,Shop_ID,Insurance_ID,Attachment_path,Attachment_size,Attachment_type,Address,City,State,Zip,Note,Modified_by,Modified_date,update_type) select Member_ID,photo_path,photo_size,photo_type,First_Name,sex,Business_Phone,Home_phone,Last_Name,Mobile_phone,SSN,DOB,Hire_Date,Email_id,Termination_Date,Shop_ID,Insurance_ID,Attachment_path,Attachment_size,Attachment_type,Address,City,State,Zip,Note,Modified_by,Modified_date,'Modify' as update_type from members where Member_ID=".$_SESSION['memberid'];
          // echo $getsql."<br>";
            $getresult=$this->connect()->query($getsql);
            $document="";
            $file_type="";
            $file_size=0;
            $doc="";
            
            if ($_FILES['Document']['name']<>NULL)
            {
                $document=MEMBERSUPLOAD.$_POST['Last_name']."_".$_FILES['Document']['name'];
                //echo "<br>new path".$file_path;
                $file_type= $_FILES['Document']['type'];
                $file_size= $_FILES['Document']['size'];
                move_uploaded_file($_FILES['Document']['tmp_name'], $document);
                $doc=",photo_path='".$document."',photo_size=".$file_size.",photo_type='".$file_type."',";
                
                
            }
            $image_size=0;
            $image_type="";
            $image="";
            $photo="";
            if($_FILES['image_upload']['name']<>NULL)
            {
                //$tmp_img_name=$_FILES['image_upload']['name'];
                //$fp_img=fopen($tmp_img_name,'r');
                $image_size=$_FILES['image_upload']['size'];
                $image_type=$_FILES['image_upload']['type'];
                //fclose($fp_img);
                $image = addslashes(file_get_contents($_FILES['image_upload']['tmp_name']));
                $photo=",photo_path='".$image."',photo_size=".$image_size.",photo_type='".$image_type."'";
                
                
            }
            
                                
            $update_sql="UPDATE members SET First_Name='".$_POST['First_name']."',sex='".$_POST['sex']."',Business_Phone='".$_POST['Business_phone']."',Home_phone='".$_POST['Home_phone']."',Last_Name='".$_POST['Last_name']."',Mobile_phone='".$_POST['Mobile_phone']."',SSN='".$_POST['Ssn']."',DOB='".$_POST['DOB']."',Hire_Date='".$hire_date."',Email_id='".$_POST['Email_id']."',Termination_Date='".$termination_date."',Insurance_ID='".$_POST['insurance_id']."',Address='".$_POST['Address']."',City='".$_POST['City']."',State='".$_POST['State']."',Zip='".$_POST['Zip']."',Note='".$_POST['note']."',Modified_by='".$_SESSION['empid']."',Modified_date='".Date("Y/m/d")."'".$doc.$photo." WHERE Member_ID=".$_SESSION['memberid'];
            $updateresult=$this->connect()->query($update_sql);
           // echo $update_sql;
           // echo $updateresult;
     }
        
      }
      protected function getdeleteMembers()
    {
        $getsql="insert into history_members (Member_ID,photo_path,photo_size,photo_type,First_Name,sex,Business_Phone,Home_phone,Last_Name,Mobile_phone,SSN,DOB,Hire_Date,Email_id,Termination_Date,Shop_ID,Insurance_ID,Attachment_path,Attachment_size,Attachment_type,Address,City,State,Zip,Note,Modified_by,Modified_date,update_type) select Member_ID,photo_path,photo_size,photo_type,First_Name,sex,Business_Phone,Home_phone,Last_Name,Mobile_phone,SSN,DOB,Hire_Date,Email_id,Termination_Date,Shop_ID,Insurance_ID,Attachment_path,Attachment_size,Attachment_type,Address,City,State,Zip,Note,Modified_by,Modified_date,'Delete' as update_type from members where Member_ID=".$_SESSION['memberid'];
        $results=$this->connect()->query($getsql);
        $delsql="delete from members where Member_ID=".$_SESSION['memberid'];
        $result=$this->connect()->query($delsql);
        return $result;
    }
    protected function getUpdateMembers()
    {
        $getsql="SELECT * FROM members WHERE Member_ID=".$_SESSION['memberid'];
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
    
    protected function getMembers($f,$l)
    {
        $getsql="SELECT  b.rowcount,members.Member_ID,members.First_Name,members.Business_Phone,members.sex,members.Home_phone,members.Last_Name,members.Mobile_phone,members.SSN,members.DOB,members.Hire_Date,members.Email_id,members.Termination_Date,Attachment_path,members.Address,members.City,members.State,members.Zip,insurance.Insurance_Name,shop.Shop_Name FROM members INNER JOIN insurance ON members.Insurance_ID=insurance.Insurance_ID  INNER JOIN shop ON members.Shop_ID=shop.Shop_ID INNER JOIN ( SELECT COUNT(*) as rowcount FROM members INNER JOIN insurance ON members.Insurance_ID=insurance.Insurance_ID INNER JOIN shop ON members.Shop_ID=shop.Shop_ID) b LIMIT ".$f.",".$l;
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
    
    protected function getMembersTermi($f,$l)
    {
        $currentda=$end_date = date('Y/m/d', strtotime("+90 days"));
        $getsql="SELECT  b.rowcount,members.Member_ID,members.First_Name,members.Business_Phone,members.sex,members.Home_phone,members.Last_Name,members.Mobile_phone,members.SSN,members.DOB,members.Hire_Date,members.Email_id,members.Termination_Date,Attachment_path,members.Address,members.City,members.State,members.Zip,insurance.Insurance_Name,shop.Shop_Name FROM members INNER JOIN insurance ON members.Insurance_ID=insurance.Insurance_ID  INNER JOIN shop ON members.Shop_ID=shop.Shop_ID INNER JOIN ( SELECT COUNT(*) as rowcount FROM members INNER JOIN insurance ON members.Insurance_ID=insurance.Insurance_ID INNER JOIN shop ON members.Shop_ID=shop.Shop_ID) b Where members.Termination_Date  between  '".Date('Y/m/d')."' AND '".$currentda."' LIMIT ".$f.",".$l;
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
            echo "Error: " . $sql . "<br>" . $this->connect()->error;
            $_SESSION['error']=$this->connect()->error;
        }
        
    }
    protected function getMemberByshopID($id,$f,$l)
    {
        $getsql="SELECT  b.rowcount,members.Member_ID,members.First_Name,members.Business_Phone,members.sex,members.Home_phone,members.Last_Name,members.Mobile_phone,members.SSN,members.DOB,members.Hire_Date,members.Email_id,members.Termination_Date,Attachment_path,members.Address,members.City,members.State,members.Zip,insurance.Insurance_Name,shop.Shop_Name FROM members INNER JOIN insurance ON members.Insurance_ID=insurance.Insurance_ID  INNER JOIN shop ON members.Shop_ID=shop.Shop_ID INNER JOIN ( SELECT COUNT(*) as rowcount FROM members INNER JOIN insurance ON members.Insurance_ID=insurance.Insurance_ID INNER JOIN shop ON members.Shop_ID=shop.Shop_ID  WHERE members.Shop_ID=".$id." ) b WHERE members.Shop_ID=".$id."  LIMIT ".$f.",".$l;;
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
    protected function getMemberByshopIDTermi($id,$f,$l)
    {
        $currentda=$end_date = date('Y/m/d', strtotime("+90 days"));
        $getsql="SELECT  b.rowcount,members.Member_ID,members.First_Name,members.Business_Phone,members.sex,members.Home_phone,members.Last_Name,members.Mobile_phone,members.SSN,members.DOB,members.Hire_Date,members.Email_id,members.Termination_Date,Attachment_path,members.Address,members.City,members.State,members.Zip,insurance.Insurance_Name,shop.Shop_Name FROM members INNER JOIN insurance ON members.Insurance_ID=insurance.Insurance_ID  INNER JOIN shop ON members.Shop_ID=shop.Shop_ID INNER JOIN ( SELECT COUNT(*) as rowcount FROM members INNER JOIN insurance ON members.Insurance_ID=insurance.Insurance_ID INNER JOIN shop ON members.Shop_ID=shop.Shop_ID  WHERE members.Shop_ID=".$id." ) b WHERE members.Shop_ID=".$id." AND members.Termination_Date  between  '".Date('Y/m/d')."' AND '".$currentda."' LIMIT ".$f.",".$l;;
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
    protected function getMemberBySearch($id)
    {
        $getsql="SELECT members.Member_ID,members.First_Name,0 as rowcount,members.Business_Phone,members.Home_phone,members.Last_Name,members.Mobile_phone,members.SSN,members.DOB,members.Hire_Date,members.Email_id,members.Termination_Date,Attachment_path,members.Address,members.City,members.State,members.Zip,insurance.Insurance_Name,shop.Shop_Name FROM members INNER JOIN insurance ON members.Insurance_ID=insurance.Insurance_ID  INNER JOIN shop ON members.Shop_ID=shop.Shop_ID WHERE members.First_Name='".$id."' OR members.Last_Name='".$id."' OR members.Email_id='".$id."' OR members.SSN='".$id."' OR members.Address='".$id."' OR members.City='".$id."' OR members.State='".$id."' OR members.Zip='".$id."'  ORDER BY members.Shop_ID";
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
    
    protected function getMemberBySearchNShop($sid,$search)
    {
        $getsql="SELECT members.Member_ID,members.First_Name,members.Business_Phone,members.Home_phone,members.Last_Name,members.Mobile_phone,members.SSN,members.DOB,members.Hire_Date,members.Email_id,members.Termination_Date,Attachment_path,members.Address,members.City,members.State,members.Zip,insurance.Insurance_Name,shop.Shop_Name FROM members INNER JOIN insurance ON members.Insurance_ID=insurance.Insurance_ID  INNER JOIN shop ON members.Shop_ID=shop.Shop_ID WHERE members.First_Name='".$search."' OR members.Last_Name='".$search."' OR members.Email_id='".$search."' OR members.SSN='".$search."' OR members.Address='".$search."' OR members.City='".$search."' OR members.State='".$search."' OR members.Zip='".$search."' AND members.Shop_ID=".$sid."  ORDER BY members.Shop_ID";
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
    protected function getlastinserter()
    {
        $lastsql="SELECT * FROM shop where Shop_ID=(Select MAX(Shop_ID) from shop)";
        $result=$this->connect()->query($lastsql);
        $idval="";
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        return $data;
        //return $idval;
    }
}