<?php
require_once('config/config.php');
require_once LIBPATH.'database.php';
require_once MODELPATH.'Model_Shop.php';
class Controller_Shop extends Model_Shop {
    
    
    
    public function showAllShop(){
        
        $datas=$this->getShop();
        return $datas;
    }
    public function showAllShops($f,$l){
        
        $datas=$this->getShops($f,$l);
        return $datas;
    }
    
    public function ShopByID($id){
        
        $datas=$this->getShopByID($id);
        return $datas;
    }
    
    public function ShopBySearch($id){
        
        $datas=$this->getShopBySearch($id);
        return $datas;
    }
    
    public function showAllContractEnds($id){
        
        $datas=$this->getShopContractEnds($id);
        return $datas;
    }
    
}