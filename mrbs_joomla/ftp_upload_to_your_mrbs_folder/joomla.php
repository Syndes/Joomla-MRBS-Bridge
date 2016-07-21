<?php
// +---------------------------------------------------------------------------+
// | Meeting Room Booking System.                                              |
// +---------------------------------------------------------------------------+
// | Functions dedicated to Joomla handling.                                   |
// |---------------------------------------------------------------------------+
// |                                                                           |
// | USE : This file should be included when using Joomla                      |
// |                                                                           |
// +---------------------------------------------------------------------------+
// | @author    ocean12.                                                       |
// |                                                                           |
// +---------------------------------------------------------------------------+
//
// extra needs for Joomla mrbs_joomla_v1.5.1 ocean12 $
//



$dir = realpath(dirname(__FILE__).'/..' ); // path to your joomla installation directory

//Joomla requirement
define( '_JEXEC', 1 );
define( 'JPATH_BASE', $dir);
define( 'DS', DIRECTORY_SEPARATOR );

require_once ( JPATH_BASE .DS . 'configuration.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once ( JPATH_BASE .DS.'libraries'.DS.'joomla'.DS.'factory.php' );

//Then you can call the classes this way
$mainframe = JFactory::getApplication('site');
jimport('joomla.plugin.helper');

//Mrbs authentication
$auth["session"] =	"jm";
$auth["type"] =		"jm";

//Database
$dbsys =		$mainframe->getCfg('dbtype');	// Database driver name
$db_host =		$mainframe->getCfg('host');		// Database host name
$db_database =	$mainframe->getCfg('db');		// Database name
$db_login =		$mainframe->getCfg('user');		// User for database authentication
$db_password =	$mainframe->getCfg('password');	// Password for database authentication
$debug =		$mainframe->getCfg('debug');
$timezoneSystem = $mainframe->getCfg('offset');

//Site
$mrbs_company =						$mainframe->getCfg('sitename');
$mrbs_admin =						$mainframe->getCfg('fromname');
$mrbs_admin_email =					$mainframe->getCfg('mailfrom');
$mail_settings['admin_backend'] =	$mainframe->getCfg('mailer');

//Email
$sendmail_settings['path'] =		$mainframe->getCfg('sendmail');
$smtp_settings['host'] =			$mainframe->getCfg('smtpsecure') . '://' . $mainframe->getCfg('smtphost');
$smtp_settings['port'] =			$mainframe->getCfg('smtpport');
if ($mainframe->getCfg('smtpauth') == '1') {$smtp_settings['auth'] = true;} else {$smtp_settings['auth'] = false;}
$smtp_settings['username'] =		$mainframe->getCfg('smtpuser');
$smtp_settings['password'] =		$mainframe->getCfg('smtppass');
$mail_settings['from'] =			$mainframe->getCfg('smtpuser');
$mail_settings['recipients'] =		$mainframe->getCfg('smtpuser');
$mail_settings['cc'] =				'';
$mail_settings['treat_cc_as_to'] =	FALSE;

//User
$user =			JFactory::getUser();
$usermail =		$user->get('email');
$username =		$user->get('name');
$userid =		$user->get('id');
$timezoneUser =	$user->getParam('timezone', FALSE);
$usergids =		$user->get('groups');

//User Additional Fields
if ($userid){
	$profile = 		JUserHelper::getProfile($user->id);
	$address1 =		$profile->profile['address1'];
	$address2 =		$profile->profile['address2'];
	$city =			$profile->profile['city'];
	$postal_code =	$profile->profile['postal_code'];
	$phone =		$profile->profile['phone'];
}

// Default language joomla
$frontendsiteDefaultLanguage = JComponentHelper::getParams('com_languages')->get('site'); 
$lang_code_partials = explode("-", $frontendsiteDefaultLanguage);
$lang_prefix = array_shift($lang_code_partials);

// Set language strings
$mail_settings['admin_lang'] = $lang_prefix;
$default_language_tokens = $lang_prefix;
$cli_language = $lang_prefix;
if ( $lang_prefix == 'en') {$faqfilelang = ''; } else { $faqfilelang = '_' . $lang_prefix; }

//Time
if ($timezoneUser) {$timezone = $timezoneUser;} else {$timezone = $timezoneSystem;}
date_default_timezone_set($timezone);

/************************************************************
 * Some checks if the bridge can work.
 ************************************************************/
$manual = "<br><br><br>TIP: <i>Check <a href='https://github.com/Syndes/Joomla-MRBS-Bridge' target='_blank'>Joomla MRBS Bridge website</a> for more information</i>";

if ($debug == 1) {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	echo "PHP Error = ON<br>";
}

// +---------------------------------------------------------+
//Remove unnecessary old files and folders
	$fileArray = array(
	    "./auth/auth_jm_aid.inc",
	    "./auth/auth_jm_gid.inc",
	    "./joomla/jm_helper.php"
	);
	
	foreach ($fileArray as $value) {
	    if (file_exists($value)) { unlink($value); }
	}
	if (is_dir("joomla")) { rmdir("joomla"); }

// +---------------------------------------------------------+

// +---------------------------------------------------------+
//Check for using old files

	$string = "ocean12";
	function checkOld($file,$string) {
		global $manual;
	    if (file_exists($file)) {
	    	$pos = strpos( file_get_contents($file) , $string);
		    if ($pos) {
				echo "Your using the wrong version of '$file' <br/><br/> Update your suft <br/><br/>";
		        echo $manual;
		        exit;
		    }
		}
	}
	checkOld('./language.inc',$string);
	checkOld('./functions_mail.inc',$string);

// +---------------------------------------------------------+
// Check all necessary files

	$string = "ocean12";
	function checkFiles($file,$string) {
		global $manual;
	    if (file_exists($file)) {
	    	$pos = strpos( file_get_contents($file) , $string);
		    if (!$pos) {
		        echo "Please reinstall the bridge. Missing files: '$file'";
		        echo $manual;
		        exit;
		    }
		}
	    if (!file_exists($file) && $file != './config.inc.overrides.php') {
	        echo "Please reinstall the bridge. Missing files: '$file'";
	        echo $manual;
	        exit;
		}

	}
	checkFiles('./config.inc.php',$string);
	checkFiles('./config.inc.overrides.ph_.php',$string);
	checkFiles('./config.inc.overrides.php',$string);
	checkFiles('./auth/auth_jm.inc',$string);
	checkFiles('./session/session_jm.inc',$string);


// +---------------------------------------------------------+
// Check all necessary files

	if (file_exists("config.inc.overrides.php.php")) {
		echo "Your using the wrong name for the override file. <br/><br/> Please read the manual <br/><br/>";
        echo $manual;
        exit;
	}


// +---------------------------------------------------------+
// Minimum requered
	$php_version_min = '5.4.0';
	$mrbs_version_min = '1.5.0';
	$joomla_version_min = '3.4.8';
	$bridge_version_min = '1.5.1';
	
	function checkVersion($version_min,$version,$requered) {
		global $manual;
		if ( version_compare($version, $version_min, "<=") AND !version_compare($version, $version_min, "=") ) { 
			echo "Sorry, wrong version of " . $requered . "<br/><br/>";
			echo "Please upgrade to a version newer then <b>" . $version_min . "</b>" ;
	        echo $manual;
			exit;
		}
	}
	
	// Check for correct PHP version.
		checkVersion($php_version_min,phpversion(),'PHP');
	
	// Check for correct MRBS version.
		require_once('version_num.inc');
		checkVersion($mrbs_version_min,$mrbs_version_number,'MRBS');
	
	// Check for correct Joomla version 2.5 and higher
		$joomlaVersion = new JVersion();
		$joomla_version = $joomlaVersion->getShortVersion();
		checkVersion($joomla_version_min,$joomla_version,'Joomla');
	
	// Check for correct Bridge version.
		require_once('config.inc.php');
		checkVersion($bridge_version_min,$bridge_version_number,'Bridge');
	
	// Check for correct Joomla version 1.5
		if (file_exists('../libraries/joomla/version.php')) {
			echo "Sorry, wrong version of Joomla <br/><br/>
			You are using probably Joomla 1.7.x or older. <br/>
			If not maybe the update to a newer version has not gone well. <br/><br/>
			Please upgrade to a version newer then <b>" . $joomla_version_min . "</b>" ;
	        echo $manual;
			exit;
		}

// +---------------------------------------------------------+
// Check if language file has been changed.
	$string = "option=com_users";
	function checkLang($file,$string) {
		global $manual;
	    if (file_exists($file)) {
	    	$pos = strpos( file_get_contents($file) , $string);
		    if (!$pos) {
		        echo "Please update your language file. We are missing the login option in file: '$file'";
		        echo $manual;
		        exit;
		    }
		}
	}
	checkLang('./lang/lang.en',$string);
	checkLang('./lang/lang.' . $lang_prefix ,$string);
	



