<?php

if (!isset($_SESSION['id_admin'])) {
    url::redireciona('PaginasController');
}

$degs= $dados['degs'];
$usuarios= $dados['usuarios'];

require   App.'/Views/Paginas/vendor/autoload.php';


$html ="DEGRADAÇÕES";
$html .="<hr>";
$html .="<section class='conteudo'>";
$html .="<div class='lista-deg-admin'>";
foreach ($degs as $deg) {
    $nome= $deg->nome;
    $nome_usuario = $usuarios[$deg->fk_usuario_id]->nome;
    $data= $deg->data_registo;
    $html .="<div class='deg'>";       
    $html .="<div class='detalhes'>";       
    $html .="<h3>";       
    $html .=$nome;       
    $html .="</h3>";       
    $html .="<a href=''>";       
    $html .="cadastrado por: <br> <h4>";    
    $html .= $nome_usuario; 
    $html .=  "</h4></a>";
    $html .="<p>Data de registo:</p>";       
    $html .="<p>";       
    $html .= $data;       
    $html .="</p>";       
    $html .="</div>";       
    $html .="</div> ";             

  }




$html .=" </div>";
$html .="</section>";



// reference the Dompdf namespace

use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf(['enable_remote'=>true]);

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();   

?>



   
   

