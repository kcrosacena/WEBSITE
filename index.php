
<?php
// session_start();
// if (isset($_SESSION['username'])) {
//   header("Location: home.php");
//   exit;
// }
echo "before header";
header("Location: http://localhost/kcportfolio/website/home.php");
echo "after header";
?>