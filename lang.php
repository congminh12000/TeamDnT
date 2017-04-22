<?php
if ($_GET["lang"] == "vi") {
    include("vi_lang.php");
} elseif ($_GET["lang"] == "en") {
    include("en_lang.php");
} else {
    include("vi_lang.php");
}
?>
