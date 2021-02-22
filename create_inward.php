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
include_once 'connection.php';

if(isset($_POST['save']))
{    
     $inward_date = $_POST['inward_date'];
     $outward_num_sending_office = $_POST['outward_num_sending_office'];
     $subject = $_POST['subject'];
     $sender_office = $_POST['sender_office'];
     $inward_num_cs_dept = $_POST['inward_num_cs_dept'];
     $received_by_cs_dept = $_POST['received_by_cs_dept'];
     $file_name_placed = $_POST['file_name_placed'];
     $file_no_record = $_POST['file_no_record'];
     $remarks = $_POST['remarks'];
	 
	 
	 $img_file = $_FILES["img_file"]["name"];
	 $ext=  explode(".", $img_file )[1]; 
	 $folderName = "imginwards/";
	  $validExt = array("jpg", "png", "jpeg", "bmp", "gif");
	  /*
	  if ($img_file == "") {
		$msg = errorMessage( "Attach an image");
	  } elseif ($_FILES["img_file"]["size"] <= 0 ) {
		$msg = errorMessage( "Image is not proper.");
	  } else if ( !in_array($ext, $validExt) )  {
		$msg = errorMessage( "Not a valid image file");
	  } else {
		// upload script here
	  } */
	  
	  $filePath = $folderName. rand(10000, 990000). '_'. time().'.'.$ext;
	  if ( move_uploaded_file( $_FILES["img_file"]["tmp_name"], $filePath)) {
		//$sql = "INSERT INTO tbl_demo VALUES (NULL, '".prepare_input($filePath) ."')";
		//$msg = ( mysql_query($sql))  ? successMessage("Uploaded and saved to database.") : errorMessage( "Problem in saving to database");
	  } else {
		//$msg = errorMessage( "Problem in uploading file");
	  }
	  
     $sql = "INSERT INTO tbl_inwards (inward_date,outward_num_sending_office,subject,sender_office, inward_num_cs_dept, received_by_cs_dept, file_name_placed, file_no_record, remarks, image_url )
     VALUES ('$inward_date','$outward_num_sending_office','$subject', '$sender_office', '$inward_num_cs_dept', '$received_by_cs_dept', '$file_name_placed', '$file_no_record', '$remarks', '$filePath')";
     if (mysqli_query($conn, $sql)) {
        header("location: inwards.php");
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
    <title>Create Inward</title>
	
	<script>
	
	function senderOffChange(sel) {
		document.getElementById("file_name_placed").value = sel.options[sel.selectedIndex].text;
	}	
	
	function validateImage() {
		return true;
		/*
		var img = $("#img_file").val();
		var exts = ['jpg','jpeg','png','gif', 'bmp'];
		// split file name at dot
		var get_ext = img.split('.');
		// reverse name to check extension
		get_ext = get_ext.reverse();
		if (img.length > 0 ) {
			if ( $.inArray ( get_ext[0].toLowerCase(), exts ) > -1 ){
			  return true;
			} else {
				 alert("Upload only jpg, jpeg, png, gif, bmp images");
				return false;
			}            
		} else {
			alert("please upload an image");
			return false;
		}
		return false;
		*/
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
                        <h2>New Inward</h2>
                    </div>
                    <p>Add New Inward Record</p>
                    
					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post" onSubmit="return validateImage();">
                        
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="inward_date" class="form-control" value="" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>Outward Num Sending Office</label>
                            <input type="text" name="outward_num_sending_office" class="form-control" value="" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" value="" maxlength="120" required="">
                        </div>
                        <div class="form-group">
                            <label>Sender Office</label>							
							<select name="sender_office" class="form-control" required="" onchange="senderOffChange(this)">
								<option></option>
								<?php 
								$result = mysqli_query($conn, "SELECT * FROM tbl_senderoffice");
								while($row = mysqli_fetch_array($result)) {
								echo "<option >" . $row['sender_office_name'] . "</option>";
								}
								?>
								<!--
								<option value="registrar">Registrar</option>
								<option value="directorfinance">Director Finance</option>
								<option value="deanfos">Dean FoS</option>
								<option value="deanfoe">Dean FoE</option>
								<option value="deanfecee">Dean FECEE</option>
								<option value="other">Other</option>
								-->
							</select>							
                            <!--<input type="text" name="sender_office" class="form-control" value="" maxlength="100" required=""> -->
                        </div>
                        <div class="form-group">
                            <label>Inward Num CS Dept</label>
                            <input type="text" name="inward_num_cs_dept" class="form-control" value="" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>Received By CS Dept</label>
                            <input type="text" name="received_by_cs_dept" class="form-control" value="" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>File Name Placed</label>
                            <input type="text" id="file_name_placed" name="file_name_placed" class="form-control" value="" maxlength="50" >
                        </div>
                        
						<div class="form-group">
                            <label>File Num Record</label>
                            <input type="text" name="file_no_record" class="form-control" value="" maxlength="50" >
                        </div>
						
						<div class="form-group ">
                            <label>Remarks</label>
                            <input type="text" name="remarks" class="form-control" value="" maxlength="30" >
                        </div>
                        
						<div class="form-group ">
                            <label>Image</label>
							<input type="file" name="img_file" id="img_file" class="form-control"/>                        
						</div>

						<div class="form-group ">
							<input type="submit" class="btn btn-primary" name="save" value="Submit">
							<a href="inwards.php" class="btn btn-default">Cancel</a>
						</div>
                    </form>
                </div>

            </div> 
		
		
			<!--
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="" maxlength="50" required="">
                        </div>
                        <div class="form-group ">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="" maxlength="30" required="">
                        </div>
                        <div class="form-group">
                            <label>Mobile</label>
                            <input type="mobile" name="mobile" class="form-control" value="" maxlength="12" required="">
                        </div>

                        <input type="submit" class="btn btn-primary" name="save" value="submit">
                        <a href="inwards.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>

            </div> 
			-->
               <br>
        </div>

</body>
</html>
