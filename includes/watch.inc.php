<?php
if (isset($_REQUEST["submitWatch"])) {
    $viewer = $_GET["viewer"];
    $streamer = $_GET["streamer"];
    $url = $_GET["url"];

    include "../classes/Dbh.cls.php";
    include "../classes/watch.cls.php";
    include "../classes/watchControl.cls.php";
    // insert watch relationship + increment view count
    $watch = new WatchControl($viewer, $streamer, $url);
    // $watch->watchView();

    // send the user to the correct watch page
    ?>
    <form action="../watch.php" id="redirectWatch" method="get">
        <input type="hidden" name="streamer" value="<?php echo $_GET["streamer"] ?>">
        <input type="hidden" name="url" value="<?php echo $_GET["url"] ?>">
    </form>
    <script>document.getElementById("redirectWatch").submit()</script>
    <?php
} else {
    header("location: ../indexUser.php");
}