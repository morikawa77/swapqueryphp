<?php
// get url requested
$url = $_SERVER['REQUEST_URI'];

// break url apart
$url_scheme = parse_url($url, PHP_URL_SCHEME); // http or https
$url_host = parse_url($url, PHP_URL_HOST); // url.com
$url_path = parse_url($url, PHP_URL_PATH); // /folder1/folder2
$url_query = parse_url($url, PHP_URL_QUERY); // ?parameter=value
$url_fragment = parse_url($url, PHP_URL_FRAGMENT); // #anchor

// convert $url_query string in an array
$query_params = explode("&", $url_query);

// get params to change from a json file
$json_file = 'params.json';

// convert json to an array
$url_params = json_decode(file_get_contents($json_file), true);

// if url has params (is not null or empty)
if (strlen($url_query) !== 0) {
    // for each url_param
    foreach ($query_params as $k => $v){
        // for each query_param
        foreach($url_params as $key => $value) {
            // if actual key is in url_query
            if (in_array($key, $query_params)) {
                // get array position of this key
                $pos = array_search($key, $url_query);
                // swap the value with the new param
                array_splice($query_params, $pos, 1, $value);
                // create string with array $query_params
                $new_url_query = implode("&",$query_params);
                // assembly new url
                $new_url = $url_scheme . $url_host . $url_path .  $url_fragment . '?'. $new_url_query;
                // redirect page to a url with new param
                Header( "HTTP/1.1 301 Moved Permanently" );
                Header( "Location: $new_url" );
            }
        }
    }
} else {
    echo 'This url has no params. It will not redirect.';
}


