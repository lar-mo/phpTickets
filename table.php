<?php

require 'db_connect.php';

// require above script
// change the path to match wherever you put it.


$table1 = "CREATE TABLE users (
  id int(10) DEFAULT '0' NOT NULL auto_increment, 
  username varchar(40),
  password varchar(50), 
  regdate varchar(20),
  email varchar(100),
  website varchar(150),
  location varchar(150),
  show_email int(2) DEFAULT '0',
  last_login varchar(20),
  auth_level int(2) NOT NULL default '3',
  PRIMARY KEY(id))";

$create1 = $db_object->query($table1);	//perform query

if(DB::isError($create1)) {
	die($create1->getMessage());
} else {
	echo 'Users table created successfully.';

}

$table2 = "CREATE TABLE projects (
  proj_id int(5) NOT NULL auto_increment,
  proj_name varchar(50) default NULL,
  proj_submitter varchar(25) default NULL,
  proj_create_dt datetime default NULL,
  proj_status varchar(15) default 'OPEN',
  proj_type varchar(15) default NULL,
  proj_desc blob,
  proj_notes blob,
  proj_assignee varchar(15) default NULL,
  proj_priority int(1) default '1',
  proj_update_dt datetime default NULL,
  proj_due_dt varchar(10) NOT NULL default '12/31/2010',
  PRIMARY KEY  (proj_id))";

$create2 = $db_object->query($table2);	//perform query

if(DB::isError($create2)) {
	die($create2->getMessage());
} else {
	echo 'Projects table created successfully.';

}


$table3 = "CREATE TABLE personnel (
  emp_id int(5) NOT NULL auto_increment,
  emp_name varchar(40) default NULL,
  emp_email varchar(50) default NULL,
  emp_title varchar(25) default NULL,
  emp_phone_hm varchar(15) default NULL,
  emp_phone_cell varchar(15) default NULL,
  emp_notes text,
  emp_group varchar(25) default NULL,
  emp_login varchar(40) default NULL,
  PRIMARY KEY  (emp_id))";

$create3 = $db_object->query($table3);	//perform query

if(DB::isError($create3)) {
	die($create3->getMessage());
} else {
	echo 'Personnel table created successfully.';

}

$table4 = "CREATE TABLE parent_child_rel (
  parent int(6) NOT NULL default '0',
  child int(6) NOT NULL default '0',
  PRIMARY KEY  (child))";

$create4 = $db_object->query($table4);	//perform query

if(DB::isError($create4)) {
	die($create4->getMessage());
} else {
	echo 'Parent_Child_Rel table created successfully.';

}



$db_object->disconnect();

?>