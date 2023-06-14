<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
/**
 * index.php - Point d'entrée de l'application
 * Ce fichier défini les routes et les méthodes des controleurs qui dervont être appelées
 */

/* Imports */
require_once __DIR__ . "/core/Router.class.php"; // Routeur
include_once __DIR__ . "/controllers/Home.php"; // Controleur Home
include_once __DIR__ . "/controllers/Articles.php"; // Controleur Articles
include_once __DIR__ . "/controllers/NotFound.php"; // Controlleur NotFound

/* Alias */

use App\Router\Router;
use App\Controllers\Home;
use App\Controllers\Articles;
use App\Controllers\NotFound;



/*********************/
/*      Requête      */
/*********************/
$method = $_SERVER['REQUEST_METHOD']; // Récupération du verbe
$uri = $_GET['uri']; // Récuépération de l'URI



/*********************/
/*       Router      */
/*********************/

/* Création du routeur */
$router = new Router($uri, $method);



/*********************/
/*       Routes      */
/*********************/

/*** Page d'accueil ***/
$homeController = new Home();

$router->get("/", [$homeController, 'render']); // GET /
$router->post("/", [$homeController, 'process_contact_form']); // POST /

/*** Page d'articles ***/
$articlesController = new Articles();

$router->get("/articles", [$articlesController, 'getArticles']); // GET /

/*** Page d'articles ***/
$newArticlesController = new Articles();

$router->get("/articles/create", [$newArticlesController, 'render']); // GET /
$router->post("/articles/create", [$newArticlesController, 'process_articles_form']); // POST /


$router->get('/nous-contacter', [$homeController, 'displayContact']);
/*********************/

/*** Route par défaut ***/
$router->default([new NotFound(), 'render']);
/*********************/



/***************************************/
/* Recherche de routes correspondantes */
/***************************************/

/* Démarrage du routeur */
$router->start();
