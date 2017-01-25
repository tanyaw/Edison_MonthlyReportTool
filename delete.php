<?php
#--------------------------- delete.php -------------------------------
# This is the logic to remove MySQL entries from the database. It
# pseudo-removes a MySQL entry by toggling a Boolean delete_flag 
# in the database from TRUE to FALSE.
#     TRUE = not deleted		FALSE = deleted
# 
# This prevents users without admin privileges from removing curcial 
# information, the database administrator will be able to go into the 
# database and manually retrieve or clear these entries.
#
#  **The functionality of this file is heavily dependent on:
# 	(1) data-id - identifies entry in MySQL
#	(2) data-table - identifies the table in MySQL
#-----------------------------------------------------------------------
include 'start.php';
$delete_id = $_POST['id'];
$table = $_POST['table'];

if ($table == "concerns") { //"DELETES" CONCERN VALUE
	if(mysqli_query($con, "UPDATE concerns SET delete_flag='FALSE' WHERE id='$delete_id'")) {
		print "This entry was deleted.";
	} else {
		print "This was not deleted.";
	}
} elseif ($table == 'accomplishments') { //"DELETES" ACCOMPLISHMENT VALUE
	if(mysqli_query($con, "UPDATE accomplishments SET delete_flag='FALSE' WHERE id='$delete_id'")) {
		print "This entry was deleted.";
	} else {
		print "This was not deleted.";
	}
} elseif($table == 'monthly_activity') { //"DELETES" MONTHLY ACTIVITY VALUE
	if(mysqli_query($con, "UPDATE monthly_activity SET delete_flag='FALSE' WHERE id='$delete_id'")) {
		print "This entry was deleted.";
	} else {
		print "This was not deleted.";
	}
} elseif($table == 'major_accomplishments') { //"DELETES" MAJOR ACCOMPLISHMENT VALUE
	if(mysqli_query($con, "UPDATE major_accomplishments SET delete_flag='FALSE' WHERE id='$delete_id'")) {
		print "This entry was deleted.";
	} else {
		print "This was not deleted.";
	}
} elseif($table == 'major_concerns') { //"DELETES" MAJOR CONCERN VALUE
	if(mysqli_query($con, "UPDATE major_concerns SET delete_flag='FALSE' WHERE id='$delete_id'")) {
		print "This entry was deleted.";
	} else {
		print "This was not deleted.";
	}
} else { //"DELETES" GOAL VALUE
	if(mysqli_query($con, "UPDATE goals SET delete_flag='FALSE' WHERE id='$delete_id'")) {
		print "This entry was deleted.";
	} else {
		print "This was not deleted.";
	}
}
?>