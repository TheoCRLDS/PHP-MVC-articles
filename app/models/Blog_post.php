<?php

/* Namespace */

namespace App\Models;

/* Alias */

use PDO;


/**
 * Modèle Blog_post
 */
class BlogPost
{

    /* Propriétés */
    protected $id;
    protected $title;
    protected $content;
    protected $author;
    protected $date;
    protected $dbh;

    /**
     * Constructeur
     */
    public function __construct($id, $title, $content, $author, $date, $dbh)
    {
        /* Nettoyage des données */
        $this->id = $id;
        $this->title = filter_var($title, FILTER_SANITIZE_STRING);
        $this->content = filter_var($content, FILTER_SANITIZE_STRING);
        $this->author = filter_var($author, FILTER_SANITIZE_STRING);
        $this->date = filter_var($date, FILTER_SANITIZE_STRING);
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

        $query = $this->dbh->prepare("INSERT INTO blog_posts (title, content, author, date) VALUES (?,?,?,?)");
        return $query->execute([$this->title, $this->content, $this->author, $this->date]);
    }

    public static function fetchArticles($dbh)
    {
        $query = $dbh->prepare("SELECT * FROM blog_posts");
        $query->execute();

        $articles = [];

        if (is_a($query, "PDOStatement")) {
            $results = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($results as $result) {
                array_push($articles, new BlogPost($result['id'], $result['title'], $result['content'], $result["author"], $result["date"], $dbh));
            }
        }

        return $articles;
    }
}
