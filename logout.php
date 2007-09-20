<?php
//*
// logout.php
// All Sections
// Logout user and return to login page
//*


session_start();
session_unregister("UserId");
session_unregister("UserType");
header("Location: index.php");
?>