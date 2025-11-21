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

$conn = mysqli_connect($DBhost,$DBuser,$DBpass,$DBName) or die("Unable to connect to database");

$sqlquery = "SELECT emp_name FROM personnel WHERE emp_title = 'group'";
$result = mysqli_query($conn, $sqlquery);
$number = @mysqli_num_rows($result);

$i = 0;

if ($number < 1) {

print "<CENTER><P>There Were No Results for Your Search</CENTER>";

} else {

  while ($row = mysqli_fetch_assoc($result)) {
  $group_name = $row["emp_name"];

	$sqlquery2 = "SELECT emp_email, emp_title FROM personnel WHERE emp_group = '$group_name'";
	$result2 = mysqli_query($conn, $sqlquery2);

	  while ($row2 = mysqli_fetch_assoc($result2)) {
	  $theemp_email = $row2["emp_email"];
	  $theemp_title = $row2["emp_title"];

	if (($theemp_title !== 'none') && ($theemp_title !== 'group')) {

	$group_list[$i] .= "$theemp_email, ";

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


$sqlquery = "SELECT emp_name, emp_email, emp_title FROM personnel";
$result = mysqli_query($conn, $sqlquery);
$number = @mysqli_num_rows($result);

if ($number < 1) {

print "<CENTER><P>There Were No Results for Your Search</CENTER>";

} else {

  while ($row = mysqli_fetch_assoc($result)) {
  $theemp_name = $row["emp_name"];
  $theemp_email = $row["emp_email"];
  $theemp_title = $row["emp_title"];

if (($theemp_title !== 'none') && ($theemp_title !== 'group')) {

  print "
  <tr>
	<td><font size=\"-1\"><a href=\"#\" onClick=\"formFill('$theemp_email,');\">$theemp_name</a></font></td>
  </tr>
  ";

}

  }
}

print "
</table>
</center>
</BODY>
</HTML>
";
?>