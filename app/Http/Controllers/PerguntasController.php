<?php 
namespace App\Http\Controllers; //obrigatorio a definicao do namespace do diretorio q contem AS classes q vamos extender

use App\Http\Controllers\Controller; //chamando a classe extendida
use Illuminate\Support\Facades\DB; //classe de comunicacao com o BD
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;
use App\WP_Users;
use App\WP_Comentario;
use App\Usuarios;
use App\Acoes;
use App\Medicos;
use App\WP_UserMeta;
use App\WP_Posts;


class PerguntasController extends Controller
{
	public function __construct()
    {
        $this->middleware('autorizador'); //invocamos o middleware q verifica o login
    }
	
	public function index()
	{
		
		return view('perguntas.recebidas');
	}

		
	public function show($id)
	{
		$acao = "/perguntas/resposta";

		$remetentes = DB::select('SELECT distinct u.ID, pm.post_id, pm.meta_key, pm.meta_value, u.user_email as email_sender, u.display_name as nome ,  p.post_content, um.meta_value from wp_postmeta as pm inner join wp_posts as p on p.ID = pm.post_id right join wp_users as u on u.user_login = pm.meta_value inner join wp_usermeta as um on um.user_id = u.ID where post_id= '. $id .' and um.meta_value = u.user_login ' );

		$medico = DB::table('wp_users as u')->join('wp_posts as p', 'u.ID', '=', 'p.post_author')->where('p.ID','=',$id)->get();
		

		return view('perguntas.responder', compact('remetentes','acao','medico'));
		
	}

	public function getPerguntas()
	{
		$perguntas = DB::select('SELECT	p.ID as post_ID, u.ID, u.display_name,  u.user_email, p.post_title, pm.meta_value, p.post_status, um.meta_value as crm FROM wp_users AS u INNER JOIN wp_usermeta AS um ON u.ID = um.user_id INNER JOIN wp_posts AS p ON u.ID = p.post_author INNER JOIN wp_postmeta AS pm ON p.ID = pm.post_id WHERE p.post_type = "sensei_message" AND pm.meta_key = "_receiver" AND um.meta_key = "crm"');

		return Datatables::of($perguntas)->make(true);
	}

	public function resposta(Request $request)
	{

		$resposta = new WP_Comentario;
		$resposta->comment_post_ID = $request->post_id;
		$resposta->comment_author = $request->nome;
		$resposta->comment_author_email = $request->email;
		$resposta->comment_author_IP = $request->ip;
		$resposta->comment_date =  $request->data;
		$resposta->comment_date_gmt = $request->gmt;
		$resposta->comment_content = $request->resposta;
		$resposta->comment_karma = $request->karma;
		$resposta->comment_approved = $request->approved;
		$resposta->comment_parent = $request->parent;
		$resposta->comment_agent = $request->agent;
		$resposta->user_id = $request->user_id;
		
		$resposta->save();

		//registrando a ocorrencia na tabela acao:
		$acao = new Acoes;
		$acao->id_usuario = \Request::session()->get('id_usuario');
		$acao->acao = 'Respondeu a pergunta: '.$request->pergunta;
		$acao->link = '/perguntas/recebidas';
		$acao->save();

		return redirect('/perguntas/recebidas');
	}
}