<?php
// Function to get the client IP address
function get_client_ip() {
    $ipaddress = '';
    if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = "HTTP_X_FORWARDED_FOR = ".getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = "HTTP_X_FORWARDED = ".getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = "HTTP_FORWARDED_FOR = ".getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = "HTTP_FORWARDED = ".getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = "REMOTE_ADDR = ".getenv('REMOTE_ADDR');
    else  if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = "HTTP_CLIENT_IP = ".getenv('HTTP_CLIENT_IP');
    else    
        $ipaddress = 'UNKNOWN';

    return "this ".$ipaddress;
}

function agent () {
    $ua_info = parse_user_agent();
    $agent = array("platform" => $ua_info['platform'], "browser" => $ua_info['browser']." (".$ua_info['version'].")");
    return $agent;
}

function TimeDiff($strTime1, $strTime2)
{
    return (strtotime($strTime2) - strtotime($strTime1))/  ( 60 * 60 ); // 1 Hour =  60*60
}

?>