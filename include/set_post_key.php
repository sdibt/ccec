<?php $_SESSION['postkey'] = strtoupper(substr(MD5($_SESSION['administrator'] . rand(0, 9999999)), 0, 10)); ?>
<input type=hidden name="postkey" value="<?php echo $_SESSION['postkey'] ?>">
