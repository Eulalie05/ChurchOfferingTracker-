<?php 
$title = "Mouvement de caisse";
require "header_and_footer/header.php";
?>

<?php require "connection.php";?>

<br>
<h2>Mouvement de caisse entre deux date</h2>
<br>

<form action="mouvement_caisse.php" method="post">
    Date 1: <input type="date" name="date1"><br>
    Date 2: <input type="date" name="date2"><br>
    <input type="submit" value="voir">
</form>

<?php 

    if(!empty($_POST['date1']) && !empty($_POST['date2'])){
        echo "<h1>Mouvement de caisse entre deux date</h1>";
        $date1 = $_POST['date1'];
        $date2 = $_POST['date2'];

        //AFFICHAGE DE L'ENTRER
        echo "Entrer de caisse entre ".$date1." jusqu'a ".$date2;
        
        $requette_affiche_entre = "SELECT * FROM entre WHERE dateEntre BETWEEN '".$date1."' AND '".$date2."'";
        $resultat_affiche_entre = $conn->query($requette_affiche_entre);

        if(!$requette_affiche_entre):
            echo "un erreur c'est produit lors de l'affichage du liste des entrée entre ces date";
        else:

            $nbr_eglise = $resultat_affiche_entre->rowCount();
        ?>

        <table border="1px">
            <tr>
                <th>idEntre</th>
                <th>Motif</th>
                <th>Montant</th>
                <th>Date</th>
            </tr>

        <?php
        while($ligne = $resultat_affiche_entre->fetch(PDO::FETCH_NUM)){
            echo "<tr>";
            foreach ($ligne as $valeur){
                echo "<td>$valeur</td>";
            }
            echo "</tr>";
        }
        ?>
            </table>

        <?php

        //CALCUL DU SOMME D'ENTRE
        $somme_montant_entre = "SELECT SUM(montant) as sum FROM entre WHERE dateEntre BETWEEN '".$date1."' AND '".$date2."'";
        $result4 = $conn->query($somme_montant_entre);
        $data4=$result4->fetch(PDO::FETCH_ASSOC);
        echo "<h3>Total :".$data4["sum"]." </h3>";

        endif;

        //AFFICHAGE DE SORTIE
        $requette_affiche_sortie = "SELECT * FROM sortie WHERE dateSortie BETWEEN '".$date1."' AND '".$date2."'";
        $resultat_affiche_sortie = $conn->query($requette_affiche_sortie);

        if(!$requette_affiche_sortie):
            echo "un erreur c'est produit lors de l'affichage du liste des entrée entre ces date";
        else:

            $nbr_eglise = $resultat_affiche_sortie->rowCount();
        ?>

        <table border="1px">
            <tr>
                <th>idSortie</th>
                <th>Motif</th>
                <th>Montant</th>
                <th>Date</th>
            </tr>
        
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
    else{
        echo "tous les champs sont requis";
    }
    
?>
 <br>


<form action="générer_pdf/pdf.php" method="post">
    Date 1 a telecharger: <input type="date" name="date11"><br>
    Date 2 a telecharger: <input type="date" name="date22"><br>
    <input type="submit" value="download">
</form>

<?php require "header_and_footer/footer.php";?>

