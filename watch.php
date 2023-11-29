<?php
session_start();
include("header.php");
?>

<!-- Display page content -->
<?php
$watch = new VideoControl($_SESSION["uid"],$_GET["url"]);
$watch->findVideo();
?>

<!-- Follow & Subscribe NYI -->

<?php
include("footer.php");
?>