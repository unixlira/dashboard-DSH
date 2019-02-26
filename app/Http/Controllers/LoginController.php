<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; //classe de comunicacao com o BD
use Auth; //importando funcao q ja tem muitos recursos no uso de validações
use App\Mail\RecuperarAcesso;
use Mail;
use App\Usuarios;
use App\Post;

// para enviar e-mails
//use PHPMailerAutoload; 
//use PHPMailer;

class LoginController extends Controller
{
    public function login(){ //invoca o form de login
        return view('/login/login');
    }

    public function logoff(Request $request){ //removendo as sessoes e redirecionando para o login
        //Atualizando status para offline no BD
        $usuario = Usuarios::find(\Request::session()->get("id_usuario"));
        $usuario->status_chat = 0;
        $usuario->save();

        $request->session() ->forget('id_usuario');
        $request->session() ->forget('permissao');
        $request->session() ->forget('nome');
        $request->session() ->forget('foto');
        $request->session() ->forget('acesso'); //para controlar mensagem de boas vindas no index
        return redirect('/login/login');
    }

    public function recuperarlogin(){ //invoca o form de login
        return view('/login/recuperarlogin');
    }

    public function enviarlogin(Request $request){
        //pegando os dados de conexao do POST
        $email = $request->email;
        //verificando no Banco
        $result = DB::select("SELECT nome, email, senha FROM usuarios WHERE email = '$email'");
        
        if(($result))
        {
            // Remetente
            $nome     = $result[0]->nome;
            $senha  = base64_decode($result[0]->senha);
            $corpo  = "Seus dados de acesso ao Nagumo Play:<br /><br />Nome: ".$nome."<br />Email: ".$email."<br />Senha cadastrada: <strong>".$senha."</strong><br /><br />Atenciosamente Equipe MagicTV";

            Mail::to($email)->send(new RecuperarAcesso($corpo));

            $mensagem = 'E-mail com recuperação de senha enviado.';
            return view('/login/recuperarlogin', compact('mensagem'));
        }else{
            $mensagem = 'Este e-mail não pertence a nenhum cadastro.';
        }
        return view('/login/recuperarlogin', compact('mensagem'));
    }

    public function valida_login(Request $request){
        /*
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $data = array(
            'secret' => '6Lft-mwUAAAAAFs5XbmYtapLWJtXNc4KP-XVXnVM',
            'response' => $_POST["g-recaptcha-response"]
        );
        $options = array(
            'http' => array (
                'method' => 'POST',
                'content' => http_build_query($data)
            )
        );
        $context  = stream_context_create($options);
        $verify = file_get_contents($url, false, $context);
        $captcha_success=json_decode($verify);
        if ($captcha_success->success==false) {
            $mensagem = 'Robo!';
            return view('/login/login', compact('mensagem'));
        } else if ($captcha_success->success==true) {
            */
            //pegando os dados de conexao do POST
            $email = $request->email;
            $senha = $request->senha;

            $email = $this->anti_injection($email);
            $senha = $this->anti_injection($senha);

            //verificando no Banco
            $result = DB::select("SELECT id, permissao, nome, ativo, foto FROM usuarios WHERE email = '$email' AND senha = '".base64_encode($senha)."'");
            //dd($result);
            if(($result))
            {
                if ($result[0]->ativo == 0) {
                    $request->session() ->forget('id_usuario');
                    $request->session() ->forget('nome');
                    $request->session() ->forget('permissao');
                    $request->session() ->forget('foto');
                    $request->session() ->forget('acesso'); //para controlar mensagem de boas vindas no index
                    $request->session() ->forget('lockscreen'); //para controlar tela de bloqueio
                    $mensagem = 'Usuário Bloqueado.';
                    return view('/login/login', compact('mensagem'));
                }elseif($result[0]->permissao != 3){ //Se nao for usuario do Acougue, libera o login
                    $request->session() ->put('id_usuario',$result[0]->id);
                    $request->session() ->put('nome',$result[0]->nome);
                    $request->session() ->put('permissao',$result[0]->permissao);
                    $request->session() ->put('foto',$result[0]->foto);
                    $request->session() ->put('acesso',1); //para controlar mensagem de boas vindas no index
                    $request->session() ->put('lockscreen',0); //para controlar tela de bloqueio
                    
                    //Atualizando status para online no BD
                    $usuario = Usuarios::find(\Request::session()->get("id_usuario"));
                    $usuario->status_chat = 1;
                    $usuario->save();
                    if ($result[0]->permissao == 2) {
                        return redirect('/docenovembro/participantescadastrados');
                    }else{
                        return redirect('/index1');
                    }
                }else{
                    $request->session() ->forget('id_usuario');
                    $request->session() ->forget('nome');
                    $request->session() ->forget('permissao');
                    $request->session() ->forget('acesso'); //para controlar mensagem de boas vindas no index
                    $request->session() ->forget('lockscreen'); //para controlar tela de bloqueio
                    $mensagem = 'Usuário sem acesso a este sistema.';
                    return view('/login/login', compact('mensagem'));
                }
            }else{
                $request->session() ->forget('id_usuario');
                $request->session() ->forget('nome');
                $request->session() ->forget('permissao');
                $request->session() ->forget('acesso'); //para controlar mensagem de boas vindas no index
                $request->session() ->forget('lockscreen'); //para controlar tela de bloqueio
                $mensagem = 'E-mail ou senha incorreto(s).';
                return view('/login/login', compact('mensagem'));
            }
        //}

    }

// -- BLOQUEIO DE TELA (lockscreen)-- //

    public function lockscreen(Request $request){ //invoca o form de bloqueio de tela
        $request->session()->put('lockscreen',1); // 1 para bloquear tela

        //Atualizando status para offline no BD
        $usuario = Usuarios::find(\Request::session()->get("id_usuario"));
        $usuario->status_chat = 0;
        $usuario->save();
        return view('/login/lockscreen');
    }

    public function valida_login_lockscreen(Request $request){
        //pegando os dados de conexao do POST
        $senha = $request->senha;
        //verificando no Banco
        $result = DB::select("SELECT id, permissao, nome, ativo, foto FROM usuarios WHERE id = ".$request->session()->get('id_usuario')." AND senha = '".base64_encode($senha)."'");
        
        if(($result))
        {
            //Atualizando status para online no BD
            $usuario = Usuarios::find(\Request::session()->get("id_usuario"));
            $usuario->status_chat = 1;
            $usuario->save();

            $request->session() ->put('lockscreen',0); //para controlar tela de bloqueio
            if ($result[0]->permissao == 2) {
                return redirect('/docenovembro/participantescadastrados');
            }else{
                return redirect('/index1');
            }
        }else{
            $mensagem = 'Senha incorreta.';
            return view('/login/lockscreen', compact('mensagem'));
        }
    }

    private function anti_injection($campo){
        $campo = trim($campo);//limpa espaços vazio
        $campo = str_replace(' ', '', $campo);//limpa espaços do conteudo
        $campo = strip_tags($campo);//tira tags html e php
        $campo = addslashes($campo);//Adiciona barras invertidas a uma string
        return $campo;
    }
}