<?php

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

print "
<html>
<head><title>Project Management</title>

<script language=\"JavaScript1.2\">

<!-- Hide

function open_window(mypage, myname, w, h, scroll, resize) {
	var winl = (screen.width - w) / 2;
	var wint = (screen.height - h) / 2;
	winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable=no'
	win = window.open(mypage, myname, winprops)
		if (parseInt(navigator.appVersion) >= 4) {
			win.window.focus();
		}
}

function goto_URL(object) {
  parent.main.location.href = object.options[object.selectedIndex].value;
  return true;
}

";

include ("js/mouseover.js");

print "

// -->

</SCRIPT>

</head>

<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=10>
<CENTER>";

include ("includes/vars.inc");

include ("includes/topframe.inc");

mysql_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database");
@mysql_select_db("$DBName") or die("Unable to select database $DBName");

if ($type == 'personnel') {

if ($view == 'groups') {

$sqlquery = "SELECT * FROM personnel WHERE emp_title = 'group' OR emp_title = 'none'";

} elseif ($group == 'ALL') {

$sqlquery = "SELECT * FROM personnel";

} elseif (strlen($group) < '1') {

$sqlquery = "SELECT * FROM personnel WHERE emp_title <> 'group' AND emp_title <> 'none' ORDER by emp_group";

} else {

$sqlquery = "SELECT * FROM personnel WHERE emp_group = '$group'";

}

$result = mysql_query($sqlquery);
$number = @mysql_numrows($result);

$i = 0;

if ($number < 1) {
print "
<table width=\"640\"><tr><td>
<table border=0 cellpadding=5 width=\"100%\" bgcolor=\"#CCCCCC\"><tr>
	<th><font size=\"-1\" color=\"#000000\">Name</font></th>
	<th><font size=\"-1\" color=\"#000000\">Email</font></th>
	<th><font size=\"-1\" color=\"#000000\">Title</font></th>
	<th><font size=\"-1\" color=\"#000000\">Group</font></th>
	<th><font size=\"-1\" color=\"#000000\">Address</font></th>
	<th><font size=\"-1\" color=\"#000000\">Home Phone</font></th>
	<th><font size=\"-1\" color=\"#000000\">Cell Phone</font></th>
	<th><font size=\"-1\" color=\"#000000\">Notes</font></th>
</tr>
 <tr><td bgcolor=\"#FFFFFF\" colspan=9><CENTER><h4>There are no people assigned to this group.</CENTER></td></tr>
</table></td></tr></table></center>";

} else {

	if ($group == 'none') {

	print "<table border=0 cellspacing=0 cellpadding=0 width=\"800\"><tr><td width=\"100\">&nbsp;</td><td align=\"center\"><img src=\"./images/all_groups_logo1.jpg\" /></td><td width=\"100\" align=right valign=bottom><!-- a href=\"list_labels.php?type=personnel&group=$group\" onClick=\"open_window(this.href,'name','612','792','no'); return false;\"><font size=\"-1\" face=\"tahoma\">Printable View</font></a --></td></tr></table>";

	} elseif (strlen($group) < '1') {

	print "<table border=0 cellspacing=0 cellpadding=0 width=\"800\"><tr><td width=\"100\">&nbsp;</td><td align=\"center\"><img src=\"./images/personnel_big_logo1.jpg\" /></td><td width=\"100\" align=right valign=bottom><!-- a href=\"list_labels.php?type=personnel&group=$group\" onClick=\"open_window(this.href,'name','612','792','no'); return false;\"><font size=\"-1\" face=\"tahoma\">Printable View</font></a --></td></tr></table>";

	} else {

	print "<table border=0 cellspacing=0 cellpadding=0 width=\"800\"><tr><td width=\"100\">&nbsp;</td><td align=\"center\"><table><tr><td align=\"right\" valign=\"bottom\"><img src=\"./images/members_of_logo1.jpg\" /></td><td align=\"center\" valign=\"bottom\">&nbsp;<b><i>$group</i></b>&nbsp;</td><td align=\"left\" valign=\"bottom\"><img src=\"./images/group_logo1.jpg\" /></td></tr></table></td><td width=\"100\" align=right valign=bottom><!-- a href=\"list_labels.php?type=personnel&group=$group\" onClick=\"open_window(this.href,'name','612','792','no'); return false;\"><font size=\"-1\" face=\"tahoma\">Printable View</font></a --></td></tr></table>";

	}



print "
<table><tr><td>
<table border=0 cellpadding=5 width=\"800\" bgcolor=\"#CCCCCC\">
<tr>
	<th><font size=\"-1\" color=\"#000000\">Name</font></th>
	<th><font size=\"-1\" color=\"#000000\">Email</font></th>
	<th width=\"65\"><font size=\"-1\" color=\"#000000\">Title</font></th>
	<th><font size=\"-1\" color=\"#000000\">Group</font></th>
	<th width=\"135\"><font size=\"-1\" color=\"#000000\">Address</font></th>
	<th><font size=\"-1\" color=\"#000000\">Home Phone</font></th>
	<th><font size=\"-1\" color=\"#000000\">Cell Phone</font></th>
	<th width=\"135\"><font size=\"-1\" color=\"#000000\">Notes</font></th>
</tr>
<tr>
";

while ($number > $i) {
$theemp_id = mysql_result($result,$i,"emp_id");
$theemp_login = mysql_result($result,$i,"emp_login");
$theemp_name = mysql_result($result,$i,"emp_name");
$theemp_email = mysql_result($result,$i,"emp_email");
$theemp_title = mysql_result($result,$i,"emp_title");
$theemp_phone_hm = mysql_result($result,$i,"emp_phone_hm");
$theemp_phone_cell = mysql_result($result,$i,"emp_phone_cell");
$theemp_notes = mysql_result($result,$i,"emp_notes");
$theemp_group = mysql_result($result,$i,"emp_group");
$theemp_address = mysql_result($result,$i,"emp_address");
$theemp_address = nl2br($theemp_address);
$theemp_notes = nl2br($theemp_notes);

print "
     	<td align=\"center\" bgcolor=\"#FFFFFF\"><font size=\"-1\"><a href=\"show.php?type=personnel&id=$theemp_id\">$theemp_name</a></font></td>
     	<!-- td align=\"center\" bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theemp_login) < '1') { print "&nbsp;"; } else { print "$theemp_login"; } print "</font></td -->
     	<td align=\"center\" bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theemp_email) < '1') { print "&nbsp;"; } else { print "<a href=mailto:$theemp_email>Click Here</a>"; } print "</font></td>
	<td align=\"center\" bgcolor=\"#FFFFFF\" width=\"65\"><font size=\"-1\">"; if(strlen($theemp_title) < '1') { print "&nbsp;"; } else { print "$theemp_title"; } print "</font></td>
 	<td align=\"center\" bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theemp_group) < '1') { print "&nbsp;"; } else { print "<a href=\"list.php?type=personnel&group=$theemp_group\">$theemp_group</a>"; } print "</font></td>
 	<td width=\"135\" align=\"left\" bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theemp_address) < '1') { print "&nbsp;"; } else { print "$theemp_address"; } print "</font></td>
 	<td align=\"center\" bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theemp_phone_hm) < '1') { print "&nbsp;"; } else { print "$theemp_phone_hm"; } print "</font></td>
 	<td align=\"center\" bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theemp_phone_cell) < '1') { print "&nbsp;"; } else { print "$theemp_phone_cell"; } print "</font></td>
 	<td width=\"135\" bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theemp_notes) < '1') { print "&nbsp;"; } else { print "$theemp_notes"; } print "</font></td>
 </tr>";

$i++;

  }

echo "</table></td></tr></table></center>";

 }

} else {

if ($view == 'ALL') {

 $sqlquery = "SELECT proj_id, proj_name, proj_submitter, proj_assignee, date_format(proj_create_dt, '%c/%e/%y %l:%i:%s %p') as proj_create_dt, proj_status, proj_type, proj_priority, proj_desc, proj_notes, proj_due_dt FROM projects WHERE proj_status IN ('OPEN','ASSIGNED','PENDING','VERIFIED') ORDER BY proj_id ASC";

} elseif ($view == 'cal') {

 if (strlen($d) > '1') {

  $sqlquery = "SELECT proj_id, proj_name, proj_submitter, proj_assignee, date_format(proj_create_dt, '%c/%e/%y %l:%i:%s %p') as proj_create_dt, proj_status, proj_type, proj_priority, proj_desc, proj_notes, proj_due_dt FROM projects WHERE proj_due_dt LIKE '$month/$d/$y'";

 } else {

  $sqlquery = "SELECT proj_id, proj_name, proj_submitter, proj_assignee, date_format(proj_create_dt, '%c/%e/%y %l:%i:%s %p') as proj_create_dt, proj_status, proj_type, proj_priority, proj_desc, proj_notes, proj_due_dt FROM projects WHERE proj_due_dt LIKE '$month/%/$y' ORDER BY proj_due_dt";

 }

} elseif ($view == 'DUE_DATE') {

 $sqlquery = "SELECT proj_id, proj_name, proj_submitter, proj_assignee, date_format(proj_create_dt, '%c/%e/%y %l:%i:%s %p') as proj_create_dt, proj_status, proj_type, proj_priority, proj_desc, proj_notes, proj_due_dt FROM projects WHERE proj_status IN ('OPEN','ASSIGNED','PENDING','VERIFIED') ORDER BY proj_due_dt";

} elseif (strlen($view) < '1') {

 $sqlquery = "SELECT proj_id, proj_name, proj_submitter, proj_assignee, date_format(proj_create_dt, '%c/%e/%y %l:%i:%s %p') as proj_create_dt, proj_status, proj_type, proj_priority, proj_desc, proj_notes, proj_due_dt FROM projects WHERE proj_status IN ('OPEN','ASSIGNED','PENDING','VERIFIED') ORDER BY proj_due_dt";

} else {

 if (strlen($assignee) > '1') {

  $sqlquery = "SELECT proj_id, proj_name, proj_submitter, proj_assignee, date_format(proj_create_dt, '%c/%e/%y %l:%i:%s %p') as proj_create_dt, proj_status, proj_type, proj_priority, proj_desc, proj_notes, proj_due_dt FROM projects WHERE proj_assignee = '$assignee' ORDER BY proj_id DESC";

 } else {

  $sqlquery = "SELECT proj_id, proj_name, proj_submitter, proj_assignee, date_format(proj_create_dt, '%c/%e/%y %l:%i:%s %p') as proj_create_dt, proj_status, proj_type, proj_priority, proj_desc, proj_notes, proj_due_dt FROM projects WHERE proj_status = '$view' ORDER BY proj_id ASC";

 }

}

$result = mysql_query($sqlquery);
$number = @mysql_numrows($result);

$i = 0;

if ($number < 1) {

	if (strlen($view) < '1') {
	print "<center>
<img src=\"./images/projects_big_logo1.jpg\" />
<table width=\"640\"><tr><td>
<table border=0 cellpadding=5 width=\"100%\" bgcolor=\"#CCCCCC\"><tr>
	<th><font size=\"-1\" color=\"#000000\">ID</font></th>
	<th><font size=\"-1\" color=\"#000000\">Title</font></th>
	<th><font size=\"-1\" color=\"#000000\">Due Date</font></th>
	<th><font size=\"-1\" color=\"#000000\">Submitter</font></th>
	<th><font size=\"-1\" color=\"#000000\">Assignee</font></th>
	<th><font size=\"-1\" color=\"#000000\">Type</font></th>
	<th><font size=\"-1\" color=\"#000000\">Description</font></th>
	<th><font size=\"-1\" color=\"#000000\">Priority</font></th>
	<th><font size=\"-1\" color=\"#000000\">Status</font></th>
 </tr>
 <tr><td bgcolor=\"#FFFFFF\" colspan=9><CENTER><h4>There are no tickets that are OPEN, ASSIGNED, PENDING or VERIFIED.</h4>Click here to <a href=\"insert.php?type=projects\">open a ticket</a>.</CENTER></td></tr>
</table></td></tr></table></center>";

	} else {

	print "<center>
<img src=\"./images/projects_big_logo1.jpg\" />
<table width=\"640\"><tr><td>
<table border=0 cellpadding=5 width=\"100%\" bgcolor=\"#CCCCCC\"><tr>
	<th><font size=\"-1\" color=\"#000000\">ID</font></th>
	<th><font size=\"-1\" color=\"#000000\">Title</font></th>
	<th><font size=\"-1\" color=\"#000000\">Due Date</font></th>
	<th><font size=\"-1\" color=\"#000000\">Submitter</font></th>
	<th><font size=\"-1\" color=\"#000000\">Assignee</font></th>
	<th><font size=\"-1\" color=\"#000000\">Type</font></th>
	<th><font size=\"-1\" color=\"#000000\">Description</font></th>
	<th><font size=\"-1\" color=\"#000000\">Priority</font></th>
	<th><font size=\"-1\" color=\"#000000\">Status</font></th>
 </tr>
 <tr><td colspan=10 bgcolor=\"#FFFFFF\"><CENTER><P>There Were No Results for Your Search</CENTER></td></tr>
</table></td></tr></table></center>";

	}


} else {

echo "
<center>
<img src=\"./images/projects_big_logo1.jpg\" />
<table><tr><td>
<table border=0 cellpadding=5 width=\"100%\" bgcolor=\"#CCCCCC\"><tr>
	<th><font size=\"-1\" color=\"#000000\">ID</font></th>
	<th><font size=\"-1\" color=\"#000000\">Title</font></th>
	<th><font size=\"-1\" color=\"#000000\">Due Date</font></th>
	<th><font size=\"-1\" color=\"#000000\">Submitter</font></th>
	<th><font size=\"-1\" color=\"#000000\">Assignee</font></th>
	<th><font size=\"-1\" color=\"#000000\">Type</font></th>
	<th><font size=\"-1\" color=\"#000000\">Description</font></th>
	<th><font size=\"-1\" color=\"#000000\">Priority</font></th>
	<th><font size=\"-1\" color=\"#000000\">Status</font></th>
 </tr>
";

while ($number > $i) {
$theproj_id = mysql_result($result,$i,"proj_id");
$theproj_name = mysql_result($result,$i,"proj_name");
$theproj_submitter = mysql_result($result,$i,"proj_submitter");
$theproj_due_dt = mysql_result($result,$i,"proj_due_dt");
$theproj_status = mysql_result($result,$i,"proj_status");
$theproj_priority = mysql_result($result,$i,"proj_priority");
$theproj_assignee = mysql_result($result,$i,"proj_assignee");
$theproj_type = mysql_result($result,$i,"proj_type");
$theproj_desc_long = mysql_result($result,$i,"proj_desc");
$theproj_desc_long = nl2br($theproj_desc_long);
$theproj_desc = substr($theproj_desc_long, 0, 35).'...';


$sqlquery2 = "SELECT parent, child FROM parent_child_rel WHERE parent = $theproj_id";
$result2 = mysql_query($sqlquery2);
$number2 = @mysql_numrows($result2);
$j = 0;

	if ($number2 < 1) {

	  print "<tr>
		  <td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\"><a href=\"show.php?type=projects&id=$theproj_id\">$theproj_id</a></font></td>";
	  print "<td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\"><a href=\"show.php?type=projects&id=$theproj_id\">$theproj_name</a></font><br>";

	} else {

	        $theparent_id = mysql_result($result2,$j,"parent");


			if ($theproj_id == $theparent_id) {

				print "<tr>
					<td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\"><a href=\"list_project.php?parent_id=$theproj_id\">$theproj_id</a></font></td>";
				print "<td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\"><a href=\"list_project.php?parent_id=$theproj_id\">$theproj_name</a></font><br>";

			} else {

				print "<tr>
					<td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\"><a href=\"show.php?type=projects&id=$theproj_id\">$theproj_id</a></font></td>";
				print "<td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\"><a href=\"show.php?type=projects&id=$theproj_id\">$theproj_name</a></font><br>";

			}


	  while ($number2 > $j) {

         $theproj_child = mysql_result($result2,$j,"child");

		if ($theproj_id == $theproj_child) {

	  		print "";

		} else {

			if ($j == 0) { echo "<font size=\"-2\">Child:</font>&nbsp;"; }

			echo "<font size=\"-2\"><a href=\"show.php?type=projects&id=$theproj_child\">$theproj_child</a></font>";

		}

		if ($number2 - 1 == $j) {
		echo "";
		} else {
		echo " ";
		}

	  $j++;

	  }

	}

print "	</td>
	<td align=\"center\" bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if($theproj_due_dt == '12/31/2010') { print "&nbsp;"; } else { print "$theproj_due_dt"; } print "</font></td>
     	<td align=\"center\" bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theproj_submitter) < '1') { print "&nbsp;"; } else { print "<a href=\"detail.php?name=$theproj_submitter\" onClick=\"open_window(this.href,'name','475','400','yes');return false;\">$theproj_submitter</a>"; } print "</font></td>
	<td align=\"center\" bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theproj_assignee) < '1') { print "&nbsp;"; } else { print "<a href=\"detail.php?name=$theproj_assignee\" onClick=\"open_window(this.href,'name','475','400','yes');return false;\">$theproj_assignee</a>"; } print "</font></td>
	<td align=\"center\" bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theproj_type) < '1') { print "&nbsp;"; } else { print "$theproj_type"; } print "</font></td>
 	<td bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theproj_desc) < '1') { print "&nbsp;"; } else { print "$theproj_desc <a href=\"detail.php?more=$theproj_id\" onClick=\"open_window(this.href,'name','475','400','yes');return false;\">more</a>"; } print "</font></td>
 	<td align=\"center\" bgcolor=\"#FFFFFF\"><font size=\"-1\">$theproj_priority</font></td>
 	<td align=\"center\" bgcolor=\"#FFFFFF\"><font size=\"-1\">$theproj_status</font></td>
 </tr>

";

$i++;

  }

echo "</table></td></tr></table></center>";

 }

}

?>

</BODY></HTML>

<?php

$db_object->disconnect();
// when you are done.

?>
