<?php 
require_once 'config/config.php';
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
if(isset($_POST['MemberSubmit']))
{
    require_once('Models/Model_Members.php');
    //Echo the last database record id inserted so that you know the query inserted
    //echo "Last ID Inserted: ".$connect->lastInsertId();
    $obj=new Model_Members();
    $obj->setMembers();
    
}
if(isset($_POST['MemberSubmitClose']))
{
    require_once('Models/Model_Members.php');
    //Echo the last database record id inserted so that you know the query inserted
    //echo "Last ID Inserted: ".$connect->lastInsertId();
    $obj=new Model_Members();
    $obj->setMembers();
    $_SESSION['path']="mainpage";
    header("Location: ".BASEPATH);
    die();
}
?>
 <div class="members">	
 <table>
 	<tr>
 		<td>
 			<form method="post" action="">
    			<table>
    				<tr>
    					<td>Hello <?php echo $_SESSION['username'];?> !</td>
    					
    					<td><input type="submit" name="mainpage" value="Close"  class="small small-primary small-block small-large"></td>
    					<td><input type="submit" name="logout" value="Logout"  class="btn btn-primary btn-block btn-large"></td>
    				</tr>
    			</table>
    			</form>
 		</td>
 	</tr>
 	<tr>
 		<td>
 			<form method="post" action="" enctype="multipart/form-data">
 				 <table>
    	<tr>
    		<td>
    		
    		<table border=1>
    		<tr>
    			<td valign="top" style="width:128px;height:128px;" height="50%">
    				<table>
    					<tr>
    						<td>
    							<img src="<?php echo MEMBERSPHOTOS."No_Image.jpg";?>" style="width:128px;height:128px;" name="imageupload" id="imageupload">
    						</td>
    					</tr>
    					<tr>
                			<td>
                				<input class="input1" id="image_upload" name="image_upload" type="file"  onchange="showImage(event)">
                			</td>
            			</tr>	
    				</table>
    				
    			</td>
				<td align="center">
					<table>
						<tr>
							<td align="left">
								<label class="description" for="element_1">First&nbsp;Name</label>								
							</td>
							<td align="left">
								<input class="input1" id="First_name" name="First_name"  value="" type="text"  required="required">
							</td>
							<td align="left">
								<label class="description" for="element_1">Business Phone</label>								
							</td>
							<td align="left">
								<input class="input1" id="Business_phone" name="Business_phone"  value="" type="text">
							</td>
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Last Name</label>								
							</td>
							<td align="left">
								<input class="input1" id="Last_name" name="Last_name"  value="" type="text"  required="required">
							</td>
							<td align="left">
								<label class="description" for="element_1">Home Phone</label>								
							</td>
							<td align="left">
								<input class="input1" id="Home_phone" name="Home_phone"  value="" type="text">
							</td>
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Date&nbsp;Of&nbsp;Birth</label>								
							</td>
							<td align="left">
								<input class="input1" id="DOB" name="DOB"  value="" type="date"  required="required">
							</td>
							<td align="left">
								<label class="description" for="element_1">Mobile Phone</label>								
							</td>
							<td align="left">
								<input class="input1" id="Mobile_phone" name="Mobile_phone"  value="" type="text">
							</td>
							
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Sex</label>								
							</td>
							<td align="left">
								<select name='sex' id='sex'  class="input1" required="required">
									<option label="Male">Male</option>
									<option label="Female">Female</option>
								</select>
							</td>
							<td align="left">
								<label class="description" for="element_1">SSN</label>								
							</td>
							<td align="left">
								<input class="input1" id="Ssn" name="Ssn"  value="" type="text"  required="required">
							</td>
							
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Hire Date</label>								
							</td>
							<td align="left">
								<input class="input1" id="Hire_date" name="Hire_date"  value="" type="date">
							</td>
							<td align="left">
								<label class="description" for="element_1">Termination&nbsp;Date</label>								
							</td>
							<td align="left">
								<input class="input1" id="Termination_date" name="Termination_date"  value="" type="date">
							</td>
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Shop Name</label>								
							</td>
							<td align="left">
								<select name="shop_id" id="shop_id" class="input1"  onchange="showInsurance(this.value)"  required="required">
								<option>Select Shop</option>
								<?php 
                                                  require_once CONTROLLERPATH.'Controller_Shop.php';
                                                  $obj=new Controller_Shop();
                                                  $datas=$obj->showAllShop();
                                                  $i=1;
                                                  foreach ($datas as $data)
                                                  {
                                    ?>
                                                     <option value=<?php echo $data['Shop_ID'];?>><?php echo $data['Shop_Name']?></option>
                                     <?php                                                
                                                  }
                                  
                                  ?>
                                </select>
							</td>
							<td align="left">
								<label class="description" for="element_1">Insurance</label>								
							</td>
							<td align="left">
								<div id="load_insurance">
									<select class="input1">
										<option>Select Insurance</option>
									</select>
								</div>
							</td>
							
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Document</label>								
							</td>
							<td align="left">
								<input class="input1" id="Document" name="Document"  value="Upload a Document" type="file">
							</td>
							<td align="left">
								<label class="description" for="element_1">Email Id</label>								
							</td>
							<td align="left">
								<input class="input1" id="Email_id" name="Email_id"  value="" type="text">
							</td>
							
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Address</label>								
							</td>
							<td align="left">
								<input class="input1" id="Address" name="Address"  value="" type="text"  required="required">
							</td>
							<td rowspan="5" valign="top" align="left">
								<label class="description" for="element_1">Note</label>								
							</td>
							<td rowspan="6" valign="top" align="left">
								<textarea name="note" id="note" rows="10" cols="15" class="input1"></textarea>
							</td>
							
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">City</label>								
							</td>
							<td align="left">
								<input class="input1" id="City" name="City"  value="" type="text"  required="required">
							</td>
							
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">State</label>								
							</td>
							<td align="left">
								<input class="input1" id="State" name="State"  value="" type="text"  required="required">
							</td>
							
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Zip</label>								
							</td>
							<td align="left">
								<input class="input1" id="Zip" name="Zip"  value="" type="text"  required="required">
							</td>
							
						</tr>
					</table>
				</td>
			</tr>	
			
		</table>
 </td>
    	</tr>
    	<tr>
    		<td  align="center">
    		<table>
    			<tr>
    				<td align="center">
    					<input   class="btn btn-primary btn-block btn-large" type="submit" name="MemberSubmit" value="Save">
        				</td>
        				<td  align="center">
        					<input   class="btn btn-primary btn-block btn-large" type="submit" name="MemberSubmitClose" value="Save & Close">
        		
    				</td>
    			</tr>
    		</table>
       		</td>
    	</tr>
    </table>
 				
 			</form>
 		</td>
 	
 	</tr>
 
 </table>
    
   		
    	
   
</div>