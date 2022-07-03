<?php

include_once './components/Parser.php';
include_once './Db/Db.php';

createTableImg($src);

$img = [];
if (!count($img)) {
    $img = selectDb();
};




