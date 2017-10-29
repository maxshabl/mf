<!DOCTYPE html>
<html>
<?php
echo $email;
$a = [];
?>
  <head>
    <title>Тестовое задание</title>
    <!-- Bootstrap -->
    <link href="/views/css/bootstrap.min.css" rel="stylesheet">
	
	<link href="/views/css/jumbotron-narrow.css" rel="stylesheet">
  </head>
  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <?php if(isset($username)): ?>
              <li class="active"><a href="/">Главная</a></li>
              <li><a href=""><?=$username ?></a></li>
              <li><a href="/index/logout">Выход</a></li>
          <?php else:?>
              <li class="active"><a href="/">Главная</a></li>
              <li><a href="/index/registration">Регистрация</a></li>
              <li><a href="/index/login">Вход</a></li>
          <?php endif;?>
        </ul>
        <h3 class="text-muted">Тестовое задание</h3>
      </div>

      <div class="jumbotron">
        <h1>Вы не вошли на сайт!</h1>
        <p class="lead">Чтобы потратить деньги необходимо войти или зарегистрироваться.
            После регистрации Вы получите 10 000 ед. на счет!</p>
        <!--<p><a class="btn btn-lg btn-success" href="#" role="button">Sign up today</a></p> -->
      </div>



      <div class="footer">
        <p>Максим Шаблинский</p>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>