<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Home</title>
<?php include "head.php"; ?>

<script type="text/javascript" src="js/bootstrap/bootstrap-dropdown.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
		function openNav() {
		  document.getElementById("mySidenav").style.width = "250px";
		}

		function closeNav() {
		  document.getElementById("mySidenav").style.width = "0";
		}
    </script>


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<style>
    .bsheader{
        <!--margin: 20px;-->
    }

</style>
</head>
<body>
	<div class="wrapper">
			
		<div class="bsheader">
			<nav class="navbar navbar-expand-md navbar-light bg-light">
				<!--<a href="#" class="navbar-brand">Brand</a> -->
				<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
					<div class="navbar-nav">
						<a href="index.php" class="nav-item nav-link active">Home</a>
						
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
					<!--
					<form class="form-inline">
						<div class="input-group">                    
							<input type="text" class="form-control" placeholder="Search">
							<div class="input-group-append">
								<button type="button" class="btn btn-secondary"><i class="fa fa-search"></i></button>
							</div>
						</div>
					</form>
					-->
					<div class="navbar-nav">
						<a href="#" class="nav-item nav-link">Welcome <?php echo htmlspecialchars($_SESSION["username"]); ?></a>
						<a href="logout.php" class="nav-item nav-link">Logout</a>	
					</div>
				</div>
			</nav>
		</div>



        <div class="container">
            <div class="row">

				<div class="col-lg-12 mx-auto">
					<div class="page-header clearfix">
						<h2 class="pull-left">Inwards</h2>				
					</div>
				
					<!--<div class="page-header clearfix ">
								<h2 class="pull-left">Inwards/Outwards</h2>
								<a href="create_inward.php" class="btn btn-success pull-right">Add Inward</a>
								<a href="create_outward.php" class="btn btn-success pull-right">Add Outward</a>                    
							</div>
							-->
				   <?php
					include_once 'connection.php';
					$result = mysqli_query($conn,"SELECT * FROM tbl_inwards");
					?>

					<?php
					if (mysqli_num_rows($result) > 0) {
					?>
					  <table class='table table-bordered table-striped'>
					  
					  <tr>
						<td>SNo</td>
						<td>Date</td>
						<td>Outward Num Sending Office</td>
						<td>Subject</td>
						<td>Sender Office</td>
						<td>Inward Num CS Dept</td>
						<td>Recieved By</td>
						<td>File Name Placed</td>
						<td>File Num Record</td>
						<td>Remarks</td>
						<td>Action</td>
					  </tr>
					<?php
					$i=0;
					while($row = mysqli_fetch_array($result)) {
					?>
					<tr>
						<td><?php echo $row["sno"]; ?></td>
						<td><?php echo $row["inward_date"]; ?></td>
						<td><?php echo ($row["outward_num_sending_office"])?($row["outward_num_sending_office"]):('N/A'); ?></td>
						<td><?php echo $row["subject"]; ?></td>
						<td><?php echo $row["sender_office"]; ?></td>
						<td><?php echo $row["inward_num_cs_dept"]; ?></td>
						<td><?php echo $row["received_by_cs_dept"]; ?></td>
						<td><?php echo $row["file_name_placed"]; ?></td>
						<td><?php echo $row["file_no_record"]; ?></td>
						<td><?php echo $row["remarks"]; ?></td>
						
						<td>
							<a href="update_inward.php?id=<?php echo $row["sno"]; ?>" title='Update Record'> 
							<i class='material-icons'><span class='far fa-file' ></span> </i>		
							</a>
							<a href="delete_inward.php?id=<?php echo $row["sno"]; ?>" title='Delete Record'>
								<i class='material-icons'><span class='fa fa-trash' ></span> </i>	
							</a>
						</td>
					</tr>
					<?php
						$i++;
					}
					?>
					</table>
					 <?php
					}
					else{
						echo "No result found";
					}
					?>

				</div>
						
			</div> 
			
			
			<div class="row">

				<div class="col-lg-12 mx-auto">
					<div class="page-header clearfix">
						<h2 class="pull-left">Outwards</h2>				
					</div>
				
					<!--<div class="page-header clearfix ">
								<h2 class="pull-left">Inwards/Outwards</h2>
								<a href="create_inward.php" class="btn btn-success pull-right">Add Inward</a>
								<a href="create_outward.php" class="btn btn-success pull-right">Add Outward</a>                    
							</div>
							-->
				   <?php
					//include_once 'connection.php';
					$result = mysqli_query($conn,"SELECT * FROM tbl_outwards");
					?>

					<?php
					if (mysqli_num_rows($result) > 0) {
					?>
					  <table class='table table-bordered table-striped'>
					  
					  <tr>
						<td>SNo</td>
						<td>Date</td>
						<td>Outward Num</td>
						<td>Subject</td>
						<td>Destination Office</td>						
						<td>Recieved By At Destination</td>
						<td>Office Copy File Name Placed</td>
						<td>Office Copy File No. Rec</td>
						<td>Remarks</td>
						<td>Action</td>
					  </tr>
					<?php
					$i=0;
					while($row = mysqli_fetch_array($result)) {
					?>
					<tr>
						<td><?php echo $row["sno"]; ?></td>
						<td><?php echo $row["inward_date"]; ?></td>
						<td><?php echo $row["outward_num"]; ?></td>
						<td><?php echo $row["subject"]; ?></td>
						<td><?php echo $row["destination_office"]; ?></td>
						<td><?php echo ($row["receiving_person_destination_office"])?($row["receiving_person_destination_office"]):('N/A'); ?></td>
						<td><?php echo ($row["office_copy_file_name_placed"])?($row["office_copy_file_name_placed"]):('N/A'); ?></td>
						<td><?php echo ($row["office_copy_file_no_record"])?($row["office_copy_file_no_record"]):('N/A'); ?></td>
						<td><?php echo ($row["remarks"])?($row["remarks"]):('N/A'); ?></td>
						
						<td>
							<a href="update_outward.php?id=<?php echo $row["sno"]; ?>" title='Update Record'> 
							<i class='material-icons'><span class='far fa-file' ></span> </i>		
							</a>
							<a href="delete_outward.php?id=<?php echo $row["sno"]; ?>" title='Delete Record'>
								<i class='material-icons'><span class='fa fa-trash' ></span> </i>	
							</a>
						</td>
					</tr>
					<?php
					$i++;
					}
					?>
					</table>
					 <?php
					}
					else{
						echo "No result found";
					}
					?>
				</div>						
			</div> 			
        </div>
	</div>
	
</body>
</html>