<?php 
namespace App\Http\Controllers; //obrigatorio a definicao do namespace do diretorio q contem AS classes q vamos extender

use App\Http\Controllers\Controller; //chamando a classe extendida
use Illuminate\Support\Facades\DB; //classe de comunicacao com o BD
use Yajra\Datatables\Datatables;
use Request;
use Session;
use App\WP_Users;
use App\WP_Comentario;

class RelatoriosController extends Controller
{
	public function __construct()
    {
        $this->middleware('autorizador'); //invocamos o middleware q verifica o login
    }



	public function performance()
	{
		$titulo = "Relatórios de Performance";
		$acao = "usuarios/adicionarUsuario";
		$cabecalho = "Inserir Informações Pessoais";
		//Relatorio Table
		$cadastros = DB::select("SELECT DISTINCT DAY(user_registered) as diacad, COUNT(DISTINCT id) cadastros FROM wp_users GROUP BY DAY(user_registered)");
					 
						 
		$comentarios = DB::select("SELECT DISTINCT DAY(comment_date) as diacom, COUNT(DISTINCT comment_ID) cadastros FROM wp_comments GROUP BY DAY(comment_date)");
		//dd($cadastros);

		return view('relatorios.performance', compact('titulo','acao','cabecalho','cadastros','comentarios'));
	}

	public function dataperformance($mes, $ano)
	{
		
		$contador = 1;		
		$cadastros = array();
			for ($i=0; $i <= (cal_days_in_month(CAL_GREGORIAN, $mes, $ano) -1); $i++) { 
				
				$dia_sql = DB::select('SELECT  (SELECT COUNT(ID) AS cadastros FROM wp_users WHERE  DAY(user_registered) = '. $contador .' AND MONTH(user_registered) = '. $mes .' AND YEAR(user_registered) = '. $ano .')  as cadastros,(SELECT COUNT(comment_ID) AS cadastros FROM wp_comments WHERE DAY(comment_date_gmt) = '.$contador .' AND MONTH(comment_date_gmt) = '. $mes .' AND YEAR(comment_date_gmt) = '. $ano .')  as comentarios,(SELECT DISTINCT COUNT(meta_key) AS totalCursos FROM wp_commentmeta WHERE DAY(meta_value) = '. $contador .' AND MONTH(meta_value) = '. $mes .' AND YEAR(meta_value) = '. $ano .')  as cursos,(SELECT	DISTINCT COUNT(comment_approved)  FROM wp_comments WHERE DAY(comment_date_gmt) = '. $contador .' AND MONTH(comment_date_gmt) = '. $mes .' AND YEAR(comment_date_gmt) = '. $ano .' AND comment_approved = "complete")  as cursosCompletos,(SELECT	DISTINCT COUNT(post_type)  FROM wp_posts WHERE DAY(post_date_gmt) = '. $contador .' AND MONTH(post_date_gmt) = '. $mes .' AND YEAR(post_date_gmt) = '. $ano .' AND post_type = "quiz")  as avaliacoes,(SELECT	DISTINCT COUNT(post_type)  FROM wp_posts WHERE DAY(post_date_gmt) = '. $contador .' AND MONTH(post_date_gmt) = '. $mes .' AND YEAR(post_date_gmt) = '. $ano .' AND post_type = "sensei_message")  as contatos'); 
				
				$cadastros[$i]= $dia_sql[0];
				$contador++;
				
			}
		return \Response::json($cadastros);

	}

}