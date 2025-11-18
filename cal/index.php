<?php include("pm_inc.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<title>CALENDAR</title>

<!-- JavaScript function to open events window and show status bar messages -->

<script language="JavaScript" type="text/javascript">
<!--
function openEventWindow(){
window.open("", "events", "width=380,height=420,toolbar=0,status=0,scrollbars=1,location=0,menubar=1,resizable=1");
}
function showEventsMessage(){
window.status = "Events ";
}
function hideEventsMessage(){
window.status = "";
}
function showProfileMessage(){
window.status = "View Member Profile";
}
function hideProfileMessage(){
window.status = "";
}
//-->
</script>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="calendar.css" />

</head>

<body>

<div align="center">

<!-- Displays the event/birthday calendar -->

<?php mixed_calendar($year,$month); ?>

<br />

<!-- Link to your homepage, as specified in your preferences -->

<?php homepage_link(); ?>


</div>

</body>

</html>
