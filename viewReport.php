<!DOCTYPE html>
<!------------------------------ VIEWREPORT.PHP ------------------------------------
   This file uses the $groupName, $monthName, and $yearNum identifiers to pull all
   entries in the MySQL database that match and auto-populate a monthly report form.
   
   This form has an editable functionality which allows the user to edit, save, and 
   delete content from the View Report page.
------------------------------------------------------------------------------------>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="mystyle.css">
	<meta charset="utf-8">
	<meta name="description" content="A page to view/edit monthly reports">
	<title>View/Edit Monthly Report Form</title>
</head>

<style>
.centerImg{display:block; margin:auto;}
#content{position: relative;}
#content img{position: absolute;top:0px; right:20px;}

body {font: 14px/21px "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif;}
.input_form textarea {padding:8px; width:300px;}
</style>

<?php
include 'start.php';
$groupName = $_REQUEST['groupName'];
$monthName = $_REQUEST['monthName'];
$yearNum = $_REQUEST['yearNum'];

#Grab supervisor name
$result = $con->query("SELECT name FROM users WHERE position='supervisor' AND groupName='$groupName'");
$supe = mysqli_fetch_assoc($result);
?>

<!-- These scripts control the functionality of mouse clicks to performs specific tasks depending on whether the cancel, delete, edit, or save button was selected. -->
<script type="text/javascript" src="modifyReport.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
//----------------------- Delete Function ---------------------------
// Executes functions in delete.php to pseduo-remove entries in database
//-------------------------------------------------------------------
$(document).on('click', '.removebutton', function() {
 var result = confirm("Are you sure you want to delete?");

  if(result == true) {
    var delete_id = $(this).closest('tr').data('id');
    var tableName = $(this).closest('tr').data('table');
    $(this).closest('tr').remove();
	
    $.post("delete.php",
    {
      id: delete_id,
      table: tableName
    },
    function(data, status) {
      alert("Data: " + data + "\nStatus: " + status);
    });
  }
  sleep(500);
  location.reload();
});
</script>

<body>
<!-- Edison Logo -->
<div id="content">
<img src="edisonLogo.png" style="width:180px; height 40px;" class="ribbon/">
</div>

<!-- View Report Header-->
<h1><font face="Lucida Sans Unicode"><center><?php echo $groupName; ?></center></font></h1>
<h2><font face="Lucida Sans Unicode"><center>Monthly Report - <?php echo $monthName . " " . $yearNum; ?></center></font></h2>
<h2><font face="Lucida Sans Unicode"><center><?php echo "{$supe['name']}"; ?></center></font></h2>
<hr>


<?php
#GOAL TABLE DISPLAY
echo "<center><table border='2' width=950 height=10>";
echo "<tr bgcolor=#2184F4><th colspan=8>{$supe['name']} - $groupName</th></tr>";
echo "<tr bgcolor=#58ACF9><th colspan=8>ACTION ITEMS</th></tr>";
echo "<tr bgcolor=#A9F4F6><th>&nbsp;&nbsp;#&nbsp;&nbsp;</th><th>Goals</th><th>Tier</th><th>Date Assigned</th><th>Due Date</th><th>Status</th><th colspan=2>Comments</th></tr>"; //Table header

	if ($result = $con->query("SELECT id, goals, tier, date_assign, date_due, status, comments FROM goals WHERE monthName='$monthName' AND yearNum='$yearNum' AND groupName='$groupName' AND delete_flag='TRUE'")) {
		$i = 1; //Counter for # column
		while ($field = $result->fetch_assoc()) {
			echo "<tr data-table='goals' data-id='$field[id]'><td height=50><center>$i</center></td><td id='goal_val$field[id]'>$field[goals]</td><td align='center' id='tier_val$field[id]'>$field[tier]</td><td id='dateAssign_val$field[id]'>$field[date_assign]</td><td id='dateDue_val$field[id]'>$field[date_due]</td><td align='center' style='font-weight:bold;color:#00cc00' id='status_val$field[id]'>$field[status]</td><td id='comments_val$field[id]'>$field[comments]</td><td width=65>
			
			<input type='image' src='edit.png' style='width:30px;height:30px;' class='edit_button' id='edit_button_goal$field[id]' value='Edit' onclick='edit_goals($field[id])'>
			
			<input type='image' src='delete.png' style='width:30px;height:30px;' class='removebutton' id='delete_button_goal$field[id]' value='Delete'></button>
			<div>
			<input type='hidden' src='save.jpg' style='width:30px;height:30px;' class='save_button' id='save_button_goal$field[id]' value='Save' onclick='save_goals($field[id])'>

			<input type='hidden' src='cancel.png' style='width:28px;height:28px;' class='cancel_button' id='cancel_button_goal$field[id]' value='Cancel' onclick='cancel($field[id])'></td></tr>\r\n";
			$i++;
		}
		$result->free();
	}
echo "</table></center><br/>";

#MONTHLY ACTIVITY TABLE DISPLAY
echo "<center><table border='2' width=950 height=10>";
echo "<tr bgcolor=#58ACF9><th colspan=7>MONTHLY ACTIVITIES</th></tr>";
echo "<tr bgcolor=#A9F4F6><th>&nbsp;&nbsp;#&nbsp;&nbsp;</th><th width=303>Monthly Activities</th><th>Date Assigned</th><th>Due Date</th><th>Status</th><th colspan=2>Comments</th></tr>"; //Table header

	if ($result = $con->query("SELECT id, activities, date_assign, date_due, status, comment FROM monthly_activity WHERE monthName='$monthName' AND yearNum='$yearNum' AND groupName='$groupName' AND delete_flag='TRUE'")) {
		$i = 1; //Counter for # column
		while ($field = $result->fetch_assoc()) {
			echo "<tr data-table='monthly_activity' data-id='$field[id]' height=50><td><center>$i</center></td><td id='act_val$field[id]'>$field[activities]</td><td id='dateAssign_val$field[id]'>$field[date_assign]</td><td id='dateDue_val$field[id]'>$field[date_due]</td><td align='center' style='font-weight:bold;color:#00cc00' id='status_val$field[id]'>$field[status]</td><td id='comments_val$field[id]'>$field[comment]</td><td width=65>
			
			<input type='image' src='edit.png' style='width:30px;height:30px;' class='edit_button' id='edit_button_act$field[id]' value='Edit' onclick='edit_acts($field[id])'>
			
			<input type='hidden' src='save.jpg' style='width:30px;height:30px;' class='save_button' id='save_button_act$field[id]' value='Save' onclick='save_acts($field[id])'>
			
			<input type='image' src='delete.png' style='width:30px;height:30px;' class='removebutton' id='delete_button_act$field[id]' value='Delete'></button>
			
			<input type='hidden' src='cancel.png' style='width:28px;height:28px;' class='cancel_button' id='cancel_button_act$field[id]' value='Cancel' onclick='cancel($field[id])'></td></tr>\r\n";
			$i++;
		}
		$result->free();
	}
echo "</table></center><br/>";

#ACCOMPLISHMENTS TABLE DISPLAY
echo "<center><table border='2' width=950 height=10>";
echo "<tr bgcolor=#58ACF9><th colspan=3>ACCOMPLISHMENTS (Limit to 10 or Under)</th></tr>";

	if ($result = $con->query("SELECT accomp, id FROM accomplishments WHERE monthName='$monthName' AND yearNum='$yearNum' AND groupName='$groupName' AND delete_flag='TRUE'")) {
		$i = 1; //Counter for # column
		while ($field = $result->fetch_assoc()) {
			echo "<tr data-table='accomplishments' data-id='$field[id]'><td width=23 height=10><center>&nbsp;&nbsp;$i&nbsp;&nbsp;</center></td><td id='text_val$field[id]'>$field[accomp]</td><td width=65>
			
			<input type='image' src='edit.png' style='width:30px;height:30px;' class='edit_button' id='edit_button_accomp$field[id]' value='Edit' onclick='edit_accomp($field[id])'>
			
			<input type='hidden' src='save.jpg' style='width:30px;height:30px;' class='save_button' id='save_button_accomp$field[id]' value='Save' onclick='save_accomp($field[id])'>
			
			<input type='image' src='delete.png' style='width:30px;height:30px;' class='removebutton' id='delete_button_accomp$field[id]' value='Delete'></button>
			
			<input type='hidden' src='cancel.png' style='width:28px;height:28px;' class='cancel_button' id='cancel_button_accomp$field[id]' value='Cancel' onclick='cancel($field[id])'></td></tr>\r\n";
			$i++;
		}
		$result->free();
	}
echo "</table></center><br/>";
 
#CONCERNS TABLE DISPLAY
echo "<center><table border='2' width=950 height=10>";
echo "<tr bgcolor=#58ACF9><th colspan=3>CONCERNS (Limit to 4 or Under)</th></tr>";

	if ($result = $con->query("SELECT concern, id FROM concerns WHERE monthName='$monthName' AND yearNum='$yearNum' AND groupName='$groupName' AND delete_flag='TRUE'")) {
		$i = 1; //Counter for # column
		while ($field = $result->fetch_assoc()) {
			echo "<tr data-table='concerns' data-id='$field[id]'><td width=23 height=10><center>&nbsp;&nbsp;$i&nbsp;&nbsp;</center></td><td id='con_val$field[id]'>$field[concern]</td><td width=65>
			
			<input type='image' src='edit.png' style='width:30px;height:30px;' class='edit_button' id='edit_button_con$field[id]' value='Edit' onclick='edit_con($field[id])'>
			
			<input type='hidden' src='save.jpg' style='width:30px;height:30px;' class='save_button' id='save_button_con$field[id]' value='Save' onclick='save_con($field[id])'>
			
			<input type='image' src='delete.png' style='width:30px;height:30px;' class='removebutton' id='delete_button_con$field[id]' value='Delete'></button>
			
			<input type='hidden' src='cancel.png' style='width:28px;height:28px;' class='cancel_button' id='cancel_button_con$field[id]' value='Cancel' onclick='cancel($field[id])'></td></tr>\r\n";
			$i++;
		}
		$result->free();
	}
echo "</table></center><br/>";

#MAJOR ACCOMP TABLE DISPLAY
echo "<center><table table border='2' width=950 height=10>";
echo "<tr bgcolor=#58ACF9><th colspan=3>List Below - One Major/High-Level Accomplishment from Above</th></tr>";
	
	if ($result3 = $con->query("SELECT major_accomp, id FROM major_accomplishments WHERE monthName='$monthName' AND yearNum='$yearNum' AND groupName='$groupName' AND delete_flag='TRUE'")) {
		$row_cnt = $result3->num_rows;
		if ($row_cnt > 0) {
			while ($field = $result3->fetch_assoc()) {
				echo "<tr data-table='major_accomplishments' data-id='$field[id]'><td width=23 height=10><center>1</center></td><td id='maj_accomp_val$field[id]'>$field[major_accomp]</td><td width=65>
			
				<input type='image' src='edit.png' style='width:30px;height:30px;' class='edit_button' id='edit_button_maj_accomp$field[id]' value='Edit' onclick='edit_maj_accomp($field[id])'>
				
				<input type='image' src='delete.png' style='width:30px;height:30px;' class='removebutton' id='delete_button_maj_accomp$field[id]' value='Delete'></button>
				
				<input type='hidden' src='save.jpg' style='width:30px;height:30px;' class='save_button' id='save_button_maj_accomp$field[id]' value='Save' onclick='save_maj_accomp($field[id])'>
				
				<input type='hidden' src='cancel.png' style='width:28px;height:28px;' class='cancel_button' id='cancel_button_maj_accomp$field[id]' value='Cancel' onclick='cancel($field[id])'></td></tr>\r\n";
			}
		} else { ?>
			<tr id="new_major_accomplishment">
				<td width=23 height=10><center>1</center></td>
				<td><input type="text" size="120" id="new_majoraccomp" placeholder="Enter a Major Accomplishment..." required></td>
				<input type="hidden" id="groupName" value="<?php echo $groupName ?>">
				<input type="hidden" id="monthName" value="<?php echo $monthName ?>">
				<input type="hidden" id="yearNum" value="<?php echo $yearNum ?>">
				<td width=40><input type="image" src="save.jpg" style="width:30px;height:30px;" value="Enter" onclick="insert_majoracc()"></td>
			</tr> <?php
		}
		$result3->free();
	}
echo "</table></center><br/>";

#MAJOR CONCERN TABLE DISPLAY
echo "<center><table table border='2' width=950 height=10>";
echo "<tr bgcolor=#58ACF9><th colspan=3>List Below - One Major/High-Level Concern from Above</th></tr>";

	if ($result4 = $con->query("SELECT major_con, id FROM major_concerns WHERE monthName='$monthName' AND yearNum='$yearNum' AND groupName='$groupName' AND delete_flag='TRUE'")) {
		$row_cnt = $result4->num_rows;
		if ($row_cnt > 0) {
			while ($field = $result4->fetch_assoc()) {
				echo "<tr data-table='major_concerns' data-id='$field[id]'><td width=23 height=10><center>1</center></td><td id='maj_con_val$field[id]'>$field[major_con]</td><td width=65>
			
				<input type='image' src='edit.png' style='width:30px;height:30px;' class='edit_button' id='edit_button_maj_con$field[id]' value='Edit' onclick='edit_maj_con($field[id])'>
				
				<input type='image' src='delete.png' style='width:30px;height:30px;' class='removebutton' id='delete_button_maj_con$field[id]' value='Delete'></button>
				
				<input type='hidden' src='save.jpg' style='width:30px;height:30px;' class='save_button' id='save_button_maj_con$field[id]' value='Save' onclick='save_maj_con($field[id])'>
				
				<input type='hidden' src='cancel.png' style='width:28px;height:28px;' class='cancel_button' id='cancel_button_maj_con$field[id]' value='Cancel' onclick='cancel($field[id])'></td></tr>\r\n";
			}
		} else{ ?>
			<tr id="new_major_concern">
				<td width=23 height=10><center>1</center></td>
				<td><input type="text" size = "120" id="new_majorconcern" placeholder="Enter a Major Concern..."></td>
				<input type="hidden" id="groupName" value="<?php echo $groupName ?>">
				<input type="hidden" id="monthName" value="<?php echo $monthName ?>">
				<input type="hidden" id="yearNum" value="<?php echo $yearNum ?>">
				<td width=40><input type="image" src="save.jpg" style="width:30px;height:30px;" value="Enter" onclick="insert_majorcon()"></td>
			</tr> <?php
		}
		$result4->free();
	}
echo "</table></center><br/>";

mysqli_close($con);
?>
<hr>	
<div><a href="http://localhost/home.php"><img class="centerImg" style="width:30px; height 30px;" src="home.png" alt="Home" border="0" /></a></div>
</body>
</html>