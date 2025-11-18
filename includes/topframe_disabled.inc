<?

$request_uri = $_SERVER['REQUEST_URI'];

$m = date("m");
$y = date("Y");

print "
<table width=\"100%\" bgcolor=\"#DDDDDD\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
	<tr>
	   <td align=\"left\"><font size=\"-1\">&nbsp;<b>personnel and project management tool :: "; print(strtolower(Date("l, F d, Y"))); print "</b></font></td>
	   <td align=\"right\"><font size=\"-1\">";

	if($request_uri == '/phpTickets/login.php') { echo 'Not logged in.'; }

	print "&nbsp;[&nbsp;<a href=\"./help/faq.php\" target=\"new\">help</a>?]&nbsp;</font></td>
	</tr>
</table>";

print "<center><table><tr><td align=\"center\" valign=\"middle\"><form>
<img src=\"./images/logo_header.jpg\"><br>
<img src=\"./images/personnel_logo1.jpg\" border=\"0\">&nbsp;<img src=\"./images/colon_logo1.jpg\" border=\"0\">&nbsp;<img src=\"./images/add_logo1.jpg\" border=\"0\" name=\"image1\">&nbsp;<img src=\"./images/colon_logo1.jpg\" border=\"0\">&nbsp;";

$match1 = strstr($request_uri, "/phpTickets/list.php?type=personnel");
if (strlen($match1) > '1') {

print "<img src=\"./images/show_people_logo1.jpg\" border=\"0\">
<select name=\"group\" onChange=\"return goto_URL(this.form.group)\" style=\"{color: #000000; font-family:tahoma; font-size:7pt;}\">
<option value=\"javascript:self.focus();\">Type</option>
<option value=\"/phpTickets/list.php?type=personnel\">All Personnel</option>
<option value=\"/phpTickets/list.php?type=personnel&group=none&view=groups\">Edit Groups</option>
";

mysql_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database");
@mysql_select_db("$DBName") or die("Unable to select database $DBName"); 

$sqlquery = "SELECT emp_name FROM personnel WHERE emp_title = 'group'";
$result = mysql_query($sqlquery);
$number = @mysql_numrows($result);
$i = 0;

while ($number > $i) {
$theemp_name = mysql_result($result,$i,"emp_name");

print "<option value=\"/phpTickets/list.php?type=personnel&group=$theemp_name\">$theemp_name</option>";

$i++;

  }

print "</SELECT>";

} else {

print "<img src=\"./images/list_people_logo1.jpg\" border=\"0\" name=\"image2\">";

}


print "
&nbsp;&nbsp;&nbsp;&nbsp;<img src=\"./images/colon_logo1.jpg\" border=\"0\"><img src=\"./images/colon_logo1.jpg\" border=\"0\">&nbsp;&nbsp;&nbsp;&nbsp;
<img src=\"./images/projects_logo1.jpg\" border=\"0\">&nbsp;<img src=\"./images/colon_logo1.jpg\" border=\"0\">&nbsp;<img src=\"./images/add_logo1.jpg\" border=\"0\" name=\"image3\">&nbsp;<img src=\"./images/colon_logo1.jpg\" border=\"0\">&nbsp;";

$match2 = strstr($request_uri, "/phpTickets/list.php?type=projects");
if (strlen($match2) > '1') {

print "<img src=\"./images/show_tickets_logo1.jpg\" border=\"0\">
<select name=\"ticketview\" onChange=\"return goto_URL(this.form.ticketview)\" style=\"{color: #000000; font-family:tahoma; font-size:7pt;}\">
<option value=\"javascript:self.focus();\">by Status</option>
<option value=\"/phpTickets/list.php?type=projects&view=ALL\">ALL</option>
<option value=\"/phpTickets/list.php?type=projects&view=OPEN\">OPEN</option>
<option value=\"/phpTickets/list.php?type=projects&view=ASSIGNED\">ASSIGNED</option>
<option value=\"/phpTickets/list.php?type=projects&view=PENDING\">PENDING</option>
<option value=\"/phpTickets/list.php?type=projects&view=CLOSED\">CLOSED</option>
<option value=\"/phpTickets/list.php?type=projects&view=CANCELED\">CANCELED</option>
<option value=\"javascript:self.focus();\"></option>";

mysql_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database");
@mysql_select_db("$DBName") or die("Unable to select database $DBName"); 

$sqlquery2 = "SELECT emp_name FROM personnel WHERE emp_title = 'group'";
$result2 = mysql_query($sqlquery2);
$number2 = @mysql_numrows($result2);
$j = 0;

while ($number2 > $j) {
$theemp_name1 = mysql_result($result2,$j,"emp_name");

print "<option value=\"/phpTickets/list.php?type=projects&view=none&assignee=$theemp_name1\">$theemp_name1</option>";

$j++;

  }

print "<option value=\"javascript:self.focus();\"></option>";

$sqlquery3 = "SELECT emp_name FROM personnel WHERE emp_title <> 'group' AND emp_title <> 'none'";
$result3 = mysql_query($sqlquery3);
$number3 = @mysql_numrows($result3);
$k = 0;

while ($number3 > $k) {
$theemp_name2 = mysql_result($result3,$k,"emp_name");

print "<option value=\"/phpTickets/list.php?type=projects&view=none&assignee=$theemp_name2\">$theemp_name2</option>";

$k++;

  }

$current_month = date("F");
$year = date("Y");
$month = date("m");

print "
<option value=\"javascript:self.focus();\"></option>
<option value=\"/phpTickets/list.php?type=projects&view=cal&y=$y&m=$m\">View $current_month</option>
<option value=\"/phpTickets/list.php?type=projects&view=DUE_DATE\">View by Due Date</option>
</SELECT>";

} else {

print "<img src=\"./images/list_tickets_logo1.jpg\" border=\"0\" name=\"image4\">";

}

print "</form></td></tr></table></center>";

?>