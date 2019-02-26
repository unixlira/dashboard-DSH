@extends(('layouts/default'))
{{-- Page title --}}
@section('title')
    Gallery
    @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!--Plugin styles -->
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/fancybox/css/jquery.fancybox.css')}}"/>
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/fancybox/css/jquery.fancybox-buttons.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/fancybox/css/jquery.fancybox-thumbs.css')}}" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/imagehover/css/imagehover.min.css')}}" />
    <!--End of plugin-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/pages/gallery.css')}}" />
@stop
@section('content')
    <header class="head">
        <div class="main-bar">
            <div class="row no-gutters">
                <div class="col-lg-6 col-md-4 col-sm-4">
                    <h4 class="nav_top_align">
                        <i class="fa fa-image"></i>
                        Galeria
                </h4>
            </div>
            <div class="col-lg-6">
                <div class="float-right">
                    <ol class="breadcrumb nav_breadcrumb_top_align">
                        <li class="breadcrumb-item">
                                <i class="fa fa-home" data-pack="default" data-tags=""></i>
                                Página Inicial
                        </li>
                        <li class="breadcrumb-item">Galeria
                        </li>
                        <li class="breadcrumb-item">Vídeos
                        </li>
                        <li class="breadcrumb-item active">Excluir Vídeos</li>
                    </ol>
                </div>
            </div>
        </div>
    </header>
    <div class="outer">
        <div class="inner bg-light lter bg-container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body m-t-15">
                            <div>
                                <div class="nav-tabs-custom">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a href="#tab_2" class="nav-link active" data-toggle="tab">Meus Vídeos</a>
                                        </li>
                                        <div class="divdireita margemBaixo">
                                            <a id="check-all" href="#" onclick="do_this();" class="btn btn-success margemDir" name="selecionar">
                                                Selecionar Todos  <i class="fa fa-check"></i>
                                            </a>
                                            <a href="#" id="remover" class="btn btn-danger">
                                                Excluir  <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active gallery-padding" id="tab_2">
                                            <div class="row no-gutters" >
                                                @foreach($videos as $v)
                                                <div class="col-xl-1 col-lg-3 col-md-4 col-6 gallery-border" align="center">
                                                    <h6><input type="checkbox" name="excluir[]" value="{{$v->id}}" class="margemCima2">{{mb_strimwidth($v->titulo, 0, 17, '...')}}</h6>
                                                    <div class="zoom thumb_zoom">
                                                        <img src="https://i.ytimg.com/vi/{{$v->id_video}}/mqdefault.jpg" alt="{{$v->id_video}}" class="img-fluid">
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <!-- /button helper gallery -->
                                    </div>
                                    <!-- /.tab-content -->
                                </div>
                                <!-- nav-tabs-custom -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.inner -->
    </div>
    <!-- /.outer -->
@stop
@section('footer_scripts')
    <!--Plugin scripts-->
    <!--Plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/vendors/holderjs/js/holder.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fancybox/js/jquery.fancybox.pack.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fancybox/js/jquery.fancybox-buttons.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fancybox/js/jquery.fancybox-thumbs.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/vendors/fancybox/js/jquery.fancybox-media.js')}}"></script>
    <!--End of plugin scripts-->
    <script type="text/javascript" src="{{asset('assets/js/pages/gallery.js')}}"></script>
    <script>
    function do_this(){
        var checkboxes = document.getElementsByName('excluir[]');
        var button = document.getElementById('check-all');

        if(button.name == 'selecionar'){
            for (var i in checkboxes){
                checkboxes[i].checked = 'FALSE';
            }
            button.name = 'limpar'
        }else{
            for (var i in checkboxes){
                checkboxes[i].checked = '';
            }
            button.name = 'selecionar';
        }
    }

    $("#remover").click(function(e) 
    {  var inputs = $("input[type='checkbox']");
        var vals=[];
        var res;
        for(var i = 0; i < inputs.length; i++) 
        { 
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") 
            {
                if(inputs[i].checked){
                    vals.push(inputs[i].value);
                }
            } 
        }
        var count_checked = $("[name='excluir[]']:checked").length; 
        if(count_checked == 0) 
        {
            alert("Selecione algum item para deletar.");
            return false;
        }
       /*** This portion is the ajax/jquery post calling   ****/
        $.post("excluirvideo", {data:vals, "_token": "{{ csrf_token() }}"}, function(result){
            location.reload();
         });
    });
  </script>
@stop