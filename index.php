<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
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

        /**
         *Pour les jointures, on utilise INNER JOIN nomTable ON l'id 
         *de la table principal est égal a la colonne voulue de la table a lié.
         *
         *Le AS est pour nommé la colonne part un alias plus parlent 
         *et aussi parfois afin de raccourcir le code mais cela n'est pas obligatoire.
         * 
         */

        $jointure_int = "SELECT i.id, i.prenom, c.commentaire 
        FROM Inscrits AS i
        INNER JOIN Commentaires AS c
        ON i.id = c.id_inscrit";

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
    <div class="container">
        <div class="row">
            <?php foreach ($resultats as $resultat) : ?>
                <div class="card my-auto mx-auto" style="width: 300px;">
                    <div class="card-body">
                        <h5 class="card-title"> <?= $resultat['id'] ?> </h5>
                        <h6 class="card-text"><?= $resultat['prenom'] ?></h6>
                        <p><?= $resultat['commentaire'] ?></p>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>