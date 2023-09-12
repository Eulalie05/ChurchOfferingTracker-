<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mouvement de Caisse</title>
</head>
<body style="background-color: whitesmoke;">
    <?php
        include("connection.php");
        include("html.php");
    ?>
    <div class="container" style="margin-top: 3rem;">
        <div class=" d-flex text-center justify-content-center" style="margin-bottom: 4rem;">
            <h1 class="border border-dark border-2 w-75">Mouvement de Caisse entre Deux Dates</h1>
        </div>
        <div class="Entrer" style="margin-bottom: 4rem;">
            <form method="post" action="case.php">
                <h4 class="text-center">Caisse Entrer et Sortie</h4>
                <div class="input-group">
                    <span class="input-group-text">Date Entre</span>
                    <input type="date" aria-label="date1" name="date1" class="form-control">
                    <input type="date" aria-label="date2" name="date2" class="form-control">
                    <button type="submit" class="btn btn-info" value="soumettre">soumettre</button>
                    <button type="reset" class="btn btn-warning" value="effacer">Effacer</button>
                </div>       
            </form>
        </div>
        <div class="" style="margin-top: 1.5rem;">
            <div class="row d-flex justify-content-center align-items-center text-center">
                <div class="jumbotron">
                        <?php
                            if(!empty($_POST['date1']) && !empty($_POST['date2'])){
                                ?><table class="table table-hover text-center" style="margin-top: 2.2rem;">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">identifiant</th>
                            <th scope="col">Motif</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $date1 = $_POST['date1'];
                            $date2 = $_POST['date2'];
                
                            //AFFICHAGE DE L'ENTRER
                            echo "<h3>Fiche de resume de mouvement entre ".$date1." jusqu'a ".$date2."</h3>";
                        
                            $requette_affiche_entre = "SELECT * FROM entre WHERE dateEntre BETWEEN '".$date1."' AND '".$date2."'";
                            $resultat_affiche_entre = $conn->query($requette_affiche_entre);
                
                                if(!$requette_affiche_entre){
                                    echo "un erreur c'est produit lors de l'affichage du liste des entrée entre ces date";}
                                else{
                                    $nbr_eglise = $resultat_affiche_entre->rowCount();
                                }
                
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

                //CALCUL DU SOMME D'ENTRE
                $somme_montant_entre = "SELECT SUM(montant) as sum FROM entre WHERE dateEntre BETWEEN '".$date1."' AND '".$date2."'";
                $result4 = $conn->query($somme_montant_entre);
                $data4=$result4->fetch(PDO::FETCH_ASSOC);
                echo "<h3>Total :".$data4["sum"]." </h3>";


                //AFFICHAGE DE SORTIE
                $requette_affiche_sortie = "SELECT * FROM sortie WHERE dateSortie BETWEEN '".$date1."' AND '".$date2."'";
                $resultat_affiche_sortie = $conn->query($requette_affiche_sortie);

                if(!$requette_affiche_sortie):
                    echo "un erreur c'est produit lors de l'affichage du liste des entrée entre ces date";
                else:

                    $nbr_eglise = $resultat_affiche_sortie->rowCount();
                ?>

                    <table class="table table-hover text-center" style="margin-top: 3.2rem;">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">identifiant</th>
                                <th scope="col">Motif</th>
                                <th scope="col">Montant</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                <?php
                while($ligne = $resultat_affiche_sortie->fetch(PDO::FETCH_NUM)){
                    echo "<tr>";
                    foreach ($ligne as $valeur){
                        echo "<td>$valeur</td>";
                    }
                    echo "</tr>";
                }
                ?>
                    </table>
        
                <?php

                //CALCUL DU SOMME SORTIE
                $somme_montant = "SELECT SUM(montant) as sum FROM sortie WHERE dateSortie BETWEEN '".$date1."' AND '".$date2."'";
                $result3 = $conn->query($somme_montant);
                $data3=$result3->fetch(PDO::FETCH_ASSOC);
                echo "<h3>Total :".$data3["sum"]." </h3>";

                endif;

            }
            //  else{
            //      echo "tous les champs sont requis";
            //  }
    
        ?>
        </div>
            </div>
        </div>
        <center><div class="border border-2 border-dark p-3 mt-5" style="max-width: 500px;">
            <form method="post" action="générer_pdf/pdf.php">
                <h4 class="text-center">Generer le Pdf</h4>
                <div class="input-group">
                    <span class="input-group-text">Telecharger</span>
                    <input type="date" aria-label="date11" name="date11" class="form-control">
                    <input type="date" aria-label="date22" name="date22" class="form-control">
                    <button type="submit" class="btn btn-success" value="Telecharger">Telecharger</button>
                </div>       
            </form>
            </div>
        </center>
    </div>
    <?php
        include("foot.php");
    ?>
</body>
</html>