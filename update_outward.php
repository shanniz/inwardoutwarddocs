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
// Include database connection file
require_once "connection.php";

    if(count($_POST)>0) {
    mysqli_query($conn,"UPDATE tbl_outwards set 
	outward_date='" . $_POST['outward_date'] . "', outward_num='" . $_POST['outward_num'] . "' ,subject='" . $_POST['subject']."', destination_office='"  . $_POST['destination_office']."', receiving_person_destination_office='"
    . $_POST['receiving_person_destination_office']."', office_copy_file_name_placed='" . $_POST['office_copy_file_name_placed']."', office_copy_file_no_record='" . $_POST['office_copy_file_no_record']."', remarks='"
	. $_POST['remarks']. "' WHERE sno='" . $_POST['id'] . "'");
     
     header("location: outwards.php");
     exit();
    }
	
	
    $result = mysqli_query($conn,"SELECT * FROM tbl_outwards WHERE sno='" . $_GET['id'] . "'");    
	$row= mysqli_fetch_array($result);
	
  
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
	
	<script>
	
	function senderOffChange(e) {
		document.getElementById("office_copy_file_name_placed").value = e.target.value;
	}
	</script>
	
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
						<a href="inwards.php" class="nav-item nav-link">Inwards</a>
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
                        <h2>Update Outward</h2>
                    </div>
                    
					<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="outward_date" class="form-control" value="<?php echo $row["outward_date"]; ?>" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>Outward Num </label>
                            <input type="text" name="outward_num" class="form-control" value="<?php echo $row["outward_num"]; ?>" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" value="<?php echo $row["subject"]; ?>" maxlength="120" required="">
                        </div>
                        <div class="form-group">
						
                            <label>Destination Office</label>
							<select name="destination_office" class="form-control" required="" onchange="senderOffChange(event)">
								<option></option>
								<?php 
								$result2 = mysqli_query($conn, "SELECT * FROM tbl_senderoffice");
								while($row2 = mysqli_fetch_array($result2)) {
									
								echo "<option " ;
								echo	strcasecmp($row['destination_office'], $row2['sender_office_name']) == 0 ? ' selected="selected"' : ' ';
								echo  " >" . $row2['sender_office_name'] . "</option>";
								}
								?>
								
								
								
							</select>
						</div>
                        <div class="form-group">
                            <label>Receiving Person At Destination Office</label>
                            <input type="text" name="receiving_person_destination_office" class="form-control" value="<?php echo $row["receiving_person_destination_office"]; ?>" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>Office Copy File Name Placed</label>
                            <input type="text" id="office_copy_file_name_placed" name="office_copy_file_name_placed" class="form-control" value="<?php echo $row["office_copy_file_name_placed"]; ?>" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>Office Copy File Num Record Placed</label>
                            <input type="text" name="office_copy_file_no_record" class="form-control" value="<?php echo $row["office_copy_file_no_record"]; ?>" maxlength="50" >
                        </div>
                        
												
						<div class="form-group ">
                            <label>Remarks</label>
                            <input type="text" name="remarks" class="form-control" value="<?php echo $row["remarks"]; ?>" maxlength="30" >
                        </div>
						<!--
						<div class="form-group ">
                            <label>Image</label>
							<input type="file" name="img_file" id="img_file" class="form-control" value="<?php echo $row["image_url"]; ?>" />  
                        </div>
						-->
                        <div class="form-group ">
							<input type="hidden" name="id" value="<?php echo $row["sno"]; ?>"/>
							<input type="submit" class="btn btn-primary" name="save" value="Update">
							<a href="outwards.php" class="btn btn-default">Cancel</a>
						</div>
                    </form>
					<br>
                </div>
				
            </div> 
				
        </div>
</body>
</html>