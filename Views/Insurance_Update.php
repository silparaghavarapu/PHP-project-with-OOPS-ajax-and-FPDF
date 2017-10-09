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
   
    $obj=new Model_Insurance();
    $obj->getUpdateInsurance();
    $_SESSION['path']="mainpage";
    header("Location: ".BASEPATH);
    die();
   
}

$getobj=new Controller_Insurance();
$data=$getobj->getInsurnace();

?>

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
        					<td align="left"><h2>Hello <?php echo $_SESSION['username'];?> !</h2></td>
        					
        					<td><input type="submit" name="mainpage" value="Close" class="button-close"></td>
        					<td><input type="submit" name="logout" value="Logout" class="button-logout"></td>
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
					<label class="fontstyles1" for="element_1">Insurance Name</label>
				</td>
				
				<td>
					<input id="Insurance_name"  class="input1" name="Insurance_name"  value="<?php echo $datas['Insurance_Name'];?>" type="text">
					<input id="Insurance_name1"  class="input1" name="Insurance_name1"  value="<?php echo $datas['Insurance_Name'];?>" type="hidden">
				</td>
			</tr>
			<tr>
				<td>
					<label class="fontstyles1" for="element_1">Insurance Plan</label>
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
					<input  class="button-save" type="submit" name="insuranceUpdate" value="Update">
				</td>
				<!-- td   align="center">
					<input  class="small small-primary small-block small-large" type="submit" name="insuranceDelete" value="Delete">
				</td-->
						</tr>
					</table>
				</td>
			</tr>
		</table>
    	
    </form>
    
