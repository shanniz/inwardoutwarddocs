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

<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#inwardsTable').dataTable();
		document.getElementById("navInwards").className += " active";

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
						<h2 class="pull-left">Inwards</h2>				
					</div>
				
					<div class="page-header clearfix ">
						<!--<h2 class="pull-left">Inwards/Outwards</h2>-->
						<a href="create_inward.php" class="btn btn-success pull-right">Add Inward</a>
								        
					</div>
					</br>		
							
							
	   <!--<table id="myTable">  
        <thead>  
          <tr>  
            <th>ENO</th>  
            <th>EMPName</th>  
            <th>Country</th>  
            <th>Salary</th>  
          </tr>  
        </thead>  
        <tbody>            
          <tr>  
            <td>002</td>  
            <td>Charles</td>  
            <td>United Kingdom</td>  
            <td>28000</td>  
          </tr>  
          <tr>  
            <td>003</td>  
            <td>Sravani</td>  
            <td>Australia</td>  
            <td>7000</td>  
          </tr>  
          </tr>  
          
        </tbody>  
      </table>  
	  -->
				   <?php
					include_once 'connection.php';
					$result = mysqli_query($conn,"SELECT * FROM tbl_inwards");
					?>

					<?php
					if (mysqli_num_rows($result) > 0) {
					?>
					

					  <table id="inwardsTable" class='table table-bordered table-striped'>
					  <thead>  
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
						<td>Image </td>
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
						<td><?php echo $row["inward_date"]; ?></td>
						<td><?php echo ($row["outward_num_sending_office"])?($row["outward_num_sending_office"]):('N/A'); ?></td>
						<td><?php echo $row["subject"]; ?></td>
						<td><?php echo $row["sender_office"]; ?></td>
						<td><?php echo $row["inward_num_cs_dept"]; ?></td>
						<td><?php echo $row["received_by_cs_dept"]; ?></td>
						<td><?php echo $row["file_name_placed"]; ?></td>
						<td><?php echo $row["file_no_record"]; ?></td>
						<td><?php echo $row["remarks"]; ?></td>
						<td align="center"><img src="<?php echo stripslashes($row["image_url"]); ?>" alt="" width="40" height="40"> </td>   
						
						<td align="center">
							<a href="update_inward.php?id=<?php echo $row["sno"]; ?>" title='Update Record'> 
							<i class='material-icons'><span class='far fa-file' ></span> </i>		
							</a>
							<a onclick='javascript:confirmationDelete($(this));return false;'  href="delete_inward.php?id=<?php echo $row["sno"]; ?>" title='Delete Record'>
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