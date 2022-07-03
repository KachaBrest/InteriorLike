<?php
session_start();
include_once './views/html/header.php';
?>
<div class="My_container">
    <div class="image_flex">
        <div  id="the_end" class="the_end">
            <img src="../../pic/My.gif" width="100%">
        </div>
<?php
        for ($n = 0; $n <= (count($_SESSION['src']) - 1); $n++) {
        echo '
        <div class="cart">
            <div class="foto">
                <img src="' . $_SESSION['src'][$n] . '">
            </div>
            <div class="cart_footer">
               <span title="Dislike" id="'.$n.'" class="input_heart_Dislike ClickFAV">&#128148</span>
            </div>
        </div>
        ';
    };
        ?>
    </div>
</div>
<script src="../../js/favorite.js"></script>
</body>
</html>

