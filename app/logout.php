<?php
session_start();

unset($_SESSION['src']);
unset($_SESSION['name']);

header('Location: ../cabinet.php');