<?php
#----------------------------- update.php ------------------------------
# This is the logic to update MySQL entries in the database. It allows 
# users to modify records in the database through the webpage GUI.
#
#  **The functionality of this file is heavily dependent on:
# 	(1) data-id - identifies entry in MySQL
#	(2) POST method - identifies the table in MySQL
#-----------------------------------------------------------------------
include 'start.php';

if(isset($_POST['edit_goals'])) { //UPDATES GOAL VALUES
 $row=$_POST['row_id'];
 $goal=$_POST['goal_val'];
 $tier=$_POST['tier_val'];
 $dateAssign=$_POST['dateAssign_val'];
 $dateDue=$_POST['dateDue_val'];
 $status=$_POST['status_val'];
 $comment=$_POST['comment_val'];
 
 if (mysqli_query($con, "UPDATE goals SET goals='$goal', tier='$tier', date_assign='$dateAssign', date_due='$dateDue', status='$status', comments='$comment'  WHERE id='$row'")) {
	print "Success";
 } else {
	print "Error, not updated.";
 }
 exit();
}

if(isset($_POST['edit_acts'])) { //UPDATES MONTHLY ACTIVITY VALUES
 $row=$_POST['row_id'];
 $act=$_POST['act_val'];
 $dateAssign=$_POST['dateAssign_val'];
 $dateDue=$_POST['dateDue_val'];
 $status=$_POST['status_val'];
 $comment=$_POST['comment_val'];
 
 if (mysqli_query($con, "UPDATE monthly_activity SET activities='$act', date_assign='$dateAssign', date_due='$dateDue', status='$status', comment='$comment'  WHERE id='$row'")) {
	print "Success";
 } else {
	print "Error, not updated.";
 }
 exit();
}

if(isset($_POST['edit_accomp'])) { //UPDATES ACCOMPLISHMENT VALUE
 $row=$_POST['row_id'];
 $text=$_POST['text_val'];
 
 if (mysqli_query($con, "UPDATE accomplishments SET accomp='$text' WHERE id='$row'")) {
	print "Success";
 } else {
	print "Error, not updated.";
 }
 exit();
}

if(isset($_POST['edit_con'])) { //UPDATES CONCERN VALUE
 $row=$_POST['row_id'];
 $concern=$_POST['con_val'];
 
 if (mysqli_query($con, "UPDATE concerns SET concern='$concern' WHERE id='$row'")) {
	print "Success";
 } else {
	print "Error, not updated.";
 }
 exit();
}

if(isset($_POST['insert_majoracc'])) //(FIRST-TIME) INSERT INTO MAJOR ACCOMPLISHMENTS TABLE
{
 $majoracc=$_POST['major_acc_val'];
 $groupName=$_POST['groupName_val'];
 $monthName=$_POST['monthName_val'];
 $yearNum=$_POST['yearNum_val'];
 mysqli_query($con, "insert into major_accomplishments (groupName, major_accomp, monthName, yearNum, delete_flag) values('$groupName','$majoracc', '$monthName', '$yearNum', 'TRUE')");
 exit();
}

if(isset($_POST['edit_maj_accomp'])) { //UPDATES MAJOR ACCOPMPLISHMENT VALUE
 $row=$_POST['row_id'];
 $text=$_POST['maj_accomp_val'];
 
 if (mysqli_query($con, "UPDATE major_accomplishments SET major_accomp='$text' WHERE id='$row'")) {
	print "Success";
 } else {
	print "Error, not updated.";
 }
 exit();
}

if(isset($_POST['insert_majorcon'])) //(FIRST-TIME) INSERT INTO MAJOR CONCERNS TABLE
{
 $majorconcern=$_POST['major_concern_val'];
 $groupName=$_POST['groupName_val'];
 $monthName=$_POST['monthName_val'];
 $yearNum=$_POST['yearNum_val'];
 mysqli_query($con, "insert into major_concerns (groupName, major_con, monthName, yearNum, delete_flag) values('$groupName','$majorconcern', '$monthName', '$yearNum', 'TRUE')");
 exit();
}

if(isset($_POST['edit_maj_con'])) { //UPDATES MAJOR CONCERN VALUE
 $row=$_POST['row_id'];
 $maj_con=$_POST['maj_con_val'];
 
 if (mysqli_query($con, "UPDATE major_concerns SET major_con='$maj_con' WHERE id='$row'")) {
	print "Success";
 } else {
	print "Error, not updated.";
 }
 exit();
}
?>