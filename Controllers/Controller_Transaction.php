<?php

require_once "../Models/Model_Transac.php";
class Controller_Transaction extends Model_Transac {
    
    
    
    public function showAllTransaction($id){
        
        $datas=$this->getTransaction($id);
        return $datas;
    }
    public function showMember_Document($id){
        
        $datas=$this->getMemberDocument($id);
        return $datas;
    }
    
}