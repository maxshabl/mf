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
      <div class="header">
        <ul class="nav nav-pills pull-right">
            <?php if (isset($username)) : ?>
              <li class="active"><a href="/">Главная</a></li>
              <li><a href=""><?=$username ?></a></li>
              <li><a href="/index/logout">Выход</a></li>
            <?php else :?>
              <li class="active"><a href="/">Главная</a></li>
              <li><a href="/index/registration">Регистрация</a></li>
              <li><a href="/index/login">Вход</a></li>
            <?php endif;?>
        </ul>
        <h3 class="text-muted">Тестовое задание</h3>
      </div>
        <?php if (isset($username)) : ?>
            <div class="jumbotron">

                <form class="form-horizontal" action="/index/spend?XDEBUG_SESSION_START=PHPSTORM" method="POST">
                    <fieldset >

                        <div class="form-group">
                            <div class="col-xs-10">
                                <h3>Добро пожаловать, <?=$username ?></h3>
                                <p class="lead">На Вашем счете <?=$coin??'произошла ошибка. 0' ?> ед.</p>
                                <input type="text" name="coins" class="form-control" id="text" placeholder="Введите сумму списания">
                            </div>
                        </div>


                            <div class="col-xs-10">
                                <button type="submit" class="btn btn-primary">Списать</button>
                            </div>
                    </fieldset>
                </form>
                <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p> -->
            </div>
        <?php else :?>
            <div class="jumbotron">
                <h1>Вы не вошли на сайт!</h1>
                <p class="lead">Чтобы потратить деньги необходимо войти или зарегистрироваться. </p>
                <p class="lead">После регистрации Вы получите 10 000 ед. на счет!</p>
                <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p> -->
            </div>
        <?php endif;?>
      <div class="footer">
        <p>Максим Шаблинский</p>
      </div>
    </div> 
  </body>
</html>