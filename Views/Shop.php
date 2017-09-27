<?php 
require_once LIBPATH.'database.php';
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
if(isset($_POST['ShopSubmit']))
{
    require_once('Models/Model_Shop.php');
    //Echo the last database record id inserted so that you know the query inserted
    //echo "Last ID Inserted: ".$connect->lastInsertId();
    $obj=new Model_Shop();
    $obj->setShop();
    
}
if(isset($_POST['ShopSubmitClose']))
{
    require_once('Models/Model_Shop.php');
    //Echo the last database record id inserted so that you know the query inserted
    //echo "Last ID Inserted: ".$connect->lastInsertId();
    $obj=new Model_Shop();
    $obj->setShop();
    $_SESSION['path']="mainpage";
    header("Location: ".BASEPATH);
    die();
}

?>
 <div class="shop">	
    
    <table>
    	<tr>
    		<td>
    			<form method="post" action="" enctype="multipart/form-data">
    			<table>
    				<tr>
    					<td>Hello <?php echo $_SESSION['username'];?> !</td>
    					
    					<td><input type="submit"  class="small small-primary small-block small-large" name="mainpage" value="Close"></td>
    					<td><input type="submit"  class="small small-primary small-block small-large" name="logout" value="Logout"></td>
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
        				<td colspan=2  align="left">
        				<table>
        					<tr>
                				<td align="left">
                					<label class="fontstyles1" for="element_1">Shop Name &nbsp;&nbsp;</label>
                				</td>
                				
                				<td align="left">
                					&nbsp;&nbsp;<input id="Shop_name" name="Shop_name"  class="input1" value="" type="text"  required="required">
                				</td>
                				<td align="left"><label class="fontstyles1" for="element_1">Website</label></td>
                                <td align="left"><input id="url" name="url"  value="" type="text" class="input1"></td>
                			</tr>
        				</table>
        				</td>
        			</tr>
        			
        			<tr>
        				<td  align="left">
        					<!-- Address table starts -->
        						<table>
        							<tr>
        								<td align="left">
        									<fieldset>
                                              <legend>Address Details</legend>
                                              <table>
                                              	  <tr>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">Address</label></td>
                                              	  	<td><textarea id="Primary_address" name="Primary_address"  class="input1" cols=2 rows=2 required="required"></textarea></td>
                                              	  </tr>
                                                  <tr>
                                                  	<td align="left"><label class="fontstyles1" for="element_1">City</label></td>
                                                  	<td><input id="Primary_city" name="Primary_city" class="input1"  value="" type="text" required="required"></td>
                                                  </tr>
                                              	  <tr>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">State</label></td>
                                              	  	<td><input id="Primary_State" name="Primary_State" class="input1"  value="" type="text" required="required"></td>
                                              	  </tr>
                                              	  <tr>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">Zip</label></td>
                                              	  	<td><input id="Primary_zip" name="Primary_zip"  class="input1" value="" type="text" required="required"></td>
                                              	  </tr>
                                              	  <tr>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">Secondary&nbsp;Address</label></td>
                                              	  	<td><textarea id="Secondary_address" name="Secondary_address"  class="input1"  cols="2" rows="2"></textarea></td>
                                              	  </tr>
                                              	  
                                              	 </table>
                                            </fieldset>
        								</td>
        							</tr>
        						</table>
        					
        					<!-- Address table ends -->
        				</td>
        				
        				<td align="left">
        					<!-- Contact details starts  -->
        						<fieldset>
                                              <legend>Contact Details</legend>
                                              <table>
                                              	  <tr>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">Primary Contact</label></td>
                                              	  	<td><input id="Primary_contact" name="Primary_contact"  value="" type="text" class="input1" required="required"></td>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">Secondary Contact</label></td>
                                              	  	<td><input id="Secondary_contact" name="Secondary_contact"  value="" type="text" class="input1"></td>
                                              	  	
                                              	  </tr>
                                                  <tr>
                                                  	<td align="left"><label class="fontstyles1" for="element_1">Primary Phone</label></td>
                                                  	<td><input id="Primary_phone" name="Primary_phone"  value="" type="text" class="input1" required="required"></td>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">Secondary Phone</label></td>
                                                  	<td><input id="Secondary_phone" name="Secondary_phone"  value="" type="text"  class="input1"></td>
                                                  </tr>
                                                  <tr>
                                                  	<td align="left"><label class="fontstyles1" for="element_1">Primary Phone(extensions)</label></td>
                                                  	<td><input id="Primary_note" name="Primary_note"  value="" type="text" class="input1">
                                                  	</td>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">Secondary Phone(extensions)</label></td>
                                                  	<td><input id="Secondary_note" name="Secondary_note"  value="" type="text"  class="input1">
                                                  	</td>
                                                  </tr>
                                              	  <tr>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">Primary Email_Id</label></td>
                                              	  	<td><input id="Primary_email" name="Primary_email"  value="" type="text"  class="input1"></td>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">Secondary Email_Id</label></td>
                                              	  	<td><input id="Secondary_email" name="Secondary_email"  value="" type="text"  class="input1"></td>
                                              	  	
                                              	  	
                                              	  </tr>
                                              	  <tr>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">Fax</label></td>
                                              	  	<td><input id="Fax" name="Fax"  value="" type="text"  class="input1"></td>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">Job Title</label></td>
                                              	  	<td><input id="Job_title" name="Job_title"  value="" type="text" class="input1"></td>
                                              	  	
                                              	  </tr>
                                              	 
                                              	  
                                              	 </table>
                                            </fieldset>
        					<!-- Contact detials ends  -->
        					        					
        				</td>
        			</tr>
        			<!-- Contrat detials starts -->
        			<tr>
        				<td align="left">
        					<fieldset>
                            <legend>Contract</legend>
        					<table>
                            	<tr>
                                	<td align="left"><label class="fontstyles1" for="element_1">Contract Start Date</label></td>
                                    <td align="left"><input id="Contract_start" name="Contract_start"  value="" type="date" class="input1"></td>
                                    
                                </tr>
                                <tr>
                                	<td align="left"><label class="fontstyles1" for="element_1">Contract End Date</label></td>
                                    <td align="left"><input id="Contract_end" name="Contract_end"  value="" type="date" class="input1"></td>
                                </tr>
                                <tr>
               				        <td align="left"><label class="fontstyles1" for="element_1">Contract Document</label></td>
                                    <td align="left"><input id="Contract_document" name="Contract_document" type="file" class="input1" onchange="checksize(event)"></td>
                                 </tr>
                                <tr>   
                                    <td align="left"><label class="fontstyles1" for="element_1">Contract Active</label></td>
                                   	<td><input id="Contract_active" name="Contract_active"  type="checkbox"></td>
                                              	 
                                </tr>
                                <tr>
                                              	  	<td><br><br></td>
                                              	  </tr>
                             </table>
                        	</fieldset>
        				</td>
        				<td>
        					
        					<!-- Insurance table starts -->
        						<table>
        							<tr>
        								<td align="left">
        									<fieldset>
                                              <legend>Select Insurance</legend>
                                              	<div class="my-overflow">
                                              <table>
                                              		<tr>
                                              	  		<td align="left">
                                              	  			  <label class="fontstyles1" for="element_1">Select</label>                                                    	
                                                          </td>
                                                          <td>
                                                          	<label class="fontstyles1" for="element_1" >&nbsp;Insurance&nbsp;Name&nbsp;&nbsp;</label>
                                                          </td>
                                                          <td>
                                                          	<label class="fontstyles1" for="element_1" >Plan</label>
                                                          </td>
                                                          <td>
                                                          	<label class="fontstyles1" for="element_1">Insurance&nbsp;Amount</label>
                                                          </td>
                                                          <td>
                                                          	<label class="fontstyles1" for="element_1">Due&nbsp;Amount</label>
                                                          </td>
                                                          <td>
                                                          	<label class="fontstyles1" for="element_1">Initiation</label>
                                                          </td>	
                                                          <td>
                                                          	<label class="fontstyles1" for="element_1">Premium</label>
                                                          </td>
                                                          <td>
                                                          	<label class="fontstyles1" for="element_1">Jiff&nbsp;Fund</label>
                                                          </td>
                                                      </tr>
                                                  <?php 
                                                  require_once CONTROLLERPATH.'Controller_Insurance.php';
                                                  $obj=new Controller_Insurance();
                                                  $datas=$obj->showAllInsurances();
                                                  $i=1;
                                                  foreach ($datas as $data)
                                                  {
                                                      
                                                      ?>
                                                      <tr>
                                              	  		<td align="left">
                                              	  			<input type="checkbox" name="<?php echo"insurance".$i; ?>">
                                              	  			<input type="hidden" value="<?php echo $data['Insurance_ID']; ?>" name="<?php echo "insurance_".$i; ?>">
                                              	  			
                                                      	
                                                          </td>
                                                          <td>
                                                          	<label class="fontstyles1" for="element_1" >&nbsp;<?php echo $data['Insurance_Name']; ?>&nbsp;&nbsp;</label>
                                                          </td>
                                                          <td>
                                                          	<label class="fontstyles1" for="element_1" ><?php echo $data['insurance_plan']; ?></label>
                                                          </td>
                                                          <td>
                                                          	<input type="text" name="<?php echo "Ins_amount_".$i; ?>" class="input2"  placeholder="Insurance Amount">
                                                          </td>
                                                          <td>
                                                          	<input type="text" name="<?php echo "due_amount_".$i; ?>" class="input2"  placeholder="Due Amount">
                                                          </td>
                                                          <td>
                                                          	<input type="text" name="<?php echo "Initiation_".$i; ?>" class="input2" placeholder="Initiation Amount">
                                                          </td>	
                                                          <td>
                                                          	<input type="text" name="<?php echo "Mdeical_".$i; ?>" class="input2" placeholder="Medical Premium">
                                                          </td>
                                                          <td>
                                                          	<input type="text" name="<?php echo "Jif_".$i; ?>" class="input2" placeholder="Jif Fund">
                                                          </td>
                                                      </tr>
                                                      <?php 
                                                      $i=$i+1;
                                                  }
                                                  ?>
                                                  	
                                              	  
                                              	 </table>
                                              	 </div>
                                            </fieldset>
        								</td>
        							</tr>
        						</table>
        					
        					<!-- Insurance table ends -->
        					
        				</td>
        			</tr>
        			<!-- Contrat detials ends  -->
        			<tr >
        				<td colspan="2"  align="center">
        			<input id="i_values" name="i_values"  class="input1"  value="<?php echo $i; ?>" type="hidden">
        				</td>
        			</tr>	
        			<tr >
        				<td  align="center">
        					<input  class="small small-primary small-block small-large" type="submit" name="ShopSubmit" value="Save">
        				</td>
        				<td  align="center">
        					<input  class="small small-primary small-block small-large" type="submit" name="ShopSubmitClose" value="Save & Close">
        				</td>
        			</tr>		
        		</table>
        		 </form>
    		</td>
    	</tr>
    </table>
		
    	
   
</div>
  
 