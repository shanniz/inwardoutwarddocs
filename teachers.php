
<?php
// Initialize the session
session_start(); 
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Teachers</title>
<?php include "head.php"; ?>

<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#teacherTable').dataTable(); 
			document.getElementById("navTeachers").className += " active"
        });
    </script>


<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<style>
    .bsheader{
        <!--margin: 20px;-->
    }
</style>
</head>
<body>

		<?php include "header.php"; ?>

        <div class="container">
			<div class="col-lg-12 mx-auto">
				<div class="page-header clearfix">
					<h2 class="pull-left">Registered Teachers</h2>
					<a href="create_teacher.php" class="btn btn-success pull-right">Add New Teacher</a>
				</div>
				<div><p></p></div>
			   <?php
				include_once 'connection.php';
				$result = mysqli_query($conn,"SELECT * FROM tbl_teachers");
				?>

				<?php
				if (mysqli_num_rows($result) > 0) {
				?>
				<table id="usersTable" class='table table-bordered table-striped'>
					<thead>
					  <tr>
						<td>Name</td>										
						<td>Phone</td>					
						<td>Email</td>	
						<td>Designation</td>					
						<td>Department</td>							
						<td>Action</td>
					  </tr>
					</thead>
					<tbody>
				<?php
				$i=0;
				while($row = mysqli_fetch_array($result)) {
				?>
						<tr>
							<td><?php echo $row["name"]; ?></td>
							<td><?php echo $row["phone"]; ?></td>					
							<td><?php echo $row["email"]; ?></td>					
							<td><?php echo $row["designation"]; ?></td>					
							<td><?php echo $row["department"]; ?></td>					
							<td>						
								<a href="update_teacher.php?id=<?php echo $row["id"]; ?>" title='Update Record'> 
									<i class='material-icons'><span class='far fa-file' ></span> </i>		
								</a>
								<a href="delete_teacher.php?id=<?php echo $row["id"]; ?>" title='Delete Record'>
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

</body>
</html>