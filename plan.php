<?php
    require_once('./sale.php');
?>

<?php
    $plan = "SELECT * FROM egzamin.plan ORDER BY plan.Ilosc_uczniow DESC ";
    if($result = mysqli_query($link, $plan)){
        if(mysqli_num_rows($result) > 0){              
            while($a = mysqli_fetch_array($result)){
                $planTab[] = new plan($a['Egzamin_ID'], $a['Ilosc_uczniow'], $a['Kwalifikacja_KOD'],$a['Data_Poczatek']);
            }                      
        }
    }
    #KOCHANY ALGORYTM <3
    $sesje = 8;
    $start_pos = 0;
    $pozostalo_miejsc = 0;
    $egzamin = 0;
    $poprzednia = 0;
    $dsale = [];
    $continue = false;
    $egzamin_data = "";
    $ilosc_dni = 0;
    

    $egzamin_data = "SELECT Data_Poczatek FROM egzamin.plan";    
    if($result_egzamin_data = mysqli_query($link, $egzamin_data)){
        if(mysqli_num_rows($result_egzamin_data) > 0){
            $data = mysqli_fetch_array($result_egzamin_data);              
            $egzamin_data = $data['Data_Poczatek'];
        }
    }

    $egzamin_istnienie = "SELECT * FROM egzamin.plan";
    if($result_istnienie = mysqli_query($link, $egzamin_istnienie)){
        if(mysqli_num_rows($result_istnienie) > 0){
        $tekst = "<b> <p> SALE na dzień " . strval(date('Y-m-d', strtotime($data[0]. " + $ilosc_dni days"))) . "r." . " egzamin elektroniczny <p> </b>";
        echo "<div> <table class = 'table table-bordered table-light'>". "<b> <p> SALE na dzień " . strval(date('Y-m-d', strtotime($data[0]. " + $ilosc_dni days"))) . "r." . " egzamin elektroniczny <p> </b>"." <tr> <th>godz.</th>";
        foreach($sale as $salaa) {
            if($salaa->disabled == 0) {
                array_push($dsale, $salaa);
                echo "<th><b>Sala [" . strval($salaa -> nr_sali) . "]</b></th>"; 
            }
        }
        echo "</tr> <tr> <td> $sesje:00 </td>";
    foreach($planTab as $a) {
        $egzamin++;
        $uczniowie = $a -> Ilosc_uczniow;
        $uczniowie_aktual = 0;
        $i = $start_pos;              
            while($i < ilosc_sal()){
            if($dsale[$i] -> disabled == 0) {
                $korekta = (int)($dsale[$i] -> ilosc_stanowisk / 10);
                $room = $dsale[$i] -> ilosc_stanowisk - $korekta;
                if(!$continue) {
                    echo "<td>";
                }
                if($pozostalo_miejsc > 0){
                    if($pozostalo_miejsc - $uczniowie > 0) {
                        echo strval($a -> Kwalifikacja_KOD) . "(" . strval($uczniowie) . ")";
                        break;
                    }
                    echo strval($a -> Kwalifikacja_KOD) . "(" . strval($pozostalo_miejsc) . ")";
                    $uczniowie_aktual += $pozostalo_miejsc;
                    $pozostalo_miejsc = 0;
                    if($i >= ilosc_sal()) {
                        $start_pos = 0;
                        $i = 0;
                        $sesje += 2;
                        #INNY DZIEŃ
                        if($sesje > 16) {
                            $ilosc_dni++;
                            echo "</table></div><div> <table class = 'table table-bordered'>" . "<b> <p> SALE na dzień " . strval(date('Y-m-d', strtotime($data[0]. " + $ilosc_dni days"))) . "r." . " egzamin elektroniczny <p> </b>" . "<tr> <th>godz.</th>";
                                foreach($sale as $salaa) {
                                    if($salaa->disabled == 0) {
                                        echo "<th>Sala [" . strval($salaa -> nr_sali) . "]</th>"; 
                                    }
                                }
                            $sesje = 8;
                        }
                        echo "</tr> <td>$sesje:00</td> <tr>";
                    }
                } else {
                    if($uczniowie_aktual + $room < $uczniowie) {
                        #tu moze byc <=
                        echo strval($a -> Kwalifikacja_KOD) . "(" . strval($room) . ")";
                        $uczniowie_aktual += $room;
                    } else if(($uczniowie -  $uczniowie_aktual) == 0) {
                        break;
                    }
                    else {
                        echo strval($a -> Kwalifikacja_KOD) . "(" . strval(($uczniowie -  $uczniowie_aktual)) . ")";
                        $continue = true;
                        $start_pos = $i;
                        $pozostalo_miejsc =  $room - ($uczniowie -  $uczniowie_aktual);
                        $poprzednia =  ($uczniowie -  $uczniowie_aktual);
                        break;
                    }
                    if($room > $poprzednia) {
                        $continue = false;
                    } else {
                        echo "</td>";
                    }
                    if($i >= ilosc_sal()) {
                        $start_pos = 0;
                        $sesje += 2;
                        $i = 0;
                        #INNY DZIEŃ
                        if($sesje > 16) {
                            $ilosc_dni++;
                            echo "</table></div> <div> <table class = 'table table-bordered'>" . "<b> <p> SALE na dzień " . strval(date('Y-m-d', strtotime($data[0]. " + $ilosc_dni days"))) . "r." . " egzamin elektroniczny <p> </b>" . "<tr> <th>godz.</th>";
                                foreach($sale as $salaa) {
                                    if($salaa->disabled == 0) {
                                        echo "<th>Sala [" . strval($salaa -> nr_sali) . "]</th>";
                                    }
                                }
                            $sesje = 8;
                        }
                        echo "</tr> <td>$sesje:00</td> <tr>";
                    }
                }
            }
            if($i >= ilosc_sal() - 1) {
                $start_pos = 0;
                $sesje += 2;
                $i = 0;
                #INNY DZIEŃ
                if($sesje > 16) {
                    $ilosc_dni++;
                    echo "</table> </div> <div> <table class = 'table table-bordered'>" . "<b> <p> SALE na dzień " . strval(date('Y-m-d', strtotime($data[0]. " + $ilosc_dni days"))) . "r." . " egzamin elektroniczny <p> </b>" . "<tr> <th>godz.</th>";
                        foreach($sale as $salaa) {
                            if($salaa->disabled == 0) {
                                echo "<th>Sala [" . strval($salaa -> nr_sali) . "]</th>"; 
                            }
                        }
                    $sesje = 8;
                }
                echo "</tr> <td>$sesje:00</td>";
                $continue = false;
            } else {
                $i++;
                $continue = false;
            }
        }
    echo "<br>";
    }
    echo "</div> </table>";
    ?>
<?php
    }
}
    class plan {
        public $Egzamin_ID;
        public $Ilosc_uczniow;
        public $Kwalifikacja_KOD;
        public $Data_Poczatek;
        
        function __construct($Egzamin_ID, $Ilosc_uczniow, $Kwalifikacja_KOD, $Data_Poczatek) {
            $this -> Egzamin_ID = $Egzamin_ID;
            $this -> Ilosc_uczniow = $Ilosc_uczniow;
            $this -> Kwalifikacja_KOD = $Kwalifikacja_KOD;
            $this -> Data_Poczatek = $Data_Poczatek;
        }
    }
?>