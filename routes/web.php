<?php

Route::get('/','IndexController@index'); //pagina inicial

Route::get('index1','IndexController@index'); //pagina inicial

Route::get('acoesrecentes','IndexController@acoesrecentes'); // Pagina com a listagem das acoes dos usuarios do sistema

Route::get('datatable/getacoesrecentes/', ['as'=>'datatable.getacoesrecentes','uses'=>'IndexController@getAcoesRecentes']);

Route::get('carregaquadradinhos','IndexController@carregaQuadradinhos'); //Quadradinhos

Route::get('acoesrecentesusuarios','IndexController@acoesRecentesUsuarios'); //Pega as 4 ultimas acoes dos usuarios no Site (Todos)

// --------------------------------------------------------- //
// -- LOGIN -- //
// --------------------------------------------------------- //

Route::get('login/login','LoginController@login'); //form de login

Route::get('login/lockscreen','LoginController@lockscreen'); //Tela de Bloqueio de Tela

Route::post('login/valida_login','LoginController@valida_login'); //validar login

Route::post('login/valida_login_lockscreen','LoginController@valida_login_lockscreen'); //validar login tela de bloqueio

Route::get('login/logoff','LoginController@logoff'); //form de logoff

Route::get('login/recuperarlogin','LoginController@recuperarlogin'); //form recuperar senha

Route::post('login/enviarlogin','LoginController@enviarlogin'); //enviar senha por email


// --------------------------------------------------------- //
// -- CHAT -- //
// --------------------------------------------------------- //

Route::get('/chat/carregacontatos',['as'=>'carregacontatos','uses'=>'ChatController@carregaContatos']); //Carregando a lista de contatos

Route::get('/chat/carregamensagens/{id}/{destinatario}',['as'=>'carregamensagens','uses'=>'ChatController@carregaMensagens']); //Carregando as mensagens

Route::post('/chat/enviamensagem',['as'=>'enviamensagem','uses'=>'ChatController@enviaMensagem']); //Carregando as mensagens

Route::get('/chat/visualizarmensagem/{id}/{destinatario}',['as'=>'visualizarmensagem','uses'=>'ChatController@visualizarMensagem']); //Atualizando updated_at (visualizou)



// --------------------------------------------------------- //
// -- AFAZERES-- //
// --------------------------------------------------------- //

Route::post('insereAfazer','IndexController@insereAfazer'); //inserindo Afazer (tarefa)

Route::get('removeAfazer/{id}','IndexController@removeAfazer'); //inserindo Afazer (tarefa)

Route::post('atualizaAfazer/{id}','IndexController@atualizaAfazer'); //atualizando Afazer (tarefa)

// -- REGISTRA NOTAS -- //
Route::post('salvaNotas','IndexController@salvaNotas'); //atualizando Afazer (tarefa)


// --------------------------------------------------------- //
// -- USUARIOS DO SITE -- //
// --------------------------------------------------------- //

Route::get('usuarios/listarusuarios','UsuariosController@listarusuarios'); //listando os usuarios

Route::get('usuarios/listarusuariosacougue','UsuariosController@listarusuariosacougue'); //listando os usuarios

Route::get('datatable/getusuarios/{ativo}', ['as'=>'datatable.getusuarios','uses'=>'UsuariosController@getUsuarios']);

Route::get('datatable/getusuariosacougue/', ['as'=>'datatable.getusuariosacougue','uses'=>'UsuariosController@getUsuariosAcougue']);

Route::get('usuarios/novousuario','UsuariosController@novousuario'); //chama form de novo usuario

Route::get('usuarios/novousuarioacougue','UsuariosController@novousuarioacougue'); //chama form de novo usuario

Route::get('usuarios/editarusuario/{id}','UsuariosController@editarusuario'); //insere novo usuario no BD

Route::get('usuarios/editarusuarioacougue/{id}','UsuariosController@editarusuarioacougue'); //insere novo usuario no BD

Route::get('usuarios/usuariosremovidos','UsuariosController@usuariosremovidos'); //ver usuarios removidos

Route::get('usuarios/perfilusuario/{id}','UsuariosController@perfilusuario'); //ver usuarios removidos 

Route::get('datatable/getacoes/{id}', ['as'=>'datatable.getacoes','uses'=>'UsuariosController@getacoes']);

Route::post('usuarios/adicionarUsuario','UsuariosController@adicionarusuario'); //cadastrando no BD novo usuario

Route::put('usuarios/atualizarusuario/{id}','UsuariosController@atualizarusuario'); //atualizar dados cadastrais do usuário 

Route::get('usuarios/restaurarusuario/{id}','UsuariosController@restaurarusuario'); //Restaura acesso de usuario

Route::get('usuarios/bloquearusuario/{id}','UsuariosController@bloquearusuario'); //Restaura acesso de usuario


// --------------------------------------------------------- //
// --  NOTIFICACOES DOS USUARIOS -- //
// --------------------------------------------------------- //

Route::get('docenovembro/notificacoesdn/{filtro}','NotificacoesController@opcoes'); //ver configuraçao de notificacao

Route::get('datatable/getposts/{filtro}', ['as'=>'datatable.getposts','uses'=>'NotificacoesController@getPosts']);

Route::get('docenovembro/notificacoesdn2018/{filtro}','NotificacoesController@notificacoesdn2018'); //ver configuraçao de notificacao

Route::get('datatable/getnotificacoesdn2018/{filtro}', ['as'=>'datatable.getnotificacoesdn2018','uses'=>'NotificacoesController@getnotificacoesdn2018']);


// --------------------------------------------------------- //
// -- ARQUIVOS -- //
// --------------------------------------------------------- //

Route::get('arquivos/listar','ArquivosController@listar'); //Tela de Listagem dos arquivos

Route::get('datatable/getarquivos', ['as'=>'datatable.getarquivos','uses'=>'ArquivosController@getArquivos']); //Tabela de listagem dos arquivos

Route::get('arquivos/adicionar','ArquivosController@adicionar'); //Tela de Listagem dos arquivos

Route::get('arquivos/excluirarquivo/{id}','ArquivosController@excluirArquivo'); //Excluir imagens

Route::post('arquivos/salvararquivo','ArquivosController@salvarArquivo'); //Upload de imagens

Route::get('arquivos/baixar/{id}','ArquivosController@baixarArquivo'); //Download de arquivos


// --------------------------------------------------------- //
// -- CALENDÁRIO -- //
// --------------------------------------------------------- //

Route::get('calendario/calendario','CalendarioController@calendario'); //Exibicao do calendário

Route::post('calendario/salvarEvento','CalendarioController@salvarEvento'); //Salvando evento

Route::post('calendario/excluirEvento','CalendarioController@excluirEvento'); //Excluir evento

Route::post('calendario/salvaDataEvento','CalendarioController@salvaDataEvento'); //Salvar Evento no Calendario

Route::post('calendario/atualizarEventoCalendario','CalendarioController@atualizarEventoCalendario'); //Atualiza Evento no Calendario

Route::post('calendario/mudaDataEvento','CalendarioController@mudaDataEvento'); //Mudar data do Evento no Calendario

Route::post('calendario/excluirEventoCalendario','CalendarioController@excluirEventoCalendario'); //Mudar data do Evento no Calendario


// --------------------------------------------------------- //
// -- Medicos Cadastrados                                    //
// --------------------------------------------------------- //
Route::get('/medicos/cadastrados','MedicosController@medicos');

Route::get('/medicos/detalhes/{id}','MedicosController@detalhes');

Route::get('/medicos/bloquear/{id}','MedicosController@bloquear');

Route::get('medicos/restaurar/{id}','MedicosController@restaurar'); //Restaura acesso de usuario

Route::get('medicos/detalhescurso/{id}','MedicosController@detalhesCurso'); //Pegando informacoes extra do curso dos médicos (+) 

Route::get('/medicos/cursos/{id}', 'MedicosController@cursos');

Route::get('/medicos/historico-cursos/{id}', 'MedicosController@historico');

Route::get('/medicos/bloqueados','MedicosController@medicosbloqueados'); //ver usuarios removidos

Route::get('/medicos/editar/{id}','MedicosController@edit'); //ver usuarios removidos

Route::get('listamedicos','MedicosController@listamedicos');

Route::get('datatable/getMedicos/{ativo}', ['as'=>'datatable.getMedicos','uses'=>'MedicosController@getMedicos']);

Route::get('totalmedicos','MedicosController@index'); //Total de medicos cadastrados no APP

Route::get('faixaetaria','MedicosController@faixaetaria'); //Faixa Etária Médicos

Route::get('genero','MedicosController@genero'); //Faixa Etária Médicos

Route::get('aulasAssistidas/{id}','MedicosController@aulasAssistidas'); //Faixa Etária Médicos

Route::get('datatable/aderidos/{id}', ['as'=>'datatable.aderidos','uses'=>'MedicosController@cursosAderidos']); //Cursos por Médico

Route::post('/medicos/editar', 'MedicosController@editarDetalhes');

// --------------------------------------------------------- //
// -- Cursos //
// --------------------------------------------------------- //

Route::get('totalcursos','CursosController@index'); //Total de Adesão aos Cursos

Route::get('top10','CursosController@top'); //Top 10 Cursos

Route::get('volumeacessos','CursosController@volumeAcessos'); //Volume de Acessos


// --------------------------------------------------------- //
// -- Relatórios //
// --------------------------------------------------------- //
Route::get('/relatorios/performance','RelatoriosController@performance');

Route::get('dataperformance/{mes}/{ano}','RelatoriosController@dataperformance');


// --------------------------------------------------------- //
// -- Mensagens recebidas                                    //
// --------------------------------------------------------- //
Route::get('/perguntas/recebidas','PerguntasController@index');

Route::get('/perguntas/responder/{id}','PerguntasController@show');

Route::post('/perguntas/resposta', 'PerguntasController@resposta');

Route::get('datatable/perguntas', ['as'=>'datatable.perguntas','uses'=>'PerguntasController@getPerguntas']);


// --------------------------------------------------------- //
// -- Zuera Javascript  //
// --------------------------------------------------------- //
Route::get('/sorteio', function () {
    return view('numeros');
});

Route::get('/home', 'HomeController@index')->name('home');

