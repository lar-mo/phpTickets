<?php

// this is the UPDATE.PHP script for http://www.aretemm.net/phpTickets/

require 'db_connect.php';

// require our database connection
// which also contains the check_login.php
// script. We have $logged_in for use.

if ($logged_in == 0) {
	die('
<html>
<head>
<meta http-equiv="refresh" content="0; url=login.php">
</head>
<body>
Sorry you are not logged in, this area is restricted to registered members. <a href="login.php">Click here</a> to log in.
</body>
</html>');
}

// show content

if ($logged_in == 0) {
	die('Sorry you are not logged in, this area is restricted to registered members. <a href="login.php">Click here</a> to log in.');
}

include ("includes/vars.inc");

  $connection = mysqli_connect($DBhost,$DBuser,$DBpass,$DBName);
  if ($connection == false){
    echo mysqli_errno($connection).": ".mysqli_error($connection)."<BR>";
    exit;
  }   


if ($type == 'personnel') {

  if ($emp_title == 'group') {
	$emp_group = '';
  }

  if (strlen($emp_title) < '1') {
	$emp_title = 'tbd';
  }

  		$query = "update $type set emp_name=\"$emp_name\", emp_email=\"$emp_email\", emp_title=\"$emp_title\", emp_group=\"$emp_group\", emp_address=\"$emp_address\", emp_phone_hm=\"$emp_phone_hm\", emp_phone_cell=\"$emp_phone_cell\", emp_notes=\"$emp_notes\" WHERE emp_id=$emp_id";
  		$result = mysqli_query($connection, $query);

  		$query2 = "update users set auth_level='$auth_level' WHERE username='$emp_login'";
  		$result2 = mysqli_query($connection, $query2);

  		if ($result){
    		echo "<html><head><script language=\"JavaScript\">"; include('js/mouseover.js'); print "</script></head><body text=\"#000000\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0>";

			include("includes/topframe.inc"); 
			print "
			<center>
			<table><tr><td align=\"center\"><img src=\"./images/success_logo1.jpg\"></td></tr>
			<tr><td>
			<table border=0 cellpadding=5 width=500 bgcolor=\"#DDDDDD\">
			 <tr>
			  <th>You updated $emp_name's information in the Database.</th>
			 </tr>
			 <tr>
			  <td bgcolor=\"#FFFFFF\" align=\"center\">
				<table>
				 <tr>
				  <td align=\"center\">
				";

				include ('includes/changes.inc');

				print "
				  </td>
				 </tr>
				 <tr>
				  <td align=\"left\">
				<p><ul>
				<li><b>Name</b>: <a href=\"show.php?type=personnel&id=$emp_id\">$emp_name</a></li>
  				<li><b>Email</b>: $emp_email</li>
  				<li><b>Title</b>: $emp_title</li>
  				<li><b>Group</b>: $emp_group</li>
  				<li><b>Address</b>: $emp_address</li>
				<li><b>Home Phone</b>: $emp_phone_hm</li>
  				<li><b>Cell Phone</b>: $emp_phone_cell</li>
				<li><b>Notes</b>: $emp_notes</li>
				<li><b>Auth Level</b>: $auth_level</li>
				<li><b>Login</b>: $emp_login</li>
				</ul>
			  </td>
		 	 </tr>
			</table></td></tr></table>
			</center>
		      </body></html>
		";	

		} else {
    			echo mysqli_errno($connection).": ".mysqli_error($connection)."<BR>";
  		}
		  mysqli_close($connection);

} else {

		if(strlen($proj_due_dt) < '1') { $proj_due_dt = '12/31/2010'; }
		if(strlen($parent_id) < '1') { $parent_id = '0'; }

		include('includes/changes_notes.inc');

		$new_notes = "Updated by <u>".$_SESSION['username']."</u> on <u>".$proj_update_dt."</u>";
		$new_notes .= "<br>";
		$new_notes .= $proj_notes;

		$proj_notes3 = strip_tags($proj_notes2);
		$mail_proj_notes = $proj_notes3;

  		$query1 = "update projects set proj_name=\"$proj_name\", proj_submitter=\"$proj_submitter\", proj_status=\"$proj_status\", proj_type=\"$proj_type\", proj_desc=\"$proj_desc\", proj_notes=concat_ws('<br><br>',proj_notes,'$new_notes'), proj_assignee=\"$proj_assignee\", proj_priority=\"$proj_priority\", proj_update_dt=\"$proj_update_dt\", proj_due_dt=\"$proj_due_dt\" WHERE proj_id=$proj_id";
  		$result1 = mysqli_query($connection, $query1);

		$query2 = "update parent_child_rel set parent=\"$parent_id\" WHERE child=$proj_id";
		mysqli_query($connection, $query2);

  		if ($result1){
    		echo "<html><head><script language=\"JavaScript\">"; include('js/mouseover.js'); print "</script></head><body text=\"#000000\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0>";

			include("includes/topframe.inc");
			print "
			<center>
			<table width=\"500\"><tr><td align=\"center\"><img src=\"./images/success_logo1.jpg\"></td></tr>
			<tr><td>
			<table border=0 cellpadding=5 width=500 bgcolor=\"#DDDDDD\">
			 <tr>
			  <th>You updated Project #$proj_id in the Database.</th>
			 </tr>
			 <tr>
			  <td bgcolor=\"#FFFFFF\" align=\"center\">
				<table>
				 <tr>
				  <td align=\"center\">
				";

				include ('includes/changes.inc');

				print "
				  </td>
				 </tr>
				 <tr>
				  <td align=\"left\" width=\"400\">
				<p><ul>
	   			<li><b>Title</b>: <a href=\"show.php?type=projects&id=$proj_id\">$proj_name2</a></li>
	   			<li><b>Create Date</b>: $proj_create_dt</li>
	   			<li><b>Submitter</b>: $proj_submitter</li>
	   			<li><b>Status</b>: $proj_status</li>
	   			<li><b>Due Date</b>: $proj_due_dt</li>
	   			<li><b>Priority</b>: $proj_priority</li>
	   			<li><b>Assignee</b>: $proj_assignee</li>
	   			<li><b>Type</b>: $proj_type</li>
	   			<li><b>Description</b>: $proj_desc2</li>
	   			<li><b>Your Notes</b>: $proj_notes2</li>
				<li><b>Cc List</b>: $cc_list</li>
	   			<li><b>Related Tickets</b>: ";


$sqlquery2 = "SELECT parent FROM parent_child_rel WHERE child = $proj_id";
$result2 = mysqli_query($connection, $sqlquery2);
$number2 = @mysqli_num_rows($result2);

	if ($number2 > 0) {

	  while ($row2 = mysqli_fetch_assoc($result2)) {

         $theproj_parent = $row2["parent"];
			
	if($theproj_parent > 0) {	

	 echo "<a href=\"list_project.php?parent_id=$theproj_parent\">$theproj_parent</a> <font size=\"-1\">(parent)</font>";

	}

	  }

	}


$sqlquery3 = "SELECT child FROM parent_child_rel WHERE parent = $proj_id";
$result3 = mysqli_query($connection, $sqlquery3);
$number3 = @mysqli_num_rows($result3);
$k = 0;

	if ($number3 > 0) {

	  if ($theproj_parent > 0) { echo "&nbsp;|&nbsp;"; }

	  while ($row3 = mysqli_fetch_assoc($result3)) {

         	$theproj_child = $row3["child"];	

		echo "<a href=\"show.php?type=projects&id=$theproj_child\">$theproj_child</a>";

		if ($number3 - 1 == $k) {
		echo "";
		} else {
		echo ", ";
		}

	  $k++;

	  }

		if($k == '1') {
			print " <font size=\"-1\">(child)</font>";
		} else { 
			print " <font size=\"-1\">(children)</font>";
		}

	}


print "</li>
				</ul>
				  </td>
				 </tr>
				</table>
			  </td>
		 	 </tr>
			</table></td></tr></table>
			<font size=\"-1\"><i>Last updated on $proj_update_dt</i></font><p>
			</center><br>
		     </body></html>
";
		
		include ('includes/mail.inc');

		} else {
    			echo mysqli_errno($connection).": ".mysqli_error($connection)."<BR>";
  		}
		  mysqli_close($connection);

}


$db_object->disconnect();
// when you are done.

?>
