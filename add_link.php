<?php 

$desc = $_GET['link_desc'];
$url = $_GET['link_url'];

if (strlen($desc) < '1') {
	print "<h3>The Description is blank.</h3>";
} elseif ((strlen($desc) < '1') && (strlen($url) < '1')) {
	print "<h3>The URL field is blank.</h3>";
} else {

$strMailTo = "su042@aretemm.net";
$strSubject = "new URL to links page (su042)";
$strBody = "Link Description: ".$desc."\nLink URL: ".$url;
$strXHeaders = "From: su042@aretemm.net\nX-Mailer: PHP/" . phpversion(); 

mail ($strMailTo, $strSubject, $strBody, $strXHeaders);

}

print "

<html>

<head>
<script language=\"JavaScript\">
function goback() {
  window.location.href = \"links.php\";
}
</script>

<meta http-equiv=\"refresh\" content=\"2; url=links.php\" />

</head>
<body />
</html>

";

 ?>