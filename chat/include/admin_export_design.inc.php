<?PHP
// Export design

// Check rights
IF(!($current_user->level&2)){
  DIE("HACK?");
}

// Export file
$css_file=$cssclass->generateFormattedCSS($session->db);
HEADER('Expires: Mon, 01 Jan 2000 15:57:24 GMT');
HEADER('Content-Disposition: attachment; filename="pcpin_design.css"');
HEADER('Cache-Control: must-revalidate, post-check=0, pre-check=0');
HEADER('Pragma: public');
HEADER('Content-Type: application/octet-stream');
HEADER('Content-Length: '.STRLEN($css_file));
ECHO $css_file;
DIE();
?>