<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Autorizador //fazer controle de acesso, conferir se usuario ta logado para ter acesso às funcoes do sistema
{
    public function handle($request, Closure $next)
    {
        //se nao for a pag de login e for visitante(login nao efetuado)
    	if(!$request->session()->has('id_usuario'))
        {
            $request->session() ->forget('id_usuario');
            $request->session() ->forget('permissao');
            $request->session() ->forget('nome');
            $request->session() ->forget('foto');
            $request->session() ->forget('acesso'); //para controlar mensagem de boas vindas no index
            return redirect('login/login');
        }
        if($request->session()->get('lockscreen') == 1)
        {
            return redirect('login/lockscreen');
        }
        return $next($request);
    }
}
