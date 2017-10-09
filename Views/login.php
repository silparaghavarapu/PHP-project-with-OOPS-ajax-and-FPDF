  <div class="login">
	<h1>Login</h1>
	<?php 
        if(isset($_POST['loginsubmit']))
        {
            require_once('Models/Model_Employees.php');
            //Echo the last database record id inserted so that you know the query inserted
            //echo "Last ID Inserted: ".$connect->lastInsertId();
            $obj=new Model_Employees();
            $results=$obj->getEmployees();
            if($results <> null)
            {    
            $_SESSION['path']="mainpage";
            header("Location: ".BASEPATH);
            die();
            }
        }
        if(isset($_POST['Signup']))
        {
                $_SESSION['path']="signup";
                header("Location: ".BASEPATH);
                die();
           
        }
        
        
    ?>
    <table>
    	<tr>
    		<td>
    		<form method="post" action="">
    
    	<table cellpadding="8">
    		<tr>
    			<td>
    				<?php
    				    if(isset($_SESSION['error']))
    				    {
    				        echo $_SESSION['error'];
    				    }
    				?>
    			</td>
    		</tr>
    		<tr>
    			<td><b>User Name</b></td>
    			<td>
    				<input type="text" class="input1" name="Username" placeholder="Username" required="required" />
    			</td>
    		</tr>
    		<tr>
    			<td><b>Password</b></td>
    			<td>
    				<input type="password" class="input1" name="password" placeholder="Password" required="required" />
    			</td>
    		</tr>
    		<tr>
    			<td colspan=2 align="center">
    				<button type="submit" name="loginsubmit" class="btn btn-primary btn-block btn-large">Login</button>
    			</td>
    		</tr>
    		
    	</table>
    </form>
    		
    		</td>
    	</tr>
	<tr>
    			<td align="right">
    			<form method="post" action="">
    				
    				<button type="submit" name="Signup" class="buttonsignup">Signup</button>&nbsp;&nbsp;
    			</form>
    			</td>
    </tr>    
    </table>
      </div>
