<?php

//require the PEAR::DB classes.

// Suppress deprecation warnings for legacy PEAR code
error_reporting(E_ALL & ~E_DEPRECATED);

// Polyfill for removed get_magic_quotes_gpc() function (removed in PHP 7.4+)
if (!function_exists('get_magic_quotes_gpc')) {
    function get_magic_quotes_gpc() {
        return false;
    }
}

// Polyfill for removed mysql_* functions (removed in PHP 7.0+) using mysqli
if (!function_exists('mysql_connect')) {
    global $__mysqli_link;
    function mysql_connect($host, $user, $pass) {
        global $__mysqli_link;
        $__mysqli_link = mysqli_connect($host, $user, $pass);
        return $__mysqli_link;
    }
    function mysql_select_db($db, $link = null) {
        global $__mysqli_link;
        $link = $link ?: $__mysqli_link;
        return mysqli_select_db($link, $db);
    }
    function mysql_query($query, $link = null) {
        global $__mysqli_link;
        $link = $link ?: $__mysqli_link;
        return mysqli_query($link, $query);
    }
    function mysql_fetch_array($result, $type = MYSQLI_BOTH) {
        return mysqli_fetch_array($result, $type);
    }
    function mysql_fetch_assoc($result) {
        return mysqli_fetch_assoc($result);
    }
    function mysql_num_rows($result) {
        return mysqli_num_rows($result);
    }
    function mysql_error($link = null) {
        global $__mysqli_link;
        $link = $link ?: $__mysqli_link;
        return mysqli_error($link);
    }
    function mysql_insert_id($link = null) {
        global $__mysqli_link;
        $link = $link ?: $__mysqli_link;
        return mysqli_insert_id($link);
    }
    function mysql_close($link = null) {
        global $__mysqli_link;
        $link = $link ?: $__mysqli_link;
        return mysqli_close($link);
    }
    function mysql_real_escape_string($string, $link = null) {
        global $__mysqli_link;
        $link = $link ?: $__mysqli_link;
        return mysqli_real_escape_string($link, $string);
    }
    function mysql_numrows($result) {
        return mysqli_num_rows($result);
    }
    function mysql_db_query($database, $query, $link = null) {
        global $__mysqli_link;
        $link = $link ?: $__mysqli_link;
        mysqli_select_db($link, $database);
        return mysqli_query($link, $query);
    }
    function mysql_affected_rows($link = null) {
        global $__mysqli_link;
        $link = $link ?: $__mysqli_link;
        return mysqli_affected_rows($link);
    }
    function mysql_fetch_row($result) {
        return mysqli_fetch_row($result);
    }
    function mysql_result($result, $row, $field = 0) {
        if ($result === null || mysqli_num_rows($result) === 0) {
            return false;
        }
        mysqli_data_seek($result, $row);
        $datarow = mysqli_fetch_array($result);
        return $datarow[$field];
    }
}

require_once 'DB.php';

// Load database configuration
require_once 'config.php';

$db_engine = DB_ENGINE;
$db_user = DB_USER;
$db_pass = DB_PASS;
$db_host = DB_HOST;
$db_name = DB_NAME;

$datasource = $db_engine.'://'.
			  $db_user.':'.
			  $db_pass.'@'.
		 	  $db_host.'/'.
	  		  $db_name;


$db_object = DB::connect($datasource, array('persistent' => false));

/* assign database object in $db_object,

if the connection fails $db_object will contain

the error message. */

// If $db_object contains an error:

// error and exit.

if(DB::isError($db_object)) {
	die('DB Connection Error: ' . $db_object->getMessage());
}

$db_object->setFetchMode(DB_FETCHMODE_ASSOC);

// we write this later on, ignore for now.

include('check_login.php');

?>
