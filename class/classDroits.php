<?php
require 'db.php';

class Droits{
    public $id;
    public $login;
    public $db;
    
    public function __construct(){
        $this->db = connect();
    }

    public function getChoice(){
        $i = 0;
        $choice = $this->db->prepare("SELECT * FROM droits");
        $choice->execute();
        while ($fetch = $choice->fetch(PDO::FETCH_ASSOC)){
            $tab[$i][] = $fetch['id'];
            $tab[$i][] = $fetch['login'];
            $i++;
        }
        return $tab;
    }
    public function displayChoice(){
        $disChoice = new Droits();
        $tab = $disChoice->getChoice();
        foreach($tab as $values){
            echo '<option value="' .$values[0] . '">'. $values[1] .'</option>';
        }
    }
}
?>