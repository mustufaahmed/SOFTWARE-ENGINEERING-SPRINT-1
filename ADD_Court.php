<!DOCTYPE html>
<html>
<head>
	<title>ADD Court</title>
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<script>
function b(){
<?php
	$id = $type = $idErr = $typeErr = "";
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		if(empty($_POST['ID_Court'])){
			$idErr = "Insert ID here";
		}else{
			$id = test_input($_POST['ID_Court']);
		}
		if(empty($_POST['type_Court'])){
			$typeErr = "Insert TYPE here";
		}else{
			$type = test_input($_POST['type_Court']);
		}
	}
	//Validation
	function test_input($data){
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
	if(empty($id) || empty($type)){
		
	}else{
	//mysqli_connect
	$db = new mysqli($host,$user,$pass,$database) or die("Unable to Connect");
	if($db == true){
		echo "Connection Successfully <br>";
	}
	else{
		echo "no Connection ";
	}
	//Sending to database
	$sql = "INSERT INTO court(COURT_ID,TYPE)
			VALUES ('$id','$type')";
	
	if($db->query($sql)=== TRUE){
		//echo "New Record Created Successfully";
		$idErr = "<script>alert('Successfully added')</script>";
	}
	else{
		echo "Error: " . $sql . "<br>" . $db->error;
	}
	//database connection closed
	$db->close();
	}
	
?>
}
</script>
	
	<header>
			
				<div class="topHeaderBoard" style="border-bottom:2px solid black;">
				
					<a href="index.html"><h1>Karachi <span>Club</span></h1></a>
					<em>Log Out</em>
			
				</div>
				<style>
					table tr td, table tr th{
						padding:10px;
						color:black;
					}
				</style>
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
				<h2>Add Court</h2>
				
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<table>
					<tr>
						<td><label id="ID">ID</label></td>
						<td><input type="number" name="ID_Court">
							<span class="error">*
							<?php echo $idErr?>
						</td>
					</tr>
					<tr>
						<td><label id="type">TYPE</label></td>
						<td><input type="text" name="type_Court">
							<span class="error">*
							<?php echo $typeErr?>
						</td>
					</tr>
					<tr>
						<td colspan="2"><input onclick="b();" type="submit" value="submit"/></td>
					</tr>
				</form>
					</div>
				</div>
			</div>
</body>
</html>