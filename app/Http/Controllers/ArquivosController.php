<?php 
namespace App\Http\Controllers; //obrigatorio a definicao do namespace do diretorio q contem as classes q vamos extender

use App\Http\Controllers\Controller; //chamando a classe extendida
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //classe de comunicacao com o BD
use Yajra\Datatables\Datatables;
//use Request;
use App\Arquivos;
use App\Acoes;
/**
* 
*/
class ArquivosController extends Controller
{
	public function __construct()
    {
        $this->middleware('autorizador'); //invocamos o middleware q verifica o login
    }

	public function listar() //lista todos os arquivos
	{
		return view('arquivos/listar');
	}

	public function getArquivos()
    {
		$files = DB::table('arquivos')->join('usuarios', 'arquivos.id_usuario', '=', 'usuarios.id')->select('arquivos.*', 'usuarios.nome');
		return Datatables::of($files)
		        ->make(true);
    }

	public function salvarArquivo(Request $request) //fazendo o upload de uma ou várias fotos
	{
		$arquivos = $request->file('arquivo');
    	if(!empty($arquivos)):

    		foreach($arquivos as $arquivo):
    			//fazendo upload ad arquivo original:
    			$fileName = rand(0, 50).time() .rand(0, 50). "." . $arquivo->getClientOriginalExtension();
			    $arquivo->move(public_path('assets/arquivos/'), $fileName);
			    
			    //convertendo em Kb, Mb, Gb...
			    $base = log($arquivo->getClientSize(), 1024);
			    $suffixes = array('Bytes', 'Kb', 'Mb', 'Gb', 'Tb');
			    //salvando no BD:
			    $arquivo_bd = new Arquivos;
				$arquivo_bd->id_usuario = \Request::session()->get('id_usuario');
				$arquivo_bd->arquivo = $fileName;
				$arquivo_bd->nome_arquivo = $arquivo->getClientOriginalName();
				$arquivo_bd->tamanho = round(pow(1024, $base - floor($base)), 2) .' '. $suffixes[floor($base)];
				$arquivo_bd->save();
    		endforeach;
    	endif;

    	//registrando o ocorrido nas acoes:
    	$acao = new Acoes;
		$acao->id_usuario = \Request::session()->get('id_usuario');
		$acao->acao = 'Upload de Arquivo';
		$acao->link = 'arquivos/listar';
		$acao->save();

    	//Retornando resposta JSON ao arquivo file_uploads.js
    	return \Response::json(array('success' => true));
	}

	public function excluirArquivo($id)
	{
		$arquivo = Arquivos::find($id); //fazendo select passando a clausula where usando funcao find
		unlink(public_path('assets/arquivos/'.$arquivo->arquivo)); //removendo a arquivo física
		$arquivo->delete(); //efetuando a remocao

    	//registrando o ocorrido nas acoes:
    	$acao = new Acoes;
		$acao->id_usuario = \Request::session()->get('id_usuario');
		$acao->acao = 'Exclusão de Arquivo';
		$acao->link = 'arquivos/listar';
		$acao->save();

    	return redirect('arquivos/listar');
	}

	public function baixarArquivo($id)
	{
		$arquivo = Arquivos::find($id); //localizando o arquivo
		return response()->download(public_path('assets/arquivos/'.$arquivo->arquivo)); //disponibilizando o download
	}	

	public function adicionar() //leva para a tela de upload
	{
		return view('arquivos/adicionar');
	}
}