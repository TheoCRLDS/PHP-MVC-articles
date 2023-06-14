<?php

/**
 * models/contact.php - Modèle Contact
 * Cette classe modélise une entrée de la table contact de la base de donnée.
 */

/* Namespace */
namespace App\Models;

/* Alias */
use PDO;


/**
 * Modèle Contact
 */
class Contact
{

    /* Propriétés */
    protected $id;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $message;
    protected $phone;
    protected $dbh;


    /**
     * Constructeur
     */
    public function __construct($id, $firstname, $lastname, $email, $phone, $message, $dbh)
    {
        /* Nettoyage des données */
        $this->id = $id;
        $this->firstname = filter_var($firstname, FILTER_SANITIZE_STRING);
        $this->lastname = filter_var($lastname, FILTER_SANITIZE_STRING);
        $this->email = filter_var($email, FILTER_SANITIZE_STRING);
        $this->phone = filter_var($phone, FILTER_SANITIZE_STRING);
        $this->message = filter_var($message, FILTER_SANITIZE_STRING);
        $this->dbh = $dbh;
    }

    /**
     * Get
     */
    public function __get($property)
    {
        if ($property !== "dbh") {
            return $this->$property;
        }
    }

    /**
     * Set
     */
    public function __set($property, $value)
    {
        if ($property !== "dbh") {
            $this->$property = $value;
        }
    }


    /**
     * Insertion dans la base de données
     */
    public function insert()
    {

        $query = $this->dbh->prepare("INSERT INTO contacts (firstname, lastname, email, phone, message) VALUES (?,?,?,?,?)");
        return $query->execute([$this->firstname, $this->lastname, $this->email, $this->phone, $this->message]);
    }


    /**
     * Récupération de contact par email
     */
    public static function fetchByEmail($email, $dbh)
    {

        $email = filter_var($email, FILTER_SANITIZE_STRING);

        $query = $dbh->prepare("SELECT * FROM contacts WHERE email = ?");
        $query->execute([$email]);
        
        $contacts = [];
        
        if(is_a($query, "PDOStatement")) {
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $result) {
                array_push($contacts, new Contact($result['id'], $result['firstname'], $result['lastname'], $result["email"], $result["phone"], $result["message"], $dbh));
            }
        }

        return $contacts;
    }
}
