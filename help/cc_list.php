<?php

include ("../includes/vars.inc");

print "<HTML>
<HEAD><TITLE>CC List Selector</TITLE>

<script language=\"JavaScript\">

 function formFill(value) {
	window.opener.$type.cc_list.value += value;
 }

 function clearAll() {
	window.opener.$type.cc_list.value = \"\";
 }

</script>

</HEAD>
<BODY>
<center>

<font size=\"-1\">Click the names to add<br>them to CC Field</font>
<hr>
<font size=\"-1\"><a href=\"#\" onClick=\"clearAll();\">clear all</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href=\"javascript:window.close();\">close window</a></font>
<hr>
<table border=0>";

mysql_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database");
@mysql_select_db("$DBName") or die("Unable to select database $DBName"); 

$sqlquery = "SELECT emp_name FROM personnel WHERE emp_title = 'group'";
$result = mysql_query($sqlquery);
$number = @mysql_numrows($result);

$i = 0;

if ($number < 1) {

print "<CENTER><P>There Were No Results for Your Search</CENTER>";

} else {

  while ($number > $i) {
  $group_name = mysql_result($result,$i,"emp_name");

	$sqlquery2 = "SELECT emp_email, emp_title FROM personnel WHERE emp_group = '$group_name'";
	$result2 = mysql_query($sqlquery2);
	$number2 = @mysql_numrows($result2);
	$j = 0;

	  while ($number2 > $j) {
	  $theemp_email = mysql_result($result2,$j,"emp_email");
	  $theemp_title = mysql_result($result2,$j,"emp_title");

	if (($theemp_title !== 'none') && ($theemp_title !== 'group')) {

	$group_list[$i] .= "$theemp_email, ";

	  $j++;

	  }

	}

print "  
  <tr>
	<td><font size=\"-1\"><a href=\"#\" onClick=\"formFill('$group_list[$i]');\">$group_name</a></font></td>
  </tr>
";

  $i++;

  }
}


mysql_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database");
@mysql_select_db("$DBName") or die("Unable to select database $DBName"); 

$sqlquery = "SELECT emp_name, emp_email, emp_title FROM personnel";
$result = mysql_query($sqlquery);
$number = @mysql_numrows($result);

$i = 0;

if ($number < 1) {

print "<CENTER><P>There Were No Results for Your Search</CENTER>";

} else {

  while ($number > $i) {
  $theemp_name = mysql_result($result,$i,"emp_name");
  $theemp_email = mysql_result($result,$i,"emp_email");
  $theemp_title = mysql_result($result,$i,"emp_title");

if (($theemp_title !== 'none') && ($theemp_title !== 'group')) {

  print "
  <tr>
	<td><font size=\"-1\"><a href=\"#\" onClick=\"formFill('$theemp_email,');\">$theemp_name</a></font></td>
  </tr>
  ";

}

  $i++;

  }
}

print "
</table>
</center>
</BODY>
</HTML>
";
?>