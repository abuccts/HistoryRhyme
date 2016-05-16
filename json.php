<?php
/**
 * Created by PhpStorm.
 * User: zc
 * Date: 16-5-6
 * Time: 下午7:31
 */

/**
 * 发送post请求
 * @param string $url 请求地址
 * @param array $post_data post键值对数据
 * @return string
 */
function send_post($url, $post_data) {

    $postdata = http_build_query($post_data);
    $options = array(
        'http' => array(
            'method' => 'POST',
            'header' => 'Content-type:application/x-www-form-urlencoded',
            'content' => $postdata,
            'timeout' => 15 * 60 // 超时时间（单位:s）
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    return $result;
}



$type = 1;

    $querystr = "";

	if (isset($_GET["class"])){
		$class = $_GET["class"];
		$person = $_GET["person"];
		$period = $_GET["period"];


    }else{

        $type = 2;
    }

    //处理请求数据
    $result="";
    if ($type == 1){

        $url = "http://localhost:21230/search";

        $post_data = array(

            'class' => $class,
			'person' => $person,
            'period' => $period

        );

        $result = send_post($url, $post_data);
    }

    echo "getResult($result)";

?>