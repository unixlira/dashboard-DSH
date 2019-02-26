
<!DOCTYPE html>
<html>
<head>
    <title>Recuperar Acesso</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="{{asset('assets/img/logo1.ico')}}"/>
    <!--Global styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/components.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />
    <!--End of Global styles -->
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/wow/css/animate.css')}}"/>
    <!--End of Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/login1.css')}}"/>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 login_top_bottom">
            @if(isset($mensagem)) <!-- funcao 'old' verifica se existe parametro passado da requisição anterior para a atual -->
                <div class="alert alert-danger alert-dismissable col-lg-5  col-md-8  col-sm-12 mx-auto">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <strong>Atenção: </strong>{{$mensagem}}
                </div>  
            @endif
            <div class="row">
                <div class="col-lg-5  col-md-8  col-sm-12 mx-auto card">
                    <div class="login_logo login_border_radius1">
                        <h3 class="text-center">
                            <img src="{{asset('assets/img/logo_nagumo_play.png')}}" alt="josh logo" class="admire_logo  m-t-15"><br/>
                        </h3>
                    </div>
                    <form action="{{url('login/enviarlogin')}}" id="login_validator1" method="post" class="form-group  login_validator">
                          {{ csrf_field() }}
                        <div class="bg-white login_content login_border_radius">
                            <div class="form-group">
                                <label for="email_modal">Digite seu e-mail cadastrado no site para receber sua senha de acesso:</label>
                                <div class="input-group">
                            <span class="input-group-addon addon_email"><i
                                    class="fa fa-envelope text-primary"></i></span>
                                    <input type="text" class="form-control email_forgot form-control-md"
                                           id="email_modal" name="email" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="form-group form-actions">
                                <input type="submit" class="btn btn-primary" value="Enviar" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer navbar-fixed-bottom">
    <div class="container-fluid m-0">
        <div class="textoFooter ">Desenvolvido por Magic TV &reg; 2017. Todos os Direitos Reservados.</div>    
    </div>
</footer>
<!-- global js -->
<script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!-- end of global js-->
<!--Plugin js-->
<script type="text/javascript" src="{{asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/wow/js/wow.min.js')}}"></script>
<!--End of plugin js-->
<script type="text/javascript" src="{{asset('assets/js/pages/forgot_password.js')}}"></script>
</body>

</html>