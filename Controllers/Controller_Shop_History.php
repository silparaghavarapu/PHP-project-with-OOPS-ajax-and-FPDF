<?php
require_once('config/config.php');

require_once MODELPATH.'Model_Shop_History.php';
class Controller_Shop_History extends Model_Shop_History {
    
    
    
    public function showAllShop(){
        
        $datas=$this->getShop();
        return $datas;
    }
    public function showAllShops($f,$l){
        
        $datas=$this->getShops($f,$l);
        return $datas;
    }
    
    public function ShopByID($id,$f,$l){
        
        $datas=$this->getShopByID($id,$f,$l);
        return $datas;
    }
    public function ShopHistryByID($id){
        
        $datas=$this->ShopeHistoryID($id);
        return $datas;
    }
    public function ShopHistryDel($id){
        
        $datas=$this->ShopeHistoryDelID($id);
        return $datas;
    }
    public function getTransactionsbyID($Sid,$Tid){
        
        $datas=$this->getTransactionamountByID($Sid,$Tid);
        return $datas;
    
    }
}