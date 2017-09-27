<?php

require_once MODELPATH."Model_Transaction.php";
class Controller_Transactions extends Model_Transaction {
    
    
    
    public function showAllTransaction($id){
        
        $datas=$this->getTransaction($id);
        return $datas;
    }
    
    public function getTransactions($id){
        
        $datas=$this->getTransactionById($id);
        return $datas;
    }
    public function getTransactionsbyID($Sid,$Tid){
        
        $datas=$this->getTransactionamountByID($Sid,$Tid);
        return $datas;
    }
}
