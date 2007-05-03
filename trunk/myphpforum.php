<?php
include("phpforum.php");
include_once("configuration.php");
//Patched 040807 to incorporate configuration.php

class myphpforum extends phpforumPlus {
function myphpforum(){
	global $db_server, $db_user, $db_password, $db_name;
	$this->db_host=$db_server;
	$this->db_user=$db_user;
	$this->db_passwd=$db_password;
	$this->forum_database=$db_name;
}
//----------------environment options--------------
	var $member;
//----------------end environment options--------
//------------------page_options------------------
	var $display_forum="displayforum.php";
	var $view_thread_page="showmessage.php";
	var $reply_page="reply.php";
	var $post_new_thread_page="post.php";
	var $search_page="search.php";
//-----------------end_page options---------------
//---------------database options------------------
	var $threads_limit_per_page=20;
	var $thread_length_limit=2000;
	var $headline_length_limit=40;
	var $database_type="mysql";
//
//**ENTER USER DATA HERE
//var $db_host=$db_host; //usually this unless MySQL is on other box
//var $db_user=$db_user;      //same db user as rest of program (should NOT be root)
//var $db_passwd=$db_password;        //same db password as rest ofprogram
//var $forum_database=$db_name;   //same db name as rest of command school
//**END OF USER DATA
	var $topic_tables=array("SCHOOL"=>array("forum_posts","forum_replies","General forum for school related discussions. Feel free to express your thoughts !"));
	var $table_struct=array("table_posts"=>array("id","member","headline","body","date_posted","views"),
	                         "table_replies"=>array("id","member","headline","body","date_posted"));
//-------------end_database options------------------
//-------------icon options-------------------------
	var $forum_icon=array("SCHOOL"=>"");
	var $thread_icon="";
	var $hot_thread_icon="";
	var $hot_thread_limit=10;
//------------end_icon options---------------------
//------------stylesheet options---------------------
	var $style_type="normal";
//-------------end-stylesheet-options--------------	
//------------site options----------------------------
        var $welcome_msg="Welcome to our community";
        var $site_administrator=SMTP_FROM_EMAIL;
//------------end_site options----------------------- 
}  
?>
