<?php

		//emails both the submitter and assignee
		//$sqlquery = "SELECT emp_name, emp_email FROM personnel, projects WHERE emp_name = proj_submitter AND projects.proj_id = '$proj_id' OR emp_name = proj_assignee AND projects.proj_id = '$proj_id'";

			if ($proj_due_dt !== '12/31/2010') { $proj_due_dt_d = $proj_due_dt; }

		if (strlen($proj_assignee) < '1') {

		//emails the submitter when ticket has not been assigned
		$sqlquery = "SELECT emp_name, emp_email FROM personnel, projects WHERE emp_name = proj_submitter AND projects.proj_id = '$proj_id'";
                $message .= "$mail_proj_notes\r\n\n";
                $message .= "*********************************************************\n\n";
		$message .= "Ticket #$proj_id\r\n\n";
		$message .= "This ticket has not yet been assigned.\r\n\n";
		$message .= "Title: $proj_name3\n";
		$message .= "Create Date: $proj_create_dt\n";
		$message .= "Submitter: $proj_submitter\n";
		$message .= "Status: $proj_status\n";
		$message .= "Assignee: $proj_assignee\n";
		$message .= "Priority: $proj_priority\n";
		$message .= "Due Date: $proj_due_dt_d\n";
		$message .= "Type: $proj_type\r\n\n";
		$message .= "Description:\r\n$proj_desc2\r\n\n";
		$message .= "*********************************************************\n\n";
		$message .= "Go to: http://".$_SERVER["SERVER_NAME"]."/tools/pt/\r\n\n";
		$message .= "Edit this Ticket:\nhttp://".$_SERVER["SERVER_NAME"]."/tools/pt/show.php?type=projects&id=$proj_id";
		
		} else {

		//emails just the assignee
		$sqlquery = "SELECT emp_name, emp_email FROM personnel, projects WHERE emp_name = proj_assignee AND projects.proj_id = '$proj_id'";
                $message .= "$mail_proj_notes\r\n\n";
                $message .= "*********************************************************\n\n";
		$message .= "Ticket #$proj_id\r\n\n";
		$message .= "Title: $proj_name3\n";
		$message .= "Create Date: $proj_create_dt\n";
		$message .= "Submitter: $proj_submitter\n";
		$message .= "Status: $proj_status\n";
		$message .= "Assignee: $proj_assignee\n";
		$message .= "Priority: $proj_priority\n";
		$message .= "Due Date: $proj_due_dt_d\n";
		$message .= "Type: $proj_type\r\n\n";
		$message .= "Description:\r\n$proj_desc2\r\n\n";
		$message .= "*********************************************************\n\n";
		$message .= "Go to: http://".$_SERVER["SERVER_NAME"]."/tools/pt/\r\n\n";
		$message .= "Edit this Ticket:\nhttp://".$_SERVER["SERVER_NAME"]."/tools/pt/show.php?type=projects&id=$proj_id";


mail ($to, $subject, $message, $extra);


		}

		$result = mysql_query($sqlquery);
		$number = @mysql_numrows($result);

		$i = 0;

		if ($number < 1) {
		print " ";

		} else {

		while ($number > $i) {
		$theemp_name = mysql_result($result,$i,"emp_name");
		$theemp_email = mysql_result($result,$i,"emp_email");

		$sqlquery2 = "SELECT emp_email as submitter_email FROM personnel WHERE emp_name = '$proj_submitter' OR emp_login = '$proj_submitter'";		
		$result2 = mysql_query($sqlquery2);
		$j = 0;
		$submitter_email = @mysql_result($result2,0,"submitter_email");
		
		if(strlen($proj_assignee) < '1') { $to = $submitter_email; } else { $to = $theemp_email; }
		$subject = "Ticket $proj_id was updated";
			
		if(strlen($proj_assignee) < '1') { $extra = "From: The Project Database <phpTickets@aretemm.net>\r\nReply-To: phpTickets@aretemm.net\r\n"; } else { $extra = "From: The Project Database <$submitter_email>\r\nReply-To: $submitter_email\r\n";}

		if (strlen($cc_list) > '1') {
	
		$cc_list = ereg_replace("[\r\n\t\ ]", " ", trim($cc_list));		

		$cc_list = str_replace(" ", ",", "$cc_list");

			$extra .= "Cc: $cc_list";

		$i++;

		}


$sqlquery3 = "SELECT parent, child FROM parent_child_rel WHERE child = $proj_id";
$result3 = mysql_query($sqlquery3);
$number3 = @mysql_numrows($result3);
$k = 0;

	if ($number3 < 1) {

print " ";

	} else {

	  while ($number3 > $k) {

         $theproj_parent = mysql_result($result3,$k,"parent");
         $theproj_child = mysql_result($result3,$k,"child");	

	    if($theproj_parent !== '0') {

		if ($proj_id == $theproj_child) {

		$message .= "\r\n\nRelated Tickets:\n";

		$message .= "http://".$_SERVER["SERVER_NAME"]."/tools/pt/list_project.php?parent_id=$parent_id (parent)";

		} else {
	
		$message .= "http://".$_SERVER["SERVER_NAME"]."/tools/pt/show.php?type=projects&id=$theproj_child\n";

		}

	   }

		if ($number2 - 1 == $k) {
		echo "";
		} else {
		echo ", ";
		}

	  $k++;

	  }

	}

		mail ($to, $subject, $message, $extra);

		$i++;
		
		  }
		 }

?>

