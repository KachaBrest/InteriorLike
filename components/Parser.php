<?php


    $userAgent = $_SERVER['HTTP_USER_AGENT'];

    function curlGetPage($url, $userAgent, $referer = 'https://google.com/')
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, '$userAgent');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, '1');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, '0');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, '0');
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_HEADER, '0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, '1');
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;

    }

    $page = curlGetPage('https://www.google.com/search?q=%D0%B8%D0%BD%D1%82%D0%B5%D1%80%D1%8C%D0%B5%D1%80%202022&tbm=isch&hl=ru&tbs=isz:m&sa=X&ved=0CAMQpwVqFwoTCIiiktzmx_gCFQAAAAAdAAAAABAC&biw=1349&bih=657', $userAgent);

// строку переделываем в объект по маркеру
    $html = explode('<', $page);

// находим только те элементы в которых есть нужный класс
    $img = [];
    foreach ($html as $element) {
        if (strpos($element, 'yWs4tf') > 0) {
            $img[] = $element;
        };
    }

// в строке находим путь к файлу с фото
$src=[];
foreach ($img as $item) {
        if (strpos($item, 'https') > 0) {
            $src[] = substr($item, 31, -3);
        }
    }