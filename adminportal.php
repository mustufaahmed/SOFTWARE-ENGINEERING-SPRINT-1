<!doctype html>
<html>
	<head>
		<title></title>
		<meta charset="utf-8" />
		<!--<link rel="stylesheet" href="css/reset.css" />-->
		<link rel="stylesheet" href="css/style.css" />
		<script type="text/javascript" src="Jquery.js"></script>
		<script type="text/javascript">
		</script>

	</head>
	
	<body>
	
	<!-- this is my php scripting for admin portal -->
	<script>
	function a(){
	
	<?php
	//Initalizing variables
	$id = $fName = $lName = $passwords = $email = $cellNo = $CNIC = "";
	$idErr = $fNameErr = $lNameErr = $passErr = $emailErr = $cellNoErr = $CNICErr = $idE = "" ;
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(empty($_POST["IDno"])){
			$idErr = "<p>ID is Required</p>";
		}
		else{
			$id = test_input($_POST["IDno"]);
		}
		if(empty($_POST["firstName"])){
			$fNameErr = "<p>First Name is Required</p>";
		}
		else{
			$fName = test_input($_POST["firstName"]);
		}
		if(empty($_POST["lastName"])){
			$lNameErr  = "Last Name is required";
		}
		else{
			$lName = test_input($_POST["lastName"]);
		}
		if(empty($_POST["password"])){
			$passErr = "PASSWORD Field is Required";
		}
		else{
			$passwords = test_input($_POST["password"]);
		}
		if(empty($_POST["Email"])){
			$emailErr = "Email is Required";
		}
		else{
			$email = test_input($_POST["Email"]);
		}
		if(empty($_POST["Contact"])){
			$cellNoErr = "Contact is Required";
		}
		else{
			$cellNo = test_input($_POST["Contact"]);
		}
		if(empty($_POST["Cnic"])){
			$CNICErr = "CNIC is required";
		}
		else{
			$CNIC = test_input($_POST["Cnic"]);
		}
	}
	else{
		$FORMErr = "There is Error Occured in form";
	}
	
	//Validation method
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	//Connection to database
	$database = 'karachireservationclub';
	$host = "localhost";
	$user="root";
	$pass = "";
	//Checking of Fields
	if(empty($id) || empty($fName) || empty($lName) || empty($passwords) || empty($email) || empty($cellNo) || empty($CNIC)){
		echo '<script type="text/javascript">
			alert("Fields are Empty");
		</script>';
	}
	else{
	//mysqli_connect
	$db = new mysqli($host,$user,$pass,$database) or die("Unable to Connect");
	if($db == true){
		echo "Connection Successfully <br>";
	}
	else{
		echo "no Connection ";
	}
	$NAME = $fName.$lName;
	//Sending to database
	$sql = "INSERT INTO users(ID,NAME,PASSWORD,EMAIL,CONTACT,CNIC)
			VALUES ('$id','$NAME','$passwords','$email','$cellNo','$CNIC')";
	
	if($db->query($sql)=== TRUE){
		//echo "New Record Created Successfully";
			$idE = "<script>alert('Record Inserted Successfully');</script>";
	}
	else{
		echo "Error: " . $sql . "<br>" . $db->error;
	}
	//database connection closed
	$db->close();
	}
?>
	
	</script>
<!--End of scripting -->
			
		<header>
			
				<div class="topHeaderBoard" style="border-bottom:2px solid black;">
					<a href="index.html"><h1>Karachi <span>Club</span></h1></a>
					<form method="post" action="loginFolder/logout.php" >
						
						<em><input type="submit" value="Logout"></em>
					</form>
				</div>
			
		</header>
		
		
			
			<div id="adminContent">
				<aside>
					<nav>
						<ul>
							<li><a href="adminportal.php">Add Memebr</a></li>
							<li><a href="Remove_Member.php" target="_blank">Remove Member</a></li>
							<li><a href="ADD_Court.php" target="_blank">Add Court</a></li>
							<li><a href="#">Change User Privacy</a></li>
							<li><a href="#">Add Memebr</a></li>
							<li><a href="#">Remove Member</a></li>
							<li><a href="Remove_Court.php" target="_blank">Remove Court</a></li>
							<li><a href="#">Change User Privacy</a></li>
							<li><a href="#">Remove Member</a></li>
							<li><a href="#">Add Court</a></li>
							<li><a href="#">Change User Privacy</a></li>
						</ul>
					</nav>
				</aside>
				<div id="section">
				<div id="createMember">
				<span class="error">
					<?php echo $idE;?>
				
				<h2>Members registration</h2>
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
						<table>
							<tr>
								<td><label for="id">ID No</label></tr>
								<td><input id="id" type="number" name="IDno">
									<span class="error">*
									<?php echo $idErr;?>
									</span>
								</tr>
							</tr>
							<tr>
								<td><label for="Fnmae">First Name</label></tr>
								<td><input id="Fname" type="text" name="firstName">
									<span class="error">*
									<?php echo $fNameErr;?>
									</span>
								</tr>
							</tr>
							<tr>
								<td><label for="Lname">Last Name</label></tr>
								<td><input id="Lname" type="text" name="lastName">
									<span class="error">*
									<?php echo $lNameErr;?>
									</span>
								</tr>
							</tr>
							<tr>
								<td><label for="pass">Password</label></tr>
								<td><input id="pass" type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
									<span class="error">*
									<?php echo $passErr;?>
									</span>
								</tr>
							</tr>
							<tr>
								<td><label for="email">Email</label></tr>
								<td><input id="email" type="email" name="Email" >
									<span class="error">*
									<?php echo $emailErr;?>
									</span>
								</tr>
							</tr>
							<tr>
								<td><label for="cellNo">Contact No</label></tr>
								<td><input id="cellNo" type="text" name="Contact">
									<span class="error">*
									<?php echo $cellNoErr;?>
									</span>
								</tr>
							</tr>
							<tr>
								<td><label for="Cnic">CNIC / Passsport No</label></tr>
								<td><input id="Cnic" type="text" name="Cnic">
									<span class="error">*
									<?php echo $CNICErr;?>
									</span>
								</tr>
							</tr>
							<tr>
								<td colspan="2"><input onclick="a()" type="submit" value="Submit"/></td>
							</tr>
							
						</table>
					</form>
				</div>
				</div>
			</div>
			</span>
			
	
			
	</body>
</html>