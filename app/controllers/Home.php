<?php

/**
 * controllers/Home.php - Controleur Home
 * Ce controleur regroupe les méthodes de la page d'accueil.
 */

/* Namespace */
namespace App\Controllers;

/* Imports */
include_once __DIR__ . "/../core/Database.class.php"; // Utilitaire de connexion à la base de données
include_once __DIR__ . "/../models/Contact.php"; // Modèle Contact
include __DIR__ . "/../views/home.php"; // Vue Home

/* Alias */
use App\Views\Home as HomeView;
use App\Models\Contact as ContactModel;
use App\Database\Database;

/**
 * Controleur Home
 */
class Home
{

    /**
     * Affichage de la page d'accueil
     */
    public function render()
    {
        $home_view = new HomeView(null); // Création d'une instance
        $home_view->render(); // Appel de la méthode de rendu (affichage)
    }

    /**
     * Traitement du formulaire de contact
     */
    public function process_contact_form()
    {
        /**
         * Validation des données
         */

        /* Cette variable indique si les données sont validées */
        $data_validated = true;

        /* Validation de l'adresse email */
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) === false) {
            $data_validated = false; // Insertion impossible car email invalide
        }


        if ($data_validated) {

            /* Création de la connexion vers la base de données */
            $dbh = Database::createDBConnection();

            /* Création d'un nouvel objet contact à partir du modèle */
            $contact = new ContactModel(null, $_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["phone"], $_POST["message"], $dbh);

            /* Insertion en base de données */
            $result = $contact->insert();
        }

        /* Affichage de la vue */
        $home_view = new HomeView($result); // création d'une instance
        $home_view->render(); // appel de la méthode d'affichage
    }
}
