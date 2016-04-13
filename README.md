# Joomla-MRBS-Bridge

Bridge between Joomla and MRBS


Minimum Required
-------------------------

Joomla 3.4.6

MRBS 1.5.x

mrbs_joomla_v1.5.1

PHP version 5.4.x


End of Support
-------------------------
Joomla 2.5.x

PHP version 5.3.x


Installation
-------------------------

- Upload MRBS
- Please read the INSTALL file from MRBS (http://mrbs.sourceforge.net/docs.php)
- When MRBS is working, follow our installation guide “readme.txt”.
- Off course Joomla must also work properly first!



Installation bridge
-------------------------

* NOTE: This bridge can NOT be installed by using the installer from joomla, use FTP *

1) Install Joomla - test if Joomla is working correctly

2) Enable the “User Profile” plugin in Joomla

3) Install MRBS - test if MRBS is working correctly It must be a subfolder of your Joomla installation.

4) Is Joomla still working?

5) Try to make a booking in MRBS.

6) upload files from FTP_UPLOAD to the MRBS folder (merge and override current files)

7) When you are using SMTP email in Joomla then the MRBS mail will also working. When you want to use a different mail-setup please read the MRBS manual.

8) Changing the line $vocab["norights"] in your own language file

   find:
   ```
   $vocab["norights"] = "You do not have the necessary rights to view this page.";
   ```

   change to:
   
   ```
   $vocab["norights"] = "
      You are not authorized to modify this entry.
      <p class='login_reg'>
      <a class='login' href='../index.php?option=com_users&amp;view=login' TARGET='_parent' id='btnLogin'>Login</a> or
      <a class='registration' href='../index.php?option=com_users&amp;view=registration' TARGET='_parent' >Register</a>
      </p>
      ";
   ```

9) Email settings must done in Joomla Global Configuration, for example with Gmail use:
	
  ```
  Mailer = smtp
  From email = admin mail
  From Name = you website name
  Sendmail Path = /usr/sbin/sendmail
  SMTP Authentication = Yes
  SMTP Security = SSL
  SMTP Port = 465
  SMTP Username = name@gmail.com or name@company_name_gmal_apps.com
  SMTP Password = ******
  SMTP Host = smtp@gmail.com
  ```

10) Edit the minimum group level in the config.inc.php file. Check in Joomla what the ID’s level numbers are. ../administrator/index.php?option=com_users&view=groups

11) Put your own needs in config.inc.overrides.php file. When there are updates for the MRBS bridge you still have your own settings after updating.



## Common errors
-------------------------

> Notice: Undefined property: JObject::$profile in ../joomla.php on line 69

Did you switch on the user profile plugin?

> Warning: Save failed with the following error: A first level menu item alias can't be 'mrbs' because 'mrbs' is a sub-folder of your joomla installation folder.

To add a menu in Joomla with the same alias as the subfolder can give an error. Use a different name for the menu item or change the folder name for MRBS. 

> Fatal error: unfortunately the database is not available at the moment.

When this happens after uploading the bridge files you did it wrong, please do not override subfolders you must merge them. Did you install the MRBS database in the same database as Joomla? Please install MRBS in the same database.

> Warning: Server failed to set locale to ‘xx_XX.UTF-8']

Search for override_locale settings to solve the problem

