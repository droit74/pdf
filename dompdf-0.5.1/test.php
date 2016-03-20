<?php
/**
 * Created by PhpStorm.
 * User: sto
 * Date: 20.03.2016
 * Time: 3:53
 */

require_once("dompdf_config.inc.php");

$html = "
<html>
<head>

<font face=\"arial\"><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />

</head>

<body>

  вавапаупкуукпкуц

</body>
</html>
";




$dompdf = new DOMPDF();
$dompdf->load_html($html);
// (Optional) Setup the paper size and orientation
$dompdf->set_paper(DOMPDF_DEFAULT_PAPER_SIZE, 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Get the generated PDF file contents


// Output the generated PDF to Browser


//$pdf = $dompdf->output();
$pdf = '111';

file_put_contents($pdf, $dompdf->output());
// Output the generated PDF to Browser
$dompdf->stream();