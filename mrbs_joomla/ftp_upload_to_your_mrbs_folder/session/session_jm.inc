<?php
/*********************************************************************************************
*                                                                                            * 
*   File name       session_jm.inc                                                           * 
*                                                                                            * 
*   Description     Authenticate users for joomla 2.5 - accesslevel                          *
*                                                                                            * 
*   Notes           To use this authentication scheme, set in config.inc.php                 *
*                                                                                            *
*                       $auth["session"]  = "jm";                                            *
*                                                                                            *         			
**********************************************************************************************/
//
// extra needs for Joomla mrbs_joomla_v1.5.1 ocean12 $
//


function authGet() { }


function getUserName() {
	return JFactory::getUser()->username;
}


function PrintLogonBox() {
	$username = JFactory::getUser()->name;
		if (isset($username)) { echo  get_vocab('you_are').": " . $username;}
	else { echo get_vocab('unknown_user');} 
}

