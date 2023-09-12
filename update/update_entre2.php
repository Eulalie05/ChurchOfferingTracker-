<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>modification_entre</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../signin.css">
    <style>
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
    </style>
</head>
<body>

<?php

    // if(empty($_POST['idEntre'])){
    //     header("Location:update_entre.php");
    // }
    
    require "../connection.php";
    $idEntre = $_GET['id'];

    //VALEUR DE L'ANCIEN MONTANT 
    // $idEntre = $_POST['idEntre'];

    // $idEntre = $_POST['idEntre'];
    $ancien_solde2 = "SELECT montant FROM entre WHERE idEntre = $idEntre";
    $result2 = $conn->query($ancien_solde2);
    $data2=$result2->fetch(PDO::FETCH_ASSOC);
    $ancien_montant = $data2['montant'];

    if(!isset($_POST["modifier"])){
    // $idEntre = $_POST['idEntre'];
    
    $requete = "SELECT * FROM entre WHERE idEntre = '$idEntre'";
    $result = $conn->query($requete);
    $data=$result->fetch(PDO::FETCH_ASSOC);

?>

<input type="hidden" name="ancien_montant" value="<?=$ancien_montant?>">

<!-- <form action="update_entre2.php?id=<?php //echo $_GET['id'];?>" method="post">
    <fieldset>
        <legend><b>Faire une modification dans le table entre</b></legend>
        <table>
            <tr><td>Motif : </td><td><input type="text" name="motif" value="<?//=$data['motif']?>"></td></tr>
            <tr><td>Montant : </td><td><input type="int" name="montant" value="<?//=$data['montant']?>"></td></tr>
            <tr><td>Date : </td><td><input type="date" name="dateEntre" value="<?//=$data['dateEntre']?>"></td></tr>

            <tr>
                <td><input type="reset" name="reset" value="reset"></td>
                <td><input type="submit" name="modifier" value="modifier"></td>
            </tr>
        </table>
    </fieldset>

    <input type="hidden" name="idEntre" value="<?//=$idEntre?>">
</form> -->

<main class="form-signin">
  <form action="update_entre2.php?id=<?php echo $_GET['id'];?>" method="post">
  <center><img class="mb-4" src="../image/logo.jpg" alt="" width="72" height="57">
    <h1 class="h3 mb-3 fw-normal">effectuer votre modification</h1></center>

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" name="motif" value="<?=$data['motif']?>"><br>
      <label for="floatingInput">Motif</label>
    </div>
    <div class="form-floating">
      <input type="int" class="form-control" id="floatingPassword" name="montant" value="<?=$data['montant']?>"><br>
      <label for="floatingPassword">Montant</label>
    </div>
    <div class="form-floating">
      <input type="date" class="form-control" id="floatingPassword" name="dateEntre" value="<?=$data['dateEntre']?>"><br>
      <label for="floatingPassword">Date</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" name="modifier" value="modifier">Modifier</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
    <input type="hidden" name="idEntre" value="<?=$idEntre?>">
  </form>
</main>

<?php
$result->closeCursor();
}
elseif(isset($_POST['motif']) && isset($_POST['montant']) && isset($_POST['dateEntre'])){

    $motif = $_POST['motif'];
    $montant = $_POST['montant'];
    $dateEntre = $_POST['dateEntre'];

    $idEntre = $_POST['idEntre'];

    $requete = $conn->prepare("UPDATE entre SET motif=:motif, montant=:montant, dateEntre=:dateEntre WHERE idEntre=:idEntre");

    $requete->bindValue(":motif", $motif);
    $requete->bindValue(":montant", $montant);
    $requete->bindValue(":dateEntre", $dateEntre);
    $requete->bindValue(":idEntre", $idEntre);

    $result = $requete->execute();

    if(!$result){
        echo "une erreur c'est produit, l'enregistrement n'as pas été faite";
    }
    else{
        // echo "vos modification ont été bien effectuer";
        header("Location:../entre.php");
    }
    
}
else{
    echo "effectuer vos modification";
}

//UPDATE SOLDE
$solde = "SELECT solde FROM eglise WHERE idEglise = 'a1' ";
$result = $conn->query($solde);
$data=$result->fetch(PDO::FETCH_ASSOC);
$solde = $data['solde'];


$ancien_solde3 = "SELECT montant FROM entre WHERE idEntre = $idEntre";
$result3 = $conn->query($ancien_solde3);
$data3=$result3->fetch(PDO::FETCH_ASSOC);
$new_montant = $data3['montant'];

$new_solde = ($solde - $ancien_montant) + $new_montant;
$msj_solde = $conn->prepare("UPDATE eglise SET solde = $new_solde");
$result_msj_solde = $msj_solde->execute();

?>
</body>
</html>