<!DOCTYPE html>
<html>
<head>
    <title>Lockscreen | Admire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="shortcut icon" href="{{asset('assets/img/logo1.ico')}}"/>
    <!-- Global styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/components.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/css/pages/login1.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/wow/css/animate.css')}}"/>
    <!--End of global styles-->
    <link rel="stylesheet" href="{{asset('assets/css/pages/lockscreen.css')}}"/>
</head>
<body>
<div class="preloader" style=" position: fixed;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  z-index: 100000;
  backface-visibility: hidden;
  background: #ffffff;">
    <div class="preloader_img" style="width: 200px;
  height: 200px;
  position: absolute;
  left: 48%;
  top: 48%;
  background-position: center;
z-index: 999999">
        <img src="{{asset('assets/img/loader.gif')}}" style=" width: 40px;" alt="loading...">
    </div>
</div>
<div>
    <div class="login-container  wow fadeInDown" data-wow-duration="1s" data-wow-delay="0.5s">
        <div class="row card">
            <div class="col-lg-12 login_border_radius1 lockscreen_img">
                @if(isset($mensagem)) <!-- funcao 'old' verifica se existe parametro passado da requisição anterior para a atual -->
                    <div class="alert alert-danger alert-dismissable col-lg-10 mx-auto">
                       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                       {{$mensagem}}
                    </div>  
                @endif
                <div ><img src="{{asset('assets/img/foto_perfil/'.Request::session()->get('foto'))}}" class="avatar" alt="avatar"></div>
            </div>
            <div class="col-lg-12 login_border_radius lockscreen_content">
                <div class="form-box">
                    <form method="POST" name="screen" action="{{url('login/valida_login_lockscreen')}}">
                        <div class="form">
                          {{csrf_field()}}
                            <p class="form-control-static">{{Request::session()->get('nome')}}</p>
                            <input type="password" name="senha" class="form-control" placeholder="Senha...">
                            <button class="btn btn-primary btn-block login" id="index_submit" type="submit">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- global js -->
<script type="text/javascript" src="{{asset('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/vendors/wow/js/wow.min.js')}}"></script>
<!-- end of global js-->
<!-- page level js-->
<script type="text/javascript">
  "use strict";
  $(window).on("load",function() {
      $('.preloader img').fadeOut();
      $('.preloader').fadeOut(1000);
  });
</script>
<script>
    new WOW().init();

    function autoRefreshPage()
    {
        window.location = window.location.href;
    }
    setInterval('autoRefreshPage()', 120000);

</script>
</body>

</html>