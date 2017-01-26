<!DOCTYPE html>
<!------------------------------ MONTHLY REPORT TOOL & DATABASE ---------------------------------
This website automates the monthly report process which allows users to create monthly reports and access previous monthly reports stored in a MySQL database.

Authors: Tanya Wanwatanakool & Penuel Chow
09.20.2016
------------------------------------------------------------------------------------------------>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="A page to create monthly reports.">
	<title>Monthly Report Form</title>
	<style>.error {color: #FF0000;}</style>
</head>

<style>
/* Places Edison Logo in Upper Right */
.centerImg{display:block; margin:auto;}
#content{position:relative;}
#content img{position:absolute; top:-15px; right:20px;}

h1 {margin-left:7px; font-size:35px;}
h2 span {font-size:14px; float:right}
body {background-image: url("background.png"); background-repeat:repeat-x; font:16px/22px "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif;}
fieldset.round {border:2px solid black; border-radius:12px; margin-left:7px; width:500px; box-shadow:3px 3px 3px #888888}

input.green {background-color:#00C900; border-radius:7px; color:white; padding:6px 17px; text-align:center; font-size:14px; font-weight:bold; font-family:Lucida Sans; box-shadow:3px 3px 3px #888888}
.input_form textarea {padding:8px; width:300px;}
input, input::-webkit-input-placeholder {font-size:16px; line-height:1;}
select {font-size:16px; height:1; }
</style>

<body>
<!-- Display Edison Logo -->
<div id="content">
<img src="edisonLogo.png" style="width:180px; height 100px;" class="ribbon/">
</div>

<h1><font face="Lucida Sans Unicode">Monthly Report Site</font></h1>
<hr><br/>
<!-------------------- CREATE MONTHLY REPORT -----------------------
User inputs are sent using the POST method to the COMPARE.PHP file.
	
The following identifers are used for:
	(1) $email, $position - User verification 
	(2) $groupName, $monthName, $yearNum - Identifiers to store/retrieve records in database
<--------------------------------------------------------------------->
<form class="input_form" action="compare.php" method="post">
	<fieldset class="round">
		<h2>Create Monthly Report <span class="error">* <em>required field</em></span></h2>
		<hr>
		
		<span class="error">*</span>Select:
			<input type="radio" name="position" value="supervisor">Supervisor
			<input type="radio" name="position" value="member">TSP
			<br/><br/>
		<span class="error">*</span>Email:&nbsp;&nbsp;<input type="text" name="email" placeholder=" name@sce.com" value="" /><br/><br/>
		<span class="error">*</span>Group:
		<select name="groupName">
			<option value="Apparatus & Maintenance">Apparatus & Maintenance</option>
			<option value="Automation & Commissioning">Automation & Commissioning</option>
			<option value="Relay/Test">Relay/Test</option>
		</select><br/><br/>
		<span class="error">*</span>Month:
		<select name="monthName">
			<option value="Jan">Jan</option>
			<option value="Feb">Feb</option>
			<option value="Mar">Mar</option>
			<option value="Apr">Apr</option>
			<option value="May">May</option>
			<option value="Jun">Jun</option>
			<option value="Jul">Jul</option>
			<option value="Aug">Aug</option>
			<option value="Sept">Sept</option>
			<option value="Oct">Oct</option>
			<option value="Nov">Nov</option>
			<option value="Dec">Dec</option>
		</select>
		&nbsp;&nbsp;&nbsp;<span class="error">*</span>Year:
		<select name="yearNum">
		<?php
			$range = range(2010, date('Y'));
			foreach ($range as $year) {
				echo "<option value='$year'>$year</option>";
			}
		?>
		</select><br/><br/>
	<input type="submit" class="green" name="create" value="Create Report">  
	</fieldset>
</form>
<br/>

<!--------------------- VIEW MONTHLY REPORT --------------------------
User inputs are sent using the GET method to the VIEWREPORT.PHP file.
	
The following identifiers: $groupName, $monthName, $yearNum are used to retrieve records in the database
---------------------------------------------------------------------->
<form action="viewReport.php" method="get">
	<fieldset class="round">
		<h2>View/Edit Monthly Report</h2>
		<hr>
		Group:
		<select name="groupName">
			<option value="Apparatus & Maintenance">Apparatus & Maintenance</option>
			<option value="Automation & Commissioning">Automation & Commissioning</option>
			<option value="Relay/Test">Relay/Test</option>
		</select><br/><br/>
		Month:
		<select name="monthName">
			<option value="Jan">Jan</option>
			<option value="Feb">Feb</option>
			<option value="Mar">Mar</option>
			<option value="Apr">Apr</option>
			<option value="May">May</option>
			<option value="Jun">Jun</option>
			<option value="Jul">Jul</option>
			<option value="Aug">Aug</option>
			<option value="Sept">Sept</option>
			<option value="Oct">Oct</option>
			<option value="Nov">Nov</option>
			<option value="Dec">Dec</option>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Year:
		<select name="yearNum">
		 <?php
			$range = range(2010, date('Y'));
			foreach ($range as $year) {
				echo "<option value='$year'>$year</option>";
			}
		?>
		<select><br/><br/>
	<input type="submit" class="green" value="View Report">  
	</fieldset>
</form>

</body>
</html>
