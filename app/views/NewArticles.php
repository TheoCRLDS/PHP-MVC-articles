<?php

/* Namespace */

namespace App\Views;

require_once __DIR__ . "/../core/Router.class.php"; // Routeur
use App\Router\Router;

/**
 * Vue Articles
 */
class NewArticles
{
    protected $result;

    /**
     * Affichage de la page
     */
    public function render()
    { ?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <title>Articles PHP-MVC-Boilerplate</title>

            <link rel="stylesheet" type="text/css" href="../assets/styles/style.css" />
        </head>

        <body>
            <?php if (!isset($this->result)) { ?>
                <p>
                    Pour tester le formulaire de création d'article, écrivez un
                    message dans le formulaire ci dessous et validez.
                </p>
            <?php } else if ($this->result === true) { ?>
                <p>Votre demande de contact a bien été enregistrée.</p>
            <?php } else { ?>
                <p>Une erreur s'est produite, veuillez réessayer.</p>
            <?php } ?>

            <div class="mainContainer">
                <form action="<?php Router::url('/articles/create'); ?>" method="POST">
                    <label for="title">Titre:</label>
                    <input type="text" id="title" name="title" required />

                    <label for="author">Auteur:</label>
                    <input type="text" id="author" name="author" required />

                    <label id="content">Contenu:</label>
                    <textarea name="content" id="content" required></textarea>

                    <button>Valider</button>
                </form>
        </body>

        </html>

<?php
    }
}
