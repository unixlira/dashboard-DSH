<?php 
namespace App\Http\Controllers; //obrigatorio a definicao do namespace do diretorio q contem as classes q vamos extender

use App\Http\Controllers\Controller; //chamando a classe extendida
use App\Http\Requests\UsuarioRequest; //classe de validacao
use Illuminate\Support\Facades\DB; //classe de comunicacao com o BD
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

use App\Usuarios;
use App\Acoes; 
use App\Lojas;
use App\Medicos;
use App\WP_Users;
use App\WP_UserMeta;
/**
* 
*/
class UsuariosController extends Controller
{
	public function __construct()
    {
        $this->middleware('autorizador'); //invocamos o middleware q verifica o login
    }
	
    public function getUsuarios($ativo)
    {
    	if ($ativo == 1) { 
			$users = DB::table('usuarios')->where('ativo', 1)->where('permissao','!=', 3);
			return Datatables::of($users)->make(true);
			//$notificacoes = Notificacoes::where('acao', 'Resgate de Cupom de R$ 100,00')->get();
		}else{ 
			$users = DB::table('usuarios')->where('ativo', 0)->where('permissao','!=', 3);
			return Datatables::of($users)->make(true);
			//$notificacoes = Notificacoes::where('acao', 'Liberação de Cupom de R$ 100,00')->get();
		}
    }
	
    public function getUsuariosAcougue() //Pegando os usuarios permissao acougue (3) e ativos
    {
		$users = DB::table('usuarios')->join('lojas', 'usuarios.id_loja', '=', 'lojas.id')->select('usuarios.*', 'lojas.nome_loja')->where('ativo', 1)->where('permissao', 3);
		return Datatables::of($users)->make(true);	
    }
	
    public function getacoes($id) //pegando as acoes dos usuarios
    {
    	$users = DB::table('acoes_recentes')->where('id_usuario', $id);
		return Datatables::of($users)
	        ->make(true);
    }

	public function listarusuarios() //lista todos os usuários
	{
		$usuarios = ''; //Usuarios::where('ativo', 1)->get(); //pegando todos os usuarios ativos

		//retornando a view listagem.php (nao precisa por a extensao) e disponibilizando o select produtos pra view
		return view('usuarios/listaUsuarios') -> with('usuarios', $usuarios);
	}

	public function listarusuariosacougue() //lista todos os usuários do açougue
	{
		return view('usuariosacougue/listausuarios');
	}

	public function novousuario() //tela de adicionar usuario
	{
		$titulo = "Adicionar Usuário";
		$acao = "usuarios/adicionarUsuario";
		$cabecalho = "Inserir Informações Pessoais";
		return view('usuarios/adicionarUsuario',compact("titulo", "acao", "cabecalho")); 	
	}

	public function novousuarioacougue() //tela de adicionar usuario do açougue
	{
		$lojas = Lojas::all(); //pegando todas as lojas
		$titulo = "Adicionar Usuário";
		$acao = "usuarios/adicionarUsuario";
		$cabecalho = "Inserir Informações Pessoais";
		return view('usuariosacougue/adicionarusuario',compact("titulo", "acao", "cabecalho", "lojas"));
	}
/* 

	LEMBRAR DE QUANDO ADICIONAR NOVO E AO ATUALIZAR FOTO, FAZER CÓPIA PARA O DIRETORIO ASSETS/IMG/FOTO_PERFIL DO DOMINIO DO ACOUGUE
	SENAO NAO EXIBE NO OUTRO SITE

*/
	public function adicionarusuario(UsuarioRequest $request){ //Salvando novo usuario no BD
			
		$id_usuario = DB::table('usuarios')->where('email', $request->email)->first(); //validando se já existe o email
		if (!is_null($id_usuario)) {
			$titulo = "Adicionar Usuário";
			$acao = "usuarios/adicionarUsuario";
			$cabecalho = "Inserir Informações Pessoais";
			$mensagem = 'E-mail já cadastrado, insira um diferente.';
			return view('usuarios/adicionarUsuario',compact("titulo", "acao", "cabecalho", "mensagem"));
		}else{
			$fileName = 'foto_perfil.png';

			if ($request->acougue != 'sim') { //Se for novo usuario acougue, leva pra listagem deles
				if (\Request::hasFile('foto')) {
			        $file = $request->file('foto');
			        $fileName = uniqid(time()) . "." . $file->getClientOriginalExtension();
			        $file->move(public_path('assets/img/foto_perfil/'), $fileName);
			    }					
			}		

	    	//pegando os parametros no dedo por causa da criptografia da senha:
			$usuario = new Usuarios; //criando o objeto da classe q manupula o BD para a tabela usuarios
			$usuario->nome = $request->nome;
			$usuario->email = $request->email;
			$usuario->senha = base64_encode($request->senha); //encriptando a senha
			$usuario->telefone = $request->telefone;
			$usuario->endereco = $request->endereco;
			$usuario->cidade = $request->cidade;
			$usuario->permissao = $request->permissao;
			$usuario->ativo = $request->ativo;
			$usuario->id_loja = $request->id_loja;
			$usuario->foto = $fileName;
			$usuario->notas = 'Suas anotações aqui...';
			$usuario->save(); //salvando o insert
			
			//registrando a ocorrencia na tabela acao:
			$id_usuario = DB::table('usuarios')->where('email', $request->email)->first(); //pegando o ID do novo usuario
			$acao = new Acoes;
			$acao->id_usuario = \Request::session()->get('id_usuario');
			$acao->acao = 'Inclusão de Usuário';
			$acao->link = 'usuarios/perfilusuario/'.$id_usuario->id;
			$acao->save();
			if ($request->acougue == 'sim') { //Se for novo usuario acougue, leva pra listagem deles
				return redirect('/usuarios/listarusuariosacougue'); 
			}else{ //leva pra listagem geral:
				return redirect('/usuarios/listarusuarios'); //após inserir, redireciona para a rota de listagem de usuarios e faz uma requisição nova ao servidor
			}
		}
	}

	public function editarusuario($id, Request $request) //lista todos os usuários
	{
		$id_user = '';
		//validando se é adm ou usuario comum:
		if($request->session()->get('permissao') == 1){
			$id_user = $id; //passa o id da request
		}else{
			$id_user = $request->session()->get('id_usuario'); //passa o id do usuario ativo na sessao
		}
		$usuario = Usuarios::find($id_user); //fazendo select do usuario 
		$titulo = "Editar Usuário";
		$acao = "usuarios/atualizarusuario";
		$cabecalho = "Atualizar Informações Pessoais";
		return view('usuarios/adicionarUsuario',compact("titulo", "acao", "id_user","cabecalho")) ->  with('usuario', $usuario);
	}

	public function editarusuarioacougue($id, Request $request) //lista todos os usuários
	{
		$lojas = Lojas::all(); //pegando todas as lojas
		$id_user = '';
		//validando se é adm ou usuario comum:
		if($request->session()->get('permissao') == 1){
			$id_user = $id; //passa o id da request
		}else{
			$id_user = $request->session()->get('id_usuario'); //passa o id do usuario ativo na sessao
		}
		$usuario = Usuarios::find($id_user); //fazendo select do usuario 
		$titulo = "Editar Usuário";
		$acao = "usuarios/atualizarusuario";
		$cabecalho = "Atualizar Informações Pessoais";
		return view('usuariosacougue/adicionarusuario',compact("titulo", "acao", "id_user","cabecalho", "lojas")) ->  with('usuario', $usuario);
	}

	public function usuariosremovidos() //lista todos os usuários
	{
		$usuarios = ''; //Usuarios::where('ativo', 0)->get(); //usando a classe model Produto com o metodo padrao all que faz select pra nos
		return view('usuarios/usuariosremovidos') -> with('usuarios', $usuarios);
	}
	
	public function perfilusuario($id, Request $request) //exibe perfil do usuario logado
	{
		$usuario = Usuarios::find($id); //fazendo select do usuario 
		$acao = ''; //DB::table('acoes_recentes')->where('id_usuario', $id)->get(); //pegando as alteracoes registradas do usuario
		return view('usuarios/perfilusuario',compact("usuario", "acao"));
	}

	public function restaurarusuario(UsuarioRequest $request, $id)// validando os valores e pegando o ID
	{
		Usuarios::where('id', $id)->update(array('ativo' => 1));
		
		//registrando a ocorrencia na tabela acao:
		$acao = new Acoes;
		$acao->id_usuario = \Request::session()->get('id_usuario');
		$acao->acao = 'Restauração de Usuário Bloqueado';
		$acao->link = 'usuarios/perfilusuario/'.$id;
		$acao->save();
		//redirecionando de acordo com o resultado do update
		return redirect('/usuarios/listarusuarios'); //redireciona para a listagem
	}

	public function bloquearusuario(UsuarioRequest $request, $id)// validando os valores e pegando o ID
	{
		Usuarios::where('id', $id)->update(array('ativo' => 0, 'updated_at' => date("Y-m-d H:i:s")));
		
		//registrando a ocorrencia na tabela acao:
		$acao = new Acoes;
		$acao->id_usuario = \Request::session()->get('id_usuario');
		$acao->acao = 'Bloqueio de Usuário';
		$acao->link = 'usuarios/perfilusuario/'.$id;
		$acao->save();
		//redirecionando de acordo com o resultado do update
		return redirect('/usuarios/listarusuarios'); //redireciona para a listagem
	}

	public function atualizarusuario(UsuarioRequest $request, $id){// validando os valores e pegando o ID
		
		//pegando os parametros no dedo pra atualziar por causa da criptografia da senha:
		$usuario = Usuarios::find($id); //pegando o usuario a atualizar
		$usuario->nome = $request->nome;
		$usuario->email = $request->email;
		if ($usuario->senha != $request->senha) { //verificando se houve alteração da senha anterior para a atual
			$usuario->senha = base64_encode($request->senha); //encriptando a senha
		}
		$usuario->telefone = $request->telefone;
		$usuario->endereco = $request->endereco;
		$usuario->cidade = $request->cidade;
		$usuario->permissao = $request->permissao;
		$usuario->ativo = $request->ativo;
		$usuario->id_loja = $request->id_loja;
		
		if (\Request::hasFile('foto')) { //testando se houve alteração da foto de perfil
	        $file = $request->file('foto');
	        if ($usuario->foto != '') {
	        	$fileName = $usuario->foto;
	        }else{
		        $fileName = uniqid(time()) . "." . $file->getClientOriginalExtension();	        	
	        }
	        $file->move(public_path('assets/img/foto_perfil/'), $fileName);    
			$usuario->foto = $fileName;
            if ($usuario->id == $request->session()->get('id_usuario')) { // se o usuario está a alterando os proprios dados:
	            $request->session()->put('foto',$fileName); //atualizando valor da variavel que armazena a foto do usuario
            }
	    }

		$update = $usuario->save(); //atualizando
		if ($usuario->id == $request->session()->get('id_usuario')) { // se o usuario está a alterando os proprios dados:
            $request->session() ->put('nome',$request->nome); //atualizando valor da variavel que armazena o nome do usuario            	
        }
		//registrando a ocorrencia na tabela acao:
		$acao = new Acoes;
		$acao->id_usuario = \Request::session()->get('id_usuario');
		$acao->acao = 'Atualização de Dados de Usuário';
		$acao->link = 'usuarios/perfilusuario/'.$id;
		$acao->save();

		//redirecionando de acordo com o resultado do update
		if ($update) {
	    //Flash::message('Atualizado com sucesso!');
			if ($request->acougue == 'sim') { //Se for novo usuario acougue, leva pra listagem deles
				return redirect('/usuarios/listarusuariosacougue'); 
			}else{ //leva pra listagem geral:
				return redirect('/usuarios/listarusuarios'); //após inserir, redireciona para a rota de listagem de usuarios e faz uma requisição nova ao servidor
			}
		}else{
			return redirect('/usuarios/editarusuario/'.$id);
		}
	}
}