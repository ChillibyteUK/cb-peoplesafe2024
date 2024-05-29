<?php
require_once('../../../../wp-config.php');

$request_host = 'https://sandbox.ddprocessing.co.uk';
$request_path = '/api/ddi/adhoc/create';

$user         = "peoplesafe2apitest";
$password     = "bMMiX2nuzq!fGH";

$options      = array(
    CURLOPT_RETURNTRANSFER => true, // return web page
    CURLOPT_HEADER => false, // don't return headers
    CURLOPT_POST => true,
    CURLOPT_USERPWD => $user . ":" . $password,
    CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
    CURLOPT_HTTPHEADER => array("Accept: application/XML"),
    CURLOPT_USERAGENT => "PeopleSafe Website Shop" // Let SmartDebit see who we are
);

$session      = curl_init($request_host . $request_path);
curl_setopt_array($session, $options);

// tell cURL to accept an SSL certificate if presented
if (preg_match("/^https/", $request_host)) {
    curl_setopt($session, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
}

// The request parameters
$pslid            = 'peoplesafetwotest';
$reference_number = "ABC1234516";
$payer_ref        = 'PHP-123451';
$first_name       = 'John1';
$last_name        = 'Smith1';
$address_1        = "123 Fake St";
$town             = "London";
$postcode         = "se3 3ed";
$country          = "United Kingdom";
$account_name     = "John Smith";
$sort_code        = "200000";
$account_number   = "55779911";
$regular_amount   = 1000;
$frequency_type   = "M";

// urlencode and concatenate the POST arguments
$postargs = 'adhoc_ddi[service_user][pslid]=' . $pslid;
$postargs .= "&adhoc_ddi[reference_number]=" . urlencode($reference_number);
$postargs .= '&adhoc_ddi[payer_reference]=' . urlencode($payer_ref);
$postargs .= '&adhoc_ddi[first_name]=' . urlencode($first_name);
$postargs .= '&adhoc_ddi[last_name]=' . urlencode($last_name);
$postargs .= '&adhoc_ddi[address_1]=' . urlencode($address_1);
$postargs .= '&adhoc_ddi[town]=' . urlencode($town);
$postargs .= '&adhoc_ddi[postcode]=' . urlencode($postcode);
$postargs .= '&adhoc_ddi[country]=' . urlencode($country);
$postargs .= '&adhoc_ddi[account_name]=' . urlencode($account_name);
$postargs .= '&adhoc_ddi[sort_code]=' . urlencode($sort_code);
$postargs .= '&adhoc_ddi[account_number]=' . urlencode($account_number);
//$postargs .= '&variable_ddi[regular_amount]=' . urlencode($regular_amount);
//$postargs .= '&variable_ddi[frequency_type]=' . urlencode($frequency_type);

// Tell curl that this is the body of the POST
curl_setopt($session, CURLOPT_POSTFIELDS, $postargs);

// $output contains the output string
$output = curl_exec($session);
$header = curl_getinfo($session);

if (curl_errno($session)) {
    echo 'Curl error: ' . curl_error($session);
} else {
    switch ($header["http_code"]) {
        case 200:
            echo "Success";
            echo "<pre>";
            print_r($output);
            echo "</pre>";
            echo "<pre>";
            print_r($header);
            echo "</pre>";
            break;
        default:
            echo "HTTP Error: " . $header["http_code"];
            echo "<pre>";
            print_r($output);
            echo "</pre>";
            echo "<pre>";
            print_r($header);
            echo "</pre>";
    }
}

// close curl resource to free up system resources
curl_close($session);

$result = wp_remote_post($url, array(
    'method' => 'POST',
    'headers' => $headers,
    'httpversion' => '1.0',
    'sslverify' => false,
    'body' => json_encode($fields))
);

//422 - A Live DDI already exists