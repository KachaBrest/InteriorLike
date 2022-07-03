<?php
session_start();
include_once './views/html/header.php';
include_once './Db/Db.php';

$name = $email = $password = $passwordReg = '';
$error = [];

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["name"]);
    $email = test_input($_POST["email"]);
}

// алгоритм при входе пльзователя
if(isset($_POST['email']) && isset($_POST['password'])){

    // Проверка правильности email
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = test_input($_POST['email']);
    } else {
        unset($error['em']);
        $error['em'] = 'Неверно указанны данные';
    }

    // Проверка пароля
    $password = test_input($_POST['password']);

    // Делаем запрос в БД и проверяем соответствие email и password
    unset($error['user']);
    $error['user'] = LoginUser($email, $password);
}

// алгоритм при регистрации нового пользователя
if(isset($_POST['nameReg']) &&
    isset($_POST['emailReg']) &&
    isset($_POST['passwordReg']) &&
    isset($_POST['passwordCheckReg'])){

    // Валидируем имя пользователя
    $name = test_input($_POST['nameReg']);

    // Проверка правильности email
    if(filter_var($_POST['emailReg'], FILTER_VALIDATE_EMAIL)) {
        $email = test_input($_POST['emailReg']);
        $true = 'true';
    } else {
        unset($error['em']);
        $error['em'] = 'Неверно указанны данные';
    }

    // Валидируем пароль
    $password = test_input($_POST['passwordReg']);

    // Валидируем повторный пароль
    $passwordReg = test_input($_POST['passwordCheckReg']);

    // Если пароли совпали
    if( $password === $passwordReg) {
        newUser($name, $email, $password);
        $_SESSION['name'] = $name;
        unset($error);
        header('Location: index.php');

    } else {
        unset($error['pas']);
        $error['pas'] = 'Пароли не совпали';
    }
}
?>


<div class="favorite_container">

    <?php
    if(count($error)){
        foreach ($error as $el) {
            echo "<p class='cabinet_error'>$el</p>";
        }
    }

    if (!isset($_SESSION['name'])) {
        echo '
        <div class="register favorite_div">
            <h3>Регистрация</h3>
            <form action="cabinet.php" method="post" class="form_cart">
                <div class="mb-3">
                    <label for="exampleInputName1" class="form-label">Name</label>
                    <input type="text" class="form-control" name="nameReg" placeholder="Alexandr">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="emailReg" placeholder="kacha.biker@gmail.com"
                       aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="passwordReg" placeholder="Password">
                </div>
                <div class="mb-3">
                    <label for="exampleInputCheckPassword1" class="form-label">Check Password</label>
                    <input type="password" class="form-control" name="passwordCheckReg" placeholder="Password">
                </div>
                <button type="submit" class="btn-primary">Регистрация</button>
                
            </form>
        </div>


        <div class="login favorite_div">
            <h3>Вход</h3>
            <form action="cabinet.php" method="post" class="form_cart">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" class="form-control" name="email" placeholder="kacha.biker@gmail.com"
                       aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn-primary">Войти</button>
            </form>
        </div>
        ';
    } else {
        echo ' 
        <div class="cabinet_logout">
            <h2>Приветствуем '. $_SESSION['name'].'</h2> 
            <form action="./app/logout.php" method="post">
                <button type="submit" class="btn-logout">Выйти</button> 
            </form>
        </div>
        ';
    }

    ?>
</div>
