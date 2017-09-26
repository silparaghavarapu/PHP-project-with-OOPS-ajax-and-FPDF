
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Speciality Trade Union</title>
  
 
</head>
<link rel="stylesheet" href="public/css/style.css">
  <script src="public/js/index.js"></script>

<body>

<?php
session_start();
require 'config/config.php';

//echo"path  :".$_SESSION['path'];

If(isset($_SESSION['path'])=="")
{
    
    include_once '/'.VIEWPATH.'login.php';
}
else{
   
    
    if($_SESSION['path']=="login")
    {
        include '/'.VIEWPATH.'login.php';
    }
    if($_SESSION['path']=="signup")
    {
        include '/'.VIEWPATH.'signup.php';
    }
    if($_SESSION['path']=="mainpage" || $_SESSION['path']=="transaction")
    {
       
        include '/'.VIEWPATH.'home.php';
    }
    if($_SESSION['path']=="shop")
    {
        
        include '/'.VIEWPATH.'Shop.php';
    }
    if($_SESSION['path']=="listofshops")
    {
        
        include '/'.VIEWPATH.'ShopLists.php';
    }
    if($_SESSION['path']=="contractend")
    {
        
        include '/'.VIEWPATH.'ShopContractEnd.php';
    }
    if($_SESSION['path']=="member")
    {
        
        include '/'.VIEWPATH.'members.php';
    }
    if($_SESSION['path']=="memberlist")
    {
        
        include '/'.VIEWPATH.'MemberLists.php';
    }
    if($_SESSION['path']=="memberterminate")
    {
        
        include '/'.VIEWPATH.'MembersTerminate.php';
    }
    if($_SESSION['path']=="insurance")
    {
        
        include '/'.VIEWPATH.'insurance.php';
    }
    if($_SESSION['path']=="memberUpdate")
    {
        include '/'.VIEWPATH.'member_Update.php';
    }
    if($_SESSION['path']=="shopUpdate")
    {
        include '/'.VIEWPATH.'Shop_Update.php';
    }
    if($_SESSION['path']=="shopreport")
    {
        include '/'.VIEWPATH.'Reports.php';
    }
    if($_SESSION['path']=="shopinvoice")
    {
        include '/'.VIEWPATH.'invoice.php';
    }
    if($_SESSION['path']=="reportview")
    {
        include '/'.VIEWPATH.'Report_View.php';
    }
    if($_SESSION['path']=="insurancelist")
    {
        include '/'.VIEWPATH.'Insurance_List.php';
    }
    if($_SESSION['path']=="insuranceupdate")
    {
        include '/'.VIEWPATH.'Insurance_Update.php';
    }
    if($_SESSION['path']=="MemberHistory")
    {
        include '/'.VIEWPATH.'Member_History.php';
    }
    if($_SESSION['path']=="ShopHistory")
    {
        include '/'.VIEWPATH.'Shop_History.php';
    }
    if($_SESSION['path']=="shopHistoryUpdate")
    {
        include '/'.VIEWPATH.'Shop_History_Update.php';
    }
    if($_SESSION['path']=="memberhistoryUpdate")
    {
        include '/'.VIEWPATH.'member_History_Update.php';
    }
}
    

    /*
     * if (!isset($_SERVER['PATH_INFO']))
{
    echo "Home page";
    exit();
}
print "The request path is : ".$_SERVER['PATH_INFO'];

     */
?>
  
    
</body>
</html>
 