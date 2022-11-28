<?php
    require('./connect.php');
?>

<?php
    $sql = "SELECT * FROM egzamin.sale";
    if ($result = mysqli_query($link, $sql)) {
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $sale[] = new sale($row['id'], $row['nr_sali'], $row['ilosc_stanowisk'], $row['disabled']);
            }   
        }
    }   

    class sale{
        public $id;
        public $nr_sali;
        public $ilosc_stanowisk;
        public $disabled;

        function __construct($id, $nr_sali, $ilosc_stanowisk, $disabled) {
            $this -> id = $id;
            $this -> nr_sali = $nr_sali;
            $this -> ilosc_stanowisk = $ilosc_stanowisk;
            $this -> disabled = $disabled;
        }
        
        function showRoom() {
            $korekta = (int)($this -> ilosc_stanowisk / 10);
            echo "<tr>";
            echo "<td>" . $this -> nr_sali . "</td>";
            echo "<td>" . $this -> ilosc_stanowisk . " [" . ($this -> ilosc_stanowisk - $korekta) .  "] ". "</td>";
            if($this -> disabled == 1) {
                echo "<td>❌</td>";
            } else {
                echo "<td>✔️</td>";
            }
            echo "<td>" . "<input type = 'checkbox' name = 'saleCheck[]' value = '" . $this -> id . "'>";
            echo "</tr>";
        }
    }    
?>

