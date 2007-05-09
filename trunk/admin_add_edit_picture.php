<?
//*
// admin_edit_student_1.php
// Admin Section
// Display and Manage Student Pictures

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
// config
include_once "configuration.php";

//Gather student id
$studentid=get_param("studentid");
$error = '';
//Do the form input. We replace the old image path from the table as well as delete the image and enter the new path into the table.
$picgo=get_param("picgo");
$newpic=get_param("newpic");
$grade=get_param("grade");
if ($picgo) {
	//Verify that an image that is allowed is uploaded. Only allow jpeg, jpg, png anf gif, nothing else.
	if ($_FILES['newpic']['type'] != 'image/jpeg' && $_FILES['newpic']['type'] != 'image/jpg' && $_FILES['newpic']['type'] != 'image/gif' && $_FILES['newpic']['type'] != 'image/png') {
		$error .= _ADMIN_ADD_EDIT_PICTURE_ERROR . "<br />";
//		echo "Doing image thingie2<br>";
	} else {
//		echo "Doing image thingie3<br>";
		$y = explode("/",$_FILES['newpic']['type']);
		$t = time();
		$newname = getcwd()."/pictures/".$studentid."_".$_POST['grade']."_".$t.".".$y[1];
		if (@!move_uploaded_file($_FILES['newpic']['tmp_name'], $newname)) {
//			echo "Doing image thingie4<br>";
			$error .= _ADMIN_ADD_EDIT_PICTURE_UPLOAD_ERROR . "<br />";
		} else {
			$sSQL = "Select COUNT(studentid) as scount from studentbio_pictures where studentid = $studentid and grade = ".$_POST['grade'];
//			echo $sSQL;
			$rt = $db->get_row($sSQL);
			if (!$rt->scount) {
				$sSQL = "Insert into studentbio_pictures VALUES('',$studentid, 'pictures/".$studentid."_".$_POST['grade']."_".$t.".".$y[1]."', ".$_POST['grade'].")";
				$db->query($sSQL);
//				echo "1".$sSQL;
			} else {
				$sSQL = "Update studentbio_pictures set picturepath = 'pictures/".$studentid."_".$_POST['grade']."_".$t.".".$y[1]."' where studentid = $studentid and grade = ".$_POST['grade'];
				$db->query($sSQL);
//				echo "2".$sSQL;
			}
		}
	}
}

$sSQL = "Select * from studentbio_pictures where studentid = $studentid order by grade desc";

$studentinfo=$db->get_row($sSQL);

//pq - 2007-02-22 - added the code to grab the picture path in the query
$sSQL="SELECT studentbio.*, DATE_FORMAT(studentbio.studentbio_dob, '" . _EXAMS_DATE . "') as sdob, ethnicity.ethnicity_desc, school_names.school_names_desc, generations.generations_desc, grades.grades_desc, studentbio_pictures.picturepath FROM (((((studentbio INNER JOIN generations ON studentbio.studentbio_generation = generations.generations_id) INNER JOIN ethnicity ON studentbio.studentbio_ethnicity = ethnicity.ethnicity_id) INNER JOIN school_names ON studentbio.studentbio_school = school_names.school_names_id) INNER JOIN student_grade_year ON studentbio.studentbio_id = student_grade_year.student_grade_year_student) INNER JOIN grades ON student_grade_year.student_grade_year_grade = grades.grades_id)  LEFT OUTER JOIN studentbio_pictures ON studentbio.studentbio_id = studentbio_pictures.studentid WHERE studentbio.studentbio_id=$studentid";
$studentinfo1=$db->get_row($sSQL);

if ($studentinfo->picturepath != NULL ) {
	//Define stuff
	define(IMAGE_BASE, 'pictures');
	define(MAX_WIDTH, 250);
	define(MAX_HEIGHT, 250);

	// Get image location
	$image_file = $studentinfo->picturepath;
	$image_path = "$image_file";
//	echo "Path: $image_path";
	//Get image extension etc, we need it to read the image
	$img = null;
	$ext = strtolower(end(explode('.', $image_path)));
	if ($ext == 'jpg' || $ext == 'jpeg') {
		$img = @imagecreatefromjpeg($image_path);
	} else if ($ext == 'png') {
		$img = @imagecreatefrompng($image_path);
	} else if ($ext == 'gif') {
		$img = @imagecreatefromgif($image_path);
		$g = 1;
	}

	if ($img) {
		//What is the width and height of image right now?
	    $width = imagesx($img);
		$height = imagesy($img);
	    $scale = min(MAX_WIDTH/$width, MAX_HEIGHT/$height);
	
		// If the image is larger than the max shrink it
	    if ($scale < 1) {
		    $new_width = floor($scale*$width);
			$new_height = floor($scale*$height);
			if (!$g) {
			    $tmp_img = imagecreatetruecolor($new_width, $new_height);
			} else {
				$tmp_img = imagecreate($new_width, $new_height);
			}

	        imagecopyresized($tmp_img, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	        imagedestroy($img);
		    $img = $tmp_img;
	    }
	}

	# Create error image if necessary
	if (!$img) {
		echo _ADMIN_ADD_EDIT_PICTURE_PIC_ERROR;
		$img = imagecreate(MAX_WIDTH, MAX_HEIGHT);
	    imagecolorallocate($img,0,0,0);
		$c = imagecolorallocate($img,70,70,70);
	    imageline($img,0,0,MAX_WIDTH,MAX_HEIGHT,$c2);
		imageline($img,MAX_WIDTH,0,0,MAX_HEIGHT,$c2);
	}
	
	//Create a temp file for this load only
	//	header("Content-type: image/jpeg");
	//  imagejpeg($img);
	$x = time();
	// $tfile = $_SERVER['DOCUMENT_ROOT']."/pictures/temp/".$x.".jpeg";
	$tfile = "pictures/temp/".$x.".jpeg";
	imagejpeg($img, $tfile);
	// $fpath = "http://".$_SERVER['HTTP_HOST']."/pictures/temp/".$x.".jpeg";
	$fpath = "pictures/temp/".$x.".jpeg";
}

?> 


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><? echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student.css";</style>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<? echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<? echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><? echo _ADMIN_ADD_EDIT_PICTURE_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	<?php
		if ($error) {
			echo $error;
	}
	?>
	<h1><? echo _ADMIN_ADD_EDIT_PICTURE_TITLE?></h1>
	<br>
	<h2><? echo $studentinfo1->studentbio_fname . " " . $studentinfo1->studentbio_mi . " " . $studentinfo1->studentbio_lname . " " .  $studentinfo1->generations_desc . " (" . $studentinfo1->studentbio_gender . ")"; ?>

	<br>
	<h2><? echo _ADMIN_ADD_EDIT_PICTURE_CURRENT?></h2>
	<?php if ($studentinfo->picturepath != NULL) { ?>
            <!-- pq - 2007-02-22 - fixed typos. used a relative path. the temp thingy wasnt working so i grab the whole picture -->
                <a href="<?php echo $studentinfo->picturepath;?>"><img src="<?php echo $studentinfo->picturepath;?>"></a>
		<br>
		<i><a href="admin_edit_student_1.php?action=edit&studentid=<?php echo $studentid;?>"><? echo _ADMIN_ADD_EDIT_PICTURE_CLICK?></a></i>
	<?php } else { ?>
		<h2><? echo _ADMIN_ADD_EDIT_PICTURE_NONE?></h2>
	<?php } ?>
	<form enctype="multipart/form-data" action="admin_add_edit_picture.php?studentid=<?php echo $studentid;?>" method="POST" name="picsubmit">
	<table width="100%" cellspacing="1" cellpadding="1" border="1">
		<tr>
			<td>
				<? echo _ADMIN_ADD_EDIT_PICTURE_PICNAME?>
			</td>
			<td>
				<input class="file" type="file" name="newpic">
			</td>
		</tr>
		<tr>
			<td>
				<? echo _ADMIN_ADD_EDIT_PICTURE_PICGRADE?>
			</td>
			<td>
				<input type="text" size="2" name="grade">
			</td>
		</tr>
		<tr>
			<td colspan="2" style="text-align: center;">
				<input type="submit" name="picgo" value="<? echo _ADMIN_ADD_EDIT_PICTURE_EDITPIC?>" class="frmbut">
			</td>
		</tr>
	</table>
	</form>
</div>
<? include "admin_menu.inc.php"; ?>
</body>
