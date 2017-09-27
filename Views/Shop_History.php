<?php 
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
    <form method="post" name="show_list" id="show_list" action="">
    <?php 
			if(isset($_POST['updatevalues']))
			{
			   // echo "update value  ".$_POST['updatevalues'];
			    if($_POST['updatevalues']<>"")
			    {
			        $_SESSION['path']="shopHistoryUpdate";
			        echo $_SESSION['path'];
			        $_SESSION['shopid']=$_POST['updatevalues'];
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
	
		<table  class="memberlist">
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
								<h1>Shops History Lists</h1>
							</td>
							<td>
								<input type="hidden" id="updatevalues"  name="updatevalues">
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
								<select id="shopbyname" name="shopbyname" class="input1"  onchange="submitdoc()">
									<option value="">Select Shop</option>
									<option value="">Show ALL</option>
									<?php 
									require_once CONTROLLERPATH.'Controller_Shop_History.php';
									$objs=new Controller_Shop_History();
									$Shop_datas=$objs->showAllShop();
									$select="";
									foreach($Shop_datas as $sdata)
									{
									    if(isset($_POST['shopbyname']))
									    {
									        if($sdata['Shop_ID']==$_POST['shopbyname'])
									            $select="Selected";
									        else
									            $select="";
									    }
									?>
									<option value="<?php echo $sdata['Shop_ID']?>" <?php echo $select;?>><?php echo $sdata['Shop_Name']?></option>
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
                                        <option>Show / Hide</option>
                                      </select>
                                      <div class="overSelect"></div>
                                    </div>
                                    <div class="checkboxlayer" id="checkboxes">
                                    	<table>
                                    		<tr>
                                    			<td align="left">
                                    				<input type="checkbox" id="Shop_name"  onclick='display_check("Shop_name",1)'/>Shop Name
                                    			</td>
                                    		</tr>
                                    		<tr>
                                    			<td align="left">
                                    				<input type="checkbox" id="Contact"  onclick='display_check("Contact",2)' />Contact
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Job_title"  onclick='display_check("Job_title",3)'  />Job Title
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Phone"  onclick='display_check("Phone",4)'  />Phone
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Email"  onclick='display_check("Email",5)'  />Email
                                    			</td>
                                    		</tr>
                                    		<tr>
                                    			<td align="left">
                                    				<input type="checkbox" id="Fax"  onclick='display_check("Fax",6)'  />Fax
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Address"  onclick='display_check("Address",7)'  />Address
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="URL"  onclick='display_check("URL",8)'  />URL
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Contract_start"  onclick='display_check("Contract_start",9)'  />Contract Start
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Contract_end"  onclick='display_check("Contract_end",10)'  />Contract End
                                    			</td>
                                    		</tr>
                                    		<tr>	
                                    			<td align="left">
                                    				<input type="checkbox" id="Contract_active"  onclick='display_check("Contract_active",11)' />Contract Active
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
					<table border="1" id="showhidecolumns">
						<tr>
						<td>
							<label class="description" for="element_1" ><b>View&nbsp;Delete</b></label>
        				</td>
						<td>
							<label class="description" for="element_1" ><b>&nbsp;Shop&nbsp;Name&nbsp;</b></label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1"><b>&nbsp;Contact&nbsp;</b></label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1"><b>&nbsp;Job&nbsp;Title&nbsp;</b></label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1"><b>&nbsp;Phone&nbsp;</b></label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1"><b>&nbsp;Email&nbsp;</b></label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1"><b>&nbsp;Fax&nbsp;</b></label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1"><b>&nbsp;Address&nbsp;</b></label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1"><b>&nbsp;URL&nbsp;</b></label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1"><b>&nbsp;Contract&nbsp;Start&nbsp;</b></label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1"><b>&nbsp;Contract&nbsp;End&nbsp;</b></label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1"><b>&nbsp;Contract&nbsp;Active&nbsp;</b></label>
        				</td>
						</tr>
						<?php 
        					
        					$obj=new Controller_Shop_History();
        					if(isset($_POST['shopbyname']))
        					{
        					    
        					    if($_POST['shopbyname']==""){
        					        $datas=$obj->showAllShops($_SESSION['first'],$_SESSION['last']);
        					    }
        					    elseif($_POST['shopbyname']<>"")
        					    {
        					        $id=$_POST['shopbyname'];
        					        $datas=$obj->ShopByID($id,$_SESSION['first'],$_SESSION['last']);
        					        $_POST['shopbyname']="";
        					    }
        					    
        					}
        					else
        					{
        					    $datas=$obj->showAllShops($_SESSION['first'],$_SESSION['last']);
        					}
        					if($datas<>"")
        					{  
        					foreach($datas as $data)
        					{
        					    $count=$data['rowcount'];
        				?>
        				<tr>
						<td>
							<input type="submit" onclick="updatevalue(<?php echo $data['id'];?>)" name="View / Delete" value="View / Delete"  class="small small-primary small-block small-large">
        				</td>
        				<td>
							<label class="description" for="element_1" ><?php echo $data['Shop_Name'];?></label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1">&nbsp;<?php echo $data['Primary_Contact'];
        					   if($data['Secondary_Contact']<>"") echo "/<br>".$data['Secondary_Contact'];
        					
        					?>&nbsp;</label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1">&nbsp;<?php echo $data['Job_Title'];?>&nbsp;</label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1">&nbsp;<?php echo $data['Primary_Phone'];
        					   if($data['Secondary_Phone']<>"") echo "/<br>". $data['Secondary_Phone']
        					?>&nbsp;</label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1">&nbsp;<?php echo $data['Primary_Email'];
        					   if($data['Secondary_Email']<>"") echo "/<br>". $data['Secondary_Email']
        					?>&nbsp;</label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1">&nbsp;<?php echo $data['Fax'];?>&nbsp;</label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1">&nbsp;<?php
        					echo $data['Primary_Address'].",".$data['Primary_City'].",".$data['Primary_State'].",".$data['Primary_zip'];
        					if($data['Secondary_Address']<>"")
        					echo "/<br>".$data['Secondary_Address'];
        					?>&nbsp;</label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1">&nbsp;<?php echo $data['Company_URL'];?>&nbsp;</label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1">&nbsp;<?php echo $data['Contract_Start_Date'];?>&nbsp;</label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1">&nbsp;<?php echo $data['Contract_End_Date'];?>&nbsp;</label>
        				</td>
        				<td>
        					
        					<label class="description" for="element_1">&nbsp;<?php if ($data['Contract_Active']==1)
        					    echo "Yes"; 
        					else 
        					    echo "No";?>&nbsp;</label>
        				</td>
						</tr>
						<?php 
        				}
        					}
						?>
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
