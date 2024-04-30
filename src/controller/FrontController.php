<?php

namespace App\src\controller;

session_start();

use App\src\DAO\ArticleDAO;
use App\src\DAO\CommentDAO;
use App\src\model\View;

class FrontController
{
    private $articleDAO;
    private $commentDAO;
    private $view;
    private $csrfToken;

    public function __construct()
    {
        $this->articleDAO = new ArticleDAO();
        $this->commentDAO = new CommentDAO();
        $this->view = new View();
//        // Générer le token CSRF lors de l'instanciation de FrontController
//        $this->csrfToken = $this->generateCsrfToken();
//        // Vous pouvez l'utiliser ou le stocker dans la session ici
    }

    public function home()
        // Epaces Acuueil
    { //echo "coucou";
        $articles = $this->articleDAO->getArticles();
        //voir articleDAO pour la requête select
        return $this->view->render('home', ['articles' => $articles]);
    }

    public function article($articleId)
        //Espace Article
    {
        $article = $this->articleDAO->getArticle($articleId);
        $comments = $this->commentDAO->getCommentsFromArticle($articleId);
        return $this->view->render('single', ['article' => $article, 'comments' => $comments]);
    }


    public function addComment($articleId, $pseudo, $content)
    {
        if (!$this->validateCommentData($articleId, $pseudo, $content)) {
            $this->errorController->errorNotFound();
            return;
        }

        $this->commentDAO->addComment($articleId, $pseudo, $content);
        // Rediriger vers l'article pour voir le commentaire ajouté
        header('Location: index.php?route=article&articleId=' . $articleId);
        exit;
    }

    private function validateCommentData($articleId, $pseudo, $content)
    {
        return !empty($pseudo) && !empty($content) && !empty($articleId) && $_SERVER['REQUEST_METHOD'] === 'POST';
    }
}
