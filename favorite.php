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
    if (isset($_SESSION['src'])) {
        foreach ($_SESSION['src'] as $item => $src) {
            echo '
        <div class="cart">
            <div class="foto">
                <img src="' . $src . '">
            </div>
            <div class="cart_footer">
               <span title="Dislike" id="' . $item . '" class="input_heart_Dislike ClickFAV">&#128148</span>
            </div>
        </div>
        ';
        };
    };
        ?>
    </div>
</div>
<script src="../../js/favorite.js"></script>
</body>
</html>