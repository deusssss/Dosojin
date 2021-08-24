<?php
/* Smarty version 3.1.39, created on 2021-08-23 23:14:02
  from 'D:\XAMPP\htdocs\Dosojin\Smarty\templates\formlogin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61240f9a919cd8_77098463',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '005a7650b79323ca12c216c2f2e8ab35e38a2701' => 
    array (
      0 => 'D:\\XAMPP\\htdocs\\Dosojin\\Smarty\\templates\\formlogin.tpl',
      1 => 1629748891,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61240f9a919cd8_77098463 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>D&#333sojin</title>
    <base href="https://localhost/Dosojin/">
    <link href="Smarty/css/DosojinBase.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
</head>

<body>

<div class="fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
        <div class="container">
            <a class="navbar-brand" rel="nofollow" href="" style="text-transform: uppercase;">
                D&#333sojin</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item active">
                        <a class="nav-link" href="">Home </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="?controller=Login&task=getLoginForm">Login
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=Registrazione&task=getSignUpForm">Registrati</a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>
</div>
<br><br><br><br>
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form action="" method="POST" class="box">
                        <p class="text-muted">
                            <?php echo $_smarty_tpl->tpl_vars['errmex']->value;?>

                        </p>
                        <h1>Login</h1>
                        <p class="text-muted"> Inserisci le tue credenziali per accedere!</p>
                        <input type="text" name="username" placeholder="Username">
                        <input type="password" name="password" placeholder="Password">
                        <input type="hidden" name="controller" value="Login">
                        <input type="hidden" name="task" value="autentica">
                        <input type="submit" name="" value="Login" >

                    </form>
                </div>
            </div>
        </div>
    </div>


</div>
</body>
</html>
<?php }
}
