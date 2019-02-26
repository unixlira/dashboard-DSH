<?php
require_once('conecta.php');
ini_set('default_charset', 'UTF-8');
ini_set('memory_limit', '1536M');

$db_record = $_GET['tb']; // Pegando a tabela a gerar CSV
$id_usuario = $_GET['usr']; // Pegando o usuario

$id_usuario = anti_injection($id_usuario);
$db_record = anti_injection($db_record);

if ($db_record == 'wp_users' || $db_record == 'wp_comments' || $db_record == 'wp_commentmeta') { //tabelas válidas
	$csv_filename = 'Relatório_Performance'.$db_record.date('d-m-Y H:i:s').'.csv';
	
	header('Content-Encoding: UTF-8');
	header('Content-Type: application/csv; charset=UTF-8');
	header("Content-Disposition: attachment; filename='".$csv_filename."'");

	$file = fopen('php://output', 'w');
	fputs( $file, "\xEF\xBB\xBF" );

	// Fazendo o select na tabela correspondente:
	$query = '';


	if ($db_record == 'wp_users') {
		$query = mysqli_query($conexao, 'SELECT  (SELECT COUNT(ID) AS cadastros FROM wp_users WHERE  DAY(user_registered) = '.$i.')  as cadastros,(SELECT COUNT(comment_ID) AS cadastros FROM wp_comments WHERE  DAY(comment_date_gmt) = '.$i.')  as comentarios,(SELECT DISTINCT COUNT(meta_key) AS totalCursos FROM wp_commentmeta WHERE  DAY(meta_value) = '.$i.')  as cursos,(SELECT	DISTINCT COUNT(comment_approved)  FROM wp_comments WHERE  DAY(comment_date_gmt) = '.$i.' AND comment_approved = "complete")  as cursosCompletos,(SELECT	DISTINCT COUNT(post_type)  FROM wp_posts WHERE  DAY(post_date_gmt) = '.$i.' AND post_type = "quiz")  as avaliacoes,(SELECT	DISTINCT COUNT(post_type)  FROM wp_posts WHERE  DAY(post_date_gmt) = '.$i.' AND post_type = "sensei_message")  as contatos'.$db_record);
	

	}else{
		$query = mysqli_query($conexao, "SELECT * FROM ".$db_record);
	}	
	

	// Montando o CSV:
	$field = mysqli_field_count($conexao);

	// Pegando os títulos:
	$titulos = array();
	for($i = 0; $i < $field; $i++) {
		array_push($titulos, mysqli_fetch_field_direct($query, $i)->name);
	}

	if ($db_record == 'wp_users') {
		array_push($titulos, 'tipo');
	}
	
	fputcsv($file, $titulos, ";");

	// Pegando todas as linhas:
	while($row = mysqli_fetch_array($query)) {
		$dados = array();
		$cpf = 0;
		for($i = 0; $i < $field; $i++) {
	        array_push($dados, $row[mysqli_fetch_field_direct($query, $i)->name]);
	        if ($i == 3 && $db_record == 'wp_users') {
	        	if (strlen($row[mysqli_fetch_field_direct($query, 3)->name]) < 12) {
	        		$cpf = 'F';
	        	}else{
	        		$cpf = 'J';
	        	}
	        }
	    }
	    if ($db_record == 'wp_users') {
	    	array_push($dados, $cpf);
	    }
		fputcsv($file, $dados, ";");
	}
	fclose($file);
	
	// -- Registrando o Download -- //
	if ($db_record == 'wp_users') {
		$db_record = 'Relatório Performance';
	}
	$sql = "insert into acoes_recentes (id_usuario, acao, link, created_at, updated_at) values (".$id_usuario.",'Geração de CSV - ".$db_record."','/relatorios/performance".$id_usuario."', now(), now())";
	mysqli_query($conexao, $sql) or die('Erro: ' . mysqli_error($conexao));
	
	mysqli_close($conexao);
}

function anti_injection($campo){
	$campo = trim($campo);//limpa espaços vazio
    $campo = str_replace(' ', '', $campo);//limpa espaços do conteudo
	$campo = strip_tags($campo);//tira tags html e php
	$campo = addslashes($campo);//Adiciona barras invertidas a uma string
	return $campo;
}
?>