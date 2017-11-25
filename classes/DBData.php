<?php

class DBData
{
  // Stocker le gestionnaire de connexion
  private $db;

  /**
   * Exo 1 : Connect me, please
   *
   * Écrire la méthode __construct prennant en paramètre le tableau de
   * configuration $config issue de `inc/config.php`
   *
   * Cette méthode doit stockée une instance PDO dans la propriété $db
   *
   * L'usage de try..catch... est fortement recommandé
   *
   */
  public function __construct($config)
  {
    // Connexion à la bdd
    try {
      $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['database'].';charset=utf8', $config['user'], $config['password']);
    }
    catch (PDOException $e) {
      die('Erreur de connexion à la base de donnée : '.$e->getMessage());
    }
  }

  /**
   * Exo 2 : Get this movie
   *
   * Écrire la méthode getFilmById prennant en paramètre un id de film
   *
   * Cette méthode doit retournée 1 résultat sous forme d'objet
   *
   * Voir : fetch_style : https://secure.php.net/manual/en/pdostatement.fetch.php
   *
   * Indice : Pouvons-nous avoir confiance en cette donnée `id` ?
   *
   */
  public function getFilmById($id)
  {
    // Requête avec un paramètre nommé
    $sql = 'SELECT * FROM `movies` WHERE `id` = :id';
    // On prépare la requête
    $result = $this->db->prepare($sql);
    // On associe une valeur au paramètre nommé :id
    $result->bindValue(':id', $id, PDO::PARAM_INT);
    // On exécute la requête préparée
    $result->execute();

    // On récupère la première ligne sous forme d'un objet
    $movieById = $result->fetch(PDO::FETCH_OBJ);

    return $movieById;
  }

  /**
   * Exo 3 : Best Fr Movie
   *
   * Écrire la méthode bestFrMovie
   *
   * Cette méthode doit retournée, sous forme d'objet,
   * -> le film en langue fr le plus populaire, sorti en 2001
   *
   */
  public function bestFrMovie()
  {
    // Requête
    $sql = "SELECT * FROM `movies` WHERE `original_language` = 'fr' AND `release_date` LIKE '2001%' ORDER BY `popularity` DESC";
    // On effectue la requête
    $result = $this->db->query($sql);

    // On récupère la première ligne sous forme d'un objet
    $bestFrMovie = $result->fetch(PDO::FETCH_OBJ);

    return $bestFrMovie;
  }
}
