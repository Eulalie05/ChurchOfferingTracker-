
<?php
 
use Dompdf\Dompdf;
 
require "../connection.php";

if(!empty($_POST['date11']) && !empty($_POST['date22'])){

    ob_start();
    require_once "pdf_content.php";
    $html =  ob_get_contents();
    ob_end_clean();

    //GENERATION DU PDF 2
    require_once "dompdf/autoload.inc.php";

    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $dompdf->stream('fiche.pdf');

    }
else{
    header("Location:../case.php");
}
 ?>


