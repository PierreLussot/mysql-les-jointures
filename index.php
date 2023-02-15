<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mysql les jointures</title>
</head>

<body>
    <?php
    try {
        $serveur = "localhost";
        $login = "root";
        $pass = "root";

        $connexion = new PDO("mysql:host=$serveur;dbname=test2", $login, $pass);
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $jointure_int = "SELECT Inscrits.prenom, Commentaires.commentaire 
        FROM Inscrits INNER JOIN Commentaires 
        ON Inscrits.id = Commentaires.id_inscrit";

        $requete = $connexion->prepare($jointure_int);
        $requete->execute();

        $resultats = $requete->fetchAll();

        /*  echo "<pre>";
        print_r($resultats);
        echo "</pre>"; */
    } catch (PDOException $e) {

        echo "Echec de la connexion: " . $e->getMessage();
    }
    ?>
    <h3> <?php foreach ($resultats as $resultat) {
                echo $resultat['prenom'] . "<br>";
                echo $resultat['commentaire'] . "<br><br>";
            } ?></h3>
</body>

</html>