<?php
require_once('/config/config.php');
require_once MODELPATH.'Model_Insurance.php';
class Controller_Insurance extends Model_Insurance {
    
    
    
    public function showAllInsurances(){
        
        $datas=$this->getInsurance();
        return $datas;
    }
   
    public function showAllHistInsurances($f,$l){
        
        $datas=$this->getHistoryInsurance($f,$l);
        return $datas;
    }
    public function showAllInsurance($f,$l){
        
        $datas=$this->getInsurances($f,$l);
        return $datas;
    }
    public function getInsuranceByID($id,$f,$l){
        
        $datas=$this->getInsuranceid($id,$f,$l);
        return $datas;
    }
    public function getInsuranceHistByID($id,$f,$l){
        
        $datas=$this->getInsurancehistoryid($id,$f,$l);
        return $datas;
    }
    public function getInsurnace()
    {
        $data=$this->getInsurancedetailsbyid();
        return $data;
    }
    public function UpdateInsurance()
    {
        $datas=$this->getUpdateInsurance();
        return $datas;
    }
    public function DeleteInsurance($id)
    {
        $datas=$this->DelRecordInsurance($id);
        return $datas;
    }
}