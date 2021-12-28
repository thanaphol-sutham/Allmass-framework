<?php


$develop = true;


if ($develop == true) {
    define("_DB_CHARSET_",    'UTF-8');
    define("_DB_TYPE_",        'mysqli'); //mysql or mysqli or mysqlpdo
    define("_DB_PORT_",        '3306');
    define("_DB_HOSTNAME_", 'localhost'); //host
    define("_DB_USERNAME_", 'root');
    define("_DB_PASSWORD_", '');
    define("_DB_NAME_", 'oyura');
} else {
    ## DATABASE #################################################
    $arrda = array();
    $arrda["APIKEY"] = _APP_KEY_;
    $arrda["TEXT"] = _DATABASE_KEY_;
    $datadecode = decodeAPPData($arrda);
    unset($arrda);

    define("_DB_CHARSET_",    'UTF-8');
    define("_DB_TYPE_",        'mysqli'); //mysql or mysqli or mysqlpdo
    define("_DB_PORT_",        $datadecode->option["PORT"]);
    define("_DB_HOSTNAME_", $datadecode->option["HOST"]); //host
    define("_DB_USERNAME_", $datadecode->option["DBUSER"]);
    define("_DB_PASSWORD_", $datadecode->option["DBPASS"]);
    define("_DB_NAME_", $datadecode->option["DBNAME"]);

    define("_UserRoot_", $datadecode->option["ROOTUSER"]);
    define("_PasswordRoot_", $datadecode->option["ROOTPASS"]);
}
