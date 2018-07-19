<?php

$url_query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

print_r($url_query);

//string($url_query);



switch ($url_query) {
    case 'teste=m77':
        Header( "HTTP/1.1 301 Moved Permanently" );
        Header( "Location: http://localhost/teste.php?test=abc" );
        break;

    case 'strstr($url, "teste=m69", true)':
        Header( "HTTP/1.1 301 Moved Permanently" );
        Header( "Location: http://localhost/teste.php?test=123" );
        break;
    
    default:
        # code...
        break;
}
