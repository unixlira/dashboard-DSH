@extends(('layouts/default'))
{{-- Page title --}}
@section('title')
    Add User
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!-- plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
    <!--end of page level css-->
@stop

{{-- Page content --}}
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <h4 class="nav_top_align skin_txt">
                        <i class="fa fa-user"></i>
                        {{$titulo}}
                    </h4>
                </div>
                <div class="col-lg-6" style="color:#fff">
                    <ol class="breadcrumb float-right nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Página Inicial
                            
                        </li>
                        <li class="breadcrumb-item">
                            Usuários
                        </li>
                        <li class="breadcrumb-item active">{{$titulo}}</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
<div class="outer">
    <div class="inner bg-container">
        <div class="card">

            <div class="card-body m-t-15">
                <div>
                    <h4>{{$cabecalho}}</h4>
                </div>
                <form class="form-horizontal login_validator" id="formNovoUsuario" action="{{ URL::to($acao) }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    @if(isset($user_id))
                    {{ method_field('PUT') }} <!-- se for editar, este campo é obrigatorio pro update-->
                    @endif
                    <div class="row">
                        <div class="col-12">
                            
                            <div class="form-group row m-t-25">
                                @if(isset($mensagem)) <!-- funcao 'old' verifica se existe parametro passado da requisição anterior para a atual -->
                                    <div class="alert alert-danger alert-dismissable col-lg-6  col-md-8  col-sm-12 mx-auto">
                                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                       <strong>Atenção: </strong>{{$mensagem}}
                                    </div>  
                                @endif
                                <div class="col-lg-3 text-center text-lg-right">
                                    <label class="col-form-label">Foto do Perfil</label>
                                </div>
                                <div class="col-lg-6 text-center text-lg-left">
                                    <div class="fileinput fileinput-new " data-provides="fileinput" style="width: 235px;">
                                        <div class="fileinput-new img-thumbnail" style="width: 235px; height: 170px; margin-bottom: 0px;">
                                            @if(isset($usuario->foto))
                                                <img src="{{asset('assets/img/foto_perfil/'.$usuario->foto)}}" alt="not found" class="fileinput" style="width: 225px; height: 160px;" />
                                            @else
                                                <img src="{{asset('assets/img/foto_perfil/foto_perfil.png')}}" class="fileinput" style="width: 225px; height: 160px;" />
                                            @endif
                                        </div>
                                        <div class="fileinput-preview fileinput-exists img-thumbnail" style="width: 235px; height: 170px;"></div>
                                        <div class="m-t-20 text-center">
                                            <span class="btn btn-info btn-file" style="background-color: #ee268f !important;border: 1px solid #ee268f;">
                                                <span class="fileinput-new">Selecionar Imagem</span>
                                                <span class="fileinput-exists">Alterar</span>
                                                <input type="file" accept="image/*" name="foto">
                                            </span>
                                            <a href="#" class="btn btn-warning fileinput-exists"
                                               data-dismiss="fileinput">Remover</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row m-t-25">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="datacadstro" class="col-form-label">
                                        Nº Cadastro</label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                    <span class="input-group-addon"> <i class="fa fa-list text-primary"></i>
                                    </span>
                                        <input type="text" disabled="disabled"  name="id" id="id" placeholder="Cadastro..."  value="{{$detalhes[0]->user_id}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row m-t-25">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="especialidades" class="col-form-label">
                                        Especialidade </label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                    <span class="input-group-addon"> <i class="fa fa-list text-primary"></i>
                                    </span>
                                        <input type="hidden" name="especialidades_id" value="{{$especialidade[0]->umeta_id}}">
                                        <input type="text" name="especialidade" id="especialidade" placeholder="Especialidade..." value="{{$especialidade[0]->especialidade}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row m-t-25">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="nome" class="col-form-label">
                                        Nome do usuário </label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user text-primary"></i>
                                    </span>
                                    <input type="hidden" name="nome_id" value="{{$nome[0]->umeta_id}}">
                                        <input type="text" name="nome" id="nome" placeholder="Nome..." class="form-control" value="{{$nome[0]->nome}}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row m-t-25">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="crm" class="col-form-label">
                                        CRM </label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                    <span class="input-group-addon"> <i class="fa fa-plus-circle text-primary"></i>
                                    </span>
                                        <input type="hidden" name="crm_id" value="{{$crm[0]->umeta_id}}">
                                        <input type="text" name="crm" id="crm" placeholder="CRM..."  value="{{$crm[0]->crm}}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="email" class="col-form-label">E-mail
                                        </label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-envelope text-primary"></i></span>                                        
                                        @if(isset($email[0]))
                                        <input type="hidden" name="email_id" value="{{$email[0]->umeta_id}}">                                        
                                        @else    
                                        <input type="hidden" name="email_id" value="">                                        
                                        @endif
                                        @if(isset($email[0]))
                                        <input type="text" id="email" name="email" placeholder="Email..." value="{{$email[0]->email}}" class="form-control">                                        
                                        @else    
                                        <input type="text" disabled="disabled" id="email" name="email" placeholder="Não Cadastrado" value="" class="form-control">                                      
                                        @endif                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="telefone" class="col-form-label">Telefone
                                        </label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone text-primary"></i></span>
                                        @if(isset($telefone[0]))
                                        <input type="hidden" name="telefone_id" value="{{$telefone[0]->umeta_id}}">
                                        @else
                                        <input type="hidden" name="telefone_id" value="">
                                        @endif
                                        @if(isset($telefone[0]))
                                        <input type="text" id="telefone" name="telefone" placeholder="Telefone..." value="{{$telefone[0]->telefone}}" class="form-control">
                                        @else
                                        <input type="text" disabled="disabled" id="telefone" name="telefone" placeholder="Não Cadastrado" value="" class="form-control">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="cep" class="col-form-label">Cep
                                         </label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrow-right text-primary"></i></span>
                                        @if(isset($cep[0]))
                                        <input type="hidden" name="cep_id" value="{{$cep[0]->umeta_id}}">
                                        @else
                                        <input type="hidden" name="cep_id" value=""> 
                                        @endif
                                        @if(isset($cep[0]))
                                        <input type="text" name="cep" placeholder="Cep..." id="cep"  value="{{$cep[0]->cep}}" onblur="ValidaCep()"   class="form-control">
                                        @else                                      
                                        <input type="text" name="cep" disabled="disabled"  placeholder="Não Cadastrado" id="cep"  disabled="disabled" value="" onblur="ValidaCep()"   class="form-control">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="rua" class="col-form-label">Endereço
                                         </label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrow-right text-primary"></i></span>
                                        @if(isset($endereco[0]))
                                        <input type="hidden" name="endereco_id" value="{{$endereco[0]->umeta_id}}">
                                        @else
                                        <input type="hidden" name="endereco_id" value="">
                                        @endif
                                        @if(isset($endereco[0]))
                                        <input type="text" name="endereco" placeholder="Endereço completo" id="endereco"  value="{{$endereco[0]->endereco}}" class="form-control">
                                        @else
                                        <input type="text" name="endereco" disabled="disabled"  placeholder="Não Cadastrado" id="endereco"  value="" class="form-control">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="rua" class="col-form-label">Complemento
                                         </label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrow-right text-primary"></i></span>
                                        @if(isset($complemento[0]))
                                        <input type="hidden" name="complemento_id" value="{{$complemento[0]->umeta_id}}">
                                        @else
                                        <input type="hidden" name="complemento_id" value="">
                                        @endif
                                        @if(isset($complemento[0]))
                                        <input type="text" name="complemento" placeholder="complemento " id="complemento"  value="{{$complemento[0]->complemento}}" class="form-control">
                                        @else
                                        <input type="text" name="complemento" disabled="disabled"  placeholder="Não Cadastrado" id="complemento"  value="" class="form-control">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="cidade" class="col-form-label">Cidade
                                         </label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrow-right text-primary"></i></span>
                                        @if(isset($cidade[0]))
                                        <input type="hidden" name="cidade_id" value="{{$cidade[0]->umeta_id}}">
                                        @else
                                        <input type="hidden" name="cidade_id" value="">
                                        @endif
                                        @if(isset($cidade[0]))                                       
                                        <input type="text" name="cidade" placeholder="Cidade..." id="cidade" value="{{$cidade[0]->cidade}}" class="form-control"> 
                                        @else
                                        <input type="text" name="cidade" disabled="disabled"  placeholder="Não Cadastrado" id="cidade" value="" class="form-control">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="estado" class="col-form-label">Estado
                                         </label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrow-right text-primary"></i></span>
                                        @if(isset($estado[0]))
                                        <input type="hidden" name="estado_id" value="{{$estado[0]->umeta_id}}">
                                        @else
                                        <input type="hidden" name="estado_id" value="">
                                        @endif
                                        @if(isset($estado[0]))                                        
                                        <input type="text" name="estado" placeholder="Estado..." id="estado" value="{{$estado[0]->estado}}" class="form-control"> 
                                        @else
                                        <input type="text" name="estado" disabled="disabled"  placeholder="Não Cadastrado" id="estado" value="" class="form-control">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="nascimento" class="col-form-label">Data Nascimento
                                         </label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrow-right text-primary"></i></span>
                                        <input type="hidden" name="nascimento_id" value="{{$nascimento[0]->umeta_id}}">
                                        <input type="text" name="nascimento" placeholder="Data Nascimento..." id="nascimento"  value="{{ date('d/m/Y',strtotime($nascimento[0]->nascimento)) }}"
                                               class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="sexo" class="col-form-label">Sexo
                                         </label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrow-right text-primary"></i></span>
                                        <input type="hidden" name="sexo_id" value="">
                                        @if( $sexo[0]->sexo == "F" || $sexo[0]->sexo == "feminino" || $sexo[0]->sexo == "Feminino" || $sexo[0]->sexo == "f")
                                        <input type="text" name="sexo" placeholder="Sexo..." id="sexo" value="Feminino" class="form-control">
                                        @elseif($sexo[0]->sexo == "M" || $sexo[0]->sexo == "masculino" || $sexo[0]->sexo == "Masculino" || $sexo[0]->sexo == "m")
                                        <input type="text" name="sexo" placeholder="Sexo..." id="sexo" value="Masculino" class="form-control">
                                        @else
                                        <input type="text" name="sexo" placeholder="Sexo..." id="sexo" value="" class="form-control">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="cadastro" class="col-form-label">Data Cadastro
                                        </label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar text-primary"></i></span>
                                        <input type="text" disabled="disabled" id="cadastro" name="cadastro"  placeholder="Data Cadastro..." value="{{ date('d/m/Y', strtotime($cadastro[0]->user_registered)) }}"  class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">
                                    <label for="observacoes" class="col-form-label">Observações</label>
                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class=""></span>
                                        @if(isset($estado[0]))
                                        <input type="hidden" name="obs_id" value="{{$obs[0]->umeta_id}}">
                                        @else
                                        <input type="hidden" name="obs_id" value="">
                                        @endif
                                        @if(isset($estado[0]))                                        
                                        <textarea rows="5" cols="" name="obs" id="obs" placeholder="Observações..." class="form-control">{{$obs[0]->obs}}</textarea> 
                                        @else
                                        <textarea rows="5" cols="" name="obs" id="obs" placeholder="Observações..." class="form-control"></textarea>
                                        @endif 
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-right">

                                </div>
                                <div class="col-xl-6 col-lg-8">
                                    <div class="input-group">
                                        <span class=""></span>
                                        <input type="submit" value="EDITAR" class="btn btn-success btn-block" style="background-color: #ee268f !important;padding:10px;border-color:#ee268f !important;">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-center">
                                    <label for="observacoes" class="col-form-label" style="font-size:18px;"><b>Cursos</b></label>
                                </div>
                                
                                <div class="col-lg-10 ml-auto">
                                    <a href="/medicos/cursos/{{ $detalhes[0]->user_id }}" class="btn btn-outline-secondary">CURSOS ADERIDOS</a>
                                    <a href="/medicos/historico-cursos/{{ $detalhes[0]->user_id }}" class="btn btn-outline-primary">HISTÓRICO DE CURSOS</a>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-3 text-lg-center">
                                    <label for="observacoes" class="col-form-label" style="font-size:18px;"><b>Ações</b></label>
                                </div>
                                
                                <div class="col-lg-10 ml-auto">
                                    <a href="/medicos/bloquear/{{ $detalhes[0]->user_id }}" class="btn btn-primary" style="background-color: #ee268f !important;border: 1px solid #ee268f;">BLOQUEAR MÉDICO</a>
                                    <a href="http://desejosexualhipoativo.com.br/wp-login.php?action=lostpassword" target="blank" class="btn btn-warning" style="background-color: #4fa6b5 !important;border: 1px solid #4fa6b5;">RESETAR SENHA</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.inner -->
</div>


@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <!-- plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pluginjs/jasny-bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/holderjs/js/holder.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/pages/validation.js')}}"></script>

    <!-- end of plugin scripts-->

<script>
function ValidaCep()

{

//Se a quantidade de dígitos do cep for igual a 8

if (cep.Length == 8)

{

//a variável cep recebe os cinco primeiros dígitos + - + três últimos dígitos ex: 09999-999

cep = cep.Substring(0, 5) + "-" + cep.Substring(5, 3);

//txtCep.Text recebe o valor da variável cep

txtCep.Text = cep;

}

//retorna true ou false

return System.Text.RegularExpressions.Regex.IsMatch(cep, ("[0-9]{5}-[0-9]{3}"));

}

</script>
@stop