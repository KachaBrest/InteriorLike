<?php
include_once './Db/tables.php'
?>
<div class="My_container">
    <div>
        <h1>What's your kind of interior design?</h1>
        <h3>This will help us suit our suggestions to your taste</h3>
    </div>
    <div class="image_flex">
        <div  id="the_end" class="the_end">
            <img src="../../pic/My.gif" width="100%">
        </div>
    <?php
    for ($n = 0; $n <= (count($img) - 1); $n++) {
        echo '
        <div class="cart">
            <div class="foto">
                <img src="' . $img[$n][1] . '">
            </div>
            <div class="cart_footer">';

                if (!isset($_SESSION['name'])){
                echo '
                    <a href="../../cabinet.php" class="input_heart_Dislike">&#128148</a>
                    <a href="../../cabinet.php" class="input_heart_Like">&#128150</a>
            </div>
        </div>
                ';} else {
                echo '
                <span title="Dislike" id="'. $img[$n][0] .'" class="input_heart_Dislike ClickBTN">&#128148</span>
               <span title="Like" id="'. $img[$n][0] .'" class="input_heart_Like ClickBTN">&#128150</span>
            </div>
        </div>
                ';}
    };
        ?>
    </div>
</div>
<script src="../../js/button.js"></script>
</body>
</html>
