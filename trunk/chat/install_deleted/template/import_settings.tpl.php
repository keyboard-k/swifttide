<form id="installform" action="./install.php" method="post">
  <input type="hidden" name="framed" value="1" />
  <input type="hidden" name="include" value="" />
  <input type="hidden" name="import_submitted" value="1" />
  <input type="hidden" name="timestamp" value="<?=md5(microtime())?>" />
  <table border="0" width="99%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <h3>3. Import settings</h3>
        <br />
        <table class="main_table" cellpadding="5" cellspacing="1">
<?php
if(true!==$data_found){
  // No previous installations detected
?>
          <tr valign="middle">
            <td class="main_table_cell" align="center" colspan="2">
              There were no old PCPIN Chat installations detected.
              <br />
              Press <b>Continue</b>.
            </td>
          </tr>
<?php
}else{
  // Previous installation detected
?>
          <tr valign="middle">
            <td class="main_table_cell" align="center" colspan="2">
              Following PCPIN Chat version installation was detected:
              <br />
              <b>PCPIN Chat <?=htmlentities($old_version)?></b>.
              <br />
              Please select the data you want to import into the new version:
            </td>
          </tr>
<?php
  $i=0;
  foreach($existsing_data as $key=>$val){
?>
          <tr valign="middle">
<?php
    if($val){
?>
            <td class="main_table_cell" align="center">
              <input type="checkbox" id="keep_settings<?=++$i?>" name="keep_settings[]" value="<?=htmlentities($key)?>" />
            </td>
            <td class="main_table_cell" align="left">
              <label for="keep_settings<?=$i?>">
                <?=htmlentities($key)?>
              </label>
            </td>
<?php
    }else{
?>
            <td class="main_table_cell" align="center">
              &nbsp;
            </td>
            <td class="main_table_cell" align="left">
              <?=htmlentities($key)?>
            </td>
<?php
    }
?>
          </tr>
<?php
  }
}
?>
        </table>
        <br />
        <input type="button" value="&nbsp;&nbsp;&nbsp;Continue&nbsp;&nbsp;&nbsp;" onclick="doSubmit('include=<?=$include?>')" />
      </td>
    </tr>
  </table>
</form>