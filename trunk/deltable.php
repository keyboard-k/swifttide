<?
//Initiate database functions
include_once "ez_sql.php";

$sSQL="DELETE FROM studentbio";
$db->query($sSQL);
echo "student ok<br>";
$sSQL="DELETE FROM studentcontact";
$db->query($sSQL);
echo "contact ok<br>";
$sSQL="DELETE FROM contact_to_students";
$db->query($sSQL);
echo "contacttostudents ok<br>";
$sSQL="DELETE FROM student_grade_year";
$db->query($sSQL);
echo "studentgradeyear ok<br>";
$sSQL="DELETE FROM web_users";
$db->query($sSQL);
echo "webusers ok<br>";
$sSQL="DELETE FROM attendance_history";
$db->query($sSQL);
echo "attendance ok<br>";
$sSQL="DELETE FROM discipline_history";
$db->query($sSQL);
echo "discipline ok<br>";
$sSQL="DELETE FROM grade_history";
$db->query($sSQL);
echo "grade ok<br>";

?>
