<?php
require_once('conecta.php');
ini_set('default_charset', 'UTF-8');
ini_set('memory_limit', '1536M');

$id_usuario = $_GET['usr']; // Pegando o usuario
$ano = $_GET['ano']; // Pegando o usuario
$mes = $_GET['mes']; // Pegando o usuario

$id_usuario = anti_injection($id_usuario);
$ano = anti_injection($ano);
$mes = anti_injection($mes);

$csv_filename = 'CSV_TESTE'.date('d-m-Y H:i:s').'.csv';

header('Content-Encoding: UTF-8');
header("Content-Type: text/csv");
header('Content-Type: application/csv; charset=UTF-8');
header("Content-Disposition: attachment; filename=".$csv_filename);


// Fazendo o select na tabela correspondente:
$query = '';
$contador = 1;
$cadastros = array();
for ($i=1; $i <= (cal_days_in_month(CAL_GREGORIAN, $mes, $ano)); $i++) {
    $query = mysqli_query($conexao, 'SELECT  (SELECT COUNT(ID) AS cadastros FROM wp_users WHERE  DAY(user_registered) = '. $contador .' AND MONTH(user_registered) = '. $mes .' AND YEAR(user_registered) = '. $ano .')  as cadastros,(SELECT COUNT(comment_ID) AS comentarios FROM wp_comments WHERE DAY(comment_date_gmt) = '.$contador .' AND MONTH(comment_date_gmt) = '. $mes .' AND YEAR(comment_date_gmt) = '. $ano .')  as comentarios,(SELECT DISTINCT COUNT(meta_key) AS totalCursos FROM wp_commentmeta WHERE DAY(meta_value) = '. $contador .' AND MONTH(meta_value) = '. $mes .' AND YEAR(meta_value) = '. $ano .')  as cursos,(SELECT	DISTINCT COUNT(comment_approved)  FROM wp_comments WHERE DAY(comment_date_gmt) = '. $contador .' AND MONTH(comment_date_gmt) = '. $mes .' AND YEAR(comment_date_gmt) = '. $ano .' AND comment_approved = "complete")  as cursosCompletos,(SELECT	DISTINCT COUNT(post_type)  FROM wp_posts WHERE DAY(post_date_gmt) = '. $contador .' AND MONTH(post_date_gmt) = '. $mes .' AND YEAR(post_date_gmt) = '. $ano .' AND post_type = "quiz")  as avaliacoes,(SELECT	DISTINCT COUNT(post_type)  FROM wp_posts WHERE DAY(post_date_gmt) = '. $contador .' AND MONTH(post_date_gmt) = '. $mes .' AND YEAR(post_date_gmt) = '. $ano .' AND post_type = "sensei_message")  as contatos');
    //$cadastros[$i]= $query->fetch_assoc();
    $cadastros[$i]= mysqli_fetch_assoc($query);
    $contador++;
}


//Fazendo a primeira linha do CSV
$linha =  '"Dia";"Cadastros";"Comentarios";"Cursos";"Cursos Completos";"Avaliacoes";"Contatos"' . "\r\n";

//Looping de dados do Array
foreach($cadastros as $key => $cadastro) {
    $linha .= '"' . $key . '";"' . $cadastro['cadastros'] . '";"' . $cadastro['comentarios'] . '";"' . $cadastro['cursos'] . '";"' . $cadastro['cursosCompletos'] . '";"' . $cadastro['avaliacoes'] . '";"' . $cadastro['contatos'] . '"' . "\r\n";
}

echo $linha;

// -- Registrando o Download -- //
$sql = "insert into acoes_recentes (id_usuario, acao, link, created_at, updated_at) values (".$id_usuario.",'Geração de CSV','/relatorios/performance".$id_usuario."', now(), now())";
mysqli_query($conexao, $sql) or die('Erro: ' . mysqli_error($conexao));

mysqli_close($conexao);

function anti_injection($campo)
{
	$campo = trim($campo);//limpa espaços vazio
    $campo = str_replace(' ', '', $campo);//limpa espaços do conteudo
	$campo = strip_tags($campo);//tira tags html e php
	$campo = addslashes($campo);//Adiciona barras invertidas a uma string
	return $campo;
}

