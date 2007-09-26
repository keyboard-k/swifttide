<?php
//*
// admin_add_edit_contact_1.php
// Admin Section
// Add additional contact for student
//v1.5 support true multiyear function
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
// config
include_once "configuration.php";

//If we come here from rback, we don't get the relations codes, so an attempt to fix that:
//Get list of relations
$relations=$db->get_results("SELECT * FROM relations_codes ORDER BY relation_codes_desc");

$action=get_param("action");
$studentid=get_param("studentid");
$contactid=get_param("contactid");
$current_year=$_SESSION['CurrentYear'];

//Set appropriate menu
$rback=get_param("rback");
if(strlen($rback)){
	$menustudent=1;
};

if ($action=="edit"){
	$action="update";
	$sub_button=_ADMIN_ADD_EDIT_CONTACT_1_UPDATE_SUB;
	$pag_header=_ADMIN_ADD_EDIT_CONTACT_1_UPDATE_PAG;
	$sSQL="SELECT studentcontact.studentcontact_state, 
	studentcontact.studentcontact_title, contact_to_students.contact_to_students_relation 
	FROM studentcontact 
	INNER JOIN contact_to_students ON studentcontact.studentcontact_id = contact_to_students.contact_to_students_contact 
	WHERE studentcontact_id='".$contactid."' 
	AND contact_to_students_student='".$studentid."' 
	AND contact_to_students_year='".$current_year."'";
	$contact=$db->get_row($sSQL);
	$set_state=$contact->studentcontact_state;
//Fix to display titles properly, doug 12-30-06
	$sSQL="SELECT title_desc FROM tbl_titles WHERE title_id='".$contact->studentcontact_title."'";
	$set_title=$db->get_var($sSQL);
	// echo "set title is $set_title";
	//$set_title=$contact->studentcontact_title;
//End of doug fix
	$set_relation=$contact->contact_to_students_relation;
}else{
	$action="new";
	$sub_button=_ADMIN_ADD_EDIT_CONTACT_1_ADD_SUB;
	$pag_header=_ADMIN_ADD_EDIT_CONTACT_1_ADD_PAG;
	//Get default values
	$config = $db->get_row("SELECT * FROM tbl_config WHERE id=1");
	$set_state=$config->default_state;
	$set_city=strip($config->default_city);
	$set_zip=strip($config->default_zip);
};

//Get list of states
$states=$db->get_results("SELECT * FROM tbl_states ORDER BY state_code");
//Get list of Salutations
$titles=$db->get_results("SELECT * FROM tbl_titles ORDER BY title_id");
//Get list of relations
$relations=$db->get_results("SELECT * FROM relations_codes ORDER BY relation_codes_desc");

//Get student first and last name
$student=$db->get_row("SELECT studentbio_fname, studentbio_lname FROM studentbio WHERE studentbio_id='".$studentid."'");
$sfname=$student->studentbio_fname;
$slname=$student->studentbio_lname;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
<title><?php echo _BROWSER_TITLE?></title>
<style type="text/css" media="all">@import "student-admin.css";</style>
<SCRIPT language="JavaScript">
/* Javascript function to submit form and check if field is empty */
function submitform(fldName)
{
  var f = document.forms[0];
  var t = f.elements[fldName]; 
  if (t.value!="") 
    return true;
  else
    alert("<?php echo _ENTER_VALUE?>");
    return false;
}

</script>
<link rel="icon" href="favicon.ico" type="image/x-icon"><link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<script type="text/javascript" language="JavaScript" src="sms.js"></script>
</head>

<body><img src="images/<?php echo _LOGO?>" border="0">

<div id="Header">
<table width="100%">
  <tr>
    <td width="50%" align="left"><font size="2">&nbsp;&nbsp;<?php echo date(_DATE_FORMAT); ?></font></td>
    <td width="50%"><?php echo _ADMIN_ADD_EDIT_CONTACT_1_UPPER?></td>
  </tr>
</table>
</div>

<div id="Content">
	   <h1><?php echo _ADMIN_ADD_EDIT_CONTACT_1_TITLE?></h1>
	   <br>
	   <h2><?php echo $sfname." ".$slname; ?></h2>
	   <br>
	   <?php
	   if ($action=="new"){
	   ?>
	   <p class="ltxt"><?php echo _ADMIN_ADD_EDIT_CONTACT_1_DB_PRIMARY?>: </p>
	   <form name="srchcontact" method="POST" action="admin_add_edit_contact_3.php" onsubmit="return submitform('clname');">
	   <p class="ltxt"><?php echo _ADMIN_ADD_EDIT_CONTACT_1_LAST?> <input type = "text" name="clname" size="20">&nbsp;<input type="submit" name="submit" value="<?php echo _ADMIN_ADD_EDIT_CONTACT_1_SEARCH?>" class="frmbut">
	   <input type="hidden" name="studentid" value="<?php echo $studentid; ?>">
	   <input type="hidden" name="sfname" value="<?php echo $sfname; ?>">
	   <input type="hidden" name="slname" value="<?php echo $slname; ?>">
	   <?php
	   if($menustudent==1){
	   ?>
			<input type="hidden" name="rback" value="rback">	   
	   <?php
	   };
	   ?>
	   </form></p>
	   <?php
	   };
	   ?>
	   <table border="0" cellpadding="1" cellspacing="1" width="100%">
	    <tr>
		<form name="addcontact" method="POST" action="admin_add_edit_contact_2.php">
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="15%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_P_TITLE?></td>
	              <td width="35%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_FIRST?></td>
	              <td width="35%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_LAST?></td>
	              <td width="15%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_RESIDENCE?></td>
	            </tr>
	            <tr>
	              <td width="15%" class="tdinput">
				  <select name="title">
				   <?php
				   //Display titles from table
				   foreach($titles as $title){
				   ?>       
				   <?php
		/************************************************************/
		/*				Coded by NubKnacker							*/
		/************************************************************/
					   if ($title->title_desc==$set_title) {
							echo "<option value='".$title->title_desc."' selected=selected>".$title->title_desc."</option>";
						} else {
							if (!$_POST['title_1']) {
								echo "<option value='".$title->title_desc."'>".$title->title_desc."</option>";
							} else {
								if ($_POST['title_1'] == $title->title_desc) {
									echo "<option value='".$title->title_desc."' selected>".$title->title_desc."</option>";
								} else {
									echo "<option value='".$title->title_desc."'>".$title->title_desc."</option>";
								}
							}
						}				
					?>
				   <?php }  ?>
				   </select>

	              </td>
	              <td width="35%" class="tdinput">
	                  <input type="text" onChange="capitalizeMe(this)" name="cfname" size="25" <?php if($action=="update"){echo " value=".strip($contact->studentcontact_fname);} else { echo " value='".$_POST['cfname_1']."'";} ?>>
	              </td>
		          <td width="35%" class="tdinput">
		              <input type="text" onChange="capitalizeMe(this)" name="clname" size="25" <?php if($action=="update"){echo " value=".strip($contact->studentcontact_lname);}
					  else { echo " value='".$_POST['clname_1']."'";}?>>
	              </td>
<?php
/************************************************************/
/*				NubKnacker									*/
/************************************************************/
?>
<?php			if (!$_POST['residence_1']) {?>
				  <td width="15%" class="tdinput" align="center">
					  <input type="checkbox" name="residence" value="1" 
					  <?php
						  if($action=="update") {
							  if($contact->studentcontact_residence==1){
								  echo "checked=checked";
							  }
						   }
						?>
<?php			} else { ?>
				  <td width="15%" class="tdinput" align="center">
					  <input type="checkbox" name="residence" value="1" 
					  <?php
							if($action=="update") {
								if($contact->studentcontact_residence==1) {
									echo "checked=checked";
								}
							} else {
								if ($_POST['residence_1']) {
									echo "checked";
								}
							}
						}
						?>
					>
	              </td>
	            </tr>
		      </table>
	        </td>
	    </tr>
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="20%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_RELATION?></td>
	              <td width="40%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_ADDRESS?></td>
		          <td width="40%">&nbsp;</td>
				</tr>
				<tr>
	              <td width="20%" class="tdinput">
				  <select name="relation">
				   <?php
				   //Display relations from table
				   foreach($relations as $relation){
 		/************************************************************/
		/*				Coded by NubKnacker							*/
		/************************************************************/
					  if ($relation->relation_codes_id==$set_relation) {
							echo "<option value='".$relation->relation_codes_id."' selected>".$relation->relation_codes_desc."</option>";
					  } else {
						  if (!$_POST['relation_1']) {
								echo "<option value='".$relation->relation_codes_id."'>".$relation->relation_codes_desc."</option>";
            				} else {
								if ($_POST['relation_1'] == $relation->relation_codes_id) {
									echo "<option value='".$relation->relation_codes_id."' selected>".$relation->relation_codes_desc."</option>";
								} else {
									echo "<option value='".$relation->relation-codes_id."'>".$relation->relation_codes_desc."</option>";
								}
							}
						}				
					?>
				   <?php
				   };
				   ?>
				   </select>
		          </td>
		          <td width="40%" class="tdinput">
				    <input type="text" onChange="capitalizeMe(this)" name="address1" size="40" <?php if($action=="update"){echo " value=".strip($contact->studentcontact_address1);} 
					else { echo " value='".$_POST['address1_1']."'";}
					?>>
	              </td>
		          <td width="40%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="address2" size="40" <?php if($action=="update"){echo " value=".strip($contact->studentcontact_address2);}
					else { echo " value='".$_POST['address2_1']."'";}
					?>>
		          </td>
	            </tr>
	          </table>
		  </td>
	    </tr>
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="35%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_CITY?></td>
	              <td width="10%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_STATE?></td>
		          <td width="10%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_ZIP?></td>
				  <td width="45%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_EMAIL?></td>
				</tr>
				<tr>
	              <td width="35%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="city" size="20" 
					<?php 
						if($action=="update"){
							echo " value=".strip($contact->studentcontact_city);
						}else{
							echo " value=".$set_city;
						}
					?>>
		          </td>
		          <td width="10%" class="tdinput">
					<select name="state">
				   <?php
				   //Display states from table
 		/************************************************************/
		/*				Coded by NubKnacker							*/
		/************************************************************/
				   foreach($states as $state){     
 						if ($state->state_code==$set_state) {
							echo "<option value='".$state->state_code."' selected>".$state->state_name."</option>";
						} else {
							if (!$_POST['state_1']) {
								echo "<option value='".$state->state_code."'>".$state->state_name."</option>";
							} else {
								echo "<option value='".$state->state_code."' selected>".$state->state_name."</option>";
							}
						}
				   }
				   ?>
					</select>
	              </td>
		          <td width="10%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="zip" size="10" <?php if($action=="update"){echo " value=".strip($contact->studentcontact_zip);}else{echo " value=".$set_zip;}; ?>>
		          </td>
		          <td width="45%" class="tdinput">
					<input type="text" onchange="this.value=this.value.toLowerCase();" name="email" size="50" <?php if($action=="update"){echo " value=".strip($contact->studentcontact_email);} else { echo " value='".$_POST['email_1']."'";} ?>>
		          </td>
	            </tr>
	          </table>
		  </td>
	    </tr>		
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="30%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_PHONE1?></td>
	              <td width="30%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_PHONE2?></td>
		          <td width="30%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_PHONE3?></td>
				  <td width="10%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_MAILINGS?></td>
				</tr>
				<tr>
	              <td width="30%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="phone1" size="20" <?php if($action=="update"){echo " value=".strip($contact->studentcontact_phone1);} else { echo "value='".$_POST['phone1_1']."'"; }?>>
		          </td>
		          <td width="30%" class="tdinput">
				    <input type="text" onChange="capitalizeMe(this)" name="phone2" size="20" <?php if($action=="update"){echo " value=".strip($contact->studentcontact_phone2);} else { echo "value='".$_POST['phone2_1']."'"; }?>>
	              </td>
		          <td width="30%" class="tdinput">
					<input type="text" onChange="capitalizeMe(this)" name="phone3" size="20" <?php if($action=="update"){echo " value=".strip($contact->studentcontact_phone3);} else { echo "value='".$_POST['phone3_1']."'"; }?>>
		          </td>
		          <td width="10%" class="tdinput">
					  <input type="checkbox" name="mailings"  
					  <?php
 		/************************************************************/
		/*				Coded by NubKnacker							*/
		/************************************************************/
					  if($action=="update") {
						  if($contact->studentcontact_mailings==1){
							  echo " checked";
						   }
					   } else {
						   if ($_POST['mailings_1']) {
								echo " checked";
						   }
					   }
					  ?>
						>
		          </td>
	            </tr>
	          </table>
		  </td>
	    </tr>		
		<tr>
	      <td width="100%">
	          <table border="1" cellpadding="0" cellspacing="0" width="100%">
	            <tr class="trform">
	              <td width="100%">&nbsp;<?php echo _ADMIN_ADD_EDIT_CONTACT_1_OTHER?></td>
				</tr>
				<tr>
	              <td width="30%" class="tdinput" align="center">
					<textarea name="other" cols="40" rows="5">
					<?php
						if($action=="update") {
							echo strip($contact->studentcontact_other);
						} else { 
							echo $_POST['other_1'];
						} 
					?>
					</textarea>
		          </td>
	            </tr>
	          </table>
		  </td>
	    </tr>		
      </td>
    </tr>
    <tr>
      <td width="100%" align="right">
	   <input type="submit" name="sumbit" value="<?php echo $sub_button; ?>" class="frmbut">
	   <input type="hidden" name="contactid" value="<?php echo $contactid; ?>">	
   	   <input type="hidden" name="studentid" value="<?php echo $studentid; ?>">	
	   <input type="hidden" name="action" value="<?php echo $action; ?>">	   
	   <?php
	   if($menustudent==1){
	   ?>
			<input type="hidden" name="rback" value="rback">	   
	   <?php
	   };
	   ?>
	  </td>
    </tr>
  </form>
</table>
</div>
<?php include "admin_menu.inc.php"; ?>
</body>

</html>
