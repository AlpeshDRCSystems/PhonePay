<?php

class Config {

    //defualt controller,which loads first.
    static $installed = true;
    static $defualt_controller = "admin";
    //directories
    static $dir_controllers = "controllers";
    static $dir_views = "views";
    static $dir_models = "models";
    static $dir_helper = "helper";
//base url eg: http://www.example.com
    static $base_url = "http://phonepay.dev";
    static $url_tail = ".php";
//database credentials
    static $db_host = "localhost";
    static $db_name = "phonepay";
    static $db_user = "root";
    static $db_password = "root";
    //stripe keys
    static $secret_key = "sk_test_lhd12QDQeGqlGhyPq4fvdpVh";
    static $public_key = "pk_test_hXlsAvJFIT3iQW1O8yof4q5K";

}

?>