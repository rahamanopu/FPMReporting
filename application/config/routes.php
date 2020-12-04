<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "dashboard";
$route['404_override'] = '';
$route["setup/view-level(/:any)?"] = "Setup/viewLevel$1";
$route["setup/add-level/(:any)"] = "Setup/addLevel/$1";
$route["setup/store-level"] = "Setup/storeLevel";
$route["setup/distributor"] = "Setup/distributor";
$route["setup/distributor-data"] = "Setup/distributorData";
$route["setup/distributor-add(/:any)?"] = "Setup/addDistributor$1";

$route["setup/product"] = "Setup/product";
$route["setup/product-data"] = "Setup/productData";
$route["setup/product-add(/:any)?"] = "Setup/addProduct$1";
// Plant
$route["setup/plant(:num?)"] = "Setup/plant$1";
$route["setup/plant-data"] = "Setup/plantData";
$route["setup/plant-add"] = "Setup/addPlant";
// Department
$route["setup/department(:num?)"] = "Setup/department$1";
$route["setup/department-data"] = "Setup/departmentData";
$route["setup/department-add"] = "Setup/addDepartment";

$route['app-upload'] = 'Setup/appUpload';
$route['submit-app-upload'] = 'Setup/submitUpload';

// thana
$route["setup/thana(:num?)"] = "Setup/thana$1";
$route["setup/thana-data"] = "Setup/thanaData";
$route["setup/thana-add"] = "Setup/addThana";
$route["download-image/(:any)"] = "report/downloadImage/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */