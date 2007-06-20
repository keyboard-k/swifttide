<form id="installform" action="./install.php" method="post">
  <input type="hidden" name="framed" value="1" />
  <input type="hidden" name="include" value="" />
  <input type="hidden" name="submitted" value="1" />
  <input type="hidden" name="timestamp" value="<?=md5(microtime())?>" />
  <table border="0" width="99%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <h3>5. Final configuration</h3>
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
foreach($settings as $setting_name=>$setting_data){
?>
          <tr valign="middle">
            <td class="main_table_cell" align="left">
              <b><?=htmlentities($setting_data['description1'])?></b>
<?php
  if($setting_data['description2']<>''){
?>
              <br />
              <?=htmlentities($setting_data['description2'])?>
<?php
  }
?>
            </td>
            <td class="main_table_cell" align="left">
              <input type="text" name="settings[<?=$setting_name?>]" value="<?=htmlentities($setting_data['value'])?>" size="64" maxlength="255" />
            </td>
          </tr>
<?php
}
?>
        </table>
        <br />
        <input type="button" value="&nbsp;&nbsp;&nbsp;Continue&nbsp;&nbsp;&nbsp;" onclick="doSubmit('include=<?=$include?>')" />
      </td>
    </tr>
  </table>
</form>