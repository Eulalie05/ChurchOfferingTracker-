<?php
    require_once ('src/jpgraph.php');
    require_once ('src/jpgraph_bar.php');
    require "../connection.php";

    $requet = "SELECT * FROM entre";
    $query = $conn->query($requet);
    $pdo = $query->fetchAll(PDO::FETCH_OBJ);
    $date = [];
    $montant = [];
    foreach($pdo as $data){
        $montant[] = $data->montant; 
        $date[] = $data->dateEntre;
    }
    if(!empty($montant)){        
    // Create the graph. These two calls are always required
    $graph = new Graph(600,320,'auto');
    $graph->SetScale("textlin");
    $graph->img->SetMargin(60,30,20,40);
    //$theme_class="DefaultTheme";
    //$graph->SetTheme(new $theme_class());
    // set major and minor tick positions manually
    $tab = [];
    for($i = 0; $i < 1000000000; $i +=5000 ){
        $tab[] = $i;
    }
    // $graph->yaxis->SetTickPositions(array(0,1000,5000,10000,15000,20000,30000,35000,40000,50000,60000,70000,75000,80000,90000,100000,125000,165000,180000,200000,500000,750000,1000000,3000000,5000000,10000000,100000000,1000000000));
    $graph->yaxis->SetTickPositions($tab);
    $graph->SetBox(false);
    //$graph->ygrid->SetColor('gray');
    $graph->ygrid->SetFill(false);
    $graph->xaxis->SetTickLabels($date);
    $graph->yaxis->HideLine(false);
    $graph->yaxis->HideTicks(false,false);
    // Create the bar plots
    $b1plot = new BarPlot($montant);
    // ...and add it to the graPH
    $graph->Add($b1plot);
    $b1plot->SetColor("white");
    $b1plot->SetFillGradient("#0000","white",GRAD_LEFT_REFLECTION);
    $b1plot->SetWidth(45);
    $graph->title->Set("Mouvement d'entrer de caisse");
    $graph->xaxis->title->Set("Date");
    // $graph->yaxis->title->Set("Entrer de caisse");
    // Display the graph
    $graph->Stroke();}
?>