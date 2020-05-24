<?php
// require_once 'Config.php';

function __autoload($cname){
    require_once 'Config/Config.php';

    $coreClasses          = INCLUDE_DIR.$cname.'.php';


    /** CORE CLASSES */
    if ( file_exists(str_replace('\\','/', $coreClasses)) ){
        require_once str_replace('\\','/',$coreClasses);
    }


    /** ROURTERS */
    if(file_exists(str_replace('\\','/',INCLUDE_DIR.'App/Routes/Frontend/Routes.php')) ){
        require_once INCLUDE_DIR.'App/Routes/Frontend/Routes.php';
    } 
    if(file_exists(str_replace('\\','/',INCLUDE_DIR.'App/Routes/Backend/Routes.php')) ){
        require_once INCLUDE_DIR.'App/Routes/Backend/Routes.php';
    }


        unset($coreClasses);

}

spl_autoload_register('__autoload');