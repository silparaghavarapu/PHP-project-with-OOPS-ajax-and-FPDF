<?php
require_once '../Models/Model_Reports.php';
class Controller_Reports extends Model_Reports {
    
    
    
    
    
    public function viewReports($id)
    {
        $data=$this->viewReportById($id);
        return $data;
        
    }
    
    public function getshopdetails($id)
    {
        $data=$this->getshopname($id);
        return $data;
    }
   
}