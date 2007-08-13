<?
//*
// admin_export2.php
// export mysql data to excel (for now)
// v1.0 2007-06-18 Helmut
//*

//Check if admin is logged in
session_start();
if(!session_is_registered('UserId') || $_SESSION['UserType'] != "A")
  {
    header ("Location: index.php?action=notauth");
	exit;
}

//Include global functions
include_once "common.php";
//Initiate database functions
include_once "ez_sql.php";
//Include paging class
include_once "ez_results.php";
// config
include_once "configuration.php";
$msgFormErr="";

// -----------------------------------
function export_table($table) {

// get the number of fields that we have in this table
$sSQL="SELECT * FROM studentbio";
$export = mysql_query($sSQL);
$fields = mysql_num_fields($export);

// get the headers
$header = "";
for ($i = 0; $i < $fields; $i++) {
    $header .= mysql_field_name($export, $i) . "\t";
}

// now get the data
$data = "";
while($row = mysql_fetch_row($export)) {
    $line = '';
    foreach($row as $value) {                                            
        if ((!isset($value)) OR ($value == "")) {
            $value = "\t";
        } else {
            $value = str_replace('"', '""', $value);
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim($line)."\n";
}
$data = str_replace("\r","",$data);

} // end function
// -----------------------------------

//Check what we have to do
$action=get_param("action");

switch ($action) {
case "excel":

	$host = "localhost";
	$user = "Benutzername";
	$password = "Passwort";
	$database = "Datenbank";
	$table = "Tabelle";
	$query_text = "SELECT * FROM " . $table;
	
	Header("Content-Type: application/vnd.ms-excel");
	
	$db_link = mysql_connect($host, $user, $password);
	mysql_select_db($database, $db_link);
	
	$result = mysql_query($query_text, $db_link);
	$fieldcounts = mysql_num_fields($result);
	for($i = 0; $i < $fieldcounts; $i++) {
	$fieldtype = mysql_fetch_field($result, $i);
	if ($i < ($fieldcounts-1)) echo "$fieldtype->name [$fieldtype->type]\t";
	else echo "$fieldtype->name [$fieldtype->type]\n";
	}
	$myrow = mysql_fetch_array($result);
	do {
	for($i = 0; $i < $fieldcounts; $i++) {
	$fieldname = mysql_field_name($result, $i);
	if ($i < ($fieldcounts-1)) echo $myrow[$fieldname] . "\t";
	else echo $myrow[$fieldname] . "\n";
	}
	} while ($myrow = mysql_fetch_array($result));
	
	// any data there?
	if ($data == "") {
	    $data = _ADMIN_EXPORT_NO_DATA . "\n";                        
	}

	// print the info
	header("Content-type: application/x-msdownload");
	header("Content-Disposition: attachment; filename=database.xls");
	header("Pragma: no-cache");
	header("Expires: 0");
	print "$header\n$data";
	break;

default:
	break;
}
?>
