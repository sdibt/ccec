<?php $_SESSION['getkey'] = strtoupper(substr(MD5($_SESSION['administrator'] . rand(0, 9999999)), 0, 10)); ?>
