<?php 
namespace App\Http\Controllers; //obrigatorio a definicao do namespace do diretorio q contem as classes q vamos extender

use App\Http\Controllers\Controller; //chamando a classe extendida
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //classe de comunicacao com o BD
//use Yajra\Datatables\Datatables;
//use Request;
use App\Calendario;
use App\Eventos;
use App\Acoes;
/**
* 
*/
class CalendarioController extends Controller
{
	public function __construct()
    {
        $this->middleware('autorizador'); //invocamos o middleware q verifica o login
    }

	public function calendario() //lista todos eventos do calendario
	{
		$eventos = Eventos::all();
		// pegando os eventos que tem registros no calendario:
		$dados_calendario = Calendario::all();
		$retorno_calendario = ''; //o q vai retornar para a tela do calendario
		foreach($dados_calendario as $d): //montando os itens a exibir no calendario
		$dia = date('j', strtotime( "$d->data_evento + 1 day" ));
		$mes = date('n', strtotime( "$d->data_evento + 1 day" ));
		$mes--; //retiramos 1 do mes
		$ano = date('Y', strtotime( "$d->data_evento + 1 day" ));
			$retorno_calendario.= '{id:'.$d->id.',title:"'.$d->evento.'", start: new Date('.$ano.','.$mes.','.$dia.'), backgroundColor: "'.$d->cor_fundo.'"},';
		endforeach;
		//removendo a ultima virgula:
		$retorno_calendario = substr($retorno_calendario,0, strlen($retorno_calendario)-1);
		return view('calendario/calendario', compact('retorno_calendario'))->with("eventos", $eventos);
	}

	public function salvarEvento(Request $request) //Salva novo Evento
	{	
		$evento = new Eventos;
		$evento->id_usuario = \Request::session()->get('id_usuario');
		$evento->evento = $request->evento;
		$evento->cor_fundo = $request->cor;
		$evento->save();

    	//registrando o ocorrido nas acoes:
    	$acao = new Acoes;
		$acao->id_usuario = \Request::session()->get('id_usuario');
		$acao->acao = 'Cadastro de Novo Evento';
		$acao->link = 'calendario/calendario';
		$acao->save();

    	//Retornando resposta JSON ao arquivo file_uploads.js
    	return \Response::json(array('success' => true));
	}

	public function salvaDataEvento(Request $request) //salva evento no calendario
	{	
		$dados_evento = Eventos::find($request->id_evento); //pegando os dados do evento pra copiar para a tb calendario
		
		$evento = new Calendario;
		$evento->id_usuario = \Request::session()->get('id_usuario');
		$evento->evento = $dados_evento->evento;
		$evento->cor_fundo = $dados_evento->cor_fundo;
		$evento->data_evento = date('Y-m-d',strtotime(substr($request->data_evento, 0, strpos($request->data_evento, 'G'))));
		$evento->save();

    	//registrando o ocorrido nas acoes:
    	$acao = new Acoes;
		$acao->id_usuario = \Request::session()->get('id_usuario');
		$acao->acao = 'Registro de Evento no dia '. str_replace('-' , '/' , date('d-m-Y',strtotime(' + 1 day',strtotime(substr($request->data_evento, 0, strpos($request->data_evento, 'G'))))));
		$acao->link = 'calendario/calendario';
		$acao->save();
    	//Retornando resposta JSON ao arquivo file_uploads.js
    	return \Response::json(array('success' => true));
	}

	public function atualizarEventoCalendario(Request $request) //atualiza um evento no calendario
	{	
		$evento = Calendario::find($request->id); //pegando os dados do evento pra copiar para a tb calendario
		
		$evento->id_usuario = \Request::session()->get('id_usuario');
		$evento->evento = $request->evento;
		$evento->cor_fundo = $request->cor_fundo;
		$evento->updated_at = date('Y-m-d H:i:s');
		$evento->save();

    	//registrando o ocorrido nas acoes:
    	$acao = new Acoes;
		$acao->id_usuario = \Request::session()->get('id_usuario');
		$acao->acao = 'Atualização do evento do dia '. str_replace('-' , '/' , date('d-m-Y',strtotime(' + 1 day', strtotime($evento->data_evento))));
		$acao->link = 'calendario/calendario';
		$acao->save();

    	//Retornando resposta JSON ao arquivo file_uploads.js
    	return \Response::json(array('success' => true));
	}

	public function mudaDataEvento(Request $request) //atualiza um evento no calendario
	{	
		$evento = Calendario::find($request->id); //pegando os dados do evento pra copiar para a tb calendario
		$data_anterior = $evento->data_evento;

		$evento->id_usuario = \Request::session()->get('id_usuario');
		$evento->data_evento = date('Y-m-d',strtotime(substr($request->novaData, 0, strpos($request->novaData, 'G'))));
		$evento->updated_at = date('Y-m-d H:i:s');
		$evento->save();

		//registrando o ocorrido nas acoes:
    	$acao = new Acoes;
		$acao->id_usuario = \Request::session()->get('id_usuario');
		$acao->acao = 'Evento mudado de '.str_replace('-' , '/' , date('d-m-Y',strtotime(' + 1 day', strtotime($data_anterior)))).' para '. str_replace('-' , '/' , date('d-m-Y',strtotime(' + 1 day', strtotime(substr($request->novaData, 0, strpos($request->novaData, 'G'))))));
		$acao->link = 'calendario/calendario';
		$acao->save();

    	//Retornando resposta JSON ao arquivo file_uploads.js
    	return \Response::json(array('success' => true));
	}

	public function excluirEvento(Request $request) //excluindo evento
	{	
		$evento = Eventos::find($request->id); //fazendo select passando a clausula where usando funcao find
		if ($evento) { //verificando se existe o registro antes de remover
			$evento->delete(); //efetuando a remocao

	    	//registrando o ocorrido nas acoes:
	    	$acao = new Acoes;
			$acao->id_usuario = \Request::session()->get('id_usuario');
			$acao->acao = 'Exclusão de evento da listagem';
			$acao->link = 'calendario/calendario';
			$acao->save();
		}
    	//Retornando resposta JSON ao arquivo file_uploads.js
    	return \Response::json(array('success' => true));
	}

	public function excluirEventoCalendario(Request $request) //excluindo evento do calendario
	{	
		$evento = Calendario::find($request->id); //fazendo select passando a clausula where usando funcao find
		if ($evento) { //verificando se existe o registro antes de remover
			$evento->delete(); //efetuando a remocao

	    	//registrando o ocorrido nas acoes:
	    	$acao = new Acoes;
			$acao->id_usuario = \Request::session()->get('id_usuario');
			$acao->acao = 'Exclusão de evento do dia '. str_replace('-' , '/' , date('d-m-Y',strtotime(' + 1 day', strtotime($evento->data_evento))));
			$acao->link = 'calendario/calendario';
			$acao->save();
		}
    	//Retornando resposta JSON ao arquivo file_uploads.js
    	return \Response::json(array('success' => true));
	}
}