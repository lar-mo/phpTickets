<?

$request_uri = $_SERVER['REQUEST_URI'];

print "<center><form>
<b>Personnel:</b> <a href=\"insert.php?type=personnel\">ADD</a>&nbsp;<b>:</b>&nbsp;<a href=\"list.php?type=personnel\">List ALL</a> 
&nbsp;&nbsp;&nbsp;&nbsp;<b>::</b>&nbsp;&nbsp;&nbsp;&nbsp;<b>Projects:</b> <a href=\"insert.php?type=projects\">INSERT</a>&nbsp;<b>:</b>&nbsp;";

$match = strstr($request_uri, "list.php?type=projects");
if (strlen($match) > '1') {

print "Show Tickets by 
<select name=\"genre\" onChange=\"return goto_URL(this.form.genre)\">
<option value=\"javascript:self.focus();\">Status</option>
<option value=\"list.php?type=projects&view=ALL\">ALL</option>
<option value=\"list.php?type=projects&view=OPEN\">OPEN</option>
<option value=\"list.php?type=projects&view=ASSIGNED\">ASSIGNED</option>
<option value=\"list.php?type=projects&view=PENDING\">PENDING</option>
<option value=\"list.php?type=projects&view=CLOSED\">CLOSED</option>
<option value=\"list.php?type=projects&view=CANCELED\">CANCELED</option>
</SELECT>";

} else {

print "<a href=\"list.php?type=projects\">List ALL</a>";

}

print "
</center></form><p>
";

?>