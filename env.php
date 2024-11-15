<?php 
// Cấu hình file kết nối csdl
    const DBNAME = "du_an1_wb19306_chatgpt";
    const DBUSER = "root";
    const DBPASS = "";
    const DBHOST = "127.0.0.1";
    const DBCHARSET = "utf8";

    const BASE_URL = "http://localhost/Du_an1_Wd19306_Clinet_test/";


    function route($url) {
        return BASE_URL.$url;
    }

?>