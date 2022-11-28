<?php 
    require('./connect.php');
    require('./funkcje.php');
   

    #WYŚWIETLANIE EGZAMINU
    $sql = "SELECT * FROM egzamin.egzaminy";
    $result = mysqli_query($link, $sql);
    
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){              
            while($row = mysqli_fetch_array($result)){
                $egzamin[] = new egzamin($row['id'], $row['nazwa'], $row['kod'], $row['id_zawodu'], $row['disabled']);
            }                      
        }
    }

    #DODAWANIE EGZAMINU
    if(isset($_REQUEST['nazwa'])) {
        $nazwa = $_REQUEST['nazwa'];
        $kod = $_REQUEST['kod'];
        $id_zawodu = $_REQUEST['id_zawodu'];
        $sql = "INSERT INTO egzamin.egzaminy (nazwa, kod, id_zawodu) VALUES ('$nazwa', '$kod', '$id_zawodu')";
        header("Location: index.php");
        die();
    }

    #echo max_sale_dzien() . "<br>";
    #echo max_uczniowie() . "<br>";

    

    class egzamin {
        public $id;
        public $nazwa;
        public $kod;
        public $id_zawodu;

        function __construct($id, $nazwa, $kod, $id_zawodu, $disabled) {
            $this -> id = $id;
            $this -> nazwa = $nazwa;
            $this -> kod = $kod;
            $this -> id_zawodu = $id_zawodu;
            $this -> disabled = $disabled;
        }

        function showEgzamin() {
            echo "<input type = 'checkbox' name = 'mark[]' value = '" . $this -> id . "'>";
            if($this -> disabled == 1) {
                echo "❌";
            } else {
                echo "✔️";
            }
            echo $this -> nazwa;
            echo " [" . $this -> kod . "] ";
        }

        function egzaminForm() {
            if($this -> disabled == 0) {
                echo "<div>";
                echo "<p>" . $this -> nazwa . " [" . $this -> kod . "] " . "(id: " . $this -> id_zawodu . ")" . "</p>";
                echo "<input type='number' name='Egzamin" . $this -> id . "Uczniowie' placeholder='Ilość uczniów: ' required='required'>";
                echo "</div>";
            }
        }

        #TO TRZEBA ZAIMPLEMENTOWAĆ
        function egzaminLicz($link) {
            $uczniowieInput = "Egzamin" . $this -> id . "Uczniowie";            
            if(isset($_REQUEST["$uczniowieInput"]) && !empty($_REQUEST["$uczniowieInput"])) {
                $uczniowie = $_REQUEST["$uczniowieInput"];
                $data_poczatek = $_REQUEST["data_poczatek"];

                $sql = "INSERT INTO egzamin.plan(Ilosc_uczniow, Data_Poczatek, Kwalifikacja_KOD, Egzamin_ID) 
                        VALUES ('$uczniowie', '$data_poczatek', '" . strval($this -> kod) ."', " . strval($this -> id) . "); \n";

                if ($link->query($sql) === TRUE) {
                    echo "Dodano egzamin!";
                    return 1;
                }
            } 
        }
    }
?>