<!DOCTYPE html>
<!-------------------------------- SUPE_VALS.PHP ------------------------------------
   This file takes and stores the Supervisor input fields (goals & monthly activities) 
   into the MySQL database tables.
   
   A submission page returns if the user successfully inputs their information.
   An error page returns if the user made a mistake during input.
----------------------------------------------------------------------------------->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Takes supervisor input goals/activities and inserts to database.">
	<title>Submit Supervisor input</title>
</head> 

<style>
.centerImg{display:block; margin:auto;}
#content{position: relative;}
#content img{position: absolute; top:-38px; right:20px;}

h1 {font-size: 35px;}
body {background-image: url("background.png"); background-repeat: repeat-x; font: 14px/21px "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif;}
.input_form h2, .input_form label {font-family:Georgia, Times, "Times New Roman", serif;}
.input_form textarea {padding:8px; width:300px;}
</style>

<body>
<h1>Submitted Monthly Report Form<span><div id="content">
<img src="edisonLogo.png" style="width:180px; height 100px;" class="ribbon/">
</div></span></h1><hr>


<?php
include 'start.php';
$groupName = $_REQUEST['groupName'];
$monthName = $_REQUEST['monthName'];
$yearNum = $_REQUEST['yearNum'];
	
if(isset($_POST["goalArray"]) && is_array($_POST["goalArray"])){  #INSERT GOAL VALUES
	/*Arrays are associative, must establish a key instead of an index to obtain the value.
	We use the same key to grab a row from the goals table each time in the foreach loop. */
	foreach($_POST["goalArray"] as $key => $goal){
		$tier = $_POST["tierArray"][$key];
		$date_assign = $_POST["dateAssign"][$key];
		$date_due = $_POST["dateDue"][$key];
		$status = $_POST["statusArray"][$key];
		$comments = $_POST["commentArray"][$key];
		
		$insert_row = "INSERT INTO goals(goals, tier, date_assign, date_due, status, comments, groupName, monthName, yearNum, delete_flag) VALUES('$goal', '$tier', '$date_assign', '$date_due', '$status', '$comments', '$groupName', '$monthName', '$yearNum', 'TRUE')"; //Adds a row to goals in MySQL database
		
		if(mysqli_query($con, $insert_row)){  //DEBUGGING PURPOSES
			#print "<u>THESE FIELDS HAVE BEEN SUBMITTED:</u><br/>";
			#print "<b>GOAL:</b> " . $goal . "<br/>";
			#print "<b>TIER:</b> " . $tier . "<br/>";
			#print "<b>DATE ASSIGN:</b> " . $date_assign . "<br/>";
			#print "<b>DATE DUE:</b> " . $date_due . "<br/>";
			#print "<b>STATUS:</b> " . $status . "<br/>";
			#print "<b>COMMENTS:</b> " . $comments . "<br/>";
		} else {
			print "Your form was not submitted. Please return to the home page and resubmit your form.";
		} 
    }
}

if(isset($_POST["monthlyActivity"]) && is_array($_POST["monthlyActivity"])){ #INSERT MONTHLY ACTIVITY VALUES
	/*Arrays are associative, must establish a key instead of an index to obtain the value.
	We use the same key to grab a row from the activities table each time in the foreach loop.*/
    foreach($_POST["monthlyActivity"] as $key => $activity){
		$date_assign2 = $_POST["dateAssign2"][$key];
		$date_due2 = $_POST["dateDue2"][$key];
		$status2 = $_POST["statusArray2"][$key];
		$comments2 = $_POST["commentArray2"][$key];
		
		$insert_row = "INSERT INTO monthly_activity(activities, date_assign, date_due, status, comment, groupName, monthName, yearNum, delete_flag) VALUES('$activity', '$date_assign2', '$date_due2', '$status2', '$comments2', '$groupName', '$monthName', '$yearNum', 'TRUE')"; //Adds a row to monthly activities in MySQL database
		
		if(mysqli_query($con, $insert_row)){  //DEBUGGING PURPOSES
			#print "<u>THESE FIELDS HAVE BEEN SUBMITTED:</u><br/>";
			#print "<b>ACTIVITY:</b> " . $activity . "<br/>";
			#print "<b>DATE ASSIGN:</b> " . $date_assign2 . "<br/>";
			#print "<b>DATE DUE:</b> " . $date_due2 . "<br/>";
			#print "<b>STATUS:</b> " . $status2 . "<br/>";
			#print "<b>COMMENTS:</b> " . $comments2 . "<br/>";
		} else {
			print "Your form was not submitted. Please return to the home page and resubmit your form.";
		} 
    }
}

mysqli_close($con);

print "Your accomplishments and concerns have been successfully submitted.";
?>
<hr>	
<div><a href="http://localhost/home.php"><img class="centerImg" style="width:30px; height 30px;" src="home.png" alt="Home" border="0" /></a></div>

</body>
</html>