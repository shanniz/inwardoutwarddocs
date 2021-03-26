
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
     $name = $_POST['name'];
     $phone = $_POST['phone'];
     $email = $_POST['email'];
     $designation = $_POST['designation'];
     $department = $_POST['department'];
     $sql = "INSERT INTO tbl_teachers (name,phone,email,designation,department)
     VALUES ('$name','$phone','$email','$designation','$department')";
     if (mysqli_query($conn, $sql)) {
        header("location: teachers.php");
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
    <title>Create Record</title>
    <?php include "head.php"; ?>
</head>
<body> 
	<div class="container">		
		<div class="row">
			<div class="col-lg-12">
				<div class="page-header">
					<h2>Create Record</h2>
				</div>
				<p>Please fill this form and submit to add teacher record to the database.</p>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" value="" maxlength="50" required="">
					</div>
					
					<div class="form-group">
						<label>Phone</label>
						<input type="mobile" name="phone" class="form-control" value="" maxlength="12" required="">
					</div>
					
					<div class="form-group ">
						<label>Email</label>
						<input type="email" name="email" class="form-control" value="" maxlength="30" required="">
					</div>
					
					<div class="form-group ">
						<label>Designation</label>
						<input type="text" name="designation" class="form-control" value="" maxlength="30" required="">
					</div>
					
					<div class="form-group ">
						<label>Department</label>
						<input type="text" name="department" class="form-control" value="" maxlength="30" required="">
					</div>

					<input type="submit" class="btn btn-primary" name="save" value="submit">
					<a href="teachers.php" class="btn btn-default">Cancel</a>
				</form>
			</div>
		</div>                
	</div>
</body>
</html>
