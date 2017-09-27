
  <div class="home">
  <?php 
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
    if(isset($_POST['ListOfShops']))
    {
        $_SESSION['path']="listofshops";
        header("Location: ".BASEPATH);
    }
    if(isset($_POST['contractEnd']))
    {
        $_SESSION['path']="contractend";
        header("Location: ".BASEPATH);
    }
    if(isset($_POST['shopReport']))
    {
        $_SESSION['path']="shopreport";
        header("Location: ".BASEPATH);
    }
   if(isset($_POST['shopInvoice']))
    {
        $_SESSION['path']="shopinvoice";
        header("Location: ".BASEPATH);
    }
    if(isset($_POST['memberEntry']))
    {
        $_SESSION['path']="member";
        header("Location: ".BASEPATH);
    }
    if(isset($_POST['memberList']))
    {
        $_SESSION['path']="memberlist";
        header("Location: ".BASEPATH);
    }
    if(isset($_POST['memberTerminating']))
    {
        $_SESSION['path']="memberterminate";
        header("Location: ".BASEPATH);
    }
    if(isset($_POST['MemberHistory']))
    {
        $_SESSION['path']="MemberHistory";
        header("Location: ".BASEPATH);
    }
    if(isset($_POST['ShopHistory']))
    {
        $_SESSION['path']="ShopHistory";
        header("Location: ".BASEPATH);
    }
    if(isset($_POST['insurance']))
    {
        $_SESSION['path']="insurance";
        header("Location: ".BASEPATH);
    }
   if(isset($_POST['insurancelist']))
    {
        $_SESSION['path']="insurancelist";
        header("Location: ".BASEPATH);
    }
  ?>
<table>
<tr>
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td>
<td>
    <form method="post">
    	<table>
    		<tr>
    			<td>
        				<table>
        						<tr>
                        			<td>
                        				Hello <?php echo $_SESSION['username'];?> !
                        			</td>
                        			<td align="right">
                        				<input type="submit" name="logout" value="Logout" class="btn2 btn2-primary btn2-block btn2-large">
                        			&nbsp;&nbsp;</td>
                        		</tr>
        						
        				</table>
                		</td>
            		</tr>
            		<tr>
            			<td>
            			<table border="1">
            		<tr>
            			<td align="center"><h2>Shop</h2></td>
            			<td align="center"><h2>Members</h2></td>
            			<td align="center"><h2>Insurance</h2></td>
            		</tr>
            		<tr>
            			<td align="center" valign="top">
            			
            				<table>
            					<tr>
            						<td><br>
            						
            						<button type="submit" name="shopEntry" class="btn1 btn1-primary btn1-block btn1-large">Shop Entry</button>
            						
            						</td>
            					</tr>
            					<tr>	
            						<td><br>
            						<button type="submit" name="ListOfShops" class="btn1 btn1-primary btn1-block btn1-large">Shop List</button>
            						
            						</td>
            					</tr>
            					<tr>
            						<td><br>
            							<button type="submit" name="contractEnd" class="btn1 btn1-primary btn1-block btn1-large">Contract Ending Soon</button>
            						
            						</td>
            					</tr>
            					<tr>
            						<td><br>
            							<button type="submit" name="ShopHistory" class="btn1 btn1-primary btn1-block btn1-large">History</button>
            						
            						</td>
            					</tr>
            					<tr>
            						<td><br>
            							<button type="submit" name="shopReport" class="btn1 btn1-primary btn1-block btn1-large">Generate Invoice</button>
            						
            						</td>
            					</tr>
            					<tr>
            						<td><br>
            							<button type="submit" name="shopInvoice" class="btn1 btn1-primary btn1-block btn1-large">Invoice Lists</button>
            						
            						</td>
            					</tr>
            				</table>
            			</td>
            			<td align="center" valign="top">
            				<table>
            					<tr>
            						<td><br>
            						<button type="submit" name="memberEntry" class="btn1 btn1-primary btn1-block btn1-large">Member Entry Form</button>
            						
            						</td>
            					</tr>
            					<tr>	
            						<td><br>
            						<button type="submit" name="memberList" class="btn1 btn1-primary btn1-block btn1-large">Member List</button>
            						
            						</td>
            					</tr>
            					<tr>
            						<td><br>
            							<button type="submit" name="memberTerminating" class="btn1 btn1-primary btn1-block btn1-large">Member Terminating Soon</button>
            						
            						</td>
            					</tr>
            					<tr>
            						<td><br>
            							<button type="submit" name="MemberHistory" class="btn1 btn1-primary btn1-block btn1-large">History</button>
            						
            						</td>
            					</tr>
            				</table>
            			</td>
            			<td align="center" valign="top">
            				<table>
            					<tr>
            						<td><br>
            						<button type="submit" name="insurance" class="btn1 btn1-primary btn1-block btn1-large">Insurance Form</button>
            						
            						</td>
            					</tr>
            					
            					<tr>
            						<td><br>
            							<button type="submit" name="insurancelist" class="btn1 btn1-primary btn1-block btn1-large">Insurance List</button>
            						
            						</td>
            						
            					</tr>
            					
            				</table>
            			</td>
            		</tr>
            		
            		
            		
            	</table>
            			
    			</td>
    		</tr>
    	</table>
    	    	
    </form>
</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
</tr>
</table>	

</div>
