
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
    if(isset($_POST['insuranceHistory']))
    {
        $_SESSION['path']="insurancehistory";
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
                        			<td align="left"><h2>Hello <?php echo $_SESSION['username'];?> !</h2></td>
                        			<td align="right">
                        				<input type="submit" name="logout" value="Logout" class="button-logout">
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
            						<td>
            						
            						<button type="submit" name="shopEntry" class="buttons">Shop&nbsp;Entry</button>
            						
            						</td>
            					</tr>
            					<tr>	
            						<td>
            						<button type="submit" name="ListOfShops" class="buttons">Shop&nbsp;List</button>
            						
            						</td>
            					</tr>
            					<tr>
            						<td>
            							<button type="submit" name="contractEnd" class="buttons">Contract&nbsp;Ending&nbsp;Soon</button>
            						
            						</td>
            					</tr>
            					<tr>
            						<td>
            							<button type="submit" name="ShopHistory" class="buttons">History</button>
            						
            						</td>
            					</tr>
            					<tr>
            						<td>
            							<button type="submit" name="shopReport" class="buttons">Generate&nbsp;Invoice</button>
            						
            						</td>
            					</tr>
            					<tr>
            						<td>
            							<button type="submit" name="shopInvoice" class="buttons">Invoice&nbsp;Lists</button>
            						
            						</td>
            					</tr>
            				</table>
            			</td>
            			<td align="center" valign="top">
            				<table>
            					<tr>
            						<td>
            						<button type="submit" name="memberEntry" class="buttons">Member&nbsp;Entry&nbsp;Form</button>
            						
            						</td>
            					</tr>
            					<tr>	
            						<td>
            						<button type="submit" name="memberList" class="buttons">Member&nbsp;List</button>
            						
            						</td>
            					</tr>
            					<tr>
            						<td>
            							<button type="submit" name="memberTerminating" class="buttons">Member&nbsp;Terminating&nbsp;Soon</button>
            						
            						</td>
            					</tr>
            					<tr>
            						<td>
            							<button type="submit" name="MemberHistory" class="buttons">History</button>
            						
            						</td>
            					</tr>
            				</table>
            			</td>
            			<td align="center" valign="top">
            				<table>
            					<tr>
            						<td>
            						<button type="submit" name="insurance" class="buttons">Insurance&nbsp;Form</button>
            						
            						</td>
            					</tr>
            					
            					<tr>
            						<td>
            							<button type="submit" name="insurancelist" class="buttons">Insurance&nbsp;List</button>
            						
            						</td>
            						
            					</tr>
            					<tr>
            						<td>
            							<button type="submit" name="insuranceHistory" class="buttons">History</button>
            						
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