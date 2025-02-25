<?php
if (isset($_GET["nama"], $_GET["jmlh"])) {
    $jmlh = $_GET["jmlh"];
    echo "Anak ayam " . $_GET["nama"] . " ada: " . $jmlh;
    echo "<br>";
    while ($jmlh > 0) {
        echo "Anak ayam turun " . $jmlh;
        echo "<br>";
        $jmlh--;
        if ($jmlh == 0) {
            echo "Mati satu " . $_GET["nama"] . " Galau";

            break;
        }
        echo "Mati satu tinggal " . $jmlh;
        echo "<br>";
    }
}
