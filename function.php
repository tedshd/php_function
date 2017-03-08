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


?>
