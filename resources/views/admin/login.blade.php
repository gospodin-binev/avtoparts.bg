<!DOCTYPE html>

<html>

        <head>
            <title>Вход | Admin Panel</title>

            <!-- Bootstap Core -->
            <link rel="stylesheet" href="css/bootstrap.css">

            <!-- Login-Admin-CSS -->
            <link rel="stylesheet" href="css/admin-login.css">

            <!-- Bootstrap Theme -->
            <link rel="stylesheet" href="css/bootstrap-theme.css">

        </head>

        <script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>
        <body>
            <div class="container">
                <div class="row vertical-offset-100">
                    <div class="col-md-4 col-md-offset-4">
                    @if(Session::has('acc-error'))
                        <div class="alert alert-danger">{{ Session::get('acc-error') }}</div>
                    @endif
                    @if(Session::has('acc-info'))
                        <div class="alert alert-success">{{ Session::get('acc-info') }}</div>
                    @endif
                        <div class="panel panel-default">
                            <div class="panel-heading">                                
                                <div class="row-fluid user-row">
                                    <img src="http://s11.postimg.org/7kzgji28v/logo_sm_2_mr_1.png" class="img-responsive" alt="Conxole Admin"/>
                                </div>
                            </div>
                            <div class="panel-body">
                                <form method="post" action="{{ url('/admin/login') }}">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control" name="email" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Парола:</label>
                                        <input type="password" class="form-control" name="password" id="password">
                                    </div>
                                    <button class="btn btn-success btn-lg">Влез</button>
                                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- jQuery -->
            <script src="js/jquery-2.1.4.min.js"></script>

            <!-- Bootstrap Core JS -->
            <script src="js/bootstrap.min.js"></script>

        </body>

<html>