<?php
    require('./connect.php');
?>

<?php
    function max_uczniowie() {
        $link = mysqli_connect("localhost", "root", "", "egzamin");
        $sql_egzamins = "SELECT * FROM egzamin.plan";
        $ilosc_uczniow = 0;

        if($sql_wynik = mysqli_query($link, $sql_egzamins)){
            while ($row= mysqli_fetch_array($sql_wynik)) {
                $ilosc_uczniow += $row['Ilosc_uczniow'];
            }
        }
        return $ilosc_uczniow;
    }

    function max_sale() {
        $link = mysqli_connect("localhost", "root", "", "egzamin");
        $sql_sale = "SELECT * FROM egzamin.sale";
        $ilosc_stanowisk_sesja = 0;
        #8, 10, 12, 14, 16
        
        if($sql_wynik = mysqli_query($link, $sql_sale)){
            while ($row= mysqli_fetch_array($sql_wynik)) {
                if($row['disabled'] == 0) {
                    #KOREKTA (1 miejsce wolne na 10 stanowisk)
                    $korekta = (int)($row['ilosc_stanowisk'] / 10);
                    $ilosc_stanowisk_sesja += ($row['ilosc_stanowisk'] - $korekta);
                }  
            }
        }
        return $ilosc_stanowisk_sesja;
    }

    function ilosc_egzaminow() {
        $link = mysqli_connect("localhost", "root", "", "egzamin");
        $plan = "SELECT * FROM egzamin.plan GROUP BY plan.Egzamin_Dni";
        $result = mysqli_query($link, $plan);
        return mysqli_num_rows($result);
    }

    function ilosc_sal() {
        $tmp = 0;
        $link = mysqli_connect("localhost", "root", "", "egzamin");
        $sql= "SELECT disabled FROM egzamin.sale";
        if($sql_wynik = mysqli_query($link, $sql)){
            while ($row= mysqli_fetch_array($sql_wynik)) {
                if($row['disabled'] == 0) {
                    $tmp++;
                }
            }
        }
        mysqli_close($link);
        return $tmp;
    }
?>