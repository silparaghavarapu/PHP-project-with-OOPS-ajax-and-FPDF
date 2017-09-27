<?php 
require_once('/config/config.php');
require_once('Controllers/Controller_Insurance.php');
require_once('Models/Model_Insurance.php');
if(isset($_POST['mainpage']))
{
    $_SESSION['path']="mainpage";
    header("Location: ".BASEPATH);
}
if(isset($_POST['logout']) || $_SESSION['username']=="")
{
    session_destroy();
    header("Location: ".BASEPATH);
}

if(isset($_POST['insuranceUpdate']))
{
   
    //Echo the last database record id inserted so that you know the query inserted
    //echo "Last ID Inserted: ".$connect->lastInsertId();
    $obj=new Model_Insurance();
    $obj->UpdateInsurance();
    $_SESSION['path']="mainpage";
    header("Location: ".BASEPATH);
    die();
   
}
if(isset($_POST['insuranceDelete']))
{
    
    //Echo the last database record id inserted so that you know the query inserted
    //echo "Last ID Inserted: ".$connect->lastInsertId();
    $obj=new Model_Insurance();
    $obj->DeleteInsurance();
    $_SESSION['path']="mainpage";
    header("Location: ".BASEPATH);
    die();
}

$getobj=new Controller_Insurance();
$data=$getobj->getInsurnace();

?>
<div class='home'>
    <form method="post">
    
		<table>
			<tr>
				<td><br>
				</td>
			</tr>
    		<tr>
        		<td>
        			<table>
        				<tr>
        					<td>Hello <?php echo $_SESSION['username'];?> !</td>
        					
        					<td><input type="submit" name="mainpage" value="Close" class="small small-primary small-block small-large"></td>
        					<td><input type="submit" name="logout" value="Logout" class="small small-primary small-block small-large"></td>
        				</tr>
        			</table>
        		</td>
        	</tr>
        	<tr>
        		<td><br>
        		</td>
        	</tr>
        	<tr>
        		<td><br>
        		</td>
        	</tr>
        	<tr>
        		<td><br>
        		</td>
        	</tr>
        	<tr>
        		<td><br>
        		</td>
        	</tr>
			<tr>
				<td>
				<?php 
				foreach($data as $datas)
				{
				?>
					<table>
						<tr>
							<td>
					<label class="description" for="element_1">Insurance Name</label>
				</td>
				
				<td>
					<input id="Insurance_name"  class="input1" name="Insurance_name"  value="<?php echo $datas['Insurance_Name'];?>" type="text">
					<input id="Insurance_name1"  class="input1" name="Insurance_name1"  value="<?php echo $datas['Insurance_Name'];?>" type="hidden">
				</td>
			</tr>
			<tr>
				<td>
					<label class="description" for="element_1">Insurance Plan</label>
				</td>
				
				<td>
					<input id="Insurance_plan" class="input1" name="Insurance_plan"  value="<?php echo $datas['insurance_plan'];?>" type="text">
					<input id="Insurance_plan1" class="input1" name="Insurance_plan1"  value="<?php echo $datas['insurance_plan'];?>" type="hidden">
				</td>
			</tr>
			
					</table>
				<?php 
				}
				?>
				</td>
				
			</tr>
			<tr>
				<td><br></td>
			</tr>		
			<tr>
				<td><br></td>
			</tr>
			<tr>
				<td>
					<table>
						<tr >
				<td   align="center">
					<input  class="small small-primary small-block small-large" type="submit" name="insuranceUpdate" value="Update">
				</td>
				<td   align="center">
					<input  class="small small-primary small-block small-large" type="submit" name="insuranceDelete" value="Delete">
				</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
    	
    </form>
    </div>
