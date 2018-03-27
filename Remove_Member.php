<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<!--This is PHP CODING -->
<script>
function c(){ 
<?php
$ID = $IDErr = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty($_POST['REMOVE_ID'])){
		$IDErr = "<p>Incorrect</p>";
	}else{
		$ID = test_input($_POST["REMOVE_ID"]);
	}
}

//Validation method
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}


//Datbase Connection
$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "karachireservationclub";

// Create connection
$ID_FORM = $NAME_FORM = $PASSWORD_FORM = $EMAIL_FORM = $CONTACT_FORM = $CNIC_FORM = "0";

$conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT ID,NAME,PASSWORD,EMAIL,CONTACT,CNIC FROM users WHERE ID = '$ID'";
$result = $conn->query($sql);

if(empty($ID)){
	echo '<script type="text/javascript">
			alert("Fields are Empty");
		</script>';
}else{
	if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    //    echo "id: " . $row["ID"]. " - Name: " . $row["NAME"]. "PASSWORD " . $row["PASSWORD"]. "EMAIL " . $row["EMAIL"]."CONTACT" . $row["CONTACT"]. "CNIC " . $row["CNIC"]."<br>";
		$ID_FORM = $row["ID"];
		$NAME_FORM = $row["NAME"];
		$PASSWORD_FORM = $row["PASSWORD"];
		$EMAIL_FORM = $row["EMAIL"];
		$CONTACT_FORM = $row["CONTACT"];
		$CNIC_FORM = $row["CNIC"];
    }
} else {
    echo '<script type="text/javascript">
			alert("No Results");
		</script>';
}
}
//************************************************
//			function deleting(){
//				$result = $conn->query($del_Query);
//			if($del_Query){
//				$ID_FORM = $NAME_FORM = $PASSWORD_FORM = $EMAIL_FORM = $CONTACT_FORM = $CNIC_FORM = "0";
//			}
//			else{
//				echo '<script type="text/javascript">
//					alert("Error");
//				</script>';
//			}
//			}
//}
?>
<!-- End of PHP CODING -->

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
				<h2>Remove Members</h2>
				<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<table>
				<tr>
					<td><label for="ID">ID</label></td>
					<td><input type="number" name="REMOVE_ID">
				
				
				<span class="error">*
					<?php echo $IDErr;?>
				</span>
				</td>
				</tr>
				<tr>
					<td colspan="2"><input onclick="c();" type="submit" value="Submit" /></td>
				</tr>
				</table>
	</form>
	<br>
	<br>
	<br>
	<table border = "2" cellpadding="5px">
		<tr>
			<th>ID</th>
			<th>NAME</th>
			<th>PASSWORD</th>
			<th>EMAIL</th>
			<th>CONTACT</th>
			<th>CNIC</th>
			<th>ACTION</th>
			<th>BACK</th>
		</tr>
		<tr>
			<td><?php echo $ID_FORM ?></td>
			<td><?php echo $NAME_FORM ?></td>
			<td><?php echo $PASSWORD_FORM ?></td>
			<td><?php echo $EMAIL_FORM ?></td>
			<td><?php echo $CONTACT_FORM ?></td>
			<td><?php echo $CNIC_FORM ?></td>
			<td><a href="Remove_Member.php?recordfunc=<?php echo $ID_FORM;?>">DELETE</a></td>
			<td><a href="adminportal.php">BACK</a></td>
		</tr>
	</table>
	<?php
	
		
		if(isset($_GET['recordfunc'])){
				$del = $_GET['recordfunc'];
				$del_Query = "DELETE FROM users WHERE ID = '$del'";
				$result = $conn->query($del_Query);
				header('Remove_Member.php');
				exit();
		}
			
			
			$conn->close();
	?>
	<br><br>	
				</div>
				</div>
			</div>
			
		
</body>
</html>