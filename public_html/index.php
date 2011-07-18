<?php
/*
 * Eniad Application Framework
 * Copyright Daine Trinidad 2011
 * A small, lightweight framework usable for very very small web apps
 */

/*
 * -----------------------------
 * APPLICATION ENVIRONMENT
 * -----------------------------
 */
    define('ENVIRONMENT', 'development');

/*
 * -----------------------------
 * ERROR REPORTING
 * -----------------------------
 */
    if(defined('ENVIRONMENT')){
        switch (ENVIRONMENT){
            case 'development':
               error_reporting(E_ALL);
               break;
            case 'testing':
            case 'production':
               error_reporting(0);
            break;
            
            default:
                exit("Environment is not set");
        }
    }
/*
 * -----------------------------
 * SYSTEM FOLDER
 * -----------------------------
 * Location of system files (must be a real path)
 */
    $system = '/web/eniad';
    
/*
 * -----------------------------
 * APPLICATION FOLDER
 * -----------------------------
 * This is where all the custom programming will occur
 */
    $application = 'application';
    
/*
 * -----------------------------
 * APPLICATION FOLDER
 * -----------------------------
 * This is where all the custom programming will occur
 */
    $default_controller = 'home';
   
/*
 * ----------------------------
 * CONTROLLERS FOLDER
 * ----------------------------
 */
    define('CONTROLLERS', 'controllers');
    
 /*
 * ----------------------------
 * MODELS FOLDER
 * ----------------------------
 */
    define('MODELS', 'models');
    
 /*
 * ----------------------------
 * VIEW FOLDER
 * ----------------------------
 */
    define('VIEWS', 'views');
 
 /*
 * ----------------------------------------
 * APPLICATION INITIAL CONFIGURATION FILE
 * ----------------------------------------
 * 
 */
    define('APP_INI', 'myfirstapp.ini');
    define('BASE_PATH', realpath('../'));
    define('SYSTEM_PATH', $system);
    define('APP_PATH', BASE_PATH.'/'.$application);
    define('DEFAULT_CONTROLLER', $default_controller);
    
    require_once( SYSTEM_PATH.'/core.php' );
?>

