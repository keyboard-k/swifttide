Hi, this is my proposed layout for modular future versions of Swift Tide.

About the root folder
====================

All folders that should not accessed directly by URL, are started with an underscore,
ex: _database_layer



FOLDERS
=======

+culture  => contains language files

+database_layer => contains files which interact with database

+front_layer => layout (html) files

+helper => functions and classes




Special Notes
=============

ignition.php is a global file which is called by all other files and contains all necessary code to ignite (initialise) them.

$E is the global array which contains everything that needed globally.
(why $E? Because capital E is easier to write as we write $ with shift key pressed and key 'E' is just below it!)
$EC is also a gloabal array which contains the language translation string


_() is function (yes, just one underscore!!) defined in helper/loaded.php which prints the value of a string in corresponding language.

By convention, all files and folders are in singular form and not in plural like teacher and not teachers. (Its just a proposal from me)

Extension convention
.dl.php 	database layer files
.cf.php		configuration files
.hp.php		helper files
.ly.php		html layout files
.cu.php		culture(language) files



To check everything execute index.php form your server.






