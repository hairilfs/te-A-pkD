<?php
session_start();
if (!isset($_SESSION['ad_priv'])) {
  header("location: index.php");
} else {
$content = 0;
$content = $_GET['page'];
include("header.php");
include("sidebar.php");
$mysqli = new mysqli("localhost", "root", "", "db_jadwal_pkd");
switch ($content) {
  case 1:
  include("gen_jadwal.php");
  break;
  case 2:
  include("masterpkd.php");
  break;
  case 3:
  include("pengaturan.php");
  break;
  case 4:
  include("akun.php");
  break;
  case 5:
  include("testing1.php");
  break;
  default:
  include("welcome.php");
  break;
}

include("footer.php");
}
?>
