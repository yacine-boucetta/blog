<?php
//require 'db.php';

class Comment extends Articles{
    public $id;
    public $comment;
    public $idArcticle;
    public $idUser;
    public $date;

    // public function __construct(){
    //     $this->db=connect();
    // }

//-----------------------------------------------AJOUTS COMMENTAIRE----------------------------------------------------------------

    public function addComment($comment, $idArcticle, $idUser){
        $errorLog ='';
        $secureComment=htmlspecialchars(trim($comment));

        if(!empty($secureComment)){
            $comLenght=strlen($secureComment);

            if($comLenght <= 240){
                $insertComment=$this->db->prepare("INSERT INTO commentaires(commentaire, id_article, id_utilisateur, date) VALUES (:commentaire, :id_article, :id_utilisateur, NOW())");
                $insertComment->bindValue(':commentaire', $comment, PDO::PARAM_STR);
                $insertComment->bindValue(':id_article', $idArcticle, PDO::PARAM_STR);
                $insertComment->bindValue(':id_utilisateur', $idUser, PDO::PARAM_STR);
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
        return $errorLog;
    }
//-----------------------------------------------------Display Comment--------------------------------------------------

    public function displayComment($id){
        $disComment = $this->db->prepare("SELECT commentaire, date, login FROM commentaires INNER JOIN utilisateurs ON utilisateurs.id = commentaires.id_utilisateur WHERE id_article = :id ORDER BY DATE DESC LIMIT 5");
        $disComment->bindValue(':id', $id, PDO::PARAM_STR);
        $disComment->execute();
        $result = $disComment->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

}
?>