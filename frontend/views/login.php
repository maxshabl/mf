<!DOCTYPE html>
<html>

<head>
    <title>Тестовое задание</title>
    <!-- Bootstrap -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <link href="/css/jumbotron-narrow.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="container">
        <div class="header">

            <h3 class="text-muted">Вход</h3>
        </div>

        <form class="form-horizontal" action="/index/login" method="POST">
            <fieldset >
                <div class="form-group">
                    <label for="username" class="control-label col-xs-2">Username</label>
                    <div class="col-xs-10">
                        <input type="username" name="username" class="form-control" id="inputEmail" placeholder="Username">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword" class="control-label col-xs-2">Пароль</label>
                    <div class="col-xs-10">
                        <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Пароль">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-10">
                        <button type="submit" class="btn btn-primary">Войти</button>
                    </div>
                </div>
            </fieldset>
        </form>

        <div class="footer">
            <p>Максим Шаблинский</p>
        </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
</body>
</html>