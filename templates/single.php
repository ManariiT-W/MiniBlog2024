<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Mon blog</title>
</head>
<body>
<div>

    <?php $this->title = "Article";

    ?>
    <h1>Mon blog</h1>
    <p>En construction</p>
    <!-- L'affichage de l'article -->
    <div>
        <h2><?= htmlspecialchars($article->getTitle()); ?></h2>
        <p><?= htmlspecialchars($article->getContent()); ?></p>
        <p><?= htmlspecialchars($article->getAuthor()); ?></p>
        <p>Créé le : <?= htmlspecialchars($article->getCreatedAt()); ?></p>

        <!-- L'affichage de commentaire -->
        <div id="comments">
            <h3>Commentaires</h3>
            <?php
            foreach ($comments as $comment):
                ?>
                <h4><?= htmlspecialchars($comment->getPseudo()); ?></h4>
                <p><?= htmlspecialchars($comment->getContent()); ?></p>
                <!-- Utilisation de getCreatedAt() -->
                <p>Posté le <?= htmlspecialchars($comment->getCreatedAt()); ?></p>
                <?php
            endforeach;
            ?>
        </div>

        <!-- Formulaire d'ajout de commentaire -->
        <div>
            <h3>Ajouter un commentaire</h3>
            <form action="../public/index.php?route=addComment&articleId=<?= $article->getId(); ?>" method="post">

                <input type="hidden" name="pseudo" id="pseudo" >
                <label for="pseudo">Pseudo :</label><br>
                <input type="text" name="pseudo" id="pseudo" required>
                <br>
                <br>
                <laadbel for="commentaire">Commentaire :</laadbel>
                <br>
                <textarea id="content" name="content" rows="5" required></textarea>
                <br>
                <br>
                <input type="submit" value="Ajouter">
                <br>
                <br>
                <a href="../public/index.php">Retour à l'accueil</a>

            </form>
        </div>
    </div>
</body>
</html>
