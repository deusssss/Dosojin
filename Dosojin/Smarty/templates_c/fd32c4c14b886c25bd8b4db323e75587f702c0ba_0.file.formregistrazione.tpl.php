<?php
/* Smarty version 3.1.39, created on 2021-08-23 23:14:13
  from 'D:\XAMPP\htdocs\Dosojin\Smarty\templates\formregistrazione.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_61240fa596cd27_92695587',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fd32c4c14b886c25bd8b4db323e75587f702c0ba' => 
    array (
      0 => 'D:\\XAMPP\\htdocs\\Dosojin\\Smarty\\templates\\formregistrazione.tpl',
      1 => 1629752929,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61240fa596cd27_92695587 (Smarty_Internal_Template $_smarty_tpl) {
?><!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>D&#333sojin</title>
    <base href="https://localhost/Dosojin/">
    <link href="Smarty/css/DosojinBase.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <title>Bootstrap Sign up Form with Icons</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.5.1.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"><?php echo '</script'; ?>
>
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
                        <a class="nav-link" href="?controller=Login&task=getLoginForm">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?controller=Registrazione&task=getSignUpForm">Registrati
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>


                </ul>
            </div>
        </div>
    </nav>
</div>
<br><br><br><br>
<div class="container">



    <div class="signup-form">
        <form action="" method="post">
            <h2>Sign Up</h2>
            <p>Inserisci i tuoi dati per iniziare a viaggiare con noi!</p>
            <hr>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<span class="fa fa-user"></span>
					</span>
                    </div>
                    <input type="text" class="form-control" name="username" placeholder="Username" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                    </div>
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-lock"></i>
					</span>
                    </div>
                    <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-lock"></i>
						<i class="fa fa-check"></i>
					</span>
                    </div>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Conferma password" required="required">
                </div>
            </div>
            <div class="form-group">
                <label class="form-check-label"><input type="checkbox" required="required"> Accetto i termini di utilizzo e le regole d'uso</a></label>
            </div>
            <div class="form-group">
                <input type="hidden" name="controller" value="Registrazione">
                <input type="hidden" name="task" value="nuovoUtente">





                <button type="submit" class="btn btn-primary btn-lg">Registrati</button>
            </div>
        </form>
        <div class="text-center">Hai gia un account? <a href="?controller=Login&task=getLoginForm">Accedi qui!</a></div>
    </div>



</div>
</body>
</html>
<?php }
}
