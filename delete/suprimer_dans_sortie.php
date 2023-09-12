<?php require "../connection.php";?>

<?php 

    $identre = $_POST['idEntre'];

    if(!empty($identre)){
        $ancien_solde3 = "SELECT montant FROM sortie WHERE idSortie = $identre";
        $result3 = $conn->query($ancien_solde3);
        $data3=$result3->fetch(PDO::FETCH_ASSOC);
        $new_montant = $data3['montant'];
        
        $requet = "DELETE FROM sortie WHERE idSortie = $identre";
        $result = $conn->exec($requet);
    }

    //UPDATE SOLDE
    $solde = "SELECT solde FROM eglise WHERE idEglise = 'a1' ";
    $result = $conn->query($solde);
    $data=$result->fetch(PDO::FETCH_ASSOC);
    $solde = $data['solde'];  

    $new_solde = $solde + $new_montant;
    $msj_solde = $conn->prepare("UPDATE eglise SET solde = $new_solde");
    $result_msj_solde = $msj_solde->execute();

    header("Location:../sortie.php");

?>
