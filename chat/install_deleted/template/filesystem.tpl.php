<form id="installform" action="./install.php" method="post">
  <input type="hidden" name="framed" value="1" />
  <input type="hidden" name="include" value="" />
  <input type="hidden" name="submitted" value="1" />
  <input type="hidden" name="timestamp" value="<?=md5(microtime())?>" />
  <table border="0" width="99%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <h3>2. Files, directories and permissions</h3>
        <br />
        <table class="main_table" cellpadding="5" cellspacing="1">
          <tr valign="middle">
            <td class="main_table_cell" align="left">
              <b>Directory</b>
            </td>
            <td class="main_table_cell" align="left">
              <b>Status</b>
            </td>
            <td class="main_table_cell" align="left">
              <b>Solution</b>
            </td>
          </tr>
<?php
foreach($modes as $mode=>$modedata){
?>
          <tr valign="middle">
            <td class="main_table_cell" align="left">
              <?=$modedata['name']?>
              <br />
              <b><?=$modedata['path']?></b>
            </td>
<?php
  if(true!==$modedata['status']){
?>
            <td class="main_table_cell" align="left">
              <span style="color:#ff0000">
                NOT WRITABLE
                <br />
                <?=$modedata['error']?>
              </span>
            </td>
            <td class="main_table_cell" align="left">
              <?=$modedata['solution']?>
            </td>
<?php
  }else{
?>
            <td class="main_table_cell" align="left">
              <span style="color:#008800">
                WRITABLE
              </span>
            </td>
            <td class="main_table_cell" align="left">
              &nbsp;
            </td>
<?php
  }
?>
            </td>
          </tr>
<?php
}
?>
        </table>
        <br />
        <input type="button" value="&nbsp;&nbsp;&nbsp;<?=(true===$status)? 'Continue' : 'RETRY'?>&nbsp;&nbsp;&nbsp;" onclick="doSubmit('include=<?=(true===$status)? $next_include : $include?>')" />
<?php
if(!$status){
  // Some errors occured
?>
        <input type="button" value="&nbsp;&nbsp;&nbsp;Ignore and continue&nbsp;&nbsp;&nbsp;" onclick="doSubmit('include=<?=$next_include?>')" />
<?php
}
?>
      </td>
    </tr>
  </table>
</form>