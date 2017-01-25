<!DOCTYPE html>
<!-------------------------------- TSP_VALS.PHP ------------------------------------
   This file takes and stores the TSP user input fields (accomplishments & concerns) 
   into the MySQL database tables. 
   
   A submission page returns if the user successfully inputs their information.
   An error page returns if the user made a mistake during input.
----------------------------------------------------------------------------------->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Takes TSP input accomplishments/concerns and inserts to database.">
	<title>Submit tsp input</title>
</head>

<style>
.centerImg{display:block; margin:auto;}
#content{position: relative;}
#content img{position: absolute; top:-38px; right:20px;}

h1 {font-size: 35px;}
body {background-image:url("background.png"); background-repeat: repeat-x; font: 14px/21px "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif;}
.input_form h2, .input_form label {font-family:Georgia, Times, "Times New Roman", serif;}
.input_form textarea {padding:8px; width:300px;}
</style>
 
<body>
<h1>Submitted Monthly Report Form <span><div id="content">
<img src="edisonLogo.png" style="width:180px; height 100px;" class="ribbon/">
</div></span></h1><hr>


<?php
include 'start.php';
$groupName = $_REQUEST['groupName'];
$monthName = $_REQUEST['monthName'];
$yearNum = $_REQUEST['yearNum'];

if(isset($_POST["accompArray"]) && is_array($_POST["accompArray"])){ #INSERT ACCOMPLISHMENTS VALUE
	/*Arrays are associative, must establish a key instead of an index to obtain the value.
	  Use key to grab an entry from the accomplishments table each time in foreach loop. */
    foreach($_POST["accompArray"] as $key => $accomp){
		$insert_row = "INSERT INTO accomplishments(accomp, groupName, monthName, yearNum, delete_flag) VALUES('$accomp', '$groupName', '$monthName', '$yearNum', 'TRUE')"; //Adds a row to accomplishments in MySQL database
		
		if(mysqli_query($con, $insert_row)){  //DEBUGGING PURPOSES
			#print "<u>THESE FIELDS HAVE BEEN SUBMITTED:</u><br/>";
			#print "\t" . $accomp . "<br/>";
			#print "--------------------------------------------<br/>";
		} else {
			print "Your form was not submitted. Please return to the home page and resubmit your form.";
		} 
    }
}

if(isset($_POST["concernArray"]) && is_array($_POST["concernArray"])){ #INSERT CONCERN VALUE
	/*Arrays are associative, must establish a key instead of an index to obtain the value.
	  We use the same key to grab a row from the concerns table each time in the foreach loop. */
    foreach($_POST["concernArray"] as $key => $concern){
		$insert_row = "INSERT INTO concerns(concern, groupName, monthName, yearNum, delete_flag) VALUES('$concern', '$groupName', '$monthName', '$yearNum', 'TRUE')"; //Adds a row to concerns in MySQL database
		
		if(mysqli_query($con, $insert_row)){  //DEBUGGING PURPOSES
			#print "<u><br/>THESE FIELDS HAVE BEEN SUBMITTED:</u><br/>";
			#print "\t" . $concern . "<br/>";
			#print "--------------------------------------------<br/>";
		} else {
			print "Your form was not submitted. Please return to the home page and resubmit your form.";
		} 
    }
}
mysqli_close($con);
?>

<p><font size="3">Your accomplishments and concerns have been successfully submitted.</font></p>
<hr>
<div><a href="http://localhost/home.php"><img class="centerImg" style="width:30px; height 30px;" src="home.png" alt="Home" border="0" /></a></div>

</body>
</html>