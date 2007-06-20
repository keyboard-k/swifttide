<?PHP
// Load headers
REQUIRE(TEMPLATEPATH."/all_header.tpl.php");
?>
<HTML><HEAD><?=$css?></HEAD><BODY class="inputframe">
<FORM name="dummy" action="main.php" method="post">
  <INPUT type="hidden" name="session_id" value="<?=$session_id?>">
  <INPUT type="hidden" name="include" value="4">
  <INPUT type="hidden" name="m" value="">
  <INPUT type="hidden" name="t" value="">
  <INPUT type="hidden" name="u" value="">
  <INPUT type="hidden" name="x" value="">
  <INPUT type="hidden" name="frame" value="i">
</FORM></BODY></HTML>