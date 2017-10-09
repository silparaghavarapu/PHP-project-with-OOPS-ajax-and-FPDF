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


if(isset($_POST['Prev']) || isset($_POST['Next']))
{
    if(isset($_POST['Prev']))
    {
        $_SESSION['first']=$_SESSION['first']-5;
        $_SESSION['last']=5;
        $count=0;
        $_SESSION['start']=$_SESSION['start']-1;
    }
    elseif (isset($_POST['Next']))
    {
        $_SESSION['first']=$_SESSION['first']+5;
        $_SESSION['last']=5;
        $count=0;
        $_SESSION['start']=$_SESSION['start']+1;
    }
    
}
else
{
    $_SESSION['first']=0;
    $_SESSION['last']=5;
    $count=0;
    $_SESSION['start']=1;
}

if($_SESSION['first']<0)
{
    $_SESSION['first']=0;
    $_SESSION['last']=5;
    $count=0;
    $_SESSION['start']=1;
}

?>

    <form method="post">
     <?php 
			if(isset($_POST['updatevalues']))
			{
			   // echo "update value  ".$_POST['updatevalues'];
			    if($_POST['updatevalues']<>"")
			    {
			        $_SESSION['path']="insuranceupdate";
			        echo $_SESSION['path'];
			        $_SESSION['insuranceid']=$_POST['updatevalues'];
			           header("Location:".BASEPATH);
			    }
			}
			?>
    
		<table>
			
    		<tr>
        		<td>
        			<table>
        				<tr>
        					<td align="left"><h2>Hello <?php echo $_SESSION['username'];?> !</h2><input type="hidden" id="updatevalues"  name="updatevalues"></td>
        					
        					<td><input type="submit" name="mainpage" value="Close" class="button-close"></td>
        					<td><input type="submit" name="logout" value="Logout" class="button-logout"></td>
        				</tr>
        			</table>
        		</td>
        	</tr>
        	
			<tr>
				<td>
					<fieldset>
                       <legend>Add Insurance</legend>
					<table>
						<tr>
							<td>
					<label class="fontstyles1" for="element_1">Insurance Name</label>
				</td>
				
				<td>
					<input id="Insurance_name"  class="input1" name="Insurance_name"  value="" type="text">
				</td>
			
				<td>
					<label class="fontstyles1" for="element_1">Insurance Plan</label>
				</td>
				
				<td>
					<input id="Insurance_plan" class="input1" name="Insurance_plan"  value="" type="text">
				</td>
				<td   align="center">
					<input  class="button-save" type="submit" name="insuranceSubmit" value="Save">
				
				</td>
			</tr>
			
					</table>
				</fieldset>	
				</td>
				
			</tr>
			<tr>
				<td>
					<table>
		<tr>
		<td>
		<table>
			
			<tr>
				<td>
					<!-- page header starts -->
					<table>
						<tr>
							
							<td>
								<h1>Insurance List</h1>
							</td>
						
							
							<td>
								<select id="shopbyname" name="shopbyname" onchange="submitdoc()" class="input1">
									<option value="">Select Insurance</option>
									<option value="">Show ALL</option>
									<?php 
									require_once CONTROLLERPATH.'Controller_Insurance.php';
									$objs=new Controller_Insurance();
									$Shop_datas=$objs->showAllInsurances();
									$select="";
									foreach($Shop_datas as $sdata)
									{
									    if(isset($_POST['shopbyname']))
									    {
									        if($_POST['shopbyname']==$sdata['Insurance_ID'])
									            $select="selected";
									        else 
									            $select="";
									    }
									        
									?>
									<option value="<?php echo $sdata['Insurance_ID'];?>" <?php echo $select;?>><?php echo $sdata['Insurance_Name']."  ".$sdata['insurance_plan'];?></option>
									<?php 
									}
									?>
								</select>
								
							</td>
							
							
						</tr>
					</table>
					<!-- page header ends -->
				</td>
			</tr>
			
			<tr>
				<td>
					<table id="showhidecolumns" border="1">
					<tr>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;Open&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;Insurance&nbsp;Name&nbsp;</label></div>
    				</td>
    				
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;Insurance&nbsp;Plan&nbsp;</label></div>
    				</td>
    				
				</tr>
					<?php 
					
					
					
					
    
					require_once CONTROLLERPATH.'Controller_Insurance.php';
					$obj=new Controller_Insurance();
					if(isset($_POST['shopbyname']) || isset($_POST['search']))
					{   
					    if($_POST['shopbyname']=="")
					    {
					        $datas=$obj->showAllInsurance($_SESSION['first'],$_SESSION['last']);
					    }
					    elseif($_POST['shopbyname']<>"")
					    {
					    $id=$_POST['shopbyname'];
					    $datas=$obj->getInsuranceByID($id,$_SESSION['first'],$_SESSION['last']);
					    $_POST['shopbyname']="";
					    }
					   
					}
					else
					{
					    $datas=$obj->showAllInsurance($_SESSION['first'],$_SESSION['last']);
					}
					if($datas<>"")
					{    
					foreach($datas as $data)
					{
					    
					    $count=$data['rowcount'];
					?>
										
				<tr>
					<td align="center">
					<div>
					<input type="submit" onclick="updatevalue(<?php echo $data['Insurance_ID'];?>)" name="Update" value="Update" class="button-update"></div>
    				</td>
    				<td align="left">
    					<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['Insurance_Name'];?>&nbsp;</label></div>
    				</td>
    				<td align="left">
    				<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['insurance_plan'];?>&nbsp;</label></div>
    				</td>
    								</tr>
				<?php
					}
					}
				?>
				</table>
				
				</td>
			</tr>
			
				
		</table>
    	</td>
    	</tr>
    	<tr>
    		<td>
    			<?php 
    			
    			$pagecount=ceil($count/5);
    			
    			
    			?>
    			<table>
    				<tr>
    					<td><?php if($_SESSION['first']>0){?><input type="submit"  name="Prev" value="<<"  class="small small-primary small-block small-large"><?php } else { echo "<<";}?></td><td><?php if($pagecount<>0) echo $_SESSION['start']. "  of  ".$pagecount;?></td><td><?php if($_SESSION['start']<$pagecount){?><input type="submit"  name="Next" value=">>" class="small small-primary small-block small-large"><?php } else { echo ">>";}?></td>
    				</tr>
    				
    			</table>
    		</td>
    	</tr>
    	</table>
				</td>
			</tr>
			
		</table>
    	
    </form>
   
