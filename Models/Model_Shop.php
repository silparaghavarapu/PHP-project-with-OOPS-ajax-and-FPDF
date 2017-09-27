<?php

class Model_Shop extends Dbh{
    
    public function setShop()
    {
        // echo "inside function<br>";
        if(isset($_POST['Contract_active']))
        {
            $contract=1;
        }
        else 
        {
            $contract=0;
        }
         $file_name="";
         
        //$newstring=str_replace("/","_",($_POST['Shop_name']);
        $match    = array(']','\\',';',"'",',','.','/','~','`','=');
        $replace  = array('-','','','','','','','','','');
        $newstring     = str_replace($match, $replace, $_POST['Shop_name']);
        
        if ($_FILES['Contract_document']['name']<>NULL)
        {
            $file_path=SHOPUPLOAD.$newstring.".".pathinfo($_FILES['Contract_document']['name'],PATHINFO_EXTENSION);
            //echo "<br>new path".$file_path;
            $file_name=$newstring.".".pathinfo($_FILES['Contract_document']['name'],PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['Contract_document']['tmp_name'], $file_path);
             
        }
                
        if(isset($_POST['Contract_start']))
            $contract_start=str_replace("-","/",$_POST['Contract_start']);
            if($contract_start=="")
                $contract_start="0000/00/00";
            if(isset($_POST['Contract_end']) )
                $contract_end=str_replace("-","/",$_POST['Contract_end']);
            if($contract_end=="")
                $contract_end="0000/00/00";
                
               
        $sql="insert into Shop (Shop_Name,Primary_Address,Primary_City,Primary_State,Primary_Zip,Secondary_Address,Company_URL,Contract_Active,Contract_Start_Date,Contract_End_Date,Contract_Attchement_Path,Primary_Contact,Secondary_Contact,Primary_Phone,Secondary_Phone,Primary_Email,Secondary_Email,Fax,Job_Title,Modified_By,Modified_date,Primary_note,Secondary_note) values ('".$_POST['Shop_name']."','".$_POST['Primary_address']."','".$_POST['Primary_city']."','".$_POST['Primary_State']."','".$_POST['Primary_zip']."','".$_POST['Secondary_address']."','".$_POST['url']."','".$contract."','".$contract_start."','".$contract_end."','".$file_name."','".$_POST['Primary_contact']."','".$_POST['Secondary_contact']."','".$_POST['Primary_phone']."','".$_POST['Secondary_phone']."','".$_POST['Primary_email']."','".$_POST['Secondary_email']."','".$_POST['Fax']."','".$_POST['Job_title']."','".$_SESSION['empid']."','".Date("Y/m/d")."','".$_POST['Primary_note']."','".$_POST['Secondary_note']."')";
        $results=$this->connect()->query($sql);
        $igetvalue=$this->getlastinserter();
     
        foreach ($igetvalue as $result) {
          $id= $result['Shop_ID'];
          
        } 
       // echo $id;
         $i=$_POST['i_values'];
 
        $inc=1;
        while ($inc<=$i){
        
            $x="insurance".$inc;
            if(isset($_POST[$x]))
            {
                if($_POST['Ins_amount_'.$inc]==""){
                    $insurance_amount="0.0";
                }
                else
                {
                    $insurance_amount=$_POST['Ins_amount_'.$inc];
                }
                if($_POST['Initiation_'.$inc]==""){
                    $initiation="0.0";
                }
                else
                {
                    $initiation=$_POST['Initiation_'.$inc];
                }
                if($_POST['due_amount_'.$inc]==""){
                    $due="0.0";
                }
                else
                {
                    $due=$_POST['due_amount_'.$inc];
                }
                if($_POST['Mdeical_'.$inc]==""){
                    $medical="0.0";
                }
                else
                {
                    $medical=$_POST['Mdeical_'.$inc];
                }
                if($_POST['Jif_'.$inc]==""){
                    $jif="0.0";
                }
                else
                {
                    $jif=$_POST['Jif_'.$inc];
                }
                $sql_transaction="insert into transaction (Shop_ID,Insurance_ID,Insurance_Amount,Due_Amount,Initiation,Medical_Premium,Jif_Fund,Modified_By,Modified_Date) values ('". $id."','".$_POST['insurance_'.$inc]."','".$insurance_amount."','".$due."','".$initiation."','".$medical."','".$jif."','".$_SESSION['empid']."','".Date("Y/m/d")."')";
               // echo "<br>".$sql_transaction;
                $results_transaction=$this->connect()->query($sql_transaction);
               // echo "<br>".$results_transaction;
               
            }
            $inc++;
        }
               
      
    }
    
    public function UpdateShop()
    {
        // echo "inside function<br>";
        if(isset($_POST['Contract_active']))
        {
            $contract=1;
        }
        else
        {
            $contract=0;
        }
        
        
        if(isset($_POST['Contract_start']))
          $contract_start=str_replace("-","/",$_POST['Contract_start']);
        if($contract_start=="")
          $contract_start="0000/00/00";
        if(isset($_POST['Contract_end']) )
          $contract_end=str_replace("-","/",$_POST['Contract_end']);
        if($contract_end=="")
          $contract_end="0000/00/00";
        if(isset($_POST['Contract_start1']))
          $contract_start1=str_replace("-","/",$_POST['Contract_start1']);
        if($contract_start1=="")
          $contract_start1="0000/00/00";
        if(isset($_POST['Contract_end1']) )
         $contract_end1=str_replace("-","/",$_POST['Contract_end1']);
        if($contract_end1=="")
          $contract_end1="0000/00/00";
        $updates=1;
        if($_POST['Shop_name'] <> $_POST['Shop_name1'] || $_POST['Primary_address'] <> $_POST['Primary_address1'] || $_POST['Primary_city'] <> $_POST['Primary_city1'] || $_POST['Primary_State'] <> $_POST['Primary_State1'] || $_POST['Primary_zip'] <> $_POST['Primary_zip1'] || $_POST['Secondary_address'] <> $_POST['Secondary_address1'] || $contract_start1 <> $contract_start || $_POST['url'] <> $_POST['url1'] || $contract_end1 <> $contract_end || $_POST['Primary_contact'] <> $_POST['Primary_contact1'] || $_POST['Primary_phone'] <> $_POST['Primary_phone1'] || $_POST['Secondary_contact'] <> $_POST['Secondary_contact1'] || $_POST['Secondary_phone'] <> $_POST['Secondary_phone1'] || $_POST['Primary_email'] <> $_POST['Primary_email1'] || $_POST['Secondary_email'] <> $_POST['Secondary_email1'] || $_FILES['Contract_document']['name']<>NULL || $_POST['Primary_note'] <> $_POST['Primary_note1'] || $_POST['Secondary_note'] <> $_POST['Secondary_note1'] || $_POST['Contract_active1']<>$contract)
        {
            $updates=0;
            $file_name="";
            
            //$newstring=str_replace("/","_",($_POST['Shop_name']);
            $match    = array(']','\\',';',"'",',','.','/','~','`','=');
            $replace  = array('-','','','','','','','','','');
            $newstring     = str_replace($match, $replace, $_POST['Shop_name']);
            
            if ($_FILES['Contract_document']['name']<>NULL)
            {
                $file_path=SHOPUPLOAD.$newstring.".".pathinfo($_FILES['Contract_document']['name'],PATHINFO_EXTENSION);
                //echo "<br>new path".$file_path;
                $file_name=", Contract_Attchement_Path=".$newstring.".".pathinfo($_FILES['Contract_document']['name'],PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['Contract_document']['tmp_name'], $file_path);
                
            }
            $updateresult="";
            $getsql="insert into history_shop (Shop_ID,Shop_Name,Primary_Address,Primary_City,Primary_State,Primary_Zip,Secondary_Address,Company_URL,Contract_Active,Contract_Start_Date,Contract_End_Date,Contract_Attchement_Path,Primary_Contact,Secondary_Contact,Primary_Phone,Secondary_Phone,Primary_Email,Secondary_Email,Fax,Job_Title,Modified_By,Modified_date,Primary_note,Secondary_note,update_type) select Shop_ID,Shop_Name,Primary_Address,Primary_City,Primary_State,Primary_Zip,Secondary_Address,Company_URL,Contract_Active,Contract_Start_Date,Contract_End_Date,Contract_Attchement_Path,Primary_Contact,Secondary_Contact,Primary_Phone,Secondary_Phone,Primary_Email,Secondary_Email,Fax,Job_Title,Modified_By,Modified_date,Primary_note,Secondary_note,'Modify' as update_type from shop where Shop_ID=".$_SESSION['shopid'];
            echo $getsql."<br>";
            $igetvalue="";
            $igetvalue=$this-> getlastinsert();
            foreach ($igetvalue as $result) {
                $id= $result['id'];
                echo $id."<br>";
                
            } 
            $getresult=$this->connect()->query($getsql);
            $update_sql="UPDATE shop SET Shop_Name='".$_POST['Shop_name']."',Primary_Address='".$_POST['Primary_address']."',Primary_City='".$_POST['Primary_city']."',Primary_State='".$_POST['Primary_State']."',Primary_zip='".$_POST['Primary_zip']."',Secondary_Address='".$_POST['Secondary_address']."',Company_URL='".$_POST['url']."',Contract_Active='".$contract."',Contract_Start_Date='".$contract_start."',Contract_End_Date='".$contract_end."',Primary_Contact='".$_POST['Primary_contact']."',Secondary_Contact='".$_POST['Secondary_contact']."',Primary_Phone='".$_POST['Primary_phone']."',Secondary_Phone='".$_POST['Secondary_phone']."',Primary_note='".$_POST['Primary_note']."',Secondary_note='".$_POST['Secondary_note']."',Primary_Email='".$_POST['Primary_email']."',Secondary_Email='".$_POST['Secondary_email']."',Fax='".$_POST['Fax']."',Job_Title='".$_POST['Job_title']."',Modified_By='".$_SESSION['empid']."',Modified_Date='".Date("Y/m/d")."'".$file_name." WHERE Shop_ID=".$_SESSION['shopid'];
           echo $getresult."<br>";
            $updateresult=$this->connect()->query($update_sql);
            
            
        }
        
                        
                  //      $sql="insert into Shop (Shop_Name,Primary_Address,Primary_City,Primary_State,Primary_Zip,Secondary_Address,Company_URL,Contract_Active,Contract_Start_Date,Contract_End_Date,Contract_Attchement_Path,Primary_Contact,Secondary_Contact,Primary_Phone,Secondary_Phone,Primary_Email,Secondary_Email,Fax,Job_Title,Modified_By,Modified_date) values ('".$_POST['Shop_name']."','".$_POST['Primary_address']."','".$_POST['Primary_city']."','".$_POST['Primary_State']."','".$_POST['Primary_zip']."','".$_POST['Secondary_address']."','".$_POST['url']."','".$contract."','".$contract_start."','".$contract_end."','".$file_name."','".$_POST['Primary_contact']."','".$_POST['Secondary_contact']."','".$_POST['Primary_phone']."','".$_POST['Secondary_phone']."','".$_POST['Primary_email']."','".$_POST['Secondary_email']."','".$_POST['Fax']."','".$_POST['Job_title']."','".$_SESSION['empid']."','".Date("Y/m/d")."')";
                  //      $results=$this-> connect ()-> query ($sql);
                  //      $igetvalue=$this-> getlastinserter ();
                        
                    //    foreach ($igetvalue as $result) {
                     //       $id= $result['Shop_ID'];
                            
                      //  }
                        // echo $id;
                        $i=$_POST['i_values'];
                        
                        $inc=1;
                        $insu=1;
                        $ini=1;
                        $duea=1;
                        $medi=1;
                        $ji=1;
                        while ($inc<=$i){
                            
                            $x="insurance".$inc;
                            if(isset($_POST[$x]))
                            {
                                if($_POST['Ins_amount_'.$inc]==""){
                                    $insurance_amount="0.0";
                                }
                                else
                                {
                                    if($_POST['Ins_amount_'.$inc]<>$_POST['Ins_amount1_'.$inc])
                                    $insu=0;
                                    $insurance_amount=$_POST['Ins_amount_'.$inc];
                                }
                                if($_POST['Initiation_'.$inc]==""){
                                    $initiation="0.0";
                                }
                                else
                                {
                                    if($_POST['Initiation_'.$inc]<>$_POST['Initiation1_'.$inc])
                                        $ini=0;
                                    $initiation=$_POST['Initiation_'.$inc];
                                }
                                if($_POST['due_amount_'.$inc]==""){
                                    $due="0.0";
                                }
                                else
                                {
                                    if($_POST['due_amount_'.$inc]<>$_POST['due_amount1_'.$inc])
                                        $duea=0;
                                    $due=$_POST['due_amount_'.$inc];
                                }
                                if($_POST['Mdeical_'.$inc]==""){
                                    $medical="0.0";
                                }
                                else
                                {
                                    if($_POST['Mdeical_'.$inc]<>$_POST['Mdeical1_'.$inc])
                                        $medi=0;
                                    $medical=$_POST['Mdeical_'.$inc];
                                }
                                if($_POST['Jif_'.$inc]==""){
                                    $jif="0.0";
                                }
                                else
                                {
                                    if($_POST['Jif_'.$inc]<>$_POST['Jif1_'.$inc])
                                        $ji=0;
                                    $jif=$_POST['Jif_'.$inc];
                                }
                                
                                
                              //  echo $sql_transaction."<br>";
                              //  echo $_POST['insurance_'.$inc]. "    ".$_POST['insurance1_'.$inc];
                                echo $insu==0 || $ini==0 || $duea || $medi==0 || $ji==0 || $updates==0 || $updates==0;
                                if($insu==0 || $ini==0 || $duea || $medi==0 || $ji==0 || $updates==0 || $updates==0)
                                {
                                    if($updates==1)
                                    {
                                        $getsql="insert into history_shop (Shop_ID,Shop_Name,Primary_Address,Primary_City,Primary_State,Primary_Zip,Secondary_Address,Company_URL,Contract_Active,Contract_Start_Date,Contract_End_Date,Contract_Attchement_Path,Primary_Contact,Secondary_Contact,Primary_Phone,Secondary_Phone,Primary_Email,Secondary_Email,Fax,Job_Title,Modified_By,Modified_date,Primary_note,Secondary_note,update_type) select Shop_ID,Shop_Name,Primary_Address,Primary_City,Primary_State,Primary_Zip,Secondary_Address,Company_URL,Contract_Active,Contract_Start_Date,Contract_End_Date,Contract_Attchement_Path,Primary_Contact,Secondary_Contact,Primary_Phone,Secondary_Phone,Primary_Email,Secondary_Email,Fax,Job_Title,Modified_By,Modified_date,Primary_note,Secondary_note,'Modify' as update_type from shop where Shop_ID=".$_SESSION['shopid'];
                                        echo "insider up 1 ".$getsql."<br>";
                                        $getresult=$this->connect()->query($getsql);
                                        $igetvalue="";
                                        $igetvalue=$this-> getlastinsert();
                                        foreach ($igetvalue as $result) {
                                            $id= $result['id'];
                                            
                                        } 
                                        $updates=0;
                                    }
                                    $sql_transaction="insert into history_transaction (history_shop_Id,Shop_ID,Transaction_ID,Insurance_ID,Insurance_Amount,Due_Amount,Initiation,Medical_Premium,Jif_Fund,Modified_By,Modified_Date,update_type) select ".$id." as history_shop_Id,Shop_ID,Transaction_ID,Insurance_ID,Insurance_Amount,Due_Amount,Initiation,Medical_Premium,Jif_Fund,Modified_By,Modified_Date,'Modify' as update_type from transaction where Shop_ID=".$_SESSION['shopid']." AND Insurance_ID=".$_POST['insurance_'.$inc];
                                    $results_transaction=$this->connect()->query($sql_transaction);
                                    echo $sql_transaction;
                                    if($_POST['insurance_'.$inc]==$_POST['insurance1_'.$inc])
                                    {
                                        
                                        $update_transac="UPDATE transaction SET Insurance_Amount='".$insurance_amount."',Due_Amount='".$due."',Initiation='".$initiation."',Medical_Premium='".$medical."',Jif_Fund='".$jif."',Modified_By='".$_SESSION['empid']."',Modified_Date='".Date("Y/m/d")."' WHERE Shop_ID=".$_SESSION['shopid']." AND Insurance_ID=".$_POST['insurance_'.$inc];
                                        $results_transac=$this->connect()->query($update_transac);
                                      //  echo $update_transac."<br>";
                                    }
                                    else
                                    {
                                        $sqltransaction="insert into transaction (Shop_ID,Insurance_ID,Insurance_Amount,Due_Amount,Initiation,Medical_Premium,Jif_Fund,Modified_By,Modified_Date) values ('". $_SESSION['shopid']."','".$_POST['insurance_'.$inc]."','".$insurance_amount."','".$due."','".$initiation."','".$medical."','".$jif."','".$_SESSION['empid']."','".Date("Y/m/d")."')";
                                        $resultstransac=$this->connect()->query($sqltransaction);
                                       // echo $sqltransaction."<br>";
                                    }
                                    
                                }
                            }
                            $inc++;
                        }
                        
                       // echo "<br> outside insurance ". $insu."   ".$ini."  ".$duea."   ".$medi."   ".$ji;                     
                        
    }
    
    protected function getShops($f,$l)
    {
        $getsql="SELECT shop.*, b.rowcount FROM `shop` INNER JOIN ( SELECT COUNT(*) as rowcount FROM shop) b LIMIT  ".$f.",".$l;
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
    protected function getShopContractEnds($id)
    {
      
        $currentda=$end_date = date('Y/m/d', strtotime("+60 days"));
       if($id==0)
       {
           $getsql="SELECT * from shop where Contract_Active=".$id." OR Contract_End_Date<'".Date('Y/m/d')."'";
       }
       else
       {
           if($id==30)
           {
               $currentda=$end_date = date('Y/m/d', strtotime("+30 days"));
           }
           elseif($id==60)
           {
               $currentda=$end_date = date('Y/m/d', strtotime("+60 days"));
           }
           elseif($id==90)
           {
               $currentda=$end_date = date('Y/m/d', strtotime("+90 days"));
           }
           $getsql="select * from shop where Contract_End_Date between  '".Date('Y/m/d')."' AND '".$currentda."'";
       }
           
        
       // $getsql="SELECT * from shop where Contract_End_Date between ".Date('Y/m/d').",".date_add(date('Y/m/d'), 'INTERVAL 60 DAY');
       
       // echo $getsql;
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
    protected function getShop()
    {
        $getsql="SELECT * FROM `shop`";
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
    
    protected function getShopByID($id)
    {
        $getsql="select shop.*,0 as rowcount from shop where Shop_ID=".$id;
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
    protected function getShopBySearch($id)
    {
        $getsql="select shop.*,0 as rowcount from shop where Shop_Name='".$id."' OR Primary_City='".$id."' OR Primary_State='".$id."' OR Primary_zip='".$id."' OR Primary_Contact='".$id."' OR Secondary_Contact='".$id."'";
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
        $data="";
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
      return $data;
               //return $idval;
    }
    protected function getlastinsert()
    {
        $lastsql="SELECT * FROM history_shop where id=(Select MAX(id) from history_shop)";
        $result=$this->connect()->query($lastsql);
        $idval="";
        $data="";
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        return $data;
        //return $idval;
    }
}