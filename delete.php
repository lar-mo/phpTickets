<?php

// this is the DELETE.PHP script for http://www.aretemm.net/phpTickets/

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

  $connection = mysqli_connect($DBhost,$DBuser,$DBpass,$DBName);
  if ($connection == false){
    echo mysqli_errno($connection).": ".mysqli_error($connection)."<BR>";
    exit;
  }   


if ($type == 'personnel') {

  		$query = "SELECT projects.proj_id, projects.proj_name FROM projects LEFT JOIN personnel ON projects.proj_assignee=personnel.emp_name WHERE personnel.emp_id=$emp_id";
  		$result = mysqli_query($connection, $query);
		$number = @mysqli_num_rows($result);
		$i = 0;

  		if ($number > 0){
    		echo "<html><head><script language=\"JavaScript\">"; include('js/mouseover.js'); print "</script></head><body text=\"#000000\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0>";

			include("includes/topframe.inc"); 
			print "
			<center>
			<table>
			<tr><td>
			<table border=0 cellpadding=5 width=500 bgcolor=\"#DDDDDD\">
			 <tr>
			  <th colspan=2>Warning! The phpTickets Database was <u>not</u> updated.</th>
			 </tr>
			 <tr>
			  <th><b>Error:</b></td><td bgcolor=\"#FFFFFF\">This person still has tickets assigned to them.</td>
			 </tr>
			 <tr>
			  <th><b>Tickets:</b></td><td bgcolor=\"#FFFFFF\">";
		
		while ($row = mysqli_fetch_assoc($result)) {
		$theproj_id = $row["proj_id"];
		$theproj_name = $row["proj_name"];
		print "<a href=\"show.php?type=projects&id=$theproj_id\">$theproj_id</a>: $theproj_name<br>";
		}

		print "
			  </td>
			 </tr>
			</table>
			</center>
		      </body></html>
		";

		} else {

  		$query2 = "DELETE FROM personnel WHERE emp_id=$emp_id";
  		$result2 = mysqli_query($connection, $query2);

  		if ($result2){
    		echo "<html><head><script language=\"JavaScript\">"; include('js/mouseover.js'); print "</script></head><body text=\"#000000\" link=\"#000000\" alink=\"#000000\" vlink=\"#000000\" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0>";

			include("includes/topframe.inc"); 
			print "
			<center>
			<table><tr><td align=\"center\"><img src=\"./images/success_logo1.jpg\"></td></tr>
			<tr><td>
			<table border=0 cellpadding=5 width=500 bgcolor=\"#DDDDDD\">
			 <tr>
			  <th>You deleted the information in the phpTickets Database.</th>
			 </tr>
			 <tr>
			  <td bgcolor=\"#FFFFFF\" align=\"center\">If you wish to re-enter the information go to <a href=\"insert.php?type=personnel\">Add page</a>.
			  </td>
			 </tr>
			</table>
			</center>
		      </body></html>
		";	

		} else {
    			echo mysqli_errno($connection).": ".mysqli_error($connection)."<BR>";
  		}
		  mysqli_close($connection);
		
		}

}

		
$db_object->disconnect();
// when you are done.

?>