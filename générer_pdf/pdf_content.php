<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF</title>

    <style>
        thead{
            background-color: black;
            color: beige;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Mouvement de caisse entre deux dates</h1>
    <br>
    
    <h2>les entrées sont: </h2>
    <?php
    //CONCERNANT L'ENTRE
    $sql1 = "SELECT * FROM entre WHERE dateEntre BETWEEN '".$_POST['date11']."' AND '".$_POST['date22']."'";

    $query1 = $conn->query($sql1);

    $entres = $query1->fetchAll(); 
    ?>
    <table class="table" border="1px" style="border-collapse: collapse; width:600px;">
        <thead >
            <th>Identifiant</th>
            <th>Motif</th>
            <th>Montant</th>
            <th>Date</th>
        </thead>
        <tbody>
            <?php foreach($entres as $caisse_entre):?>
                <tr>
                    <td><?= $caisse_entre['idEntre']?></td>
                    <td><?= $caisse_entre['motif']?></td>
                    <td><?= $caisse_entre['montant']?></td>
                    <td><?= $caisse_entre['dateEntre']?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
<?php
    //CALCUL DU SOMME D'ENTRE
    $somme_montant_entre = "SELECT SUM(montant) as sum FROM entre WHERE dateEntre BETWEEN '".$_POST['date11']."' AND '".$_POST['date22']."'";
    $result4 = $conn->query($somme_montant_entre);
    $data4=$result4->fetch(PDO::FETCH_ASSOC);
    echo "<h3>Total :".$data4["sum"]." </h3>";
?>

    <br>
    <h2>les dépenses sont: </h2>
    <?php

    //CONCERNANT LA SORTIE
    $sql = "SELECT * FROM sortie WHERE dateSortie BETWEEN '".$_POST['date11']."' AND '".$_POST['date22']."'";

    $query = $conn->query($sql);

    $sorties = $query->fetchAll(); 
    ?>
    <table class="table" border="1px" style="border-collapse: collapse; width:600px;">
        <thead>
            <th>Identifiant</th>
            <th>Motif</th>
            <th>Montant</th>
            <th>Date</th>
        </thead>
        <tbody>
            <?php foreach($sorties as $caisse_sortie):?>
                <tr>
                    <td><?= $caisse_sortie['idSortie']?></td>
                    <td><?= $caisse_sortie['motif']?></td>
                    <td><?= $caisse_sortie['montant']?></td>
                    <td><?= $caisse_sortie['dateSortie']?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php
    //CALCUL DU SOMME SORTIE
    $somme_montant = "SELECT SUM(montant) as sum FROM sortie WHERE dateSortie BETWEEN '".$_POST['date11']."' AND '".$_POST['date22']."'";
    $result3 = $conn->query($somme_montant);
    $data3=$result3->fetch(PDO::FETCH_ASSOC);
    echo "<h3>Total :".$data3["sum"]." </h3>";
?>

</body>
</html>