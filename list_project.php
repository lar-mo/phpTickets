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

<SCRIPT LANGUAGE=\"JavaScript\">

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

";

include("js/mouseover.js");

print "

// -->

</SCRIPT>

</head>
<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=10>";

include("includes/topframe.inc");

include("includes/vars.inc");

mysql_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database");
@mysql_select_db("$DBName") or die("Unable to select database $DBName"); 

$sqlquery1 = "SELECT child FROM parent_child_rel WHERE parent = '$parent_id'";
$result1 = mysql_query($sqlquery1);
$number1 = @mysql_numrows($result1);

$k = 0;

	while ($number1 > $k) {
	$child_id = mysql_result($result1,$k,"child");
	$addParams .= " OR proj_id = '$child_id'";
	$k++; 
	}

$sqlquery2 = "SELECT proj_id, proj_name, proj_submitter, proj_assignee, date_format(proj_create_dt, '%c/%e/%y %l:%i:%s %p') as proj_create_dt, proj_status, proj_type, proj_priority, proj_desc, proj_notes, proj_due_dt FROM projects WHERE (proj_id = '$parent_id' $addParams) AND (proj_status IN ('OPEN','ASSIGNED','PENDING','VERIFIED'))";
$result2 = mysql_query($sqlquery2);
$number2 = @mysql_numrows($result2);

$i = 0;

if ($number2 < 1) {
print "<CENTER><P>There Were No Results for Your Search</CENTER>";

} else {

$sqlquery3 = "SELECT proj_name FROM projects WHERE proj_id = '$parent_id'";
$result3 = mysql_query($sqlquery3);
$caption_title = mysql_result($result3,0,"proj_name");

echo "
<center>
<table><tr><td align=\"center\"><table><tr><td><img src=\"./images/tix_related_logo1.jpg\"></td><td>&nbsp;<b><i>$caption_title</i></b></td></tr></table></td></tr>
<tr><td>
<table border=0 cellpadding=5 bgcolor=\"#CCCCCC\">
 <tr>
	<th><font size=\"-1\">ID</font></th>
	<th><font size=\"-1\">Title</font></th>
	<th><font size=\"-1\">Due Date</font></th>
	<th><font size=\"-1\">Submitter</font></th>
	<th><font size=\"-1\">Assignee</font></th>
	<th><font size=\"-1\">Type</font></th>
	<th><font size=\"-1\">Description</font></th>
	<th><font size=\"-1\">Priority</font></th>
	<th><font size=\"-1\">Status</font></th>
 </tr>";

while ($number2 > $i) {
$theproj_id = mysql_result($result2,$i,"proj_id");
$theproj_name = mysql_result($result2,$i,"proj_name");
$theproj_submitter = mysql_result($result2,$i,"proj_submitter");
$theproj_due_dt = mysql_result($result2,$i,"proj_due_dt");
$theproj_status = mysql_result($result2,$i,"proj_status");
$theproj_priority = mysql_result($result2,$i,"proj_priority");
$theproj_assignee = mysql_result($result2,$i,"proj_assignee");
$theproj_type = mysql_result($result2,$i,"proj_type");
$theproj_desc_long = mysql_result($result2,$i,"proj_desc");
$theproj_desc_long = nl2br($theproj_desc_long);
$theproj_desc = substr($theproj_desc_long, 0, 35).'...';

print"
 <tr>	
	<td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\"><a href=\"show.php?type=projects&id=$theproj_id\">$theproj_id</a></font></td>";

$sqlquery3 = "SELECT parent, child FROM parent_child_rel WHERE parent = $theproj_id";
$result3 = mysql_query($sqlquery3);
$number3 = @mysql_numrows($result3);

$j = 0;

	if ($number3 < 1) {

	  print "<td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\"><a href=\"show.php?type=projects&id=$theproj_id\">$theproj_name</a></font><br>";

	} else {

	  $theparent_id = mysql_result($result3,$j,"parent");

	  	print "<td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\"><a href=\"show.php?type=projects&id=$theproj_id\">$theproj_name</a></font><br>";		

	  while ($number3 > $j) {

         $theproj_child = mysql_result($result3,$j,"child");	

		if ($theproj_id == $theproj_child) {

	  		print "";

		} else {

			if ($j == 0) { echo "<font size=\"-2\"><a href=\"insert_child.php?type=projects&parent_id=$theproj_id\">Child</a>:</font>&nbsp;"; }			

			echo "<font size=\"-2\"><a href=\"show.php?type=projects&id=$theproj_child\">$theproj_child</a></font>";

		}

		if ($number3 - 1 == $j) {
		echo "";
		} else {
		echo " ";
		}

	  $j++;

	  }

	}

print "	</td>
	<td align=\"center\" bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if($theproj_due_dt == '12/31/2010') { print "&nbsp;"; } else { print "$theproj_due_dt"; } print "</font></td>
     	<td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theproj_submitter) < '1') { print "&nbsp;"; } else { print "<a href=\"detail.php?name=$theproj_submitter\" onClick=\"open_window(this.href,'name','475','400','yes');return false;\">$theproj_submitter</a>"; } print "</font></td>
	<td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theproj_assignee) < '1') { print "&nbsp;"; } else { print "<a href=\"detail.php?name=$theproj_assignee\" onClick=\"open_window(this.href,'name','475','400','yes');return false;\">$theproj_assignee</a>"; } print "</font></td>
 	<td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theproj_type) < '1') { print "&nbsp;"; } else { print "$theproj_type"; } print "</font></td>
 	<td width=150 bgcolor=\"#FFFFFF\"><font size=\"-1\">"; if(strlen($theproj_desc) < '1') { print "&nbsp;"; } else { print "$theproj_desc <a href=\"detail.php?more=$theproj_id\" onClick=\"open_window(this.href,'name','475','400','yes');return false;\">more</a>"; } print "</font></td>
 	<td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\">$theproj_priority</font></td>
 	<td align=center bgcolor=\"#FFFFFF\"><font size=\"-1\">$theproj_status</font></td>
 </tr>
";

$i++;

  }

echo "</table></center>";

 }

?>

</BODY></HTML>

<?php

$db_object->disconnect();
// when you are done.

?>