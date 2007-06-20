<?PHP
// Check rights
IF(!($current_user->level&128)){
  DIE("HACK?");
}

// Declare class
$advertisement=NEW advertisement();

IF($add){
  // Add new advertisement
  IF($submitted){
    // Save advertisement
    // Validate form
    UNSET($error);
    // Check text
    IF(EMPTY($text)){
      $error[]=$lng["textempty"];
    }
    // Check date
    IF(!@CHECKDATE($start_month,$start_day,$start_year)){
      $error[]=$lng["startdateinvalid"];
    }
    IF(!@CHECKDATE($stop_month,$stop_day,$stop_year)){
      $error[]=$lng["stopdateinvalid"];
    }
    // Check time
    IF(  !common::checkDigits($start_hour)||$start_hour>23
       ||!common::checkDigits($start_minute)||$start_minute>59
       ||!common::checkDigits($start_second)||$start_second>59
       ){
      $error[]=$lng["starttimeinvalid"];
    }
    IF(  !common::checkDigits($stop_hour)||$stop_hour>23
       ||!common::checkDigits($stop_minute)||$stop_minute>59
       ||!common::checkDigits($stop_second)||$stop_second>59
       ){
      $error[]=$lng["stoptimeinvalid"];
    }
    IF(!IS_ARRAY($error)){
      // No errors
      // Generate MySQL DATETIME string
      $start=MKTIME($start_hour,$start_minute,$start_second,$start_month,$start_day,$start_year);
      $stop=MKTIME($stop_hour,$stop_minute,$stop_second,$stop_month,$stop_day,$stop_year);
      // Saving advertisement
      $advertisement->text=$text;
      $advertisement->start=$start;
      $advertisement->stop=$stop;
      $advertisement->period=$period;
      $advertisement->min_roomusers=$min_roomusers;
      $advertisement->show_private=$show_private;
      $advertisement->insertAdvertisement($session,$advertisement_id);
      $edit=1;
      UNSET($advertisement_id);
    }ELSE{
      UNSET($submitted);
    }
  }
  IF(!$submitted){
    // Show form
    // Set defaults
    IF(EMPTY($banner_url)){
      $banner_url="http://";
    }
    IF(EMPTY($banner_href)){
      $banner_href="http://";
    }
    IF(!$start_year){
      $start_year=DATE("Y");
    }
    IF(!$start_month){
      $start_month=DATE("m");
    }
    IF(!$start_day){
      $start_day=DATE("d");
    }
    IF(!ISSET($start_hour)){
      $start_hour=DATE("H");
    }
    IF(!ISSET($start_minute)){
      $start_minute=DATE("i");
    }
    IF(!ISSET($start_second)){
      $start_second=DATE("s");
    }
    IF(!$stop_year){
      $stop_year=$start_year+1;
    }
    IF(!$stop_month){
      $stop_month=$start_month;
    }
    IF(!$stop_day){
      $stop_day=$start_day;
    }
    IF(!ISSET($stop_hour)){
      $stop_hour=$start_hour;
    }
    IF(!ISSET($stop_minute)){
      $stop_minute=$start_minute;
    }
    IF(!ISSET($stop_second)){
      $stop_second=$start_second;
    }
    IF(!$period){
      $period=5;
    }
    IF(!$min_roomusers){
      $min_roomusers=2;
    }
    IF(!ISSET($show_private)){
      $show_private=0;
    }
    ${'checked_show_private_'.$show_private}='checked';
    // Load teplate
    REQUIRE(TEMPLATEPATH."/admin_advertisement.tpl.php");
  }
}
IF($edit){
  IF($delete&&$advertisement_id){
    // Delete advertisement
    $advertisement->deleteAdvertisement($session,$advertisement_id);
    UNSET($advertisement_id);
  }
  // Edit advertisement
  IF(!$advertisement_id){
    // List advertisements
    $advertisements=$advertisement->listAdvertisements($session);
    $advertisements_count=COUNT($advertisements);
    // Load teplate
    REQUIRE(TEMPLATEPATH."/admin_advertisementlist.tpl.php");
  }ELSE{
    // Load advertisement
    $advertisement->readAdvertisement($session,$advertisement_id);
    $text=$advertisement->text;
    $start_year=DATE("Y",$advertisement->start);
    $start_month=DATE("m",$advertisement->start);
    $start_day=DATE("d",$advertisement->start);
    $start_hour=DATE("H",$advertisement->start);
    $start_minute=DATE("i",$advertisement->start);
    $start_second=DATE("s",$advertisement->start);
    $stop_year=DATE("Y",$advertisement->stop);
    $stop_month=DATE("m",$advertisement->stop);
    $stop_day=DATE("d",$advertisement->stop);
    $stop_hour=DATE("H",$advertisement->stop);
    $stop_minute=DATE("i",$advertisement->stop);
    $stop_second=DATE("s",$advertisement->stop);
    $period=$advertisement->period;
    $min_roomusers=$advertisement->min_roomusers;
    $show_private=$advertisement->show_private;
    ${'checked_show_private_'.$show_private}='checked';
    // Load teplate
    REQUIRE(TEMPLATEPATH."/admin_advertisement.tpl.php");
  }
}


?>
