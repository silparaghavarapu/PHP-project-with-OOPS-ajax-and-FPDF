<?php
require_once '../libs/database.php';
class Model_Reports extends Dbh{
    
     protected function viewReportById($id)
    {
    $sql="SELECT reports.Report_Name,reports.Generated_Date,reports.Due_Date,reports.Amount_Due,shop.Shop_Name,shop.Primary_Address,shop.Primary_City,shop.Primary_State,shop.Primary_zip,invoices.Invoice_Name,invoices.Member_Name,invoices.Quantity,invoices.Rate,insurance.Insurance_Name,insurance.insurance_plan FROM reports INNER JOIN shop ON shop.Shop_ID=reports.Shop_ID INNER JOIN  invoices ON invoices.Report_id=reports.Report_Id INNER JOIN insurance ON insurance.Insurance_ID=invoices.insurance_Id WHERE reports.Report_ID=".$id;
    $result=$this->connect()->query($sql);
    $idval="";
    $data="";
    while($row=$result->fetch_assoc()){
        $data[]=$row;
    }
    return $data;
    }
    
    protected function getshopname($id)
    {
        $sql="SELECT reports.Report_Id,reports.Report_Name,shop.Shop_Name,shop.Primary_Address,shop.Primary_City,shop.Primary_State,shop.Primary_zip,reports.Amount_Due,reports.Generated_Date,reports.Due_Date FROM reports INNER JOIN shop ON shop.Shop_ID=reports.Shop_ID  WHERE reports.Report_ID=".$id;
        $result=$this->connect()->query($sql);
        $idval="";
        $data="";
        while($row=$result->fetch_assoc()){
            $data[]=$row;
        }
        return $data;
    }
}