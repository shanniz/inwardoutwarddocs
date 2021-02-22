
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

//$img_file = $_FILES["img_file"]["name"];
    if(count($_POST)>0) {
		
		 $img_file = $_FILES["img_file"]["name"];
		 //print_r($img_file );
		 
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
		  print_r($filePath);
		  //exit();
		  
		  if ( move_uploaded_file( $_FILES["img_file"]["tmp_name"], $filePath)) {
			//$sql = "INSERT INTO tbl_demo VALUES (NULL, '".prepare_input($filePath) ."')";
			//$msg = ( mysql_query($sql))  ? successMessage("Uploaded and saved to database.") : errorMessage( "Problem in saving to database");
		  } else {
			//$msg = errorMessage( "Problem in uploading file");
		  }
		
		
		mysqli_query($conn,"UPDATE tbl_inwards set 
		inward_date='" . $_POST['inward_date'] . "', outward_num_sending_office='" . $_POST['outward_num_sending_office'] . "' ,subject='" . $_POST['subject']."', sender_office='"  . $_POST['sender_office']."', inward_num_cs_dept='"
		. $_POST['inward_num_cs_dept']."', received_by_cs_dept='" . $_POST['received_by_cs_dept']."', file_name_placed='" . $_POST['file_name_placed']."', file_no_record='" . $_POST['file_no_record']."', remarks='"
		. $_POST['remarks'] //. "', image_url='" . $filePath 
		. "' WHERE sno='" . $_POST['id'] . "'");
		 
		 header("location: inwards.php");
		exit();
    }
		
    $result = mysqli_query($conn,"SELECT * FROM tbl_inwards WHERE sno='" . $_GET['id'] . "'");    
	$row= mysqli_fetch_array($result);
	  
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Inward</title>
	
	
	<script>	
	function senderOffChange(e) {
		document.getElementById("file_name_placed").value = e.target.value;
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Update Inward Record</p>
					<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" enctype="multipart/form-data" method="post" onSubmit="return validateImage();">
                        
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" name="inward_date" class="form-control" value="<?php echo $row["inward_date"]; ?>" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>outward_num_sending_office</label>
                            <input type="text" name="outward_num_sending_office" class="form-control" value="<?php echo $row["outward_num_sending_office"]; ?>" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" name="subject" class="form-control" value="<?php echo $row["subject"]; ?>" maxlength="120" required="">
                        </div>
                        <div class="form-group">
                            <label>sender_office</label>
							<?php echo ($row['sender_office'] ); ?>
							<select name="sender_office" class="form-control" required="" onchange="senderOffChange(event)">
								<option></option>

								<?php 
								$result2 = mysqli_query($conn, "SELECT * FROM tbl_senderoffice");
								while($row2 = mysqli_fetch_array($result2)) {
									
								echo "<option " ;
									//.  $row['sender_office'] == $row2['sender_office_name'] ? ' selected="selected"' : ''  .  ">" 
								echo	strcasecmp($row['sender_office'], $row2['sender_office_name']) == 0 ? ' selected="selected"' : ' ';
								echo  " >" . $row2['sender_office_name'] . "</option>";
								}
								?>
								<!--
								<option value="registrar" <?php if($row["sender_office"] == "Registrar"): ?> selected="selected"<?php endif; ?>>Registrar</option>
								<option value="directorfinance" <?php if($row["sender_office"] == "Director Finance"): ?> selected="selected"<?php endif; ?> >Director Finance</option>
								<option value="deanfos" <?php if($row["sender_office"] == "Dean FoS"): ?> selected="selected"<?php endif; ?> >Dean FoS</option>
								<option value="deanfoe" <?php if($row["sender_office"] == "deanfoe"): ?> selected="selected"<?php endif; ?>  >Dean FoE</option>
								<option value="deanfecee" <?php if($row["sender_office"] == "deanfecee"): ?> selected="selected"<?php endif; ?> >Dean FECEE</option>
								<option value="other" <?php if($row["sender_office"] == "other"): ?> selected="selected"<?php endif; ?> > Other </option>
								-->
							</select>			
                        </div>
                        <div class="form-group">
                            <label>inward_num_cs_dept</label>
                            <input type="text" name="inward_num_cs_dept" class="form-control" value="<?php echo $row["inward_num_cs_dept"]; ?>" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>received_by_cs_dept</label>
                            <input type="text" name="received_by_cs_dept" class="form-control" value="<?php echo $row["received_by_cs_dept"]; ?>" maxlength="50" required="">
                        </div>
                        <div class="form-group">
                            <label>file_name_placed</label>
                            <input type="text" id="file_name_placed" name="file_name_placed" class="form-control" value="<?php echo $row["file_name_placed"]; ?>" maxlength="50" >
                        </div>
                        
						<div class="form-group">
                            <label>file_no_record</label>
                            <input type="text" name="file_no_record" class="form-control" value="<?php echo $row["file_no_record"]; ?>" maxlength="50" >
                        </div>
						
						<div class="form-group ">
                            <label>remarks</label>
                            <input type="text" name="remarks" class="form-control" value="<?php echo $row["remarks"]; ?>" maxlength="30" >
                        </div>
                        
						
						<!--
						<div class="form-group ">
                            <label>Image</label>
							<input type="file" name="img_file" id="img_file" class="form-control" value="<?php echo $row['image_url']; ?>" />  
                        </div>
						-->
						
						<input type="hidden" name="id" value="<?php echo $row["sno"]; ?>"/>
						<div class="form-group ">
							<input type="submit" class="btn btn-primary" name="save" value="Update">
							<a href="inwards.php" class="btn btn-default">Cancel</a>
						</div>
                    </form>
                </div>

            </div> 
		
		
        </div>
</body>
</html>