<?php
/**
 *
 * @authors Ted Shiu (tedshd@gmail.com)
 * @date    2016-08-20 09:57:50
 * @version $Id$
 */


/**
 * [httpGet curl use get]
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function httpGet($url)
{
    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//  curl_setopt($ch,CURLOPT_HEADER, false);

    $output=curl_exec($ch);

    curl_close($ch);
    return $output;
}
// example
// echo httpGet("http://hayageek.com");

/**
 * [httpPost curl post]
 * @param  [type] $url    [description]
 * @param  [type] $params [description]
 * @return [type]         [description]
 */
function httpPost($url,$params)
{
  $postData = '';
   //create name value pairs seperated by &
   foreach($params as $k => $v)
   {
      $postData .= $k . '='.$v.'&';
   }
   $postData = rtrim($postData, '&');

    $ch = curl_init();

    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_POST, count($postData));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

    $output=curl_exec($ch);

    curl_close($ch);
    return $output;
}

// example
// $params = array(
//    "name" => "Ravishanker Kusuma",
//    "age" => "32",
//    "location" => "India"
// );

// echo httpPost("http://hayageek.com/examples/php/curl-examples/post.php",$params);
//
// refer -http://hayageek.com/php-curl-post-get/

?>