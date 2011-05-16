<?php
//include ("../../../jpgraph-2.3.3/src/jpgraph.php");
//include ("../../../jpgraph-2.3.3/src/jpgraph_line.php");
App::import('Vendor', 'jpgraph', array('file'=>'jpgraph/jpgraph.php'));
App::import('Vendor', 'jpgraph_line', array('file'=>'jpgraph/jpgraph_line.php'));
App::import('Vendor', 'jpgraph_bar', array('file'=>'jpgraph/jpgraph_bar.php'));
/*
$ydata = array(11,3,8,12,5,1,9,13,5,7);
$y2data = array(354,200,265,99,111,91,198,225,293,251);

// Create the graph and specify the scale for both Y-axis
$graph = new Graph(400,200,"auto");   
$graph->SetScale("textlin");
$graph->SetY2Scale("lin");
$graph->SetShadow();

// Adjust the margin
$graph->img->SetMargin(40,140,20,40);

// Create the two linear plot
$lineplot=new LinePlot($ydata);
$lineplot2=new LinePlot($y2data);

// Add the plot to the graph
$graph->Add($lineplot);
$graph->AddY2($lineplot2);
$lineplot2->SetColor("orange");
$lineplot2->SetWeight(2);

// Adjust the axis color
$graph->y2axis->SetColor("orange");
$graph->yaxis->SetColor("blue");

$graph->title->Set("Example 6");
$graph->xaxis->title->Set("X-title");
$graph->yaxis->title->Set("Y-title");

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Set the colors for the plots 
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);
$lineplot2->SetColor("orange");
$lineplot2->SetWeight(2);

// Set the legends for the plots
$lineplot->SetLegend("Plot 1");
$lineplot2->SetLegend("Plot 2");

// Adjust the legend position
$graph->legend->Pos(0.05,0.5,"right","center");

// Display the graph
$graph->Stroke();*/

//$datay=array(12,26,9,17,31);

// Create the graph. 
// One minute timeout for the cached image
// INLINE_NO means don't stream it back to the browser.
$graph = new Graph(310,300,'auto');
$graph->SetScale("textlin", min($datay)*.9, max($datay)*1.02);
$graph->img->SetMargin(60,60,60,60);
//$graph->yaxis->SetTitleMargin(45);
$graph->yaxis->scale->SetGrace(5);
$graph->SetShadow();
$graph->yaxis->hide();
// Turn the tickmarks
$graph->xaxis->SetTickSide(SIDE_DOWN);
//$graph->yaxis->SetTickSide(SIDE_LEFT);

// Create a bar pot
$bplot = new BarPlot($datay);
//$graph->xaxis->SetTitle("X-title",'center');
//$graph->xaxis->title->SetFont("Arial",FS_BOLD);
//$graph->xaxis->title->SetAngle(90);
//$graph->xaxis->SetTitleMargin(30);
$graph->xaxis->SetLabelMargin(15);
$graph->xaxis->SetLabelAlign('right','center');
$graph->xaxis->SetTickLabels($label);
$graph->xaxis->SetLabelAngle(45);
$graph->xaxis->SetLabelFormat("Arial");
// Create targets for the image maps. One for each column
$targ=array("bar_clsmex1.php#1","bar_clsmex1.php#2","bar_clsmex1.php#3","bar_clsmex1.php#4","bar_clsmex1.php#5","bar_clsmex1.php#6");
$alts=array("val=%d","val=%d","val=%d","val=%d","val=%d","val=%d");
$bplot->SetCSIMTargets($targ,$alts);
$bplot->SetFillColor("orange");

// Use a shadow on the bar graphs (just use the default settings)
$bplot->SetShadow();
$bplot->value->SetFormat(" $ %2.1f",70);
$bplot->value->SetFont(FF_ARIAL,FS_NORMAL,9);
$bplot->value->SetColor("blue");
$bplot->value->Show();

$graph->Add($bplot);

$graph->title->Set($title);
//$graph->xaxis->title->Set("X-title");
//$graph->yaxis->title->Set("Y-title");

$graph->title->SetFont(FF_FONT1,FS_BOLD);
//$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Send back the HTML page which will call this script again
// to retrieve the image.
//$graph->StrokeCSIM();
$graph->Stroke();



?>
