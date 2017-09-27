<?php
require_once('/config/config.php');
require_once MODELPATH.'Model_Members_History.php';
class Controller_Members_History extends Model_Members_History {
    
    
    
    public function showAllMembers($f,$l){
        
        $datas=$this->getMembers($f,$l);
        return $datas;
    }
    
    public function getMembersByID($id,$f,$l){
        $datas=$this->getMemberByshopID($id,$f,$l);
        return $datas;
    }
    
    public function MembersBySearch($id){
        $datas=$this->getMemberBySearch($id);
        return $datas;
    }
    public function MembersBySearchNShop($sid,$search){
        $datas=$this->getMemberBySearchNShop($sid,$search);
        return $datas;
    }
    
    
    public function showAllMembersTermi($f,$l){
        
        $datas=$this->getMembersTermi($f,$l);
        return $datas;
    }
    
    
    public function getMembersByIDTermi($id,$f,$l){
        $datas=$this->getMemberByshopIDTermi($id,$f,$l);
        return $datas;
    }
    
   
    public function UpdateMembers()
    {
        $datas=$this->getUpdateMembers();
        return $datas;
    }
    
    
    public function deleteMemberById($id)
    {
        
       $datas=$this->getdeleteMembers($id);
       return $datas;   
    }
}