<?php

/**
 * views/NotFound.php - Vue NotFound
 * Cette vue permet d'afficher la page par défaut quand aucune route ne correspond.
 */

/* Namespace */

namespace App\Views;


/**
 * Vue NotFound
 */
class NotFound
{

    /**
     * Affichage de la page
     */
    public function render()
    { ?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="utf-8">
            <title>Boilerplate MVC PHP</title>

            <link rel="stylesheet" type="text/css" href="assets/styles/style.css" />
        </head>

        <body>
            <div class="mainContainer">
                <h1>Boilerplate MVC PHP</h1>
                <p>Cette page n'existe pas.</p>
            </div>
        </body>

        </html>

<?php
    }
}
