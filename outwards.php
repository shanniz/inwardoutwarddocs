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
<title>Outwards</title>
<?php include "head.php"; ?>

<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		//$('[data-toggle="tooltip"]').tooltip();   
		$('#outwardsTable').dataTable();
		document.getElementById("navOutwards").className += " active";
	});
	function confirmationDelete(anchor)
	{
	   var conf = confirm('Are you sure want to delete this record?');
	   if(conf)
		  window.location=anchor.attr("href");
	}
</script>


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

</head>
<body>
	<div class="wrapper">
			
		<?php include "header.php"; ?>

        <div class="container">
            
			<div class="row">

				<div class="col-lg-12 mx-auto">
					<div class="page-header clearfix">
						<h2 class="pull-left">Outwards</h2>				
					</div>
				
					<div class="page-header clearfix ">
								<!--<h2 class="pull-left">Inwards/Outwards</h2>-->
								<a href="create_outward.php" class="btn btn-success pull-right">Add Outward</a>                    
					</div>
					</br>
							
				   <?php
					include_once 'connection.php';
					$result = mysqli_query($conn,"SELECT * FROM tbl_outwards");
					?>

					<?php
					if (mysqli_num_rows($result) > 0) {
					?>
					  <table id="outwardsTable" class='table table-bordered table-striped'>
					  <thead>  
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
						<td>Image</td>
						<td>Action</td>
					  </tr>
					  </thead>
					<tbody>  
					<?php
					$i=0;
					while($row = mysqli_fetch_array($result)) {
					?>
					<tr>
						<td><?php echo $row["sno"]; ?></td>
						<td><?php echo $row["outward_date"]; ?></td>
						<td><?php echo $row["outward_num"]; ?></td>
						<td><?php echo $row["subject"]; ?></td>
						<td><?php echo $row["destination_office"]; ?></td>
						<td><?php echo ($row["receiving_person_destination_office"])?($row["receiving_person_destination_office"]):('N/A'); ?></td>
						<td><?php echo ($row["office_copy_file_name_placed"])?($row["office_copy_file_name_placed"]):('N/A'); ?></td>
						<td><?php echo ($row["office_copy_file_no_record"])?($row["office_copy_file_no_record"]):('N/A'); ?></td>
						<td><?php echo ($row["remarks"])?($row["remarks"]):('N/A'); ?></td>
						<td align="center">
							<img src="<?php echo stripslashes($row["image_url"]); ?>" alt="" width="40" height="40"> 
						</td>   
						
						<td>
							<a href="update_outward.php?id=<?php echo $row["sno"]; ?>" title='Update Record'> 
							<i class='material-icons'><span class='far fa-file' ></span> </i>		
							</a>
							<a onclick='javascript:confirmationDelete($(this));return false;' href="delete_outward.php?id=<?php echo $row["sno"]; ?>" title='Delete Record'>
								<i class='material-icons'><span class='fa fa-trash' ></span> </i>	
							</a>
						</td>
					</tr>
					<?php
					$i++;
					}
					?>
					</tbody>  
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