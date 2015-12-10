<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">

    <title>@yield('page-title') | Админ Панел - AVTOPARTS.BG</title>

    <!-- Bootstrap Core CSS -->
    <link href="/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap-select.css">

    <!-- MetisMenu CSS -->
    <link href="/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- DropZone -->
    <link href="/css/dropzone.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="/js/tinymce.min.js"></script>
    <script>
        tinymce.init({selector:'#post_description'});
        tinymce.init({selector:'#post_content'});
        tinymce.init({selector:'#work_time'});
    </script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/bg_BG/sdk.js#xfbml=1&version=v2.5";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('/admin/dashboard') }}">AVTOPARTS.BG - Администрация</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> {{ Auth::user()->getName() }} <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="{{ url('/') }}"><i class="fa fa-sign-out fa-fw"></i> Към сайта</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="{{ url('/admin/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Начало</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-building-o fa-fw"></i> Продукти<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="{{ url('/admin/add-products/') }}">Добавяне на продукт</a>
                                </li>
                                <li>
                                    <a href="{{ url('/admin/list-products') }}">Таблица с продукти</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="{{ url('/admin/categories') }}"><i class="fa fa-table fa-fw"></i> Категории</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/sub-categories') }}"><i class="fa fa-edit fa-fw"></i> Подкатегории </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/brands') }}"><i class="fa fa-wrench fa-fw"></i> Марки</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/models') }}"><i class="fa fa-wrench fa-fw"></i> Модели</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/orders') }}"><i class="fa fa-wrench fa-fw"></i> Поръчки</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/blog') }}"><i class="fa fa-wrench fa-fw"></i> Blog</a>
                        </li>
                        <li>
                            <a href="{{ url('/admin/contacts') }}"><i class="fa fa-wrench fa-fw"></i> Контакти</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        @yield('content')

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="/bower_components/jquery/dist/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="/bower_components/metisMenu/dist/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript --> 
        <script src="/bower_components/raphael/raphael-min.js"></script>
        <script src="/bower_components/morrisjs/morris.min.js"></script>
        <script src="/js/morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="/dist/js/sb-admin-2.js"></script>

        <script src="/js/dropzone.min.js"></script>

        <script>
            $('#myTabs a').click(function (e) {
              e.preventDefault()
              $(this).tab('show')
            });

            $('#myTabs2 a').click(function (e) {
              e.preventDefault()
              $(this).tab('show')
            });

            $('#category_id').on('change',function(e){
                console.log(e);

                var cat_id = e.target.value;

                //ajax
                $.get('/ajax-subcat?cat_id=' + cat_id, function(data){
                    //success data
                    $('#subcategory_id').empty();
                    $.each(data, function(index, subcatObj){

                        $('#subcategory_id').append('<option value="'+subcatObj.id+'">'+subcatObj.name+'</option>');

                    });

                });

            });

            $('#brand_id').on('change',function(e){
                console.log(e);

                var brand_id = e.target.value;

                //ajax
                $.get('/ajax-model?brand_id=' + brand_id, function(data){
                    //success data
                    $('#model_id').empty();
                    $.each(data, function(index, modelObj){

                        $('#model_id').append('<option value="'+modelObj.id+'">'+modelObj.name+'</option>');

                    });

                });

            });
        </script>

</body>

</html>