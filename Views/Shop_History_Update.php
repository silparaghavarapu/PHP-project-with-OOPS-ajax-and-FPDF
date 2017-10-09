<?php
require_once LIBPATH.'database.php';

require_once LIBPATH. 'fpdf.php';
require_once (CONTROLLERPATH.'Controller_Shop_History.php');
require_once (CONTROLLERPATH.'Controller_Transactions.php');
if(isset($_POST['mainpage']))
{
    $_SESSION['path']="mainpage";
    header("Location: ".BASEPATH);
}
if(isset($_POST['logout']) || $_SESSION['username']=="")
{
    session_destroy();
    header("Location: ".BASEPATH);
    die();
}
if(isset($_POST['Delete']))
{
       
    $obj=new Controller_Shop_History();
    $obj->ShopHistryDel($_SESSION['shopid']);
     $_SESSION['path']="ShopHistory";
     header("Location: ".BASEPATH);
     die();
   
}

?>
 <div>	
    
    <table>
    	<tr>
    		<td  align="left">
    			<form method="post" action="" enctype="multipart/form-data">
    			<table>
    				<tr>
    					<td align="left"><h2>Hello <?php echo $_SESSION['username'];?> !</h2></td>
    					
    					<td><input type="submit" class="button-close" name="mainpage" value="Close"></td>
    					<td><input type="submit" class="button-logout" name="logout" value="Logout"></td>
    				</tr>
    			</table>
    			</form>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<?php 
    			$obj=new Controller_Shop_History();
    			$shop_data=$obj->ShopHistryByID($_SESSION['shopid']);
    			foreach($shop_data as $update_data)
    			{
    			?>
    			<form method="post" action="" enctype="multipart/form-data">
    			<table>
        			<tr>
        				<td colspan=2>
        				<table>
        				<tr>
        				<td  align="left">
        					<label class="fontstyles1" for="element_1">Shop Name &nbsp;&nbsp;</label>
        				</td>
        				
        				<td align="left">
        					&nbsp;&nbsp;<input id="Shop_name" name="Shop_name"  class="input1" value="<?php echo $update_data['Shop_Name'];?>" type="text"  readonly  required="required">
        					<input id="Shop_name1" name="Shop_name1"  class="input1" value="<?php echo $update_data['Shop_Name'];?>" type="hidden">
        				</td>
        					<td align="left"><label class="fontstyles1" for="element_1">Website</label></td>
                                    <td align="left"><input id="url" name="url"  value="<?php echo $update_data['Company_URL'];?>" type="text"  readonly class="input1">
                                    	<input id="url1" name="url1"  value="<?php echo $update_data['Company_URL'];?>" type="hidden" class="input1">
                                    </td>
                                    </tr>
        				</table>
        				</td>
        				
        			</tr>
        			<tr>
        				<td>
        					<!-- Address table starts -->
        						<table>
        							<tr>
        								<td align="left">
        									<fieldset class="fieldset-auto-width">
                                              <legend>Address Details</legend>
                                              <table>
                                              	  <tr>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">Address</label></td>
                                              	  	<td align="left"><textarea id="Primary_address" readonly name="Primary_address"  class="input1" cols=2 rows=2 required="required"><?php echo $update_data['Primary_Address'];?></textarea>
                                              	  		<input id="Primary_address1" name="Primary_address1"  class="input1" value="<?php echo $update_data['Primary_Address'];?>" type="hidden">
                                              	  	</td>
                                              	  </tr>
                                                  <tr>
                                                  	<td align="left"><label class="fontstyles1" for="element_1">City</label></td>
                                                  	<td align="left"><input id="Primary_city" name="Primary_city" class="input1"  value="<?php echo $update_data['Primary_City'];?>" type="text"   readonly required="required">
                                                  	    <input id="Primary_city1" name="Primary_city1" class="input1"  value="<?php echo $update_data['Primary_City'];?>" type="hidden">
                                                  	</td>
                                                  </tr>
                                              	  <tr>
                                              	  	<td align="left"><label class="fontstyles1" for="element_1">State</label></td>
                                              	  	<td align="left"><input id="Primary_State" name="Primary_State" class="input1"  value="<?php echo $update_data['Primary_State'];?>" type="text"   readonly required="required">
                                              	  		<input id="Primary_State1" name="Primary_State1" class="input1"  value="<?php echo $update_data['Primary_State'];?>" type="hidden">
                                              	  	</td>
                                              	  </tr>
                                              	  <tr>
                                              	  	<td  align="left"><label class="fontstyles1" for="element_1">Zip</label></td>
                                              	  	<td  align="left"><input id="Primary_zip" name="Primary_zip"  class="input1" value="<?php echo $update_data['Primary_zip'];?>" type="text"   readonly required="required">
                                              	  		<input id="Primary_zip1" name="Primary_zip1"  class="input1" value="<?php echo $update_data['Primary_zip'];?>" type="hidden">
                                              	  	</td>
                                              	  </tr>
                                              	  <tr>
                                              	  	<td  align="left"><label class="fontstyles1" for="element_1">Secondary Address</label></td>
                                              	  	<td  align="left"><textarea id="Secondary_address" name="Secondary_address"  class="input1"  cols="2" rows="2"><?php echo $update_data['Secondary_Address'];?></textarea>
                                              	  		<input type="hidden" id="Secondary_address1" name="Secondary_address1"  class="input1"  value="<?php echo $update_data['Secondary_Address'];?>">
                                              	  	</td>
                                              	  </tr>
                                              	 </table>
                                            </fieldset>
        								</td>
        							</tr>
        						</table>
        					
        					<!-- Address table ends -->
        				</td>
        				
        				<td  align="left">
        				<!-- Contact details starts  -->
        						<fieldset>
                                              <legend>Contact Details</legend>
                                              <table>
                                              	  <tr>
                                              	  	<td  align="left"><label class="fontstyles1" for="element_1">Primary Contact</label></td>
                                              	  	<td  align="left"><input id="Primary_contact" name="Primary_contact"  value="<?php echo $update_data['Primary_Contact'];?>" type="text"   readonly class="input1" required="required">
                                              	  		<input id="Primary_contact1" name="Primary_contact1"  value="<?php echo $update_data['Primary_Contact'];?>" type="hidden" class="input1">
                                              	  	</td>
                                              	  	<td  align="left"><label class="fontstyles1" for="element_1">Secondary Contact</label></td>
                                              	  	<td  align="left"><input id="Secondary_contact" name="Secondary_contact"  value="<?php echo $update_data['Secondary_Contact'];?>" type="text"   readonly class="input1">
                                              	  		<input id="Secondary_contact1" name="Secondary_contact1"  value="<?php echo $update_data['Secondary_Contact'];?>" type="hidden">
                                              	  	</td>
                                              	  	
                                              	  </tr>
                                                  <tr>
                                                  	<td  align="left"><label class="fontstyles1" for="element_1">Primary Phone</label></td>
                                                  	<td  align="left"><input id="Primary_phone" name="Primary_phone"  value="<?php echo $update_data['Primary_Phone'];?>" type="text"   readonly class="input1" required="required">
                                                  		<input id="Primary_phone1" name="Primary_phone1"  value="<?php echo $update_data['Primary_Phone'];?>" type="hidden" class="input1">
                                                  	</td>
                                              	  	<td  align="left"><label class="fontstyles1" for="element_1">Secondary Phone</label></td>
                                                  	<td  align="left"><input id="Secondary_phone" name="Secondary_phone"  value="<?php echo $update_data['Secondary_Phone'];?>" type="text"   readonly  class="input1">
                                                  		<input id="Secondary_phone1" name="Secondary_phone1"  value="<?php echo $update_data['Secondary_Phone'];?>" type="hidden">
                                                  	</td>
                                                  </tr>
                                                  <tr>
                                                  	<td  align="left"><label class="fontstyles1" for="element_1">Primary Phone(extensions)</label></td>
                                                  	<td  align="left"><input id="Primary_note" name="Primary_note"  value="<?php echo $update_data['Primary_note'];?>" type="text"   readonly class="input1">
                                                  		<input id="Primary_note1" name="Primary_note1"  value="<?php echo $update_data['Primary_note'];?>" type="hidden" class="input1">
                                                  	</td>
                                              	  	<td  align="left"><label class="fontstyles1" for="element_1">Secondary Phone(extensions)</label></td>
                                                  	<td  align="left"><input id="Secondary_note" name="Secondary_note"  value="<?php echo $update_data['Secondary_note'];?>" type="text"   readonly  class="input1">
                                                  		<input id="Secondary_note1" name="Secondary_note1"  value="<?php echo $update_data['Secondary_note'];?>" type="hidden">
                                                  	</td>
                                                  </tr>
                                              	  <tr>
                                              	  	<td  align="left"><label class="fontstyles1" for="element_1">Primary Email_Id</label></td>
                                              	  	<td  align="left"><input id="Primary_email" name="Primary_email"  value="<?php echo $update_data['Primary_Email'];?>" type="text"   readonly  class="input1">
                                              	  		<input id="Primary_email1" name="Primary_email1"  value="<?php echo $update_data['Primary_Email'];?>" type="hidden">
                                              	  	</td>
                                              	  	<td  align="left"><label class="fontstyles1" for="element_1">Secondary Email_Id</label></td>
                                              	  	<td  align="left"><input id="Secondary_email" name="Secondary_email"  value="<?php echo $update_data['Secondary_Email'];?>" type="text"   readonly  class="input1">
                                              	  		<input id="Secondary_email1" name="Secondary_email1"  value="<?php echo $update_data['Secondary_Email'];?>" type="hidden">
                                              	  	</td>
                                              	  	
                                              	  	
                                              	  </tr>
                                              	  <tr>
                                              	  	<td  align="left"><label class="fontstyles1" for="element_1">Fax</label></td>
                                              	  	<td  align="left"><input id="Fax" name="Fax"  value="<?php echo $update_data['Fax'];?>" type="text"   readonly  class="input1">
                                              	  		<input id="Fax1" name="Fax1"  value="<?php echo $update_data['Fax'];?>" type="hidden">
                                              	  	</td>
                                              	  	<td  align="left"><label class="fontstyles1" for="element_1">Job Title</label></td>
                                              	  	<td  align="left"><input id="Job_title" name="Job_title"  value="<?php echo $update_data['Job_Title'];?>" type="text"   readonly class="input1">
                                              	  		<input id="Job_title1" name="Job_title1"  value="<?php echo $update_data['Job_Title'];?>" type="hidden">
                                              	  	</td>
                                              	  	
                                              	  </tr>
                                              	  
                                              	  
                                              	 </table>
                                            </fieldset>
        					<!-- Contact detials ends  -->
        				
        				        					
        				</td>
        			</tr>
        			<!-- Contrat detials starts -->
        			<tr>
        			
        				<td  align="left">
        					<fieldset class="fieldset-auto-width">
                            <legend>Contract</legend>
        					<table>
                            	<tr>
                                	<td  align="left"><label class="fontstyles1" for="element_1">Contract Start Date</label></td>
                                    <td  align="left"><input id="Contract_start" name="Contract_start"  value="<?php echo $update_data['Contract_Start_Date'];?>" type="date" class="input1">
                                    	<input id="Contract_start1" name="Contract_start1"  value="<?php echo $update_data['Contract_Start_Date'];?>" type="hidden" class="input1">
                                    </td>
                                </tr>
                               	<tr>
                                	<td  align="left"><label class="fontstyles1" for="element_1">Contract End Date</label></td>
                                    <td  align="left"><input id="Contract_end" name="Contract_end"  value="<?php echo $update_data['Contract_End_Date'];?>" type="date" class="input1">
                                    	<input id="Contract_end1" name="Contract_end1"  value="<?php echo $update_data['Contract_End_Date'];?>" type="hidden" class="input1">
                                    </td>
                                </tr>
                                <tr>
                                    <td  align="left"><label class="fontstyles1" for="element_1">Contract Document</label></td>
                                    <td  align="left"><input id="Contract_document" name="Contract_document" type="file" class="input1" onchange="checksize(event)"></td>
                                </tr>
                                <tr>
                                   	<td  align="left"><label class="fontstyles1" for="element_1">Contract Active</label></td>
                                    <?php 
                                        $check="";
                                        if($update_data['Contract_Active']==1)
                                            $check="checked";
                                    ?>
                                    <td  align="left"><input id="Contract_active" name="Contract_active"  disabled="disabled"  type="checkbox" <?php echo $check;?>>
                                        <input type="hidden" name="Contract_active1" value="<?php echo $update_data['Contract_Active'];?>">
                                    </td>
                                </tr>
                             </table>
                        	</fieldset>
        				</td>
        			
        			<!-- Contrat detials ends  -->
        			
        				<td colspan="2"  align="center">
        					<!-- Insurance table starts -->
        						<table>
        							<tr>
        								<td  align="left">
        									<fieldset>
                                              <legend>Select Insurance</legend>
                                              	<div class="my-overflow">
                                              <table>
                                                  <?php 
                                                  require_once CONTROLLERPATH.'Controller_Insurance.php';
                                                  $obj=new Controller_Insurance();
                                                  $datas=$obj->showAllInsurances();
                                                  $i=1;
                                                  foreach ($datas as $data)
                                                  {
                                                      $objs=new Controller_Shop_History();
                                                      $tdata=$objs->getTransactionsbyID($_SESSION['shopid'], $data['Insurance_ID']);
                                                      if($tdata<>"")
                                                      {
                                                          foreach ($tdata as $transdata)
                                                          {
                                                              
                                                    ?>
                                                      
                                                      <tr>
                                              	  		<td align="left">
                                              	  			<input type="checkbox" name="<?php echo"insurance".$i; ?>" checked  disabled="disabled">
                                              	  			<input type="hidden" value="<?php echo $data['Insurance_ID']; ?>" name="<?php echo "insurance_".$i; ?>">
                                              	  			<input type="hidden" value="<?php echo $data['Insurance_ID']; ?>" name="<?php echo "insurance1_".$i; ?>">
                                              	  			
                                                      	
                                                          </td>
                                                          <td  align="left">
                                                          	<label class="fontstyles1" for="element_1" >&nbsp;<?php echo $data['Insurance_Name']; ?>&nbsp;&nbsp;</label>
                                                          </td>
                                                          <td  align="left">
                                                          	<label class="fontstyles1" for="element_1" ><?php echo $data['insurance_plan']; ?></label>
                                                          </td>
                                                          
                                                          <td  align="left">
                                                          	<input type="text"   readonly name="<?php echo "Ins_amount_".$i; ?>" class="input2" value="<?php echo $transdata['Insurance_Amount'] ?>"  placeholder="Insurance Amount">
                                                          	<input type="hidden" name="<?php echo "Ins_amount1_".$i; ?>" class="input2" value="<?php echo $transdata['Insurance_Amount'] ?>"  placeholder="Insurance Amount">
                                                          </td>
                                                          <td  align="left">
                                                          	<input type="text"   readonly name="<?php echo "due_amount_".$i; ?>" class="input2" value="<?php echo $transdata['Due_Amount'] ?>"  placeholder="Due Amount">
                                                          	<input type="hidden" name="<?php echo "due_amount1_".$i; ?>" class="input2" value="<?php echo $transdata['Due_Amount'] ?>"  placeholder="Due Amount">
                                                          </td>
                                                          <td  align="left">
                                                          	<input type="text"   readonly name="<?php echo "Initiation_".$i; ?>" class="input2" value="<?php echo $transdata['Initiation'] ?>" placeholder="Initiation Amount">
                                                          	<input type="hidden" name="<?php echo "Initiation1_".$i; ?>" class="input2" value="<?php echo $transdata['Initiation'] ?>" placeholder="Initiation Amount">
                                                          </td>	
                                                          <td  align="left">
                                                          	<input type="text"   readonly name="<?php echo "Mdeical_".$i; ?>" class="input2" value="<?php echo $transdata['Medical_Premium'] ?>" placeholder="Medical Premium">
                                                          	<input type="hidden" name="<?php echo "Mdeical1_".$i; ?>" class="input2" value="<?php echo $transdata['Medical_Premium'] ?>" placeholder="Medical Premium">
                                                          </td>
                                                          <td  align="left">
                                                          	<input type="text"   readonly name="<?php echo "Jif_".$i; ?>" value="<?php echo $transdata['Jif_Fund'] ?>" class="input2" placeholder="Jif Fund">
                                                          	<input type="hidden" name="<?php echo "Jif1_".$i; ?>" value="<?php echo $transdata['Jif_Fund'] ?>" class="input2" placeholder="Jif Fund">
                                                          </td>
                                                          
                                                      </tr>
                                                      <?php 
                                                          }
                                                          
                                                          }
                                                          else 
                                                          {
                                                              ?>
                                                          <tr>
                                              	  		<td align="left">
                                              	  			<input type="checkbox" name="<?php echo"insurance".$i; ?>"  disabled="disabled">
                                              	  			<input type="hidden" value="<?php echo $data['Insurance_ID']; ?>" name="<?php echo "insurance_".$i; ?>">
                                              	  			<input type="hidden" value="" name="<?php echo "insurance1_".$i; ?>">
                                              	  			
                                                      	
                                                          </td>
                                                          <td  align="left">
                                                          	<label class="fontstyles1" for="element_1" >&nbsp;<?php echo $data['Insurance_Name']; ?>&nbsp;&nbsp;</label>
                                                          </td>
                                                          <td  align="left">
                                                          	<label class="fontstyles1" for="element_1" ><?php echo $data['insurance_plan']; ?></label>
                                                          </td>
                                                          <td  align="left">
                                                          	<input type="text"   readonly name="<?php echo "Ins_amount_".$i; ?>" class="input2"  placeholder="Insurance Amount">
                                                          	<input type="hidden" name="<?php echo "Ins_amount1_".$i; ?>" class="input2"  placeholder="Insurance Amount">
                                                          </td>
                                                          <td  align="left">
                                                          	<input type="text"   readonly name="<?php echo "due_amount_".$i; ?>" class="input2"  placeholder="Due Amount">
                                                          	<input type="hidden" name="<?php echo "due_amount1_".$i; ?>" class="input2"  placeholder="Due Amount">
                                                          </td>
                                                          <td  align="left">
                                                          	<input type="text"   readonly name="<?php echo "Initiation_".$i; ?>" class="input2" placeholder="Initiation Amount">
                                                          	<input type="hidden" name="<?php echo "Initiation1_".$i; ?>" class="input2" placeholder="Initiation Amount">
                                                          </td>	
                                                          <td  align="left">
                                                          	<input type="text"   readonly name="<?php echo "Mdeical_".$i; ?>" class="input2" placeholder="Medical Premium">
                                                          	<input type="hidden" name="<?php echo "Mdeical1_".$i; ?>" class="input2" placeholder="Medical Premium">
                                                          </td>
                                                          <td  align="left">
                                                          	<input type="text"   readonly name="<?php echo "Jif_".$i; ?>" class="input2" placeholder="Jif Fund">
                                                          	<input type="hidden" name="<?php echo "Jif1_".$i; ?>" class="input2" placeholder="Jif Fund">
                                                          </td>
                                                      </tr>
                                                           <?php 
                                                          }
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
        					<input id="i_values" name="i_values"  class="input1"  value="<?php echo $i; ?>" type="hidden">
        				</td>
        			</tr>	
        			<tr >
        				<td  align="center" colspan=2>
        					<input  class="button-save" type="submit" name="Delete" value="Delete">
        				</td>
        				
        			</tr>		
        		</table>
        		 </form>
        		 <?php 
    			}
        		 ?>
    		</td>
    	</tr>
    </table>
		
    	
   
</div>
  
 