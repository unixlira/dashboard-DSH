
<!DOCTYPE html>
<html>
<head>
    <title>Login | DSH</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="{{asset('assets/img/logo1.ico')}}"/>
    <!--Global styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/components.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />
    <!--End of Global styles -->
    <!--Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css')}}"/>
    <!--End of Plugin styles-->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/login1.css')}}"/>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 login_top_bottom">
            @if(Session::has('erro_login'))
                <div class="alert alert-danger alert-dismissable col-lg-5  col-md-8  col-sm-12 mx-auto">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                   <strong>Atenção: </strong>{{Session::get('erro_login')}}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-5  col-md-8  col-sm-12 mx-auto card">
                    <div class="login_logo login_border_radius1">
                        <h3 class="text-center">
                            <img src="{{asset('assets/img/logo.png')}}" alt="josh logo" class="admire_logo  m-t-15">
                        </h3>
                    </div>
                    <div class="bg-white login_content login_border_radius">
                        <form action="{{url('login/valida_login')}}" id="login_validator" method="post" class="login_validator">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="email" class="col-form-label"> E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-addon input_email"><i
                                            class="fa fa-envelope text-primary"></i></span>
                                    <input type="text" class="form-control  form-control-md" id="email" name="email" placeholder="E-mail">
                                </div>
                            </div>
                            <!--</h3>-->
                            <div class="form-group">
                                <label for="senha" class="col-form-label">Senha</label>
                                <div class="input-group">
                                    <span class="input-group-addon addon_senha"><i
                                            class="fa fa-lock text-primary"></i></span>
                                    <input type="password" class="form-control form-control-md" id="senha"   name="senha" placeholder="senha">
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <div class="input-group">
                                    <div class="g-recaptcha" data-sitekey="6Lft-mwUAAAAAHGicrg39G603MaiIQaJTbfoH0kV"></div>
                                </div>
                            </div> -->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-lg-12">
                                    <input type="submit" value="Entrar" class="btn btn-success btn-block login_button" style="background-color: #ee268f !important;padding:15px;">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input form-control">
                                        <span class="custom-control-indicator"></span>
                                        <a class="custom-control-description">Mantenha-me logado</a>
                                    </label>
                                </div>
                                <div class="col-6 text-right forgot_pwd">
                                    <a href="{{url('login/recuperarlogin')}}" class="custom-control-description forgottxt_clr">Esqueceu a senha?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="footer navbar-fixed-bottom">
    <div class="container-fluid m-0">
        <div class="textoFooter ">Desenvolvido por Magic TV &reg; 2019. Todos os Direitos Reservados.</div>    
    </div>
</footer>
<!-- global js -->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!-- end of global js-->
<!--Plugin js-->
<script type="text/javascript" src="{{asset('assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js')}}"></script>
<!--End of plugin js-->
<script type="text/javascript" src="{{asset('assets/js/pages/login1.js')}}"></script>
<script type="text/javascript">
    function autoRefreshPage()
    {
        window.location = window.location.href;
    }
    setInterval('autoRefreshPage()', 120000);
</script>
</body>
</html>