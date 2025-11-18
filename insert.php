<?php

// this is the INSERT.PHP script for http://www.aretemm.net/phpTickets/

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
 
if ($type == 'personnel') {

  if ($emp_title == 'group') {
	$emp_group = '';
  }

 if ($_REQUEST['submitBtn'] == "Add Entry") {
  // The submit button was clicked!
  // Get the input for fullname and email then store it in the database.

  $connection = mysql_connect($DBhost,$DBuser,$DBpass);
  if ($connection == false){
    echo mysql_errno().": ".mysql_error()."<BR>";
    exit;
  }   

  $query = "insert into personnel (emp_id,emp_name,emp_email,emp_title,emp_group,emp_address,emp_phone_hm,emp_phone_cell,emp_notes) values ('$emp_id','$emp_name','$emp_email','$emp_title','$emp_group','$emp_address','$emp_phone_hm','$emp_phone_cell','$emp_notes')";
  $result = mysql_db_query($DBName, $query);

  $query2 = "SELECT MAX(emp_id) as emp_id FROM personnel";
  $result2 = mysql_db_query($DBName, $query2);

	$emp_id = mysql_result($result2,$i,"emp_id");

	  if ($result){
   		echo "<html><head><script language=\"JavaScript\">"; include('js/mouseover.js'); print "</script></head><body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0>";

			include("includes/topframe.inc"); 
			print "
			<center>
			<table><tr><td align=\"center\"><img src=\"./images/success_logo1.jpg\"></td></tr>
			<tr><td>
			<table border=0 cellpadding=5 width=500 bgcolor=\"#DDDDDD\">
			 <tr>
			  <th>You updated the Employee information in the Database.</th>
			 </tr>
			 <tr>
			  <td bgcolor=\"#FFFFFF\" align=\"center\">		
			    <table>
			      <tr>
				<td>
				<ul>&nbsp;
	   			<li><b>Name</b>: <a href=\"show.php?type=personnel&id=$emp_id\">$emp_name</a></li>
				<li><b>Email</b>: $emp_email</li>
	   			<li><b>Title</b>: $emp_title</li>
				<li><b>Group</b>: $emp_group</li>
				<li><b>Home Address</b>: $emp_address</li>
				<li><b>Home Phone</b>: $emp_phone_hm</li>
				<li><b>Cell Phone</b>: $emp_phone_cell</li>
				<li><b>Notes</b>: $emp_notes</li>
				</ul>
				</td>
			      </tr>
			    </table>
			  </td>
		 	 </tr>
			</table></td></tr></table>
			</center>
		      </body></html>
		";
		
		} else {
    		echo mysql_errno().": ".mysql_error()."<BR>";
  		}
		  mysql_close ();

 } else { 

 echo "
  <html>
  <head>
  <SCRIPT LANGUAGE=\"JavaScript\">
  <!--
  function validate(object,text) {
      	if(object.value.length > 0)
          	return true;
    	else {
        	alert(text + ' field empty!');
        	if (navigator.appName.indexOf('Netscape') > -1) {
              		object.focus();
          	}
        	return false;
    	}
  }

  function setTitleTo(value) {

	window.document.insert.emp_title.value = value;

  }

  function disableEmpGroup() {
	if(document.insert.emp_title.value == 'group') {
		document.insert.emp_group.disabled = true;
		document.insert.emp_group.selectedIndex = 0;
	}
  }

  function enableEmpGroup() {
	if(document.insert.emp_title.value !== 'group') {
		document.insert.emp_group.disabled = false;
	}	
  }

";

include('js/mouseover.js');

print "

  //--></SCRIPT>

  </head>
	<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0>";

  include("includes/topframe.inc");

  print "
  <center>
  <img src=\"./images/add_personnel_logo1.jpg\">
  <table><tr><td>
  <form name=\"insert\" action=\"insert.php\">
  <input type=\"hidden\" name=\"type\" value=\"$type\">
  <input type=\"hidden\" name=\"emp_id\">
  <table border=0 cellpadding=5 bgcolor=\"#CCCCCC\">
   <tr>
    <th><font size=\"-1\" color=\"#CCCCCC\">*</font>Name<font color=\"red\" size=\"-1\">*</font></th>
    <td bgcolor=\"#FFFFFF\"><input type=\"text\" name=\"emp_name\"></td>
   </tr>
   <tr>
    <th><font size=\"-1\" color=\"#CCCCCC\">*</font>Email<font color=\"red\" size=\"-1\">*</font></th>
    <td bgcolor=\"#FFFFFF\"><input type=\"text\" name=\"emp_email\"></td>
   </tr>
   <tr>
    <th>Title</th>
    <td bgcolor=\"#FFFFFF\"><input type=\"text\" name=\"emp_title\" onChange=\"enableEmpGroup();\"><br><font size=\"-2\"><i>Note: To set an entry as a Group, set Title to <a href=\"#\" onClick=\"setTitleTo('group');\">group</a>.</i></font></td>
   </tr>
   <tr>
    <th>Group</th>
    <td bgcolor=\"#FFFFFF\">
    <select name=\"emp_group\" onMouseOver=\"disableEmpGroup();\">
	<option></option>";


mysql_connect($DBhost,$DBuser,$DBpass) or die("Unable to connect to database");
@mysql_select_db("$DBName") or die("Unable to select database $DBName"); 

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

print "
    </select>
  </td>
 </tr>
   <tr>
    <th>Address</th>
    <td bgcolor=\"#FFFFFF\"><textarea name=\"emp_address\" wrap=\"virtual\" rows=5 cols=36></textarea></td>
   </tr>
   <tr>
    <th>Home Phone</th>
    <td bgcolor=\"#FFFFFF\"><input type=\"text\" name=\"emp_phone_hm\"></td>
   </tr>
   <tr>
    <th>Cell Phone</th>
    <td bgcolor=\"#FFFFFF\"><input type=\"text\" name=\"emp_phone_cell\"></td>
   </tr>
   <tr>
    <th>Notes</th>
    <td bgcolor=\"#FFFFFF\"><textarea name=\"emp_notes\" wrap=\"virtual\" rows=5 cols=36></textarea></td>
   </tr>
  </table></td></tr></table>
<font size=\"-1\"><font color=\"red\">*</font> denotes required fields</font>
  <p>
  <input type=\"submit\" name=\"submitBtn\" value=\"Add Entry\" onFocus=\"validate(this.form.emp_name,'Name'); validate(this.form.emp_email,'Email');\"></input>
      </form>
      </center>
      </body></html>
    ";

 }

 
} else {


 if ($_REQUEST['submitBtn'] == "Add Entry") {
  // The submit button was clicked!
  // Get the input for fullname and email then store it in the database.



  $connection = mysql_connect($DBhost,$DBuser,$DBpass);
  if ($connection == false){
    echo mysql_errno().": ".mysql_error()."<BR>";
    exit;
  }   

  if(strlen($proj_due_dt) < '1') { $proj_due_dt = '12/31/2010'; }

  $query = "insert into projects (proj_id,proj_name,proj_submitter,proj_create_dt,proj_status,proj_type,proj_desc,proj_notes,proj_assignee,proj_priority,proj_due_dt) values ('$proj_id','$proj_name','$proj_submitter','$proj_create_dt','$proj_status','$proj_type','$proj_desc','$proj_notes','$proj_assignee','$proj_priority','$proj_due_dt')";
  $result = mysql_db_query($DBName, $query);

  $query2 = "SELECT MAX(proj_id) as proj_id FROM projects";
  $result2 = mysql_db_query($DBName, $query2);

	$theproj_id = mysql_result($result2,$i,"proj_id");

  $query3 = "insert into parent_child_rel (parent,child) values ('0','$theproj_id')";
  mysql_db_query($DBName, $query3);

  if ($result){
    		echo "<html><head><script language=\"JavaScript\">"; include('js/mouseover.js'); print "</script></head><body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0>";

			include("includes/topframe.inc"); 

		print "
			<center>
			<table><tr><td align=\"center\"><img src=\"./images/success_logo1.jpg\"></td></tr>
			<tr><td>
			<table border=0 cellpadding=5 width=500 bgcolor=\"#DDDDDD\">
			 <tr>
			  <th>You added Project #$theproj_id to the Database.</th>
			 </tr>
			 <tr>
			  <td bgcolor=\"#FFFFFF\">";

  $query2 = "SELECT MAX(proj_id) as proj_id FROM projects";
  $result2 = mysql_db_query($DBName, $query2);

	$proj_id = mysql_result($result2,$i,"proj_id");

		echo "		
				<ul>&nbsp;
	   			<li><b>Title</b>: <a href=\"show.php?type=projects&id=$proj_id\">$proj_name</a></li>
	   			<li><b>Due Date</b>: <?php if($proj_due_dt !== '12/31/2010') { echo $proj_due_dt; } ?></li>
	   			<li><b>Submitter</b>: $proj_submitter</li>
	   			<li><b>Status</b>: $proj_status</li>
	   			<li><b>Priority</b>: $proj_priority</li>
	   			<li><b>Assignee</b>: $proj_assignee</li>
	   			<li><b>Type</b>: $proj_type</li>
	   			<li><b>Description</b>: $proj_desc2</li>
	   			<li><b>Notes</b>: $proj_notes2</li>
				</ul>
			  </td>
		 	 </tr>
			</table></td></tr></table>
			</center>
		      </body></html>
		";

		include ("includes/mail2.inc");
		
		} else {
    		echo mysql_errno().": ".mysql_error()."<BR>";
  		}
		  mysql_close ();

 } else { 

 echo "
<html>
<head>

<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"js/CalendarPopup.js\"></SCRIPT>

<SCRIPT LANGUAGE=\"JavaScript\">
<!--
function validate(object,text) {
      	if(object.value.length > 0)
          	return true;
    	else {
        	alert(text + ' must be filled out to add a ticket!');
        	if (navigator.appName.indexOf('Netscape') > -1) {
              		object.focus();
          	}
        	return false;
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

";

include('js/mouseover.js');

print "

  //--></SCRIPT>

  </head>
	<body bgcolor=\"#FFFFFF\" text=\"#000000\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0>";

include("includes/topframe.inc");

print "
<center>
  <img src=\"./images/open_new_project_logo1.jpg\">
<table><tr><td>
<form name=\"insert\" action=\"insert.php\">
<input type=\"hidden\" name=\"type\" value=\"$type\">
<input type=\"hidden\" name=\"proj_id\">
<input type=\"hidden\" name=\"proj_create_dt\" value=\"$today\">
<input type=\"hidden\" name=\"proj_submitter\" value=\"".$_SESSION['username']."\">
<table border=0 cellpadding=5 bgcolor=\"#CCCCCC\">
 <tr>
  <th><font size=\"-1\" color=\"#CCCCCC\">*</font><a href=\"detail.php?help=y&helpindex=0\" onClick=\"open_window(this.href,'name','400','200','yes');return false;\">Title</a><font color=\"red\" size=\"-1\">*</font></th>
  <td bgcolor=\"#FFFFFF\"><input type=\"text\" size=\"50\" maxlength=\"50\" name=\"proj_name\"></td>
 </tr>
 <tr>
  <th>Status</th>
   <td bgcolor=\"#FFFFFF\">
    <select name=\"proj_status\">
	<option value=\"OPEN\">OPEN</option> 
	<option value=\"ASSIGNED\">ASSIGNED</option>
    </select>
  </td>
 </tr>
 <tr>
  <th>Assignee</th>
  <td bgcolor=\"#FFFFFF\"><select name=\"proj_assignee\" onChange=\"setStatusToAssigned(this.form);\">
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

if (($theemp_title !== 'none') && ($theemp_title !== 'group' )) {
	print "<option value=\"$theemp_name\">$theemp_name</option>";
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
	<option value=\"1\">&nbsp;1&nbsp;</option>
	<option value=\"2\">&nbsp;2&nbsp;</option>
	<option value=\"3\">&nbsp;3&nbsp;</option>
	<option value=\"4\">&nbsp;4&nbsp;</option>
	<option value=\"5\">&nbsp;5&nbsp;</option>
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
cal.addDisabledDates(\"12/25/2003\");
cal.addDisabledDates(\"Jan 1, 2009\",null);
</SCRIPT>
<input type=\"text\" name=\"proj_due_dt\" size=\"10\">
<A HREF=\"#\" onClick=\"cal.select(document.insert.proj_due_dt,'anchor17','MM/dd/yyyy'); return false;\" NAME=\"anchor17\" ID=\"anchor17\"><font size=\"-1\">select</font></A>
<br><font size=\"-2\"><i>*note: use</i> mm/dd/yyyy <i>format</i></font>
  </td>
 </tr>
 <tr>
  <th>Type</th>
  <td bgcolor=\"#FFFFFF\">
    <select name=\"proj_type\">
	<option></option>";
	include("./includes/ticket-type.inc");
print "
    </select>
  </td>
 </tr>
 <tr>
  <th><font size=\"-1\" color=\"#CCCCCC\">*</font><a href=\"detail.php?help=y&helpindex=1\" onClick=\"open_window(this.href,'name','400','165','yes');return false;\">Description</a><font color=\"red\" size=\"-1\">*</font></th>
  <td bgcolor=\"#FFFFFF\"><textarea name=\"proj_desc\" wrap=\"virtual\" rows=5 cols=36></textarea></td>
 </tr>
 <tr>
  <th>Notes</th>
  <td bgcolor=\"#FFFFFF\"><textarea name=\"proj_notes\" wrap=\"virtual\" rows=5 cols=36></textarea></td>
 </tr>
 <tr>
  <th><a href=\"help/cc_list.php?type=insert\" onClick=\"open_window(this.href,'name','200','300','yes');return false;\">Cc List</a></th>      
  <td bgcolor=\"#FFFFFF\"><font size=\"-2\"><i>This field can be used to notify others of a ticket's creation.</i></font><br><textarea name=\"cc_list\" wrap=\"virtual\" rows=2 cols=36></textarea><br><font size=\"-2\"><i>*note: use a comma or space to separate email addresses</i></font></td>
 </tr>
</table></td></tr></table>
<font size=\"-1\"><font color=\"red\">*</font> denotes required fields</font>
 <p>
 <input type=\"submit\" name=\"submitBtn\" value=\"Add Entry\" onFocus=\"validate(this.form.proj_name,'Project Title'); validate(this.form.proj_desc,'Description');\"></input>
    </form>
</td></tr></table>
    </center></body></html>
  ";

 }

}

$db_object->disconnect();

?>