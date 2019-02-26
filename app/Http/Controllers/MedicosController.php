<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; //chamando a classe extendida
use Illuminate\Support\Facades\DB; //classe de comunicacao com o BD
use Yajra\Datatables\Datatables;
use App\Usuarios;
use App\Acoes;
use App\Medicos;
use App\WP_Users;
use App\WP_UserMeta;
use App\WP_Comentario;
use App\WP_Posts;


class MedicosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalMedicos = Medicos::select(DB::raw('COUNT(*) AS totalMedicos'))->where('meta_value','=','a:1:{s:8:"customer";b:1;}')->get();
        $novosMedicosDia = WP_Users::select(DB::raw('COUNT(*) AS novosMedicosDia'))->whereYear('user_registered', date('Y'))->whereMonth('user_registered', date('n'))->whereDay('user_registered', date('j'))->get();
		$novosMedicosSemana = DB::select("SELECT COUNT(*) AS novosMedicosSemana FROM wp_users WHERE YEAR(user_registered) = ".date('Y')." AND WEEK (user_registered ,0) = WEEK(NOW())");
        $novosMedicosMes = WP_Users::select(DB::raw('COUNT(*) AS novosMedicosMes'))->whereYear('user_registered', date('Y'))->whereMonth('user_registered', date('n'))->get();
        

        return \Response::json([$totalMedicos, $novosMedicosDia, $novosMedicosSemana, $novosMedicosMes]);
    }

    public function getMedicos($ativo)
    {
        
    	if ($ativo == 1) { 
			
            $users = DB::table('wp_users as u')->where('u.user_status', 1)->rightJoin('wp_usermeta as um', 'u.ID', '=', 'um.user_id')->where('meta_key','=','crm')->get();
            return Datatables::of($users)->make(true);
			
		}else{ 
            //$users = DB::table('wp_users')->where('user_status', 0);
            $users = DB::select("SELECT users.ID, users.display_name, users.user_registered, users.user_email, usermeta.meta_value FROM wp_users as users INNER JOIN wp_usermeta as usermeta ON users.ID = usermeta.user_id WHERE users.user_status = 0 AND usermeta.meta_key = 'crm'");


			return Datatables::of($users)->make(true);
			
		}
    }

    public function medicos()
	{
		return view('medicos.cadastrados');
	}

	public function listamedicos()
    {
    	 
		$listamedicos = DB::table('wp_usermeta')->get();

		return Datatables::of($listamedicos)->make(true);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function faixaetaria()
    {
        $faixaetaria = DB::select('SELECT TIMESTAMPDIFF(YEAR, meta_value, CURDATE()) as Idade FROM desejohipoativ.wp_usermeta WHERE meta_key = "nascimento" ');        
        return \Response::json([$faixaetaria]);
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function genero()
    {               

        $generoM = DB::select("SELECT COUNT(*) AS generoM FROM wp_usermeta WHERE meta_key = 'genero' AND meta_value = 'M' ");
        $generoF = DB::select("SELECT COUNT(*) AS generoF FROM wp_usermeta WHERE meta_key = 'genero' AND meta_value = 'F' ");

        return \Response::json([$generoM, $generoF]);
    }


    public function detalhes($id)
    
    {
        
        $usuario = WP_UserMeta::where('user_id','=',$id)->get();
        $titulo = 'Informações Gerais';
        $cabecalho = "Inserir Informações Pessoais";
        $detalhes = DB::select(" SELECT  user_id, umeta_id, meta_key, meta_value FROM wp_usermeta WHERE user_id =".$id);
        $especialidade = WP_UserMeta::select('umeta_id','meta_value as especialidade')->where('meta_key', '=', 'especialidade')->where('user_id', '=', $id)->get();
        $nome = WP_UserMeta::select('umeta_id','meta_value as nome')->where('meta_key', '=', 'nickname')->where('user_id', '=', $id)->get();
        $crm = WP_UserMeta::select('umeta_id','meta_value as crm')->where('meta_key', '=', 'crm')->where('user_id', '=', $id)->get();
        $email = WP_UserMeta::select('umeta_id','meta_value as email')->where('meta_key', '=', 'billing_email')->where('user_id', '=', $id)->get();
        $telefone = WP_UserMeta::select('umeta_id','meta_value as telefone')->where('meta_key', '=', 'billing_phone')->where('user_id', '=', $id)->get();
        $cep = WP_UserMeta::select('umeta_id','meta_value as cep')->where('meta_key', '=', 'billing_postcode')->where('user_id', '=', $id)->get();
        $endereco = WP_UserMeta::select('umeta_id','meta_value as endereco')->where('meta_key', '=', 'billing_address_1')->where('user_id', '=', $id)->get();
        $complemento = WP_UserMeta::select('umeta_id','meta_value as complemento')->where('meta_key', '=', 'billing_address_2')->where('user_id', '=', $id)->get();
        $cidade = WP_UserMeta::select('umeta_id','meta_value as cidade')->where('meta_key', '=', 'billing_city')->where('user_id', '=', $id)->get();
        $estado = WP_UserMeta::select('umeta_id','meta_value as estado')->where('meta_key', '=', 'billing_state')->where('user_id', '=', $id)->get();
        $nascimento = WP_UserMeta::select('umeta_id','meta_value as nascimento')->where('meta_key', '=', 'nascimento')->where('user_id', '=', $id)->get();
        $sexo = WP_UserMeta::select('umeta_id','meta_value as sexo')->where('meta_key', '=', 'genero')->where('user_id', '=', $id)->get();
        $cadastro = WP_Users::select('user_registered')->where('ID','=',$id)->get();
        $obs = WP_UserMeta::select('umeta_id','meta_value as obs')->where('meta_key', '=', 'obs')->where('user_id', '=', $id)->get();
   
        
        $acao = "/medicos/editar";
        
        //dd($email);

        return view('medicos.detalhes',compact("usuario","acao","titulo","cabecalho","nome","crm","telefone","email","senha","cep","endereco","numero","complemento","cidade", "estado","nascimento","sexo","cadastro","especialidade","detalhes","obs","complemento"));
        
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editarDetalhes(Request $request)
    { 

        DB::table('wp_usermeta')->where('umeta_id', $request->especialidades_id )->update(array('meta_value' => $request->especialidade));
        DB::table('wp_usermeta')->where('umeta_id', $request->nome_id )->update(array('meta_value' => $request->nome));
        DB::table('wp_usermeta')->where('umeta_id', $request->crm_id )->update(array('meta_value' => $request->crm));
        DB::table('wp_usermeta')->where('umeta_id', $request->email_id )->update(array('meta_value' => $request->email));
        DB::table('wp_usermeta')->where('umeta_id', $request->telefone_id )->update(array('meta_value' => $request->telefone));
        DB::table('wp_usermeta')->where('umeta_id', $request->cep_id )->update(array('meta_value' => $request->cep));
        DB::table('wp_usermeta')->where('umeta_id', $request->endereco_id )->update(array('meta_value' => $request->endereco));
        DB::table('wp_usermeta')->where('umeta_id', $request->complemento_id )->update(array('meta_value' => $request->complemento));
        DB::table('wp_usermeta')->where('umeta_id', $request->cidade_id )->update(array('meta_value' => $request->cidade));
        DB::table('wp_usermeta')->where('umeta_id', $request->estado_id )->update(array('meta_value' => $request->estado));
        DB::table('wp_usermeta')->where('umeta_id', $request->nascimento_id )->update(array('meta_value' => $request->nascimento));
        DB::table('wp_usermeta')->where('umeta_id', $request->sexo_id )->update(array('meta_value' => strtolower($request->sexo)));
        DB::table('wp_usermeta')->where('umeta_id', $request->obs_id )->update(array('meta_value' => $request->obs));


        //registrando a ocorrencia na tabela acao:
		$acao = new Acoes;
		$acao->id_usuario = \Request::session()->get('id_usuario');
		$acao->acao = 'Atualização de Usuário';
		$acao->link = 'medicos/editar';
        $acao->save();
        
		//redirecionando de acordo com o resultado do update
		return redirect('/medicos/cadastrados'); //redireciona para a listagem
    }
    
       /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bloquear(Request $request, $id)// validando os valores e pegando o ID
	{
		WP_Users::where('ID', $id)->update(array('user_status' => 1, 'updated_at' => date("Y-m-d H:i:s")));
		
		//registrando a ocorrencia na tabela acao:
		$acao = new Acoes;
		$acao->id_usuario = \Request::session()->get('id_usuario');
		$acao->acao = 'Bloqueio de Usuário';
		$acao->link = 'medicos/detalhes/'.$id;
		$acao->save();
		//redirecionando de acordo com o resultado do update
		return redirect('/medicos/cadastrados'); //redireciona para a listagem
    }

    public function restaurar(Request $request, $id)// validando os valores e pegando o ID
	{
		WP_Users::where('id', $id)->update(array('user_status' => 0));
		
		//registrando a ocorrencia na tabela acao:
		$acao = new Acoes;
		$acao->id_usuario = \Request::session()->get('id_usuario');
		$acao->acao = 'Restauração de Usuário Bloqueado';
		$acao->link = 'medicos/detalhes/'.$id;
		$acao->save();
		//redirecionando de acordo com o resultado do update
		return redirect('/medicos/cadastrados'); //redireciona para a listagem
	}
    

    public function medicosbloqueados() //lista todos os usuários
	{
		$medicos = ''; //medicos::where('ativo', 0)->get(); //usando a classe model Produto com o metodo padrao all que faz select pra nos
		return view('medicos/medicosbloqueados') -> with('medicos', $medicos);
    }


        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletarmedico($id)
    {
        WP_Users::where('ID', '=', $id)->delete();

        return redirect('/medicos/cadastrados');
    }

            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function aulasAssistidas($id)
    {               

        $assistidas = WP_Comentario::select(DB::raw('COUNT(comment_ID) AS assistidas'))->where('comment_type' ,'=', 'sensei_lesson_status')->where('comment_approved','=', 'complete')->where('user_id','=', $id)->get();

        
        return \Response::json($assistidas);
    }


        
    /**
     * Info Médicos Classes attended .
     *
     * @return \Illuminate\Http\Response
    */
    public function cursosAderidos($id) //Pegando informacoes extra do médico (+)
	{
        $aderidos = WP_Posts::select('user_id','post_title as curso','comment_approved as status', 'comment_date as dataInicio')->join('wp_comments', 'wp_comments.comment_post_ID', '=', 'wp_posts.ID')->where('wp_posts.post_type' ,'=', 'course')->where('wp_comments.user_id', '=', $id)->get();

        return Datatables::of($aderidos)->make(true);
    }   


        /**
     * Info Médicos Courses.
     *
     * @return \Illuminate\Http\Response
    */
    public function cursos($id) //Pegando informacoes extra do participante (+)
	{
        
        $nome = WP_Users::where('ID' , '=' , $id)->get();
        $id = $id;
		return view('medicos.cursos', compact('id','nome'));
    }



        /**
     * Info Médicos Courses.
     *
     * @return \Illuminate\Http\Response
    */
    public function historico($id) //Pegando informacoes extra do participante (+)
	{
        $nome = WP_Users::where('ID' , '=' , $id)->get();
        $id = $id;
		return view('medicos.historico-cursos', compact('id','nome'));
    }
    
    
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
