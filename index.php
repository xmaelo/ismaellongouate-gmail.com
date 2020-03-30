<?php



function lister($chemin)
{
   echo '<u>Contenu du dossier '.$chemin.'</u><br><blockquote>';
   
   //nom du r?pertoire ? lister
   $nom_repertoire = $chemin;
   
   //on ouvre un pointeur sur le repertoire
   $pointeur = opendir($nom_repertoire);
   
   //pour chaque fichier et dossier
   while ($fichier = readdir($pointeur))
   {
      //on ne traite pas les . et ..
      if(($fichier != '.') && ($fichier != '..'))
      {
         //si c'est un dossier, on le lit
         // if (is_dir($nom_repertoire.'/'.$fichier))
         // {
         //    echo '<blockquote>'; 
         //    lister($nom_repertoire.'/'.$fichier);
         //    echo '</blockquote>';
         // }
         // else
         // {
            //c'est un fichier, on l'affiche
         // }
      }
            echo $fichier.'<br>';
   }
   echo '</blockquote><u>Fin du dossier '.$nom_repertoire.'</u><br>';
   
   //fermeture du pointeur
   closedir($pointeur);
}
lister(__DIR__);
die();





/**
 * DO NOT EDIT THIS FILE!
 * Make a copy of the ipconfig.php.example file, rename the copy to 'ipconfig.php' and set your settings in this file
 */

/*
 *---------------------------------------------------------------
 * LOAD DOTENV 
 *---------------------------------------------------------------
 */

if (!file_exists('ipconfig.php')) {
    exit("The <b>ipconfig.php</b> file is missing! Please make a copy of the <b>ipconfig.php.example</b> file and rename it to <b>ipconfig.php</b>");
}

require('vendor/autoload.php');
$dotenv = new \Dotenv\Dotenv(__DIR__, 'ipconfig.php');
$dotenv->load();

/**
 * Small helper function to allow defaults for the getenv function
 *
 * @param string $env_key
 * @param mixed $default
 *
 * @return mixed
 */
function env($env_key, $default = null)
{
    return getenv($env_key) ? getenv($env_key) : $default;
}

/**
 * Small helper function to get bool values for the env setting
 *
 * @param string $env_key
 * @param boolean $default
 *
 * @return bool
 */
function env_bool($env_key, $default = false)
{
    return env($env_key, $default) === 'true' ? true : false;
}

// Enable debug mode if set
define('IP_DEBUG', env_bool('ENABLE_DEBUG'));
define('SUMEX_URL', env('SUMEX_URL'));

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */
switch (ENVIRONMENT) {
    case 'development':
        error_reporting(-1);
        ini_set('display_errors', 1);
        break;

    case 'testing':
    case 'production':
        ini_set('display_errors', 0);
        if (version_compare(PHP_VERSION, '5.3', '>=')) {
            error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
        } else {
            error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
        }
        break;

    default:
        header('HTTP/1.1 503 Service Unavailable.', true, 503);
        echo 'The application environment is not set correctly.';
        exit(1); // EXIT_ERROR
}

/*
 *---------------------------------------------------------------
 * SYSTEM DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" directory.
 * Set the path if it is not in the same directory as this file.
 */
$system_path = 'vendor/codeigniter/framework/system';

/*
 *---------------------------------------------------------------
 * APPLICATION DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * directory than the default one you can set its name here. The directory
 * can also be renamed or relocated anywhere on your server. If you do,
 * use an absolute (full) server path.
 * For more info please see the user guide:
 *
 * https://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 */
$application_folder = 'application';

/*
 *---------------------------------------------------------------
 * VIEW DIRECTORY NAME
 *---------------------------------------------------------------
 *
 * If you want to move the view directory out of the application
 * directory, set the path to it here. The directory can be renamed
 * and relocated anywhere on your server. If blank, it will default
 * to the standard location inside your application directory.
 * If you do move this, use an absolute (full) server path.
 *
 * NO TRAILING SLASH!
 */
$view_folder = '';


/*
 * --------------------------------------------------------------------
 * DEFAULT CONTROLLER
 * --------------------------------------------------------------------
 *
 * Normally you will set your default controller in the routes.php file.
 * You can, however, force a custom routing by hard-coding a
 * specific controller class/function here. For most applications, you
 * WILL NOT set your routing here, but it's an option for those
 * special instances where you might want to override the standard
 * routing in a specific front controller that shares a common CI installation.
 *
 * IMPORTANT: If you set the routing here, NO OTHER controller will be
 * callable. In essence, this preference limits your application to ONE
 * specific controller. Leave the function name blank if you need
 * to call functions dynamically via the URI.
 *
 * Un-comment the $routing array below to use this feature
 */
// The directory name, relative to the "controllers" directory.  Leave blank
// if your controller is not in a sub-directory within the "controllers" one
// $routing['directory'] = '';

// The controller class file name.  Example:  mycontroller
// $routing['controller'] = '';

// The controller function you wish to be called.
// $routing['function']	= '';


/*
 * -------------------------------------------------------------------
 *  CUSTOM CONFIG VALUES
 * -------------------------------------------------------------------
 *
 * The $assign_to_config array below will be passed dynamically to the
 * config class when initialized. This allows you to set custom config
 * items or override any default config values found in the config.php file.
 * This can be handy as it permits you to share one application between
 * multiple front controller files, with each file containing different
 * config values.
 *
 * Un-comment the $assign_to_config array below to use this feature
 */
// $assign_to_config['name_of_config_item'] = 'value of config item';


// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */

// Set the current directory correctly for CLI requests
if (defined('STDIN')) {
    chdir(dirname(__FILE__));
}

if (($_temp = realpath($system_path)) !== false) {
    $system_path = $_temp . DIRECTORY_SEPARATOR;
} else {
    // Ensure there's a trailing slash
    $system_path = strtr(
            rtrim($system_path, '/\\'),
            '/\\',
            DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR
        ) . DIRECTORY_SEPARATOR;
}

// Is the system path correct?
if (!is_dir($system_path)) {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo 'Your system folder path does not appear to be set correctly. Please open the following file and correct this: ' . pathinfo(__FILE__,
            PATHINFO_BASENAME);
    exit(3); // EXIT_CONFIG
}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// Path to the system directory
define('BASEPATH', $system_path);

// Path to the front controller (this file) directory
define('FCPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

// Name of the "system" directory
define('SYSDIR', basename(BASEPATH));

// The path to the "application" directory
if (is_dir($application_folder)) {

    if (($_temp = realpath($application_folder)) !== false) {
        $application_folder = $_temp;
    } else {
        $application_folder = strtr(
            rtrim($application_folder, '/\\'),
            '/\\',
            DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR
        );
    }

} elseif (is_dir(BASEPATH . $application_folder . DIRECTORY_SEPARATOR)) {

    $application_folder = BASEPATH . strtr(
            trim($application_folder, '/\\'),
            '/\\',
            DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR
        );

} else {

    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo 'Your application folder path does not appear to be set correctly. Please open the following file and correct this: ' . SELF;
    exit(3); // EXIT_CONFIG

}

define('APPPATH', $application_folder . DIRECTORY_SEPARATOR);

// The path to the "views" directory
if (!isset($view_folder[0]) && is_dir(APPPATH . 'views' . DIRECTORY_SEPARATOR)) {
    $view_folder = APPPATH . 'views';
} elseif (is_dir($view_folder)) {
    if (($_temp = realpath($view_folder)) !== false) {
        $view_folder = $_temp;
    } else {
        $view_folder = strtr(
            rtrim($view_folder, '/\\'),
            '/\\',
            DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR
        );
    }
} elseif (is_dir(APPPATH . $view_folder . DIRECTORY_SEPARATOR)) {
    $view_folder = APPPATH . strtr(
            trim($view_folder, '/\\'),
            '/\\',
            DIRECTORY_SEPARATOR . DIRECTORY_SEPARATOR
        );
} else {
    header('HTTP/1.1 503 Service Unavailable.', true, 503);
    echo 'Your view folder path does not appear to be set correctly. Please open the following file and correct this: ' . SELF;
    exit(3); // EXIT_CONFIG
}


define('IPCONFIG_FILE', FCPATH . 'ipconfig.php');

define('LOGS_FOLDER', APPPATH . 'logs' . DIRECTORY_SEPARATOR);

define('UPLOADS_FOLDER', FCPATH . 'uploads' . DIRECTORY_SEPARATOR);
define('UPLOADS_ARCHIVE_FOLDER', UPLOADS_FOLDER . 'archive' . DIRECTORY_SEPARATOR);
define('UPLOADS_CFILES_FOLDER', UPLOADS_FOLDER . 'customer_files' . DIRECTORY_SEPARATOR);
define('UPLOADS_TEMP_FOLDER', UPLOADS_FOLDER . 'temp' . DIRECTORY_SEPARATOR);
define('UPLOADS_TEMP_MPDF_FOLDER', UPLOADS_TEMP_FOLDER . 'mpdf' . DIRECTORY_SEPARATOR);

define('VIEWPATH', $view_folder . DIRECTORY_SEPARATOR);
define('THEME_FOLDER', FCPATH . 'assets' . DIRECTORY_SEPARATOR);

/**
 * Automatic temp pdf cleanup
 */
array_map('unlink', glob(UPLOADS_TEMP_FOLDER . '*.pdf'));
array_map('unlink', glob(UPLOADS_TEMP_FOLDER . '*_zugferd.xml'));

/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 */
require_once BASEPATH . 'core/CodeIgniter.php';  
