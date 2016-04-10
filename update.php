<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Update</title>
        <style type="text/css">@import url("css.css");</style>
    </head>
    <body>    
        <h1>Update</h1>
        <?php
        function nactiTridu($trida) {
            require("tridy/$trida.php");
        }

        spl_autoload_register("nactiTridu");
        db::connect();
        $napln = db::napln();
        ?>
        <div>
        <form action="index.php" method="post">
            Jméno: <br>
            <input type="text" name="ju" value="<?php echo $napln[0]['Jmeno'];?>"> <br>
            Příjmení:<br>
            <input type="text" name="pu" value="<?php echo $napln[0]['Prijmeni'];?>"><br>
            Stát: <br>
            <input type="text" name="su" value="<?php echo $napln[0]['Stat'];?>"><br>
            Umělecké jméno / Skupina:<br>
            <input type="text" name="au" value="<?php echo $napln[0]['Artist'];?>"><br>
            <input type="hidden" name="id" value="<?php echo $napln[0]['Id'];?>">
            <input type="submit" value="Přidat">
        </form>
        </div>


    </body>
</html>
