<select name="insurance_id" id="insurance_id" class="input1">
	<option>Select Insurance</option>
<?php
require_once "../Controllers/Controller_Transaction.php";
require_once "../config/config.php";
$obj=new Controller_Transaction();
$id=$_GET['sid'];
$datas=$obj->showAllTransaction($id);
//echo $datas;
foreach ($datas as $data)
{
    ?>
    <option value=<?php echo $data['Insurance_ID'];?> ><?php echo $data['Insurance_Name']."  ".$data['insurance_plan'];?></option>
<?php                                                
 }
?>
</select>
