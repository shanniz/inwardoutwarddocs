<?php
include_once 'connection.php';
$sql = "DELETE FROM tbl_senderoffice WHERE sno='" . $_GET["id"] . "'";
if (mysqli_query($conn, $sql)) {
   header("location: settings.php");
   exit();
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>