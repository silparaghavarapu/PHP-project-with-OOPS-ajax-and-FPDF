<?php
require_once('/config/config.php');
require_once MODELPATH.'Model_Invoice.php';
class Controller_invoice extends Model_Invoice {
    
    
    
    public function showAllReports($f,$l){
        
        $datas=$this->getReport($f,$l);
        return $datas;
    }
    
    public function getReportsByID($id,$f,$l){
        $datas=$this->getReportByID($id,$f,$l);
        return $datas;
    }
    
    public function delReportsByID($id)
    {
        $datas=$this->DeleteReport($id);
        return $datas;
    }
}