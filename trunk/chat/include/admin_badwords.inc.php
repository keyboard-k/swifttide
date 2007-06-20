<?PHP
// Check rights
IF(!($current_user->level&512)){
  DIE("HACK?");
}

// Declare class
$badword=NEW badword();

// Delete bad word
IF($edit&&$delete&&$badword_id){
  $badword->deleteBadword($session,$badword_id);
  UNSET($badword_id);
}

IF($add||$badword_id){
  // Add bad word
  IF($submitted){
    // Save bad word
    // Validate form
    UNSET($error);
    // Check word
    common::dTrim($word);
    IF(EMPTY($word)){
      $error[]=$lng["wordempty"];
    }ELSEIF(STRPOS($word,"'")||STRPOS($word,"\\")||STRPOS($word,"\"")||STRPOS($word,"<")||STRPOS($word,">")){
      $error[]=$lng["invalidcharsinword"];
    }ELSE{
      IF(!$edit){
        $badword->readBadword($session,0,$word);
        IF($badword->id){
          // Bad word already exists
          $error[]=$lng["badwordexists"];
        }
      }
    }
    IF(!IS_ARRAY($error)){
      // No errors
      // Delete old bad word
      $badword->deleteBadWord($session,$badword_id);
      // Save bad word
      $badword->saveBadWord($session,$word,$replacement);
      UNSET($badword_id);
      $edit=1;
    }ELSE{
      UNSET($submitted);
    }
  }
  IF(!$submitted){
    // Show form
    IF($edit){
      $badword->readBadWord($session,$badword_id);
      $word=$badword->word;
      $replacement=$badword->replacement;
    }
    // Load teplate
    REQUIRE(TEMPLATEPATH."/admin_badword.tpl.php");
  }
}
IF($edit&&!$badword_id){
  // Show bad word list
  $badwords=$badword->listBadWords($session);
  $badwords_count=COUNT($badwords);
  // Load teplate
  REQUIRE(TEMPLATEPATH."/admin_badwordslist.tpl.php");
}



?>
