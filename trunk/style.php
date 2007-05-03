<?php
/*
**********************************************************
Class: Style 
Description: the php class for customizing the look & feel
of your forum 
Author: Tsiavos Chris <jaames@freemail.gr>
Date: Oct 2003
***********************************************************
FOR MORE INFO READ THE ACCOMPANING README FILE
***********************************************************
File: style.php - Customizes the look & feel of your forum
***********************************************************
FAQ for class Style
***********************************************************
Q:How can i use a stylesheet for the forum?
A:Open the myphpforum.php script and in the stylesheet options
area edit the value of the var $style_type to any of the following
stylesheet names: blue_gray,black_gray,ocean,orange,normal,green,
IceBlue and gray_tech.

Q:How can i use my own stylesheet?
A: You can include your custom stylesheet in this file

Q:What is the use of var $table_info_section,
var $table_body_section and var $table_footer_section variables?
A: 
      var $table_info_section: This variable defines the name of the CSS class selector applied in the info
      section of the HTML table. The info section is the row which contains the name of the table columns.For
      instance if we want to make the background color of this row to be black we specify a CSS class selector
      as below

      .black_row {background-color:black;}

      Next we inform the table_info_section variable with the name of the CSS class selector

      $this->table_info_section="black_row";

      var $table_footer_section: As above it's used to define the name of the CSS class selector applied in
      the footer section of the HTML table.The footer section is the last row of the table.

      var $table_body_section: The body section is all table rows minus the first and the last row. You can
      specify multiple CSS class selectors. If this is the case the styles will be applied in an repeative
      order

Q:How can i change the attributes of the <TABLE> HTML element?
A:Edit the appropriate variables in function "style" 
(constructor of class style).

Q:And which variables do i edit?
A:
       var $table_width: Defines the width of the HTML table. Default value 720 pixels.

       $this->table_width=720;

       var $table_height: The height of the HTML table.Default value none(meaning auto)

       $this->table_height="";

       var $table_cell_spacing: Cell spacing attribute. Default value 1.

       $this->table_cell_spacing=1;

       var $table_cell_padding: Cell padding attribute.Default value 0.

       $this->table_cell_padding=0;

       var $table_border: Table's border attribute.Default value 0.

       $this->table_border=0; 
**********************************************************
*/

class style {

	var $what_style;
	var $table_info_section;
	var $table_body_section;
	var $table_footer_section;
	var $table_width;
	var $table_height;
	var $table_cell_spacing;
	var $table_cell_padding;
	var $table_border;


function style($style) {
$this->what_style=$style;
$this->table_info_section="table_info";
$this->table_body_section=array("table_body","table_body2");
$this->table_footer_section="table_footer";
$this->table_width=720;
$this->table_height="";
$this->table_cell_spacing=1;
$this->table_cell_padding=0;
$this->table_border=0;
$this->apply_style();
}

function apply_style() {

	switch ($this->what_style) {

	case "blue_gray":

print <<<BLUE_GRAY
<style type="text/css">
<!--
BODY {   SCROLLBAR-FACE-COLOR: #DFDFE5; 
         SCROLLBAR-HIGHLIGHT-COLOR: #F1F1F4;
         SCROLLBAR-SHADOW-COLOR: #72728B;
         SCROLLBAR-3DLIGHT-COLOR: #72728B;
         SCROLLBAR-ARROW-COLOR: #696983;
         SCROLLBAR-TRACK-COLOR: #F1F1F4;
         SCROLLBAR-DARKSHADOW-COLOR: #E4E4E9;
         BACKGROUND-COLOR:#CCC8C5;
         font-family: Arial, Helvetica, sans-serif; font-size: 12px;
         position: relative !important; }
   
A  {    font-family: Arial, Helvetica, sans-serif;
	font-size: 14px; color: #4d4b8c; 
	text-decoration: underline; }

A:hover { color: #999999; 
          text-decoration: underline; }

A:visited { color: #4d4b8c; 
	    text-decoration: underline; }

A:visited:hover { color: black; 
                  text-decoration: underline; }

.table_info {  background-color:#5a5891; 
               font-family: Arial; color: white;padding:5px; }

.table_body { background-color:#f4f4f4; 
              font-family: Arial; color: black;
              padding:8px; }
	
.table_body2 {  background-color:lightgrey; 
                font-family: Arial; color: black;
                padding:8px; }

.table_footer {  background-color:#5a5891;
                 font-family: Arial; color: white;
                 padding:3px; }

textarea,select,input   { background-color: #E9E9EF; 
                          font-family: Arial, Helvetica, sans-serif;
                          font-size: 14px;
                          color:#57576B;
                          font-style: normal;
                          font-weight:normal;
                          border: 1px #6B6B85 solid; }

td,tr {  font-family: Arial, Helvetica, sans-serif; 
         font-size: 14px;
         font-style: normal;
         font-weight: normal;
         color: #000000;  }
//-->
</style>
BLUE_GRAY;
break;

	case "black_gray":

print <<<BLACK_GRAY
<style type="text/css">
<!--
BODY {   SCROLLBAR-FACE-COLOR: #000000; 
         SCROLLBAR-HIGHLIGHT-COLOR:#F1F1F4;
         SCROLLBAR-SHADOW-COLOR: #72728B;
         SCROLLBAR-3DLIGHT-COLOR: #72728B;
         SCROLLBAR-ARROW-COLOR: #696983;
         SCROLLBAR-TRACK-COLOR: gray;
         SCROLLBAR-DARKSHADOW-COLOR: #E4E4E9;
         BACKGROUND-COLOR:#CCC8C5;
         font-family: Arial, Helvetica, sans-serif;
         font-size: 12px;
         position: relative !important;  }
   
A               { font-family: Arial, Helvetica, sans-serif; 
                  font-size: 14px;
                  color: #4d4b8c;
                  text-decoration: underline; }

A:hover             { color: #999999; 
                      text-decoration: underline; }

A:visited           { color: #4d4b8c; 
                      text-decoration: underline; }

A:visited:hover { color: black; 
                  text-decoration: underline; }

.table_info {  background-color:#000000; 
               font-family: Arial;
               color: white;
               padding:5px; }

.table_body {  background-color:#f4f4f4; 
               font-family: Arial;
               color: black;
               padding:8px; }

.table_body2 {  background-color:lightgrey; 
                font-family: Arial;
                color: black;
                padding:8px; }
 
.table_footer {  background-color:#000000; 
                 font-family: Arial;
                 color: white;
                 padding:3px; }

textarea,select,input   { background-color: gray; 
                          font-family: Arial, Helvetica, sans-serif;
                          font-size: 14px;
                          color:white;
                          font-style: normal;
                          font-weight:normal;
                          border: 1px #6B6B85 solid; }

td,tr { font-family: Arial, Helvetica, sans-serif; 
        font-size: 14px;
        font-style: normal;
        font-weight: normal;
        color: #000000; }
//-->
</style>
BLACK_GRAY;
break;

	case "ocean":

print <<<OCEAN
<style type="text/css">
<!--
body { SCROLLBAR-FACE-COLOR: #505B94; 
       SCROLLBAR-HIGHLIGHT-COLOR:#F1F1F4;
       SCROLLBAR-SHADOW-COLOR: #72728B;
       SCROLLBAR-3DLIGHT-COLOR: #72728B;
       SCROLLBAR-ARROW-COLOR: #FFFFFF;
       SCROLLBAR-TRACK-COLOR:#90D6E2;
       SCROLLBAR-DARKSHADOW-COLOR: #E4E4E9;
       BACKGROUND-COLOR:#7483CB;
       font-family: Arial, Helvetica, sans-serif;
       font-size: 12px;
       position: relative !important;
       color:white; }
   
TD A           { font-family: Arial, Helvetica, sans-serif;
                 font-size: 14px;
                 color:#4d4b8c;
                 text-decoration: underline;  }

A:hover,A:visited:hover
	{  color: black;
         text-decoration: underline; }

A               { font-family: Arial, Helvetica, sans-serif;
		  font-size: 14px;
	 	  color:#FFFFFF;
	 	  text-decoration: underline; }

.table_info {  background-color:#000000; 
               font-family: Arial;
               color: white;
               padding:5px; }

.table_body { background-color:#ACC8EF;
              font-family: Arial;
              color: black;
              padding:8px; }

.table_body2 { background-color:#90D6E2;
               font-family: Arial;
               color: black;padding:8px; }

.table_footer { background-color:#000000;
                font-family: Arial;
                color: white;
                padding:3px; }

textarea,select,input   { background-color: #ACC8EF; 
                          font-family: Arial, Helvetica, sans-serif;
                          font-size: 14px;
                          color:#000000;
                          font-style: normal;
                          font-weight:normal;
                          border: 1px #6B6B85 solid; }

td,tr { font-family: Arial, Helvetica, sans-serif; 
        font-size: 14px;
        font-style: normal;
        font-weight: normal;
      }
//-->
</style>
OCEAN;
break;

	case "orange":

print <<<ORANGE
<style type="text/css">
<!--
body { SCROLLBAR-FACE-COLOR: #000000;
       SCROLLBAR-HIGHLIGHT-COLOR:#F1F1F4;
       SCROLLBAR-SHADOW-COLOR: #72728B;
       SCROLLBAR-3DLIGHT-COLOR: #72728B;
       SCROLLBAR-ARROW-COLOR: #FFFFFF;
       SCROLLBAR-TRACK-COLOR:#D1A996;
       SCROLLBAR-DARKSHADOW-COLOR: #E4E4E9;
       BACKGROUND-COLOR:#D1A976;
       font-family: Arial, Helvetica, sans-serif;
       font-size: 12px;
       position: relative !important;
       color:black; }

A,TD A,A:hover,A:visited,A:visited:hover
	{ font-family: Arial, Helvetica, sans-serif;
   	  font-size: 14px;
	  color:#000000;
   	  text-decoration: underline; }

.table_info {  background-color:#000000; 
               font-family: Arial;
               color: white;
               padding:5px; }

.table_body { background-color:#F5E7D5; 
              font-family: Arial;
              color: black;
              padding:8px; }
	
.table_body2 { background-color:#E9D5BB;
               font-family: Arial;
               color: black;padding:8px; }

.table_footer { background-color:#000000; 
                font-family: Arial;
                color: white;
                padding:3px; }

textarea,select,input   { background-color: #F9DDB9; 
                          font-family: Arial, Helvetica, sans-serif;
                          font-size: 14px;
                          color:#000000;
                          font-style: normal;
                          font-weight:normal;
                          border: 1px #6B6B85 solid; }

td,tr { font-family: Arial, Helvetica, sans-serif; 
        font-size: 14px;
        font-style: normal;
        font-weight: normal;
        color: #000000; }
//-->
</style>
ORANGE;
break;

	case "normal":

print <<<NORMAL
<style type="text/css">
<!--
   
/*A,TD A,A:hover,A:visited,A:visited:hover
                { font-family: Arial, Helvetica, sans-serif;
	  	  font-size: 14px;
	          color:#000000;
	  	  text-decoration: underline; }*/
a {
      color : navy;
      font-size : 11px;
      text-decoration : none;
      font-weight : 600;
      font-family : verdana, arial, helvetica, sans-serif;
 }
 a:link {
      color : navy;
 }
 a:visited {
      color : navy;
 }
 a:hover {
      background-color : #ffffff;
	  text-decoration : underline;
 }
.table_info {  background-color:#708090; 
               font-family: Arial;
               color: white;
               padding:5px; }

.table_body { background-color:#FFFFFF; 
              font-family: Arial;
              color: black;
      border-style : solid;
      border-color : black;
      border-width : 1px 0;
      line-height : 11px;

              padding:3px; }

.table_body2 { background-color:#FFFFFF;
               font-family: Arial;
               color: black;
	           padding:3px; }

.table_footer { background-color:#708090; 
                font-family: Arial;
                color: white;
                padding:3px; }

textarea,select,input   { background-color: #FFFFFF;
                          font-family: Arial, Helvetica, sans-serif;
                          font-size: 14px;
                          color:#000000;
                          font-style: normal;

                          font-weight:normal;
                          border: 1px #6B6B85 solid; }

td,tr { font-family: Arial, Helvetica, sans-serif; 
          font-size: 14px; 
          font-style: normal; 
          font-weight: normal; 
          color: #000000; }

//-->
</style>
NORMAL;
break;

	case "green":

print <<<GREEN
<style type="text/css">
<!--
body { SCROLLBAR-FACE-COLOR: #A6CEB0;
       SCROLLBAR-HIGHLIGHT-COLOR:#F1F1F4;
       SCROLLBAR-SHADOW-COLOR: #72728B;
       SCROLLBAR-3DLIGHT-COLOR: #72728B;
       SCROLLBAR-ARROW-COLOR: #000000;
       SCROLLBAR-TRACK-COLOR:#D9D9D9;
       SCROLLBAR-DARKSHADOW-COLOR: #E4E4E9;
       BACKGROUND-COLOR:#E8E8E2;
       font-family: Arial, Helvetica, sans-serif;
       font-size: 12px;
       position: relative !important;
       color:black; }

A,TD A,A:hover,A:visited,A:visited:hover
                { font-family: Arial, Helvetica, sans-serif;
	  	  font-size: 14px;
	  	  color:#000000;
	  	  text-decoration: underline; }

.table_info {  background-color:#000000;
               font-family: Arial;
               color: white;
               padding:5px; }

.table_body { background-color:#D0E8C9;
              font-family: Arial;
              color: black;
              padding:8px; }

.table_body2 { background-color:#A6CEB0;
               font-family: Arial;
               color: black;padding:8px; }

.table_footer { background-color:#000000;
                font-family: Arial;
                color: white;
                padding:3px; }

textarea,select,input   { background-color: #C8E1CF;
                          font-family: Arial, Helvetica, sans-serif;
                          font-size: 14px;
                          color:#000000;
                          font-style: normal;
                          font-weight:normal;
                          border: 1px #6B6B85 solid; }

td,tr { font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        font-style: normal;
        font-weight: normal;
        color: #000000; }
//-->
</style>
GREEN;
break;

case "IceBlue":

print <<<ICEBLUE
<style type="text/css">
<!--
body { SCROLLBAR-FACE-COLOR: #283fc1;
       SCROLLBAR-HIGHLIGHT-COLOR:#283fc1;
       SCROLLBAR-SHADOW-COLOR: #72728B;
       SCROLLBAR-3DLIGHT-COLOR: #72728B;
       SCROLLBAR-ARROW-COLOR: #FFFFFF;
       SCROLLBAR-TRACK-COLOR:#f2f6f9;
       SCROLLBAR-DARKSHADOW-COLOR: #E4E4E9;
       BACKGROUND-COLOR:#FFFFFF;
       font-family: Arial, Helvetica, sans-serif;
       font-size: 12px;
       position: relative !important;
       color:black; }

A,TD A,A:hover,A:visited,A:visited:hover
                { font-family: Arial, Helvetica, sans-serif;
	  	  font-size: 14px;
	  	  color:#283fc1;
	  	  text-decoration: underline; }

.table_info {  background-color:#283fc1;
               font-family: Arial;
               color: white;
               padding:5px; }

.table_body { background-color:#f2f6f9;
              font-family: Arial;
              color: black;
              padding:8px; }

.table_body2 { background-color:#FFFFFF;
               font-family: Arial;
               color: black;padding:8px; }

.table_footer { background-color:#283fc1;
                font-family: Arial;
                color: white;
                padding:3px; }

input,textarea,select   { background-color: #FFFFFF;
          		  font-family: Arial, Helvetica, sans-serif;
          		  font-size: 14px;
          		  color:#000000;
          		  font-style: normal;
          		  font-weight:normal;
          		  border: 1px #6B6B85 solid; }


td,tr { font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        font-style: normal;
        font-weight: normal;
        color: #283fc1; }
//-->
</style>
ICEBLUE;
break;

case "gray_tech":

print <<<GRAY_TECH
<style type="text/css">
<!--
body { SCROLLBAR-FACE-COLOR: #000000;
       SCROLLBAR-HIGHLIGHT-COLOR:#000000;
       SCROLLBAR-SHADOW-COLOR: #72728B;
       SCROLLBAR-3DLIGHT-COLOR: #72728B;
       SCROLLBAR-ARROW-COLOR: #FFFFFF;
       SCROLLBAR-TRACK-COLOR:#444342;
       SCROLLBAR-DARKSHADOW-COLOR: #E4E4E9;
       BACKGROUND-COLOR:#e8e2dc;
       font-family: Arial, Helvetica, sans-serif;
       font-size: 12px;
       position: relative !important;
       color:black; }

A,TD A,A:hover,A:visited,A:visited:hover
                { font-family: Arial, Helvetica, sans-serif;
	  	  font-size: 14px;
	  	  color:#000000;
	  	  text-decoration: underline; }

.table_info {  background-color:#444342;
               font-family: Arial;
               color: white;
               padding:5px; }

.table_body { background-color:#d0eae8;
              font-family: Arial;
              color: black;
              padding:8px; }

.table_body2 { background-color:#d0eae8;
               font-family: Arial;
               color: black;padding:8px; }

.table_footer { background-color:#444342;
                font-family: Arial;
                color: white;
                padding:3px; }

input,textarea          { background-color: #FFFFFF;
          		  font-family: Arial, Helvetica, sans-serif;
          		  font-size: 14px;
          		  color:#000000;
          		  font-style: normal;
          		  font-weight:normal;
          		  border: 1px #6B6B85 solid; }

select 		{	  background-color: #d0eae8;
          		  font-family: Arial, Helvetica, sans-serif;
          		  font-size: 14px;
          		  color:#000000;
          		  font-style: normal;
          		  font-weight:normal;
          		  border: 1px #6B6B85 solid;}



td,tr { font-family: Arial, Helvetica, sans-serif;
        font-size: 14px;
        font-style: normal;
        font-weight: normal;
        color: #000000; }
//-->
</style>
GRAY_TECH;
break;

	default:
	print("<strong><font color=\"red\">Error from class Style:Invalid Stylesheet selected</font></strong><br/>");

}	

}

}

?>
