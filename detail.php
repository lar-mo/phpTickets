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

?>

<html>
<head><title>Show Details</title>

<SCRIPT LANGUAGE="JavaScript">
<!-- Activate cloaking

function view_ticket(value) {

	window.opener.location.href = value;
	window.close();

}

// Deactivate cloaking-->
</SCRIPT>  

</head>

<?php

print "<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\">";

include ("includes/vars.inc");

mysql_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database");
@mysql_select_db("$DBName") or die("Unable to select database $DBName"); 

if (strlen($name) > '0') {

$sqlquery = "SELECT * FROM personnel WHERE emp_name LIKE '$name' OR emp_login LIKE '$name'";
$result = mysql_query($sqlquery);
$number = @mysql_numrows($result);

$i = 0;

 if ($number < 1) {
 print "<CENTER><P><h2>Whoops!</h2>The person or group you inquired about<br>has not been entered in the Personnel database.</CENTER>";

 } else {

   while ($number > $i) {
   $theemp_id = mysql_result($result,$i,"emp_id");
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
   <center>
   <table><tr><td align=\"center\"><table border=0><tr><td align=\"right\" valign=\"bottom\"><img src=\"./images/details_logo1.jpg\">&nbsp;</td><td align=\"left\"><i>$theemp_name</i></td></tr><table></td></tr>
   <tr><td>
   <table border=0 cellpadding=5 width=350 bgcolor=\"#DDDDDD\">
    <tr>
     <th width=\"100\">Email</th>
     <td bgcolor=\"#FFFFFF\">"; if(strlen($theemp_email) < '1') { print "&nbsp;"; } else { print "$theemp_email"; } print "</td>
    </tr>
    <tr>
     <th width=\"100\">Title</th>
     <td bgcolor=\"#FFFFFF\">"; if(strlen($theemp_title) < '1') { print "&nbsp;"; } else { print "$theemp_title"; } print "</td>
    </tr>
    <tr>
     <th width=\"100\">Group</th>
     <td bgcolor=\"#FFFFFF\">"; if(strlen($theemp_group) < '1') { print "&nbsp;"; } else { print "$theemp_group"; } print "</td>
    </tr>
    <tr>
     <th width=\"100\">Address</th>
     <td bgcolor=\"#FFFFFF\">"; if(strlen($theemp_address) < '1') { print "&nbsp;"; } else { print "$theemp_address"; } print "</td>
    </tr>
    <tr>
     <th width=\"100\">Home Phone</th>
     <td bgcolor=\"#FFFFFF\">"; if(strlen($theemp_phone_hm) < '1') { print "&nbsp;"; } else { print "$theemp_phone_hm"; } print "</td>
    </tr>
    <tr>
     <th width=\"100\">Cell Phone</th>
     <td bgcolor=\"#FFFFFF\">"; if(strlen($theemp_phone_cell) < '1') { print "&nbsp;"; } else { print "$theemp_phone_cell"; } print "</td>
    </tr>
    <tr>
     <th width=\"100\">Notes</th>
     <td bgcolor=\"#FFFFFF\">"; if(strlen($theemp_notes) < '1') { print "&nbsp;"; } else { print "$theemp_notes"; } print "</td>
    </tr>
   </table></td></tr></table>
   <p>
   <a href=\"javascript:window.close();\"><img src=\"./images/cw_logo1.jpg\" border=\"0\"></a>
   </center>";

   $i++;
   }
 }

} 

if (strlen($more) > '0') {

$sqlquery = "SELECT proj_id, proj_name, proj_desc, proj_notes FROM projects WHERE proj_id LIKE '$more'";
$result = mysql_query($sqlquery);
$number = @mysql_numrows($result);

$i = 0;

 if ($number < 1) {
   print "<CENTER><P><h2>Whoops!</h2>There's a glitch in the matrix. Contact <a href=mailto:techsupport@aretemm.net>Tech Support</a>.</CENTER>";

 } else {

   while ($number > $i) {
   $theproj_id = mysql_result($result,$i,"proj_id");
   $theproj_name = mysql_result($result,$i,"proj_name");
   $theproj_desc = mysql_result($result,$i,"proj_desc");
   $theproj_notes = mysql_result($result,$i,"proj_notes");

   print "
   <center>
   <table><tr><td align=\"center\"><table border=0>
	<tr><td align=\"right\" valign=\"bottom\"><img src=\"./images/details_logo1.jpg\">&nbsp;</td><td align=\"left\"><i>$theproj_name</i></td></tr>
	<table></td></tr>
   <tr><td>
   <table border=0 cellpadding=5 width=350 bgcolor=\"#DDDDDD\">
    <tr>
     <th colspan=2><font size=\"-1\"><a href=\"show.php?type=projects&id=$theproj_id\" onClick=\"view_ticket(this.href);\">View the ticket #$theproj_id</a></font></th>
    </tr>
    <tr>
     <th width=\"100\">Description</th>
     <td bgcolor=\"#FFFFFF\">$theproj_desc</td>
    </tr>
    <tr>
     <th width=\"100\">Notes</th>
     <td bgcolor=\"#FFFFFF\">"; if(strlen($theproj_notes) < '1') { print "&nbsp;"; } else { print "$theproj_notes"; } print "</td>
    </tr>
   </table></td></tr></table>
   <p>
   <a href=\"javascript:window.close();\"><img src=\"./images/cw_logo1.jpg\" border=\"0\"></a>
   </center>";

   $i++;
   }
 }

}


if (strlen($help) > '0') {

 if ($helpindex == '0') {

   print "
   <center>
   <table><tr><td align=\"center\"><table border=0><tr><td align=\"right\" valign=\"bottom\"><img src=\"./images/details_logo1.jpg\">&nbsp;</td><td align=\"left\"><i>Title</i></td></tr><table></td></tr>
   <tr><td>
   <table border=0 cellpadding=5 width=350 bgcolor=\"#DDDDDD\">
    <tr>
     <td bgcolor=\"#FFFFFF\">
	This is a brief description of the project, task or issue. It is referenced on the index page and in email notices. Your basic label.
     </td>
    </tr>
   </table></td></tr></table>
   <p>
   <a href=\"javascript:window.close();\"><img src=\"./images/cw_logo1.jpg\" border=\"0\"></a>
   </center>";

 }

 if ($helpindex == '1') {

   print "
   <center>
   <table><tr><td align=\"center\"><table border=0><tr><td align=\"right\" valign=\"bottom\"><img src=\"./images/details_logo1.jpg\">&nbsp;</td><td align=\"left\"><i>Description</i></td></tr><table></td></tr>
   <tr><td>
   <table border=0 cellpadding=5 width=350 bgcolor=\"#DDDDDD\">
    <tr>
     <td bgcolor=\"#FFFFFF\">
	This is a full description of the project, task or issue. It is truncated on the main index page.
     </td>
    </tr>
   </table></td></tr></table>
   <p>
   <a href=\"javascript:window.close();\"><img src=\"./images/cw_logo1.jpg\" border=\"0\"></a>
   </center>";

 }

}


?>
</BODY></HTML>

<?php

$db_object->disconnect();
// when you are done.

?>