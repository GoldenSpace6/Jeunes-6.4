<?php
function getid($tab,$email) {
        for ($i = 0; $i <= count($tab); $i++) {
            if($tab[$i]["mail"] == $email) {
                return $i;
            }
        }
        return -1;
    }
?>
