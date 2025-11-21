<?php

		//emails both the submitter and assignee
		//$sqlquery = "SELECT emp_name, emp_email FROM personnel, projects WHERE emp_name = proj_submitter AND projects.proj_id = '$proj_id' OR emp_name = proj_assignee AND projects.proj_id = '$proj_id'";

		if (strlen($proj_assignee) < '1') {

		//emails the submitter when ticket has not been assigned
		$sqlquery = "SELECT emp_name, emp_email FROM personnel, projects WHERE emp_name = proj_submitter AND projects.proj_id = '$proj_id'";
		$message = "Ticket #$proj_id\r\n\n";
		$message .= "This is a new ticket and has not yet been assigned.\r\n\n";		
		$message .= "Title: $proj_name2\n";
		$message .= "Create Date: $proj_create_dt\n";
		$message .= "Submitter: $proj_submitter\n";
		$message .= "Status: $proj_status\n";
		$message .= "Assignee: $proj_assignee\n";
		$message .= "Priority: $proj_priority\n";
		$message .= "Due Date: $proj_due_dt_d\n";
		$message .= "Type: $proj_type\r\n\n";
		$message .= "Description:\r\n$proj_desc2\r\n\n";
		$message .= "Notes:\r\n$proj_notes2\r\n\n";
		$message .= "*********************************************************\n\n";
		$message .= "Go to: http://".$_SERVER["SERVER_NAME"]."/phpTickets/\r\n\n";
		$message .= "Edit this Ticket:\nhttp://".$_SERVER["SERVER_NAME"]."/phpTickets/show.php?type=projects&id=$proj_id";
		
		} else {

		//emails just the assignee
		$sqlquery = "SELECT emp_name, emp_email FROM personnel, projects WHERE emp_name = proj_assignee AND projects.proj_id = '$proj_id'";
		$message = "Ticket #$proj_id\r\n\n";
		$message .= "This is a new ticket.\r\n\n";		
		$message .= "Title: $proj_name2\n";
		$message .= "Create Date: $proj_create_dt\n";
		$message .= "Submitter: $proj_submitter\n";
		$message .= "Status: $proj_status\n";
		$message .= "Assignee: $proj_assignee\n";
		$message .= "Priority: $proj_priority\n";
		$message .= "Due Date: $proj_due_dt_d\n";
		$message .= "Type: $proj_type\r\n\n";
		$message .= "Description:\r\n$proj_desc2\r\n\n";
		$message .= "Notes:\r\n$proj_notes2\r\n\n";
		$message .= "*********************************************************\n\n";
		$message .= "Go to: http://".$_SERVER["SERVER_NAME"]."/phpTickets/\r\n\n";
		$message .= "Edit this Ticket:\nhttp://".$_SERVER["SERVER_NAME"]."/phpTickets/show.php?type=projects&id=$proj_id";

		}

		$result = mysqli_query($connection, $sqlquery);
		$number = @mysqli_num_rows($result);

		if ($number < 1) {
		print " ";

		} else {

		while ($row = mysqli_fetch_assoc($result)) {
		$theemp_name = $row["emp_name"];
		$theemp_email = $row["emp_email"];

		$to = $theemp_email;
		$subject = "Ticket $proj_id was added";

		$sqlquery2 = "SELECT emp_email as submitter_email FROM personnel WHERE emp_name = '$proj_submitter' OR emp_login = '$proj_submitter'";		
		$result2 = mysqli_query($connection, $sqlquery2);
		$row2 = mysqli_fetch_assoc($result2);
		$submitter_email = $row2["submitter_email"] ?? '';
			
		if(strlen($proj_assignee) < '1') { $extra = "From: The Project Database <phpTickets@aretemm.net>\r\nReply-To: phpTickets@aretemm.net\r\n"; } else { $extra = "From: The Project Database <$submitter_email>\r\nReply-To: $submitter_email\r\n";}

		if (strlen($cc_list) > '1') {
	
		$cc_list = preg_replace("/[\r\n\t ]/", " ", trim($cc_list));		

		$cc_list = str_replace(" ", ",", "$cc_list");

			$extra .= "Cc: $cc_list\r\n";

		}


$sqlquery3 = "SELECT parent, child FROM parent_child_rel WHERE parent = $proj_id OR child = $proj_id";
$result3 = mysqli_query($connection, $sqlquery3);
$number3 = @mysqli_num_rows($result3);

	if ($number3 < 1) {

print " ";

	} else {

	  while ($row3 = mysqli_fetch_assoc($result3)) {

         $theproj_parent = $row3["parent"];
         $theproj_child = $row3["child"];	

	    if($theproj_parent !== '0') {

		if ($proj_id == $theproj_child) {

		$message .= "\r\n\nRelated Tickets:\n";

		$message .= "http://".$_SERVER["SERVER_NAME"]."/phpTickets/list_project.php?parent_id=$parent_id (parent)";

		} else {
	
		$message .= "http://".$_SERVER["SERVER_NAME"]."/phpTickets/show.php?type=projects&id=$theproj_child\n";

		}

	   }

	  }

	}

		mail ($to, $subject, $message, $extra);
		
		  }
		 }

?>