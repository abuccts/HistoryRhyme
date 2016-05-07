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

    if (isset($_GET["object"])){
        $object = $_GET["object"];
        $scene  = $_GET["scene"];
        $period = $_GET["period"];
        $person = $_GET["person"];
        $verb   = $_GET["verb"];


    }else{

        $type = 2;
    }

    //处理请求数据
    $result="";
    if ($type == 1){
        //$result = "[{\"eid\": 0, \"text\": \"American Civil War : A day after Union forces capture Richmond, Virginia , U.S. President Abraham Lincoln visits the Confederate capital.\", \"tag\": [\"a\", \"aa\", \"aaaa\", \"aaaaa\"]}, {\"eid\": 1, \"text\": \"World War II - Fuehrerbunker : Adolf Hitler marries his long-time partner Eva Braun in a Berlin bunker and designates Admiral Karl Dönitz as his successor. Both Hitler and Braun will commit suicide the next day.\", \"tag\": [\"b\", \"bb\", \"bbbbbb\"]}, {\"eid\": 2, \"text\": \"General Douglas MacArthur fulfills his promise to return to the Philippines when he commands an Allied assault on the islands, reclaiming them from the Japanese during the Second World War .\", \"tag\": [\"c\", \"ccc\", \"ccccccccc\"]}, {\"eid\": 0, \"text\": \"President Dwight D. Eisenhower signs the Alaska Statehood Act into United States law .\", \"tag\": [\"a\", \"aa\", \"aaaa\", \"aaaaa\"]}, {\"eid\": 1, \"text\": \"Nat Turner's slave rebellion revolt commences just after midnight in Southampton, Virginia , leading to the deaths of more than 50 whites and several hundred African Americans who were killed in retaliation for the uprising.\", \"tag\": [\"b\", \"bb\", \"bbbbbb\"]}, {\"eid\": 2, \"text\": \"zzzzzzzzzzzcccccccccccccccccczzzzzzzzzzzccccccccccccccccccz\", \"tag\": [\"c\", \"ccc\", \"ccccccccc\"]}]";

        $url = "http://localhost:21230/search";

        $post_data = array(

            'object' => $object,
            'scene'  => $scene,
            'period' => $period,
            'person' => $person,
            'verb'   => $verb

        );

        $result = send_post($url, $post_data);
    }

    echo "getResult($result)";


?>