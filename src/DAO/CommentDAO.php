<?php
namespace App\src\DAO;
use App\src\model\Comment;
class CommentDAO extends DAO
{
    private function buildObject($row)
        //Récupère les colonnes que l'on as besoin
    {
        $comment = new Comment();
        $comment->setId($row['id']);
        $comment->setPseudo($row['pseudo']);
        $comment->setContent($row['content']);
        $comment->setCreatedAt($row['createdAt']);
        return $comment;
    }
    public function getCommentsFromArticle($articleId)
        //Permet de récupérer les commentaire stocker dans la base de donnée "comment"
    {
        $sql = 'SELECT id, pseudo ,  content, createdAt, article_id FROM comment WHERE article_id = ? ORDER BY  createdAt DESC';
        $result = $this->createQuery($sql, [$articleId]);
        $comments = [];
        foreach ($result as $row){
            $commentId = $row['id'];
            $comments[$commentId] = $this->buildObject($row);
        }
        $result->closeCursor();
        return $comments;
    }

    public function addComment($articleId, $pseudo, $content)
        //Permet d'ajouter un commentaire et le stocker dans la base de donnée "comment"
    {
        $sql = 'INSERT INTO comment (pseudo, content, createdAt, article_id) VALUES (?, ?, NOW(),?)';
        $this->createQuery($sql, [$pseudo, $content, $articleId]);

    }

}