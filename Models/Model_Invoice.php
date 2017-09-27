<?php
require_once 'config/config.php';
require_once LIBPATH.'database.php';
class Model_Invoice extends Dbh{

    public function setReports()
    {
        
        
        if(isset($_POST['duedate']))
            $due_date=str_replace("-","/",$_POST['duedate']);
            if($due_date=="")
                $due_date="0000/00/00";
                if($_POST['insurance']=="insurance_carrier")
                {
                    $shop_sum_amount=$this->getshopdetailsByDueAmount($_POST['shopbyname']);
                    
                    foreach($shop_sum_amount as $total)
                    {
                        
                        $sql_report="insert into reports (Report_Name,Shop_ID,Generated_Date,Due_Date,Amount_Due,Created_By,Created_Date) values ('".$_POST['insurance']."',".$_POST['shopbyname'].",'".Date("Y/m/d")."','".$due_date."',".$total['Total'].",'".$_SESSION['empid']."','".Date("Y/m/d")."')";
                        $results=$this->connect()->query($sql_report);
                        // echo $sql_report."<br>";
                    }
                    $reportid="";
                    $lastinsertid=$this->getlastinsert();
                    foreach($lastinsertid as $id)
                    {
                        $reportid=$id['Report_Id'];
                    }
                    
                    $shop_results=$this->getshopdetailsByInsurance($_POST['shopbyname']);
                    
                    foreach ($shop_results as $result_data)
                    {
                        $ins=$result_data['Insurance_Name']."   ".$result_data['insurance_plan'];
                        $sql_insurance="insert into invoices (Report_id,Invoice_Name,insurance_Id,Member_Name,Quantity,Rate,Amount) values (".$reportid.",'".$ins."','".$result_data['Insurance_ID']."','".$result_data['Primary_Contact']."',0,".$result_data['Rate'].",".$result_data['Rate'].")";
                        $results=$this->connect()->query($sql_insurance);
                        //echo $sql_insurance."<br>";
                    }
                    
                }
                elseif($_POST['insurance']=="monthly_due")
                {
                    $shop_sum_amount=$this->getshopdetailsByInsuranceAmount($_POST['shopbyname']);
                    $ins="Monthrly Due";
                    foreach ($shop_sum_amount as $total)
                    {
                        
                        $sql_report="insert into reports (Report_Name,Shop_ID,Generated_Date,Due_Date,Amount_Due,Created_By,Created_Date) values ('".$_POST['insurance']."',".$_POST['shopbyname'].",'".Date("Y/m/d")."','".$due_date."',".$total['Total'].",'".$_SESSION['empid']."','".Date("Y/m/d")."')";
                        $results=$this->connect()->query($sql_report);
                        //echo $sql_report."<br>";
                    }
                    $reportid="";
                    $lastinsertid=$this->getlastinsert();
                    foreach($lastinsertid as $id)
                    {
                        $reportid=$id['Report_Id'];
                    }
                    
                    $shop_monthlydue_results=$this->getamountByInsurance($_POST['shopbyname']);
                    $amount='0.0';
                    if($shop_monthlydue_results<>"")
                    {    
                        foreach ($shop_monthlydue_results as $result_data)
                        {
                            
                             $amount=$result_data['Insurance_Amount'];
                            
                            $sql_insurance="insert into invoices (Report_id,Invoice_Name,insurance_Id,Member_Name,Quantity,Rate,Amount) values (".$reportid.",'".$ins."','".$result_data['Insurance_ID']."','".$result_data['First_Name']."',1,".$amount.",".$amount.")";
                            $results=$this->connect()->query($sql_insurance);
                            // echo $sql_insurance."<br>";
                        }
                    }
                    else 
                    {
                        $sql_insurance="delect reports where Report_Id=".$reportid;
                        $results=$this->connect()->query($sql_insurance);
                    }
                    
                }
                
                
                return $results;
                
    }
    
    private function getshopdetailsByInsurance($id)
    {
        $sql_shop="select shop.Shop_Name,shop.Primary_Address,shop.Primary_City,shop.Primary_State,shop.Primary_zip,shop.Primary_Contact,shop.Secondary_Contact,insurance.Insurance_Name,insurance.Insurance_ID,insurance.insurance_plan,(transaction.Insurance_Amount+transaction.Due_Amount+transaction.Initiation+transaction.Medical_Premium+transaction.Jif_Fund) as Rate FROM shop INNER JOIN insurance INNER JOIN  transaction ON transaction.Insurance_ID=insurance.Insurance_ID AND transaction.Shop_ID=shop.Shop_ID where shop.Shop_ID=".$id;
        //echo $sql_shop;
        $shop_result=$this->connect()->query($sql_shop);
        if($shop_result<> null)
        {
            while($row=$shop_result->fetch_assoc()){
                $data[]=$row;
            }
            return $data;
        }
    }
    private function getamountByInsurance($id)
    {
        $sql_shop="select shop.Shop_Name,shop.Primary_Address,shop.Primary_City,shop.Primary_State,shop.Primary_zip,shop.Primary_Contact,shop.Secondary_Contact,members.First_Name,members.Last_Name,members.Insurance_ID,insurance.Insurance_ID,insurance.Insurance_Name,insurance.insurance_plan,transaction.Insurance_Amount,transaction.Due_Amount,transaction.Initiation,transaction.Medical_Premium,transaction.Jif_Fund FROM shop INNER JOIN members ON members.Shop_ID = shop.Shop_ID INNER JOIN insurance ON insurance.Insurance_ID=members.Insurance_ID INNER JOIN  transaction ON transaction.Insurance_ID=insurance.Insurance_ID AND transaction.Shop_ID=shop.Shop_ID where shop.Shop_ID=".$id;
        $shop_result=$this->connect()->query($sql_shop);
        $data="";
        if($shop_result<> null)
        {
            while($row=$shop_result->fetch_assoc()){
                $data[]=$row;
            }
            return $data;
        }
    }
    
    private function getshopdetailsByDueAmount($id)
    {
        $sql_shop="SELECT SUM(Insurance_Amount),sum(Due_Amount),sum(Initiation),sum(Medical_Premium),sum(Jif_Fund), (SUM(Insurance_Amount)+sum(Due_Amount)+sum(Initiation)+sum(Medical_Premium)+sum(Jif_Fund)) as Total FROM `transaction` WHERE SHOP_ID=".$id;
        $shop_result=$this->connect()->query($sql_shop);
       // echo $sql_shop."<br>";
        if($shop_result<> null)
        {
            while($row=$shop_result->fetch_assoc()){
                $data[]=$row;
            }
            return $data;
        }
        
    }
    
    protected function getshopdetailsByInsuranceAmount($id)
    {
        $sql_shop="select sum(transaction.Insurance_Amount) as Total,transaction.Due_Amount,transaction.Initiation,transaction.Medical_Premium,transaction.Jif_Fund FROM shop INNER JOIN members ON members.Shop_ID = shop.Shop_ID INNER JOIN insurance ON insurance.Insurance_ID=members.Insurance_ID INNER JOIN  transaction ON transaction.Insurance_ID=insurance.Insurance_ID AND transaction.Shop_ID=shop.Shop_ID where shop.Shop_ID=".$id;
        $shop_result=$this->connect()->query($sql_shop);
      //  echo $sql_shop."<br>";
        if($shop_result<> null)
        {
            while($row=$shop_result->fetch_assoc()){
                $data[]=$row;
            }
            return $data;
        }
    }
    
    
    protected function getlastinsert()
    {
        $lastsql="SELECT * FROM reports where Report_Id=(Select MAX(Report_Id) from reports)";
        $result=$this->connect()->query($lastsql);
        $idval="";
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        return $data;
        //return $idval;
    }
    
    
    

protected function getReport($f,$l)
{
    $data="";
    $sql="Select  b.rowcount,reports.Report_Id,reports.Report_Name,shop.Shop_Name,employee.Name,reports.Generated_Date,reports.Due_Date,reports.Amount_Due FROM reports INNER JOIN employee ON employee.Emp_id=reports.Created_By INNER JOIN shop ON shop.Shop_ID=reports.Shop_ID INNER JOIN (Select COUNT(*) as rowcount FROM reports INNER JOIN employee ON employee.Emp_id=reports.Created_By INNER JOIN shop ON shop.Shop_ID=reports.Shop_ID) b LIMIT ".$f.",".$l;
    $result=$this->connect()->query($sql);
    $idval="";
    while($row=$result->fetch_assoc()){
        $data[]=$row;
    }
    return $data;
}
protected function getReportByID($id,$f,$l)
{
    $data="";
    $sql="Select b.rowcount, reports.Report_Id,reports.Report_Name,shop.Shop_Name,employee.Name,reports.Generated_Date,reports.Due_Date,reports.Amount_Due FROM reports INNER JOIN employee ON employee.Emp_id=reports.Created_By INNER JOIN shop ON shop.Shop_ID=reports.Shop_ID INNER JOIN (Select COUNT(*) as rowcount FROM reports INNER JOIN employee ON employee.Emp_id=reports.Created_By INNER JOIN shop ON shop.Shop_ID=reports.Shop_ID WHERE reports.Shop_ID=".$id.") b WHERE reports.Shop_ID=".$id." LIMIT ".$f.",".$l;  
    $result=$this->connect()->query($sql);
    $idval="";
    while($row=$result->fetch_assoc()){
        $data[]=$row;
    }
    return $data;
}

protected function DeleteReport($id)
{
    $delrep="delete from reports where Report_Id=".$id;
    $delresult=$this->connect()->query($delrep);
    $delinvo="delete from invoices where Report_id=".$id;
    $results=$this->connect()->query($delinvo);
    return $results;
    
}
}