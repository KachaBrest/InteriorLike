<?php
include_once './components/Parser.php';

//функция подключения к БД
function getConnection()
{
    $connect = new mysqli('localhost', 'root', 'root', 'interior');
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }
    return $connect;
}

// функция которая создает новую БД
function createTableImg(array $arr)
{
    // подключение к БД
    $connect = new mysqli('localhost', 'root', 'root', 'interior');
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // формируем запрос на создание новой таблицы
    $sql = "CREATE TABLE 'image' ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, src VARCHAR (255))";

    $checkCount = "SELECT * FROM image";
    $resultCount = $connect-> query($checkCount);
    $imgCount = $resultCount->fetch_all();

    // если таблица удачно создалась и в ней нету эллементов, наполняем ее изображениями
    if (count($imgCount) == 0) {
        foreach ($arr as $el) {
            $img = "INSERT INTO image (src)
                        VALUES ('$el')";
            $connect->query($img);
        }
    }

    $connect->close();
}

;

//функция которая получает данные с БД
function selectDb()
{
    $connect = getConnection();

    $sql = "SELECT * FROM Image ORDER BY id";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        $card = $result->fetch_all();
        return $card;
    } else {
        echo 'Запрос нулевой';
    }
}

;

// функция которая удаляет картинку по id

function deleteImg($id)
{
    $connect = new mysqli('localhost', 'root', 'root', 'interior');

    $sql = "DELETE FROM image WHERE id = $id";
    if ($connect->query($sql)) {
        header("Location: index.php");
    } else {
        echo 'Ошибка';
    }

    $connect->close();
}

//функция создает новую баззу данных любимых картинок
function getSRC($id) {
    $connect = getConnection();

    $select = "SELECT src FROM image WHERE id = '$id'";
    $result = $connect->query($sql);
    $fin = $result->fetch_all();
    return $fin;

}

// функция которая регестрирует нового пользователя в общей таблице User

function newUser($name, $email, $password){

    // подключаемся к таблице user
    $connect = new mysqli('localhost', 'root', 'root', 'user');
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // делаем запрос в БД c поиском по email
    $check = "SELECT id FROM users WHERE email ='$email'";
    $conn = $connect->query($check);
    $result = $conn->fetch_all();
//     проверяем вернул ли нам запрос строку с email
    if (!count($result)) {
        //если пользователя нет, тогда его регестрируем
        $user = "INSERT INTO users (name, email, password)
                        VALUES ('$name', '$email', '$password')";
        $connect->query($user);

    } else {
        // если пользователь есть авторизуем его
//    $sql = "UPDATE user SET "

    }

    $connect->close();
}


function LoginUser($email, $password){

    // подключаемся к таблице user
    $connect = new mysqli('localhost', 'root', 'root', 'user');
    if ($connect->connect_error) {
        die("Connection failed: " . $connect->connect_error);
    }

    // делаем запрос в БД c поиском по email
    $check = "SELECT name FROM users WHERE email ='$email' AND password = '$password'";
    $conn = $connect->query($check);
    $result = $conn->fetch_all();

//     проверяем вернул ли нам запрос строку с email
    if (count($result)) {
        foreach ($result as $val) {
            foreach ($val as $el){
                session_start();
                $_SESSION['name'] = $el;
            }
        }
        header('Location: index.php');
    } else {
        return 'Введены не верные данные';
    }

    $connect->close();
}