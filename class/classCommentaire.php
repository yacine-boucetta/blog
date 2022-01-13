<?php
//require 'db.php';

class Comment{
    public $id;
    public $comment;
    public $idArcticle;
    public $idUser;
    public $date;

    // public function __construct(){
    //     $this->db=connect();
    // }

//-----------------------------------------------AJOUTS COMMENTAIRE----------------------------------------------------------------

    public function AddComment($comment, $idArcticle, $idUser, $date){

        $secureComment=htmlspecialchars(trim($comment));

        if(!empty($secureComment)){
            $comLenght=strlen($secureComment);

            if($comLenght <= 240){
                $insertComment=$this->db->prepare("INSERT INTO commentaires(commentaire, id_article, id_utilisateur, date) VALUES (:commentaire, :id_article, :id_utilisateur, NOW())");
                $insertComment->bindValues(':commentaire', $comment, PDO::PARAM_STR);
                $insertComment->bindValues(':id_article', $idArcticle, PDO::PARAM_STR);
                $insertComment->bindValues(':id_utilisateur', $idUser, PDO::PARAM_STR);
                //$insertComment->bindValues(':date', strtotime (date ("d-m-Y H:i:s")), PDO::PARAM_STR);
                $insertComment->execute();

            }
            else{
                $errorLog = 'Le commentaire est trop long';
            }
        }
        else{
            $errorLog = 'Le commentaire est vide.';
        }
    }
//-----------------------------------------------------Display Comment--------------------------------------------------

    public function displayComment(){
        $disComment = $this->db->prepare("SELECT (commentaire, date, login) FROM commentaires INNER JOIN utilisateurs ON utilisateurs.id = commentaires.id_utilisateur ORDER BY Date LIMIT 5");
        $disComment->execute();
        $result = $disComment->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['commentaire'] = $result;
    }

}
?>