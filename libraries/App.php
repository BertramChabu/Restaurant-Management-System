<?php
    require "../php/config.php";
?>

<?php
    class App{
        public $host = HOST;
        public $dname = DBNAME;

        public $user = USER;

        public $pass = PASS;

        public $link;


        //connect to the database server

        //create a construct
        public function __construct(){
            try{
                $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dname);

                if($this->link->connect_error){
                    die("Connection failed: ". $this->link->connect_error);
                }

            }catch(PDOException $e){
                echo "Connection failed: ". $e->getMessage();
            }

        }

        public function selectAll($query){
            $row = $this->link->query($query);
            $row->execute();

            $allRows = $row->fetch_all(PDO::FETCH_OBJ);

            if($allRows){
                return $allRows;

            }else {
                return false;
            }
        }

        public function selectOne($query){
            $row = $this->link->query($query);
$row = $this->link->prepare($query);
$row->execute();

$allRows = array();
$row->bind_result($column1, $column2, ...); // replace with your actual column names
while ($row->fetch()) {
    $allRows[] = array('column1' => $column1, 'column2' => $column2, ...); // replace with your actual column names
}

if (!empty($allRows)) {
    return $allRows;
} else {
    return false;
}

            $singleRow = $row->fetch_all(PDO::FETCH_OBJ);

            if($singleRow){
                return $singleRow;

            }else {
                return false;
            }
        }
    }
?>
