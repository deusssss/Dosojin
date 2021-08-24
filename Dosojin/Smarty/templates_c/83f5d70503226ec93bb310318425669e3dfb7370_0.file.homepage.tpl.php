<?php
/* Smarty version 3.1.39, created on 2021-08-23 16:26:59
  from 'D:\XAMPP\htdocs\Dosojin\Smarty\templates\homepage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6123b033f409c7_11122484',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '83f5d70503226ec93bb310318425669e3dfb7370' => 
    array (
      0 => 'D:\\XAMPP\\htdocs\\Dosojin\\Smarty\\templates\\homepage.tpl',
      1 => 1629718630,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6123b033f409c7_11122484 (Smarty_Internal_Template $_smarty_tpl) {
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
                        <a class="nav-link" href="">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <?php if ($_smarty_tpl->tpl_vars['logged']->value == false) {?>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=Login&task=getLoginForm">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=Registrazione&task=getSignUpForm">Registrati</a>
                        </li>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['logged']->value == true) {?>
                        <?php if ($_smarty_tpl->tpl_vars['userType']->value != 'interno') {?>
                            <?php if ($_smarty_tpl->tpl_vars['userType']->value == 'esterno') {?>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="?controller=SfogliaPercorsi&task=getPercorsiSalvati&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">Salvati</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="?controller=PercorsoSeguito&task=getPercorsoSeguito&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">Seguito</a>
                                </li>
                            <?php }?>
                            <li class="nav-item">
                                <a class="nav-link" href="?controller=CreaPercorso&task=getFormCreaPercorso">Crea</a>
                            </li>
                        <?php }?>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=Utente&task=getPaginaUtente&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a>
                        </li>
                        <li class="nav-item">
                            <img src="<?php echo $_smarty_tpl->tpl_vars['picture']->value;?>
">
                        </li>
                    <?php }?>

                </ul>
            </div>
        </div>
    </nav>
</div>
<br><br><br><br>
<div class="container">
    <img src="Smarty/immagini/site/logo.png" class="centerLogo"><br>
    <?php if ($_smarty_tpl->tpl_vars['userType']->value == 'interno') {?>
        <a href="?controller=Inbox&task=getInbox&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
" class=cta>
            <span>La tua inbox!</span>
            <svg width="13px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
            </svg>
        </a>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['userType']->value != 'interno') {?>
        <a href="?controller=sfogliaPercorsi&task=sfoglia" class=cta>
            <span>Sfoglia i percorsi!</span>
            <svg width="13px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
            </svg>
        </a>
    <?php }?>
</div>
</body>
</html>
<?php }
}
