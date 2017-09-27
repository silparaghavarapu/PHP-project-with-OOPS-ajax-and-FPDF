<?php 
require_once LIBPATH.'database.php';
if(isset($_POST['mainpage']))
{
    $_SESSION['path']="mainpage";
    header("Location: ".BASEPATH);
}
if(isset($_POST['logout']))
{
    session_destroy();
    header("Location: ".BASEPATH);
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

    

?>

    <form method="post" action="" id="show_list" name="show_list">
    <?php 
			if(isset($_POST['updatevalues']))
			{
			   // echo "update value  ".$_POST['updatevalues'];
			    if($_POST['updatevalues']<>"")
			    {
			        $_SESSION['path']="memberhistoryUpdate";
			        echo $_SESSION['path'];
			        $_SESSION['memberid']=$_POST['updatevalues'];
			           header("Location:".BASEPATH);
			    }
			}
			?>
<table>
<tr>
	<td><br></td>
</tr>
<tr>
<td>
			
			
		<table class="memberlist">
		<tr>
		<td>
		<table>
			<tr>
				<td align="left">
					Hello <?php echo $_SESSION['username'];?> !
				</td>
			</tr>
			<tr>
				<td>
					<!-- page header starts -->
					<table>
						<tr>
							<td>
								<h1>Members List</h1>
							</td>
							<td>
								<input type="hidden" id="updatevalues"  name="updatevalues"><input class="input1" type="text" value="" name="search" id="search"><input type="submit" name="seach_button" id="search_button" value="Search"  class="small small-primary small-block small-large">
							</td>
							<td>
								<table>
									<tr>
										<td>
											<input type="submit" name="mainpage" value="Close"  class="small small-primary small-block small-large">
										</td>
										<td>
											<input type="submit" name="logout" value="Logout"  class="small small-primary small-block small-large">
										</td>
									</tr>
										
									
								</table>
							</td>
						</tr>
						<tr>
							<td>
								
							</td>
							<td>
								<select id="shopbyname" name="shopbyname" onchange="submitdoc()" class="input1">
									<option value="">Select Shop</option>
									<option value="">Show ALL</option>
									<?php 
									require_once CONTROLLERPATH.'Controller_Shop.php';
									$objs=new Controller_Shop();
									$Shop_datas=$objs->showAllShop();
									$select="";
									foreach($Shop_datas as $sdata)
									{
									    if(isset($_POST['shopbyname']))
									    {
									        if($_POST['shopbyname']==$sdata['Shop_ID'])
									            $select="selected";
									        else 
									            $select="";
									    }
									        
									?>
									<option value="<?php echo $sdata['Shop_ID'];?>" <?php echo $select;?>><?php echo $sdata['Shop_Name'];?></option>
									<?php 
									}
									?>
								</select>
								
							</td>
							<td>
							<!-- Multiselect starts -->
								<div class="multiselect">
                                    <div class="selectBox" onclick="showCheckboxes()">
                                      <select class="input1">
                                        <option>Show Or Hide</option>
                                      </select>
                                      <div class="overSelect"></div>
                                    </div>
                                    <div class="checkboxlayer" id="checkboxes">
                                    	<table>
                                    		<tr>
                                    			<td align="left">
                                    				<input type="checkbox" id="First_name"  onclick='display_check("First_name",1)'/>First Name
                                    			</td>
                                    		</tr>
                                    		
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Last_name"  onclick='display_check("Last_name",2)'  />Last Name
                                    			</td>
                                    		</tr>
                                    		<tr>
                                    			<td align="left">
                                    				<input type="checkbox" id="Email_id"  onclick='display_check("Email_id",3)'  />Email Id
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="db"  onclick='display_check("db",4)'  />Date Of Birth
                                    			</td>
                                    		</tr>
                                    		
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="social"  onclick='display_check("social",5)'  />SSN
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Business"  onclick='display_check("Business",6)'  />Business Phone
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Home"  onclick='display_check("Home",7)'  />Home Phone
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Mobile"  onclick='display_check("Mobile",8)' />Mobile Phone
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Address"  onclick='display_check("Address",9)'  />Address
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Shop"  onclick='display_check("Shop",10)'  />Shop Name
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Insurance"  onclick='display_check("Insurance",11)'  />Insurance Name
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    			 	<input type="checkbox" id="Hire_date"  onclick='display_check("Hire_date",12)'  />Hire Date
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Termination"  onclick='display_check("Termination",13)'  />Termination Date
                                    			</td>
                                    		</tr>
                                    		
                                    	</table>
                                      
                                    </div>
                                  </div>
							<!-- Multiselect ends -->
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
    					<label class="description" for="element_1">&nbsp;First&nbsp;Name&nbsp;</label></div>
    				</td>
    				
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;Last&nbsp;Name&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;Email Id&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;Date&nbsp;Of&nbsp;Birth&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;SSN&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;Business Phone&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;Home Phone&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;Mobile Phone&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;Address&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;Shop Name&nbsp;</label></div>
    				</td>
    				<td>
    				<div>
    					<label class="description" for="element_1">&nbsp;Insurance&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;Hire Date&nbsp;</label></div>
    				</td>
    				
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;Termination Date&nbsp;</label></div>
    				</td>
				</tr>
					<?php 
					
					
					
					
    
					require_once CONTROLLERPATH.'Controller_Members_History.php';
					$obj=new Controller_Members_History();
					if(isset($_POST['shopbyname']) || isset($_POST['search']))
					{   
					    if($_POST['shopbyname']=="" AND $_POST['search']=="")
					    {
					        $datas=$obj->showAllMembers($_SESSION['first'],$_SESSION['last']);
					    }
					    elseif($_POST['shopbyname']<>"" AND $_POST['search']=="")
					    {
					    $id=$_POST['shopbyname'];
					    $datas=$obj->getMembersByID($id,$_SESSION['first'],$_SESSION['last']);
					    $_POST['shopbyname']="";
					    }
					    elseif(($_POST['search']<>"" AND $_POST['shopbyname']=="") || ($_POST['search']<>"" AND $_POST['shopbyname']<>""))
					    {
					        $datas=$obj->MembersBySearch($_POST['search']);
					    }
					    elseif($_POST['search']<>"" AND $_POST['shopbyname']<>"")
					    {
					        $datas=$obj->MembersBySearchNShop($_POST['shopbyname'],$_POST['search']);
					    }
					}
					else
					{
					    $datas=$obj->showAllMembers($_SESSION['first'],$_SESSION['last']);
					}
					if($datas<>"")
					{    
					foreach($datas as $data)
					{
					    
					    $count=$data['rowcount'];
					?>
										
				<tr>
					<td>
					<div>
					<input type="submit" onclick="updatevalue(<?php echo $data['id'];?>)" name="Update" value="View / Delete" class="small small-primary small-block small-large"></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['First_Name'];?>&nbsp;</label></div>
    				</td>
    				<td>
    				<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['Last_Name'];?>&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['Email_id'];?>&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['DOB'];?>&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['SSN'];?>&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['Business_Phone'];?>&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['Home_phone'];?>&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['Mobile_phone'];?>&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['Address'].",",$data['City'].",".$data['State'].",".$data['Zip'];?>&nbsp;</label></div>
    				</td>
    				
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['Shop_Name'];?>&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['Insurance_Name'];?>&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['Hire_Date'];?>&nbsp;</label></div>
    				</td>
    				<td>
    					<div>
    					<label class="description" for="element_1">&nbsp;<?php echo $data['Termination_Date'];?>&nbsp;</label></div>
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
    
