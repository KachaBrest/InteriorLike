<?php
session_start();

$responseJson = file_get_contents('php://input');
$response = json_decode($responseJson, true);

$id = '';
$Like = '';
$Dislike = '';
$ok =[];

if (count($response) > 0 ) {

    $id = $response['id'];
    if ($response['choice'] == 'Like') {
        $Like = $response['choice'];
    } else {
        $Dislike = $response['choice'];
    }
};

include_once './Db/Db.php';

// выполнение если поставили лайк
if ($Like == 'Like' ) {

    //подключение к БД  и удаляем из основной таблицы элемент
    $connect = new mysqli('localhost', 'root', 'root', 'interior');

    // записываем в сессию src подравившейся картинки
    $sel = "SELECT src FROM image WHERE id = '$id'";
    $result = $connect->query($sel);
    $fin = $result->fetch_all();

    foreach ($fin as $el) {
        foreach ($el as $src) {
            $_SESSION['src'][] = $src;
        }
    }


    // удаляем из таблицы
    $del = "DELETE FROM image WHERE id = '$id'";
    $connect->query($del);

    exit();
};

// выполнение если поставили дизлайк
if ($Dislike == 'Dislike') {

    //подключение к БД  и удаляем из основной таблицы элемент
    $connect = new mysqli('localhost', 'root', 'root', 'interior');

    $sql = "DELETE FROM image WHERE id = '$id'";
    $connect->query($sql);

    exit();
};