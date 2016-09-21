<?php
/**************************************************************************
 *   MRBS Configuration File
 *   Configure this file for your site.
 *   You shouldn't have to modify anything outside this file
 *   (except for the lang.* files, eg lang.en for English, if
 *   you want to change text strings such as "Meeting Room
 *   Booking System", "room" and "area").
 **************************************************************************
//
// extra needs for Joomla mrbs_joomla_v1.5.1 ocean12 $
//


*##################################################################################################################################################*/
/* Modify these lines for the right Joomla settings */
$db_tbl_prefix =	"mrbs_";  // change the prefix to your needs

// Grouplevel check defaults Joomla "..administrator/index.php?option=com_users&view=groups"
// 3 = author - 8 = super user - 13 = [extra group level]
// extra group levels can be made in Joomla.
$min_manager_level  = array(3,8,13);

/*##################################################################################################################################################*/
/*
   Add lines from systemdefaults.inc.php and areadefaults.inc.php below here
   to change the default configuration. Do _NOT_ modify systemdefaults.inc.php
   or areadefaults.inc.php.

   You can also use the file config.inc.overrides.php for extra overrides
   The settings below are the most common needs
*/
 
// WHO TO EMAIL
$mail_settings['admin_on_bookings']      = TRUE;  // the addresses defined by $mail_settings['recipients'] below
$mail_settings['area_admin_on_bookings'] = TRUE;  // the area administrator
$mail_settings['room_admin_on_bookings'] = TRUE;  // the room administrator
$mail_settings['booker']                 = TRUE;  // the person making the booking
$mail_settings['book_admin_on_approval'] = TRUE;  // the booking administrator when booking approval is enabled

// WHEN TO EMAIL
$mail_settings['on_new']    = TRUE;   // when an entry is created
$mail_settings['on_change'] = TRUE;  // when an entry is changed
$mail_settings['on_delete'] = TRUE;  // when an entry is deleted

// WHAT TO EMAIL
$mail_settings['details']   = TRUE; // Set to TRUE if you want full booking details;
$mail_settings['html']      = TRUE; // Set to true if you want HTML mail
$mail_settings['icalendar'] = TRUE; // Set to TRUE to include iCalendar details

/*******************
 * Calendar settings
 *******************/

// TIMES SETTINGS
// --------------
$morningstarts         = 9;   // must be integer in range 0-23
$morningstarts_minutes = 0;   // must be integer in range 0-59
$eveningends           = 24;  // must be integer in range 0-23
$eveningends_minutes   = 00;   // must be integer in range 0-59

// PERIODS SETTINGS
// ----------------
$periods[] = "09:00&nbsp;-&nbsp;10:00";
$periods[] = "10:00&nbsp;-&nbsp;11:00";
$periods[] = "11:00&nbsp;-&nbsp;12:00";
$periods[] = "12:00&nbsp;-&nbsp;13:00";
$periods[] = "13:00&nbsp;-&nbsp;14:00";
$periods[] = "14:00&nbsp;-&nbsp;15:00";
$periods[] = "15:00&nbsp;-&nbsp;16:00";
$periods[] = "16:00&nbsp;-&nbsp;17:00";
$periods[] = "17:00&nbsp;-&nbsp;18:00";
$periods[] = "15:00&nbsp;-&nbsp;16:00";
$periods[] = "16:00&nbsp;-&nbsp;17:00";
$periods[] = "17:00&nbsp;-&nbsp;18:00";
$periods[] = "18:00&nbsp;-&nbsp;19:00";
$periods[] = "19:00&nbsp;-&nbsp;20:00";
$periods[] = "20:00&nbsp;-&nbsp;21:00";
$periods[] = "21:00&nbsp;-&nbsp;22:00";
$periods[] = "22:00&nbsp;-&nbsp;23:00";
$periods[] = "23:00&nbsp;-&nbsp;00:00";

/******************
 * Booking policies
 ******************/


/******************
 * Display settings
 ******************/
$mincals_week_numbers = TRUE;

/************************
 * Miscellaneous settings
 ************************/
$max_rep_entrys = 100;	// default 365 + 1;

// SETTINGS FOR APPROVING BOOKINGS - PER-AREA
$approval_enabled = TRUE;  // Set to TRUE to enable booking approval
$reminders_enabled = TRUE;

// SETTINGS FOR APPROVING BOOKINGS - GLOBAL
$reminder_interval = 60*60*24*2;  // 4 working days
$working_days = array(0,1,2,3,4,5,6,7);  // Mon-Fri

// SETTINGS FOR BOOKING CONFIRMATION
$confirmation_enabled = false;
$confirmed_default = FALSE;

// PRIVATE BOOKINGS SETTINGS
$is_private_field['entry.defaultName'] = FALSE;
$is_private_field['entry.name'] = FALSE;

$is_private_field['entry.debnumber'] = TRUE;
$is_private_field['entry.contact'] = TRUE;
$is_private_field['entry.adress'] = TRUE;
$is_private_field['entry.zipcode'] = TRUE;
$is_private_field['entry.place'] = TRUE;
$is_private_field['entry.telephone'] = TRUE;
$is_private_field['entry.mail'] = TRUE;

$is_private_field['entry.description'] = TRUE;
$is_private_field['entry.create_by'] = TRUE;

// General settings
$auth['only_admin_can_book'] = FALSE;
$auth['only_admin_can_book_repeat'] = FALSE;
$auth['only_admin_can_book_multiday'] = FALSE;
$auth['only_admin_can_select_multiroom'] = FALSE;
$auth['only_admin_can_see_other_users'] = TRUE;
$auth['deny_public_access'] = FALSE;


/************************************************************
 * Do NOT modify below this lines !!!
 ************************************************************/

$bridge_version_number = '1.5.1';
require ( 'joomla.php' );
if (file_exists("config.inc.overrides.php")) {require ( 'config.inc.overrides.php' );}

/***********************************************
 * Get Joomla defaults
 ***********************************************/
$is_default_entry['entry.mail'] = $usermail;
$is_default_entry['entry.contact'] = $username;
$is_default_entry['entry.debnumber'] = $userid;

/***********************************************
 * Set login language
 ***********************************************/
$vocab_override['en']["norights"] = "
	You are not authorized to modify this entry.
	<p class='login_reg'>
	<a class='login' href='../index.php?option=com_users&amp;view=login' TARGET='_parent' id='btnLogin'>Login</a> or
	<a class='registration' href='../index.php?option=com_users&amp;view=registration' TARGET='_parent' >Register</a>
	</p>
	";
$vocab_override['nl']["norights"] = "
	U heeft geen rechten om deze boeking aan te passen.
	<p class='login_reg'>
	<a class='login' href='../index.php?option=com_users&amp;view=login' TARGET='_parent' id='btnLogin'>Login</a> or
	<a class='registration' href='../index.php?option=com_users&amp;view=registration' TARGET='_parent' >Register</a>
	</p>
	";
$vocab_override['de']["norights"] = "
	Sie haben keine Berechtigung, diesen Eintrag zu ändern.
	<p class='login_reg'>
	<a class='login' href='../index.php?option=com_users&amp;view=login' TARGET='_parent' id='btnLogin'>Login</a> or
	<a class='registration' href='../index.php?option=com_users&amp;view=registration' TARGET='_parent' >Register</a>
	</p>
	";



