<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">@import url("css.css");</style>
    </head>
    <body>
        <?php

        function nactiTridu($trida) {
            require("tridy/$trida.php");
        }

        spl_autoload_register("nactiTridu");
        
        if (isset($_POST['ju']) && isset($_POST['su']) && isset($_POST['pu']) && isset($_POST['au'])){
            db::connect();
            $ju = filter_input(INPUT_POST,'ju');
            $su = filter_input(INPUT_POST,'su');
            $pu = filter_input(INPUT_POST,'pu');
            $au = filter_input(INPUT_POST,'au');
            $id = filter_input(INPUT_POST, 'id');
            db::update($id, $ju, $pu, $su, $au);
        }

        if(isset($_POST['jmeno'])){
        if ($_POST['jmeno'] && $_POST['prijmeni'] && $_POST['stat'] != '') {
            db::connect();
            $jmeno = filter_input(INPUT_POST, 'jmeno');
            $prijmeni = filter_input(INPUT_POST, 'prijmeni');
            $stat = filter_input(INPUT_POST, 'stat');
            if ($_POST['artist'] != '') {
                $artist = filter_input(INPUT_POST, 'artist');
            } else {
                $artist = '';
            }
            db::novy($jmeno, $prijmeni, $stat, $artist);
        }
        }

        if (isset($_GET['delete'])) {
            $radek = filter_input(INPUT_GET, 'delete');
            db::connect();
            db::delete($radek);
            db::dotaz();
            db::vypis();
        } else {
            db::connect();
            db::dotaz();
            db::vypis();
        }
        ?>
    </body>
</html>