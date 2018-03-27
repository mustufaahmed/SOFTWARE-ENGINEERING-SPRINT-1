<!DOCTYPE HTML>

<?php
    // Start the session
    session_start();

    // Defines username and password. Retrieve however you like,
//    $username = 11111;
//    $password = "MICROsoft532";
	$ID = $IDERR = $PASS = $PASSERR = "0";

    // Error message
    $error = "";

    // Checks to see if the user is already logged in. If so, refirect to correct page.
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
        $error = "success";
        header('Location: ../adminportal.php');
    } 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if(empty($_POST['username'])){
				$IDERR = "<p>TYPE ID</p>";
			}else{
				$ID = $_POST['username'];
			}
			
			if(empty($_POST['password'])){
				$PASSERR = "<p>TYPE PASSWORD</p>";
			}else{
				$PASS = $_POST['password'];
			}
	}
    // Checks to see if the username and password have been entered.
    // If so and are equal to the username and password defined above, log them in.
//    if (isset($_POST['username']) && isset($_POST['password'])) {
//        if ($_POST['username'] == $username && $_POST['password'] == $password) {
//            $_SESSION['loggedIn'] = true;
//            header('Location: ../adminportal.php');
//        } else {
//            $_SESSION['loggedIn'] = false;
//            $error = "Invalid username and password!";
//        }
//    }
	//Database Connection
	$servername = "localhost";
$username = "root";
$pass = "";
$dbname = "karachireservationclub";

// Create connection
$ID_login = $PASSWORD_login = "0";

$conn = new mysqli($servername, $username, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT ID,PASSWORD FROM users WHERE ID = '$ID'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $ID_login = $row["ID"];
		$PASSWORD_login = $row["PASSWORD"];
    }
} else {
    echo '<script type="text/javascript">
			alert("No Results");
		</script>';
}

    // Checks to see if the username and password have been entered.
    // If so and are equal to the username and password defined above, log them in.
    if (isset($_POST['username']) && isset($_POST['password'])) {
        if ($_POST['username'] == $ID_login && $_POST['password'] == $PASSWORD_login) {
            $_SESSION['loggedIn'] = true;
            if($ID_login == 11111){
				header('Location: ../adminportal.php');
			}else{
				header('Location: ../dashboard.html');
			}
        } else {
            $_SESSION['loggedIn'] = false;
            $error = "Invalid username and password!";
        }
    }
$conn->close();
?>
<html>
    <head>
        <title>Login Page</title>
		<link rel="stylesheet" href="../css/style.css" />
		<script type="text/javascript" src="../Jquery.js"></script>
    </head>
    
    <body>
        <!-- Output error message if any -->
        <?php echo $error; ?>
        
       
		<div id="Panel" style="display:block;">
			<div class="close" style="display:block;"></div>
			<h2></h2>
			
			<form id="loginForm" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" style="display:block;">
				<table>
					<tr>
						<td></td>
					</tr>
					<tr>
						<td><label for="userN">ID</label></td>
					</tr>
					<tr>
						<td><input id="userN" type="text" name="username"/></td>
					</tr>
					<tr>
						<td><label for="pa">Password</label></td>
					</tr>
					<tr>
						<td><input id="pa" type="Password" name="password" /></td>
					</tr>
					<tr>
						<td><input type="submit" value="Login"/></td>
						<span class="error">*<?php echo $error?>
					</tr>
				</table>
			</form>
		</div>
		<!-- Panel End -->

	
		<!-- Black Screen ---->
		<div id="black" style="display:block">
		
		</div>
		
		<!-------------------->
    </body>
</html>