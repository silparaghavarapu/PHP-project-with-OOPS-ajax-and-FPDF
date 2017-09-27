<?php 
require_once('/config/config.php');
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

if(isset($_POST['insuranceSubmit']))
{
    require_once('Models/Model_Insurance.php');
    //Echo the last database record id inserted so that you know the query inserted
    //echo "Last ID Inserted: ".$connect->lastInsertId();
    $obj=new Model_Insurance();
    $obj->setInsurance();
   
}
if(isset($_POST['insuranceSaveclose']))
{
    require_once('Models/Model_Insurance.php');
    //Echo the last database record id inserted so that you know the query inserted
    //echo "Last ID Inserted: ".$connect->lastInsertId();
    $obj=new Model_Insurance();
    $obj->setInsurance();
    $_SESSION['path']="mainpage";
    header("Location: ".BASEPATH);
    die();
}
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
					<table>
						<tr>
							<td>
					<label class="description" for="element_1">Insurance Name</label>
				</td>
				
				<td>
					<input id="Insurance_name"  class="input1" name="Insurance_name"  value="" type="text">
				</td>
			</tr>
			<tr>
				<td>
					<label class="description" for="element_1">Insurance Plan</label>
				</td>
				
				<td>
					<input id="Insurance_plan" class="input1" name="Insurance_plan"  value="" type="text">
				</td>
			</tr>
			
					</table>
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
					<input  class="small small-primary small-block small-large" type="submit" name="insuranceSubmit" value="Save">
				</td>
				<td   align="center">
					<input  class="small small-primary small-block small-large" type="submit" name="insuranceSaveclose" value="Save & Close">
				</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
    	
    </form>
    </div>
