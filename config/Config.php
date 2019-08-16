<?php 

    define('DEBUG', true); //controls error reporting

    define('DBHOST', '127.0.0.1');
    define('DBNAME', 'dbname');
    define('DBUSER', 'root');
    define('DBPASSWORD', '');
    
    define('DEFAULT_CONTROLLER', 'Home'); //default controller if no controller is set
    define('DEFAULT_LAYOUT', 'default'); //default layout if no layout is specified

    define('PROOT', '/root/'); //set this to '/' during production

    define('SITE_TITLE', 'Home'); //the default site title if the site title is not set

    define('USER_SESSION_NAME', '98dfje0sjasdiw00dfjaoijfa');
    define('USER_COOKIE_NAME', 'kdf939u83lkdkdl23jlsf3f7ys');
    define('USER_COOKIE_EXPIRY', time() + (86400 * 30));

?>