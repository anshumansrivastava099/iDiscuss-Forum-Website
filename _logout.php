<?php
session_start();
echo "Please wait we logged out you....";

session_destroy();

header("Location: /forum/index.php");
?>