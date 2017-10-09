<?php 
require_once 'config/config.php';
require_once LIBPATH.'database.php';
require_once LIBPATH. 'fpdf.php';
require_once (CONTROLLERPATH.'Controller_Members_History.php');
require_once CONTROLLERPATH.'Controller_Transactions.php';


if(isset($_POST['MemberDelete']))
{
    require_once(MODELPATH.'Model_Members.php');
    $obj=new Controller_Members_History();
    $obj->deleteMemberById($_SESSION['memberid']);
    $_SESSION['path']="ShopHistory";
    header("Location: ".BASEPATH);
    die();
}
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
//echo $_SESSION['memberid'];


    $obj=new Controller_Members_History();
    $data=$obj->UpdateMembers();
    

    
    

?>
 	
 <table>
 	<tr>
 		<td align="left">
 			<form method="post" action="">
    			<table>
    				<tr>
    					<td align="left"><h2>Hello <?php echo $_SESSION['username'];?> !</h2></td>
    					
    					<td align="left"><input type="submit" name="mainpage" value="Close"  class="button-close"></td>
    					<td align="left"><input type="submit" name="logout" value="Logout"  class="button-logout"></td>
    				</tr>
    			</table>
    			</form>
 		</td>
 	</tr>
 	<tr>
 		<td align="left">
 			<form method="post" action="" enctype="multipart/form-data">
 			<?php 
 			foreach ($data as $Mdata)
 			{
 			?>
 				 <table>
    	<tr>
    		<td align="left">
    		
    		<table border=1>
    		<tr>
    			<td valign="top" style="width:128px;height:128px;" height="50%">
    				<table>
    					<tr>
    						<td align="left">
    							<?php 
    							//header('Content: image/jpg/png');
    							if($Mdata['photo_path']<>"")
    							{
    							echo '<img src="data:image/jpeg;base64,'.base64_encode( $Mdata['photo_path'] ).'" style="width:128px;height:128px; " name="imageupload" id="imageupload" />';
    							}
    							else
    							{
    							?>
    							<img src="<?php echo MEMBERSPHOTOS."No_Image.jpg";?>" style="width:128px;height:128px;" name="imageupload" id="imageupload">
    							<?php 
    							}
    							?>
    						</td>
    					</tr>
    					<tr>
                			<td align="left">
                				<input class="input1" id="image_upload" name="image_upload" type="file"  onchange="showImage(event)">
                			</td>
            			</tr>	
    				</table>
    				
    			</td>
				<td align="left">
					<table>
						<tr>
							<td align="left">
								<label class="description" for="element_1">First&nbsp;Name</label>								
							</td>
							<td align="left">
								<input class="input1" id="First_name" name="First_name"  value="<?php echo $Mdata['First_Name'];?>"type="text" readonly  required="required">
								<input class="input1" id="First_name1" name="First_name1"  value="<?php echo $Mdata['First_Name'];?>" type="hidden">
							</td>
							<td align="left">
								<label class="description" for="element_1">Business Phone</label>								
							</td>
							<td align="left">
								<input class="input1" id="Business_phone" name="Business_phone"  value="<?php echo $Mdata['Business_Phone'];?>"type="text" readonly>
								<input class="input1" id="Business_phone1" name="Business_phone1"  value="<?php echo $Mdata['Business_Phone'];?>" type="hidden">
							</td>
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Last Name</label>								
							</td>
							<td align="left">
								<input class="input1" id="Last_name" name="Last_name"  value="<?php echo $Mdata['Last_Name'];?>"type="text" readonly  required="required">
								<input class="input1" id="Last_name1" name="Last_name1"  value="<?php echo $Mdata['Last_Name'];?>" type="hidden">
							</td>
							<td align="left">
								<label class="description" for="element_1">Home Phone</label>								
							</td>
							<td align="left">
								<input class="input1" id="Home_phone" name="Home_phone"  value="<?php echo $Mdata['Home_phone'];?>"type="text" readonly>
								<input class="input1" id="Home_phone1" name="Home_phone1"  value="<?php echo $Mdata['Home_phone'];?>" type="hidden">
							</td>
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Date&nbsp;Of&nbsp;Birth</label>								
							</td>
							<td align="left">
								<input class="input1" id="DOB" name="DOB"  value="<?php echo $Mdata['DOB'];?>" type="date"  required="required">
								<input class="input1" id="DOB1" name="DOB1"  value="<?php echo $Mdata['DOB'];?>" type="hidden">
							</td>
							<td align="left">
								<label class="description" for="element_1">Mobile Phone</label>								
							</td>
							<td align="left">
								<input class="input1" id="Mobile_phone" name="Mobile_phone"  value="<?php echo $Mdata['Mobile_phone'];?>"type="text" readonly>
								<input class="input1" id="Mobile_phone1" name="Mobile_phone1"  value="<?php echo $Mdata['Mobile_phone'];?>" type="hidden">
							</td>
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">SSN</label>								
							</td>
							<td align="left">
								<input class="input1" id="Ssn" name="Ssn"  value="<?php echo $Mdata['SSN'];?>"type="text" readonly  required="required">
								<input class="input1" id="Ssn1" name="Ssn1"  value="<?php echo $Mdata['SSN'];?>" type="hidden">
							</td>
							<td align="left">
								<label class="description" for="element_1">Sex</label>								
							</td>
							<td align="left">
							
								<select name='sex' id='sex'  class="input1" required="required" disabled="true">
								<?php 
								$m="";
								$f="";
								if($Mdata['sex']=="Male")
								   $m="selected";
 			                    if($Mdata['sex']=="Female")
 			                       $f="selected";
 			                    
 			                    ?>
									<option label="Male" <?php echo $m;?>>Male</option>
									<option label="Female" <?php echo $f;?>>Female</option>
								</select>
								<input class="input1" id="sex1" name="sex1"  value="<?php echo $Mdata['sex'];?>" type="hidden">
							</td>
							
						</tr>
						<tr>
							
							<td align="left">
								<label class="description" for="element_1">Hire Date</label>								
							</td>
							<td align="left">
								<input class="input1" id="Hire_date" name="Hire_date"  value="<?php echo $Mdata['Hire_Date'];?>" type="date" readonly>
								<input class="input1" id="Hire_date1" name="Hire_date1"  value="<?php echo $Mdata['Hire_Date'];?>" type="hidden">
							</td>
							<td align="left">
								<label class="description" for="element_1">Termination&nbsp;Date</label>								
							</td>
							<td align="left">
								<input class="input1" id="Termination_date" name="Termination_date"  value="<?php echo $Mdata['Termination_Date'];?>" type="date" readonly>
								<input class="input1" id="Termination_date1" name="Termination_date1"  value="<?php echo $Mdata['Termination_Date'];?>" type="hidden">
							</td>
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Shop Name</label>								
							</td>
							<td align="left">
																
								<?php 
                                                  require_once CONTROLLERPATH.'Controller_Shop.php';
                                                  $obj=new Controller_Shop();
                                                  $datas=$obj->showAllShop();
                                                  $i=1;
                                                  foreach ($datas as $data)
                                                  {
                                   
                                                     if($Mdata['Shop_ID']==$data['Shop_ID'])
                                                          echo $data['Shop_Name'];
                                                                                   
                                                  }
                                  
                                  ?>
                                
							</td>
							<td align="left">
								<label class="description" for="element_1">Insurance</label>								
							</td>
							<td align="left">
								
									<select name="insurance_id" id="insurance_id" class="input1" disabled="true">
										<option>Select Insurance</option>
										<?php 
										$obj_transac=new Controller_Transactions();
                                                  $datas=$obj_transac->getTransactions($Mdata['Shop_ID']);
                                                  
                                                  foreach ($datas as $data)
                                                  {
                                                      if($Mdata['Insurance_ID']==$data['Insurance_ID'])
                                                          $select="selected";
                                                      else
                                                          $select="";
                                                      ?>
                                                    <option value=<?php echo $data['Insurance_ID'];?> <?php echo $select;?>><?php echo $data['Insurance_Name']?></option>
                                                <?php                                                
                                                         }
                                                ?>

									</select>
									<input class="input1" id="insurance_id1" name="insurance_id1"  value="<?php echo $Mdata['Insurance_ID'];?>" type="hidden">								
							</td>
							
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Document</label>								
							</td>
							<td align="left">
								<div>
								<?php 
								    if($Mdata['Attachment_path']<>"")
								    {
								//echo "data: ".$Mdata['Attachment_type']. $Mdata['Attachment_path'];
								?>
								</div>
								<!-- a href=# onclick="runDoc('<?php// echo BASEPATH.$Mdata['Attachment_path']?>'); return false;">View Document</a-->
								<a href='<?php echo $Mdata['Attachment_path']?>' target="_blank">View Doc</a>
								<?php 
								    }
								?>
								<input class="input1" id="Document" name="Document"  value="Upload a Document" type="file">
							</td>
							<td align="left">
								<label class="description" for="element_1">Email Id</label>								
							</td>
							<td align="left">
								<input class="input1" id="Email_id" name="Email_id"  value="<?php echo $Mdata['Email_id'];?>"type="text" readonly>
								<input class="input1" id="Email_id1" name="Email_id1"  value="<?php echo $Mdata['Email_id'];?>" type="hidden">
							</td>
							
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Address</label>								
							</td>
							<td align="left">
								<textarea class="input1" id="Address" name="Address" required="required" cols=2 rows=2 readonly><?php echo $Mdata['Address'];?></textarea>
								<input class="input1" id="Address1" name="Address1"  value="<?php echo $Mdata['Address'];?>" type="hidden">
							</td>
							<td rowspan="5" valign="top">
								<label class="description" for="element_1">Note</label>								
							</td>
							<td rowspan="5" valign="top">
								<textarea name="note" id="note" rows="10" cols="15" class="input1" readonly><?php echo $Mdata['Note']?></textarea>
								<input class="input1" id="note1" name="note1"  value="<?php echo $Mdata['Note'];?>" type="hidden">
							</td>
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">City</label>								
							</td>
							<td align="left">
								<input class="input1" id="City" name="City"  value="<?php echo $Mdata['City'];?>"type="text" readonly  required="required">
								<input class="input1" id="City1" name="City1"  value="<?php echo $Mdata['City'];?>" type="hidden">
							</td>
							
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">State</label>								
							</td>
							<td align="left">
								<input class="input1" id="State" name="State"  value="<?php echo $Mdata['State'];?>"type="text" readonly  required="required">
								<input class="input1" id="State1" name="State1"  value="<?php echo $Mdata['State'];?>" type="hidden">
							</td>
							
						</tr>
						<tr>
							<td align="left">
								<label class="description" for="element_1">Zip</label>								
							</td>
							<td align="left">
								<input class="input1" id="Zip" name="Zip"  value="<?php echo $Mdata['Zip'];?>"type="text" readonly  required="required">
								<input class="input1" id="Zip1" name="Zip1"  value="<?php echo $Mdata['Zip'];?>" type="hidden">
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
        				
        				<td  align="center"><input type="submit" name="MemberDelete" value="Delete"  class="button-save"></td>
        			</tr>			
        		</table>
        	</td>
        	
    	</tr>
    </table>
    <?php 
 			}    
    ?>
 				
 			</form>
 		</td>
 	
 	</tr>
 
 </table>
    
   		
    	
   
</div>