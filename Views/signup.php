<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Login Form</title>
  
  <link rel="stylesheet" href="css/style.css">
  <script src="js/index.js"></script>

</head>

<body>
  <div class="signup">
	<h1>Registration</h1>
<?php 
    require_once('/config/config.php');
	
	if(isset($_POST['signupSubmit']))
	{
	require_once('Models/Model_Employees.php');
	//Echo the last database record id inserted so that you know the query inserted
	//echo "Last ID Inserted: ".$connect->lastInsertId();
	$obj=new Model_Employees();
	$obj->setEmployees();
	$_SESSION['path']="login";
	header("Location: ".BASEPATH);
	die();
	}
	if(isset($_POST['login']))
	{
	    $_SESSION['path']="login";
	    header("Location: ".BASEPATH);
	    die();
	    
	}
	?>
	<table>
		<tr>
			<td>
				<form method="post" action="" name="signup">
                	<table cellpadding="8">
                		<tr>
                			<td class="fontstyles" align="left">Name</td>
                			<td><input type="text" name="name" placeholder="Name" class="input1" autocomplete="off"  required="required"  /></td>
                		</tr>
                		<tr>
                			<td class="fontstyles" align="left">Email</td>
                			<td><input type="text" name="email" autocomplete="off" class="input1" placeholder="Email ID"  required="required"  /></td>
                		</tr>
                		<tr>
                			<td class="fontstyles" align="left">User Name</td>
                			<td><input type="text" name="username" autocomplete="off" class="input1" placeholder="User Name"  required="required"  /></td>
                		</tr>
                		<tr>
                			<td class="fontstyles" align="left">Password</td>
                			<td><input type="password" name="password" autocomplete="off" class="input1" placeholder="Password"  required="required" /></td>
                		</tr>
                		<tr>
                			<td class="fontstyles" align="left">Confirm Password</td>
                			<td><input type="password" name="Cpassword" autocomplete="off" class="input1" placeholder="Confirm Password"  required="required" /></td>
                		</tr>
                		<tr>
                			<td colspan=2>
                				<input type="submit"  class="btn btn-primary btn-block btn-large" name="signupSubmit" value="Signup">
                			</td>
                		</tr>
                	</table>
                </form>
			</td>
		</tr>
		<tr>
    			<td align="right">
    			<form method="post" action="">
    				
    				<button type="submit" name="login" class="buttonsignup">Login</button>&nbsp;&nbsp;
    			</form>
    			</td>
    </tr>    
	</table>
        
</div>
  
    <script src="js/index.js"></script>

</body>
</html>
