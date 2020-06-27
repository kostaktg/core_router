<?php


##Path vars
define('INCLUDE_DIR',               dirname(__FILE__).'/../');
define('ROOT_DIR',                  INCLUDE_DIR.'');

## APP
define('CONTROLLER_DIR',            'App/Controllers');
define('FRONTEND_CONTROLLER_DIR',   'App\Controllers\Frontend');
define('MODELS_DIR',                INCLUDE_DIR.'App/Models');
define('HELPERS_DIR',               INCLUDE_DIR.'App/Helpers');
## OTHERS
define('TEMPLATE_DIR',              ROOT_DIR.'templates/');
define('SITE_SUBDOMAIN_URL',        'lr/');
define('SITE_URL',                  'http://localhost/'.SITE_SUBDOMAIN_URL);
define('SITE_PUBLIC_URL',           SITE_URL.'public/');
define('SITE_IMAGES_URL',           SITE_PUBLIC_URL.'images/');
define('SITE_CSS_URL',              SITE_PUBLIC_URL.'css/');
define('SITE_JS_URL',               SITE_PUBLIC_URL.'js/');

##Smarty path vars
define('VIEW_DIR',                   'App/Views');
define('VIEW_DIR_COMPILE',           'templates_c');


## DB vars
define('DB_HOST',                    'localhost');
define('DB_USER',                    '');
define('DB_PASSWORD',                 '');
define('DB_NAME',                     '');

## PDO vars

