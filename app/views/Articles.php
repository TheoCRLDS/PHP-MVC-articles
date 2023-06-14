<?php

/* Namespace */

namespace App\Views;

/**
 * Vue Articles
 */
class Articles
{
    public $result;

    /**
     * Fonction Constructeur afin d'afficher les données récupérées 
     */

    public function __construct($result)
    {
        /* Nettoyage des données */
        $this->result = $result;
    }
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

            <link rel="stylesheet" type="text/css" href="assets/styles/style.css" />
        </head>

        <body>
            <div class="mainContainer">

                <?php foreach ($this->result as $r) { ?>
                    <h1>Article <?php echo $r->id; ?></h1>

                    <h2>
                        <?php
                        echo $r->title;
                        ?>
                    </h2>
                    <p>
                        <?php
                        echo $r->content;
                        ?>
                    </p>
                    <i>
                        <?php
                        echo $r->author;
                        ?>
                    </i>
                    <p>
                        <?php
                        echo $r->date;
                        ?>
                    </p>

                <?php } ?>
            </div>
        </body>

        </html>

<?php
    }
}
