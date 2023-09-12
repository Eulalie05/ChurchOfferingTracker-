<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Entrer de caisse</title>

    <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="bootstrap/font/bootstrap-icons.css">

    <style>
        body{
            background-color: white;
        }
        .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
        }

        @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
        }
        .titre_recherche{
            display: flex;
        }
        .form1{
            display: flex;
            padding: 3px 0px 10px 55px;
        } 
        .button_cherche{
            margin-left: 5px;
        }
        .con{
            margin-left: 0;
        }
        div.cont1{
            margin-left: 50px;
            margin-right: 50px;
        }
        div.cont2{
            margin-left: 42px;
            margin-right: 42px;
        }
        
    </style>


</head>
<body>

<?php require "connection.php";?>

<!-- ---------------------------------NAVIGATION-------------------------------- -->
<?php require "html.php";?>

<!-- ------------------------------DEBUT DU CONTENUE----------------------- -->
<div class="py-4">

    <div class="p-5 mb-4 bg-light rounded-3 cont1">
        <div class="container-fluid py-0">
        <h1 class="display-5 fw-bold">Entrer de caisse de l'eglise</h1>
        <!-- <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p> -->
        <!-- <button class="btn btn-primary btn-lg" type="button">Example button</button> -->
        </div>
    </div>

    <div class="row align-items-md-stretch cont2">

    <!-- ----------------------------FORMMULAIRE DE CREDIT------------------------ -->
      <div class="col-md-6">
        <div class="h-100 p-5 text-white bg-dark rounded-3">
            <h2>Ajouter des données dans l'entrer : </h2><br>

            <form action="entre.php" method="post" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="text" class="form-control form-control-dark" placeholder="motif" aria-label="motif" name="motif"><br>
                <input type="int" class="form-control form-control-dark" placeholder="montant" aria-label="montant" name="montant"><br>
                <input type="date" class="form-control form-control-dark" placeholder="date" aria-label="date" name="date"><br>
                <input type="reset" class="btn btn-warning">
                <input type="submit" name="enregistrer" value="Enregistrer" class="btn btn-outline-light me-2">
            </form>

            <?php

            //INSERER LES VALEUR DANS ENTRER
            if(isset($_POST['enregistrer'])){

                $motif = $_POST["motif"];
                $montant = $_POST["montant"];
                $date = $_POST["date"];

                if(!empty($motif) && !empty($montant) && !empty($date)){
                    $requete = $conn->prepare('INSERT INTO entre(motif, montant, dateEntre) VALUES(:motif, :montant, :date)');

                    $requete->bindValue(":motif", $motif);
                    $requete->bindValue(":montant", $montant);
                    $requete->bindValue(":date", $date);

                    $result = $requete->execute();

                    if(!$result){
                        echo "un problème est survenur, l'enregistrement n'as pas été effectuer";
                    }
                    else{
                        echo "<br>L'enregistrement a été bien effectuer. Son identifient est : ".$conn->lastInsertId();
                    }
                }
                else{
                    echo "<br>Tous les champ sont requis<br>";
                }
            }

            ?>
            <br>
            <h2>Suprimer dans l'entrer </h2><br>
            <form action="delete/suprimer_dans_entre.php" method="post" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="int" class="form-control form-control-dark" placeholder="identifient a suprimer" aria-label="suprimer" name="idEntre"><br>
                <input type="submit" name="suprimer" value="suprimer" class="btn btn-outline-light me-2">
                <a href="service.php" class="btn btn-outline-light me-2">Retour</a>
            </form>

            <!-- <br>
            <h2>Modifier le table entrer </h2><br>
            <form action="update_entre/update_entre2.php" method="post" class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                <input type="int" class="form-control form-control-dark" placeholder="identifient a modifier" aria-label="suprimer" name="idEntre"><br>
                <input type="submit" name="modif_entre" class="btn btn-outline-light me-2">
            </form> -->

        </div>
      </div>

    <!-- ------------------------------TABLE DE CREDIT----------------------------- -->
      <div class="col-md-6">
        <div class="h-100 p-5 bg-light border rounded-3">

            <div class="titre_recherche">
                <h2>Table entre</h2>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 form1" action="entre.php" method="post">
                    <input type="text" class="form-control form-control-dark" placeholder="motif a chercher" aria-label="motif" name="recherche">
                    <input type="submit" value="Chercher" name="chercher" class="button_cherche">
                </form>
            </div>

            <?php
                //RECHERCHE 
                // $recherche = $_POST['recherche'];
                if(!empty($_POST['recherche'])){
                    $recherche = $_POST['recherche'];
                    $requete_recherche = "SELECT * FROM entre WHERE motif LIKE '%$recherche%'";
                    $resultat_affiche_entre = $conn->query($requete_recherche);

                    if(! $resultat_affiche_entre):
                        echo "un erreur c'est produit lors de l'affichage du liste des eglises";
                    else:
                        $nbr_eglise = $resultat_affiche_entre->rowCount();
            ?>

            <table class="table table-hover text-center" style="margin-top: 1rem;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Motif</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($ligne = $resultat_affiche_entre->fetch(PDO::FETCH_NUM)){
                            echo "<tr>";
                            foreach ($ligne as $valeur){
                                echo "<td>$valeur</td>";
                            }
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
            <?php
                endif;
                }
                else{
                    //AFFICHER LE TABLE ENTRE
                    $requette_affiche_entre = "SELECT * FROM entre";
                    $resultat_affiche_entre = $conn->query($requette_affiche_entre);
                
                    if(!$requette_affiche_entre):
                        echo "un erreur c'est produit lors de l'affichage du liste des eglises";
                    else:
                        $nbr_eglise = $resultat_affiche_entre->rowCount();
            ?>
            <table class="table table-hover text-center" style="margin-top: 1rem;">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Identifiant</th>
                        <th scope="col">Motif</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Date</th>
                        <th scope="col">Modifier</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($ligne = $resultat_affiche_entre->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <tr>
                                <td><?php echo $ligne['idEntre']?></td>
                                <td><?php echo $ligne['motif']?></td>
                                <td><?php echo $ligne['montant']?></td>
                                <td><?php echo $ligne['dateEntre']?></td>
                                <td><a href="update/update_entre2.php?id=<?php echo $ligne['idEntre'] ?>" class="link-dark"><i class="bi bi-pencil-square"></i></a></td>
                                
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
            <?php
                endif;
                }
            ?>
            <br>
            <?php echo "<img src = 'histogramme/histogramme_entre.php'";?>

            <?php
                //UPDATE EGLISE
                if(!empty($montant)){
                $requete_update = $conn->prepare("UPDATE eglise SET solde = solde +".$montant." WHERE idEglise = 'a1' ");
                $result_update = $requete_update->execute();
                }else{
                    // echo "entrer le montant";
                }

            ?>

        </div>
      </div>

    </div>

    

</div>

<?php require "foot.php";?>