<script>
  function checkChkBox(){
    var myForm=document.getElementById('installform');
    if(myForm && myForm.do_skip){
      if(myForm.do_skip.checked){
        myForm.admin_login.disabled=true;
        myForm.admin_pw.disabled=true;
        myForm.admin_email.disabled=true;
      }else{
        myForm.admin_login.disabled=false;
        myForm.admin_pw.disabled=false;
        myForm.admin_email.disabled=false;
      }
    }
  }
</script>
<form id="installform" action="./install.php" method="post">
  <input type="hidden" name="framed" value="1" />
  <input type="hidden" name="include" value="" />
  <input type="hidden" name="submitted" value="1" />
  <input type="hidden" name="timestamp" value="<?=md5(microtime())?>" />
  <table border="0" width="99%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <h3>4. Create Administrator account</h3>
        <br />
<?php
if(!empty($errortext)){
?>
        <table class="main_table" cellpadding="5" cellspacing="1">
<?php
  foreach($errortext as $error){
?>
          <tr valign="middle">
            <td class="main_table_cell_error" align="left">
              <b><?=htmlentities($error)?></b>
            </td>
          </tr>
<?php
  }
?>
        </table>
        <br />
<?php
}
?>
        <table class="main_table" cellpadding="5" cellspacing="1">
<?php
if($keep_users){
?>
          <tr valign="middle">
            <td class="main_table_cell" align="left" colspan="2">
              <label for="do_skip">
                <input type="checkbox" onclick="checkChkBox()" onchange="checkChkBox()" name="do_skip" id="do_skip" value="1" />
                Do not create new Administrator account
              </label>
            </td>
          </tr>
<?php
}
?>
          <tr valign="middle">
            <td class="main_table_cell" align="left">
              <b>Administrator username:</b>
            </td>
            <td class="main_table_cell" align="left">
              <input type="text" name="admin_login" value="<?=htmlentities($admin_login)?>" size="18" maxlength="255" />
            </td>
          </tr>
          <tr valign="middle">
            <td class="main_table_cell" align="left">
              <b>Administrator password:</b>
            </td>
            <td class="main_table_cell" align="left">
              <input type="text" name="admin_pw" value="<?=htmlentities($admin_pw)?>" size="18" maxlength="255" />
            </td>
          </tr>
          <tr valign="middle">
            <td class="main_table_cell" align="left">
              <b>Administrator Email address:</b>
            </td>
            <td class="main_table_cell" align="left">
              <input type="text" name="admin_email" value="<?=htmlentities($admin_email)?>" size="18" maxlength="255" />
            </td>
          </tr>
        </table>
        <br />
        <input type="button" value="&nbsp;&nbsp;&nbsp;Continue&nbsp;&nbsp;&nbsp;" onclick="doSubmit('include=<?=$include?>')" />
      </td>
    </tr>
  </table>
</form>