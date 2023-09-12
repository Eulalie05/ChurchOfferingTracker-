<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Services Disponibles</title>
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
</head>
<body>
    <?php
        include("connection.php");
    ?>
    <?php
        include("html.php");
    ?>
    <div class="container" style="margin-top: 2.6rem;">
        <div class="row d-flex justify-content-center align-items-center text-center">
            <h1 style="border: solid 2.5px black; width: 1000px;">Affichage de la table eglise</h1>
            <table class="table table-hover text-center" style="margin-top: 4.2rem;">
            <thead class="table-dark">
                <tr>
                    <th scope="col">identifiant</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Solde</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $requette_affiche = "SELECT * FROM eglise";
                    $resultat_affiche = $conn->query($requette_affiche);
                
                    if(!$requette_affiche){
                        echo "un erreur c'est produit lors de l'affichage du liste des eglises";
                    }
                    while($ligne = $resultat_affiche->fetch(PDO::FETCH_NUM)){
                        echo "<tr>";
                        foreach ($ligne as $valeur){
                            echo "<td>$valeur</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
        </div>
        <div class="row justify-content-around" style="margin-top: 10rem;">
            <div class="col-2">
                <a href="entre.php" class="btn btn-success">Caisse Entrer</a>
            </div>
            <div class="col-2">
            <a href="sortie.php" class="btn btn-success">Caisse Sortie</a>
            </div>
        </div>
        <div class="row mt-4 justify-content-around">
            <div class="col">
                <h4>Voir plus concernant la table Entrer</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda perferendis laboriosam illum, deserunt nesciunt nobis esse tempora doloremque commodi, maiores incidunt suscipit at corrupti non fugiat unde. Modi, a velit.</p>
            </div>
            <div class="col">
            <h4>Voir plus concernant la table Sortie</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda perferendis laboriosam illum, deserunt nesciunt nobis esse tempora doloremque commodi, maiores incidunt suscipit at corrupti non fugiat unde. Modi, a velit.</p>
            </div>
        </div>
    </div>
    <?php
        include("foot.php");
    ?>
<script src="bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>