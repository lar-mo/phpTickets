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

if ($_REQUEST['submitBtn'] == "Add Link") {

//do something, add link to this page

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
  <font size=\"+3\" face=\"courier new\"><b>Class Links</b></font>
	<table><tr><td bgcolor=\"#000000\">
	<table bgcolor=\"#FFFFFF\" cellpadding=\"10\"><tr>
	<td valign=\"top\">
	<h3>PSU Links</h3>
	<ul>
	<li><a href=\"http://www.oit.pdx.edu/\" target=\"new\">Office of Information Technologies</a></li>
	<li><a href=\"https://webmail.pdx.edu/\" target=\"new\">PSU Webmail</a></li>
	<li><a href=\"http://www.uss.pdx.edu/\" target=\"new\">User Support Systems</a></li>
	<li><a href=\"http://web.pdx.edu/documentation/unixhelp/\" target=\"new\">UNIXhelp for Users</a></li>
	</ul>
	</td>
	<td valign=\"top\">
	<h3>IDSC Lab</h3>
	<ul>
	<li><a href=\"http://www.idsc.pdx.edu/\" target=\"new\">Instructional Development Support Center</a></li>
	<li><a href=\"http://www.idsc.pdx.edu/resources/info.php?page=97\" target=\"new\">Resources: Lab Hardware</a></li>
	<li><a href=\"http://www.idsc.pdx.edu/resources/info.php?page=103\" target=\"new\">Resources: Lab Software</a></li>
	<li><a href=\"http://www.idsc.pdx.edu/resources/info.php?page=98\" target=\"new\">IDSC Media Library</a></li>
	</ul>

	</td></tr>
	<tr><td valign=\"top\">

	<h3>Client Liaison Group</h3>
	<ul>
	<li><a href=\"http://www.parks.ci.portland.or.us/Default.htm\" target=\"new\">Portland Parks & Recreation</a></li>
	<li><a href=\"http://www.parks.ci.portland.or.us/Levy/levyprojects.htm\" target=\"new\">PP&R Levy</a></li>
	<li><a href=\"http://www.portlandparksfoundation.org/\" target=\"new\">Portland Parks Foundation</a></li>
	<li><a href=\"http://www.parks.ci.portland.or.us/Planning/2020vision/index.htm\" target=\"new\">Parks 2020 Vision</a></li>
	<li><a href=\"http://www.parks.ci.portland.or.us/History/History_1852-1900.htm\" target=\"new\">PP&R History</a></li>
	</ul>
	</td><td valign=\"top\">
	<h3>Creative Group</h3>
	<ul>
	<li>* TBD</li>
	<li>* TBD</li>
	<li>* TBD</li>
	<li>* TBD</li>
	</ul>

	</td></tr>
	<tr><td valign=\"top\">

	<h3>Technical Group</h3>
	<ul>
	<li><a href=\"http://www.neostream.com/\" target=\"new\">Neostream</a></li>
	<li><a href=\"http://www.saltedherring.com/\" target=\"new\">Salted Herring</a></li>
	<li><a href=\"http://www.gotoandplay.net/\" target=\"new\">Goto+Play</a></li>
	<li><a href=\"http://www.flashkit.com/\" target=\"new\">FlashKit</a></li>
	<li><a href=\"http://www.asmble.com/\" target=\"new\">Asmble.com</a></li>
	</ul>
	</td><td valign=\"top\">
	<h3>Other Stuff</h3>
	<ul>
	<li><a href=\"http://www.ganttchart.com/\" target=\"new\">GANTT Charts</a></li>
	<li><a href=\"http://groups.yahoo.com/group/su042/\" target=\"new\">Yahoo Group for SU042</a></li>
	<li><a href=\"http://cae.pdx.edu/caps-stu03.pdf\" target=\"new\">Capstone Student Handbook</a></li>
	<li><a href=\"http://cae.pdx.edu/capst-stu-append.html\" target=\"new\">Capstone Student Handbook Appendix</a></li>
	</ul>

	</td></tr>
	<tr><td colspan=\"2\" align=\"center\">
	<table>
	<tr>
	<td>
	<h3>Books</h3>
	<ul>
	<li><a href=\"http://www.powells.com/cgi-bin/biblio?inkey=17-0961392126-0\" target=\"new\">Visual Explanations</a> (<a href=\"http://www.powells.com/search/DTSearch/search?author=Edward%20R%20Tufte\" target=\"new\">Tufte</a>)</li>
	<li><a href=\"http://www.powells.com/cgi-bin/biblio?inkey=4-0961392142-0\" target=\"new\">The Visual Display of Quantitative Information</a> (<a href=\"http://www.powells.com/search/DTSearch/search?author=Edward%20R%20Tufte\" target=\"new\">Tufte</a>)</li>
	<li><a href=\"http://www.powells.com/cgi-bin/biblio?inkey=1-0471390577-10\" target=\"new\">Digital Creativity: Techniques for Digital Media and the Internet</a> (<a href=\"http://www.powells.com/search/DTSearch/search?author=Bruce%20Wands\" target=\"new\">Wands</a>)</li>
	</ul>
	</td></tr></table>
	</td></tr></table>
	</td></tr></table>

<br><br>

  <form name=\"addlink\" action=\"add_link.php\">
<font size=\"+1\" face=\"courier new\"><b>Add Link</b></font>
	<table><tr><td bgcolor=\"#000000\">
	<table bgcolor=\"#FFFFFF\">
	<tr><td>Link Description:</td><td><input type=\"text\" name=\"link_desc\" size=\"30\"></td></tr>
	<tr><td>Link URL:</td><td><input type=\"text\" name=\"link_url\" size=\"30\" value=\"http://\"></td></tr>
	<tr><td colspan=\"2\" align=\"center\"><input type=\"submit\" name=\"submit\" value=\"Add Link\"></td></tr>
	</table>
	</td></tr></table>
  </form>

  </td></tr></table>
  </body></html>
  ";

}

?>