<?php

# IP TO BLOCK
$iptoaccess = $_SERVER['REMOTE_ADDR'];

session_start();

# ERROR HANDLING
error_reporting(0);
ini_set('error_reporting', E_ALL-E_NOTICE);
ini_set('display_errors', 0);

# DATABASE CONNECTION
define("DBHOST", "localhost:3306"); 
define("DBUSER", "znettech_impuser");
define("DBPASS", "citi.2020");
define("DBNAME", "znettech_imperial");

//var_dump($comp);
define("SITENAME", "Citi Appliances CMS");
define("SYSTEMNAME", "Citi Appliances Content Management System");
define("WELCOME", "Welcome to Citi Appliances CMS");
define("COMPNAME", "Citi Appliances");

//var_dump(DBNAME);

$doc_root = dirname(__FILE__);

# WEB FOLDERS
define("ROOT", "http://plus5tech.com/citiapp/admin");
define("WEB", ROOT);
define("JS_WEB", WEB."/js");
define("PLUGINS_WEB", WEB."/plugins");
define("CSS", WEB."/dist/css");
define("IMG_WEB", WEB."/dist/img");
define("OBJ_WEB", WEB."/object");
define("TEMP_WEB", WEB."/template");

define("SROOT", "http://plus5tech.com/citiapp");
define("SWEB", SROOT);

define("DOCUMENT", $doc_root);
define("JS", DOCUMENT."/js");
define("LIB", DOCUMENT."/lib");
define("CLASSES", DOCUMENT."/lib/class");
define("REQUEST", DOCUMENT."/lib/request");
define("PLUGINS", DOCUMENT."/plugins");
define("IMG", DOCUMENT."/dist/img");
define("OBJ", DOCUMENT."/object");
define("TEMP", DOCUMENT."/template");

define("ADMIN_CONTACT", "");
define("TECH_CONTACT", "");
define("ADMIN_EMAIL", "admin@citiapp.com");

define("NOTIFICATION_EMAIL", "noreply@citiapp.com");

$sroot = ROOT;

# INCLUDE CLASS
include(CLASSES."/main.class.php");
include(CLASSES."/register.class.php");
include(CLASSES."/zebra.class.php");

# INITIATE CLASS
$main		 			= new main;
$register		 		= new register;
$zebra  		 		= new Zebra_Image();

# USER COOKIE
$usercook = unserialize($_COOKIE['imperial_cookie']);
$cookname = $usercook['user_name'];
define("COOKNAME", $cookname);

if (isset($_COOKIE['coreplus_cookie'])){
	$spot_cookie = 1;
	define("COOKNAME", strtoupper(COOKNAME));
	define("COOKNAME2", COOKNAME);
}

#DATE VARIABLE
date_default_timezone_set('UTC+8');

$date10year = date("Y-m-d", strtotime("-10 year"));
$date1year = date("Y-m-d", strtotime("-1 year"));
$date6month = date("Y-m-d", strtotime("-6 month"));
$date3month = date("Y-m-d", strtotime("-3 month"));
$date1month = date("Y-m-d", strtotime("-1 month"));
$date2week = date("Y-m-d", strtotime("-2 weeks"));
$date1week = date("Y-m-d", strtotime("-1 weeks"));
$date1day = date("Y-m-d", strtotime("-1 days"));
$datenow = date("Y-m-d");

$unix3month = date("U", strtotime("+3 month"));

define("UNIX3MONTH", $unix3month);

# PAGINATION
define("QS_VAR", "page"); // the variable name inside the query string (don't use this name inside other links)
define("STR_FWD", "&gt;"); // the string is used for a link (step forward)
define("STR_BWD", "&lt;"); // the string is used for a link (step backward)
define("NUM_LINKS", 5); // the number of links inside the navigation (the default value)
define("NUM_ROWS", 20);
define("PROD_NUM_ROWS", 20); // row numbers of notifications 
define("APPR_NUM_ROWS", 10); // row numbers of approvers management
define("MEMO_NUM_ROWS", 10); // row numbers of memo 
define("GAL_NUM_ROWS", 12);
define("DIR_NUM_ROWS", 20);
define("LOGS_NUM_ROWS", 15); // row numbers of logs

//WELCOME REMARKS
$welcome = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?";

//WEB FOOTER
$wfooter = "Should you have any questions regarding ".SITENAME." contents you can draft an email and send to <a href='mailto:".ADMIN_EMAIL."'>".ADMIN_EMAIL."</a>.<br>If you are encountering technical issues, please consult our Information Systems Management by sending an email to <a href='mailto:".ADMIN_EMAIL."'>".ADMIN_EMAIL."</a> with a clear description of the issue. For urgent assistance please call at ".TECH_CONTACT.".";

//DEFAULT TIME IN AND OUT
$def_timein = '08:30:00';
$def_timeout = '17:30:00';

$timearray = array("06:00:00"=>"6:00AM","06:30:00"=>"6:30AM","07:00:00"=>"7:00AM","07:30:00"=>"7:30AM","08:00:00"=>"8:00AM","08:30:00"=>"8:30AM","09:00:00"=>"9:00AM","09:30:00"=>"9:30AM","10:00:00"=>"10:00AM","10:30:00"=>"10:30AM","11:00:00"=>"11:00AM","11:30:00"=>"11:30AM","12:00:00"=>"12:00NN","12:30:00"=>"12:30PM","13:00:00"=>"1:00PM","13:30:00"=>"1:30PM","14:00:00"=>"2:00PM","14:30:00"=>"2:30PM","15:00:00"=>"3:00PM","15:30:00"=>"3:30PM","16:00:00"=>"4:00PM","16:30:00"=>"4:30PM","17:00:00"=>"5:00PM","17:30:00"=>"5:30PM","18:00:00"=>"6:00PM","18:30:00"=>"6:30PM","19:00:00"=>"7:00PM","19:30:00"=>"7:30PM","20:00:00"=>"8:00PM","20:30:00"=>"8:30PM","21:00:00"=>"9:00PM","21:30:00"=>"9:30PM","22:00:00"=>"10:00PM","22:30:00"=>"10:30PM","23:00:00"=>"11:00PM");

$nationals = 
array('Afghan', 'Albanian', 'Algerian', 'American', 'Andorran', 'Angolan', 'Antiguans', 'Argentinean', 'Armenian', 'Australian', 'Austrian', 'Azerbaijani', 'Bahamian', 'Bahraini', 'Bangladeshi', 'Barbadian', 'Barbudans', 'Batswana', 'Belarusian', 'Belgian', 'Belizean', 'Beninese', 'Bhutanese', 'Bolivian', 'Bosnian', 'Brazilian', 'British', 'Bruneian', 'Bulgarian', 'Burkinabe', 'Burmese', 'Burundian', 'Cambodian', 'Cameroonian', 'Canadian', 'Cape Verdean', 'Central African', 'Chadian', 'Chilean', 'Chinese', 'Colombian', 'Comoran', 'Congolese', 'Costa Rican', 'Croatian', 'Cuban', 'Cypriot', 'Czech', 'Danish', 'Djibouti', 'Dominican', 'Dutch', 'East Timorese', 'Ecuadorean', 'Egyptian', 'Emirian', 'Equatorial Guinean', 'Eritrean', 'Estonian', 'Ethiopian', 'Fijian', 'Filipino', 'Finnish', 'French', 'Gabonese', 'Gambian', 'Georgian', 'German', 'Ghanaian', 'Greek', 'Grenadian', 'Guatemalan', 'Guinea-Bissauan', 'Guinean', 'Guyanese', 'Haitian', 'Herzegovinian', 'Honduran', 'Hungarian', 'I-Kiribati', 'Icelander', 'Indian', 'Indonesian', 'Iranian', 'Iraqi', 'Irish', 'Israeli', 'Italian', 'Ivorian', 'Jamaican', 'Japanese', 'Jordanian', 'Kazakhstani', 'Kenyan', 'Kittian and Nevisian', 'Kuwaiti', 'Kyrgyz', 'Laotian', 'Latvian', 'Lebanese', 'Liberian', 'Libyan', 'Liechtensteiner', 'Lithuanian', 'Luxembourger', 'Macedonian', 'Malagasy', 'Malawian', 'Malaysian', 'Maldivan', 'Malian', 'Maltese', 'Marshallese', 'Mauritanian', 'Mauritian', 'Mexican', 'Micronesian', 'Moldovan', 'Monacan', 'Mongolian', 'Moroccan', 'Mosotho', 'Motswana', 'Mozambican', 'Namibian', 'Nauruan', 'Nepalese', 'New Zealander', 'Nicaraguan', 'Nigerian', 'Nigerien', 'North Korean', 'Northern Irish', 'Norwegian', 'Omani', 'Pakistani', 'Palauan', 'Panamanian', 'Papua New Guinean', 'Paraguayan', 'Peruvian', 'Polish', 'Portuguese', 'Qatari', 'Romanian', 'Russian', 'Rwandan', 'Saint Lucian', 'Salvadoran', 'Samoan', 'San Marinese', 'Sao Tomean', 'Saudi', 'Scottish', 'Senegalese', 'Serbian', 'Seychellois', 'Sierra Leonean', 'Singaporean', 'Slovakian', 'Slovenian', 'Solomon Islander', 'Somali', 'South African', 'South Korean', 'Spanish', 'Sri Lankan', 'Sudanese', 'Surinamer', 'Swazi', 'Swedish', 'Swiss', 'Syrian', 'Taiwanese', 'Tajik', 'Tanzanian', 'Thai', 'Togolese', 'Tongan', 'Trinidadian/Tobagonian', 'Tunisian', 'Turkish', 'Tuvaluan', 'Ugandan', 'Ukrainian', 'Uruguayan', 'Uzbekistani', 'Venezuelan', 'Vietnamese', 'Welsh', 'Yemenite', 'Zambian', 'Zimbabwean');


$country = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");

$promo_type = array("Store", "Product");

$order_status = array(1 => array("Hold", "redbg"), 2 => array("Processing", "orangebg"), 3 => array("Ready for Delivery", "bluebg"), 4 => array("Shipping", "bluebg"), 8 => array("Invalid", "tealbg"), 9 => array("Delivered", "greenbg"));
$order_status2 = array(1 => array("Hold", "redbg"), 2 => array("Processing", "orangebg"), 3 => array("Ready for Pickup", "bluebg"), 4 => array("For Pickup", "bluebg"), 8 => array("Invalid", "tealbg"), 9 => array("Received", "greenbg"));

$user_typeval = array(1 => "Customer", 2 => "Product Manager", 3 => "Marketing", 5 => "HR", 6 => "Warehouse", 8 => "Admin");
$civil_status = array(1 => "Single", 2 => "Married", 3 => "Separated", 4 => "Divorce");
$refer_value = array(1 => "TV/Radio Ads", 2 => "Friends", 3 => "Print Ads", 4 => "Internet", 5 => "Other");
$content_type = array(1 => "About Us", 2 => "What's New", 3 => "Career", 4 => "Footer", 5 => "Privacy");
$user_type = array(1 => "Customer", 4 => "Subscriber Only", 9 => "Admin");

$model_month = array('01' => "January", '02' => "February", '03' => "March", '04' => "April", '05' => "May", '06' => "June", '07' => "July", '08' => "August", '09' => "September", '10' => "October", '11' => "November", '12' => "December");

$shipping_charge = 200;

// CONNECT TO DB
$con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
if (mysqli_connect_errno($con))
{
	echo "Failed to connect to database: " . mysqli_connect_error();
}
/*$con = mssql_connect(DBHOST, DBUSER, DBPASS);
if (!$con) {
    die('Something went wrong while connecting to database');
}*/

//EMAIL INIT
ini_set("SMTP", "mail.citiapp.com");                     
ini_set("smtp_port", "26");                     
ini_set("sendmail_from", "admin@citiapp.com");

?>