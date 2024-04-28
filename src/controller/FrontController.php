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
        return $this->view->render('single', ['article' => $article,'comments' => $comments]);
    }


    public function addComment($articleId, $pseudo, $content) {

//        // Vérifier si le token CSRF soumis correspond à celui stocké dans la session utilisateur
//        if (!isset($_SESSION['csrfToken']) || $_SESSION['csrfToken'] !== $csrfToken) {
//            // Rediriger vers une page d'erreur CSRF
//            header('Location: error_csrf.php');
//            exit;
//        }

        // Validation supplémentaire des données du commentaire
        if (!$this->validateCommentData($articleId, $pseudo, $content) || ) {
            // Rediriger vers une page d'erreur de validation des données
            header('Location: error_csrf_Valid.php');
            exit;
        }

        $this->commentDAO->addComment($articleId, $pseudo, $content);
        // Rediriger vers l'article pour voir le commentaire ajouté
        header('Location: index.php?route=article&articleId=' . $articleId);
        exit;
    }

//    public function addComment($articleId, $pseudo, $content) {
//        if (!$this->validateCommentData($articleId, $pseudo, $content)) {
//            $this->errorController->errorNotFound();
//            return;
//        }
//
//        $this->commentDAO->addComment($articleId, $pseudo, $content);
//        // Rediriger vers l'article pour voir le commentaire ajouté
//        header('Location: index.php?route=article&articleId=' . $articleId);
//        exit;
//    }
//
//    private function validateCommentData($articleId, $pseudo, $content) {
//    return !empty($pseudo) && !empty($content) && !empty($articleId) && $_SERVER['REQUEST_METHOD'] === 'POST';
//}

//Génération du CSRF Token
    private function generateCsrfToken() {
        $numBitsToken = 128;
        $tokenBytes = random_bytes($numBitsToken / 8);
        $csrfToken = bin2hex($tokenBytes);

//        $csrfToken = bin2hex(random_bytes(32)); // Génère un token aléatoire de 32 caractères

        // Stocker le token CSRF dans la session
        $_SESSION['csrf_token'] = $csrfToken;

        return $csrfToken;
    }

    public function validateCsrfToken() {
        return;
    }
}

?>