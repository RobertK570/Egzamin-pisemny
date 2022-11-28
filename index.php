<?php
    require('./sale.php');
    require('./egzaminy.php');
    require_once "funkcje.php";
    ob_start(); #dzieki temu nie ma header error
    session_start();
?>

<!DOCTYPE html>
<html lang="PL">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Egzaminy</title>
        <link rel="stylesheet" href="styleNEW.css" !important="!important">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <script src="./script.js"></script>
        <script src="./bootstrap.min.js"></script>
        <script
            src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
            integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
            integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
            crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <div class="logo">
                <h2>ZSNR4</h2>
            </div>
            <div class="info">
                <p>
                    Ilość uczniów egzaminowanych:
                    <b>
                        <?php echo max_uczniowie() ?>
                    </b>
                </p>
                <p>
                    Sale max (jedna sesja):
                    <b>
                        <?php echo  max_sale() ?>
                    </b>
                </p>

            </div>
        </nav>
        <section class="all">
            <section class="container">
                <div class="egzams">
                    <h2>Dodawanie egzaminów</h2>
                    <h4>Aktualne egzaminy
                    </h4>
                    <form action="" method="post" class="egzaminyForm">
                        <?php
                $i = 1;
                foreach($egzamin as $a) {
                    echo "<div class='input-group-text'>";
                    
                    $a -> showEgzamin();
                    echo "</div>";
                    $i++;
                }
                ?>
                        <input
                            type="submit"
                            value="Włącz / Wyłącz wybrane egzaminy"
                            class="egzamChanger btn btn-danger ">
                    </form>
                    <button
                        type="submit"
                        onclick="addEgzam()"
                        class="btn btn-success"
                        style="margin-top: 20px">Dodaj egzamin</button>
                <?php
                if(isset($_REQUEST['mark'])) {
                    $egzaminCheck = $_REQUEST['mark'];
                    foreach($egzaminCheck as $egz) {
                        $egzamin_id_changea = $egz;
                        $sql_requesta = "SELECT disabled FROM egzamin.egzaminy WHERE egzaminy.id = $egzamin_id_changea";
                        if($sql_wynika= mysqli_query($link, $sql_requesta)){
                            $sql_boola = mysqli_fetch_array($sql_wynika);
                            if($sql_boola['disabled'] == 1) {
                                $sql_senda = "UPDATE egzaminy SET egzaminy.disabled = 0 WHERE egzaminy.id =  $egzamin_id_changea";
                            } else {
                                $sql_senda = "UPDATE egzaminy SET egzaminy.disabled = 1 WHERE egzaminy.id =  $egzamin_id_changea";
                            }
                        $link->query($sql_senda);
                        } 
                    }
                    header("Location: index.php");
                }
            ?>

                    <div class="egzaminDodaj" style="display:none">
                        <h2>Dodawanie nowego egzaminu</h2>
                        <form method="POST">
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom01">Nazwa egzaminu</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="validationCustom01"
                                    placeholder="Nazwa"
                                    required="required"
                                    name="nazwa123">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="validationCustom02">Kod egzaminu</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="validationCustom02"
                                    placeholder="Kod"
                                    required="required"
                                    name="kod">
                            </div>
                            <button
                                type="submit"
                                value="Dodaj!"
                                class="btn btn-success btn-egzam-add"
                                name="addEgzam123">Dodaj!
                            </button>
                        </form>

                    </div>
                </div>
                <?php
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
            if(isset($_REQUEST['nazwa123'])) {
                $nazwa1 = $_REQUEST['nazwa123'];
                $kod1 = $_REQUEST['kod'];
                #$id_zawodu1 = $_REQUEST['id_zawodu'];
                $sql3 = "INSERT INTO egzamin.egzaminy (nazwa, kod, id_zawodu)
                VALUES ('$nazwa1', '$kod1', '0')";
                if ($link->query($sql3) === TRUE) {
                }
                header("Location: index.php");
                #die();
                }
            ?>

                <div class="egzamsSettingsDiv">
                    <h2>Edytowanie wartości egzaminu</h2>
                    <?php
                    $ilosc_egzaminow = 0;
                    echo "<form method='POST'>";
                    echo "<p>Te wartości można edytować</p>";
                    $request = "SELECT * FROM egzamin.egzaminy";
                    if($result = mysqli_query($link, $request)){
                        while($row = mysqli_fetch_array($result)){
                        echo "<div>";
                        echo "<input value = " . "'" . $row['nazwa'] . "' name = 'Nazwa" . $row['id'] . "' >";
                        echo "<input value = " . "'" . $row['kod'] . "' name = 'Kod" . $row['id'] . "' >";
                        echo "</div>";
                        $ilosc_egzaminow = $row['id'];
                        }
                    }
                    echo "<button type='submit' name='egzamin-edit-submit' value='Edytuj' class='btn btn-primary mb-1'>Edytuj</button>";
                    echo "</form>";
                ?>
                    <?php 
                if(isset($_REQUEST['egzamin-edit-submit'])) {
                    for($i = 1; $i <= $ilosc_egzaminow; $i++) {
                        //todo
                        $nazwa = "Nazwa" . $i;
                        $kod = "Kod" . $i;
                        $nazwa_egzaminu = $_REQUEST["$nazwa"];
                        $kod_egzaminu = $_REQUEST["$kod"];
                        $id = $i;

                        $SqlRequestFirst = "UPDATE egzamin.egzaminy SET kod = '$kod_egzaminu' WHERE id = $id;";
                        $SqlRequestSecond = "UPDATE egzamin.egzaminy SET nazwa = '$nazwa_egzaminu' WHERE id = $id;";
                        mysqli_query($link, $SqlRequestFirst);
                        mysqli_query($link, $SqlRequestSecond);
                    }
                    header("Location: index.php");
                }
            ?>
                </div>
            </div>
        </div>
    </section>
    <section class="spacer mx-auto"></section>
    <section class="sale">
        <!-- LISTA + ZMIANA SAL DZIAŁA -->
        <div class="saleLista">
            <h2>Dostęne sale</h2>
            <div class="allsale">
                <form action="" method="post">
                    <table class="table table-light">
                        <thead class="thead-dark">
                            <tr>
                                <th>Numer</th>
                                <th>Ilość stanowisk
                                    <br>
                                    [Dostępne]</th>
                                <th>Status</th>
                                <th>Zmień</th>
                            </tr>
                        </thead>
                        <?php
                foreach($sale as $a) {
                $a -> showRoom();
            }
            ?>
                    </table>
                    <input type="submit" value="Włącz /Wyłącz sale" class="btn btn-danger">
                </form>
                <button
                    type="submit"
                    onclick="addRooms()"
                    class="btn btn-success"
                    style="margin-top: 20px">Dodaj sale</button>
            <?php
            if(!empty($_REQUEST['saleCheck'])){
                $saleCheckBox = $_REQUEST['saleCheck'];
                foreach($saleCheckBox as $sall){
                    $egzamin_id_change = $sall;
                    $sql_request = "SELECT disabled FROM egzamin.sale WHERE sale.id = $egzamin_id_change";
                    if($sql_wynik = mysqli_query($link, $sql_request)){
                        $sql_bool = mysqli_fetch_array($sql_wynik);
                        if($sql_bool['disabled'] == 1) {
                            $sql_send = "UPDATE egzamin.sale SET sale.disabled = 0 WHERE sale.id =  $egzamin_id_change";
                        } else {
                        $sql_send = "UPDATE egzamin.sale SET sale.disabled = 1 WHERE sale.id =  $egzamin_id_change";
                        }   
                        if ($link->query($sql_send) === TRUE){}
                        }  
                    }
                    header("Location: index.php");
                    die();
                }
                ?>
                <div class="dodajSale" style="display:none">
                    <h2>Dodawanie nowych sal</h2>
                    <form action="" method="post">
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom03">Numer sali</label>
                            <input
                                type="text"
                                class="form-control"
                                id="validationCustom03"
                                placeholder="Numer sali"
                                required="required"
                                name="numer_form">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom04">Ilość stanowisk</label>
                            <input
                                type="text"
                                class="form-control"
                                id="validationCustom04"
                                placeholder="Ilość stanowisk"
                                required="required"
                                name="ilosc_stanowisk_form">
                        </div>
                        <button
                            type="submit"
                            value="Dodaj sale"
                            name="add-rooms"
                            class="btn btn-success">
                            Dodaj!
                        </button>
                    </form>
                </div>
                <?php 
            if(isset($_REQUEST['add-rooms']) && !empty($_REQUEST['numer_form']) && !empty($_REQUEST['ilosc_stanowisk_form'])) {
                $numer = $_REQUEST['numer_form'];
                $ilosc_stanowisk = $_REQUEST['ilosc_stanowisk_form'];

                echo $zapytanie = "INSERT INTO egzamin.sale VALUES(NULL, '$numer', '$ilosc_stanowisk', '0')";

                mysqli_query($link, $zapytanie);

                header("Location: index.php");
            }
        ?>
            </div>
        </div>
        <div class="sale-edit">
            <h2>Edytowanie wartości sal</h2>
            <!-- ZMIEN TO / CHYBA DZIAŁA-->
            <?php
                $ilosc_sal = 0; 
                echo "<form method='POST'>";
                echo "<p> Te wartości można edytować </p>";
                $request = "SELECT * FROM egzamin.sale";
                if($result = mysqli_query($link, $request)){
                while($row = mysqli_fetch_array($result)){
                   # echo $row['nr_sali'] . "<br>";
                   echo "<div>";
                   echo "<input value = " . "'" . $row['nr_sali'] . "' name = 'NumerSali" . $row['id'] . "' >";
                   echo "<input value = " . "'" . $row['ilosc_stanowisk'] . "' name = 'IloscStanowisk" . $row['id'] . "' >";
                   echo "</div>";
                   $ilosc_sal = $row['id'];
                }
            }
            echo "<input type='submit' name='sale-edit-submit' value='Edytuj' class='btn btn-primary mb-1' style='margin-top: 20px'>";
            echo "</form>";
            ?>

            <?php 
                if(isset($_REQUEST['sale-edit-submit'])) {
                    for($i = 1; $i <= $ilosc_sal; $i++) {
                        //todo
                        $salaName = "NumerSali" . $i;
                        $stanowiskaName = "IloscStanowisk" . $i;
                        $nr_sali = $_REQUEST["$salaName"];
                        $ilosc_stanowisk = $_REQUEST["$stanowiskaName"];
                        $id = $i;

                        $SqlRequestFirst = "UPDATE egzamin.sale SET nr_sali = '$nr_sali' WHERE id = $id;";
                        $SqlRequestSecond = "UPDATE egzamin.sale SET ilosc_stanowisk = '$ilosc_stanowisk' WHERE id = $id;";
                        mysqli_query($link, $SqlRequestFirst);
                        mysqli_query($link, $SqlRequestSecond);
                    }
                    header("Location: index.php");
                }
            ?>

        </section>
        <section class="spacer mx-auto"></section>
        <section class="students-add">
            <form method="POST">
                <form action="" method="post">
                    <div class="first">
                        <?php
                foreach($egzamin as $a) {
                    if($a -> disabled == 0) {
                        echo "<div class='egzaminForm'>";
                        $a -> egzaminForm();
                        echo "</div>";
                    }
                }
            ?>
                    </div>

                    <?php
        foreach($egzamin as $a) {
            if($a -> disabled == 0) {
        ?>
                    <div class="second">
                        <p>Data początek:
                        </p>
                        <input type="date" name="data_poczatek" id="" required='required'>
                        <button
                            type="submit"
                            value="Dodaj egzaminy"
                            class="btn btn-danger"
                            style="margin-top: 20px">Dodaj egzaminy</button>
                    </div>
                    <?php
        break;
            }
        }
        ?>
                </form>
            </form>
            <?php
        $tmp = 0;
        foreach($egzamin as $a) {
            if($a -> egzaminLicz($link) > 0) $tmp++;
            if($tmp >= 1) header("Location: index.php");
        }
    ?>

        </section>
        <section class="spacer mx-auto"></section>
        <section class="tableOut">
            <?php require('./plan.php'); ?>
        </section>
        <section class="deleteTable">
            <button
                type="button"
                class="btn btn-danger"
                data-toggle="modal"
                data-target="#exampleModal">Usuń tabelki!</button>

            <div
                class="modal fade"
                id="exampleModal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">UWAGA</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <b>
                                Zaczekaj!
                            </b><br>
                            <p>Na pewno chcesz usunąć wszystkie tabele ?</p>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                            <form action="" method="post">
                                <button type="submit" class="btn btn-danger" name="dropDataBase">Usun tabele!</button>
                            </form>
                            <?php
            if(isset($_REQUEST['dropDataBase'])) {
                header("Location: index.php");
                $drop = "DELETE  FROM `plan`";
                if ($link->query($drop) === TRUE){}
            }
        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <style>
        .tableOut table {
            border: solid 1px black !important;
            text-align: center;
            border-collapse: collapse;

        }
        .tableOut td,
        .tableOut th {
            border: solid 1px black !important;
            padding: 7px;
        }
    </style>
</body>
</html>