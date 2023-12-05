<?php
session_start();
include("header.php");
?>

<!-- Display page content -->
<?php
include "classes/Dbh.cls.php";
include "classes/video.cls.php";
include "classes/videoControl.cls.php";
$watch = new VideoControl($_GET["streamer"],$_GET["url"]);
$watch->findVideo();
?>


<?php
include("footer.php");
?>