<?php

/* Namespace */

namespace App\Controllers;

/* Imports */

include_once __DIR__ . "/../core/Database.class.php"; // Utilitaire de connexion à la base de données
include_once __DIR__ . "/../models/Blog_post.php"; // Modèle Blog_post
include __DIR__ . "/../views/Articles.php"; // Vue Articles
include __DIR__ . "/../views/NewArticles.php"; // Vue NewArticles

/* Alias */

use App\Views\NewArticles as NewArticlesView;
use App\Views\Articles as ArticlesView;
use App\Models\BlogPost as BlogPostModel;
use App\Database\Database;

/**
 * Controleur Articles
 */
class Articles
{

    /**
     * Affichage de la page d'articles
     */
    public function render()
    {
        $article_view = new NewArticlesView(null); // Création d'une instance
        $article_view->render(); // Appel de la méthode de rendu (affichage)
    }

    public function getArticles()
    {
        /* Création de la connexion vers la base de données */
        $dbh = Database::createDBConnection();

        /* Récupération des articles dans la base de données */
        $result = BlogPostModel::fetchArticles($dbh);

        /* Affichage des articles */
        $view = new ArticlesView($result);
        $view->render();
    }

    /**
     * Traitement du formulaire de création d'article
     */
    public function process_articles_form()
    {
        /* Création de la connexion vers la base de données */
        $dbh = Database::createDBConnection();

        /* Création d'un nouvel objet BlogPost à partir du modèle */
        $article = new BlogPostModel(null, $_POST["title"], $_POST["content"], $_POST["author"], date("Y-m-d H:i:s"), $dbh);

        /* Insertion en base de données */
        $article->insert();

        /* Rafraichissement de la page */
        header("Refresh:0; url=/PHP_Vanilla/php-boilerplate-alt/articles");
    }
}
