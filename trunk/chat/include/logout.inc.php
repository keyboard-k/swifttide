<?PHP
/* Process logout */
// Update cookie
$user=NEW user();
$user->readUser($session, $session->user_id);
SETCOOKIE('pcpin_cookie','@'.$user->login,TIME()+COOKIE_LIFETIME);

// Delete session
$session->logout($session_id);

?>
<HTML>
<HEAD>
<SCRIPT>
  window.location.href="<?=$session->config->exit_url?>";
</SCRIPT>
</HEAD>
</HTML>