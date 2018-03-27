<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<!--This is PHP CODING -->
<script>
function d(){
<?php
$ID = $IDErr = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(empty($_POST['ID_Remove_Court'])){
		$IDErr = "<p>Incorrect</p>";
	}else{
		$ID = test_input($_POST["ID_Remove_Court"]);
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
$ID_FORM = $TYPE_FORM = "0";

$conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT COURT_ID,TYPE FROM court WHERE COURT_ID = '$ID'";
$result = $conn->query($sql);

if(empty($ID)){
	echo '<script type="text/javascript">
			alert("Fields are Empty");
		</script>';
}else{
	if ($result->num_rows > 0){
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$ID_FORM = $row["COURT_ID"];
		$TYPE_FORM = $row["TYPE"];
    }
} else {
    echo '<script type="text/javascript">
			alert("No Results");
		</script>';
}
}
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
				<h2>Remove Court</h2>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
				<table>
				<tr>
					<td><label for="ID">ID</label></td>
					<td><input type="number" name="ID_Remove_Court">
				
				
				<span class="error">*<?php echo $IDErr?>
				</td>
				</tr>
				<tr>
					<td colspan="2"><input onclick="d();" type="submit" value="Submit"/></td>
				</tr>
				</table>
	</form>
	<br /><br />
	<table border="2" cellpadding="5px">
		<tr>
			<th>ID</th>
			<th>COURT</th>
			<th>ACTION</th>
			<th>BACK</th>
		</tr>
		<tr>
			<td><?php echo $ID_FORM?></td>
			<td><?php echo $TYPE_FORM?></td>
			<td><a href="Remove_Court.php?recordfunc=<?php echo $ID_FORM;?>">DELETE</a></td>
			<td><a href="adminportal.php">BACK</a></td>
		</tr>
	</table>
	<?php
		if(isset($_GET['recordfunc'])){
				$del = $_GET['recordfunc'];
				$del_Query = "DELETE FROM court WHERE COURT_ID = '$del'";
				$result = $conn->query($del_Query);
				header('Remove_Court.php');
				exit();
		}
			$conn->close();
	?>
			</div>
</body>
</html>