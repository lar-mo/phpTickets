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

print "<html>
<head><title>Show Details</title>

<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"./js/CalendarPopup.js\"></SCRIPT>

<SCRIPT LANGUAGE=\"JavaScript\">
<!--

function valid()//This checks that all fields were filled in 
{ 
var V1 = document.update.proj_name.value; 
var V2 = document.update.proj_desc.value; 

if ((V1.length > 0)&&(V2.length > 0)) 
{ 
return true; 
} 
else 
{ 
alert('You must fill out all fields on this form before it can be processed. Please fill out all fields and try again.');return false; 
} 
} 

function open_window(mypage, myname, w, h, scroll, resize) {
	var winl = ((screen.width - w) / 4) * 3;
	var wint = (screen.height - h) / 2;
	winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable=no'
	win = window.open(mypage, myname, winprops)
		if (parseInt(navigator.appVersion) >= 4) { 
			win.window.focus(); 
		}
}

  function setStatusToAssigned(f) {
	if ((f.proj_assignee.selectedIndex > 0) && (f.proj_status.selectedIndex < 1)) {
		f.proj_status.selectedIndex = 1;
	}

	if ((f.proj_assignee.selectedIndex < 1) && (f.proj_status.selectedIndex > 0)) {
		f.proj_status.selectedIndex = 0;
	}
  }

  function setTitleTo(value) {

	document.update.emp_title.value = value;
	document.update.emp_group.selectedIndex = 0;

  }

  function disableEmpGroup() {
	if(document.update.emp_title.value == 'group') {
		document.update.emp_group.disabled = true;
		document.update.emp_group.selectedIndex = 0;
	}
  }

  function enableEmpGroup() {
	if(document.update.emp_title.value !== 'group') {
		document.update.emp_group.disabled = false;
	}	
  }

  function submitConfirm() {
	if(window.confirm('Are you sure you want to delete this record?') == true) {
		return true;
	} else {
		return false;
	}
  }

function closePopup()
 {
    win.close ();
 }


// --> ";

include("js/mouseover.js");

print "

</SCRIPT>

</head>
<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=10>";

include("includes/topframe.inc");

include ("includes/vars.inc");

mysql_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database");
@mysql_select_db("$DBName") or die("Unable to select database $DBName"); 

if ($type == 'personnel') {

$sqlquery = "SELECT * FROM $type WHERE emp_id LIKE '$id'";
$result = mysql_query($sqlquery);
$number = @mysql_numrows($result);

$i = 0;

if ($number < 1) {
print "<CENTER><P>There Were No Results for Your Search</CENTER>";

} else {

while ($number > $i) {
$theemp_id = mysql_result($result,$i,"emp_id");
$theemp_name = mysql_result($result,$i,"emp_name");
$theemp_login = mysql_result($result,$i,"emp_login");
$theemp_email = mysql_result($result,$i,"emp_email");
$theemp_title = mysql_result($result,$i,"emp_title");
$theemp_address = mysql_result($result,$i,"emp_address");
$theemp_phone_hm = mysql_result($result,$i,"emp_phone_hm");
$theemp_phone_cell = mysql_result($result,$i,"emp_phone_cell");
$theemp_notes = mysql_result($result,$i,"emp_notes");
$theemp_group = mysql_result($result,$i,"emp_group");

print "<center>
<table><tr><td align=\"center\">";

$check = $db_object->query("SELECT auth_level FROM users WHERE username = '".$_SESSION['username']."'");
$info = $check->fetchRow();

if(($_SESSION['username'] == $theemp_login) || ($info['auth_level'] < '3')) {
	print "<form name=\"update\" action=\"update.php\">";
} else {
	print "<form name=\"update\">";
}

print "
<input type=\"hidden\" name=\"type\" value=\"personnel\">
<input type=\"hidden\" name=\"emp_id\" value=\"$theemp_id\">
<input type=\"hidden\" name=\"auth_level\" value=\"".$info['auth_level']."\">

<input type=\"hidden\" name=\"old_emp_name\" value=\"$theemp_name\">
<input type=\"hidden\" name=\"old_emp_email\" value=\"$theemp_email\">
<input type=\"hidden\" name=\"old_emp_title\" value=\"$theemp_title\">
<input type=\"hidden\" name=\"old_emp_address\" value=\"$theemp_address\">
<input type=\"hidden\" name=\"old_emp_phone_hm\" value=\"$theemp_phone_hm\">
<input type=\"hidden\" name=\"old_emp_phone_cell\" value=\"$theemp_phone_cell\">
<input type=\"hidden\" name=\"old_emp_group\" value=\"$theemp_group\">

<table><tr><td><img src=\"./images/update_record_logo1.jpg\"></td><td>&nbsp;<b><i>#$theemp_id:</i></b>&nbsp;$theemp_name</td></tr></table></td></tr>
<tr><td>
<table border=0 cellpadding=5 bgcolor=\"#CCCCCC\">";

if(strlen($theemp_login ?? '') > '0') {

print "
 <tr>
  <th>Login</th>
  <td bgcolor=\"#FFFFFF\"><input type=\"text\" name=\"emp_login\" value=\"$theemp_login\" onFocus=\"this.blur();\"><br><font size=\"-2\"><i>Note: You cannot edit your login.</font></td>
 </tr>
";

$getAuth = $db_object->query("SELECT auth_level FROM users WHERE username = '$theemp_login'");
$authlevel = $getAuth->fetchRow();

$getAuth2 = $db_object->query("SELECT auth_level FROM users WHERE username = '".$_SESSION['username']."'");
$authlevel2 = $getAuth2->fetchRow();

 if($authlevel2['auth_level'] == '1') {
	print "
	 <tr>
 	  <th>User Level</th>
 	  <td bgcolor=\"#FFFFFF\">
	   <input type=\"radio\" name=\"auth_level\" value=\"3\""; if($authlevel['auth_level'] == '3') { echo ' checked'; } print ">Basic
	   <input type=\"radio\" name=\"auth_level\" value=\"2\""; if($authlevel['auth_level'] == '2') { echo ' checked'; } print ">Admin
	  </td>
	 </tr>
	";
 }

}

print "
 <tr>
  <th><font size=\"-1\" color=\"#CCCCCC\">*</font>Name<font color=\"red\" size=\"-1\">*</font></th>
  <td bgcolor=\"#FFFFFF\"><input type=\"text\" name=\"emp_name\" value=\"$theemp_name\"></td>
 </tr>
 <tr>
  <th><font size=\"-1\" color=\"#CCCCCC\">*</font>Email<font color=\"red\" size=\"-1\">*</font></th>
  <td bgcolor=\"#FFFFFF\"><input type=\"text\" name=\"emp_email\" value=\"$theemp_email\"></td>
 </tr>
 <tr>
  <th>Title</th>
  <td bgcolor=\"#FFFFFF\"><input type=\"text\" name=\"emp_title\" value=\"$theemp_title\" onChange=\"enableEmpGroup();\"><br><font size=\"-2\"><i>Note: To set an entry as a Group, set Title to <a href=\"#\" onClick=\"setTitleTo('group');\">group</a>.</i></font></td>
 </tr>
 <tr>
  <th>Group</th>
  <td bgcolor=\"#FFFFFF\">
    <select name=\"emp_group\" onMouseOver=\"disableEmpGroup();\">
	<option></option>";

$sqlquery = "SELECT emp_name FROM personnel WHERE emp_title = 'group'";
$result = mysql_query($sqlquery); 
$number = @mysql_numrows($result);

$i = 0;

// while loop to display all the records that were returned

	while ($number > $i) {

$theemp_name = mysql_result($result,$i,"emp_name");

	print "<option value=\"$theemp_name\"";	
		if($theemp_group == $theemp_name) echo 'selected'; 
	print ">$theemp_name</option>\n\t";

$i++;
	}

print "
   </select>
  </td>
 </tr>
 <tr>
  <th>Address</th>
  <td bgcolor=\"#FFFFFF\"><textarea name=\"emp_address\" wrap=\"hard\" rows=5 cols=36>$theemp_address</textarea></td>
 </tr>
 <tr>
  <th>Home Phone</th>
  <td bgcolor=\"#FFFFFF\"><input type=\"text\" name=\"emp_phone_hm\" value=\"$theemp_phone_hm\"></td>
 </tr>
 <tr>
  <th>Cell Phone</th>
  <td bgcolor=\"#FFFFFF\"><input type=\"text\" name=\"emp_phone_cell\" value=\"$theemp_phone_cell\"></td>
 </tr>
 <tr>
  <th>Notes</th>
  <td bgcolor=\"#FFFFFF\"><textarea name=\"emp_notes\" wrap=\"hard\" rows=5 cols=36>$theemp_notes</textarea></td>
 </tr>
</table><center>

<table width=300>
<tr><td align=center>";

  if(($_SESSION['username'] == $theemp_login) || ($info['auth_level'] < '3')) {
	print "<font size=\"-1\"><font color=\"red\">*</font> denotes required fields</font><p><input type=submit name=update value=update onClick=\"updateButtonClicked(this.value);\" onMouseDown=\"validate(this.form.emp_name,'Name'); validate(this.form.emp_email,'Email');\">
	<input type=\"hidden\" name=\"old_auth_level\" value=\""; echo $authlevel['auth_level']; print "\"></form>";
  }

print "</td><td align=center>";

  if($info['auth_level'] < '3') {
	print "<font size=\"-1\"><font color=\"red\">&nbsp;</font><p><form name=\"DeleteEmp\" action=\"delete.php\" onSubmit=\"return submitConfirm();\"><input type=submit name=delete value=delete>
	<input type=\"hidden\" name=\"type\" value=\"personnel\"><input type=\"hidden\" name=\"emp_id\" value=\"$theemp_id\"></form>";
  }

print "</td></tr></table></center></td></tr></table></center>";

$i++;
  }
 }

} else {

$sqlquery = "SELECT proj_id, proj_name, proj_submitter, date_format(proj_create_dt, '%c/%e/%y %l:%i:%s %p') as proj_create_dt, proj_type, proj_status, proj_desc, proj_notes, proj_assignee, proj_priority, date_format(proj_update_dt, '%c/%e/%y') as proj_update_dt, proj_due_dt FROM $type WHERE proj_id LIKE '$id'";
$result = mysql_query($sqlquery);
$number = @mysql_numrows($result);

$i = 0;

if ($number < 1) {
print "<CENTER><P>There Were No Results for Your Search</CENTER>";

} else {

while ($number > $i) {
$theproj_id = mysql_result($result,$i,"proj_id");
$theproj_name = mysql_result($result,$i,"proj_name");
$theproj_submitter = mysql_result($result,$i,"proj_submitter");
$theproj_create_dt = mysql_result($result,$i,"proj_create_dt");
$theproj_status = mysql_result($result,$i,"proj_status");
$theproj_type = mysql_result($result,$i,"proj_type");
$theproj_desc = mysql_result($result,$i,"proj_desc");
$theproj_notes = mysql_result($result,$i,"proj_notes");
$theproj_assignee = mysql_result($result,$i,"proj_assignee");
$theproj_priority = mysql_result($result,$i,"proj_priority");
$theproj_update_dt = mysql_result($result,$i,"proj_update_dt");
$theproj_due_dt = mysql_result($result,$i,"proj_due_dt");

$theproj_name2 = htmlentities($theproj_name);
$theproj_desc2 = htmlentities($theproj_desc);

print "<center><table><tr><td align=\"center\">";

if(strlen($_SESSION['username']) > '1') {
print "
<form name=\"update\" action=\"update.php\" method=\"POST\" onSubmit=\"return valid()\">
<input type=\"hidden\" name=\"type\" value=\"projects\">
<input type=\"hidden\" name=\"proj_id\" value=\"$theproj_id\">
<input type=\"hidden\" name=\"proj_create_dt\" value=\"$theproj_create_dt\">
<input type=\"hidden\" name=\"proj_update_dt\" value=\"$today\">
<input type=\"hidden\" name=\"proj_submitter\" value=\"$theproj_submitter\">

<input type=\"hidden\" name=\"old_proj_name\" value=\"$theproj_name2\">
<input type=\"hidden\" name=\"old_proj_status\" value=\"$theproj_status\">
<input type=\"hidden\" name=\"old_proj_due_dt\" value=\"$theproj_due_dt\">
<input type=\"hidden\" name=\"old_proj_priority\" value=\"$theproj_priority\">
<input type=\"hidden\" name=\"old_proj_assignee\" value=\"$theproj_assignee\">
<input type=\"hidden\" name=\"old_proj_type\" value=\"$theproj_type\">";
} else {
print "<form name=\"update\">";
}

print "
<table><tr><td><table><tr><td><img src=\"./images/update_ticket_logo1.jpg\"></td><td>&nbsp;<b><i>#$theproj_id:</i></b>&nbsp;$theproj_name</td></tr></table></td></tr>
<tr><td align=\"center\"><font size=\"-1\">Created on $theproj_create_dt by $theproj_submitter</font></td></tr></table></td></tr>
<tr><td>
<table border=0 cellpadding=5 bgcolor=\"#CCCCCC\">
 <tr>
  <th><font size=\"-1\" color=\"#CCCCCC\">*</font><a href=\"detail.php?help=y&helpindex=0\" onClick=\"open_window(this.href,'name','400','200','yes');return false;\">Title</a><font color=\"red\" size=\"-1\">*</font></th>
  <td bgcolor=\"#FFFFFF\"><input type=\"text\" name=\"proj_name\" value=\"$theproj_name2\" size=\"50\" maxlength=\"50\"></td>
 </tr>
 <tr>
  <th>Status</th>
  <td bgcolor=\"#FFFFFF\">
    <select name=\"proj_status\">
	<option value=\"OPEN\" ";
	if($theproj_status == 'OPEN') echo 'selected'; 
	print ">OPEN</option> 
	<option value=\"ASSIGNED\" "; 
	if($theproj_status == 'ASSIGNED') echo 'selected'; 
	print ">ASSIGNED</option> 
	<option value=\"PENDING\" ";
	if($theproj_status == 'PENDING') echo 'selected'; 
	print ">PENDING</option> 
	<option value=\"VERIFIED\" ";
	if($theproj_status == 'VERIFIED') echo 'selected'; 
	print ">VERIFIED</option>
	<option value=\"CLOSED\" ";
	if($theproj_status == 'CLOSED') echo 'selected'; 
	print ">CLOSED</option>
	<option value=\"CANCELED\" ";
	if($theproj_status == 'CANCELED') echo 'selected'; 
	print ">CANCELED</option>
	<option value=\"WONTFIX\" ";
	if($theproj_status == 'WONTFIX') echo 'selected'; 
	print ">WONTFIX</option>
    </select>
  </td>
 </tr>
 <tr>
  <th>Assignee</th>
  <td bgcolor=\"#FFFFFF\">
	<select name=\"proj_assignee\" onChange=\"setStatusToAssigned(this.form);\">	
	<option></option>";

$sqlquery = "SELECT emp_name FROM personnel WHERE emp_title = 'group'";
$result = mysql_query($sqlquery); 
$number = @mysql_numrows($result);

$i = 0;

// while loop to display all the records that were returned

	while ($number > $i) {

$theemp_name = mysql_result($result,$i,"emp_name");

	print "<option value=\"$theemp_name\"";	
		if($theproj_assignee == $theemp_name) echo 'selected'; 
	print ">$theemp_name</option>\n\t";

$i++;
	}

$sqlquery = "SELECT emp_name, emp_title FROM personnel WHERE emp_login <> ''";
$result = mysql_query($sqlquery); 
$number = @mysql_numrows($result);

$i = 0;

if ($number < 1) {
	print "<CENTER><P>There Were No Results for Your Search</CENTER>";
} else {

// while loop to display all the records that were returned

	while ($number > $i) {

$theemp_name = mysql_result($result,$i,"emp_name");
$theemp_title = mysql_result($result,$i,"emp_title");

if (($theemp_title !== 'group') && ($theemp_title !== 'none' )) {
	print "<option value=\"$theemp_name\"";	
		if($theproj_assignee == $theemp_name) echo 'selected'; 
	print ">$theemp_name</option>\n\t";
}

$i++;
 }
}

print "
   </select>
  </td>
 </tr>
 <tr>
  <th>Priority</th>
  <td bgcolor=\"#FFFFFF\">    
    <select name=\"proj_priority\">
	<option value=\"1\" ";
	if($theproj_priority == '1') echo 'selected';
	print ">&nbsp;1&nbsp;</option>
	<option value=\"2\" ";
	if($theproj_priority == '2') echo 'selected';
	print ">&nbsp;2&nbsp;</option>
	<option value=\"3\" ";
	if($theproj_priority == '3') echo 'selected';
	print ">&nbsp;3&nbsp;</option>
	<option value=\"4\" ";
	if($theproj_priority == '4') echo 'selected';
	print ">&nbsp;4&nbsp;</option>
	<option value=\"5\" ";
	if($theproj_priority == '5') echo 'selected';
	print ">&nbsp;5&nbsp;</option>
    </select>
	<font size=\"-1\">1 (Low) to 5 (High)</font>
  </td>
 </tr>
 <tr>
  <th>Due Date</th>
  <td bgcolor=\"#FFFFFF\">
  <SCRIPT LANGUAGE=\"JavaScript\">
  var now = new Date();
  var cal = new CalendarPopup();
  cal.addDisabledDates(null,formatDate(now,\"yyyy-MM-dd\"));
  </SCRIPT>
  <input type=\"text\" name=\"proj_due_dt\" value='"; if($theproj_due_dt !== '12/31/2010') { echo "$theproj_due_dt"; } print "' size=\"10\">
  <A HREF=\"#\" onClick=\"cal.select(document.update.proj_due_dt,'anchor17','MM/dd/yyyy'); return false;\" NAME=\"anchor17\" ID=\"anchor17\"><font size=\"-1\">select</font></A>
  <br><font size=\"-2\"><i>*note: use</i> mm/dd/yyyy <i>format</i></font>
  </td>
 </tr>
 <tr>
  <th>Type</th>
  <td bgcolor=\"#FFFFFF\">
    <select name=\"proj_type\">
	<option></option>";
	include("./includes/ticket-type2.inc");
print "
    </select>
  </td>
 </tr>
 <tr>
  <th><font size=\"-1\" color=\"#CCCCCC\">*</font><a href=\"detail.php?help=y&helpindex=1\" onClick=\"open_window(this.href,'name','400','165','yes');return false;\">Description</a><font color=\"red\" size=\"-1\">*</font></th>
  <td bgcolor=\"#FFFFFF\"><textarea name=\"proj_desc\" wrap=\"virtual\" rows=5 cols=36 "; $check2 = $db_object->query("SELECT auth_level FROM users WHERE username = '".$_SESSION['username']."'"); $info2 = $check2->fetchRow(); if($info2['auth_level'] == '3') { echo "onFocus=\"this.blur();\""; } print ">$theproj_desc2</textarea></td>
</tr>
"; 
if(strlen($theproj_update_dt ?? '') > '1') { 
echo "
<tr>
  <td align=\"center\"><b>Notes</b><br><font size=\"-2\">Last Updated $theproj_update_dt</font></td>      
  <td bgcolor=\"#FFFFFF\" width=\"350\"><center><font size=\"-1\">Oldest to Newest:</font></center><br>$theproj_notes</td>
 </tr>
";
}
print "
 <tr>
  <td align=\"center\"><b>Add Notes</b></td>      
  <td bgcolor=\"#FFFFFF\"><textarea name=\"proj_notes\" wrap=soft rows=5 cols=36></textarea></td>
 </tr>
 <tr>
  <th><a href=\"help/cc_list.php?type=update\" onClick=\"open_window(this.href,'name','200','300','yes');return false;\">Cc List</a></th>      
  <td bgcolor=\"#FFFFFF\"><font size=\"-2\"><i>This field can be used to notify others of a ticket update.</i></font><br><textarea name=\"cc_list\" id=\"cc_list\" wrap=soft rows=2 cols=36></textarea><br><font size=\"-2\"><i>*note: use a comma or space to separate email addresses</i></font></td>
 </tr>
 <tr>
  <td align=\"center\"><b>Related Tickets</b><br><font size=\"-1\">(<a href=\"insert_child.php?type=projects&parent_id=$theproj_id\">open child</a>)</font></td>";

$sqlquery2 = "SELECT parent FROM parent_child_rel WHERE child = $theproj_id";
$result2 = mysql_query($sqlquery2);
$number2 = @mysql_numrows($result2);
$j = 0;

	if ($number2 < 1) {

	print "<td bgcolor=\"#FFFFFF\"><input type=\"text\" name=\"parent_id\" value=\"\" size=\"5\"></input> <font size=\"-1\">(parent)</font></td>";

	} else {
	
	print "<td bgcolor=\"#FFFFFF\">";

	  while ($number2 > $j) {

         $theproj_parent = mysql_result($result2,$j,"parent");

		print "<input type=\"text\" name=\"parent_id\" value=\""; if($theproj_parent > '0') { $theproj_parent_x = $theproj_parent; } else { $theproj_parent_x = ''; } echo $theproj_parent_x; print "\" size=\"5\"></input> <font size=\"-1\">("; if($theproj_parent > '0') { echo "<a href='list_project.php?parent_id=$theproj_parent'>parent</a>"; } else { echo "parent"; } print ")</font>";
	
	  $j++;

	  }

	}


$sqlquery3 = "SELECT child FROM parent_child_rel WHERE parent = $theproj_id";
$result3 = mysql_query($sqlquery3);
$number3 = @mysql_numrows($result3);
$k = 0;

	if ($number3 > 0) {
		
	print "&nbsp;|&nbsp;";

	  while ($number3 > $k) {

          $theproj_child = mysql_result($result3,$k,"child");

		echo "<a href=\"show.php?type=projects&id=$theproj_child\">$theproj_child</a>";

		if ($number3 - 1 == $k) {
		echo "";
		} else {
		echo ", ";
		}

	  $k++;

	  }

		if($k == '1') {
			if($theproj_id !== $theproj_child) { print " <font size=\"-1\">(child)</font>"; }
		} else { 
			print " <font size=\"-1\">(children)</font>";
		}

	}


print "</td></tr>
</table></td></tr></table><center>";

if(strlen($_SESSION['username']) > '1') {
	print "<font size=\"-1\"><font color=\"red\">*</font> denotes required fields</font><p>
<input type=\"hidden\" name=\"old_parent_id\" value=\"$theproj_parent\">
<input type=\"submit\" name=\"update\" value=\"update\" onClick=\"closePopup()\">
</form>
</center>";

}

print "</center></td></tr></table></center>";

$i++;
  }
 }


}

$db_object->disconnect();

?>
</BODY></HTML>