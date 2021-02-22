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
<title>Settings</title>
<?php include "head.php"; ?>

<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#senderOffTable').dataTable();
		document.getElementById("navSettings").className += " active"
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
						<h2 class="pull-left">Sender Offices</h2>				
					</div>
									
					<div class="page-header clearfix ">
						<a href="create_sender_office.php" class="btn btn-success pull-right">Add Sender Office</a>
								        
					</div>
					</br>		
							
	
				   <?php
					include_once 'connection.php';
					$result = mysqli_query($conn,"SELECT * FROM tbl_senderoffice");
					?>

					<?php
					if (mysqli_num_rows($result) > 0) {
					?>
					

					  <table id="senderOffTable" class='table table-bordered table-striped'>
					  <thead>  
					  <tr>
						<td>SNo</td> 
						<td>Sender Office</td>						
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
						<td><?php echo $row["sender_office_name"]; ?></td>
						
						<td align="center">							
							<a onclick='javascript:confirmationDelete($(this));return false;'  href="delete_setting.php?id=<?php echo $row["sno"]; ?>" title='Delete Record'>
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