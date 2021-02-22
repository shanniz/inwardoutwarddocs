<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

?>

<?php
require_once "connection.php";

if(isset($_POST['save']))
{    
     $sender_office = $_POST['sender_office_name'];
     
     $sql = "INSERT INTO tbl_senderoffice (sender_office_name ) VALUES ('$sender_office')";
     if (mysqli_query($conn, $sql)) {
        header("location: settings.php");
        exit();
     } else {
        echo "Error: " . $sql . "
" . mysqli_error($conn);
     }
     mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Sender Office</title>
	
    <?php include "head.php"; ?>
</head>
<body>

		<div class="bsheader">
			<nav class="navbar navbar-expand-md navbar-light bg-light">
				<!--<a href="#" class="navbar-brand">Brand</a> -->
				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
					<div class="navbar-nav">
						<a href="inwards.php" class="nav-item nav-link ">Inwards</a>
						<a href="outwards.php" class="nav-item nav-link">Outwards</a>
						
						<div class="nav-item dropdown">
							<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Add New</a>
							<div class="dropdown-menu">
								<a href="create_inward.php" class="dropdown-item">New Inward</a>
								<a href="create_outward.php" class="dropdown-item">New Outward</a>								
							</div>
						</div>
						<a href="users.php" class="nav-item nav-link">Users</a>
						<a href="#" class="nav-item nav-link">About</a>
					</div>
					
					<div class="navbar-nav">
						<a href="#" class="nav-item nav-link">Welcome <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
						<a href="logout.php" class="nav-item nav-link">Logout</a>	
					</div>
				</div>
			</nav>
		</div>
 
        <div class="container">		
			<div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h2>New Sender Office</h2>
                    </div>
                    <p>Add New Sender Office</p>
                    
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
                        
                        
                        <div class="form-group">
                            <label>Sender Office</label>							
							<input type="text" name="sender_office_name" class="form-control" value="" maxlength="100" required="">
                        </div>
                        
						<div class="form-group ">
							<input type="submit" class="btn btn-primary" name="save" value="Submit">
							<a href="settings.php" class="btn btn-default">Cancel</a>
						</div>
                    </form>
                </div>

            </div> 
		
        </div>

</body>
</html>
