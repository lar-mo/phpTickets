<?

$request_uri = $_SERVER['REQUEST_URI'];

$m = date("m");
$y = date("Y");

print "<center><form>
<img src=\"./images/logo_header.jpg\"><br>
<b>Personnel:</b> <a href=\"/pcac2/insert.php?type=personnel\">ADD</a>&nbsp;<b>:</b>&nbsp;";

$match1 = strstr($request_uri, "/pcac2/list.php?type=personnel");
if (strlen($match1) > '1') {

print "Show People by 
<select name=\"group\" onChange=\"return goto_URL(this.form.group)\">
<option value=\"javascript:self.focus();\">Type</option>
<option value=\"/pcac2/list.php?type=personnel\">All Personnel</option>
<option value=\"/pcac2/list.php?type=personnel&group=none&view=groups\">Edit Groups</option>
";

mysql_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database");
@mysql_select_db("$DBName") or die("Unable to select database $DBName"); 

$sqlquery = "SELECT emp_name FROM personnel WHERE emp_title = 'group'";
$result = mysql_query($sqlquery);
$number = @mysql_numrows($result);
$i = 0;

while ($number > $i) {
$theemp_name = mysql_result($result,$i,"emp_name");

print "<option value=\"/pcac2/list.php?type=personnel&group=$theemp_name\">$theemp_name</option>";

$i++;

  }

print "</SELECT>";

} else {

print "<a href=\"/pcac2/list.php?type=personnel&m=$m&y=$y\">List People</a>";

}


print "
&nbsp;&nbsp;&nbsp;&nbsp;<b>::</b>&nbsp;&nbsp;&nbsp;&nbsp;
<b>Projects:</b> <a href=\"/pcac2/insert.php?type=projects\">INSERT</a>&nbsp;<b>:</b>&nbsp;";

$match2 = strstr($request_uri, "/pcac2/list.php?type=projects");
if (strlen($match2) > '1') {

print "Show Tickets 
<select name=\"ticketview\" onChange=\"return goto_URL(this.form.ticketview)\">
<option value=\"javascript:self.focus();\">by Status</option>
<option value=\"/pcac2/list.php?type=projects&view=ALL\">ALL</option>
<option value=\"/pcac2/list.php?type=projects&view=OPEN\">OPEN</option>
<option value=\"/pcac2/list.php?type=projects&view=ASSIGNED\">ASSIGNED</option>
<option value=\"/pcac2/list.php?type=projects&view=PENDING\">PENDING</option>
<option value=\"/pcac2/list.php?type=projects&view=CLOSED\">CLOSED</option>
<option value=\"/pcac2/list.php?type=projects&view=CANCELED\">CANCELED</option>
<option value=\"javascript:self.focus();\"></option>";

mysql_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database");
@mysql_select_db("$DBName") or die("Unable to select database $DBName"); 

$sqlquery2 = "SELECT emp_name FROM personnel WHERE emp_title = 'group'";
$result2 = mysql_query($sqlquery2);
$number2 = @mysql_numrows($result2);
$j = 0;

while ($number2 > $j) {
$theemp_name1 = mysql_result($result2,$j,"emp_name");

print "<option value=\"/pcac2/list.php?type=projects&view=none&assignee=$theemp_name1\">$theemp_name1</option>";

$j++;

  }

print "<option value=\"javascript:self.focus();\"></option>";

$sqlquery3 = "SELECT emp_name FROM personnel WHERE emp_title <> 'group' AND emp_title <> 'none'";
$result3 = mysql_query($sqlquery3);
$number3 = @mysql_numrows($result3);
$k = 0;

while ($number3 > $k) {
$theemp_name2 = mysql_result($result3,$k,"emp_name");

print "<option value=\"/pcac2/list.php?type=projects&view=none&assignee=$theemp_name2\">$theemp_name2</option>";

$k++;

  }

$current_month = date("F");
$year = date("Y");
$month = date("m");

print "
<option value=\"javascript:self.focus();\"></option>
<option value=\"/pcac2/list.php?type=projects&view=cal&y=$y&m=$m\">View $current_month</option>
<option value=\"/pcac2/list.php?type=projects&view=DUE_DATE\">View by Due Date</option>
</SELECT>";

} else {

print "<a href=\"/pcac2/list.php?type=projects\">List Tickets</a>";

}

print "</form></center>";

?>