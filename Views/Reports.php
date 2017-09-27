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
if(isset($_POST['shopEntry']))
{
    $_SESSION['path']="shop";
    header("Location: ".BASEPATH);
}
if(isset($_POST['ShowReport']))
{
    require_once('Models/Model_Invoice.php');
    $obj=new Model_Invoice();
    $obj->setReports();
  //  $_SESSION['path']="Report_Invoice";
   //  header("Location:".BASEPATH);
}
?>
<div class="shop">
    <form method="post" name="show_list" id="show_list" action="">
    
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
								<table>
									<tr>
										<td>
											<input type="submit" name="mainpage" value="Close" class="small small-primary small-block small-large">
										</td>
										<td>
											<input type="submit" name="logout" value="Logout" class="small small-primary small-block small-large">
										</td>
									</tr>
										
									
								</table>
							</td>
						
					</table>
					<!-- page header ends -->
				</td>
			</tr>
			<tr>
				<td align="center">
					<table  border=1  style="width:50%;" >
						<tr>
							<td>Shop
							</td>
							<td>
								<select id="shopbyname" name="shopbyname" class="input1">
									<option value="">Select Shop</option>
									<option value="">Show ALL</option>
									<?php 
									require_once CONTROLLERPATH.'Controller_Shop.php';
									$objs=new Controller_Shop();
									$Shop_datas=$objs->showAllShop();
									foreach($Shop_datas as $sdata)
									{
									?>
									<option value="<?php echo $sdata['Shop_ID'];?>"><?php echo $sdata['Shop_Name'];?></option>
									<?php 
									}
									?>
								</select>
							</td>
						</tr>
						<tr>
							<td>Report</td>
							<td><select id="insurance" name="insurance" class="input1">
									<option>Select Report</option>
									<option value="insurance_carrier">Insurance Carrier</option>
									<option value="monthly_due">Monthly Due</option>
									<!-- option value="due_amount">Due Amount</option>
									<option value="initiation">Initiation</option>
									<option value="medical_premium">Medical Premium</option>
									<option value="jif_fund">Jif Fund</option-->
								</select>
							</td>
						</tr>
						<tr>
							<td>Due Date</td>
							<td><input type="date" name="duedate" id="duedate" class="input1">
						</tr>
						<tr>
							<td colspan=2 align="center">
								<input type="submit" name="ShowReport" Value="Generate Report"  class="btn btn-primary btn-block btn-large"> 
							</td>
						</tr>
					</table>
					       					
				</td>
			</tr>
				
		</table>
    	
    </form>
    </div>
