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



class QueryString {

    public function query()
    {
        // handle query filter & rule
        $filters = [
            'q' => '',
            'type' => '',
            'start' => FILTER_VALIDATE_INT,
            'rows' => FILTER_VALIDATE_INT,
            'sort' => '',
            'a' => [
                'filter' => '',
                'flags'  => FILTER_REQUIRE_ARRAY,
            ],
        ];

        $query = filter_input_array(INPUT_GET, $filters);

        foreach ($query as $key => $value) {
            $query[$key] = (is_array($value)) ? array_map('trim', $value) : trim($value);
        }
        return $query;
    }


    public function urlGenerate($modified) {
        foreach($modi)
    }

    public function urlGenerate($path, $new_query)
    {
        $query = $this -> query();
        $query_string = http_build_query(array_filter($query));
        if (!empty($query_string)) {
            $query_string = '?' . $query_string;
        }
        $new_query = http_build_query(array_filter($new_query));
        if (!empty($new_query)) {
            if (empty($query_string)) {
                $new_query = '?' . $new_query;
            } else {
                $new_query = '&' . $new_query;
            }
        }
        return $path . $query_string . $new_query;
    }
}

// example
// $QueryString = new QueryString;
// var_dump($QueryString->query());
// echo $QueryString -> urlGenerate();

function url_update_query($url='', $query_string=[])
{
  $url_data = parse_url($url);
  $query_array = [];
  if (isset($url_data['query'])) {
    $query_data = $url_data['query'];
    parse_str($query_data, $query_array);
  }
  if (!empty($query_string)) {
    foreach ($query_string as $key => $value) {
      $query_array[$key] = $value;
    }
    $url_data['query'] = http_build_query($query_array, null, '&', PHP_QUERY_RFC3986);
  }

  $scheme   = isset($url_data['scheme']) ? $url_data['scheme'] . '://' : '';
  $host     = isset($url_data['host']) ? $url_data['host'] : '';
  $port     = isset($url_data['port']) ? ':' . $url_data['port'] : '';
  $user     = isset($url_data['user']) ? $url_data['user'] : '';
  $pass     = isset($url_data['pass']) ? ':' . $url_data['pass']  : '';
  $pass     = ($user || $pass) ? "$pass@" : '';
  $path     = isset($url_data['path']) ? $url_data['path'] : '';
  $query    = isset($url_data['query']) ? '?' . $url_data['query'] : '';
  $fragment = isset($url_data['fragment']) ? '#' . $url_data['fragment'] : '';

  return $scheme . $user . $pass . $host . $port . $path . $query . $fragment;
}

/**
 * $ver_min = '8.2';
 * $ver_max = '8.3.0';
 */
function matchMaxVersion($ver_min, $ver_max)
{
  $ver_min_arr = explode('.', $ver_min);
  $ver_max_arr = explode('.', $ver_max);

  for ($i = 0; $i < sizeof($ver_min_arr); $i++) {
    if (isset($ver_min_arr[$i]) && isset($ver_max_arr[$i])) {
      if (intval($ver_max_arr[$i]) > intval($ver_min_arr[$i])) {
        return true;
      }
      if (intval($ver_max_arr[$i]) < intval($ver_min_arr[$i])) {
        return false;
      }
    }
  }
}

function androidOsVersionValid($ver)
{
  $array = explode('.', $ver);
  if (sizeof($array) != 2) {
    return false;
  }
  for ($i = 0; $i < 2; $i++) {
    if (!is_numeric($array[$i])) {
      return false;
    }
  }
  if ($array[0] <= 0 || $array[0] > 100) {
    return false;
  }
  if ($array[1] < 0 || $array[1] > 10) {
    return false;
  }
  return true;
}

function iosOsVersionValid($ver)
{
  $array = explode('.', $ver);
  if (sizeof($array) != 3) {
    return false;
  }
  for ($i = 0; $i < 3; $i++) {
    if (!is_numeric($array[$i])) {
      return false;
    }
  }
  if ($array[0] <= 0 || $array[0] > 100) {
    return false;
  }
  if ($array[1] < 0 || $array[1] > 10) {
    return false;
  }
  if ($array[1] < 0 || $array[1] > 10) {
    return false;
  }
  return true;
}

function androidVersionValid($ver)
{
  $array = explode('.', $ver);
  if (sizeof($array) != 2) {
    return false;
  }
  for ($i = 0; $i < 2; $i++) {
    if (!is_numeric($array[$i])) {
      return false;
    }
  }
  if ($array[0] <= 0 || $array[0] > 100) {
    return false;
  }
  if ($array[1] < 0 || $array[1] > 100) {
    return false;
  }
  return true;
}

function iosVersionValid($ver)
{
  $array = explode('.', $ver);
  if (sizeof($array) != 3) {
    return false;
  }
  for ($i = 0; $i < 3; $i++) {
    if (!is_numeric($array[$i])) {
      return false;
    }
  }
  if ($array[0] <= 0 || $array[0] > 100) {
    return false;
  }
  if ($array[1] < 0 || $array[1] > 10) {
    return false;
  }
  if ($array[1] < 0 || $array[1] > 100) {
    return false;
  }
  return true;
}

?>
