<?php

class Constants {
    public static $EMPTY_STRING = "";

    // PROD or LOCAL
    public static $ENV = "LOCAL";
    //Vide en local - Prefixe suivi de _ en Prod
    public static $TABLE_PREFIX = "";

    public static $SUCCES_CODE = "SUCCES";
    public static $WARNING_CODE = "WARNING";
    public static $ERROR_CODE = "ERROR";

    public static $PROD_BD_CONFIG = array(
        "host" => "185.98.131.90",
        "user" => "djste1070339",
        "password" => "da6ysjpqpp",
        "bdname" => "djste1070339"
    );

    public static $LOCAL_BD_CONFIG = array(
         "host" => "localhost",
         "user" => "root",
         "password" => "root",
          "bdname" => "authent_security"
    );

}

?>
