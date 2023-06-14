<?php

/**
 * views/Home.php - Vue Home
 * Cette vue permet d'afficher la page d'accueil.
 */

/* Namespace */

namespace App\Views;

require_once __DIR__ . "/../core/Router.class.php"; // Routeur
use App\Router\Router;

/**
 * Vue Home
 */
class Home
{
    /* Propriétés */
    protected $result; // Résultat du stockage des informations du formulaire

    /**
     * Contructeur
     * Ce constructeur prend en paramètre une valeur booléenne contenant le résultat du traitement
     * des informations du formulaire de contact. Si le paramètre est null, la requête reçue
     * n'était pas une soumission de formulaire.
     */
    public function __construct($result)
    {
        // Si la variable $result n'est pas nulle
        if (isset($result)) {
            $this->result = $result; // Assignation de la valeur du résultat dans la propriété résultat
        }
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
            <title>Boilerplate MVC PHP</title>

            <link rel="stylesheet" type="text/css" href="assets/styles/style.css" />
        </head>

        <body>
            <div class="mainContainer">
                <h1>Boilerplate MVC PHP</h1>

                <h2>Modifier la page</h2>
                <p>
                    Bienvenue sur la page d'accueil. Vous pouvez modifier
                    cette page depuis la vue app/views/Home.php .
                </p>

                <h2>Tester le formulaire de contact</h2>
                <?php if (!isset($this->result)) { ?>
                    <p>
                        Pour tester le formulaire de contact, écrivez un
                        message dans le formulaire ci dessous et validez.
                    </p>
                <?php } else if ($this->result === true) { ?>
                    <p>Votre demande de contact a bien été enregistrée.</p>
                <?php } else { ?>
                    <p>Une erreur s'est produite, veuillez réessayer.</p>
                <?php } ?>

                <form action="<?php Router::url('/'); ?>" method="POST">
                    <label for="firstname">Prénom:</label>
                    <input type="text" id="firstname" name="firstname" required />

                    <label for="lastname">Nom:</label>
                    <input type="text" id="lastname" name="lastname" required />

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required />

                    <label for="phone">Téléphone:</label>
                    <input type="text" id="phone" name="phone" required />

                    <label id="message">Message</label>
                    <textarea name="message" id="message" required></textarea>

                    <button>Valider</button>
                </form>
            </div>
        </body>

        </html>

<?php
    }
}
