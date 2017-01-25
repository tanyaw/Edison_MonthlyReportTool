<!DOCTYPE html>
<!--------------------------------- COMPARE.PHP ------------------------------------
   This page displays the TSP or supervisor form depending on the user's position.
   After the user submits his/her form, the user input fields are passed through the
   POST method to the TSP_VALS.PHP or SUPE_VALS.PHP files.
------------------------------------------------------------------------------------>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Determines supervisor or TSP page and takes user input.">
	<title>Create Report</title>
</head> 

<style>
.centerImg{display:block; margin:auto;}
#content{position:relative;}
#content img{position: absolute; top:-13px; right:20px;}

h1 {margin-left: 7px; font-size: 35px;}
body {background-image:url("background.png"); background-repeat:repeat-x; font:16px/21px "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif;}

fieldset.round3 {border:2px solid black; border-radius:12px; margin-left:4px; width:1000px; box-shadow: 3px 3px 3px #888888}
fieldset.round2 {border:2px solid black; border-radius:12px; margin-left:4px; width:500px; box-shadow:3px 3px 3px #888888}
.input_form h2, .input_form label {font-family:Georgia, Times, "Times New Roman", serif;}
.input_form textarea {padding:8px; width:300px;}
input.normie {border-radius:7px; color:black; padding:6px 17px; text-align:center; font-size:17px; font-weight:bold; font-family:Lucida Sans; box-shadow:3px 3px 3px #888888}

button {margin-top:8px; border-radius:7px; color:black; top:5px; padding:4px 8px; text-align:center; font-size:14px; font-family:Lucida Sans; box-shadow:3px 3px 3px #888888}
</style>

<body>
<?php  error_reporting(0); #Forces errors to stop displaying, remove to debug ?> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
//----------------------------- javascript functions --------------------------------
// These functions dictate the utility of mouse clicks to perform specific tasks 
// depending on whether the add or delete button is selected.
//
// INIT/"ADD" FUNCTION - Adds an input textbox upon user seletcion, stores all user input
//					     in an array
// "REMOVE" FUNCTION - Removes the selected input textbox
//----------------------------------------------------------------------------------
$(document).ready(function() {
		//FUNCTION CALLS TO GENERATE AND STORE MEMEBER INPUT FIELDS
        init_tsp_fields(10, '.input_fields_wrap', '.add_field_button', 'accompArray[]');
		init_tsp_fields(10, '.input_fields_wrap2', '.add_field_button2', 'concernArray[]');
		
		function init_tsp_fields(max, wrap, butt, fname_p) {
            var max_fields = max; //Maximum input boxes allowed
            var wrapper = $(wrap); //Fields wrapper
            var add_button = $(butt); //Add button class
            var fname = fname_p; //Refers to array in function call

            var x = 1; //Text box counter
            $(add_button).click(function (e) { //When user clicks on add button
                e.preventDefault();
                if (x < max_fields) { //Max input box allowed
                    x++; //Counter increment

                    $(wrapper).append('<tr><td><textarea placeholder="Input Here..." name=' + fname + ' rows="5" cols="60"></textarea></td><td><input type="image" src="delete.png" style="width:30px;height:30px;" class="remove_field" title="remove this row"></td></tr>'); //Add input box
                }
            });

            $(wrapper).on("click", ".remove_field", function (e) { //When user clicks on remove button
                e.preventDefault();
                $(this).closest('tr').remove(); //Remove input box
                x--; //Counter decrement
            })
        }
		
		/*Function call to generate and store supervisor goals input fields
		  The following arrays store each column of the supervisor table*/
		init_supe_goals(100, '.input_fields_wrap3', '.add_field_button3', 'goalArray[]', 'tierArray[]', 'dateAssign[]', 'dateDue[]', 'statusArray[]', 'commentArray[]');
		
		function init_supe_goals(max, wrap, butt, fname1, fname2, fname3, fname4, fname5, fname6) {
            var max_fields = max; //Maximum input boxes allowed
            var wrapper = $(wrap); //Fields wrapper
            var add_button = $(butt); //Add button class			

            var x = 1; //Text box counter
            $(add_button).click(function (e) { //On add input button click
                e.preventDefault();
                if (x < max_fields) {
                    x++; //Counterincrement
					
                    $(wrapper).append('<tr><td><textarea placeholder="Enter Goal" name=' + fname1 + ' rows="5" cols="40"></textarea></td><td><textarea placeholder="Enter Tier" name=' + fname2 + ' rows="5" cols="5"></textarea></td><td><textarea placeholder="Enter Date Assigned" name=' + fname3 + ' rows="5" cols="15"></textarea></td><td><textarea placeholder="Enter Date Due" name=' + fname4 + ' rows="5" cols="15"></textarea></td><td><textarea placeholder="Enter Status" name=' + fname5 + ' rows="5" cols="10"></textarea></td><td ><textarea placeholder="Enter Comment" name=' + fname6 + ' rows="5" cols="40"></textarea></td><td><input type="image" src="delete.png" style="width:30px;height:30px;" class="remove_field" title="remove this row"></td></tr>'); //add input box
                }
            });

            $(wrapper).on("click", ".remove_field", function (e) { //When user clicks on remove text
                e.preventDefault();
                $(this).closest('tr').remove(); //Remove input box
                x--; //Counter decrement
            })
        }
		
		/*Function call to generate and store supervisor monthly activity input fields
		  The following arrays store each column of the supervisor table*/
		init_supe_activity(100, '.input_fields_wrap4', '.add_field_button4', 'monthlyActivity[]', 'dateAssign2[]', 'dateDue2[]', 'statusArray2[]', 'commentArray2[]');
		
		function init_supe_activity(max, wrap, butt,  fname1, fname2, fname3, fname4, fname5) {
            var max_fields = max; //Maximum input boxes allowed
            var wrapper = $(wrap); //Fields wrapper
            var add_button = $(butt); //Add button class

            var x = 1; //Text box counter
            $(add_button).click(function (e) { //On add input button click
                e.preventDefault();
                if (x < max_fields) {
                    x++; //Counter increment
					
                    $(wrapper).append('<tr><td><textarea placeholder="Enter Monthly Activities" name=' + fname1 + ' rows="5" cols="40"></textarea></td><td><textarea placeholder="Enter Date Assigned" name=' + fname2 + ' rows="5" cols="17"></textarea></td><td><textarea placeholder="Enter Date Due" name=' + fname3 + ' rows="5" cols="17"></textarea></td><td><textarea placeholder="Enter Status" name=' + fname4 + ' rows="5" cols="11"></textarea></td><td><textarea placeholder="Enter Comments" name=' + fname5 + ' rows="5" cols="45"></textarea></td><td><input type="image" src="delete.png" style="width:30px;height:30px;" class="remove_field" title="remove this row"></td></tr>'); //add input box
                }
            });

            $(wrapper).on("click", ".remove_field", function (e) { //When user clicks on remove text
                e.preventDefault();
                $(this).closest('tr').remove(); //Remove input box
                x--; //Counter decrement
            })
        }
    });
</script>

<?php
include 'start.php';
// Post user inputs from HOME.PHP
$position = $_POST["position"];
$groupName = $_POST["groupName"];
$email = $_POST["email"];
$monthName = $_POST["monthName"];
$yearNum = $_POST["yearNum"];

// Grab user's name and group from MySQL
$result = $con->query("SELECT name, groupName FROM users WHERE email='$email'");
while( $field = $result->fetch_assoc() ) {
	$nam = $field[name];
}

#----------------------ADD USER INTO DATABASE----------------------
# (1) Uncomment block below to add new user from home page
# (2) Go directly to MySQL database and insert user from console
#
/* $add = "INSERT INTO users(position, email, groupName) VALUES('$position', '$email', '$groupName')";

if (mysqli_query($con, $add)) {
	echo "New record created successfully";
} else {
	mysqli_error($con);
}
*/
#------------------END OF ADD USER TO DATABASE---------------------

#-------------------USER VERIFICATION--------------------
# Use email, group, and position input to check database 
# if user is part of system and if they inputted the 
# correct field.	
#--------------------------------------------------------
$test = $con->query("SELECT email FROM users WHERE email='$email' AND groupName='$groupName' AND position='$position'");
if($user = mysqli_fetch_assoc($test)) {
	
	#------------------COMPARE FUNCTION--------------------
	# This if-else clause checks the user's position, then 
	# switches to the form for the specific position.
	#------------------------------------------------------
	if ($_POST["position"] == "supervisor") { ?>
			<br/>
			<form action="supe_vals.php" method="post">
			<fieldset class="round3" width="1000px;">
				<h1>Create Monthly Report (<?php echo $nam; ?>)</h1>
				<hr><br/>
				
				<!-- GOALS TABLE DISPLAY -->
				<table border='2' width=1130 height=10 class="input_fields_wrap3">
				<?php echo "<tr bgcolor=#2184F4><th colspan=7>$groupName - Goals</th></tr>" ?>
				<tr bgcolor=#A9F4F6 width=1130 height=10>
					<th width=300>Goal</th>
					<th>Tier</th>
					<th>Date Asisgned</th>
					<th>Due Date</th>
					<th>Status</th>
					<th colspan=2 width=230>Comment</th>
				</tr>
				</table>
				<button class="add_field_button3">Add Goals</button><br/><br/>
				<!-- 
				1. Change "Add Goals" button class="add_field_button3" to class="input_fields_wrap3" This will go to the init_supe_goals function.
				1.5 Upon click, "Add Goals" should generate a table with 4 blank rows.
				2. Requires more init_supe_goals function calls...
				-->
				
				<!-- MONTHLY ACTIVITIES TABLE DISPLAY -->
				<table border='2' width=1130 height=10 class="input_fields_wrap4">
					<?php echo" <tr bgcolor=#2184F4><th colspan=6>$groupName - Monthly Activities</th></tr>" ?>
					<tr bgcolor=#A9F4F6 width=1130 height=10>
						<th width=320>Monthly Activities</th>
						<th>Date Asisgned</th>
						<th>Due Date</th>
						<th>Status</th>
						<th colspan=2 width=235>Comment</th>
					</tr>
					</table>
					<button class="add_field_button4">Add Activities</button><br/>
			</fieldset>
			
			<!-- **Hidden variables -->
			<input type="hidden" name="groupName" value="<?php echo $_POST['groupName']; ?>">
			<input type="hidden" name="monthName" value="<?php echo $_POST['monthName']; ?>">
			<input type="hidden" name="yearNum" value="<?php echo $_POST['yearNum']; ?>">
			
			<br/><input type="submit" class="normie" value="SUBMIT">
			</form>
			
			<br/><hr>
			<a href="http://localhost/home.php"><img class="centerImg" style="width:30px; height 30px;" src="home.png" alt="Home" border="0" /></a>
			
		<?php } else { ?> 
			<br/>
			<form action="tsp_vals.php" method="post">
			<fieldset class="round2">
				<h1> Create Monthly Report </h1>
				<hr><br/>

				<!-- ACCOMPLISHMENTS TABLE DISPLAY -->
				<table border='2' width=500 height=10 class="input_fields_wrap">
					<tr bgcolor=#58ACF9><th colspan=2><?php echo $nam; ?> - Accomplishments</th></tr>
				</table>
				<button class="add_field_button">Add Accomplishments</button><br/><br/>

				<!-- CONCERNS TABLE DISPLAY -->
				<table border='2' width=500 height=10 class="input_fields_wrap2">
					<tr bgcolor=#58ACF9><th colspan=2><?php echo $nam; ?> - Concerns</th></tr>
				</table>
				<button class="add_field_button2">Add Concerns</button><br/><br/>
			</fieldset>
			
			<!-- **Hidden variables -->
			<input type="hidden" name="groupName" value="<?php echo $_POST['groupName']; ?>">
			<input type="hidden" name="monthName" value="<?php echo $_POST['monthName']; ?>">
			<input type="hidden" name="yearNum" value="<?php echo $_POST['yearNum']; ?>">
			
			<br/><input type="submit" class="normie" value="SUBMIT">
			</form>
			
			<br/><hr><a href="http://localhost/home.php"><img class="centerImg" style="width:30px; height 30px;" src="home.png" alt="Home" border="0" /></a>
		<?php } 
} else { ?>
	<!-------------------------INPUT VERIFICATION--------------------------
	   Returns user to homepage if they selected invalid user information 
	----------------------------------------------------------------------->
	<style>
	.centerImg{display:block; margin:auto;}
	#content{position: relative;}
	#content img{position: absolute; top:-38px; right:20px;}

	h1 {font-size: 35px;}
	background-image: url("background.png"); background-repeat: repeat-x;
	</style>
	
	<h1>Error <span><div id="content"><img src="edisonLogo.png" style="width:180px; height 100px;" class="ribbon/"></div></span></h1><hr>

	<p><font size="3">You may have inputted the wrong email, selected the wrong group/position, or this user may not exist in the database yet. <br/><b>Please return to the home page.</b></font><br/></p>
	<hr>
	<div><a href="http://localhost/home.php"><img class="centerImg" style="width:30px; height 30px;" src="home.png" alt="Home" border="0" /></a></div>
<?php }

mysqli_close($con);
?>
</body>
</html>