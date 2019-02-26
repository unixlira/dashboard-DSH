<?php 
namespace App\Http\Controllers; //obrigatorio a definicao do namespace do diretorio q contem as classes q vamos extender

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; //chamando a classe extendida
use Illuminate\Support\Facades\DB; //classe de comunicacao com o BD
use View;
use App\Chat;

class ChatController extends Controller
{
	public function __construct()
    {
        $this->middleware('autorizador'); //invocamos o middleware q verifica o login
    }
	
	public function carregaContatos(){
		//Pegando Lista de Contatos do BD select a.id, a.nome, a.status_chat, b.id_destinatario, b.id_usuario from usuarios a left join chat b on a.id = b.id_usuario and b.created_at = b.updated_at and b.id_destinatario =1 group by a.id order by a.status_chat desc, a.nome asc
		$contatos = DB::select('SELECT a.id, a.nome, a.status_chat, a.ativo, a.permissao, b.id_destinatario, b.id_usuario FROM usuarios a LEFT JOIN chat b ON a.id = b.id_usuario AND b.created_at = b.updated_at AND b.id_destinatario = '.\Request::session()->get("id_usuario").' ORDER BY a.status_chat DESC, a.nome ASC;');
		return \Response::json($contatos);
	}
	
	public function carregaMensagens($id,$destinatario){
		//Pegando Lista de Contatos do BD
		$mensagens = DB::select('SELECT * FROM appnagumo.chat WHERE id_usuario IN('.$id.','.$destinatario.') AND id_destinatario IN('.$id.','.$destinatario.')');
		return \Response::json($mensagens);
	}
	
	public function visualizarMensagem($id,$destinatario){
		//Atualizando updated_at (visualizou) onde o usuario logado é o destinatario:
		Chat::where('id_usuario', $destinatario)->where('id_destinatario', $id)->update(array('updated_at' => date('Y-m-d H:i:s')));
		return \Response::json(array('success' => true));
	}
		
	public function enviaMensagem(Request $request){
		//enviando mensagem:
		$mensagem = new Chat;
		$mensagem->id_usuario = $request->id_usuario;	
		$mensagem->id_destinatario = $request->id_destinatario;
		$mensagem->mensagem = $request->mensagem; 
		$mensagem->save();

    	return \Response::json(array('success' => true));
	}
}