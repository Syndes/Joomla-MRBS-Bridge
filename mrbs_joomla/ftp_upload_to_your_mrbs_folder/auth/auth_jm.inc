<?php
/*********************************************************************************************
*                                                                                            * 
*   File name       auth_db_jm.inc                                                           * 
*                                                                                            * 
*   Description     Authenticate users for joomla - grouplevel                               *
*                                                                                            * 
*   Notes           To use this authentication scheme, set in config.inc.php:                *
*                                                                                            *         			
**********************************************************************************************/
//
// extra needs for Joomla mrbs_joomla_v1.5.1 ocean12 $
//


function authGetUserLevel($user)
{
  global $usergids,$min_manager_level;

  // User not logged in, user level '0'
  if(!isset($user))
  {
    return 0;
  }

  // Check if the user is can modify
	if(is_array($min_manager_level) && count($min_manager_level) > 0)
	{
		$result_gid_manager = array_intersect($min_manager_level, $usergids);
		if (is_array($result_gid_manager) && count($result_gid_manager) > 0){
			return 2;
		}
	}


  // Everybody else is access level '1'
  return 1;
}


// Gets the user's email address.   Returns an empty
// string if one can't be found
function authGetUserEmail($user)
{
  global $usermail;
  
  if (!isset($user) || $user === '')
  {
    return '';
  }
         
  $email = $usermail;
  
  if ($email == -1)
  {
    $sql_error = sql_error();
    if (!empty($sql_error))
    {
      // It's possible that sql_query1 returned -1 because there were no matching rows,
      // so we only trigger an error if there was a genuine SQL error.
      trigger_error($sql_error, E_USER_WARNING);
    }
    $email = '';
  }
  
  return $email;
}




?>
