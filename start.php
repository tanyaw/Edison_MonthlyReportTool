<?php 
#------------------ Start.php ----------------------
# There is no html page.
# Start.php establishes the database connection and
# is included in specific pages to improve user 
# readability
#---------------------------------------------------
$con= new mysqli("localhost", "root", "password", "reports");
if($con->connect_error){
	die("Connection failed: " . $con->connect_error);
}

#DEBUGGING, prints content of POST array
  #print_r($_POST);
  #echo "<br/><br/>";
?>