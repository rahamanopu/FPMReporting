<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/
if (!defined('DB_SERVER_CET')) define('DB_SERVER_CET', "192.168.100.75");
if (!defined('DB_SERVER_DCR')) define('DB_SERVER_DCR', "192.168.100.75");
if (!defined('DB_SERVER_PIMS')) define('DB_SERVER_PIMS', "192.168.100.2");
if (!defined('DB_SERVER_Matplan')) define('DB_SERVER_Matplan', "192.168.100.90");
if (!defined('DB_SERVER_SDMS')) define('DB_SERVER_SDMS', "192.168.100.90");

if (!defined('DB_DB_CET')) define('DB_DB_CET', "FPM");
if (!defined('DB_DB_DCR')) define('DB_DB_DCR', "DCR");
if (!defined('DB_DB_PIMS')) define('DB_DB_PIMS', "PIMSNEW");
if (!defined('DB_DB_Matplan')) define('DB_DB_Matplan', "MatPlan");
if (!defined('DB_DB_SDMS')) define('DB_DB_SDMS', "sdms");

if (!defined('DB_CONSTRING_CET'))define('DB_CONSTRING_CET', "DRIVER={SQL Server};SERVER=".DB_SERVER_CET.";DATABASE=".DB_DB_CET);
if (!defined('DB_CONSTRING_DCR'))define('DB_CONSTRING_DCR', "DRIVER={SQL Server};SERVER=".DB_SERVER_DCR.";DATABASE=".DB_DB_DCR);
if (!defined('DB_CONSTRING_PIMS'))define('DB_CONSTRING_PIMS', "DRIVER={SQL Server};SERVER=".DB_SERVER_PIMS.";DATABASE=".DB_DB_PIMS);
if (!defined('DB_CONSTRING_Matplan'))define('DB_CONSTRING_Matplan', "DRIVER={SQL Server};SERVER=".DB_SERVER_Matplan.";DATABASE=".DB_DB_Matplan);
if (!defined('DB_CONSTRING_SDMS'))define('DB_CONSTRING_SDMS', "DRIVER={SQL Server};SERVER=".DB_SERVER_SDMS.";DATABASE=".DB_DB_SDMS);


$active_group = 'default';
$active_record = TRUE;
$db['default']['hostname'] = DB_CONSTRING_CET;
$db['default']['username'] = "sa";
$db['default']['password'] = "dataport";
$db['default']['database'] = DB_DB_CET;
$db['default']['dbdriver'] = "odbc";
$db['default']['dbprefix'] = "";
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = "";
$db['default']['char_set'] = "utf8";
$db['default']['dbcollat'] = "utf8_general_ci";
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = FALSE;
$db['default']['stricton'] = FALSE;

$db['dcr']['hostname'] = DB_CONSTRING_DCR;
$db['dcr']['username'] = "sa";
$db['dcr']['password'] = "dataport";
$db['dcr']['database'] = DB_DB_DCR;
$db['dcr']['dbdriver'] = "odbc";
$db['dcr']['dbprefix'] = "";
$db['dcr']['pconnect'] = FALSE;
$db['dcr']['db_debug'] = TRUE;
$db['dcr']['cache_on'] = FALSE;
$db['dcr']['cachedir'] = "";
$db['dcr']['char_set'] = "utf8";
$db['dcr']['dbcollat'] = "utf8_general_ci";
$db['dcr']['swap_pre'] = '';
$db['dcr']['autoinit'] = FALSE;
$db['dcr']['stricton'] = FALSE;


$db['PIMS']['hostname'] = DB_CONSTRING_PIMS;
$db['PIMS']['username'] = "sa";
$db['PIMS']['password'] = "dataport";
$db['PIMS']['database'] = DB_SERVER_PIMS;
$db['PIMS']['dbdriver'] = "odbc";
$db['PIMS']['dbprefix'] = "";
$db['PIMS']['pconnect'] = FALSE;
$db['PIMS']['db_debug'] = TRUE;
$db['PIMS']['cache_on'] = FALSE;
$db['PIMS']['cachedir'] = "";
$db['PIMS']['char_set'] = "utf8";
$db['PIMS']['dbcollat'] = "utf8_general_ci";
$db['PIMS']['swap_pre'] = '';
$db['PIMS']['autoinit'] = FALSE;
$db['PIMS']['stricton'] = FALSE;


$db['Matplan']['hostname'] = DB_CONSTRING_Matplan;
$db['Matplan']['username'] = "sa";
$db['Matplan']['password'] = "dataport";
$db['Matplan']['database'] = DB_DB_Matplan;
$db['Matplan']['dbdriver'] = "odbc";
$db['Matplan']['dbprefix'] = "";
$db['Matplan']['pconnect'] = FALSE;
$db['Matplan']['db_debug'] = TRUE;
$db['Matplan']['cache_on'] = FALSE;
$db['Matplan']['cachedir'] = "";
$db['Matplan']['char_set'] = "utf8";
$db['Matplan']['dbcollat'] = "utf8_general_ci";
$db['Matplan']['swap_pre'] = '';
$db['Matplan']['autoinit'] = FALSE;
$db['Matplan']['stricton'] = FALSE;


$db['sdms']['hostname'] = DB_CONSTRING_SDMS;
$db['sdms']['username'] = "sa";
$db['sdms']['password'] = "dataport";
$db['sdms']['database'] = DB_DB_SDMS;
$db['sdms']['dbdriver'] = "odbc";
$db['sdms']['dbprefix'] = "";
$db['sdms']['pconnect'] = FALSE;
$db['sdms']['db_debug'] = TRUE;
$db['sdms']['cache_on'] = FALSE;
$db['sdms']['cachedir'] = "";
$db['sdms']['char_set'] = "utf8";
$db['sdms']['dbcollat'] = "utf8_general_ci";
$db['sdms']['swap_pre'] = '';
$db['sdms']['autoinit'] = FALSE;
$db['sdms']['stricton'] = FALSE;
 
/* End of file database.php */
/* Location: ./application/config/database.php */
