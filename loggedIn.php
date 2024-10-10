<html|>
Welcome
<?php
    session_start();
    echo $_SESSION["name"];
?>
!
<br>
<h1>Welcome <?php echo $_SESSION["name"]?></h1>
</html>