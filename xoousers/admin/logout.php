<?php
include("../xoo-ini.php");
include("../xoo-sources.php");
include("../xoo-config.php");
unset($_SESSION['user']);
header("Location: login.php");
?>
