<?php
/**
* @version $Id: lang_de.php, version 0.1 2007/03/05
*/

/** ensure this file is being included by a parent file */
defined( '_VALID' ) or die( 'Kein direkter Zugriff erlaubt.' );

/** common */

DEFINE('_BROWSER_TITLE', 'Sch&uuml;ler Management System');
DEFINE('_WELCOME', 'Willkommen');
DEFINE('_YES', 'Ja');
DEFINE('_NO', 'Nein');
DEFINE('_ENTER_VALUE', 'Bitte einen Wert eingeben!');
DEFINE('_ERROR', 'Fehler');
DEFINE("_MAX_ATTEMPTS", 10);
DEFINE('_MALE', 'm');
DEFINE('_FEMALE', 'w');
DEFINE('_NEW', 'Neu');
DEFINE('_HOST', 'localhost');
DEFINE('_DATE_FORMAT', 'd. m. Y');
DEFINE('_EXAMS_DATE', '%d. %m. %Y');
DEFINE('_STUDENTBIO_DATE', '%Y-%m-%d');
DEFINE("_CAL_FORMAT", "dd/mm/yyyy");
DEFINE('_MONDAY', 'Mo');
DEFINE('_TUESDAY', 'Di');
DEFINE('_WEDNESDAY', 'Mi');
DEFINE('_THURSDAY', 'Do');
DEFINE('_FRIDAY', 'Fr');

/** index.php */

DEFINE('_INDEX_TITLE', 'Sch&uuml;ler Management System' );
DEFINE('_INDEX_ERRLOG', 'Benutzername/Passwort inkorrekt. Bitte wiederholen.' );
DEFINE('_INDEX_NOTAUTH', 'Nicht angemeldet oder Session zu Ende. Bitte einloggen.' );
DEFINE('_INDEX_NOTFOUND', 'Wir haben diesen Benutzer nicht gefunden. Bitte wiederholen.' );
DEFINE('_INDEX_GOTPASS', 'Ihr Passwort ist Ihnen geemailt worden.' );
DEFINE('_INDEX_ATTEMPT', 'Zu viele Versuche.<BR>Bitte in 20 Minuten wieder versuchen.' );
DEFINE('_INDEX_PICTURE', 'images/sms_de.gif' );
DEFINE('_INDEX_PICTURE_SMALL', 'images/sms_de_small.gif' );
DEFINE('_INDEX_USERNAME', 'Benutzername' );
DEFINE('_INDEX_PASSWORD', 'Passwort' );
DEFINE('_INDEX_LOGIN', 'Login' );
DEFINE('_INDEX_FORGOT_PASSWORD', 'Passwort vergessen' );

/** login.php */

/** admin_main_menu.php */

DEFINE('_ADMIN_MAIN_MENU_UPPER', 'Administrator Bereich' );
DEFINE('_ADMIN_MAIN_MENU_TITLE', 'Admin Hauptmen&uuml;' );
DEFINE('_ADMIN_MAIN_MENU_SUBTITLE', 'Bitte einen Men&uuml;punkt links ausw&auml;hlen.' );

/** teacher_change_password.php */

DEFINE('_TEACHER_CHANGE_PASSWORD_SUCCESSFUL', 'Das Passwort wurde erfolgreich ge&auml;ndert.' );
DEFINE('_TEACHER_CHANGE_PASSWORD_TITLE', 'Passwort &auml;ndern' );
DEFINE('_TEACHER_CHANGE_PASSWORD_UPDATE', 'Passwort aktualisieren' );

/** teacher_change_student_year.php */

DEFINE('_TEACHER_CHANGE_STUDENT_YEAR_CONFIRM', 'Das Jahr wird geaendert. Weiter?' );
DEFINE('_TEACHER_CHANGE_STUDENT_YEAR_TITLE', 'Das Jahr f&uuml;r Sch&uuml;ler &auml;ndern' );
DEFINE('_TEACHER_CHANGE_STUDENT_YEAR_SELECT', 'Bitte m&ouml;gliche Jahre ausw&auml;hlen:' );

/** teacher_edit_student_1.php */

DEFINE('_TEACHER_EDIT_STUDENT_1_TITLE', 'Sch&uuml;lerdaten' );
DEFINE('_TEACHER_EDIT_STUDENT_1_INTERNAL_ID', 'Interne ID' );
DEFINE('_TEACHER_EDIT_STUDENT_1_ETHNICITY', 'Nationalit&auml;t' );
DEFINE('_TEACHER_EDIT_STUDENT_1_BIRTHDATE', 'Geburtstag' );
DEFINE('_TEACHER_EDIT_STUDENT_1_SCHOOL', 'Schule' );
DEFINE('_TEACHER_EDIT_STUDENT_1_GRADE', 'Klasse' );
DEFINE('_TEACHER_EDIT_STUDENT_1_ACTIVE', 'Aktiv' );
DEFINE('_TEACHER_EDIT_STUDENT_1_HOMED', 'Unterricht zu Hause' );
DEFINE('_TEACHER_EDIT_STUDENT_1_SPED', 'Spezialausbildung' );
DEFINE('_TEACHER_EDIT_STUDENT_1_ENTRY_RECORD', 'Eintrag' );
DEFINE('_TEACHER_EDIT_STUDENT_1_NOTES', 'Eintr&auml;ge');
DEFINE('_TEACHER_EDIT_STUDENT_1_BIRTHCITY', 'Geburtsort');
DEFINE('_TEACHER_EDIT_STUDENT_1_BIRTHSTATE', 'Geburtsbundesland');
DEFINE('_TEACHER_EDIT_STUDENT_1_BIRTHCOUNTRY', 'Geburtsland');
DEFINE('_TEACHER_EDIT_STUDENT_1_PRVS_SCHOOLNAME', 'Name der vorigen Schule');
DEFINE('_TEACHER_EDIT_STUDENT_1_PRVS_SCHOOLADDRESS', 'Adresse der vorigen Schule');
DEFINE('_TEACHER_EDIT_STUDENT_1_PRVS_SCHOOLCITY', 'Stadt der vorigen Schule');
DEFINE('_TEACHER_EDIT_STUDENT_1_PRVS_SCHOOLSTATE', 'Bundesland der vorigen Schule');
DEFINE('_TEACHER_EDIT_STUDENT_1_PRVS_SCHOOLZIP', 'PLZ der vorigen Schule');
DEFINE('_TEACHER_EDIT_STUDENT_1_PRVS_SCHOOLCOUNTRY', 'Land der vorigen Schule');
DEFINE('_TEACHER_EDIT_STUDENT_1_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_TEACHER_EDIT_STUDENT_1_PRIMARY_CONTACT', 'Kontaktperson');
DEFINE('_TEACHER_EDIT_STUDENT_1_RESIDENCE', 'Wohnort');
DEFINE('_TEACHER_EDIT_STUDENT_1_ADDRESS', 'Adresse');
DEFINE('_TEACHER_EDIT_STUDENT_1_CITY', 'Stadt');
DEFINE('_TEACHER_EDIT_STUDENT_1_STATE', 'Bundesland');
DEFINE('_TEACHER_EDIT_STUDENT_1_ZIP', 'PLZ');
DEFINE('_TEACHER_EDIT_STUDENT_1_PHONE1', 'Telefon 1');
DEFINE('_TEACHER_EDIT_STUDENT_1_PHONE2', 'Telefon 2');
DEFINE('_TEACHER_EDIT_STUDENT_1_PHONE3', 'Telefon 3');
DEFINE('_TEACHER_EDIT_STUDENT_1_EMAIL', 'Email');
DEFINE('_TEACHER_EDIT_STUDENT_1_WEB_USER', 'Web User');
DEFINE('_TEACHER_EDIT_STUDENT_1_ADD_CONTACTS', 'Weitere Kontakte');
DEFINE('_TEACHER_EDIT_STUDENT_1_ADD_FIRST_NAME', 'Vorname');
DEFINE('_TEACHER_EDIT_STUDENT_1_ADD_LAST_NAME', 'Nachname');
DEFINE('_TEACHER_EDIT_STUDENT_1_ADD_RELATION', 'Beziehung');
DEFINE('_TEACHER_EDIT_STUDENT_1_ADD_WEB_USER', 'Web User');
DEFINE('_TEACHER_EDIT_STUDENT_1_DETAILS', 'Details');

/** teacher_edit_student_2.php */

DEFINE('_TEACHER_EDIT_STUDENT_2_TITLE', 'Sch&uuml;ler' );
DEFINE('_TEACHER_EDIT_STUDENT_2_CONTACT', 'Kontaktperson' );
DEFINE('_TEACHER_EDIT_STUDENT_2_RESIDENCE', 'Wohnort' );
DEFINE('_TEACHER_EDIT_STUDENT_2_ADDRESS', 'Adresse');
DEFINE('_TEACHER_EDIT_STUDENT_2_CITY', 'Stadt');
DEFINE('_TEACHER_EDIT_STUDENT_2_STATE', 'Bundesland');
DEFINE('_TEACHER_EDIT_STUDENT_2_ZIP', 'PLZ');
DEFINE('_TEACHER_EDIT_STUDENT_2_PHONE1', 'Telefon 1');
DEFINE('_TEACHER_EDIT_STUDENT_2_PHONE2', 'Telefon 2');
DEFINE('_TEACHER_EDIT_STUDENT_2_PHONE3', 'Telefon 3');
DEFINE('_TEACHER_EDIT_STUDENT_2_EMAIL', 'Email');
DEFINE('_TEACHER_EDIT_STUDENT_2_WEB_USER', 'Web User');
DEFINE('_TEACHER_EDIT_STUDENT_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');

/** teacher_homework.php */

DEFINE('_TEACHER_HOMEWORK_ENTER_NAME', 'Bitte einen Namen eingeben');
DEFINE('_TEACHER_HOMEWORK_ENTER_SUBJECT', 'Bitte einen Titel eingeben');
DEFINE('_TEACHER_HOMEWORK_ENTER_DATE', 'Bitte ein Erstellungsdatum eingeben');
DEFINE('_TEACHER_HOMEWORK_ENTER_DATE_DUE', 'Bitte ein Ende-Datum eingeben');
DEFINE('_TEACHER_HOMEWORK_DELETE_ASSIGNMENT', 'Sind Sie sicher?');
DEFINE('_TEACHER_HOMEWORK_TITLE', 'Haus&uuml;bung');
DEFINE('_TEACHER_HOMEWORK_NEW_HOMEWORK', 'Neue Haus&uuml;bung');
DEFINE('_TEACHER_HOMEWORK_HOMEWORK_NAME', 'Name');
DEFINE('_TEACHER_HOMEWORK_ASSIGNED_ON', 'Aufgegeben am');
DEFINE('_TEACHER_HOMEWORK_DUE_ON', 'Fertig bis');
DEFINE('_TEACHER_HOMEWORK_NOTES', 'Eintr&auml;ge');
DEFINE('_TEACHER_HOMEWORK_SUBJECT', 'Thema');
DEFINE('_TEACHER_HOMEWORK_DELETE_BUTTON', 'Loeschen');
DEFINE('_TEACHER_HOMEWORK_UPDATE_BUTTON', 'Update');

/** teacher_manage_attendance_1.php */

DEFINE('_TEACHER_MANAGE_ATTENDANCE_1_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_1_DATE', 'Datum');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_1_CODE', 'Art');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_1_DETAILS', 'Details');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_1_TITLE', 'An-/Abwesenheit des Sch&uuml;lers');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_1_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_1_ADD_NOTE', 'Neuer Eintrag');

/** teacher_manage_attendance_2.php */

DEFINE('_TEACHER_MANAGE_ATTENDANCE_2_TITLE', 'An-/Abwesenheit des Sch&uuml;lers');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_2_SCHOOL', 'Schule');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_2_YEAR', 'Jahr');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_2_CODE', 'Art');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_2_DATE', 'Datum');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_2_NOTES', 'Eintr&auml;ge');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_2_EDIT', 'Eintrag editieren');

/** teacher_manage_attendance_3.php */

DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_TITLE', 'An-/Abwesenheit des Sch&uuml;lers');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_INSERTED', 'Eintrag von ');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_SCHOOL', 'Schule');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_YEAR', 'Jahr');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_CODE', 'Art');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_DATE', 'Datum');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_SELECT_CODE', 'Art ausw&auml;hlen');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_NOTES', 'Eintr&auml;ge');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_NOTIFY', 'Kontakt benachrichtigen');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_DELETE', 'L&ouml;schen');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_ADD', 'Hinzuf&uuml;gen');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_NEW', 'Neu');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_EDIT', 'Eintrag editieren');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_3_UPDATE', 'Eintrag aktualisieren');

/** teacher_manage_attendance_4.php */

DEFINE('_TEACHER_MANAGE_ATTENDANCE_4_SUBJECT', 'Neuer An-/Abwesenheitseintrag f&uuml;r ');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_4_BODY1', 'Ein neuer An-/Abwesenheitseintrag wurde hinzugefuegt: fuer ');
DEFINE('_TEACHER_MANAGE_ATTENDANCE_4_BODY2', 'Bitte loggen Sie auf der Home Page ein.Danke - Der Direktor');

/** teacher_manage_discipline_1.php */

DEFINE('_TEACHER_MANAGE_DISCIPLINE_1_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_1_DATE', 'Datum');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_1_CODE', 'Art');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_1_DETAILS', 'Details');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_1_TITLE', 'Verhalten des Sch&uuml;lers');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_1_ADD_NOTE', 'Neuer Eintrag');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_1_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');

/** teacher_manage_discipline_2.php */

DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_TITLE', 'Verhalten des Sch&uuml;lers');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_SCHOOL', 'Schule');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_YEAR', 'Jahr');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_INFRACTION', '&Uuml;bertretung');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_DATE', 'Datum');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_START_DATE', 'Anfang');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_END_DATE', 'Ende');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_NOTES', 'Eintr&auml;ge');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_EDIT', 'Eintrag editieren');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_INSERTED', 'Eintrag von');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_ACTION', 'Folge');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_WHO', 'Wer hat die &Uuml;bertretung gemeldet');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_2_CUSTOM_FIELDS', 'Bemerkungen');

/** teacher_manage_discipline_3.php */

DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_TITLE', 'An-/Abwesenheit des Sch&uuml;lers');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_INSERTED', 'Eintrag von ');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_SCHOOL', 'Schule');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_YEAR', 'Jahr');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_INFRACTION', '&Uuml;bertretung');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_DATE', 'Datum');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_START_DATE', 'Anfangsdatum');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_END_DATE', 'Ende-Datum');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_SELECT_CODE', 'Art ausw&auml;hlen');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_NOTES', 'Eintr&auml;ge');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_NOTIFY', 'Kontakt benachrichtigen');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_DELETE', 'L&ouml;schen');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_NEW', 'Neu');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_ADD', 'Hinzuf&uuml;gen');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_EDIT', 'Eintrag editieren');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_UPDATE', 'Eintrag aktualisieren');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_SELECT', 'Eintrag ausw&auml;hlen');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_ACTION', 'Folge');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_3_WHO', 'Wer hat die &Uuml;bertretung gemeldet');

/** teacher_manage_discipline_4.php */

DEFINE('_TEACHER_MANAGE_DISCIPLINE_4_ENTER_CODE', 'Bitte eine &Uuml;bertretung ausw&auml;hlen.');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_4_ENTER_DATE', 'Bitte das Datum ausw&auml;hlen.');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_4_ENTER_START', 'Bitte Anfangsdatum ausw&auml;hlen.');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_4_ENTER_END', 'Bitte Ende-Datum ausw&auml;hlen.');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_4_ENTER_ACTION', 'Bitte die Folgen angeben.');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_4_ENTER_WHO', 'Bitte angeben, wer die Meldung gemacht hat.');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_4_SUBJECT', 'Neuer Verhaltens-Eintrag fuer ');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_4_BODY1', 'Ein neuer Verhaltens-Eintrag wurde hinzugefuegt: fuer ');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_4_BODY2', 'Bitte loggen Sie auf der Home Page ein.Danke - Der Direktor');
DEFINE('_TEACHER_MANAGE_DISCIPLINE_4_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');

/** teacher_manage_grades_1.php */

DEFINE('_TEACHER_MANAGE_GRADES_1_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_TEACHER_MANAGE_GRADES_1_QUARTER', 'Semester');
DEFINE('_TEACHER_MANAGE_GRADES_1_GRADE', 'Note');
DEFINE('_TEACHER_MANAGE_GRADES_1_EFFORT', 'Mitarbeit');
DEFINE('_TEACHER_MANAGE_GRADES_1_CONDUCT', 'Verhalten');
DEFINE('_TEACHER_MANAGE_GRADES_1_SUBJECT', 'Fach');
DEFINE('_TEACHER_MANAGE_GRADES_1_DETAILS', 'Details');
DEFINE('_TEACHER_MANAGE_GRADES_1_TITLE', 'Sch&uuml;lernoten');
DEFINE('_TEACHER_MANAGE_GRADES_1_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_TEACHER_MANAGE_GRADES_1_ADD', 'Note hinzuf&uuml;gen');

/** teacher_manage_grades_2.php */

DEFINE('_TEACHER_MANAGE_GRADES_2_TITLE', 'Sch&uuml;lernoten');
DEFINE('_TEACHER_MANAGE_GRADES_2_INSERTED', 'Eintrag von ');
DEFINE('_TEACHER_MANAGE_GRADES_2_FOR', 'f&uuml;r');
DEFINE('_TEACHER_MANAGE_GRADES_2_SCHOOL', 'Schule');
DEFINE('_TEACHER_MANAGE_GRADES_2_YEAR', 'Jahr');
DEFINE('_TEACHER_MANAGE_GRADES_2_TERM', 'Zeitraum');
DEFINE('_TEACHER_MANAGE_GRADES_2_GRADE', 'Note');
DEFINE('_TEACHER_MANAGE_GRADES_2_EFFORT', 'Mitarbeit');
DEFINE('_TEACHER_MANAGE_GRADES_2_CONDUCT', 'Verhalten');
DEFINE('_TEACHER_MANAGE_GRADES_2_DETAILS', 'Details');
DEFINE('_TEACHER_MANAGE_GRADES_2_COMMENTS', 'Kommentare');
DEFINE('_TEACHER_MANAGE_GRADES_2_NOTES', 'Eintr&auml;ge');
DEFINE('_TEACHER_MANAGE_GRADES_2_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_TEACHER_MANAGE_GRADES_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_TEACHER_MANAGE_GRADES_2_EDIT', 'Eintrag editieren');

/** teacher_manage_grades_3.php */

DEFINE('_TEACHER_MANAGE_GRADES_3_TITLE', 'Sch&uuml;lernoten');
DEFINE('_TEACHER_MANAGE_GRADES_3_INSERTED', 'Eintrag von ');
DEFINE('_TEACHER_MANAGE_GRADES_3_YEAR', 'Jahr');
DEFINE('_TEACHER_MANAGE_GRADES_3_SUBJECT', 'Fach');
DEFINE('_TEACHER_MANAGE_GRADES_3_TERM', 'Zeitraum');
DEFINE('_TEACHER_MANAGE_GRADES_3_OVERALL', 'Gesamtnote');
DEFINE('_TEACHER_MANAGE_GRADES_3_EFFORT', 'Mitarbeit');
DEFINE('_TEACHER_MANAGE_GRADES_3_CONDUCT', 'Verhalten');
DEFINE('_TEACHER_MANAGE_GRADES_3_COMMENTS', 'Kommentare');
DEFINE('_TEACHER_MANAGE_GRADES_3_NOTES', 'Eintr&auml;ge');
DEFINE('_TEACHER_MANAGE_GRADES_3_NOTIFY', 'Kontakt benachrichtigen');
DEFINE('_TEACHER_MANAGE_GRADES_3_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_TEACHER_MANAGE_GRADES_3_DELETE', 'L&ouml;schen');
DEFINE('_TEACHER_MANAGE_GRADES_3_NEW', 'Neu');
DEFINE('_TEACHER_MANAGE_GRADES_3_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_TEACHER_MANAGE_GRADES_3_UPDATE', 'Eintrag aktualisieren');
DEFINE('_TEACHER_MANAGE_GRADES_3_ADD', 'Neuer Eintrag');

/** teacher_manage_grades_4.php */

DEFINE('_TEACHER_MANAGE_GRADES_4_ENTER_TERM', 'Bitte einen Zeitraum ausw&auml;hlen.');
DEFINE('_TEACHER_MANAGE_GRADES_4_ENTER_GRADE', 'Bitte eine Gesamtnote angeben');
DEFINE('_TEACHER_MANAGE_GRADES_4_ENTER_EFFORT', 'Bitte Mitarbeit eintragen.');
DEFINE('_TEACHER_MANAGE_GRADES_4_ENTER_CONDUCT', 'Bitte Verhalten eintragen.');
DEFINE('_TEACHER_MANAGE_GRADES_4_SUBJECT', 'Neuer Noten-Eintrag fuer ');
DEFINE('_TEACHER_MANAGE_GRADES_4_BODY1', 'Ein neuer Noten-Eintrag wurde hinzugefuegt: fuer ');
DEFINE('_TEACHER_MANAGE_GRADES_4_BODY2', 'Bitte loggen Sie auf der Home Page ein.Danke - Der Direktor');
DEFINE('_TEACHER_MANAGE_GRADES_4_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');
DEFINE('_TEACHER_MANAGE_GRADES_4_GRADE_NOTE', 'Note');

/** teacher_menu_forum.inc.php */

DEFINE('_TEACHER_MENU_FORUM_INC_PHP_TITLE', 'Zur&uuml;ck zum Hauptmen&uuml;');
DEFINE('_TEACHER_MENU_FORUM_INC_PHP_TITLE_TEXT', 'Hauptmen&uuml;');

/** teacher_menu.inc.php */

DEFINE('_TEACHER_MENU_INC_PHP_MAIN', 'Zur&uuml;ck zum Hauptmen&uuml;');
DEFINE('_TEACHER_MENU_INC_PHP_MAIN_TEXT', 'Hauptmen&uuml;');
DEFINE('_TEACHER_MENU_INC_PHP_TIMETABLE', 'Stundenplan anschauen');
DEFINE('_TEACHER_MENU_INC_PHP_TIMETABLE_TEXT', 'Stundenplan');
DEFINE('_TEACHER_MENU_INC_PHP_EXAMS', 'Pr&uuml;fungen verwalten');
DEFINE('_TEACHER_MENU_INC_PHP_EXAMS_TEXT', 'Pr&uuml;fungen');
DEFINE('_TEACHER_MENU_INC_PHP_STUDENTS', 'Sch&uuml;ler ausw&auml;hlen');
DEFINE('_TEACHER_MENU_INC_PHP_STUDENTS_TEXT', 'Sch&uuml;ler ausw&auml;hlen');
DEFINE('_TEACHER_MENU_INC_PHP_ATTENDANCE', 'An-/Abwesenheit eintragen');
DEFINE('_TEACHER_MENU_INC_PHP_ATTENDANCE_TEXT', 'An-/Abwesenheit');
DEFINE('_TEACHER_MENU_INC_PHP_DISCIPLINE', 'Verhalten verwalten');
DEFINE('_TEACHER_MENU_INC_PHP_DISCIPLINE_TEXT', 'Verhalten');
DEFINE('_TEACHER_MENU_INC_PHP_SINGLE', 'Noten eingeben');
DEFINE('_TEACHER_MENU_INC_PHP_SINGLE_TEXT', 'Noten');
DEFINE('_TEACHER_MENU_INC_PHP_BULK', 'Mehrere Noten gleichzeitig eingeben');
DEFINE('_TEACHER_MENU_INC_PHP_BULK_TEXT', 'Mehrere Noten');
DEFINE('_TEACHER_MENU_INC_PHP_YEAR', 'Jahreszahl &auml;ndern');
DEFINE('_TEACHER_MENU_INC_PHP_YEAR_TEXT', 'Jahreszahl &auml;ndern');
DEFINE('_TEACHER_MENU_INC_PHP_HOMEWORK', 'Haus&uuml;bungen aufgeben');
DEFINE('_TEACHER_MENU_INC_PHP_HOMEWORK_TEXT', 'Haus&uuml;bungen');
DEFINE('_TEACHER_MENU_INC_PHP_FORUM', 'Zur Diskussion');
DEFINE('_TEACHER_MENU_INC_PHP_FORUM_TEXT', 'Forum');
DEFINE('_TEACHER_MENU_INC_PHP_SPEAK', 'Sprechstunde verwalten');
DEFINE('_TEACHER_MENU_INC_PHP_SPEAK_TEXT', 'Sprechstunden');
DEFINE('_TEACHER_MENU_INC_PHP_CHANGE', 'Passwort &auml;ndern');
DEFINE('_TEACHER_MENU_INC_PHP_CHANGE_TEXT', 'Passwort &auml;ndern');
DEFINE('_TEACHER_MENU_INC_PHP_LOGOUT', 'Vom System abmelden');
DEFINE('_TEACHER_MENU_INC_PHP_LOGOUT_TEXT', 'Logout');
DEFINE('_TEACHER_MENU_INC_PHP_CURRENT_YEAR', 'Jahr');

/** teachers_menu.php */

DEFINE('_TEACHERS_MENU_TITLE', 'Lehrer Seite');
DEFINE('_TEACHERS_MENU_CHOOSE', 'Bitte w&auml;hlen Sie aus dem Men&uuml; auf der linken Seite');
DEFINE('_TEACHERS_MENU_BIRTHDAY', 'Diese Sch&uuml;ler haben heute Geburtstag:');
DEFINE('_TEACHERS_MENU_LASTNAME', 'Nachname');
DEFINE('_TEACHERS_MENU_FIRSTNAME', 'Vorname');
DEFINE('_TEACHERS_MENU_HOMEROOM', 'Klasse');
DEFINE('_TEACHERS_MENU_GENDER', 'Geschlecht');
DEFINE('_TEACHERS_MENU_DOB', 'Geburtstag');
DEFINE('_TEACHERS_MENU_AGE', 'Alter');

/** teacher_schedule_1.php */

DEFINE('_TEACHER_SCHEDULE_1_ERROR_FORM', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_TEACHER_SCHEDULE_1_DATE', 'Datum');
DEFINE('_TEACHER_SCHEDULE_1_CODE', 'Art');
DEFINE('_TEACHER_SCHEDULE_1_DETAILS', 'Details');
DEFINE('_TEACHER_SCHEDULE_1_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_TEACHER_SCHEDULE_1_TITLE', 'Lehrer Plan f&uuml;r');
DEFINE('_TEACHER_SCHEDULE_1_BACK', 'Zur&uuml;ck zum Lehrer');
DEFINE('_TEACHER_SCHEDULE_1_ADD', 'Neuer Eintrag');

/** teacher_schedule_2.php */

DEFINE('_TEACHER_SCHEDULE_2_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_TEACHER_SCHEDULE_2_TITLE', 'Lehrer Plan f&uuml;r');
DEFINE('_TEACHER_SCHEDULE_2_INSERTED', 'Eintrag von ');
DEFINE('_TEACHER_SCHEDULE_2_SCHOOL', 'Schule');
DEFINE('_TEACHER_SCHEDULE_2_YEAR', 'Jahr');
DEFINE('_TEACHER_SCHEDULE_2_CODE', 'Nummer');
DEFINE('_TEACHER_SCHEDULE_2_DATE', 'Datum');
DEFINE('_TEACHER_SCHEDULE_2_NOTES', 'Eintr&auml;ge');
DEFINE('_TEACHER_SCHEDULE_2_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');
DEFINE('_TEACHER_SCHEDULE_2_EDIT', 'Eintrag &auml;ndern');

/** teacher_schedule_3.php */

DEFINE('_TEACHER_SCHEDULE_3_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_TEACHER_SCHEDULE_3_TITLE', 'Lehrer Plan f&uuml;r');
DEFINE('_TEACHER_SCHEDULE_3_TERM', 'Zeitraum');
DEFINE('_TEACHER_SCHEDULE_3_CLASS_PERIOD', 'Stunde');
DEFINE('_TEACHER_SCHEDULE_3_CODE', 'Nummer');
DEFINE('_TEACHER_SCHEDULE_3_SUBJECT', 'Fach');
DEFINE('_TEACHER_SCHEDULE_3_SELECT', 'Nummer ausw&auml;hlen');
DEFINE('_TEACHER_SCHEDULE_3_NOTES', 'Eintr&auml;ge');
DEFINE('_TEACHER_SCHEDULE_3_BACK', 'Zur&uuml;ck zum Lehrer');
DEFINE('_TEACHER_SCHEDULE_3_UPDATE', 'Eintrag aktualisieren');
DEFINE('_TEACHER_SCHEDULE_3_ADD', 'Neuer Eintrag');

/** teachers_homework.php */

DEFINE('_TEACHERS_HOMEWORK_ENTER_NEW_NAME', 'Bitte einen Namen eingeben.');
DEFINE('_TEACHERS_HOMEWORK_ENTER_NEW_SUBJECT', 'Bitte einen Titel eingeben.');
DEFINE('_TEACHERS_HOMEWORK_ENTER_NEW_DATE', 'Bitte ein Datum eingeben.');
DEFINE('_TEACHERS_HOMEWORK_ENTER_NEW_DUE_DATE', 'Bitte ein Ende-Datum eingeben.');
DEFINE('_TEACHERS_HOMEWORK_ENTER_SUBJECT', 'Bitte einen Titel eingeben.');
DEFINE('_TEACHERS_HOMEWORK_ENTER_DATE', 'Bitte ein Datum eingeben.');
DEFINE('_TEACHERS_HOMEWORK_ENTER_DUE_DATE', 'Bitte ein Ende-Datum eingeben.');
DEFINE('_TEACHERS_HOMEWORK_DELETE', 'Sind Sie sicher, dass Sie fortfahren wollen?');
DEFINE('_TEACHERS_HOMEWORK_FILE_TITLE', 'Bitte den Titel der Datei angeben');
DEFINE('_TEACHERS_HOMEWORK_FILE_INVALID', 'Ungueltiger Dateiname');
DEFINE('_TEACHERS_HOMEWORK_DELETE_FILE', 'Sind Sie sicher, dass Sie die Datei loeschen wollen?');
DEFINE('_TEACHERS_HOMEWORK_TITLE', 'Haus&uuml;bungen');
DEFINE('_TEACHERS_HOMEWORK_NEW_TITLE', 'Neue Haus&uuml;bung');
DEFINE('_TEACHERS_HOMEWORK_NEW_NAME', 'Name');
DEFINE('_TEACHERS_HOMEWORK_NEW_SUBJECT', 'Fach');
DEFINE('_TEACHERS_HOMEWORK_NEW_ROOM', 'Klasse');
DEFINE('_TEACHERS_HOMEWORK_ASSIGNED_ON', 'Aufgegeben am');
DEFINE('_TEACHERS_HOMEWORK_DUE_ON', 'Fertig bis');
DEFINE('_TEACHERS_HOMEWORK_NOTES', 'Eintr&auml;ge');
DEFINE('_TEACHERS_HOMEWORK_ADD', 'Hinzuf&uuml;gen');
DEFINE('_TEACHERS_HOMEWORK_SUBJECT', 'Fach');
DEFINE('_TEACHERS_HOMEWORK_ROOM', 'Klasse');
DEFINE('_TEACHERS_HOMEWORK_DEL_ASSIGNMENT', 'Aufgabe l&ouml;schen');
DEFINE('_TEACHERS_HOMEWORK_UPD_ASSIGNMENT', 'Aufgabe &auml;ndern');
DEFINE('_TEACHERS_HOMEWORK_TITLE2', 'Dateien zur Haus&uuml;bung');
DEFINE('_TEACHERS_HOMEWORK_FILES_TITLE', 'Titel');
DEFINE('_TEACHERS_HOMEWORK_FILES_LOCATION', 'Speicherort');
DEFINE('_TEACHERS_HOMEWORK_FILES_ADD', 'Hinzuf&uuml;gen');
DEFINE('_TEACHERS_HOMEWORK_FILES_DELETE', 'L&ouml;schen');

/** teacher_student_1.php */

DEFINE('_TEACHER_STUDENT_1_TITLE', 'Sch&uuml;ler verwalten');
DEFINE('_TEACHER_STUDENT_1_SEARCH_DB', 'Datenbank durchsuchen');
DEFINE('_TEACHER_STUDENT_1_BY_ID', 'Nach interner Nummer');
DEFINE('_TEACHER_STUDENT_1_BY_NAME', 'Nach Name');
DEFINE('_TEACHER_STUDENT_1_SEARCH', 'Suchen');
DEFINE('_TEACHER_STUDENT_1_BY_OTHER', 'oder nach');
DEFINE('_TEACHER_STUDENT_1_BY_GRADE', 'nach Klasse');
DEFINE('_TEACHER_STUDENT_1_BY_GENDER', 'nach Geschlecht');
DEFINE('_TEACHER_STUDENT_1_BY_ETHNICITY', 'nach Zugeh&ouml;rigkeit');
DEFINE('_TEACHER_STUDENT_1_ACTIVE', 'Aktiv');
DEFINE('_TEACHER_STUDENT_1_HOMED', 'zu Hause');
DEFINE('_TEACHER_STUDENT_1_SPED', 'Spezialausbildung');
DEFINE('_TEACHER_STUDENT_1_BY_LAST', 'Oder nach Anfangsbuchstaben des Nachnamens anzeigen');

/** teacher_student_2.php */

DEFINE('_TEACHER_STUDENT_2_ERROR_ID', 'Kein Sch&uuml;ler gefunden mit interner Nummer ');
DEFINE('_TEACHER_STUDENT_2_ERROR_LAST', 'Kein Sch&uuml;ler gefunden mit Nachname ');
DEFINE('_TEACHER_STUDENT_2_SELECT', 'Ausw&auml;hlen');
DEFINE('_TEACHER_STUDENT_2_ERROR_CRITERIA', 'Kein Sch&uuml;ler mit diesen Kriterien gefunden.');
DEFINE('_TEACHER_STUDENT_2_TITLE', 'Suchergebnis Sch&uuml;ler');
DEFINE('_TEACHER_STUDENT_2_NEW', 'Neue Suche');

/** teacher_timetable.php */

DEFINE('_TEACHER_TIMETABLE_UPPER', 'Lehrer-Bereich');
DEFINE('_TEACHER_TIMETABLE_TITLE', 'Stundenplan');
DEFINE('_TEACHER_TIMETABLE_SCHOOL', 'Schule');
DEFINE('_TEACHER_TIMETABLE_TERM', 'Zeitraum');
DEFINE('_TEACHER_TIMETABLE_SUBJECT', 'Fach');
DEFINE('_TEACHER_TIMETABLE_DAYS', 'Tag');
DEFINE('_TEACHER_TIMETABLE_PERIOD', 'Stunde');
DEFINE('_TEACHER_TIMETABLE_ROOM', 'Klasse');

/** grade_student_1.php */

DEFINE('_GRADE_STUDENT_1_UPPER', 'Notenbereich');
DEFINE('_GRADE_STUDENT_1_TITLE', 'Neue Suche');
DEFINE('_GRADE_STUDENT_1_TITLE2', 'Sch&uuml;ler Liste erstellen');
DEFINE('_GRADE_STUDENT_1_CHOOSE', 'Bitte Schule, Fach, Semester und Klasse ausw&auml;hlen');
DEFINE('_GRADE_STUDENT_1_CHOOSE_SCHOOL', 'Bitte Schule ausw&auml;hlen');
DEFINE('_GRADE_STUDENT_1_CHOOSE_GRADE', 'Bitte Klasse ausw&auml;hlen');
DEFINE('_GRADE_STUDENT_1_CHOOSE_TERM', 'Bitte Semester ausw&auml;hlen');
DEFINE('_GRADE_STUDENT_1_CHOOSE_SUBJECT', 'Bitte Fach ausw&auml;hlen');
DEFINE('_GRADE_STUDENT_1_BUILD', 'Liste erstellen');

/** grade_student_2.php */

DEFINE('_GRADE_STUDENT_2_ENTER_TERM', 'Bitte das Semester angeben');
DEFINE('_GRADE_STUDENT_2_ENTER_SUBJECT', 'Bitte das Fach angeben');
DEFINE('_GRADE_STUDENT_2_TEACHER_AREA', 'Lehrer Bereich');
DEFINE('_GRADE_STUDENT_2_SELECT', 'ausw&auml;hlen');
DEFINE('_GRADE_STUDENT_2_FORM_ERROR', 'Kein Sch&uuml;ler mit diesen Kriterien gefunden.');
DEFINE('_GRADE_STUDENT_2_TITLE', 'Suchergebnis f&uuml;r mehrere Noten');
DEFINE('_GRADE_STUDENT_2_NEW', 'Neue Suche');

/** grade_student_3.php */

DEFINE('_GRADE_STUDENT_3_TITLE', 'Noten f&uuml;r Sch&uuml;ler');
DEFINE('_GRADE_STUDENT_3_TITLE2', 'Noten f&uuml;r Semester');
DEFINE('_GRADE_STUDENT_3_SCHOOL', 'Schule');
DEFINE('_GRADE_STUDENT_3_YEAR', 'Jahr');
DEFINE('_GRADE_STUDENT_3_SUBJECT', 'Fach');
DEFINE('_GRADE_STUDENT_3_OVERALL', 'Gesamtnote');
DEFINE('_GRADE_STUDENT_3_EFFORT', 'Mitarbeit');
DEFINE('_GRADE_STUDENT_3_CONDUCT', 'Verhalten');
DEFINE('_GRADE_STUDENT_3_COMMENTS', 'Kommentare');
DEFINE('_GRADE_STUDENT_3_NOTES', 'Eintr&auml;ge');
DEFINE('_GRADE_STUDENT_3_NOTIFY', 'Kontakte benachrichtigen');
DEFINE('_GRADE_STUDENT_3_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');
DEFINE('_GRADE_STUDENT_3_UPDATE', 'Eintrag aktualisieren');
DEFINE('_GRADE_STUDENT_3_ADD', 'Neuer Eintrag');

/** grade_student_4.php */

DEFINE('_GRADE_STUDENT_4_ENTER_QUARTER', 'Bitte das Semester ausw&auml;hlen.');
DEFINE('_GRADE_STUDENT_4_ENTER_OVERALL', 'Bitte Gesamtnote eingeben.');
DEFINE('_GRADE_STUDENT_4_ENTER_EFFORT', 'Bitte Mitarbeit ausw&auml;hlen.');
DEFINE('_GRADE_STUDENT_4_ENTER_CONDUCT', 'Bitte Verhalten ausw&auml;hlen.');
DEFINE('_GRADE_STUDENT_4_FORMERROR', 'Fehler. Bitte das Fenster schliessen und noch einmal versuchen.');
DEFINE('_GRADE_STUDENT_4_SUBJECT', 'Neuer Noten-Eintrag fuer ');
DEFINE('_GRADE_STUDENT_4_BODY1', 'Ein neuer Noten-Eintrag wurde hinzugefuegt: fuer ');
DEFINE('_GRADE_STUDENT_4_BODY2', 'Bitte loggen Sie auf der Home Page ein.Danke - Der Direktor');
DEFINE('_GRADE_STUDENT_4_TITLE', 'Noten Eintrag');
DEFINE('_GRADE_STUDENT_4_CONTINUE', 'Klicken Sie hier, um mit anderen Sch&uuml;lern weiter zu machen');

/** showmessage.php */

DEFINE('_SHOWMESSAGE_UPPER', 'Forum');

/** search.php */

DEFINE('_SEARCH_UPPER', 'Forum');

/** schedule_teacher_1.php */

DEFINE('_SCHEDULE_TEACHER_1_ENTER_VALUE', 'Bitte einen Wert eingeben!');
DEFINE('_SCHEDULE_TEACHER_1_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_SCHEDULE_TEACHER_1_TITLE', 'Lehrer Stundenplan eingeben');
DEFINE('_SCHEDULE_TEACHER_1_TITLE2', 'Lehrer ausw&auml;hlen');
DEFINE('_SCHEDULE_TEACHER_1_BY_SCHOOL', 'Nach Schule');
DEFINE('_SCHEDULE_TEACHER_1_BY_LAST', 'Nach Nachname');
DEFINE('_SCHEDULE_TEACHER_1_ALL', 'Alle Schulen');
DEFINE('_SCHEDULE_TEACHER_1_SEARCH', 'Suchen');
DEFINE('_SCHEDULE_TEACHER_1_SEARCH_LAST', 'Oder nach Anfangsbuchstaben des Nachnamens anzeigen');

/** schedule_teacher_2.php */

DEFINE('_SCHEDULE_TEACHER_2_REMOVE', 'L&ouml;schen');
DEFINE('_SCHEDULE_TEACHER_2_NO_TEACHERS', 'Keine Lehrer gefunden f&uuml;r ');
DEFINE('_SCHEDULE_TEACHER_2_NO_FOUND', 'Keine Lehrer gefunden.');
DEFINE('_SCHEDULE_TEACHER_2_SELECT', 'Ausw&auml;hlen');
DEFINE('_SCHEDULE_TEACHER_2_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_SCHEDULE_TEACHER_2_TITLE', 'Suchergebnis Lehrer');
DEFINE('_SCHEDULE_TEACHER_2_NEW', 'Neue Suche');

/** schedule_teacher_3.php */

DEFINE('_SCHEDULE_TEACHER_3_ENTER_VALUE', 'Bitte einen Wert eingeben!');
DEFINE('_SCHEDULE_TEACHER_3_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_SCHEDULE_TEACHER_3_TITLE', 'Titel');
DEFINE('_SCHEDULE_TEACHER_3_FIRST', 'Vorname');
DEFINE('_SCHEDULE_TEACHER_3_LAST', 'Nachname');
DEFINE('_SCHEDULE_TEACHER_3_MI', '2. Initiale');
DEFINE('_SCHEDULE_TEACHER_3_SUBJECTS', 'F&auml;cher');
DEFINE('_SCHEDULE_TEACHER_3_EMAIL', 'Email');
DEFINE('_SCHEDULE_TEACHER_3_ACCESS', 'Zugang Gesundheit');
DEFINE('_SCHEDULE_TEACHER_3_USERNAME', 'Benutzername');
DEFINE('_SCHEDULE_TEACHER_3_PASSWORD', 'Passwort');

/** report_attendance.php */

DEFINE('_REPORT_ATTENDANCE_BROWSER_TITLE', 'Berichte: Sch&uuml;ler');
DEFINE('_REPORT_ATTENDANCE_TITLE', 'An-/Abwesenheits-Bericht ');
DEFINE('_REPORT_ATTENDANCE_ROUTE', 'Verkehrsmittel');
DEFINE('_REPORT_ATTENDANCE_HOME', 'Klassenzimmer ');
DEFINE('_REPORT_ATTENDANCE_NOTES', 'Eintr&auml;ge');
DEFINE('_REPORT_ATTENDANCE_SCHOOL', 'Schule');
DEFINE('_REPORT_ATTENDANCE_INTERNAL', 'Interne Nummer');
DEFINE('_REPORT_ATTENDANCE_DOB', 'Geburtstag');
DEFINE('_REPORT_ATTENDANCE_NONE', 'Keine passenden Eintr&auml;ge');
DEFINE('_REPORT_ATTENDANCE_GRADE', 'Klasse');
DEFINE('_REPORT_ATTENDANCE_ETHNICITY', 'Nationalit&auml;t');

/** report_discipline.php */

DEFINE('_REPORT_DISCIPLINE_BROWSER_TITLE', 'Berichte: Sch&uuml;ler');
DEFINE('_REPORT_DISCIPLINE_TITLE', 'Verhaltens-Bericht f&uuml;r ');
DEFINE('_REPORT_DISCIPLINE_ROUTE', 'Verkehrsmittel');
DEFINE('_REPORT_DISCIPLINE_HOME', 'Klassenzimmer ');
DEFINE('_REPORT_DISCIPLINE_NOTES', 'Eintr&auml;ge');
DEFINE('_REPORT_DISCIPLINE_SCHOOL', 'Schule');
DEFINE('_REPORT_DISCIPLINE_INTERNAL', 'Interne Nummer');
DEFINE('_REPORT_DISCIPLINE_ACTION', 'Konsequenz');
DEFINE('_REPORT_DISCIPLINE_DOB', 'Geburtstag');
DEFINE('_REPORT_DISCIPLINE_NONE', 'Keine passenden Eintr&auml;ge');
DEFINE('_REPORT_DISCIPLINE_GRADE', 'Klasse');
DEFINE('_REPORT_DISCIPLINE_ETHNICITY', 'Nationalit&auml;t');

/** report_grades.php */

DEFINE('_REPORT_GRADES_VALUE', ' ist der Wert');
DEFINE('_REPORT_GRADES_VALUE2', 'Ihr Wert ist ');
DEFINE('_REPORT_GRADES_NONE', 'Keine passenden Eintr&auml;ge');

/** report_grades_2.php */

DEFINE('_REPORT_GRADES_2_HEADER', 'Bericht aktive Sch&uuml;ler');
DEFINE('_REPORT_GRADES_2_HEADER_SUBJECT', 'Fach');
DEFINE('_REPORT_GRADES_2_HEADER_QUARTER', 'Zeitraum');
DEFINE('_REPORT_GRADES_2_HEADER_GRADE', 'Note');
DEFINE('_REPORT_GRADES_2_HEADER_EFFORT', 'Mitarbeit');
DEFINE('_REPORT_GRADES_2_HEADER_CONDUCT', 'Verhalten');
DEFINE('_REPORT_GRADES_2_NONE', 'Keine passenden Eintr&auml;ge');

/** report_student.php */

DEFINE('_REPORT_STUDENT_BROWSER_TITLE', 'Berichte: Sch&uuml;ler');
DEFINE('_REPORT_STUDENT_HEADER', 'Bericht aktive Sch&uuml;ler');
DEFINE('_REPORT_STUDENT_ROUTE', 'Verkehrsmittel');
DEFINE('_REPORT_STUDENT_HOME', 'Klassenzimmer ');
DEFINE('_REPORT_STUDENT_INTERNAL', 'Interne Nummer');
DEFINE('_REPORT_STUDENT_DOB', 'Geburtstag');
DEFINE('_REPORT_STUDENT_SCHOOL', 'Schule');
DEFINE('_REPORT_STUDENT_GRADE', 'Klasse');
DEFINE('_REPORT_STUDENT_ETHNICITY', 'Zugeh&ouml;rigkeit');
DEFINE('_REPORT_STUDENT_NONE', 'Keine passenden Eintr&auml;ge');

/** reply.php */

DEFINE('_REPLY_UPPER', 'Forum');

/** post.php */

DEFINE('_POST_UPPER', 'Forum');

/** phpunit.php */

DEFINE('_PHPUNIT_FAIL', 'Fehler');
DEFINE('_PHPUNIT_OK', 'OK');

/** phpforum.php */

DEFINE('_PHPFORUM_MISSING_GET', 'GET Argument fehlen in dem URL');
DEFINE('_PHPFORUM_INVALID_FORUM', 'Ung&uuml;ltiges Forum ausgew&auml;hlt');
DEFINE('_PHPFORUM_FORUM_EMPTY', 'Forum leer');
DEFINE('_PHPFORUM_INVALID_POS', 'Ung&uuml;ltiger Position Identifier');

/** pdfclass.php */

DEFINE('_PDFCLASS_INTERNAL', 'Interne Nummer');
DEFINE('_PDFCLASS_NAME', 'Name');
DEFINE('_PDFCLASS_DOB', 'Geburtstag');
DEFINE('_PDFCLASS_SCHOOL', 'Schule');
DEFINE('_PDFCLASS_GRADE', 'Klasse');
DEFINE('_PDFCLASS_HOME', 'Klassenzimmer');
DEFINE('_PDFCLASS_ETHNICITY', 'Nationalitaet');
DEFINE('_PDFCLASS_SEX', 'Geschlecht');
DEFINE('_PDFCLASS_ROUTE', 'Verkehrsmittel');

/** nurse_info_1.php */

DEFINE('_NURSE_INFO_1_TITLE', 'Sch&uuml;ler verwalten');
DEFINE('_NURSE_INFO_1_SEARCH_DB', 'Datenbank durchsuchen');
DEFINE('_NURSE_INFO_1_BY_INTERNAL', 'Nach interner Nummer');
DEFINE('_NURSE_INFO_1_BY_LAST', 'Nach Nachname');
DEFINE('_NURSE_INFO_1_SEARCH', 'Suchen');
DEFINE('_NURSE_INFO_1_OR_BY', 'oder nach');
DEFINE('_NURSE_INFO_1_BY_GRADE', 'Nach Klasse');
DEFINE('_NURSE_INFO_1_BY_GENDER', 'nach Geschlecht');
DEFINE('_NURSE_INFO_1_BY_ETHNICITY', 'nach Nationalit&auml;t');
DEFINE('_NURSE_INFO_1_ACTIVE', 'Aktiv');
DEFINE('_NURSE_INFO_1_HOMED', 'zu Hause');
DEFINE('_NURSE_INFO_1_SPED', 'Spezialausbildung');
DEFINE('_NURSE_INFO_1_SEARCH_LAST', 'Oder nach Anfangsbuchstaben des Nachnamens anzeigen');

/** nurse_info_2.php */

DEFINE('_NURSE_INFO_2_ERROR_ID', 'Kein Sch&uuml;ler gefunden mit interner Nummer ');
DEFINE('_NURSE_INFO_2_ERROR_LAST', 'Kein Sch&uuml;ler gefunden mit Nachname ');
DEFINE('_NURSE_INFO_2_SELECT', 'Ausw&auml;hlen');
DEFINE('_NURSE_INFO_2_ERROR_CRITERIA', 'Kein Sch&uuml;ler mit dieser Auswahl gefunden.');
DEFINE('_NURSE_INFO_2_TITLE', 'Suchergebnis Sch&uuml;ler');
DEFINE('_NURSE_INFO_2_NEW', 'Neue Suche');

/** nurse_info_3.php */

DEFINE('_NURSE_INFO_3_UPPER', 'Gesundheits-Bereich');
DEFINE('_NURSE_INFO_3_TITLE', 'Zusammenfassung Gesundheit Sch&uuml;ler');
DEFINE('_NURSE_INFO_3_DOB', 'Geburtstag');
DEFINE('_NURSE_INFO_3_SCHOOL', 'Schule');
DEFINE('_NURSE_INFO_3_GRADE', 'Klasse');
DEFINE('_NURSE_INFO_3_HOME', 'Klassenzimmer');
DEFINE('_NURSE_INFO_3_TEACHER', 'Klassenvorstand');
DEFINE('_NURSE_INFO_3_ROUTE', 'Verkehrsmittel');
DEFINE('_NURSE_INFO_3_PRIMARY', 'Kontaktperson');
DEFINE('_NURSE_INFO_3_RESIDENCE', 'Wohnort');
DEFINE('_NURSE_INFO_3_ADDRESS', 'Adresse');
DEFINE('_NURSE_INFO_3_CITY', 'Stadt');
DEFINE('_NURSE_INFO_3_STATE', 'Bundesland');
DEFINE('_NURSE_INFO_3_ZIP', 'PLZ');
DEFINE('_NURSE_INFO_3_PHONE1', 'Telefon 1');
DEFINE('_NURSE_INFO_3_PHONE2', 'Telefon 2');
DEFINE('_NURSE_INFO_3_PHONE3', 'Telefon 3');
DEFINE('_NURSE_INFO_3_MED_INFO', 'Medizinische Information &uuml;ber den Sch&uuml;ler');
DEFINE('_NURSE_INFO_3_DATE', 'Datum');
DEFINE('_NURSE_INFO_3_MEDICATION', 'Medikament');
DEFINE('_NURSE_INFO_3_CODE', 'Art');
DEFINE('_NURSE_INFO_3_DETAILS', 'Details');
DEFINE('_NURSE_INFO_3_ALL_INFO', 'Information &uuml;ber Allergien des Sch&uuml;lers');
DEFINE('_NURSE_INFO_3_ALLERGY', 'Allergie');
DEFINE('_NURSE_INFO_3_IMM_INFO', 'Impfungen des Sch&uuml;lers');
DEFINE('_NURSE_INFO_3_IMM', 'Impfung');
DEFINE('_NURSE_INFO_3_HEALTH_INFO', 'Arztbesuche / Krankenabteilung');
DEFINE('_NURSE_INFO_3_HEALTH', 'Arztbesuch');

/** nurse_student_1.php */

DEFINE('_NURSE_STUDENT_1_ENTER_VALUE', 'Bitte einen Wert eingeben!');
DEFINE('_NURSE_STUDENT_1_TITLE', 'Sch&uuml;ler verwalten');
DEFINE('_NURSE_STUDENT_1_SEARCH_DB', 'Datenbank durchsuchen');
DEFINE('_NURSE_STUDENT_1_BY_INTERNAL', 'Nach interner Nummer');
DEFINE('_NURSE_STUDENT_1_BY_LAST', 'Nach Nachname');
DEFINE('_NURSE_STUDENT_1_SEARCH', 'Suchen');
DEFINE('_NURSE_STUDENT_1_OR_BY', 'oder nach');
DEFINE('_NURSE_STUDENT_1_BY_GRADE', 'Nach Klasse');
DEFINE('_NURSE_STUDENT_1_BY_GENDER', 'nach Geschlecht');
DEFINE('_NURSE_STUDENT_1_BY_ETHNICITY', 'nach Nationalit&auml;t');
DEFINE('_NURSE_STUDENT_1_ACTIVE', 'Aktiv');
DEFINE('_NURSE_STUDENT_1_HOMED', 'zu Hause');
DEFINE('_NURSE_STUDENT_1_SPED', 'Spezialausbildung');
DEFINE('_NURSE_STUDENT_1_SEARCH_LAST', 'Oder nach Anfangsbuchstaben des Nachnamens anzeigen');

/** nurse_student_2.php */

DEFINE('_NURSE_STUDENT_2_ERROR_ID', 'Kein Sch&uuml;ler gefunden mit interner Nummer ');
DEFINE('_NURSE_STUDENT_2_ERROR_LAST', 'Kein Sch&uuml;ler gefunden mit Nachname ');
DEFINE('_NURSE_STUDENT_2_SELECT', 'Ausw&auml;hlen');
DEFINE('_NURSE_STUDENT_2_ERROR_CRITERIA', 'Kein Sch&uuml;ler mit dieser Auswahl gefunden.');
DEFINE('_NURSE_STUDENT_2_TITLE', 'Suchergebnis Sch&uuml;ler');
DEFINE('_NURSE_STUDENT_2_NEW', 'Neue Suche');

/** makereport.php */

// DEFINE("_MAKE_REPORT_THING", "Bericht ueber Verhalten von $start_db_date bis $end_db_date");
DEFINE('_MAKE_REPORT_NAME', 'Name');
DEFINE('_MAKE_REPORT_INFRACTION', 'Uebertretung');
DEFINE('_MAKE_REPORT_DATE', 'Datum');
DEFINE('_MAKE_REPORT_REPORTER', 'Meldung');
DEFINE('_MAKE_REPORT_ACTION', 'Konsequenzen');
DEFINE('_MAKE_REPORT_NOTES', 'Bemerkungen');
DEFINE('_MAKE_REPORT_SEX', 'Geschlecht');
DEFINE('_MAKE_REPORT_SCHOOL', 'Schule');
DEFINE('_MAKE_REPORT_REASON', 'Grund');

/** health_menu.php */

DEFINE('_HEALTH_MENU_TITLE', 'Hauptmen&uuml; Gesundheitswesen');
DEFINE('_HEALTH_MENU_SUBTITLE', 'Bitte w&auml;hlen Sie aus dem Men&uuml; auf der linken Seite');

/** health_menu.inc.php */

DEFINE('_HEALTH_MENU_INC_TITLE', 'Zur&uuml;ck zum Hauptmen&uuml;');
DEFINE('_HEALTH_MENU_INC_TEXT', 'Hauptmen&uuml;');
DEFINE('_HEALTH_MENU_INC_SUMMARY', '&Uuml;bersicht Sch&uuml;ler');
DEFINE('_HEALTH_MENU_INC_SUMMARY_TEXT', 'Sch&uuml;ler ausw&auml;hlen');
DEFINE('_HEALTH_MENU_INC_VISITS', 'Arztbesuche verwalten');
DEFINE('_HEALTH_MENU_INC_VISITS_TEXT', 'Arztbesuche');
DEFINE('_HEALTH_MENU_INC_MED', 'Medikamente');
DEFINE('_HEALTH_MENU_INC_MED_TEXT', 'Medikamente');
DEFINE('_HEALTH_MENU_INC_IMM', 'Impfungen');
DEFINE('_HEALTH_MENU_INC_IMM_TEXT', 'Impfungen');
DEFINE('_HEALTH_MENU_INC_ALL', 'Allergien');
DEFINE('_HEALTH_MENU_INC_ALL_TEXT', 'Allergien');
DEFINE('_HEALTH_MENU_INC_CHANGE', 'Jahr &auml;ndern');
DEFINE('_HEALTH_MENU_INC_CHANGE_TEXT', 'Jahr &auml;ndern');
DEFINE('_HEALTH_MENU_INC_FORUM', 'Zur Diskussion');
DEFINE('_HEALTH_MENU_INC_FORUM_TEXT', 'Forum');
DEFINE('_HEALTH_MENU_INC_EDIT_HEALTH', 'Krankenheiten &auml;ndern');
DEFINE('_HEALTH_MENU_INC_EDIT_HEALTH_TEXT', 'Krankheiten');
DEFINE('_HEALTH_MENU_INC_EDIT_IMM', 'Impfungen &auml;ndern');
DEFINE('_HEALTH_MENU_INC_EDIT_IMM_TEXT', 'Impfungen');
DEFINE('_HEALTH_MENU_INC_EDIT_MED', 'Medikamente &auml;ndern');
DEFINE('_HEALTH_MENU_INC_EDIT_MED_TEXT', 'Medikamente');
DEFINE('_HEALTH_MENU_INC_EDIT_ALL', 'Alergien &auml;ndern');
DEFINE('_HEALTH_MENU_INC_EDIT_ALL_TEXT', 'Allergien');
DEFINE('_HEALTH_MENU_INC_PASSWORD', 'Passwort &auml;ndern');
DEFINE('_HEALTH_MENU_INC_PASSWORD_TEXT', 'Passwort &auml;ndern');
DEFINE('_HEALTH_MENU_INC_LOGOUT', 'Vom System abmelden');
DEFINE('_HEALTH_MENU_INC_LOGOUT_TEXT', 'Logout');
DEFINE('_HEALTH_MENU_INC_ADMIN_AREA', 'Zur&uuml;ck zum Administrator Bereich');
DEFINE('_HEALTH_MENU_INC_ADMIN_AREA_TEXT', 'Admin Bereich');
DEFINE('_HEALTH_MENU_INC_YEAR', 'Jahr');

/** health_menu_forum.inc.php */
/** verwendet die selben Konstanten wie health_menu.inc.php */

/** health_med_student_1.php */

DEFINE('_HEALTH_MED_STUDENT_1_ERROR_FORM', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_HEALTH_MED_STUDENT_1_DATE', 'Datum');
DEFINE('_HEALTH_MED_STUDENT_1_MEDICATION', 'Medikament');
DEFINE('_HEALTH_MED_STUDENT_1_DETAILS', 'Details');
DEFINE('_HEALTH_MED_STUDENT_1_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_MED_STUDENT_1_TITLE', 'Medizin der Sch&uuml;ler');
DEFINE('_HEALTH_MED_STUDENT_1_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_MED_STUDENT_1_ADD', 'Neuer Eintrag');

/** health_med_student_2.php */

DEFINE('_HEALTH_MED_STUDENT_2_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_MED_STUDENT_2_TITLE', 'Medikamente der Sch&uuml;ler');
DEFINE('_HEALTH_MED_STUDENT_2_INSERTED', 'Eintrag von ');
DEFINE('_HEALTH_MED_STUDENT_2_SCHOOL', 'Schule');
DEFINE('_HEALTH_MED_STUDENT_2_YEAR', 'Jahr');
DEFINE('_HEALTH_MED_STUDENT_2_MED', 'Medikament');
DEFINE('_HEALTH_MED_STUDENT_2_DATE', 'Datum');
DEFINE('_HEALTH_MED_STUDENT_2_REASON', 'Grund');
DEFINE('_HEALTH_MED_STUDENT_2_NOTES', 'Eintr&auml;ge');
DEFINE('_HEALTH_MED_STUDENT_2_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_HEALTH_MED_STUDENT_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_MED_STUDENT_2_EDIT', 'Eintrag &auml;ndern');

/** health_med_student_3.php */

DEFINE('_HEALTH_MED_STUDENT_3_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_MED_STUDENT_3_TITLE', 'Medikamente der Sch&uuml;ler');
DEFINE('_HEALTH_MED_STUDENT_3_INSERTED', 'Eintrag von ');
DEFINE('_HEALTH_MED_STUDENT_3_SCHOOL', 'Schule');
DEFINE('_HEALTH_MED_STUDENT_3_YEAR', 'Jahr');
DEFINE('_HEALTH_MED_STUDENT_3_MED', 'Medikament');
DEFINE('_HEALTH_MED_STUDENT_3_DATE', 'Datum');
DEFINE('_HEALTH_MED_STUDENT_3_REASON', 'Grund');
DEFINE('_HEALTH_MED_STUDENT_3_NOTES', 'Eintr&auml;ge');
DEFINE('_HEALTH_MED_STUDENT_3_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_MED_STUDENT_3_UPDATE_NOTE', 'Eintrag aktualisieren');
DEFINE('_HEALTH_MED_STUDENT_3_ADD_NOTE', 'Neuer Eintrag');

/** health_med_student_4.php */

DEFINE('_HEALTH_MED_STUDENT_4_ENTER_MED', 'Bitte Medikament ausw&auml;hlen.');
DEFINE('_HEALTH_MED_STUDENT_4_ENTER_REASON', 'Bitte einen Grund angeben.');
DEFINE('_HEALTH_MED_STUDENT_4_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_MED_STUDENT_4_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');

/** health_medicine.php */

DEFINE('_HEALTH_MEDICINE_NOT_REMOVED', 'Kann nicht gel&ouml;scht werden, wird im System verwendet.');
DEFINE('_HEALTH_MEDICINE_DUP', 'Ist schon in Verwendung, doppelte Eintr&auml;ge sind nicht erlaubt.');
DEFINE('_HEALTH_MEDICINE_EDIT', '&Auml;ndern');
DEFINE('_HEALTH_MEDICINE_REMOVE', 'L&ouml;schen');
DEFINE('_HEALTH_MEDICINE_SURE', 'Sind Sie sicher?');
DEFINE('_HEALTH_MEDICINE_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_MEDICINE_TITLE', 'Medikamente verwalten');
DEFINE('_HEALTH_MEDICINE_ADD_MED', 'Neues Medikament hinzuf&uuml;gen');
DEFINE('_HEALTH_MEDICINE_ADD', 'Hinzuf&uuml;gen');
DEFINE('_HEALTH_MEDICINE_UPDATE_MED', 'Medikament &auml;ndern');
DEFINE('_HEALTH_MEDICINE_UPDATE', '&Auml;ndern');

/** health_manage_1.php */

DEFINE('_HEALTH_MANAGE_1_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_HEALTH_MANAGE_1_DATE', 'Datum');
DEFINE('_HEALTH_MANAGE_1_CODE', 'Art');
DEFINE('_HEALTH_MANAGE_1_DETAILS', 'Details');
DEFINE('_HEALTH_MANAGE_1_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_MANAGE_1_TITLE', 'Daten zur Gesundheit des Sch&uuml;lers');
DEFINE('_HEALTH_MANAGE_1_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_MANAGE_1_ADD', 'Neuer Eintrag');

/** health_manage_2.php */

DEFINE('_HEALTH_MANAGE_2_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_MANAGE_2_TITLE', 'Daten zur Gesundheit des Sch&uuml;lers');
DEFINE('_HEALTH_MANAGE_2_INSERTED', 'Eintrag von ');
DEFINE('_HEALTH_MANAGE_2_SCHOOL', 'Schule');
DEFINE('_HEALTH_MANAGE_2_YEAR', 'Jahr');
DEFINE('_HEALTH_MANAGE_2_INCIDENT', 'Sache');
DEFINE('_HEALTH_MANAGE_2_DATE', 'Datum');
DEFINE('_HEALTH_MANAGE_2_ACTION', 'Konsequenzen');
DEFINE('_HEALTH_MANAGE_2_WHO', 'Wer hat den Sch&uuml;ler geschickt');
DEFINE('_HEALTH_MANAGE_2_NOTES', 'Eintr&auml;ge');
DEFINE('_HEALTH_MANAGE_2_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_HEALTH_MANAGE_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_MANAGE_2_EDIT', 'Eintrag &auml;ndern');

/** health_manage_3.php */

DEFINE('_HEALTH_MANAGE_3_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_MANAGE_3_TITLE', 'Daten zur Gesundheit des Sch&uuml;lers');
DEFINE('_HEALTH_MANAGE_3_INSERTED', 'Eintrag von ');
DEFINE('_HEALTH_MANAGE_3_SCHOOL', 'Schule');
DEFINE('_HEALTH_MANAGE_3_YEAR', 'Jahr');
DEFINE('_HEALTH_MANAGE_3_REASON', 'Grund');
DEFINE('_HEALTH_MANAGE_3_DATE', 'Datum');
DEFINE('_HEALTH_MANAGE_3_SELECT', 'Grund ausw&auml;hlen');
DEFINE('_HEALTH_MANAGE_3_ACTION', 'Konsequenzen');
DEFINE('_HEALTH_MANAGE_3_WHO', 'Wer hat den Sch&uuml;ler geschickt');
DEFINE('_HEALTH_MANAGE_3_NOTES', 'Eintr&auml;ge');
DEFINE('_HEALTH_MANAGE_3_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_HEALTH_MANAGE_3_DELETE', 'L&ouml;schen');
DEFINE('_HEALTH_MANAGE_3_NEW', 'Neuer Eintrag');
DEFINE('_HEALTH_MANAGE_3_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_MANAGE_3_UPDATE_NOTE', 'Eintrag aktualisieren');
DEFINE('_HEALTH_MANAGE_3_ADD_NOTE', 'Neuer Eintrag');

/** health_manage_4.php */

DEFINE('_HEALTH_MANAGE_4_ENTER_INFRACTION', 'Bitte einen Grund ausw&auml;hlen.');
DEFINE('_HEALTH_MANAGE_4_ENTER_DATE', 'Bitte ein Datum angeben.');
DEFINE('_HEALTH_MANAGE_4_ENTER_ACTION', 'Bitte die Konsequenzen angeben.');
DEFINE('_HEALTH_MANAGE_4_ENTER_WHO', 'Bitte angeben, wer gemeldet hat.');
DEFINE('_HEALTH_MANAGE_4_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_MANAGE_4_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');

/** health_immunz_student_1.php */

DEFINE('_HEALTH_IMMUNZ_STUDENT_1_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_DATE', 'Datum');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_IMM', 'Impfung');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_DETAILS', 'Details');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_TITLE', 'Impfungen des Sch&uuml;lers');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_IMMUNZ_STUDENT_1_ADD', 'Neuer Eintrag');

/** health_immunz_student_2.php */

DEFINE('_HEALTH_IMMUNZ_STUDENT_2_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_TITLE', 'Impfungen des Sch&uuml;lers');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_INSERTED', 'Eintrag von ');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_SCHOOL', 'Schule');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_YEAR', 'Jahr');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_IMM', 'Impfung');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_DATE', 'Datum');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_REASON', 'Grund');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_NOTES', 'Eintr&auml;ge');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_IMMUNZ_STUDENT_2_EDIT', 'Eintrag &auml;ndern');

/** health_immunz_student_3.php */

DEFINE('_HEALTH_IMMUNZ_STUDENT_3_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_TITLE', 'Impfungen des Sch&uuml;lers');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_INSERTED', 'Eintrag von ');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_SCHOOL', 'Schule');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_YEAR', 'Jahr');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_IMM', 'Impfung');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_DATE', 'Datum');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_SELECT', 'Impfung ausw&auml;hlen');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_REASON', 'Grund');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_NOTES', 'Eintr&auml;ge');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_UPDATE_NOTE', 'Eintrag aktualisieren');
DEFINE('_HEALTH_IMMUNZ_STUDENT_3_ADD_NOTE', 'Neuer Eintrag');

/** health_immunz_student_4.php */

DEFINE('_HEALTH_IMMUNZ_STUDENT_4_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_IMMUNZ_STUDENT_4_ENTER_MED', 'Bitte Medikament ausw&auml;hlen.');
DEFINE('_HEALTH_IMMUNZ_STUDENT_4_ENTER_REASON', 'Bitte einen Grund angeben.');
DEFINE('_HEALTH_IMMUNZ_STUDENT_4_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');

/** health_immunz.php */

DEFINE('_HEALTH_IMMUNZ_NOT_REMOVED', 'Kann nicht gel&ouml;scht werden, wird im System verwendet.');
DEFINE('_HEALTH_IMMUNZ_DUP', 'Ist schon in Verwendung, doppelte Eintr&auml;ge sind nicht erlaubt.');
DEFINE('_HEALTH_IMMUNZ_EDIT', '&Auml;ndern');
DEFINE('_HEALTH_IMMUNZ_REMOVE', 'L&ouml;schen');
DEFINE('_HEALTH_IMMUNZ_SURE', 'Sind Sie sicher?');
DEFINE('_HEALTH_IMMUNZ_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_IMMUNZ_TITLE', 'Impfungen verwalten');
DEFINE('_HEALTH_IMMUNZ_NEW', 'Neue Impfung hinzuf&uuml;gen');
DEFINE('_HEALTH_IMMUNZ_ADD', 'Hinzuf&uuml;gen');
DEFINE('_HEALTH_IMMUNZ_UPDATE_CODE', 'Impfung &auml;ndern');
DEFINE('_HEALTH_IMMUNZ_UPDATE', '&Auml;ndern');

/** health_immunz_1.php */

DEFINE('_HEALTH_IMMUNZ_1_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_HEALTH_IMMUNZ_1_DATE', 'Datum');
DEFINE('_HEALTH_IMMUNZ_1_CODE', 'Art');
DEFINE('_HEALTH_IMMUNZ_1_DETAILS', 'Details');
DEFINE('_HEALTH_IMMUNZ_1_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_IMMUNZ_1_TITLE', 'Impfungen des Sch&uuml;lers');
DEFINE('_HEALTH_IMMUNZ_1_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_IMMUNZ_1_ADD', 'Neuer Eintrag');

/** health_immunz_2.php */

DEFINE('_HEALTH_IMMUNZ_2_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_IMMUNZ_2_TITLE', 'Impfungen des Sch&uuml;lers');
DEFINE('_HEALTH_IMMUNZ_2_INSERTED', 'Eintrag von ');
DEFINE('_HEALTH_IMMUNZ_2_SCHOOL', 'Schule');
DEFINE('_HEALTH_IMMUNZ_2_YEAR', 'Jahr');
DEFINE('_HEALTH_IMMUNZ_2_MED', 'Medikament');
DEFINE('_HEALTH_IMMUNZ_2_DATE', 'Datum');
DEFINE('_HEALTH_IMMUNZ_2_REASON', 'Grund');
DEFINE('_HEALTH_IMMUNZ_2_NOTES', 'Eintr&auml;ge');
DEFINE('_HEALTH_IMMUNZ_2_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_HEALTH_IMMUNZ_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_IMMUNZ_2_EDIT', 'Eintrag &auml;ndern');

/** health_immunz_3.php */

DEFINE('_HEALTH_IMMUNZ_3_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_IMMUNZ_3_TITLE', 'Impfungen des Sch&uuml;lers');
DEFINE('_HEALTH_IMMUNZ_3_INSERTED', 'Eintrag von ');
DEFINE('_HEALTH_IMMUNZ_3_SCHOOL', 'Schule');
DEFINE('_HEALTH_IMMUNZ_3_YEAR', 'Jahr');
DEFINE('_HEALTH_IMMUNZ_3_MED', 'Medikament');
DEFINE('_HEALTH_IMMUNZ_3_DATE', 'Datum');
DEFINE('_HEALTH_IMMUNZ_3_SELECT', 'Medikament ausw&auml;hlen');
DEFINE('_HEALTH_IMMUNZ_3_REASON', 'Grund');
DEFINE('_HEALTH_IMMUNZ_3_NOTES', 'Eintr&auml;ge');
DEFINE('_HEALTH_IMMUNZ_3_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_IMMUNZ_3_UPDATE_NOTE', 'Eintrag aktualisieren');
DEFINE('_HEALTH_IMMUNZ_3_ADD_NOTE', 'Neuer Eintrag');

/** health_immunz_4.php */

DEFINE('_HEALTH_IMMUNZ_4_ENTER_MED', 'Bitte Medikament ausw&auml;hlen.');
DEFINE('_HEALTH_IMMUNZ_4_ENTER_DATE', 'Bitte Datum ausw&auml;hlen.');
DEFINE('_HEALTH_IMMUNZ_4_ENTER_REASON', 'Bitte einen Grund angeben.');
DEFINE('_HEALTH_IMMUNZ_4_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_IMMUNZ_4_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');

/** health_allergy_1.php */

DEFINE('_HEALTH_ALLERGY_1_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_HEALTH_ALLERGY_1_DATE', 'Datum');
DEFINE('_HEALTH_ALLERGY_1_CODE', 'Art');
DEFINE('_HEALTH_ALLERGY_1_DETAILS', 'Details');
DEFINE('_HEALTH_ALLERGY_1_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_ALLERGY_1_TITLE', 'Allergien des Sch&uuml;lers');
DEFINE('_HEALTH_ALLERGY_1_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_ALLERGY_1_ADD', 'Neuer Eintrag');

/** health_allergy_2.php */

DEFINE('_HEALTH_ALLERGY_2_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_ALLERGY_2_TITLE', 'Allergien des Sch&uuml;lers');
DEFINE('_HEALTH_ALLERGY_2_INSERTED', 'Eintrag von ');
DEFINE('_HEALTH_ALLERGY_2_SCHOOL', 'Schule');
DEFINE('_HEALTH_ALLERGY_2_YEAR', 'Jahr');
DEFINE('_HEALTH_ALLERGY_2_ALLERGY', 'Allergie');
DEFINE('_HEALTH_ALLERGY_2_DATE', 'Datum');
DEFINE('_HEALTH_ALLERGY_2_REASON', 'Grund');
DEFINE('_HEALTH_ALLERGY_2_NOTES', 'Eintr&auml;ge');
DEFINE('_HEALTH_ALLERGY_2_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_HEALTH_ALLERGY_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_ALLERGY_2_EDIT', 'Eintrag &auml;ndern');

/** health_allergy_3.php */

DEFINE('_HEALTH_ALLERGY_3_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_ALLERGY_3_TITLE', 'Allergien des Sch&uuml;lers');
DEFINE('_HEALTH_ALLERGY_3_INSERTED', 'Eintrag von ');
DEFINE('_HEALTH_ALLERGY_3_SCHOOL', 'Schule');
DEFINE('_HEALTH_ALLERGY_3_YEAR', 'Jahr');
DEFINE('_HEALTH_ALLERGY_3_ALLERGY', 'Allergie');
DEFINE('_HEALTH_ALLERGY_3_DATE', 'Datum');
DEFINE('_HEALTH_ALLERGY_3_SELECT', 'Allergie ausw&auml;hlen');
DEFINE('_HEALTH_ALLERGY_3_REASON', 'Grund');
DEFINE('_HEALTH_ALLERGY_3_NOTES', 'Eintr&auml;ge');
DEFINE('_HEALTH_ALLERGY_3_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_HEALTH_ALLERGY_3_UPDATE_NOTE', 'Eintrag aktualisieren');
DEFINE('_HEALTH_ALLERGY_3_ADD_NOTE', 'Neuer Eintrag');

/** health_allergy_4.php */

DEFINE('_HEALTH_ALLERGY_4_ENTER_DATE', 'Bitte Datum ausw&auml;hlen.');
DEFINE('_HEALTH_ALLERGY_4_ENTER_REASON', 'Bitte einen Grund angeben.');
DEFINE('_HEALTH_ALLERGY_4_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_ALLERGY_4_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');

/** health_allergies.php */

DEFINE('_HEALTH_ALLERGIES_NOT_REMOVED', 'Kann nicht gel&ouml;scht werden, wird im System verwendet.');
DEFINE('_HEALTH_ALLERGIES_DUP', 'Ist schon in Verwendung, doppelte Eintr&auml;ge sind nicht erlaubt.');
DEFINE('_HEALTH_ALLERGIES_EDIT', '&Auml;ndern');
DEFINE('_HEALTH_ALLERGIES_REMOVE', 'L&ouml;schen');
DEFINE('_HEALTH_ALLERGIES_SURE', 'Sind Sie sicher?');
DEFINE('_HEALTH_ALLERGIES_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_ALLERGIES_TITLE', 'Allergien verwalten');
DEFINE('_HEALTH_ALLERGIES_NEW', 'Neue Allergie hinzuf&uuml;gen');
DEFINE('_HEALTH_ALLERGIES_ADD', 'Hinzuf&uuml;gen');
DEFINE('_HEALTH_ALLERGIES_UPDATE_CODE', 'Allergie &auml;ndern');
DEFINE('_HEALTH_ALLERGIES_UPDATE', '&Auml;ndern');

/** health_change_password.php */

DEFINE('_HEALTH_CHANGE_PASSWORD_SUCCESSFUL', 'Das Passwort wurde erfolgreich ge&auml;ndert.' );
DEFINE('_HEALTH_CHANGE_PASSWORD_TITLE', 'Passwort &auml;ndern' );
DEFINE('_HEALTH_CHANGE_PASSWORD_UPDATE', 'Passwort aktualisieren' );

/** health_change_student_year.php */

DEFINE('_HEALTH_CHANGE_STUDENT_YEAR_CONFIRM', 'Das Jahr wird geaendert. Weiter?' );
DEFINE('_HEALTH_CHANGE_STUDENT_YEAR_TITLE', 'Das Jahr f&uuml;r Sch&uuml;ler &auml;ndern' );
DEFINE('_HEALTH_CHANGE_STUDENT_YEAR_SELECT', 'Bitte m&ouml;gliche Jahre ausw&auml;hlen:' );

/** health_codes.php */

DEFINE('_HEALTH_CODES_NOT_REMOVED', 'Kann nicht gel&ouml;scht werden, wird im System verwendet.');
DEFINE('_HEALTH_CODES_DUP', 'Ist schon in Verwendung, doppelte Eintr&auml;ge sind nicht erlaubt.');
DEFINE('_HEALTH_CODES_EDIT', '&Auml;ndern');
DEFINE('_HEALTH_CODES_REMOVE', 'L&ouml;schen');
DEFINE('_HEALTH_CODES_SURE', 'Sind Sie sicher?');
DEFINE('_HEALTH_CODES_UPPER', 'Gesundheits-Bereich');
DEFINE('_HEALTH_CODES_TITLE', 'Krankheiten verwalten');
DEFINE('_HEALTH_CODES_NEW', 'Neuer Eintrag');
DEFINE('_HEALTH_CODES_ADD', 'Hinzuf&uuml;gen');
DEFINE('_HEALTH_CODES_UPDATE_CODE', 'Eintrag &auml;ndern');
DEFINE('_HEALTH_CODES_UPDATE', '&Auml;ndern');

/** generatereportcard.php */

DEFINE('_GENERATE_REPORT_CARD_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_GENERATE_REPORT_CARD_TITLE', 'Bericht');
DEFINE('_GENERATE_REPORT_CARD_SUBTITLE', 'Keine Berichte.');
DEFINE('_GENERATE_REPORT_CARD_NAME', 'Name');
DEFINE('_GENERATE_REPORT_CARD_TEACHER', 'Lehrer');
DEFINE('_GENERATE_REPORT_CARD_OVERALL', 'Gesamtnote');
DEFINE('_GENERATE_REPORT_CARD_EFFORT', 'Mitarbeit');
DEFINE('_GENERATE_REPORT_CARD_CONDUCT', 'Verhalten');
DEFINE('_GENERATE_REPORT_CARD_COMMENTS', 'Bemerkungen');
DEFINE('_GENERATE_REPORT_CARD_GENERATE', 'Bericht erstellen');

/** generatereportcardnew.php */

DEFINE('_GENERATE_REPORT_CARD_NEW_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_GENERATE_REPORT_CARD_NEW_TITLE', 'Bericht');
DEFINE('_GENERATE_REPORT_CARD_NEW_TITLE2', 'Bitte einen Bericht ausw&auml;hlen');
DEFINE('_GENERATE_REPORT_CARD_NEW_SUBTITLE', 'Keine Berichte.');
DEFINE('_GENERATE_REPORT_CARD_NEW_WRITE', 'Berichte der Klasse ');
DEFINE('_GENERATE_REPORT_CARD_NEW_NAME', 'Name');
DEFINE('_GENERATE_REPORT_CARD_NEW_TEACHER', 'Lehrer');
DEFINE('_GENERATE_REPORT_CARD_NEW_OVERALL', 'Gesamtnote');
DEFINE('_GENERATE_REPORT_CARD_NEW_EFFORT', 'Mitarbeit');
DEFINE('_GENERATE_REPORT_CARD_NEW_CONDUCT', 'Verhalten');
DEFINE('_GENERATE_REPORT_CARD_NEW_COMMENTS', 'Bemerkungen');
DEFINE('_GENERATE_REPORT_CARD_NEW_COURSE', 'Fach');
DEFINE('_GENERATE_REPORT_CARD_NEW_QUARTER1', 'Semester 1');
DEFINE('_GENERATE_REPORT_CARD_NEW_QUARTER2', 'Semester 2');
DEFINE('_GENERATE_REPORT_CARD_NEW_QUARTER3', 'Quarter 3');
DEFINE('_GENERATE_REPORT_CARD_NEW_QUARTER4', 'Quarter 4');
DEFINE('_GENERATE_REPORT_CARD_NEW_CHOOSE', 'Sch&uuml;ler ausw&auml;hlen');
DEFINE('_GENERATE_REPORT_CARD_NEW_GENERATE', 'Bericht erstellen');
DEFINE('_GENERATE_REPORT_CARD_NEW_CHOOSE2', 'Bitte w&auml;hlen Sie eine Klasse und einen Zeitraum f&uuml;r den Bericht');

/** forgot_password.php */

DEFINE('_FORGOT_PASSWORD_FORM_ERROR','Der Eintrag im Email Feld muss g&uuml;ltig sein.');
DEFINE('_FORGOT_PASSWORD_SUBJECT','Passwort zuschicken');
DEFINE('_FORGOT_PASSWORD_BODY1','Ihr Passwort ist ');
DEFINE('_FORGOT_PASSWORD_BODY2','Bitte verwenden Sie es zum Login.');
DEFINE('_FORGOT_PASSWORD_FORM_ERROR2','Es gibt keinen Benutzer mit dieser Email Adresse.');
DEFINE('_FORGOT_PASSWORD_PICTURE_SMALL','images/sms_de_small.gif');
DEFINE('_FORGOT_PASSWORD_EMAIL','Bitte Email Adresse eingeben');
DEFINE('_FORGOT_PASSWORD_SUBMIT','Password zuschicken');

/** ez_results.php */

DEFINE('_EZ_RESULTS_NO_RESULTS', 'Keine Ergebnisse.');
DEFINE('_EZ_RESULTS_MIXED_NAV_LEFT', 'Zeige an: CUR_START-CUR_END von TOTAL_RESULTS Ergebnis(sen) (Seite CUR_PAGE von NUM_PAGES Seite(n))');
DEFINE('_EZ_RESULTS_MIXED_NAV_RIGHT', 'Zeige an: CUR_START-CUR_END von TOTAL_RESULTS Ergebnis(sen) (Seite CUR_PAGE von NUM_PAGES Seite(n))');
DEFINE('_EZ_RESULTS_TEXT_COUNT', 'NUMBER Ergebnis(se)');
DEFINE('_EZ_RESULTS_TEXT_NEXT', 'N&auml;chsten NUMBER &gt;&gt;');
DEFINE('_EZ_RESULTS_TEXT_BACK', '&lt;&lt; NUMBER zur&uuml;ck');
DEFINE('_EZ_RESULTS_TEXT_NUM_PAGES', '| NUMBER SEITEN |');
DEFINE('_EZ_RESULTS_TEXT_START_PAGE', '[<u>Start</u>]');
DEFINE('_EZ_RESULTS_TEXT_LAST_PAGE', '[<u>Letzte von NUMBER Seiten</u>]');
DEFINE('_EZ_RESULTS_TEXT_HOVER_MSG_LINK', 'Gehe zur Seite NUMBER der Ergebnisse ...');
DEFINE('_EZ_RESULTS_TEXT_HOVER_MSG_NEXT', 'Gehe zu den n&auml;chsten NUMBER Ergebnissen ...');
DEFINE('_EZ_RESULTS_TEXT_HOVER_MSG_BACK', 'Gehe zu den vorigen NUMBER Ergebnissen ...');
DEFINE('_EZ_RESULTS_TEXT_HOVER_MSG_START', 'Gehe zu den ersten NUMBER Ergebnissen ...');
DEFINE('_EZ_RESULTS_TEXT_HOVER_MSG_END', 'Gehe zu den letzten NUMBER Ergebnissen ...');

/** down_reports.php */

DEFINE('_DOWN_REPORTS_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_DOWN_REPORTS_TITLE', 'Berichte im pdf Format');
DEFINE('_DOWN_REPORTS_STUDENTS', 'Alle aktiven Sch&uuml;ler');
DEFINE('_DOWN_REPORTS_ATTENDANCE', 'An-/Abwesenheit pro Tag');
DEFINE('_DOWN_REPORTS_DISCIPLINE', 'Verhalten');
DEFINE('_DOWN_REPORTS_GRADES', 'Berichte');
DEFINE('_DOWN_REPORTS_SORTED', 'sortiert nach');
DEFINE('_DOWN_REPORTS_GRADES_ID', 'Klasse');
DEFINE('_DOWN_REPORTS_SCHOOL', 'Schule');
DEFINE('_DOWN_REPORTS_ETH', 'Nationalit&auml;t');
DEFINE('_DOWN_REPORTS_GENDER', 'Geschlecht');
DEFINE('_DOWN_REPORTS_HEADER', 'Bericht &uuml;ber aktive Sch&uuml;ler');
DEFINE('_DOWN_REPORTS_ROUTE', 'Verkehrsmittel');
DEFINE('_DOWN_REPORTS_HOME', 'Klassenzimmer');
DEFINE('_DOWN_REPORTS_BY', 'und nach');
DEFINE('_DOWN_REPORTS_NONE', 'nicht sortiert');
DEFINE('_DOWN_REPORTS_DOWNLOAD', 'PDF Bericht erstellen');

/** displayforum.php */

DEFINE('_DISPLAY_FORUM_UPPER', 'Forum');

/** contacts_homework.php */

DEFINE('_CONTACTS_HOMEWORK_TITLE', 'Aktuelle Haus&uuml;bungen');
DEFINE('_CONTACTS_HOMEWORK_SUBJECT', 'Fach');
DEFINE('_CONTACTS_HOMEWORK_ROOM', 'Klasse');
DEFINE('_CONTACTS_HOMEWORK_TEACHER', 'Lehrer');
DEFINE('_CONTACTS_HOMEWORK_ASSIGNED_ON', 'Aufgegeben am');
DEFINE('_CONTACTS_HOMEWORK_DUE_ON', 'Fertig bis');
DEFINE('_CONTACTS_HOMEWORK_NOTES', 'Bemerkungen');
DEFINE('_CONTACTS_HOMEWORK_FILES', 'Datei(en)');

/** contacts_menu.php */

DEFINE('_CONTACTS_MENU_TITLE', 'Seite f&uuml;r Eltern');
DEFINE('_CONTACTS_MENU_SUBTITLE', 'Bitte einen Sch&uuml;ler ausw&auml;hlen');
DEFINE('_CONTACTS_MENU_NO_STUDENTS', 'Keine Sch&uuml;ler.');

/** contacts_set_student.php */

DEFINE('_CONTACTS_SET_STUDENT_TITLE', 'Seite f&uuml;r Eltern');
DEFINE('_CONTACTS_SET_STUDENT_SUBTITLE', 'Bitte links die Eintr&auml;ge des Sch&uuml;lers ausw&auml;hlen');

/** contact_change_password.php */

DEFINE('_CONTACT_CHANGE_PASSWORD_SUCCESSFUL', 'Das Passwort wurde erfolgreich ge&auml;ndert.' );
DEFINE('_CONTACT_CHANGE_PASSWORD_TITLE', 'Passwort &auml;ndern' );
DEFINE('_CONTACT_CHANGE_PASSWORD_UPDATE', 'Passwort aktualisieren' );

/** contact_change_student_year.php */

DEFINE('_CONTACT_CHANGE_STUDENT_YEAR_CONFIRM', 'Das Jahr wird geaendert. Weiter?' );
DEFINE('_CONTACT_CHANGE_STUDENT_YEAR_TITLE', 'Das Jahr f&uuml;r Sch&uuml;ler &auml;ndern' );
DEFINE('_CONTACT_CHANGE_STUDENT_YEAR_SELECT', 'Bitte m&ouml;gliche Jahre ausw&auml;hlen:' );

/** contact_manage_attendance_1.php */

DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_DATE', 'Datum');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_CODE', 'Art');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_DETAILS', 'Details');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_TITLE', 'An-/Abwesenheit des Sch&uuml;lers');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_1_ADD_NOTE', 'Neuer Eintrag');

/** contact_manage_attendance_2.php */

DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_TITLE', 'An-/Abwesenheit des Sch&uuml;lers');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_INSERTED', 'Eintrag von ');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_SCHOOL', 'Schule');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_YEAR', 'Jahr');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_CODE', 'Art');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_DATE', 'Datum');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_NOTES', 'Eintr&auml;ge');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_CONTACT_MANAGE_ATTENDANCE_2_EDIT', 'Eintrag editieren');

/** contact_manage_discipline_1.php */

DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_DATE', 'Datum');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_CODE', 'Art');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_DETAILS', 'Details');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_TITLE', 'Verhalten des Sch&uuml;lers');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_1_ADD_NOTE', 'Neuer Eintrag');

/** contact_manage_discipline_2.php */

DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_TITLE', 'Verhalten des Sch&uuml;lers');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_INSERTED', 'Eintrag von ');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_SCHOOL', 'Schule');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_YEAR', 'Jahr');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_INFRACTION', '&Uuml;bertretung');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_DATE', 'Datum');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_START_DATE', 'Anfangsdatum');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_END_DATE', 'Ende-Datum');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_ACTION', 'Konsequenzen');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_WHO', 'Meldung');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_NOTES', 'Eintr&auml;ge');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_CONTACT_MANAGE_DISCIPLINE_2_EDIT', 'Eintrag editieren');

/** contact_manage_grades_1.php */

DEFINE('_CONTACT_MANAGE_GRADES_1_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_CONTACT_MANAGE_GRADES_1_QUARTER', 'Zeitraum');
DEFINE('_CONTACT_MANAGE_GRADES_1_SUBJECT', 'Fach');
DEFINE('_CONTACT_MANAGE_GRADES_1_GRADE', 'Note');
DEFINE('_CONTACT_MANAGE_GRADES_1_EFFORT', 'Mitarbeit');
DEFINE('_CONTACT_MANAGE_GRADES_1_DETAILS', 'Details');
DEFINE('_CONTACT_MANAGE_GRADES_1_TITLE', 'Noten des Sch&uuml;lers');
DEFINE('_CONTACT_MANAGE_GRADES_1_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_CONTACT_MANAGE_GRADES_1_ADD_NOTE', 'Neuer Eintrag');

/** contact_manage_grades_2.php */

DEFINE('_CONTACT_MANAGE_GRADES_2_TITLE', 'Noten des Sch&uuml;lers');
DEFINE('_CONTACT_MANAGE_GRADES_2_INSERTED', 'Eintrag von ');
DEFINE('_CONTACT_MANAGE_GRADES_2_SCHOOL', 'Schule');
DEFINE('_CONTACT_MANAGE_GRADES_2_SUBJECT', 'Fach');
DEFINE('_CONTACT_MANAGE_GRADES_2_QUARTER', 'Zeitraum');
DEFINE('_CONTACT_MANAGE_GRADES_2_GRADE', 'Note');
DEFINE('_CONTACT_MANAGE_GRADES_2_EFFORT', 'Mitarbeit');
DEFINE('_CONTACT_MANAGE_GRADES_2_CONDUCT', 'Verhalten');
DEFINE('_CONTACT_MANAGE_GRADES_2_COMMENTS', 'Kommentare');
DEFINE('_CONTACT_MANAGE_GRADES_2_NOTES', 'Eintr&auml;ge');
DEFINE('_CONTACT_MANAGE_GRADES_2_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_CONTACT_MANAGE_GRADES_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_CONTACT_MANAGE_GRADES_2_EDIT', 'Eintrag editieren');

/** contact_menu_forum.inc.php */

DEFINE('_CONTACT_MENU_FORUM_INC_TITLE', 'Zur&uuml;ck zum Hauptmen&uuml;');
DEFINE('_CONTACT_MENU_FORUM_INC_TITLE_TEXT', 'Hauptmen&uuml;');
DEFINE('_CONTACT_MENU_FORUM_INC_ATT', 'Eintr&auml;ge zur an- und Abwesenheit');
DEFINE('_CONTACT_MENU_FORUM_INC_ATT_TEXT', 'An-/Abwesenheit');
DEFINE('_CONTACT_MENU_FORUM_INC_DIS', 'Verhalten');
DEFINE('_CONTACT_MENU_FORUM_INC_DIS_TEXT', 'Verhalten');
DEFINE('_CONTACT_MENU_FORUM_INC_GRADE', 'Noten');
DEFINE('_CONTACT_MENU_FORUM_INC_GRADE_TEXT', 'Noten');
DEFINE('_CONTACT_MENU_FORUM_INC_CHANGE', 'Jahr &auml;ndern');
DEFINE('_CONTACT_MENU_FORUM_INC_CHANGE_TEXT', 'Jahr &auml;ndern');
DEFINE('_CONTACT_MENU_FORUM_INC_HOMEWORK', 'Haus&uuml;bungen');
DEFINE('_CONTACT_MENU_FORUM_INC_HOMEWORK_TEXT', 'Haus&uuml;bungen');
DEFINE('_CONTACT_MENU_FORUM_INC_FORUM', 'Forum');
DEFINE('_CONTACT_MENU_FORUM_INC_FORUM_TEXT', 'Forum');
DEFINE('_CONTACT_MENU_FORUM_INC_PASS', 'Passwort &auml;ndern');
DEFINE('_CONTACT_MENU_FORUM_INC_PASS_TEXT', 'Passwort &auml;ndern');
DEFINE('_CONTACT_MENU_FORUM_INC_LOGOUT', 'Vom System abmelden');
DEFINE('_CONTACT_MENU_FORUM_INC_LOGOUT_TEXT', 'Logout');

/** contact_menu.inc.php */

DEFINE('_CONTACT_MENU_INC_TITLE', 'Zur&uuml;ck zum Hauptmen&uuml;');
DEFINE('_CONTACT_MENU_INC_TITLE_TEXT', 'Hauptmen&uuml;');
DEFINE('_CONTACT_MENU_INC_TIMETABLE', 'Stundenplan anzeigen');
DEFINE('_CONTACT_MENU_INC_TIMETABLE_TEXT', 'Stundenplan');
DEFINE('_CONTACT_MENU_INC_EXAMS', 'Pr&uuml;fungen anzeigen');
DEFINE('_CONTACT_MENU_INC_EXAMS_TEXT', 'Pr&uuml;fungen');
DEFINE('_CONTACT_MENU_INC_ATT', 'Eintr&auml;ge zur an- und Abwesenheit');
DEFINE('_CONTACT_MENU_INC_ATT_TEXT', 'An-/Abwesenheit');
DEFINE('_CONTACT_MENU_INC_DIS', 'Verhalten');
DEFINE('_CONTACT_MENU_INC_DIS_TEXT', 'Verhalten');
DEFINE('_CONTACT_MENU_INC_GRADE', 'Noten');
DEFINE('_CONTACT_MENU_INC_GRADE_TEXT', 'Noten');
DEFINE('_CONTACT_MENU_INC_CHANGE', 'Jahr &auml;ndern');
DEFINE('_CONTACT_MENU_INC_CHANGE_TEXT', 'Jahr &auml;ndern');
DEFINE('_CONTACT_MENU_INC_HOMEWORK', 'Haus&uuml;bungen');
DEFINE('_CONTACT_MENU_INC_HOMEWORK_TEXT', 'Haus&uuml;bungen');
DEFINE('_CONTACT_MENU_INC_FORUM', 'Forum');
DEFINE('_CONTACT_MENU_INC_FORUM_TEXT', 'Forum');
DEFINE('_CONTACT_MENU_INC_SPEAK', 'Sprechstunden anzeigen');
DEFINE('_CONTACT_MENU_INC_SPEAK_TEXT', 'Sprechstunden ');
DEFINE('_CONTACT_MENU_INC_PASS', 'Passwort &auml;ndern');
DEFINE('_CONTACT_MENU_INC_PASS_TEXT', 'Passwort &auml;ndern');
DEFINE('_CONTACT_MENU_INC_LOGOUT', 'Vom System abmelden');
DEFINE('_CONTACT_MENU_INC_LOGOUT_TEXT', 'Logout');
DEFINE('_CONTACT_MENU_INC_YEAR', 'Jahr');

/** admin_webusers_active.php */

/** admin_webusers_contacts.php */

DEFINE('_ADMIN_WEBUSERS_CONTACTS_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_ADMIN_WEBUSERS_CONTACTS_TITLE', 'Suchergebnisse');
DEFINE('_ADMIN_WEBUSERS_CONTACTS_NO_DATA', 'Keine Daten.');
DEFINE('_ADMIN_WEBUSERS_CONTACTS_ACTIVATE', 'Aktivieren');
DEFINE('_ADMIN_WEBUSERS_CONTACTS_DEACTIVATE', 'De-Aktivieren');
DEFINE('_ADMIN_WEBUSERS_CONTACTS_PASS', 'Passwort zur&uuml;cksetzen');
DEFINE('_ADMIN_WEBUSERS_CONTACTS_NEW', 'Neue Suche');

/** admin_webusers_resetpass.php */

DEFINE('_ADMIN_WEBUSERS_RESETPASS_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_TITLE', 'Passwort zur&uuml;cksetzen');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_NO_DATA', 'Keine Daten.');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_SUBJECT', 'Ihr neues Passwort');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_BODY1', 'Ihr Passwort ist zurueckgesetzt worden. Das neue Passwort ist: ');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_BODY2', 'Es ist nur voruebergehend. Bitte loggen Sie ein und aendern Sie Ihr Passwort.');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_USER1', 'Passwort fuer Benutzer ');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_USER2', ' ist zurueckgesetzt worden');
DEFINE('_ADMIN_WEBUSERS_RESETPASS_USER3', '. Ein Email ist an den Benutzer verschickt worden.');

/** admin_webusers_teachers.php */

DEFINE('_ADMIN_WEBUSERS_TEACHERS_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_ADMIN_WEBUSERS_TEACHERS_TITLE', 'Suchergebnis Lehrer');
DEFINE('_ADMIN_WEBUSERS_TEACHERS_NODATA', 'Keine Lehrer gefunden.');
DEFINE('_ADMIN_WEBUSERS_TEACHERS_ACTIVATE', 'Aktivieren');
DEFINE('_ADMIN_WEBUSERS_TEACHERS_DEACTIVATE', 'De-Aktivieren');
DEFINE('_ADMIN_WEBUSERS_TEACHERS_PASS', 'Passwort zur&uuml;cksetzen');
DEFINE('_ADMIN_WEBUSERS_TEACHERS_NEW', 'Neue Suche');

/** admin_users_1.php */

DEFINE('_ADMIN_USERS_1_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_ADMIN_USERS_1_TITLE', 'Lehrer/Kontaktperson aktivieren oder deaktivieren');
DEFINE('_ADMIN_USERS_1_SUBTITLE1', 'Lehrer entfernen/deaktivieren');
DEFINE('_ADMIN_USERS_1_BY_SCHOOL', 'Nach Name der Schule');
DEFINE('_ADMIN_USERS_1_BY_LASTNAME', 'Nach Nachname');
DEFINE('_ADMIN_USERS_1_ALL_SCHOOLS', 'Alle Schulen');
DEFINE('_ADMIN_USERS_1_SEARCH', 'Suchen');
DEFINE('_ADMIN_USERS_1_BY_LAST', 'Oder nach Anfangsbuchstaben des Nachnamens anzeigen');
DEFINE('_ADMIN_USERS_1_SUBTITLE2', 'Kontaktpersonen entfernen/deaktivieren');
DEFINE('_ADMIN_USERS_1_BY_LIST', 'Aus der Liste');
DEFINE('_ADMIN_USERS_1_ALL_CONTACTS', 'Alle Kontakte');

/** admin_users_2.php */

DEFINE('_ADMIN_USERS_2_FORM_ERROR', 'Keine Ergebnisse mit Nachname ');
DEFINE('_ADMIN_USERS_2_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_ADMIN_USERS_2_SEARCH_RESULTS', 'Suchergebnis');
DEFINE('_ADMIN_USERS_2_NEW', 'Neue Suche');

/** admin_users_3.php */

DEFINE('_ADMIN_USERS_3_FORM_ERROR', 'Nationalit&auml;t kann nicht gel&ouml;scht werden, wird im System verwendet.');
DEFINE('_ADMIN_USERS_3_EDIT', '&Auml;ndern');
DEFINE('_ADMIN_USERS_3_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_USERS_3_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_USERS_3_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_ADMIN_USERS_3_ETH', 'Nationalit&auml;ten verwalten');
DEFINE('_ADMIN_USERS_3_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_USERS_3_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_USERS_3_UPDATE_ETH', 'Eintrag aktualisieren');
DEFINE('_ADMIN_USERS_3_UPDATE', 'Aktualisieren');

/** admin_titles.php */

DEFINE('_ADMIN_TITLES_FORM_ERROR', 'Titel kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_TITLES_DUP', 'Dieser Titel ist schon in Verwendung. Doppelte Eintr&auml;ge sind nicht erlaubt.');
DEFINE('_ADMIN_TITLES_EDIT', '&Auml;ndern');
DEFINE('_ADMIN_TITLES_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_TITLES_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_TITLES_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_ADMIN_TITLES_TITLE', 'Titel verwalten');
DEFINE('_ADMIN_TITLES_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_TITLES_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_TITLES_UPDATE_TITLE', 'Titel aktualisieren');
DEFINE('_ADMIN_TITLES_UPDATE', 'Aktualisieren');

/** admin_terms.php */

DEFINE('_ADMIN_TERMS_FORM_ERROR', 'Zeitraum kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_TERMS_DUP', 'Dieser Zeitraum ist schon in Verwendung. Doppelte Eintr&auml;ge sind nicht erlaubt.');
DEFINE('_ADMIN_TERMS_EDIT', '&Auml;ndern');
DEFINE('_ADMIN_TERMS_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_TERMS_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_TERMS_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_ADMIN_TERMS_TITLE', 'Zeitr&auml;ume verwalten');
DEFINE('_ADMIN_TERMS_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_TERMS_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_TERMS_UPDATE_TERM', 'Titel aktualisieren');
DEFINE('_ADMIN_TERMS_UPDATE', 'Aktualisieren');

/** admin_teacher_schedules.php */

DEFINE('_ADMIN_TEACHER_SCHEDULES_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, Sch&uuml;ler sind ihm im System zugeordnet.');
DEFINE('_ADMIN_TEACHER_SCHEDULES_DUP', 'Dieser Eintrag wird schon verwendet.');
DEFINE('_ADMIN_TEACHER_SCHEDULES_EDIT', '&Auml;ndern');
DEFINE('_ADMIN_TEACHER_SCHEDULES_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_TEACHER_SCHEDULES_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_TEACHER_SCHEDULES_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_ADMIN_TEACHER_SCHEDULES_TITLE', 'Eintrag verwalten');
DEFINE('_ADMIN_TEACHER_SCHEDULES_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_TEACHER_SCHEDULES_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_TEACHER_SCHEDULES_UPDATE_SCHEDULE', 'Eintrag aktualisieren');
DEFINE('_ADMIN_TEACHER_SCHEDULES_UPDATE', 'Aktualisieren');

/** admin_teacher_1.php */

DEFINE('_ADMIN_TEACHER_1_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_TEACHER_1_TITLE', 'Lehrer verwalten');
DEFINE('_ADMIN_TEACHER_1_ADD_NEW', 'Neuen Lehrer hinzuf&uuml;gen');
DEFINE('_ADMIN_TEACHER_1_SUBTITLE', 'Oder die Datenbank durchsuchen');
DEFINE('_ADMIN_TEACHER_1_BY_SCHOOL', 'Nach Schule');
DEFINE('_ADMIN_TEACHER_1_BY_NAME', 'Nach Nachname');
DEFINE('_ADMIN_TEACHER_1_ALL', 'Alle Schulen');
DEFINE('_ADMIN_TEACHER_1_SEARCH', 'Suchen');
DEFINE('_ADMIN_TEACHER_1_BY_LAST', 'Oder nach Anfangsbuchstaben des Nachnamens anzeigen');

/** admin_teacher_2.php */

DEFINE('_ADMIN_TEACHER_2_ACTIVATE', 'Aktivieren');
DEFINE('_ADMIN_TEACHER_2_DEACTIVATE', 'Deaktivieren');
DEFINE('_ADMIN_TEACHER_2_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_TEACHER_2_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_TEACHER_2_REMOVE_ERROR', 'Fehler beim L&ouml;schen');
DEFINE('_ADMIN_TEACHER_2_FORM_ERROR', 'Keine Lehrer f&uuml;r Schule ');
DEFINE('_ADMIN_TEACHER_2_FORM_ERROR2', 'Keine Lehrer gefunden');
DEFINE('_ADMIN_TEACHER_2_FORM_ERROR3', 'Keine Lehrer mit Nachname ');
DEFINE('_ADMIN_TEACHER_2_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_TEACHER_2_TITLE', 'Suchergebnis Lehrer');
DEFINE('_ADMIN_TEACHER_2_NEW', 'Neue Suche');
DEFINE('_ADMIN_TEACHER_2_NAME', 'Name');
DEFINE('_ADMIN_TEACHER_2_SCHOOL', 'Schule');
DEFINE('_ADMIN_TEACHER_2_ACTIVE', 'Aktiv');

/** admin_subjects.php */

DEFINE('_ADMIN_SUBJECTS_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_SUBJECTS_DUP', 'Dieser Eintrag wird schon verwendet.');
DEFINE('_ADMIN_SUBJECTS_EDIT', '&Auml;ndern');
DEFINE('_ADMIN_SUBJECTS_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_SUBJECTS_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_SUBJECTS_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_ADMIN_SUBJECTS_TITLE', 'F&auml;cher verwalten');
DEFINE('_ADMIN_SUBJECTS_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_SUBJECTS_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_SUBJECTS_UPDATE_SUBJECT', 'Eintrag aktualisieren');
DEFINE('_ADMIN_SUBJECTS_UPDATE', 'Aktualisieren');

/** admin_stu_schedule.php */

DEFINE('_ADMIN_STU_SCHEDULE_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_STU_SCHEDULE_DUP', 'Dieser Eintrag wird schon verwendet.');
DEFINE('_ADMIN_STU_SCHEDULE_TERM', 'Zeitraum');
DEFINE('_ADMIN_STU_SCHEDULE_TEACHER', 'Lehrer');
DEFINE('_ADMIN_STU_SCHEDULE_SUBJECT', 'Fach');
DEFINE('_ADMIN_STU_SCHEDULE_PERIOD', 'Stunde');
DEFINE('_ADMIN_STU_SCHEDULE_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_STU_SCHEDULE_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_STU_SCHEDULE_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_STU_SCHEDULE_TITLE', 'Stundenplan f&uuml;r');
DEFINE('_ADMIN_STU_SCHEDULE_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_STU_SCHEDULE_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_STU_SCHEDULE_DAYS', 'Tage');

/** admin_student_1.php */

DEFINE('_ADMIN_STUDENT_1_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_STUDENT_1_TITLE', 'Sch&uuml;ler verwalten');
DEFINE('_ADMIN_STUDENT_1_ADD_NEW', 'Neuen Sch&uuml;ler hinzuf&uuml;gen');
DEFINE('_ADMIN_STUDENT_1_SUBTITLE', 'Oder die Datenbank durchsuchen');
DEFINE('_ADMIN_STUDENT_1_BY_INTERNAL', 'Nach interner Nummer');
DEFINE('_ADMIN_STUDENT_1_BY_NAME', 'Nach Nachname');
DEFINE('_ADMIN_STUDENT_1_SEARCH', 'Suchen');
DEFINE('_ADMIN_STUDENT_1_OR_BY', 'Oder nach');
DEFINE('_ADMIN_STUDENT_1_BY_SCHOOL', 'Nach Schule');
DEFINE('_ADMIN_STUDENT_1_BY_GRADE', 'Nach Klasse');
DEFINE('_ADMIN_STUDENT_1_BY_GENDER', 'Nach Geschlecht');
DEFINE('_ADMIN_STUDENT_1_BY_ETHNICITY', 'Nach Nationalit&auml;t');
DEFINE('_ADMIN_STUDENT_1_ACTIVE', 'Aktiv');
DEFINE('_ADMIN_STUDENT_1_HOMED', 'Unterricht zu Hause');
DEFINE('_ADMIN_STUDENT_1_SPED', 'Spezialausbildung');
DEFINE('_ADMIN_STUDENT_1_BY_LAST', 'Oder nach Anfangsbuchstaben des Nachnamens anzeigen');

/** admin_student_2.php */

DEFINE('_ADMIN_STUDENT_2_FORM_ERROR', 'Kein Sch&uuml;ler mit interner Nummer ');
DEFINE('_ADMIN_STUDENT_2_SELECT', 'Ausw&auml;hlen');
DEFINE('_ADMIN_STUDENT_2_FORM_ERROR2', 'Kein Sch&uuml;ler mit Nachname ');
DEFINE('_ADMIN_STUDENT_2_FORM_ERROR3', 'Kein Sch&uuml;ler mit diesen Suchkriterien.');
DEFINE('_ADMIN_STUDENT_2_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_STUDENT_2_TITLE', 'Suchergebnisse');
DEFINE('_ADMIN_STUDENT_2_NEW', 'Neue Suche');

/** admin_student_5.php */

DEFINE('_ADMIN_STUDENT_5_DUP', 'Doppelte Eintr&auml;ge wurden nicht gespeichert.');
DEFINE('_ADMIN_STUDENT_5_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_STUDENT_5_UPPER', 'Stundenplan');
DEFINE('_ADMIN_STUDENT_5_TITLE', 'Sch&uuml;ler in diesem Stundenplan');
DEFINE('_ADMIN_STUDENT_5_BACK', 'Zur&uuml;ck zum Stundenplan');
DEFINE('_ADMIN_STUDENT_5_CHANGE', '&Auml;ndern');

/** admin_sgrades.php */

DEFINE('_ADMIN_SGRADES_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_SGRADES_EDIT', '&Auml;ndern');
DEFINE('_ADMIN_SGRADES_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_SGRADES_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_SGRADES_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_SGRADES_TITLE', 'Kommentare verwalten');
DEFINE('_ADMIN_SGRADES_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_SGRADES_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_SGRADES_UPDATE_COMMENT', 'Eintrag aktualisieren');
DEFINE('_ADMIN_SGRADES_UPDATE', 'Aktualisieren');

/** admin_school_years.php */

DEFINE('_ADMIN_SCHOOL_YEARS_FORM_ERROR', 'Kann dieses Jahr nicht l&ouml;schen, es sind Sch&uuml;ler eingetragen.');
DEFINE('_ADMIN_SCHOOL_YEARS_FORM_ERROR2', 'Keine doppelten Schuljahre');
DEFINE('_ADMIN_SCHOOL_YEARS_SCHOOLYEAR', 'Schuljahr ist ');
DEFINE('_ADMIN_SCHOOL_YEARS_EDIT', '&Auml;ndern');
DEFINE('_ADMIN_SCHOOL_YEARS_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_SCHOOL_YEARS_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_SCHOOL_YEARS_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_SCHOOL_YEARS_TITLE', 'Schuljahre verwalten');
DEFINE('_ADMIN_SCHOOL_YEARS_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_SCHOOL_YEARS_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_SCHOOL_YEARS_UPDATE_YEAR', 'Eintrag aktualisieren');
DEFINE('_ADMIN_SCHOOL_YEARS_UPDATE', 'Aktualisieren');

/** admin_school_names.php */

DEFINE('_ADMIN_SCHOOL_NAMES_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_SCHOOL_NAMES_DUP', 'Dieser Eintrag wird schon verwendet.');
DEFINE('_ADMIN_SCHOOL_NAMES_EDIT', '&Auml;ndern');
DEFINE('_ADMIN_SCHOOL_NAMES_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_SCHOOL_NAMES_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_SCHOOL_NAMES_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_SCHOOL_NAMES_TITLE', 'Schulnamen verwalten');
DEFINE('_ADMIN_SCHOOL_NAMES_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_SCHOOL_NAMES_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_SCHOOL_NAMES_UPDATE_NAME', 'Eintrag aktualisieren');
DEFINE('_ADMIN_SCHOOL_NAMES_UPDATE', 'Aktualisieren');

/** admin_schedule_teach_1.php */

DEFINE('_ADMIN_SCHEDULE_TEACH_1_FORM_ERROR', 'Bitte zuerst einen Lehrer ausw&auml;hlen.');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_YEAR', 'Jahr');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_SCHOOL', 'Schule');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_TERM', 'Zeitraum');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_SUBJECT', 'Fach');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_PERIOD', 'Stunde');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_DETAILS', 'Details');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_TITLE', 'Lehrer Stundenplan f&uuml;r ');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_BACK', 'Zur&uuml;ck zum Lehrer');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_ADD', 'Neuer Eintrag');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_DAYS', 'Tag');
DEFINE('_ADMIN_SCHEDULE_TEACH_1_ROOM', 'Klasse');

/** admin_schedule_teach_2.php */

DEFINE('_ADMIN_SCHEDULE_TEACH_2_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_TITLE', 'Lehrer Stundenplan f&uuml;r ');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_TERM', 'Zeitraum');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_SUBJECT', 'Fach');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_PERIOD', 'Stunde');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_YEAR', 'Jahr');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_ROOM', 'Klasse');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_NOTES', 'Eintr&auml;ge');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_BACK', 'Zur&uuml;ck zur &Uuml;bersicht');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_ADD', 'Sch&uuml;ler zu diesem Stundenplan hinzuf&uuml;gen');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_EDIT', 'Stundenplan &auml;ndern');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_STUDENTS', 'Sch&uuml;ler in diesem Stundenplan');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_SCHEDULE_TEACH_2_DAYS', 'Tag(e)');

/** admin_schedule_teach_3.php */

DEFINE('_ADMIN_SCHEDULE_TEACH_3_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_TITLE', 'Lehrer Stundenplan f&uuml;r ');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_SCHOOL', 'Schule');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_PERIOD', 'Stunde');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_TERM', 'Zeitraum');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_SUBJECT', 'Fach');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_ROOM', 'Klasse');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_BACK', 'Zur&uuml;ck zum Lehrer Stundenplan');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_UPDATE', 'Eintrag aktualisieren');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_ADD', 'Neuer Eintrag');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_DAYS', 'Tag');
DEFINE('_ADMIN_SCHEDULE_TEACH_3_DEF_DAYS', 'Mo');

/** admin_schedule_teach_4.php */

DEFINE('_ADMIN_SCHEDULE_TEACH_4_SELECT_TERM', 'Bitte einen Zeitraum ausw&auml;hlen.');
DEFINE('_ADMIN_SCHEDULE_TEACH_4_FORM_ERROR', 'Bitte ein Fach ausw&auml;hlen.');
DEFINE('_ADMIN_SCHEDULE_TEACH_4_FORM_ERROR2', 'Bitte eine Periode ausw&auml;hlen.');
DEFINE('_ADMIN_SCHEDULE_TEACH_4_FORM_ERROR3', 'Dieser Lehrer hat schon einen Stundenplan.');
DEFINE('_ADMIN_SCHEDULE_TEACH_4_TITLE', 'Stundenplan Eintrag');
DEFINE('_ADMIN_SCHEDULE_TEACH_4_SUBTITLE', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');
DEFINE('_ADMIN_SCHEDULE_TEACH_4_UPPER', 'Administrator Bereich');

/** admin_schedule_students_1.php */

DEFINE('_ADMIN_SCHEDULE_STUDENT_1_UPPER', 'Sch&uuml;ler Bereich');
DEFINE('_ADMIN_SCHEDULE_STUDENT_1_TITLE', 'Zuordnung Sch&uuml;ler - Klassen');
DEFINE('_ADMIN_SCHEDULE_STUDENT_1_SCHEDULE', 'Plan');
DEFINE('_ADMIN_SCHEDULE_STUDENT_1_PERIOD', 'Stunde');
DEFINE('_ADMIN_SCHEDULE_STUDENT_1_CHOOSE', 'Klasse ausw&auml;hlen');
DEFINE('_ADMIN_SCHEDULE_STUDENT_1_BUILD', 'Liste erstellen');

/** admin_schedule_students_2.php */

DEFINE('_ADMIN_SCHEDULE_STUDENT_2_FORM_ERROR', 'Bitte die Klasse angeben.');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_FORM_ERROR2', 'Kein Sch&uuml;ler mit diesen Kriterien gefunden.');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_TITLE', 'Bitte rechts die Sch&uuml;ler ausw&auml;hlen');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_CLASS', 'Klasse');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_PERIOD', 'Stunde');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_NEW', 'Neue Suche');
DEFINE('_ADMIN_SCHEDULE_STUDENT_2_ADD', 'Sch&uuml;ler hinzuf&uuml;gen');

/** admin_reports.php */

DEFINE('_ADMIN_REPORTS_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_REPORTS_TITLE', 'Berichte im HTML Format');
DEFINE('_ADMIN_REPORTS_STUDENTS', 'Alle aktiven Sch&uuml;ler');
DEFINE('_ADMIN_REPORTS_ATTENDANCE', 'An-/Abwesenheit pro Tag');
DEFINE('_ADMIN_REPORTS_DISCIPLINE', 'Verhalten');
DEFINE('_ADMIN_REPORTS_GRADES', 'Noten');
DEFINE('_ADMIN_REPORTS_SORTED', 'sortiert nach');
DEFINE('_ADMIN_REPORTS_GRADES_ID', 'Klasse');
DEFINE('_ADMIN_REPORTS_SCHOOL', 'Schule');
DEFINE('_ADMIN_REPORTS_ETH', 'Nationalit&auml;t');
DEFINE('_ADMIN_REPORTS_GENDER', 'Geschlecht');
DEFINE('_ADMIN_REPORTS_ROUTE', 'Verkehrsmittel');
DEFINE('_ADMIN_REPORTS_HOME', 'Klassenzimmer');
DEFINE('_ADMIN_REPORTS_FROM', 'von');
DEFINE('_ADMIN_REPORTS_TO', 'bis');
DEFINE('_ADMIN_REPORTS_BY', 'nach');
DEFINE('_ADMIN_REPORTS_NONE', 'nicht sortiert');
DEFINE('_ADMIN_REPORTS_DOWNLOAD', 'HTML Bericht erstellen');

/** admin_relations.php */

DEFINE('_ADMIN_RELATIONS_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_RELATIONS_DUP', 'Dieser Eintrag wird schon verwendet.');
DEFINE('_ADMIN_RELATIONS_EDIT', '&Auml;ndern');
DEFINE('_ADMIN_RELATIONS_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_RELATIONS_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_RELATIONS_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_RELATIONS_TITLE', 'Beziehungen verwalten');
DEFINE('_ADMIN_RELATIONS_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_RELATIONS_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_RELATIONS_UPDATE_REL', 'Eintrag aktualisieren');
DEFINE('_ADMIN_RELATIONS_UPDATE', 'Aktualisieren');

/** admin_process_mass_mail.php */

// nothing so far

/** admin_menu.inc.php */

DEFINE('_ADMIN_MENU_INC_YEAR', 'Jahr');
DEFINE('_ADMIN_MENU_INC_MAINT', 'Tabellen Verwaltung');
DEFINE('_ADMIN_MENU_INC_MAINT_TEXT', 'Tabellen');
DEFINE('_ADMIN_MENU_INC_USER', 'Benutzer Logins verwalten');
DEFINE('_ADMIN_MENU_INC_USER_TEXT', 'Benutzer Logins');
DEFINE('_ADMIN_MENU_INC_STUDENTS', 'Sch&uuml;ler');
DEFINE('_ADMIN_MENU_INC_MAN_STU', 'Sch&uuml;ler ausw&auml;hlen');
DEFINE('_ADMIN_MENU_INC_MAN_STU_TEXT', 'Sch&uuml;ler ausw&auml;hlen');
DEFINE('_ADMIN_MENU_INC_MAN_ATT', 'An-/Abwesenheit verwalten');
DEFINE('_ADMIN_MENU_INC_MAN_ATT_TEXT', 'An-/Abwesenheit');
DEFINE('_ADMIN_MENU_INC_HEALTH', 'Gesundheitswesen verwalten');
DEFINE('_ADMIN_MENU_INC_HEALTH_TEXT', 'Gesundheit');
DEFINE('_ADMIN_MENU_INC_DIS', 'Verhalten verwalten');
DEFINE('_ADMIN_MENU_INC_DIS_TEXT', 'Verhalten');
DEFINE('_ADMIN_MENU_INC_GRA', 'Noten verwalten');
DEFINE('_ADMIN_MENU_INC_GRA_TEXT', 'Noten');
DEFINE('_ADMIN_MENU_INC_CHANGE', 'Jahr &auml;ndern');
DEFINE('_ADMIN_MENU_INC_CHANGE_TEXT', 'Jahr &auml;ndern');
DEFINE('_ADMIN_MENU_INC_EXAMS', 'Pr&uuml;fungen verwalten');
DEFINE('_ADMIN_MENU_INC_EXAMS_TEXT', 'Pr&uuml;fungen');
DEFINE('_ADMIN_MENU_INC_TEACHERS', 'Lehrer verwalten');
DEFINE('_ADMIN_MENU_INC_TEACHERS_TEXT', 'Lehrer ausw&auml;hlen');
DEFINE('_ADMIN_MENU_INC_SCHEDULE', 'Stundenplan verwalten');
DEFINE('_ADMIN_MENU_INC_SCHEDULE_TEXT', 'Stundenplan');
DEFINE('_ADMIN_MENU_INC_MASS', 'Massen Emails versenden');
DEFINE('_ADMIN_MENU_INC_MASS_TEXT', 'Massen Emails');
DEFINE('_ADMIN_MENU_INC_FORUM', 'Zur Diskussion');
DEFINE('_ADMIN_MENU_INC_FORUM_TEXT', 'Forum');
DEFINE('_ADMIN_MENU_INC_PASS', 'Passwort &auml;ndern');
DEFINE('_ADMIN_MENU_INC_PASS_TEXT', 'Passwort');
DEFINE('_ADMIN_MENU_INC_REP', 'HTML Berichte');
DEFINE('_ADMIN_MENU_INC_REP_TEXT', 'HTML Berichte');
DEFINE('_ADMIN_MENU_INC_DOWN', 'Berichte herunterladen');
DEFINE('_ADMIN_MENU_INC_DOWN_TEXT', 'PDF Berichte');
DEFINE('_ADMIN_MENU_INC_GEN', 'Berichte erstellen');
DEFINE('_ADMIN_MENU_INC_GEN_TEXT', 'Berichte');
DEFINE('_ADMIN_MENU_INC_LOGOUT', 'Vom System abmelden');
DEFINE('_ADMIN_MENU_INC_LOGOUT_TEXT', 'Logout');

/** admin_menu_forum.inc.php */

DEFINE('_ADMIN_MENU_FORUM_INC_YEAR', 'Jahr');
DEFINE('_ADMIN_MENU_FORUM_INC_MAINT', 'Tabellen-Verwaltung');
DEFINE('_ADMIN_MENU_FORUM_INC_MAINT_TEXT', 'Tabellen');
DEFINE('_ADMIN_MENU_FORUM_INC_USER', 'Benutzer Logins verwalten');
DEFINE('_ADMIN_MENU_FORUM_INC_USER_TEXT', 'Benutzer Logins');
DEFINE('_ADMIN_MENU_FORUM_INC_STUDENTS', 'Sch&uuml;ler');
DEFINE('_ADMIN_MENU_FORUM_INC_MAN_STU', 'Sch&uuml;ler verwalten');
DEFINE('_ADMIN_MENU_FORUM_INC_MAN_STU_TEXT', 'Sch&uuml;ler verwalten');
DEFINE('_ADMIN_MENU_FORUM_INC_MAN_ATT', 'An-/Abwesenheit verwalten');
DEFINE('_ADMIN_MENU_FORUM_INC_MAN_ATT_TEXT', 'An-/Abwesenheit');
DEFINE('_ADMIN_MENU_FORUM_INC_HEALTH', 'Gesundheitswesen verwalten');
DEFINE('_ADMIN_MENU_FORUM_INC_HEALTH_TEXT', 'Gesundheit');
DEFINE('_ADMIN_MENU_FORUM_INC_DIS', 'Verhalten verwalten');
DEFINE('_ADMIN_MENU_FORUM_INC_DIS_TEXT', 'Verhalten');
DEFINE('_ADMIN_MENU_FORUM_INC_GRA', 'Noten verwalten');
DEFINE('_ADMIN_MENU_FORUM_INC_GRA_TEXT', 'Noten');
DEFINE('_ADMIN_MENU_FORUM_INC_CHANGE', 'Jahr &auml;ndern');
DEFINE('_ADMIN_MENU_FORUM_INC_CHANGE_TEXT', 'Jahr &auml;ndern');
DEFINE('_ADMIN_MENU_FORUM_INC_TEACHERS', 'Lehrer verwalten');
DEFINE('_ADMIN_MENU_FORUM_INC_TEACHERS_TEXT', 'Lehrer');
DEFINE('_ADMIN_MENU_FORUM_INC_MASS', 'Emails versenden');
DEFINE('_ADMIN_MENU_FORUM_INC_MASS_TEXT', 'Emails');
DEFINE('_ADMIN_MENU_FORUM_INC_FORUM', 'Zur Diskussion');
DEFINE('_ADMIN_MENU_FORUM_INC_FORUM_TEXT', 'Forum');
DEFINE('_ADMIN_MENU_FORUM_INC_PASS', 'Passwort &auml;ndern');
DEFINE('_ADMIN_MENU_FORUM_INC_PASS_TEXT', 'Passwort');
DEFINE('_ADMIN_MENU_FORUM_INC_REP', 'HTML Berichte');
DEFINE('_ADMIN_MENU_FORUM_INC_REP_TEXT', 'HTML Berichte');
DEFINE('_ADMIN_MENU_FORUM_INC_DOWN', 'Berichte herunterladen');
DEFINE('_ADMIN_MENU_FORUM_INC_DOWN_TEXT', 'PDF Berichte');
DEFINE('_ADMIN_MENU_FORUM_INC_GEN', 'Berichte erstellen');
DEFINE('_ADMIN_MENU_FORUM_INC_GEN_TEXT', 'Berichte');
DEFINE('_ADMIN_MENU_FORUM_INC_LOGOUT', 'Vom System abmelden');
DEFINE('_ADMIN_MENU_FORUM_INC_LOGOUT_TEXT', 'Logout');

/** admin_mass_email.php */

DEFINE('_ADMIN_MASS_EMAIL_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MASS_EMAIL_TITLE', 'Massen-Emails');
DEFINE('_ADMIN_MASS_EMAIL_SUBTITLE', 'Eine Kopie der Nachricht wird an den Administrator geschickt.');
DEFINE('_ADMIN_MASS_EMAIL_SEND', 'Sende Nachricht an');
DEFINE('_ADMIN_MASS_EMAIL_CONTACTS', 'Kontaktpersonen');
DEFINE('_ADMIN_MASS_EMAIL_TEACHERS', 'Lehrer');
DEFINE('_ADMIN_MASS_EMAIL_BOTH', 'Beide');
DEFINE('_ADMIN_MASS_EMAIL_SUBJECT', 'Titel');
DEFINE('_ADMIN_MASS_EMAIL_MESSAGE', 'Text');
DEFINE('_ADMIN_MASS_EMAIL_NOW', 'Senden');

/** admin_manage_schedule_1.php */

DEFINE('_ADMIN_MANAGE_SCHEDULE_1_FORM_ERROR', 'Bitte zuerst einen Lehrer ausw&auml;hlen.');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_TERM', 'Zeitraum');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_SUBJECT', 'Fach');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_PERIOD', 'Stunde');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_SURE2', 'Sind Sie sicher?');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_TITLE', 'Stundenplan f&uuml;r ');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_DELETE', 'Auswahl l&ouml;schen');
DEFINE('_ADMIN_MANAGE_SCHEDULE_1_ADD', 'Neuer Eintrag');

/** admin_manage_schedule_2.php */

DEFINE('_ADMIN_MANAGE_SCHEDULE_2_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_TITLE', 'Stundenplan f&uuml;r Sch&uuml;ler');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_SCHOOL', 'Schule');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_YEAR', 'Jahr');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_CODE', 'Art');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_DATE', 'Datum');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_NOTES', 'Eintr&auml;ge');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');
DEFINE('_ADMIN_MANAGE_SCHEDULE_2_EDIT', 'Eintrag bearbeiten');

/** admin_manage_schedule_3.php */

DEFINE('_ADMIN_MANAGE_SCHEDULE_3_ENTER', 'Bitte Art und Datum eingeben.');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_TITLE', 'Stundenplan f&uuml;r Sch&uuml;ler');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_INSERTED', 'Eintrag von ');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_ENTRY', 'Eintrag');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_TERM', 'Zeitraum');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_SELECT', 'Art ausw&auml;hlen');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_NOTES', 'Eintr&auml;ge');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_NOTIFY', 'Kontaktpersonen informieren');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_DELETE', 'L&ouml;schen');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_UPDATE', 'Aktualisieren');
DEFINE('_ADMIN_MANAGE_SCHEDULE_3_ADD', 'Neuer Eintrag');

/** admin_manage_schedule_4.php */

DEFINE('_ADMIN_MANAGE_SCHEDULE_4_FROM', 'h.leinfellner@sbg.at');
DEFINE('_ADMIN_MANAGE_SCHEDULE_4_FROM_NAME', 'Administrator der Schule');
DEFINE('_ADMIN_MANAGE_SCHEDULE_4_SUBJECT', 'Neuer An-/Abwesenheits-Eintrag fuer ');
DEFINE('_ADMIN_MANAGE_SCHEDULE_4_BODY1', 'Ein neuer An-/Abwesenheits-Eintrag wurde hinzugefuegt: fuer ');
DEFINE('_ADMIN_MANAGE_SCHEDULE_4_BODY2', 'Bitte loggen Sie auf der Home Page ein.Danke - Der Direktor');
DEFINE('_ADMIN_MANAGE_SCHEDULE_4_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');

/** admin_manage_grades_1.php */

DEFINE('_ADMIN_MANAGE_GRADES_1_FORM_ERROR', 'Bitte zuerst einen Lehrer ausw&auml;hlen.');
DEFINE('_ADMIN_MANAGE_GRADES_1_QUARTER', 'Zeitraum');
DEFINE('_ADMIN_MANAGE_GRADES_1_GRADE', 'Note');
DEFINE('_ADMIN_MANAGE_GRADES_1_EFFORT', 'Mitarbeit');
DEFINE('_ADMIN_MANAGE_GRADES_1_CONDUCT', 'Verhalten');
DEFINE('_ADMIN_MANAGE_GRADES_1_DETAILS', 'Details');
DEFINE('_ADMIN_MANAGE_GRADES_1_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MANAGE_GRADES_1_TITLE', 'Noten des Sch&uuml;lers');
DEFINE('_ADMIN_MANAGE_GRADES_1_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');
DEFINE('_ADMIN_MANAGE_GRADES_1_ADD', 'Neuer Eintrag');

/** admin_manage_grades_2.php */

DEFINE('_ADMIN_MANAGE_GRADES_2_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MANAGE_GRADES_2_TITLE', 'Noten des Sch&uuml;lers');
DEFINE('_ADMIN_MANAGE_GRADES_2_INSERTED', 'Eintrag von ');
DEFINE('_ADMIN_MANAGE_GRADES_2_SCHOOL', 'Schule');
DEFINE('_ADMIN_MANAGE_GRADES_2_YEAR', 'Jahr');
DEFINE('_ADMIN_MANAGE_GRADES_2_QUARTER', 'Zeitraum');
DEFINE('_ADMIN_MANAGE_GRADES_2_GRADE', 'Note');
DEFINE('_ADMIN_MANAGE_GRADES_2_EFFORT', 'Mitarbeit');
DEFINE('_ADMIN_MANAGE_GRADES_2_CONDUCT', 'Verhalten');
DEFINE('_ADMIN_MANAGE_GRADES_2_COMMENTS', 'Kommentare');
DEFINE('_ADMIN_MANAGE_GRADES_2_NOTES', 'Eintr&auml;ge');
DEFINE('_ADMIN_MANAGE_GRADES_2_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_ADMIN_MANAGE_GRADES_2_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');
DEFINE('_ADMIN_MANAGE_GRADES_2_EDIT', 'Eintrag &auml;ndern');

/** admin_manage_grades_3.php */

DEFINE('_ADMIN_MANAGE_GRADES_3_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MANAGE_GRADES_3_TITLE', 'Noten des Sch&uuml;lers ');
DEFINE('_ADMIN_MANAGE_GRADES_3_INSERTED', 'Eintrag von ');
DEFINE('_ADMIN_MANAGE_GRADES_3_SCHOOL', 'Schule');
DEFINE('_ADMIN_MANAGE_GRADES_3_YEAR', 'Jahr');
DEFINE('_ADMIN_MANAGE_GRADES_3_TERM', 'Zeitraum');
DEFINE('_ADMIN_MANAGE_GRADES_3_GRADE', 'Note');
DEFINE('_ADMIN_MANAGE_GRADES_3_EFFORT', 'Mitarbeit');
DEFINE('_ADMIN_MANAGE_GRADES_3_CONDUCT', 'Verhalten');
DEFINE('_ADMIN_MANAGE_GRADES_3_COMMENTS', 'Kommentare');
DEFINE('_ADMIN_MANAGE_GRADES_3_NOTES', 'Eintr&auml;ge');
DEFINE('_ADMIN_MANAGE_GRADES_3_NOTIFY', 'Kontaktpersonen informieren');
DEFINE('_ADMIN_MANAGE_GRADES_3_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_ADMIN_MANAGE_GRADES_3_DELETE', 'L&ouml;schen');
DEFINE('_ADMIN_MANAGE_GRADES_3_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_MANAGE_GRADES_3_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');
DEFINE('_ADMIN_MANAGE_GRADES_3_UPDATE', 'Aktualisieren');
DEFINE('_ADMIN_MANAGE_GRADES_3_ADD', 'Neuer Eintrag');

/** admin_manage_grades_4.php */

DEFINE('_ADMIN_MANAGE_GRADES_4_ENTER_QUARTER', 'Bitte das Semester ausw&auml;hlen.');
DEFINE('_ADMIN_MANAGE_GRADES_4_ENTER_OVERALL', 'Bitte Gesamtnote eingeben.');
DEFINE('_ADMIN_MANAGE_GRADES_4_ENTER_EFFORT', 'Bitte Mitarbeit ausw&auml;hlen.');
DEFINE('_ADMIN_MANAGE_GRADES_4_ENTER_CONDUCT', 'Bitte Verhalten ausw&auml;hlen.');
DEFINE('_ADMIN_MANAGE_GRADES_4_SUBJECT', 'Neuer Noten-Eintrag fuer ');
DEFINE('_ADMIN_MANAGE_GRADES_4_BODY1', 'Ein neuer Noten-Eintrag wurde hinzugefuegt: fuer ');
DEFINE('_ADMIN_MANAGE_GRADES_4_BODY2', 'Bitte loggen Sie auf der Home Page ein.Danke - Der Direktor');
DEFINE('_ADMIN_MANAGE_GRADES_4_TITLE', 'Noten Eintrag');
DEFINE('_ADMIN_MANAGE_GRADES_4_SUBTITLE', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');
DEFINE('_ADMIN_MANAGE_GRADES_4_UPPER', 'Administrator Bereich');

/** admin_manage_discipline_1.php */

DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_QUARTER', 'Zeitraum');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_DATE', 'Datum');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_CODE', 'Art');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_DETAILS', 'Details');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_TITLE', 'Verhalten des Sch&uuml;lers');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_1_ADD', 'Neuer Eintrag');

/** admin_manage_discipline_2.php */

DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_TITLE', 'Verhalten des Sch&uuml;lers');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_INSERTED', 'Eintrag von ');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_SCHOOL', 'Schule');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_YEAR', 'Jahr');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_INFRACTION', '&Uuml;bertretung');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_DATE', 'Datum');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_START_DATE', 'Anfang der Konsequenzen');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_END_DATE', 'Ende der Konsequenzen');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_ACTION', 'Folge');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_WHO', 'Wer hat die &Uuml;bertretung gemeldet');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_NOTES', 'Eintr&auml;ge');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_2_EDIT', 'Eintrag editieren');

/** admin_manage_discipline_3.php */

DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_TITLE', 'Verhalten des Sch&uuml;lers');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_INSERTED', 'Eintrag von ');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_SCHOOL', 'Schule');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_YEAR', 'Jahr');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_INFRACTION', '&Uuml;bertretung');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_DATE', 'Datum');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_SELECT_INFRACTION', '&Uuml;bertretung ausw&auml;hlen');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_START_DATE', 'Anfang der Konsequenzen');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_END_DATE', 'Ende der Konsequenzen');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_ACTION', 'Folge');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_WHO', 'Wer hat die &Uuml;bertretung gemeldet');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_NOTES', 'Eintr&auml;ge');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_NOTIFY', 'Kontaktperson informieren');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_DELETE', 'L&ouml;schen');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_UPDATE', 'Aktualisieren');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_3_ADD', 'Neu eintragen');

/** admin_manage_discipline_4.php */

DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ENTER_CODE', 'Bitte eine &Uuml;bertretung ausw&auml;hlen.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ENTER_DATE', 'Bitte das Datum ausw&auml;hlen.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ENTER_START', 'Bitte Anfangsdatum ausw&auml;hlen.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ENTER_END', 'Bitte Ende-Datum ausw&auml;hlen.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ENTER_ACTION', 'Bitte die Folgen angeben.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ENTER_WHO', 'Bitte angeben, wer die Meldung gemacht hat.');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_FROM', 'h.leinfellner@sbg.at');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_FROM_NAME', 'Administrator der Schule');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_SUBJECT', 'Neuer Verhaltens-Eintrag fuer ');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_BODY1', 'Ein neuer Verhaltens-Eintrag wurde hinzugefuegt: fuer ');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_BODY2', 'Bitte loggen Sie auf der Home Page ein.Danke - Der Direktor');
DEFINE('_ADMIN_MANAGE_DISCIPLINE_4_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');

/** admin_manage_attendance_1.php */

DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_DATE', 'Datum');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_CODE', 'Art');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_DETAILS', 'Details');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_TITLE', 'An-/Abwesenheit des Sch&uuml;lers');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_1_ADD', 'Neuer Eintrag');

/** admin_manage_attendance_2.php */

DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_TITLE', 'An-/Abwesenheit des Sch&uuml;lers');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_INSERTED', 'Eintrag von ');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_SCHOOL', 'Schule');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_YEAR', 'Jahr');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_CODE', 'Art');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_DATE', 'Datum');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_NOTES', 'Eintr&auml;ge');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_2_EDIT', 'Eintrag editieren');

/** admin_manage_attendance_3.php */

DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_FORM_ERROR', 'Bitte Art und Datum eingeben.');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_TITLE', 'An-/Abwesenheit des Sch&uuml;lers');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_INSERTED', 'Eintrag von ');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_SCHOOL', 'Schule');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_YEAR', 'Jahr');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_CODE', 'Art');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_SELECT', 'Bitte ausw&auml;hlen');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_DATE', 'Datum');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_NOTES', 'Eintr&auml;ge');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_NOTIFY', 'Kontaktpersonen benachrichtigen');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_DELETE', 'L&ouml;schen');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_UPDATE', 'Aktualisieren');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_3_ADD', 'Neuer Eintrag');

/** admin_manage_attendance_4.php */

DEFINE('_ADMIN_MANAGE_ATTENDANCE_4_FROM', 'Administrator der Schule');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_4_SUBJECT', 'Neuer An-/Abwesenheits-Eintrag fuer ');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_4_BODY1', 'Ein neuer An-/Abwesenheits-Eintrag wurde hinzugefuegt: fuer ');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_4_BODY2', 'Bitte loggen Sie auf der Home Page ein.Danke - Der Direktor');
DEFINE('_ADMIN_MANAGE_ATTENDANCE_4_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');

/** admin_maint_tables_menu.inc.php */

DEFINE('_ADMIN_MAINT_TABLES_MENU_YEAR', 'Jahr');
DEFINE('_ADMIN_MAINT_TABLES_MENU_TABLES', 'Tabellen-Verwaltung');
DEFINE('_ADMIN_MAINT_TABLES_MENU_CONF', 'Standard Texte verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_CONF_TEXT', 'Konfiguration');
DEFINE('_ADMIN_MAINT_TABLES_MENU_SCHOOL', 'Schulnamen verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_SCHOOL_TEXT', 'Schulnamen');
DEFINE('_ADMIN_MAINT_TABLES_MENU_SUB', 'F&auml;cher verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_SUB_TEXT', 'F&auml;cher');
DEFINE('_ADMIN_MAINT_TABLES_MENU_GRADE', 'Klassen verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_GRADE_TEXT', 'Klassen');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ROOMS', 'Klassenzimer verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ROOMS_TEXT', 'Klassenzimmer');
DEFINE('_ADMIN_MAINT_TABLES_MENU_EXAMS_TYPES', 'Pr&uuml;fungen verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_EXAMS_TYPES_TEXT', 'Pr&uuml;fungsarten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_SPEAK', 'Sprechstunden verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_SPEAK_TEXT', 'Sprechstunden');
DEFINE('_ADMIN_MAINT_TABLES_MENU_TERMS', 'Zeitr&auml;ume verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_TERMS_TEXT', 'Zeitr&auml;ume');
DEFINE('_ADMIN_MAINT_TABLES_MENU_YEARS', 'Schuljahre verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_YEARS_TEXT', 'Schuljahre');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ETH', 'Nationalit&auml;ten verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ETH_TEXT', 'Nationalit&auml;ten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_COMM', 'Kommentare verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_COMM_TEXT', 'Kommentare');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ATT', 'An-/Abwesenheit verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ATT_TEXT', 'An-/Abwesenheit');
DEFINE('_ADMIN_MAINT_TABLES_MENU_INFR', 'Verhalten verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_INFR_TEXT', 'Verhalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_GEN', 'Generationen eingeben (sen. jun.)');
DEFINE('_ADMIN_MAINT_TABLES_MENU_GEN_TEXT', 'Generationen');
DEFINE('_ADMIN_MAINT_TABLES_MENU_REL', 'Beziehungen verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_REL_TEXT', 'Beziehungen');
DEFINE('_ADMIN_MAINT_TABLES_MENU_TITLES', 'Anreden verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_TITLES_TEXT', 'Anreden');
DEFINE('_ADMIN_MAINT_TABLES_MENU_CUS', 'Spezielle Felder eingeben');
DEFINE('_ADMIN_MAINT_TABLES_MENU_CUS_TEXT', 'Spezielle Felder');
DEFINE('_ADMIN_MAINT_TABLES_MENU_HEALTH', 'Gesundheitswesen');
DEFINE('_ADMIN_MAINT_TABLES_MENU_OFF', 'Gr&uuml;nde f&uuml;r Besuche beim Arzt');
DEFINE('_ADMIN_MAINT_TABLES_MENU_OFF_TEXT', 'Krankheiten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_IMM', 'Impfungen verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_IMM_TEXT', 'Impfungen');
DEFINE('_ADMIN_MAINT_TABLES_MENU_MED', 'Medikamente verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_MED_TEXT', 'Medikamente');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ALL', 'Allergien verwalten');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ALL_TEXT', 'Allergien');
DEFINE('_ADMIN_MAINT_TABLES_MENU_MENU', 'Hauptmen&uuml;');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ADMIN', 'Zur&uuml;ck zum Hauptmen&uuml;');
DEFINE('_ADMIN_MAINT_TABLES_MENU_ADMIN_TEXT', 'Admin Hauptmen&uuml;');

/** admin_maint_menu.php */

DEFINE('_ADMIN_MAINT_MENU_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_MAINT_MENU_TITLE', 'Administrator Tabellen Verwaltung');
DEFINE('_ADMIN_MAINT_MENU_SUBTITLE', 'Bitte links aus den Men&uuml;s ausw&auml;hlen');

/** admin_infraction_codes.php */

DEFINE('_ADMIN_INFRACTION_CODES_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_INFRACTION_CODES_DUP', 'Dieser Eintrag wird schon verwendet.');
DEFINE('_ADMIN_INFRACTION_CODES_EDIT', 'Bearbeiten');
DEFINE('_ADMIN_INFRACTION_CODES_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_INFRACTION_CODES_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_INFRACTION_CODES_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_INFRACTION_CODES_TITLE', 'Verhalten verwalten');
DEFINE('_ADMIN_INFRACTION_CODES_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_INFRACTION_CODES_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_INFRACTION_CODES_UPDATE_INFR', 'Eintrag aktualisieren');
DEFINE('_ADMIN_INFRACTION_CODES_UPDATE', 'Aktualisieren');

/** admin_grades.php */

DEFINE('_ADMIN_GRADES_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_GRADES_DUP', 'Dieser Eintrag wird schon verwendet.');
DEFINE('_ADMIN_GRADES_EDIT', 'Bearbeiten');
DEFINE('_ADMIN_GRADES_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_GRADES_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_GRADES_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_GRADES_TITLE', 'Klassen verwalten');
DEFINE('_ADMIN_GRADES_SUBTITLE', 'Bitte von der niedrigsten bis zur h&ouml;chsten eingeben');
DEFINE('_ADMIN_GRADES_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_GRADES_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_GRADES_UPDATE_GRADE', 'Eintrag aktualisieren');
DEFINE('_ADMIN_GRADES_UPDATE', 'Aktualisieren');

/** admin_generations.php */

DEFINE('_ADMIN_GENERATIONS_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_GENERATIONS_DUP', 'Dieser Eintrag wird schon verwendet.');
DEFINE('_ADMIN_GENERATIONS_EDIT', 'Bearbeiten');
DEFINE('_ADMIN_GENERATIONS_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_GENERATIONS_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_GENERATIONS_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_GENERATIONS_TITLE', 'Generationen verwalten');
DEFINE('_ADMIN_GENERATIONS_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_GENERATIONS_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_GENERATIONS_UPDATE_GEN', 'Eintrag aktualisieren');
DEFINE('_ADMIN_GENERATIONS_UPDATE', 'Aktualisieren');

/** admin_ethnicity.php */

DEFINE('_ADMIN_ETHNICITY_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_ETHNICITY_DUP', 'Dieser Eintrag wird schon verwendet.');
DEFINE('_ADMIN_ETHNICITY_EDIT', 'Bearbeiten');
DEFINE('_ADMIN_ETHNICITY_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_ETHNICITY_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_ETHNICITY_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ETHNICITY_TITLE', 'Nationalit&auml;ten verwalten');
DEFINE('_ADMIN_ETHNICITY_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_ETHNICITY_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_ETHNICITY_UPDATE_ETH', 'Eintrag aktualisieren');
DEFINE('_ADMIN_ETHNICITY_UPDATE', 'Aktualisieren');

/** admin_attendance_codes.php */

DEFINE('_ADMIN_ATTENDANCE_CODES_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_ATTENDANCE_CODES_DUP', 'Dieser Eintrag wird schon verwendet.');
DEFINE('_ADMIN_ATTENDANCE_CODES_EDIT', 'Bearbeiten');
DEFINE('_ADMIN_ATTENDANCE_CODES_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_ATTENDANCE_CODES_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_ATTENDANCE_CODES_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ATTENDANCE_CODES_TITLE', 'An-/Abwesenheit verwalten');
DEFINE('_ADMIN_ATTENDANCE_CODES_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_ATTENDANCE_CODES_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_ATTENDANCE_CODES_UPDATE_ATT', 'Eintrag aktualisieren');
DEFINE('_ADMIN_ATTENDANCE_CODES_UPDATE', 'Aktualisieren');

/** admin_custom_fields.php */

DEFINE('_ADMIN_CUSTOM_FIELDS_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_CUSTOM_FIELDS_DUP', 'Dieser Eintrag wird schon verwendet.');
DEFINE('_ADMIN_CUSTOM_FIELDS_EDIT', 'Bearbeiten');
DEFINE('_ADMIN_CUSTOM_FIELDS_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_CUSTOM_FIELDS_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_CUSTOM_FIELDS_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_CUSTOM_FIELDS_TITLE', 'Spezielle Felder verwalten');
DEFINE('_ADMIN_CUSTOM_FIELDS_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_CUSTOM_FIELDS_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_CUSTOM_FIELDS_UPDATE_CUSTOM', 'Eintrag aktualisieren');
DEFINE('_ADMIN_CUSTOM_FIELDS_UPDATE', 'Aktualisieren');

/** admin_conf_change_year.php */

DEFINE('_ADMIN_CONF_CHANGE_YEAR_FORM_ERROR', 'Dieses Jahr exisitiert schon.');

/** admin_change_password.php */

DEFINE('_ADMIN_CHANGE_PASSWORD_SUCCESSFUL', 'Das Passwort wurde erfolgreich ge&auml;ndert.' );
DEFINE('_ADMIN_CHANGE_PASSWORD_TITLE', 'Passwort &auml;ndern' );
DEFINE('_ADMIN_CHANGE_PASSWORD_UPDATE', 'Passwort aktualisieren' );

/** admin_change_student_year.php */

DEFINE('_ADMIN_CHANGE_STUDENT_YEAR_CONFIRM', 'Das Jahr wird geaendert. Weiter?' );
DEFINE('_ADMIN_CHANGE_STUDENT_YEAR_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_CHANGE_STUDENT_YEAR_TITLE', 'Das Jahr f&uuml;r Sch&uuml;ler &auml;ndern' );
DEFINE('_ADMIN_CHANGE_STUDENT_YEAR_SELECT', 'Bitte m&ouml;gliche Jahre ausw&auml;hlen:' );

/** admin_change_year.php */

DEFINE('_ADMIN_CHANGE_YEAR_CONFIRM', 'Letzte Moeglichkeit, abzubrechen: Jahre aendern?');
DEFINE('_ADMIN_CHANGE_YEAR_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_CHANGE_YEAR_TITLE', 'Aktuelles Jahr auf das N&auml;chste &auml;ndern!');
DEFINE('_ADMIN_CHANGE_YEAR_TEXT1', 'Sind Sie ganz sicher, das aktuelle Jahr &auml;ndern zu wollen? Von ');
DEFINE('_ADMIN_CHANGE_YEAR_TO', ' auf ');
DEFINE('_ADMIN_CHANGE_YEAR_TEXT2', 'Das neue Standard-Jahr wird auf ');
DEFINE('_ADMIN_CHANGE_YEAR_TEXT3', ' gesetzt und alle Sch&uuml;ler werden automatisch eine Klasse h&ouml;her eingetragen.');
DEFINE('_ADMIN_CHANGE_YEAR_TEXT4', 'Dieser Vorgang <strong>KANN NICHT</strong> r&uuml;ckg&auml;ngig gemacht werden. Seien Sie also bitte <strong>GANZ SICHER</strong>, dass Sie diese &Auml;nderung durchf&uuml;hren wollen.');
DEFINE('_ADMIN_CHANGE_YEAR_CONFIRM2', 'Jahres&auml;nderung best&auml;tigen');

/** admin_change_year_successful.php */

DEFINE('_ADMIN_CHANGE_YEAR_SUCCESS_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_CHANGE_YEAR_SUCCESS_TITLE', 'Die &Auml;nderung war erfolgreich');
DEFINE('_ADMIN_CHANGE_YEAR_SUCCESS_TEXT1', 'Alle Sch&uuml;ler sind in die n&auml;chste Klasse gesetzt worden');
DEFINE('_ADMIN_CHANGE_YEAR_SUCCESS_TEXT2', 'Sie befinden sich jetzt schon im neuen Jahr');

/** admin_change_year_error.php */

DEFINE('_ADMIN_CHANGE_YEAR_ERROR_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_CHANGE_YEAR_ERROR_TITLE', 'Die &Auml;nderung war nicht erfolgreich');
DEFINE('_ADMIN_CHANGE_YEAR_ERROR_TEXT1', 'Dieses Schuljahr existiert schon');

/** admin_config.php */

DEFINE('_ADMIN_CONFIG_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_CONFIG_TITLE', 'Allgemeine Konfiguration aktualisieren');
DEFINE('_ADMIN_CONFIG_CURRENT', 'Aktuelles Jahr');
DEFINE('_ADMIN_CONFIG_NEXT', 'Auf n&auml;chstes Jahr &auml;ndern');
DEFINE('_ADMIN_CONFIG_LOGIN', 'Login Nachricht (f&uuml;r jeden Benutzer auf der Startseite sichtbar)');
DEFINE('_ADMIN_CONFIG_TEACHERS', 'Nachricht an Lehrer');
DEFINE('_ADMIN_CONFIG_PARENTS', 'Nachricht an Eltern');
DEFINE('_ADMIN_CONFIG_DEF_CITY', 'Vorgabe Ort');
DEFINE('_ADMIN_CONFIG_DEF_STATE', 'Vorgabe Bundesland');
DEFINE('_ADMIN_CONFIG_DEF_ZIP', 'Vorgabe PLZ');
DEFINE('_ADMIN_CONFIG_DEF_DATE', 'Vorgabe Eintrittsdatum');
DEFINE('_ADMIN_CONFIG_DEF_UPDATE', 'Konfiguration aktualisieren');

/** admin_add_contact_user.php */

DEFINE('_ADMIN_ADD_CONTACT_USER_FORM_ERROR', 'Der Eintrag im Email Feld muss g&uuml;ltig sein.');
DEFINE('_ADMIN_ADD_CONTACT_USER_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_CONTACT_USER_TITLE_ERROR', 'Fehler beim Hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_CONTACT_USER_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');
DEFINE('_ADMIN_ADD_CONTACT_USER_TITLE_SUCCESS', 'Web User Erfolgreich hinzugef&uuml;gt');
DEFINE('_ADMIN_ADD_CONTACT_USER_ADD', 'Neue Kontaktperson hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_CONTACT_USER_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');

/** admin_edit_student_1.php */

DEFINE('_ADMIN_EDIT_STUDENT_1_ERROR1', 'Kann neuen GD image stream nicht initialisieren');
DEFINE('_ADMIN_EDIT_STUDENT_1_ERROR2', 'Fehler beim Erstellen des Bildes');
DEFINE('_ADMIN_EDIT_STUDENT_1_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_EDIT_STUDENT_1_TITLE', 'Sch&uuml;lerdaten');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_CONTACT', 'Kontaktperson hinzuf&uuml;gen');
DEFINE('_ADMIN_EDIT_STUDENT_1_VIEW_SCHEDULE', 'Stundenplan anschauen');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_PIC', 'Bild hinzuf&uuml;gen/&auml;ndern');
DEFINE('_ADMIN_EDIT_STUDENT_1_INTERNAL_ID', 'Interne ID' );
DEFINE('_ADMIN_EDIT_STUDENT_1_ETHNICITY', 'Nationalit&auml;t' );
DEFINE('_ADMIN_EDIT_STUDENT_1_BIRTHDATE', 'Geburtstag' );
DEFINE('_ADMIN_EDIT_STUDENT_1_SCHOOL', 'Schule' );
DEFINE('_ADMIN_EDIT_STUDENT_1_GRADE', 'Klasse' );
DEFINE('_ADMIN_EDIT_STUDENT_1_ACTIVE', 'Aktiv' );
DEFINE('_ADMIN_EDIT_STUDENT_1_HOMED', 'Unterricht zu Hause' );
DEFINE('_ADMIN_EDIT_STUDENT_1_SPED', 'Spezialausbildung' );
DEFINE('_ADMIN_EDIT_STUDENT_1_ENTRY_RECORD', 'Eintrag' );
DEFINE('_ADMIN_EDIT_STUDENT_1_NOTES', 'Eintr&auml;ge');
DEFINE('_ADMIN_EDIT_STUDENT_1_INTO', ' nach ');
DEFINE('_ADMIN_EDIT_STUDENT_1_FROM', ' von ');
DEFINE('_ADMIN_EDIT_STUDENT_1_HOME', 'Klassenzimmer' );
DEFINE('_ADMIN_EDIT_STUDENT_1_TEACHER', 'Klassenvorstand' );
DEFINE('_ADMIN_EDIT_STUDENT_1_ROUTE', 'Verkehrsmittel' );
DEFINE('_ADMIN_EDIT_STUDENT_1_BIRTHCITY', 'Geburtsort');
DEFINE('_ADMIN_EDIT_STUDENT_1_BIRTHSTATE', 'Geburtsbundesland');
DEFINE('_ADMIN_EDIT_STUDENT_1_BIRTHCOUNTRY', 'Geburtsland');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLNAME', 'Name der vorigen Schule');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLADDRESS', 'Adresse der vorigen Schule');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLCITY', 'Stadt der vorigen Schule');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLSTATE', 'Bundesland der vorigen Schule');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLZIP', 'PLZ der vorigen Schule');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRVS_SCHOOLCOUNTRY', 'Land der vorigen Schule');
DEFINE('_ADMIN_EDIT_STUDENT_1_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_ADMIN_EDIT_STUDENT_1_EDIT_STUDENT', 'Sch&uuml;ler bearbeiten');
DEFINE('_ADMIN_EDIT_STUDENT_1_PRIMARY_CONTACT', 'Kontaktperson');
DEFINE('_ADMIN_EDIT_STUDENT_1_RESIDENCE', 'Wohnort');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADDRESS', 'Adresse');
DEFINE('_ADMIN_EDIT_STUDENT_1_CITY', 'Stadt');
DEFINE('_ADMIN_EDIT_STUDENT_1_STATE', 'Bundesland');
DEFINE('_ADMIN_EDIT_STUDENT_1_ZIP', 'PLZ');
DEFINE('_ADMIN_EDIT_STUDENT_1_PHONE1', 'Telefon 1');
DEFINE('_ADMIN_EDIT_STUDENT_1_PHONE2', 'Telefon 2');
DEFINE('_ADMIN_EDIT_STUDENT_1_PHONE3', 'Telefon 3');
DEFINE('_ADMIN_EDIT_STUDENT_1_EMAIL', 'Email');
DEFINE('_ADMIN_EDIT_STUDENT_1_WEB_USER', 'Web User');
DEFINE('_ADMIN_EDIT_STUDENT_1_EDIT_PRIMARY', 'Kontaktperson bearbeiten');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_CONTACTS', 'Weitere Kontakte');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_FIRST_NAME', 'Vorname');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_LAST_NAME', 'Nachname');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_RELATION', 'Beziehung');
DEFINE('_ADMIN_EDIT_STUDENT_1_ADD_WEB_USER', 'Web User');
DEFINE('_ADMIN_EDIT_STUDENT_1_DETAILS', 'Details');

/** admin_edit_student_2.php */

DEFINE('_ADMIN_EDIT_STUDENT_2_UPPER', 'Administrator Bereich' );
DEFINE('_ADMIN_EDIT_STUDENT_2_TITLE', 'Sch&uuml;ler' );
DEFINE('_ADMIN_EDIT_STUDENT_2_CONTACT', 'Kontaktperson' );
DEFINE('_ADMIN_EDIT_STUDENT_2_RESIDENCE', 'Wohnort' );
DEFINE('_ADMIN_EDIT_STUDENT_2_ADDRESS', 'Adresse');
DEFINE('_ADMIN_EDIT_STUDENT_2_CITY', 'Stadt');
DEFINE('_ADMIN_EDIT_STUDENT_2_STATE', 'Bundesland');
DEFINE('_ADMIN_EDIT_STUDENT_2_ZIP', 'PLZ');
DEFINE('_ADMIN_EDIT_STUDENT_2_PHONE1', 'Telefon 1');
DEFINE('_ADMIN_EDIT_STUDENT_2_PHONE2', 'Telefon 2');
DEFINE('_ADMIN_EDIT_STUDENT_2_PHONE3', 'Telefon 3');
DEFINE('_ADMIN_EDIT_STUDENT_2_EMAIL', 'Email');
DEFINE('_ADMIN_EDIT_STUDENT_2_WEB_USER', 'Web User');
DEFINE('_ADMIN_EDIT_STUDENT_2_EDIT', 'Kontaktperson bearbeiten');
DEFINE('_ADMIN_EDIT_STUDENT_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');

/** admin_edit_student_3.php */

DEFINE('_ADMIN_EDIT_STUDENT_3_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_EDIT_STUDENT_3_TITLE', 'Sch&uuml;ler bearbeiten');
DEFINE('_ADMIN_EDIT_STUDENT_3_FIRST', 'Vorname' );
DEFINE('_ADMIN_EDIT_STUDENT_3_MIDDLE', 'Initialen' );
DEFINE('_ADMIN_EDIT_STUDENT_3_LAST', 'Nachname' );
DEFINE('_ADMIN_EDIT_STUDENT_3_GEN', 'Generation' );
DEFINE('_ADMIN_EDIT_STUDENT_3_GENDER', 'Geschlecht' );
DEFINE('_ADMIN_EDIT_STUDENT_3_ETHNICITY', 'Nationalit&auml;t' );
DEFINE('_ADMIN_EDIT_STUDENT_3_ACTIVE', 'Aktiv' );
DEFINE('_ADMIN_EDIT_STUDENT_3_HOMED', 'Unterricht zu Hause' );
DEFINE('_ADMIN_EDIT_STUDENT_3_SPED', 'Spezialausbildung' );
DEFINE('_ADMIN_EDIT_STUDENT_3_ENTRY_RECORD', 'Eintrag' );
DEFINE('_ADMIN_EDIT_STUDENT_3_NOTES', 'Eintr&auml;ge');
DEFINE('_ADMIN_EDIT_STUDENT_3_DELETE', 'L&ouml;schen');
DEFINE('_ADMIN_EDIT_STUDENT_3_INTO', ' nach ');
DEFINE('_ADMIN_EDIT_STUDENT_3_FROM', ' von ');
DEFINE('_ADMIN_EDIT_STUDENT_3_ENTRY', 'Eingang');
DEFINE('_ADMIN_EDIT_STUDENT_3_EXIT', 'Ausgang');
DEFINE('_ADMIN_EDIT_STUDENT_3_ON', 'am');
DEFINE('_ADMIN_EDIT_STUDENT_3_FOR_YEAR', 'f&uuml;r das Jahr');
DEFINE('_ADMIN_EDIT_STUDENT_3_SCHOOL', 'Schule' );
DEFINE('_ADMIN_EDIT_STUDENT_3_INTERNAL_ID', 'Interne ID' );
DEFINE('_ADMIN_EDIT_STUDENT_3_BIRTHDATE', 'Geburtstag' );
DEFINE('_ADMIN_EDIT_STUDENT_3_HOME', 'Klassenzimmer' );
DEFINE('_ADMIN_EDIT_STUDENT_3_TEACHER', 'Klassenvorstand' );
DEFINE('_ADMIN_EDIT_STUDENT_3_ROUTE', 'Verkehrsmittel' );
DEFINE('_ADMIN_EDIT_STUDENT_3_BIRTHCITY', 'Geburtsort');
DEFINE('_ADMIN_EDIT_STUDENT_3_BIRTHSTATE', 'Geburtsbundesland');
DEFINE('_ADMIN_EDIT_STUDENT_3_BIRTHCOUNTRY', 'Geburtsland');
DEFINE('_ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLNAME', 'Name der vorigen Schule');
DEFINE('_ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLADDRESS', 'Adresse der vorigen Schule');
DEFINE('_ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLCITY', 'Stadt der vorigen Schule');
DEFINE('_ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLSTATE', 'Bundesland der vorigen Schule');
DEFINE('_ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLZIP', 'PLZ der vorigen Schule');
DEFINE('_ADMIN_EDIT_STUDENT_3_PRVS_SCHOOLCOUNTRY', 'Land der vorigen Schule');
DEFINE('_ADMIN_EDIT_STUDENT_3_MESSAGE', 'Bitte die Klasse des Sch&uuml;lers ausw&auml;hlen');
DEFINE('_ADMIN_EDIT_STUDENT_3_CUSTOM_FIELDS', 'Bemerkungen');
DEFINE('_ADMIN_EDIT_STUDENT_3_ADD_NEW', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_EDIT_STUDENT_3_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');
DEFINE('_ADMIN_EDIT_STUDENT_3_UPDATE', 'Aktualisieren');

/** admin_edit_student_4.php */

DEFINE('_ADMIN_EDIT_STUDENT_4_ENTER_ID', 'Bitte eine interne Nummer des Sch&uuml;lers eingeben.');
DEFINE('_ADMIN_EDIT_STUDENT_4_ENTER_LAST', 'Bitte den Nachnamen des Sch&uuml;lers eingeben.');
DEFINE('_ADMIN_EDIT_STUDENT_4_ENTER_FIRST', 'Bitte den Vornamen des Sch&uuml;lers eingeben.');
DEFINE('_ADMIN_EDIT_STUDENT_4_ENTER_DOB', 'Bitte das Geburtsdatum des Sch&uuml;lers eingeben.');
DEFINE('_ADMIN_EDIT_STUDENT_4_FORM_ERROR', 'Das Datum ist nicht im richtigen Format.');
DEFINE('_ADMIN_EDIT_STUDENT_4_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_EDIT_STUDENT_4_TITLE', 'Fehler beim Aktualisieren');
DEFINE('_ADMIN_EDIT_STUDENT_4_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');
DEFINE('_ADMIN_EDIT_STUDENT_4_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');

/** admin_add_student_1.php */

DEFINE('_ADMIN_ADD_STUDENT_1_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_STUDENT_1_TITLE', 'Sch&uuml;ler hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_STUDENT_1_FIRST', 'Vorname' );
DEFINE('_ADMIN_ADD_STUDENT_1_MIDDLE', 'Initialen' );
DEFINE('_ADMIN_ADD_STUDENT_1_LAST', 'Nachname' );
DEFINE('_ADMIN_ADD_STUDENT_1_GEN', 'Generation' );
DEFINE('_ADMIN_ADD_STUDENT_1_GENDER', 'Geschlecht' );
DEFINE('_ADMIN_ADD_STUDENT_1_ETHNICITY', 'Nationalit&auml;t' );
DEFINE('_ADMIN_ADD_STUDENT_1_ACTIVE', 'Aktiv' );
DEFINE('_ADMIN_ADD_STUDENT_1_HOMED', 'Unterricht zu Hause' );
DEFINE('_ADMIN_ADD_STUDENT_1_SPED', 'Spezialausbildung' );

// DEFINE('_ADMIN_ADD_STUDENT_1_ENTRY_RECORD', 'Eintrag' );
// DEFINE('_ADMIN_ADD_STUDENT_1_NOTES', 'Eintr&auml;ge');
// DEFINE('_ADMIN_ADD_STUDENT_1_DELETE', 'L&ouml;schen');
// DEFINE('_ADMIN_ADD_STUDENT_1_INTO', ' nach ');
// DEFINE('_ADMIN_ADD_STUDENT_1_FROM', ' von ');
// DEFINE('_ADMIN_ADD_STUDENT_1_ENTRY', 'Eingang');
// DEFINE('_ADMIN_ADD_STUDENT_1_EXIT', 'Ausgang');
// DEFINE('_ADMIN_ADD_STUDENT_1_ON', 'am');
// DEFINE('_ADMIN_ADD_STUDENT_1_FOR_YEAR', 'f&uuml;r das Jahr');

DEFINE('_ADMIN_ADD_STUDENT_1_SCHOOL', 'Schule' );
DEFINE('_ADMIN_ADD_STUDENT_1_INTERNAL_ID', 'Interne ID' );
DEFINE('_ADMIN_ADD_STUDENT_1_BIRTHDATE', 'Geburtstag' );
DEFINE('_ADMIN_ADD_STUDENT_1_HOME', 'Klassenzimmer' );
DEFINE('_ADMIN_ADD_STUDENT_1_TEACHER', 'Klassenvorstand' );
DEFINE('_ADMIN_ADD_STUDENT_1_ROUTE', 'Verkehrsmittel' );
DEFINE('_ADMIN_ADD_STUDENT_1_BIRTHCITY', 'Geburtsort');
DEFINE('_ADMIN_ADD_STUDENT_1_BIRTHSTATE', 'Geburtsbundesland');
DEFINE('_ADMIN_ADD_STUDENT_1_BIRTHCOUNTRY', 'Geburtsland');
DEFINE('_ADMIN_ADD_STUDENT_1_PRVS_SCHOOLNAME', 'Name der vorigen Schule');
DEFINE('_ADMIN_ADD_STUDENT_1_PRVS_SCHOOLADDRESS', 'Adresse der vorigen Schule');
DEFINE('_ADMIN_ADD_STUDENT_1_PRVS_SCHOOLCITY', 'Stadt der vorigen Schule');
DEFINE('_ADMIN_ADD_STUDENT_1_PRVS_SCHOOLSTATE', 'Bundesland der vorigen Schule');
DEFINE('_ADMIN_ADD_STUDENT_1_PRVS_SCHOOLZIP', 'PLZ der vorigen Schule');
DEFINE('_ADMIN_ADD_STUDENT_1_PRVS_SCHOOLCOUNTRY', 'Land der vorigen Schule');
DEFINE('_ADMIN_ADD_STUDENT_1_MESSAGE', 'Bitte die Klasse des Sch&uuml;lers ausw&auml;hlen');
DEFINE('_ADMIN_ADD_STUDENT_1_ADD', 'Sch&uuml;ler hinzuf&uuml;gen');

// DEFINE('_ADMIN_ADD_STUDENT_1_CUSTOM_FIELDS', 'Bemerkungen');
// DEFINE('_ADMIN_ADD_STUDENT_1_DELETE', 'L&ouml;schen');
// DEFINE('_ADMIN_ADD_STUDENT_1_ADD_NEW', 'Hinzuf&uuml;gen');
// DEFINE('_ADMIN_ADD_STUDENT_1_BACK', 'Zur&uuml;ck zum Sch&uuml;ler');
// DEFINE('_ADMIN_ADD_STUDENT_1_UPDATE', 'Aktualisieren');

/** admin_add_student_2.php */

DEFINE('_ADMIN_ADD_STUDENT_2_ENTER_ID', 'Bitte eine interne Nummer des Sch&uuml;lers eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_2_ENTER_LAST', 'Bitte den Nachnamen des Sch&uuml;lers eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_2_ENTER_FIRST', 'Bitte den Vornamen des Sch&uuml;lers eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_2_ENTER_DOB', 'Bitte das Geburtsdatum des Sch&uuml;lers eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_2_FORM_ERROR', 'Das Datum ist nicht im richtigen Format.');
DEFINE('_ADMIN_ADD_STUDENT_2_FORM_ERROR2', 'Diese interne Nummer ist schon zugewiesen: ');
DEFINE('_ADMIN_ADD_STUDENT_2_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_STUDENT_2_TITLE', 'Fehler beim Aktualisieren');
DEFINE('_ADMIN_ADD_STUDENT_2_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');
DEFINE('_ADMIN_ADD_STUDENT_2_TITLE_PRIMARY', 'Kontaktperson f&uuml;r Sch&uuml;ler eingeben');
DEFINE('_ADMIN_ADD_STUDENT_2_DB_PRIMARY', 'Oder die Kontaktperson aus der Datenbank ausw&auml;hlen');
DEFINE('_ADMIN_ADD_STUDENT_2_SEARCH', 'Suchen');
DEFINE('_ADMIN_ADD_STUDENT_2_P_TITLE', 'Titel');
DEFINE('_ADMIN_ADD_STUDENT_2_FIRST', 'Vorname');
DEFINE('_ADMIN_ADD_STUDENT_2_LAST', 'Nachname');
DEFINE('_ADMIN_ADD_STUDENT_2_RESIDENCE', 'Wohnort');
DEFINE('_ADMIN_ADD_STUDENT_2_RELATION', 'Beziehung');
DEFINE('_ADMIN_ADD_STUDENT_2_ADDRESS', 'Adresse');
DEFINE('_ADMIN_ADD_STUDENT_2_CITY', 'Stadt');
DEFINE('_ADMIN_ADD_STUDENT_2_STATE', 'Bundesland');
DEFINE('_ADMIN_ADD_STUDENT_2_ZIP', 'PLZ');
DEFINE('_ADMIN_ADD_STUDENT_2_EMAIL', 'Email');
DEFINE('_ADMIN_ADD_STUDENT_2_PHONE1', 'Telefon 1');
DEFINE('_ADMIN_ADD_STUDENT_2_PHONE2', 'Telefon 2');
DEFINE('_ADMIN_ADD_STUDENT_2_PHONE3', 'Telefon 3');
DEFINE('_ADMIN_ADD_STUDENT_2_MAILINGS', 'Emails');
DEFINE('_ADMIN_ADD_STUDENT_2_OTHER', 'Andere Kommentare');
DEFINE('_ADMIN_ADD_STUDENT_2_ADD', 'Kontakt hinzuf&uuml;gen');

/** admin_add_student_3.php */

DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_FIRST', 'Bitte den Vornamen der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_LAST', 'Bitte den Nachnamen der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_RELATION', 'Bitte die Beziehung zum Sch&uuml;ler eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_ADDRESS', 'Bitte die Adresse der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_CITY', 'Bitte den Ort der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_STATE', 'Bitte das Bundeland der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_ZIP', 'Bitte die PLZ der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_PHONE', 'Bitte mindestens eine Telefonnummer der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_EMAIL', 'Die Email Adresse mu&szlig; g&uuml;ltig sein.');
DEFINE('_ADMIN_ADD_STUDENT_3_ENTER_ALL', 'Bitte alle Werte eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_3_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_STUDENT_3_TITLE', 'Fehler beim Einf&uuml;gen');
DEFINE('_ADMIN_ADD_STUDENT_3_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');
DEFINE('_ADMIN_ADD_STUDENT_3_TITLE_SUCCESS', 'Neuen Sch&uuml;ler und Kontaktperson erfolgreich hinzugef&uuml;gt');
DEFINE('_ADMIN_ADD_STUDENT_3_STUDENT', 'Sch&uuml;ler');
DEFINE('_ADMIN_ADD_STUDENT_3_CONTACT', 'Kontaktperson');
DEFINE('_ADMIN_ADD_STUDENT_3_MESSAGE', 'Wenn diese Kontaktperson in das System einloggen k&ouml;nnen soll, bitte noch diese Informationen ausf&uuml;llen:');
DEFINE('_ADMIN_ADD_STUDENT_3_EMAIL', 'Email Adresse');
DEFINE('_ADMIN_ADD_STUDENT_3_USERNAME', 'Benutzername');
DEFINE('_ADMIN_ADD_STUDENT_3_PASSWORD', 'Passwort');
DEFINE('_ADMIN_ADD_STUDENT_3_SET', 'Als Web User eintragen');
DEFINE('_ADMIN_ADD_STUDENT_3_ADD_NEW', 'Neue Kontaktperson hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_STUDENT_3_ADD', 'Neuen Sch&uuml;ler hinzuf&uuml;gen');

/** admin_add_student_4.php */

DEFINE('_ADMIN_ADD_STUDENT_4_FORM_ERROR', 'Keine Kontaktperson gefunden. Bitte eine Seite zur&uuml;ck gehen, um eine hinzuzuf6uuml;gen.');
DEFINE('_ADMIN_ADD_STUDENT_4_SELECT', 'Ausw&auml;hlen');
DEFINE('_ADMIN_ADD_STUDENT_4_ALERT', 'Bitte eine Beziehung angeben.');
DEFINE('_ADMIN_ADD_STUDENT_4_ALERT2', 'Diese Kontaktperson fuer den Schueler auswaehlen?');
DEFINE('_ADMIN_ADD_STUDENT_4_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_STUDENT_4_TITLE', 'Fehler beim Hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_STUDENT_4_TITLE2', 'Kontaktperson ausw&auml;hlen: f&uuml;r');
DEFINE('_ADMIN_ADD_STUDENT_4_STUDENT', 'Sch&uuml;ler');
DEFINE('_ADMIN_ADD_STUDENT_4_SEL_REL', 'Beziehung ausw&auml;hlen');
DEFINE('_ADMIN_ADD_STUDENT_4_RESIDENCE', 'Wohnort');
DEFINE('_ADMIN_ADD_STUDENT_4_BACK', 'Bitte eine Seite zur&uuml;ck gehen.');

/** admin_add_student_5.php */

DEFINE('_ADMIN_ADD_STUDENT_5_ENTER_ALL', 'Bitte alle Werte eingeben.');
DEFINE('_ADMIN_ADD_STUDENT_5_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_STUDENT_5_TITLE_SUCCESS', 'Neuen Sch&uuml;ler und Kontaktperson erfolgreich eingef&uuml;gt');
DEFINE('_ADMIN_ADD_STUDENT_5_STUDENT', 'Sch&uuml;ler');
DEFINE('_ADMIN_ADD_STUDENT_5_CONTACT', 'Kontaktperson');
DEFINE('_ADMIN_ADD_STUDENT_5_MESSAGE', 'Wenn diese Kontaktperson in das System einloggen k&ouml;nnen soll, bitte noch diese Informationen ausf&uuml;llen:');
DEFINE('_ADMIN_ADD_STUDENT_5_EMAIL', 'Email Adresse');
DEFINE('_ADMIN_ADD_STUDENT_5_USERNAME', 'Benutzername');
DEFINE('_ADMIN_ADD_STUDENT_5_PASSWORD', 'Passwort');
DEFINE('_ADMIN_ADD_STUDENT_5_SET', 'Als Web User eintragen');
DEFINE('_ADMIN_ADD_STUDENT_5_ADD_NEW', 'Neue Kontaktperson hinzuf&uuml;gen');

/** admin_add_edit_picture.php */

DEFINE('_ADMIN_ADD_EDIT_PICTURE_ERROR', 'Der Typ der Datei ist nicht erlaubt. Bitte nur Bilder mit Dateiendungen .jpg, .jpeg, .gif oder .png verwenden.');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_UPLOAD_ERROR', 'Datei Upload Error');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_PIC_ERROR', 'Fehler beim Erstellen des Bildes');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_TITLE', 'Sch&uuml;ler verwalten');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_CURRENT', 'Aktuelles Bild');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_CLICK', 'Klicken Sie hier, um zur&uuml;ck zu gehen');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_NONE', 'Kein Bild gefunden, bitte mit diesem Formular ein Bild auf den Server laden.');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_PICNAME', 'Names des Bildes:');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_PICGRADE', 'In welcher Klasse wurde das Bild aufgenommen?');
DEFINE('_ADMIN_ADD_EDIT_PICTURE_EDITPIC', 'Bild aktualisieren');

/** admin_add_edit_teacher_1.php */

DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_UPDATE_SUB', 'Lehrer aktualisieren');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_UPDATE_PAG', 'Lehrer aktualisieren');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_ADD_SUB', 'Lehrer hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_ADD_PAG', 'Neuen Lehrer hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_TITLE', 'Titel');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_FIRST', 'Vorname');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_LAST', 'Nachname');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_MIDDLE', 'Initialien');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_SCHOOL', 'Schule');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_EMAIL', 'Email');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_ACCESS', 'Zugang zum Gesundsheitswesen (A / T / N)');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_USERNAME', 'Benutzername');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_PASSWORD', 'Passwort');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_ADD_SCH', 'Stundenplan anschauen/hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_1_ADD_TEACHER', 'Lehrer hinzuf&uuml;gen');

/** admin_add_edit_teacher_2.php */

DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ENTER_FIRST', 'Bitte den Vornamen des Lehrers eingeben.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ENTER_LAST', 'Bitte den Nachnamen des Lehrers eingeben.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ENTER_USER', 'Bitte einen Benutzernamen f&uuml;r den Lehrer angeben.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ENTER_PASS', 'Bitte ein Passwort f&uuml;r den Lehrer angeben.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ENTER_EMAIL', 'Bitte eine Email Adresse f&uuml;r den Lehrer angeben.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ENTER_VALID', 'Der Eintrag im Email Feld muss g&uuml;ltig sein.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_DUP', 'Dieser Benutzername wird schon verwendet. Bitte gehen Sie zur&uuml;ck und w&auml;hlen Sie einen anderen Benutzernamen.');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ADDED', 'hinzugef&uuml;gt: ');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_UPDATED', 'aktualisiert: ');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ADDING', 'Hinzuf&uuml;gen: ');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_UPDATING', 'Aktualisieren: ');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_TITLE', 'Fehler');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_TEACHER', 'Lehrer');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_SUCCESSFULLY', 'Erfolgreich');
DEFINE('_ADMIN_ADD_EDIT_TEACHER_2_ADD_TEACHER', 'Lehrer hinzuf&uuml;gen');

/** admin_add_edit_contact_1.php */

DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_UPDATE_SUB', 'Kontaktperson aktualisieren');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_UPDATE_PAG', 'Kontaktperson aktualisieren');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_ADD_SUB', 'Kontaktperson hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_ADD_PAG', 'Neue Kontaktperson hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_TITLE', 'Weitere Kontaktpersonen hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_DB_PRIMARY', 'Oder die Kontaktperson aus der Datenbank ausw&auml;hlen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_SEARCH', 'Suchen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_P_TITLE', 'Titel');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_FIRST', 'Vorname');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_LAST', 'Nachname');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_RESIDENCE', 'Wohnort');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_RELATION', 'Beziehung');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_ADDRESS', 'Adresse');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_CITY', 'Stadt');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_STATE', 'Bundesland');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_ZIP', 'PLZ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_EMAIL', 'Email');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_PHONE1', 'Telefon 1');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_PHONE2', 'Telefon 2');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_PHONE3', 'Telefon 3');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_MAILINGS', 'Emails');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_OTHER', 'Andere Kommentare');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_1_ADD', 'Kontakt hinzuf&uuml;gen');

/** admin_add_edit_contact_2.php */

DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_FIRST', 'Bitte den Vornamen der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_LAST', 'Bitte den Nachnamen der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_RELATION', 'Bitte die Beziehung zum Sch&uuml;ler eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_ADDRESS', 'Bitte die Adresse der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_CITY', 'Bitte den Ort der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_STATE', 'Bitte das Bundeland der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_ZIP', 'Bitte die PLZ der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_PHONE', 'Bitte mindestens eine Telefonnummer der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_EMAIL', 'Die Email Adresse mu&szlig; g&uuml;ltig sein.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_REL_DEF1', 'Die Beziehung ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_REL_DEF2', ' ist f&uuml;r den Sch&uuml;ler schon definiert.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_RES_DEF', 'Der Wohnort ist f&uuml;r den Sch&uuml;ler schon zugewiesen.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ADDED', 'hinzugef&uuml;gt: ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_UPDATED', 'aktualisiert: ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ADDING', 'Hinzuf&uuml;gen: ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_UPDATING', 'Aktualisieren: ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ENTER_ALL', 'Bitte alle Werte eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_TITLE', 'Fehler');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_CONTACT', 'Kontaktperson');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_PLEASE', 'Bitte');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_CLICK_HERE', 'hier klicken');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_CORRECT', 'um diese Fehler zu korrigieren:');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_TITLE_SUCCESS', 'Erfolgreich');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_MESSAGE', 'Wenn diese Kontaktperson in das System einloggen k&ouml;nnen soll, bitte noch diese Informationen ausf&uuml;llen:');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_EMAIL', 'Email Adresse');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_USERNAME', 'Benutzername');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_PASSWORD', 'Passwort');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_SET', 'Als Web User eintragen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_ADD_NEW', 'Neue Kontaktperson hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_2_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');

/** admin_add_edit_contact_3.php */

DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_FORM_ERROR', 'Keine Kontaktperson gefunden. Bitte gehen Sie eine Seite zur&uuml;ck, um eine hinzuzuf&uuml;gen.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_ENTER_RELATION', 'Bitte die Beziehung zum Sch&uuml;ler eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_CONFIRM', 'Diese Kontaktperson zum Schueler hinzufuegen?');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_TITLE', 'Fehler beim Hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_CHOOSE', 'Weitere Kontaktperson ausw&auml;hlen f&uuml;r');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_STUDENT', 'Sch&uuml;ler');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_SEL_REL', 'Beziehung ausw&auml;hlen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_RESIDENCE', 'Wohnort');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_3_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');

/** admin_add_edit_contact_4.php */

DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_REL_DEF1', 'Die Beziehung ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_REL_DEF2', ' ist f&uuml;r den Sch&uuml;ler schon definiert.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_RES_DEF', 'Der Wohnort ist f&uuml;r den Sch&uuml;ler schon zugewiesen.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_ENTER_ALL', 'Bitte alle Werte eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_TITLE', 'Kontaktpersonen erfolgreich hinzugef&uuml;gt');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_STUDENT', 'Sch&uuml;ler');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_ADDITIONAL', 'Weitere Kontaktpersonen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_MESSAGE', 'Wenn diese Kontaktperson in das System einloggen k&ouml;nnen soll, bitte noch diese Informationen ausf&uuml;llen:');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_EMAIL', 'Email Adresse');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_USERNAME', 'Benutzername');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_PASSWORD', 'Passwort');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_SET', 'Als Web User eintragen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_ADD_NEW', 'Neue Kontaktperson hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_TITLE_ERROR', 'Fehler beim Hinzuf&uuml;gen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_4_BACK2', 'Bitte gehen Sie eine Seite zur&uuml;ck, um die Fehler zu korrigieren');

/** admin_add_edit_contact_5.php */

DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_EDIT', 'Bearbeiten');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_CFS', 'Kontaktperson f&uuml;r Sch&uuml;ler');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_P_TITLE', 'Titel');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_FIRST', 'Vorname');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_LAST', 'Nachname');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_RESIDENCE', 'Wohnort');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_RELATION', 'Beziehung');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_ADDRESS', 'Adresse');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_CITY', 'Stadt');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_STATE', 'Bundesland');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_ZIP', 'PLZ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_EMAIL', 'Email');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_PHONE1', 'Telefon 1');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_PHONE2', 'Telefon 2');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_PHONE3', 'Telefon 3');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_MAILINGS', 'Emails');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_OTHER', 'Andere Kommentare');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_5_UPDATE', 'Kontakt aktualisieren');

/** admin_add_edit_contact_6.php */

DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_FIRST', 'Bitte den Vornamen der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_LAST', 'Bitte den Nachnamen der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_RELATION', 'Bitte die Beziehung zum Sch&uuml;ler eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_ADDRESS', 'Bitte die Adresse der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_CITY', 'Bitte den Ort der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_STATE', 'Bitte das Bundeland der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_ZIP', 'Bitte die PLZ der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_PHONE', 'Bitte mindestens eine Telefonnummer der Kontaktperson eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_EMAIL', 'Die Email Adresse mu&szlig; g&uuml;ltig sein.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_RES_DEF', 'Der Wohnort ist f&uuml;r den Sch&uuml;ler schon zugewiesen.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_REL_DEF1', 'Die Beziehung ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_REL_DEF2', ' ist f&uuml;r den Sch&uuml;ler schon definiert.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ENTER_ALL', 'Bitte alle Werte eingeben.');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_UPDATED', 'aktualisiert: ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_UPDATING', 'Aktualisieren: ');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_TITLE', 'Fehler');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_CONTACT', 'Kontaktperson');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_ERROR_BACK', 'Bitte gehen Sie eine Seite zur&uuml;ck, um diese(n) Fehler zu korrigieren:');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_TITLE_SUCCESS', 'Erfolgreich');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_MESSAGE', 'Wenn diese Kontaktperson in das System einloggen k&ouml;nnen soll, bitte noch diese Informationen ausf&uuml;llen:');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_EMAIL', 'Email Adresse');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_USERNAME', 'Benutzername');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_PASSWORD', 'Passwort');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_SET', 'Als Web User eintragen');
DEFINE('_ADMIN_ADD_EDIT_CONTACT_6_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');

/** admin_process_mass_mail.php */

DEFINE('_ADMIN_PROCESS_MASS_MAIL_GENERAL', 'Allgemeines Email');

/** admin_rooms.php */

DEFINE('_ADMIN_ROOMS_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_ROOMS_DUP', 'Dieser Eintrag wird schon verwendet.');
DEFINE('_ADMIN_ROOMS_EDIT', 'Bearbeiten');
DEFINE('_ADMIN_ROOMS_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_ROOMS_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_ROOMS_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_ROOMS_TITLE', 'Klassenzimmer verwalten');
DEFINE('_ADMIN_ROOMS_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_ROOMS_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_ROOMS_UPDATE_CUSTOM', 'Eintrag aktualisieren');
DEFINE('_ADMIN_ROOMS_UPDATE', 'Aktualisieren');

/** contact_timetable.php */

DEFINE('_CONTACT_TIMETABLE_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_CONTACT_TIMETABLE_DATE', 'Datum');
DEFINE('_CONTACT_TIMETABLE_CODE', 'Art');
DEFINE('_CONTACT_TIMETABLE_DETAILS', 'Details');
DEFINE('_CONTACT_TIMETABLE_TITLE', 'Stundenplan des Sch&uuml;lers');
DEFINE('_CONTACT_TIMETABLE_BACK', 'Zum Sch&uuml;ler zur&uuml;ck');
DEFINE('_CONTACT_TIMETABLE_ADD_NOTE', 'Neuer Eintrag');

/** admin_exams_types.php */

DEFINE('_ADMIN_EXAMS_TYPES_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_EXAMS_TYPES_DUP', 'Dieser Eintrag wird schon verwendet.');
DEFINE('_ADMIN_EXAMS_TYPES_EDIT', 'Bearbeiten');
DEFINE('_ADMIN_EXAMS_TYPES_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_EXAMS_TYPES_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_EXAMS_TYPES_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_EXAMS_TYPES_TITLE', 'Pr&uuml;fungen verwalten');
DEFINE('_ADMIN_EXAMS_TYPES_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_EXAMS_TYPES_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_EXAMS_TYPES_UPDATE_CUSTOM', 'Eintrag aktualisieren');
DEFINE('_ADMIN_EXAMS_TYPES_UPDATE', 'Aktualisieren');

/** admin_exams_1.php */

DEFINE('_ADMIN_EXAMS_1_SCHOOL', 'Schule');
DEFINE('_ADMIN_EXAMS_1_ROOM', 'Klasse');
DEFINE('_ADMIN_EXAMS_1_DATE', 'Datum');
DEFINE('_ADMIN_EXAMS_1_SUBJECT', 'Fach');
DEFINE('_ADMIN_EXAMS_1_TYPE', 'Art');
DEFINE('_ADMIN_EXAMS_1_TEACHER', 'Lehrer');
DEFINE('_ADMIN_EXAMS_1_DETAILS', 'Details');
DEFINE('_ADMIN_EXAMS_1_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_EXAMS_1_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_EXAMS_1_TITLE', 'Schularbeiten, Pr&uuml;fungen und Tests');
DEFINE('_ADMIN_EXAMS_1_ADD', 'Pr&uuml;fung hinzuf&uuml;gen');

/** admin_exams_2.php */

DEFINE('_ADMIN_EXAMS_2_SCHOOL', 'Schule');
DEFINE('_ADMIN_EXAMS_2_ROOM', 'Klasse');
DEFINE('_ADMIN_EXAMS_2_DATE', 'Datum');
DEFINE('_ADMIN_EXAMS_2_SUBJECT', 'Fach');
DEFINE('_ADMIN_EXAMS_2_TYPE', 'Art');
DEFINE('_ADMIN_EXAMS_2_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_EXAMS_2_TITLE', 'Pr&uuml;fungen');
DEFINE('_ADMIN_EXAMS_2_YEAR', 'Jahr');
DEFINE('_ADMIN_EXAMS_2_TEACHER', 'Lehrer');
DEFINE('_ADMIN_EXAMS_2_BACK', 'Zur&uuml;ck zur &Uuml;bersicht');
DEFINE('_ADMIN_EXAMS_2_EDIT', 'Eintrag bearbeiten');

/** admin_exams_3.php */

DEFINE('_ADMIN_EXAMS_3_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_EXAMS_3_TITLE', 'Pr&uuml;fungen');
DEFINE('_ADMIN_EXAMS_3_YEAR', 'Jahr');
DEFINE('_ADMIN_EXAMS_3_SCHOOL', 'Schule');
DEFINE('_ADMIN_EXAMS_3_ROOM', 'Klasse');
DEFINE('_ADMIN_EXAMS_3_DATE', 'Datum');
DEFINE('_ADMIN_EXAMS_3_SUBJECT', 'Fach');
DEFINE('_ADMIN_EXAMS_3_TYPE', 'Art');
DEFINE('_ADMIN_EXAMS_3_TEACHER', 'Lehrer');
DEFINE('_ADMIN_EXAMS_3_BACK', 'Zur&uuml;ck');
DEFINE('_ADMIN_EXAMS_3_UPDATE', 'Aktualisieren');
DEFINE('_ADMIN_EXAMS_3_ADD', 'Hinzuf&uuml;gen');

/** admin_exams_4.php */

DEFINE('_ADMIN_EXAMS_4_SELECT_ROOM', 'Bitte eine Klasse ausw&auml;hlen');
DEFINE('_ADMIN_EXAMS_4_FORM_DATE', 'Bitte ein Datum angeben');
DEFINE('_ADMIN_EXAMS_4_FORM_SUBJECT', 'Bitte ein Fach angeben');
DEFINE('_ADMIN_EXAMS_4_FORM_TYPE', 'Bitte einen Typ angeben');
DEFINE('_ADMIN_EXAMS_4_FORM_TEACHER', 'Bitte einen Lehrer angeben');
DEFINE('_ADMIN_EXAMS_4_DUP', 'Dieser Eintrag existiert bereits.');
DEFINE('_ADMIN_EXAMS_4_UPDATING', 'Aktualisieren:');
DEFINE('_ADMIN_EXAMS_4_ADDING', 'Hinzuf&uuml;gen:');
DEFINE('_ADMIN_EXAMS_4_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_EXAMS_4_TITLE', 'Pr&uuml;fungen');

/** teacher_exams_1.php */

DEFINE('_TEACHER_EXAMS_1_SCHOOL', 'Schule');
DEFINE('_TEACHER_EXAMS_1_ROOM', 'Klasse');
DEFINE('_TEACHER_EXAMS_1_DATE', 'Datum');
DEFINE('_TEACHER_EXAMS_1_SUBJECT', 'Fach');
DEFINE('_TEACHER_EXAMS_1_TYPE', 'Art');
DEFINE('_TEACHER_EXAMS_1_TEACHER', 'Lehrer');
DEFINE('_TEACHER_EXAMS_1_DETAILS', 'Details');
DEFINE('_TEACHER_EXAMS_1_REMOVE', 'L&ouml;schen');
DEFINE('_TEACHER_EXAMS_1_UPPER', 'Lehrer Bereich');
DEFINE('_TEACHER_EXAMS_1_TITLE', 'Schularbeiten, Pr&uuml;fungen und Tests');
DEFINE('_TEACHER_EXAMS_1_ADD', 'Pr&uuml;fung hinzuf&uuml;gen');

/** teacher_exams_2.php */

DEFINE('_TEACHER_EXAMS_2_SCHOOL', 'Schule');
DEFINE('_TEACHER_EXAMS_2_ROOM', 'Klasse');
DEFINE('_TEACHER_EXAMS_2_DATE', 'Datum');
DEFINE('_TEACHER_EXAMS_2_SUBJECT', 'Fach');
DEFINE('_TEACHER_EXAMS_2_TYPE', 'Art');
DEFINE('_TEACHER_EXAMS_2_UPPER', 'Lehrer Bereich');
DEFINE('_TEACHER_EXAMS_2_TITLE', 'Pr&uuml;fungen');
DEFINE('_TEACHER_EXAMS_2_YEAR', 'Jahr');
DEFINE('_TEACHER_EXAMS_2_TEACHER', 'Lehrer');
DEFINE('_TEACHER_EXAMS_2_BACK', 'Zur&uuml;ck zur &Uuml;bersicht');
DEFINE('_TEACHER_EXAMS_2_EDIT', 'Eintrag bearbeiten');

/** teacher_exams_3.php */

DEFINE('_TEACHER_EXAMS_3_UPPER', 'Lehrer Bereich');
DEFINE('_TEACHER_EXAMS_3_TITLE', 'Pr&uuml;fungen');
DEFINE('_TEACHER_EXAMS_3_YEAR', 'Jahr');
DEFINE('_TEACHER_EXAMS_3_SCHOOL', 'Schule');
DEFINE('_TEACHER_EXAMS_3_ROOM', 'Klasse');
DEFINE('_TEACHER_EXAMS_3_DATE', 'Datum');
DEFINE('_TEACHER_EXAMS_3_SUBJECT', 'Fach');
DEFINE('_TEACHER_EXAMS_3_TYPE', 'Art');
DEFINE('_TEACHER_EXAMS_3_TEACHER', 'Lehrer');
DEFINE('_TEACHER_EXAMS_3_BACK', 'Zur&uuml;ck');
DEFINE('_TEACHER_EXAMS_3_UPDATE', 'Aktualisieren');
DEFINE('_TEACHER_EXAMS_3_ADD', 'Hinzuf&uuml;gen');

/** teacher_exams_4.php */

DEFINE('_TEACHER_EXAMS_4_SELECT_ROOM', 'Bitte eine Klasse ausw&auml;hlen');
DEFINE('_TEACHER_EXAMS_4_FORM_DATE', 'Bitte ein Datum angeben');
DEFINE('_TEACHER_EXAMS_4_FORM_SUBJECT', 'Bitte ein Fach angeben');
DEFINE('_TEACHER_EXAMS_4_FORM_TYPE', 'Bitte einen Typ angeben');
DEFINE('_TEACHER_EXAMS_4_FORM_TEACHER', 'Bitte einen Lehrer angeben');
DEFINE('_TEACHER_EXAMS_4_DUP', 'Dieser Eintrag existiert bereits.');
DEFINE('_TEACHER_EXAMS_4_UPDATING', 'Aktualisieren:');
DEFINE('_TEACHER_EXAMS_4_ADDING', 'Hinzuf&uuml;gen:');
DEFINE('_TEACHER_EXAMS_4_UPPER', 'Lehrer Bereich');
DEFINE('_TEACHER_EXAMS_4_TITLE', 'Pr&uuml;fungen');

/** contact_exams.php */

DEFINE('_CONTACT_EXAMS_FORM_ERROR', 'Bitte zuerst einen Sch&uuml;ler ausw&auml;hlen.');
DEFINE('_CONTACT_EXAMS_SCHOOL', 'Schule');
DEFINE('_CONTACT_EXAMS_ROOM', 'Klasse');
DEFINE('_CONTACT_EXAMS_DAYS', 'Tag');
DEFINE('_CONTACT_EXAMS_SUBJECT', 'Fach');
DEFINE('_CONTACT_EXAMS_TYPE', 'Art');
DEFINE('_CONTACT_EXAMS_TEACHER', 'Lehrer');
DEFINE('_CONTACT_EXAMS_TITLE', 'Schularbeiten, Pr&uuml;fungen und Tests');

/** admin_speak.php */

DEFINE('_ADMIN_SPEAK_FORM_ERROR', 'Dieser Eintrag kann nicht gel&ouml;scht werden, er wird im System verwendet.');
DEFINE('_ADMIN_SPEAK_DUP', 'Ein Eintrag f&uuml;r diesen Lehrer existiert schon.');
DEFINE('_ADMIN_SPEAK_EDIT', '&Auml;ndern');
DEFINE('_ADMIN_SPEAK_REMOVE', 'L&ouml;schen');
DEFINE('_ADMIN_SPEAK_SURE', 'Sind Sie sicher?');
DEFINE('_ADMIN_SPEAK_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_ADMIN_SPEAK_TITLE', 'Sprechstunden verwalten');
DEFINE('_ADMIN_SPEAK_ADD_NEW', 'Neuer Eintrag');
DEFINE('_ADMIN_SPEAK_TEACHER', 'Lehrer');
DEFINE('_ADMIN_SPEAK_DAY', 'Tag');
DEFINE('_ADMIN_SPEAK_PERIOD', 'Stunde');
DEFINE('_ADMIN_SPEAK_ADD', 'Hinzuf&uuml;gen');
DEFINE('_ADMIN_SPEAK_UPDATE_SUBJECT', 'Eintrag aktualisieren');
DEFINE('_ADMIN_SPEAK_UPDATE', 'Aktualisieren');

/** contact_speak.php */

DEFINE('_CONTACT_SPEAK_TEACHER', 'Lehrer');
DEFINE('_CONTACT_SPEAK_DAY', 'Tag');
DEFINE('_CONTACT_SPEAK_PERIOD', 'Stunde');
DEFINE('_CONTACT_SPEAK_UPPER', 'Kontakt Bereich');
DEFINE('_CONTACT_SPEAK_TITLE', 'Sprechstunden anzeigen');

/** teacher_speak.php */

DEFINE('_TEACHER_SPEAK_TEACHER', 'Lehrer');
DEFINE('_TEACHER_SPEAK_DAY', 'Tag');
DEFINE('_TEACHER_SPEAK_PERIOD', 'Stunde');
DEFINE('_TEACHER_SPEAK_UPPER', 'Lehrer Bereich');
DEFINE('_TEACHER_SPEAK_TITLE', 'Sprechstunden anzeigen');
DEFINE('_TEACHER_SPEAK_UPDATE_SUBJECT', 'Eigenen Eintrag aktualisieren:');
DEFINE('_TEACHER_SPEAK_UPDATE', 'Aktualisieren');

/** admin_books.php */

DEFINE('_ADMIN_BOOKS_ADMIN_AREA', 'Administrator Bereich');
DEFINE('_ADMIN_BOOKS_TITLE', 'B&uuml;cher bestellen');
DEFINE('_ADMIN_BOOKS_SUBTITLE', 'B&uuml;cher-Bestellung bei:');
DEFINE('_ADMIN_BOOKS_TEXT', 'Geben Sie hier die ISBN Nummer und St&uuml;ckzahl des Buches, das Sie bestellen wollen, an.');
DEFINE('_ADMIN_BOOKS_TEXT2', 'Bitte beachten Sie, dass die Bestellung verbindlich ist!');
DEFINE('_ADMIN_BOOKS_PHONE', 'Telefon');
DEFINE('_ADMIN_BOOKS_FAX', 'Fax');
DEFINE('_ADMIN_BOOKS_EMAIL', 'Email');
DEFINE('_ADMIN_BOOKS_DISCOUNT', 'Rabatt');
DEFINE('_ADMIN_BOOKS_ISBN', 'ISBN Nummer');
DEFINE('_ADMIN_BOOKS_QUANTITY', 'St&uuml;ckzahl');
DEFINE('_ADMIN_BOOKS_ORDER', 'Jetzt bestellen!');

/** admin_books_2.php */

DEFINE('_ADMIN_BOOKS_2_MESSAGE1', 'Es gibt eine neue Buchbestellung!');
DEFINE('_ADMIN_BOOKS_2_MESSAGE2', 'Dieses Buch ist bestellt worden:');
DEFINE('_ADMIN_BOOKS_2_MESSAGE3', 'Menge:');
DEFINE('_ADMIN_BOOKS_2_SUBJECT', 'Buchbestellung');

/** admin_contact_2.php */

DEFINE('_ADMIN_CONTACT_2_ACTIVATE', 'Aktivieren');
DEFINE('_ADMIN_CONTACT_2_DEACTIVATE', 'Deaktivieren');
DEFINE('_ADMIN_CONTACT_2_FORM_ERROR', 'Kontaktperson nicht gefunden');
DEFINE('_ADMIN_CONTACT_2_NAME', 'Name');
DEFINE('_ADMIN_CONTACT_2_ACTIVE', 'Aktiv');
DEFINE('_ADMIN_CONTACT_2_FORM_ERROR2', 'Keine Kontaktperson gefunden: ');
DEFINE('_ADMIN_CONTACT_2_FORM_ERROR3', 'Keine Kontaktperson gefunden: Buchstabe ');
DEFINE('_ADMIN_CONTACT_2_UPPER', 'Administrator Bereich');
DEFINE('_ADMIN_CONTACT_2_TITLE', 'Suchergebnis Kontaktpersonen');
DEFINE('_ADMIN_CONTACT_2_NEW', 'Neue Suche');

