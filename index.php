
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Speciality Trade Union</title>
  
 
</head>
<link rel="stylesheet" href="public/css/style.css">
  <script src="public/js/index.js"></script>
  <?php 
  session_start();
  $clss="";
  if(isset($_SESSION['path']))
    {
        if($_SESSION['path']=="login" || $_SESSION['path']=="signup")
        $clss="class='body2'";
        else 
        $clss="";
    }
    else 
    {
        $clss="class='body2'";
    }
    require 'config/config.php';
    
  ?>

<body <?php echo $clss;?>>
<table>
	<tr>
		<td>
			<table style="width:50%;" align="center">
			<tr><td><img src="public/Local741_logo.png" width="80" height="80"></td>
			<td><h1 style="color:#BA1419;">SPECIALITY TRADES UNION LTD.</h1></td></tr></table>
			
		</td>
	</tr>
	<tr>
		<td>
		<?php


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
    if($_SESSION['path']=="insurancehistory")
    {
        include '/'.VIEWPATH.'Insurance_History.php';
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
  
    </td>
	</tr>

</table>
    
</body>
</html>
 