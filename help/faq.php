<HTML>
<HEAD><TITLE> PMT User Manual and FAQs </TITLE>

<SCRIPT LANGUAGE="JavaScript">
<!-- Activate cloaking

function show_login(value) {

	window.opener.location.href = value;

}

// Deactivate cloaking-->
</SCRIPT> 

</HEAD>
	<body bgcolor="#FFFFFF" text="#000000" link="#000000" alink="#000000" vlink="#000000" marginwidth=0 marginheight=0 leftmargin=0 rightmargin=0 topmargin=0 bottommargin=0>
<table width="100%" bgcolor="#DDDDDD" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="left"><font size="-1"><a name=\"top\">&nbsp;</a><b>personnel and project management tool :: <?php print(strtolower(Date("l, F d, Y"))); ?></b></font></td>
		<td align="right">&nbsp;</td>
	</tr>
</table><center><table><tr><td align="center" valign="middle">
<img src="../images/logo_header.jpg"><br>

<?php

print "
<center><h1>User Manual</h1>
<hr>

<h4>Frequently Asked Questions (FAQs)</h4>
<table border=0>
<tr>
<td>
<pre><b><ol><li><a href=\"#reg\">How do I register for an account?</a>
<li><a href=\"#chp\">How do I change my password?</a>
<li><a href=\"#log\">How do I login to the system?</a>
<li><a href=\"#addgrp\">How do I create a mailing list group?</a>
<li><a href=\"#addppl\">How do I add people to a mailing list?</a>
<li><a href=\"#updtppl\">How do I update someone's record?</a>
<li><a href=\"#showppl\">How do I show people a certain group?</a>
<li><a href=\"#addprj\">How do I create a project?</a>
<li><a href=\"#addprj\">How do I add tasks to a project?</a>
<li><a href=\"#updtprj\">How do I make comments on a task or project?</a>
<li><a href=\"#showprj\">How do I show all ASSIGNED projects?</a>
<li><a href=mailto:lmoiola@aretemm.net?subject=PMT_help>My question that isn't listed here!</a>
</ol>
</b></pre>
</td>
</tr>
</table>
<table border=0>
<tr>
<td>
<pre>
<a name=\"reg\"><hr>

<b>REGISTRATION</b></a>

1. Go to the Registration page (<a href=mailto:lmoiola@aretemm.net?subject=PMT_registration_help>Contact me</a> to obtain the URL.)
2. Enter Username
3. Enter Password
4. Enter Confirm Password
5. Enter Email
6. Hit Enter or click Sign Up button

<a name=\"chp\"><hr><p align=right><font size=\"-1\">[ <a href=\"#top\">back to top</a> ]</font></p>

<b>CHANGE PASSWORD</b></a>

1. Go to Change Password page
   Follow the link provided in the welcome email you got
   when you registered. (<a href=mailto:lmoiola@aretemm.net?subject=PMT_password_help>Contact me</a> to obtain the URL.)
2. Enter Old Password
3. Enter New Password
4. Enter Confirm New Password
5. Hit Enter or click Change Password button

<a name=\"log\"><hr><p align=right><font size=\"-1\">[ <a href=\"#top\">back to top</a> ]</font></p>

<b>LOGIN</b></a>

1. Go to <a href=\"../login.php\" onClick=\"show_login(this.href); return false;\">login.php</a>
2. Enter Username (called 'login' in your profile)
3. Enter Password
4. Hit Enter or click Login button

<a name=\"addgrp\"><hr><p align=right><font size=\"-1\">[ <a href=\"#top\">back to top</a> ]</font></p>

<b>CREATE GROUP</b></a>

1. Go to <a href=\"../insert.php?type=personnel\" onClick=\"show_login(this.href); return false;\">insert.php?type=personnel</a>
   or click the Add link in the Personnel header
2. Enter Name, (required)
   a. Enter a Name for the group
   b. *Note: You won't be able to login with this Name
3. Enter Email, (required)
   a. You are responsible for accuracy; there is no validity check
   b. This is necessary for communication and ticket updates
   c. Select someone from the group as a point of contact
      (this will change in future versions)
4. Enter Title
   a. Enter 'group' in this field
   b. This will create a value in any Group pulldown menu
   c. Propogates to the Personnel and Project forms
5. Enter Group (*not required when creating a group)
6. Enter Address (*not a required field)
7. Enter Home Phone (*not a required field)
8. Enter Cell Phone (*not a required field)
9. Enter Notes (*not a required field)

<a name=\"addppl\"><hr><p align=right><font size=\"-1\">[ <a href=\"#top\">back to top</a> ]</font></p>

<b>ADD PEOPLE</b></a>

1. Go to <a href=\"../insert.php?type=personnel\" onClick=\"show_login(this.href); return false;\">insert.php?type=personnel</a>
   or click the Add link in the Personnel header
2. Enter Name, (required)
   a. Enter First and Last
   b. This is NOT the login ID
3. Enter Email, (required)
   a. You are responsible for accuracy; there is no validity check
   b. This is necessary for communication and ticket updates
4. Enter Title
   a. This field describes your duties; volunteer, creative director
   b. You can use the field to define a department by entering 'group'
5. Enter Group
6. Enter Address
7. Enter Home Phone
8. Enter Cell Phone
9. Enter Notes

<a name=\"updtppl\"><hr><p align=right><font size=\"-1\">[ <a href=\"#top\">back to top</a> ]</font></p>

<b>UPDATE PEOPLE</b></a>

NOTE: Only administrators can add personnel. Only the 
owner or an administrator can modify their record.

1. Go to <u>show.php?type=personnel&id=&lt;record id&gt;</u>
   or click the Add link in the Personnel header
2. Login: This field won't appear if user is not registered 
   to use the Project System (PMT)
3. Change Name, (required)
   a. Enter First and Last
   b. This is NOT the login ID
4. Change Email, (required)
   a. You are responsible for accuracy; 
      there is no validity check
   b. This is necessary for communication and ticket updates
5. Change Title
   a. This field describes your duties; volunteer, creative director
   b. Field cannot be blank and will revert to 'tbd' when empty
6. Add/Change Group
7. Add/Change Home Phone
8. Add/Change Cell Phone
9. Add/Change Notes

<a name=\"showppl\"><hr><p align=right><font size=\"-1\">[ <a href=\"#top\">back to top</a> ]</font></p>

<b>SHOW PEOPLE</b></a>

1. Go to <a href=\"../list.php?type=personnel\" onClick=\"show_login(this.href); return false;\">list.php?type=personnel</a>
2. Use pulldown to display ALL Personnel, Edit Groups, 
   list all personnel in the selected group
3. NAME will show a detailed view of the personnel record
4. EMAIL is a mailto link
5. GROUP link shows all personnel in the selected group

<a name=\"addprj\"><hr><p align=right><font size=\"-1\">[ <a href=\"#top\">back to top</a> ]</font></p>

<b>CREATE PROJECTS AND TASKS</b></a>

If you'd want to create a task for project, click the 
Open Child link on the Update Ticket page. This will
create a parent-child relationship in the database
between the two tickets.

You can subjugate or orphan a ticket at any time by adding, 
updating or deleting the value in the Related Tickets field.

1. Go to <a href=\"../insert.php?type=projects\" onClick=\"show_login(this.href); return false;\">insert.php?type=projects</a>
   or click the Add link in the Projects header
2. Enter Title
   a. Keep this brief but try to make it descriptive
   b. You are limited to 40 chars
3. Enter Status
   a. You can leave a ticket OPEN if you're not sure who
      to assign a ticket to
4. Enter Assignee
   a. Select either a group or an individual
   b. If a ticket is assigned to a group all individuals
      will be notified when a ticket is updated.
      (NOTE: This has not been implemented yet.)
5. Enter Priority
   a. Select a value between 1 and 5
   b. 1 is the lowest; 5 is the highest
   c. This value should correspond with the Due Date
6. Enter Due Date
   a. Use the mm/dd/yyyy format
   b. Click the 'select' link to launch the Date Selector
   c. You can only select dates in the future
7. Enter Type
   a. This is the nature of the project
   b. This is optional.
8. Enter Description
   a. This is the body of your 'ticket'
   b. There is no char limit but try to make use of
      ticket hierarchy and parse the tasks into a family
9. The Notes section is typically used for updates.
10. Cc List
   a. Enter comma-separated email addresses in the text
      field or click the label to launch the Selector
   b. you can cc: individuals or an entire group

<a name=\"updtprj\"><hr><p align=right><font size=\"-1\">[ <a href=\"#top\">back to top</a> ]</font></p>

<b>UPDATE PROJECTS AND TASKS</b></a>

NOTE: Anyone can add notes to tickets but only the person 
that submitted the ticket or an administrator can modify 
the original description.

1. Go to <u>show.php?type=projects&id=&lt;ticket number&gt;</u>
   or click the Add link in the Projects header
2. Change Title
   a. Keep this brief but try to make it descriptive
   b. You are limited to 40 chars
3. Change Status
   a. You can leave a ticket OPEN if you're not sure who
      to assign a ticket to
4. Add/Change Assignee
   a. Select either a group or an individual
   b. If a ticket is assigned to a group all individuals
      will be notified when a ticket is updated.
5. Add/Change Priority
   a. Select a value between 1 and 5
   b. 1 is the lowest; 5 is the highest
   c. This value should correspond with the Due Date
6. Add/Change Due Date
   a. Use the mm/dd/yyyy format
   b. Click the 'select' link to launch the Selector
   c. You can only select dates in the future
7. Add/Change Type
   a. This is the nature of the project
   b. This is optional.
8. Change Description
   a. This is the body of your 'ticket'
   b. There is no char limit but try to make use of
      ticket hierarchy and parse the tasks into a family
9. Add Notes during a task's lifetime.
10. Enter recipient(s) to the Cc List
   a. Enter comma-separated email addresses in the text
      field or click the label to launch the Selector
   b. you can cc: individuals or an entire group
11. Add/Change Related Tickets
   a. If the ticket is a child, it's parent will show in the text 
      field and the label 'parent' will link to the project family
   b. If the ticket is a parent, it's child will be displayed
   c. You can change or delete the parent id
12. Email confirmation
   a. When a ticket is updated the Assignee is sent an email notice
   b. If the ticket has not yet been asssigned then the Submitter is 
      emailed a reminder to update the STATUS and ASSIGNEE  

If you'd want to create a task for project, click the 
Open Child link on the Update Ticket page. This will
create a parent-child relationship in the database
between the two tickets.

You can subjugate or orphan a ticket at any time by adding, 
updating or deleting the value in the Related Tickets field.

<a name=\"showprj\"><hr><p align=right><font size=\"-1\">[ <a href=\"#top\">back to top</a> ]</font></p>

<b>SHOW PROJECTS AND TASKS</b></a>

Use the pulldown in the upper-right to display all PENDING tickets.

1. Go to <a href=\"../list.php?type=projects\" onClick=\"show_login(this.href); return false;\">list.php?type=projects</a>
2. Ticket that are CLOSED or CANCELED will not show up
3. Use the pulldown to display CLOSED or CANCELED tickets, 
   tickets assigned to a particular group, tickets assigned to a
   particular individual, tickets with a Due Date in the current
   month or tickets by Due Date in chronological order
4. ID will show a detailed view of the ticket
5. If ticket is a parent, NAME will link to the project family
   or else NAME links to a detailed view of the ticket
6. Submitter links to a popup that shows the personnel info
7. Assignee links to a popup that show the personnel info
8. In the Description, the 'more' links to a popup that shows 
   the Description and Notes for the ticket. You can also go 
   to a detailed view of the ticket as well.

If you'd want to create a task for project, click the 
Child link on the Show Project page. This will
create a parent-child relationship in the database
between the two tickets.

<hr><p align=right><font size=\"-1\">[ <a href=\"#top\">back to top</a> ]</font></p>

</pre>
</td>
</tr>
</table>

<h1>Pending Updates</h1>

<table>
<tr>
<td>
<pre>

1. Automated Project Reminder Service - 
   triggers when current_date == (due_date - 5 days)

2. Email function
	a. Opt-out list for people don't wish to recieve
	   email regarding ticket updates
	b. checkbox on update form to opt-out email for 
	   creator and/or assignee
	c. individual preference for email notices like 
	   daily/weekly summary or when a ticket's priority 
	   exceeds a certain level.

3. Search page to find individual records in the database

4. More advanced Print Label function, different layouts (3x10)...

5. When any fields OTHER THAN notes are modified, add changes.inc to notes

6. Password Reminder Service
   Link on login form triggers email associated with login
   if login doesn't exist no email is sent

7. Limit the results shown on a particular page 
   [ if ($result > 10) { $sql .= \"LIMIT 10\"} ]
   Next link:  [ $sql .= \"START=11 LIMIT 10\" ]   

</pre>
</td>
</tr>
</table>
<hr>
<h4>Send <a href=mailto:lmoiola@aretemm.net?subject=PMT_suggestions>email</a> with suggestions.</h4>
</center>
</BODY>
</HTML>
";
?>