<?php

class Model_Transaction extends Dbh{
    
    public function setMembers()
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
                        
                        
                        $sql="insert into Shop (Shop_Name,Primary_Address,Primary_City,Primary_State,Primary_Zip,Secondary_Address,Company_URL,Contract_Active,Contract_Start_Date,Contract_End_Date,Contract_Attchement_Path,Primary_Contact,Secondary_Contact,Primary_Phone,Secondary_Phone,Primary_Email,Secondary_Email,Fax,Job_Title,Modified_By,Modified_date) values ('".$_POST['Shop_name']."','".$_POST['Primary_address']."','".$_POST['Primary_city']."','".$_POST['Primary_State']."','".$_POST['Primary_zip']."','".$_POST['Secondary_address']."','".$_POST['url']."','".$contract."','".$contract_start."','".$contract_end."','".$file_name."','".$_POST['Primary_contact']."','".$_POST['Secondary_contact']."','".$_POST['Primary_phone']."','".$_POST['Secondary_phone']."','".$_POST['Primary_email']."','".$_POST['Secondary_email']."','".$_POST['Fax']."','".$_POST['Job_title']."','".$_SESSION['empid']."','".Date("Y/m/d")."')";
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
    
    protected function getTransactionById($id)
    {
        // $id="65";
        $getsql="SELECT insurance.Insurance_Name,insurance.Insurance_ID FROM insurance INNER JOIN transaction ON insurance.Insurance_ID=transaction.Insurance_ID AND transaction.Shop_ID=".$id;
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
    protected function getTransactionamountByID($Sid,$Tid)
    {
        $getsql="SELECT * from transaction where Shop_ID=".$Sid." AND Insurance_ID=".$Tid;
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
}