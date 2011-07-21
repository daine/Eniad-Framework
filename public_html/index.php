<?php
/*
 * Eniad Application Framework
 *
 * A small, lightweight framework usable for very very small web apps
 *
 * Copyright 2011 Daine Trinidad
 * 
 * This file is part of Eniad Application Framework.
 * 
 * Eniad Application Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Eniad Application Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Eniad Application Framework.  If not, see <http://www.gnu.org/licenses/>.
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

