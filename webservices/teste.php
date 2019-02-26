<?php
require_once('conecta.php');


$id_usuario = $_GET['usr']; // Pegando o usuario
$ano = $_GET['ano']; // Pegando o usuario
$mes = $_GET['mes']; // Pegando o usuario


// Fazendo o select na tabela correspondente:
$query = '';
$contador = 1;
$cadastros = array();
for ($i=0; $i <= (cal_days_in_month(CAL_GREGORIAN, $mes, $ano) -1); $i++) {    
    $query = mysqli_query($conexao, 'SELECT  (SELECT COUNT(ID) AS cadastros FROM wp_users WHERE  DAY(user_registered) = '. $contador .' AND MONTH(user_registered) = '. $mes .' AND YEAR(user_registered) = '. $ano .')  as cadastros,(SELECT COUNT(comment_ID) AS comentarios FROM wp_comments WHERE DAY(comment_date_gmt) = '.$contador .' AND MONTH(comment_date_gmt) = '. $mes .' AND YEAR(comment_date_gmt) = '. $ano .')  as comentarios,(SELECT DISTINCT COUNT(meta_key) AS totalCursos FROM wp_commentmeta WHERE DAY(meta_value) = '. $contador .' AND MONTH(meta_value) = '. $mes .' AND YEAR(meta_value) = '. $ano .')  as cursos,(SELECT	DISTINCT COUNT(comment_approved)  FROM wp_comments WHERE DAY(comment_date_gmt) = '. $contador .' AND MONTH(comment_date_gmt) = '. $mes .' AND YEAR(comment_date_gmt) = '. $ano .' AND comment_approved = "complete")  as cursosCompletos,(SELECT	DISTINCT COUNT(post_type)  FROM wp_posts WHERE DAY(post_date_gmt) = '. $contador .' AND MONTH(post_date_gmt) = '. $mes .' AND YEAR(post_date_gmt) = '. $ano .' AND post_type = "quiz")  as avaliacoes,(SELECT	DISTINCT COUNT(post_type)  FROM wp_posts WHERE DAY(post_date_gmt) = '. $contador .' AND MONTH(post_date_gmt) = '. $mes .' AND YEAR(post_date_gmt) = '. $ano .' AND post_type = "sensei_message")  as contatos');
    //$cadastros[$i]= $query->fetch_assoc();
    $cadastros[$i]= mysqli_fetch_assoc($query);
    $contador++;
}

echo json_encode($cadastros);

if ($rows = mysqli_query($link, $cadastros))
{
// loop over the rows, outputting them
while ($row = mysqli_fetch_assoc($rows))
{
fputcsv($file, $row);
}
// free result set
mysqli_free_result($result);
}
// close the connection
mysqli_close($link);
 
exit();







?>