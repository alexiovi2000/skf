<?php
function verifyUrlExist($my_url = '') {
/*
	echo '<pre> $my_url: ';
	print_r($my_url);
	echo '</pre>';

	$url = parse_url($my_url);
	echo '<pre> $url: ';
	print_r($url);
	echo '</pre>';
*/

	$url = parse_url($my_url);

	$host = isset($url['host']) ? $url['host'] : '';
	$port = isset($url['port']) ? $url['port'] : '';
	$path = isset($url['path']) ? $url['path'] : '';

	if(!$port) {
		$port = 80;
	}

	if(!$path) {
		$path = '/';
	}


	$request = "HEAD $path HTTP/1.1\r\n"
	           ."Host: $host\r\n"
			   ."Connection: close\r\n"
			   ."\r\n";
	$address = gethostbyname($host);
/*
pr('$host ' .$host);
pr('$port ' .$port);
pr('$path ' .$path);
pr('$address ' .$address);
*/

	$response_code = 0;
	$address_valid = false;

	if (preg_match( "/^(([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]).){3}([1-9]?[0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/", $address)) {
		$address_valid = true;
	}


	if ($address_valid) {

		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		socket_connect($socket, $address, $port);
		socket_write($socket, $request, strlen($request));
		$response = split(' ', socket_read($socket, 1024));
		socket_close($socket);
		$response_code = (isset($response[1]) && $response[1] == '200') ? 1 : 0;
	}

	return $response_code;
}


function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  //check ip from share internet
        $ip=$_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  //to check ip is pass from proxy
        $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


function getUserAgent() {

    return $_SERVER['HTTP_USER_AGENT'];

}


function shortString($string = '', $max_char = 0) {
	if ($string) {
		if ($max_char) {
			if (strlen($string) > $max_char) {
				$string = substr($string, 0, $max_char);
			}
		}
	}
	return $string;
}



function cleanTextUrl($string = '') {

	if ($string) {
		$string = preg_replace('/[^A-Za-z0-9-]/i', '-', $string);
		$string = preg_replace('/-[-]*/i', '-', $string);
		$string = trim($string, '-');
	}

	return $string;
}




function dateAdd($interval, $number, $date) {
    $date_time_array = getdate($date);
    $hours = $date_time_array['hours'];
    $minutes = $date_time_array['minutes'];
    $seconds = $date_time_array['seconds'];
    $month = $date_time_array['mon'];
    $day = $date_time_array['mday'];
    $year = $date_time_array['year'];
    switch ($interval) {

        case 'y':   // add year
            $year+=$number;
            break;

        case 'm':    // add month
            $month+=$number;
            break;

        case 'd':    // add days
            $day+=$number;
            break;

        case 'w':    // add week
            $day+=($number*7);
            break;

        case 'h':    // add hour
            $hours+=$number;
            break;

        case 'n':    // add minutes
            $minutes+=$number;
            break;

        case 's':    // add seconds
            $seconds+=$number;
            break;

    }
    $timestamp= mktime($hours,$minutes,$seconds,$month,$day,$year);
    return $timestamp;
}
// example - adds 10 days to current date
//$temptime = time();
//echo strftime('%Hh%M %A %d %b',$temptime);
//$temptime = DateAdd('d',10,$temptime);
//echo '<p>';
//echo strftime('%Hh%M %A %d %b',$temptime);

// example - adds 10 days to current date
//$temptime = $this->mysql2timestamp($user_logging['User']['date_expiry']);
//pr('$temptime pre ' . $temptime);
//pr('$temptime pre formatted ' . strftime('%Y-%m-%d',$temptime));

//$temptime = $this->DateAdd('d',10,$temptime);
//pr('$temptime post ' . $temptime);
//pr('$temptime pre formatted ' . strftime('%Y-%m-%d',$temptime));


function mysql2timestamp($datetime) {
       $val = explode(" ",$datetime);
       if (isset($val[0])) {
           $date = explode("-",$val[0]);
       } else {
            $date = array();
            $date[0] = '0000';
            $date[1] = '00';
            $date[2] = '00';
       }

       if (isset($val[1])) {
           $time = explode(":",$val[1]);
       } else {
            $time = array();
            $time[0] = '00';
            $time[1] = '00';
            $time[2] = '00';
       }

       return mktime($time[0],$time[1],$time[2],$date[1],$date[2],$date[0]);
}


function timestamp2mysql($temptime) {
    return strftime('%Y-%m-%d %H:%M:%S',$temptime);
}


function mysql2form($date){
	$date = explode('-', $date);                                    /*Split the string into an array with dd mm yyyy*/
	return $newdate = $date[2] . '/' . $date[1] . '/' . $date[0];   /*Compose the string as yyyy-mm-dd format*/
}



/**
 * Wrapper per formattare le date dei form di ricerca
 *
 * @param string $date campo contenente la data
 * @return string data formattata nel formato MySQL Y-m-d
 */

function convertSearchDateForMySQL($date){
	$date = explode('/', $date);                                    /*Split the string into an array with dd mm yyyy*/
	return $newdate = $date[2] . '-' . $date[1] . '-' . $date[0];   /*Compose the string as yyyy-mm-dd format*/
}



function check_pagination_sort($paginator, $sort_field) {
/*
echo '<br />$sort_field: ' . $sort_field;
echo '<br />$paginator->sortKey(): ' . $paginator->sortKey();
echo '<br />$paginator->sortDir(): ' . $paginator->sortDir();
*/

    if($paginator->sortKey() == $sort_field) {
		return ' class="paginator_sort_' . $paginator->sortDir() . '"';
    }


/*

$sort_key = $paginator->sortKey();
$sort_key_tmp = explode('.', $sort_key);

$sort_field_tmp = explode('.', $sort_field);



echo '<br />$sort_field: ' . $sort_field;
echo '<br />$sort_key: ' . $sort_key;
echo '<br />$sort_key_tmp[1]: ' . $sort_key_tmp[1];
echo '<br />$sort_field_tmp[1]: ' . $sort_field_tmp[1];

    if($sort_key == $sort_field) {
		return ' class="paginator_sort_' . $paginator->sortDir() . '"';
    }

	if (isset($sort_key_tmp[1]) && isset($sort_field_tmp[1])) {
	    if($sort_key_tmp[1] == $sort_field_tmp[1]) {
			return ' class="paginator_sort_' . $paginator->sortDir() . '"';
	    }
	}
*/

}


function numbers_to_stars ($number = 0) {
/*
	$stars = '';
	for ($i = 0; $i < $number; $i ++) {
		$stars .= '*';
	}
*/
	$stars = '<span class="star'. $number .'">&nbsp;</span>';
	return $stars;
}




/*
function format_number_csv_export($number) {
    $number = trim($number);
    $number = str_replace('.', ',', $number);
    return $number;
}


function format_number_csv_import($number) {
    $number = trim($number);
    $number = ereg_replace("[^.,0-9]", "", $number);
    $number = str_replace('.', '', $number);
    $number = str_replace(',', '.', $number);
    return $number;
}


function clean_csv_export($string) {
    $string = trim($string);
    $string = str_replace('"', '""', $string);
    $string = utf8_decode ($string);
    return $string;
}


function clean_csv_import($string) {
    $string = trim($string);
    $string = str_replace('""', '"', $string);
    $string = utf8_encode ($string);
    return $string;
}
*/

?>