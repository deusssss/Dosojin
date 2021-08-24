<!doctype html>
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

                    {if $logged==false}
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=Login&task=getLoginForm">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=Registrazione&task=getSignUpForm">Registrati</a>
                        </li>
                    {/if}
                    {if $logged==true}
                        {if $userType!='interno'}
                            {if $userType=='esterno'}
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="?controller=SfogliaPercorsi&task=getPercorsiSalvati&id={$id}">Salvati</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="?controller=PercorsoSeguito&task=getPercorsoSeguito&id={$id}">Seguito</a>
                                </li>
                            {/if}
                            <li class="nav-item">
                                <a class="nav-link" href="?controller=CreaPercorso&task=getFormCreaPercorso">Crea</a>
                            </li>
                        {/if}
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=Utente&task=getPaginaUtente&id={$id}">{$username}</a>
                        </li>
                        <li class="nav-item">
                            <img src="{$picture}">
                        </li>
                    {/if}

                </ul>
            </div>
        </div>
    </nav>
</div>
<br><br><br><br>
<div class="container">
    <img src="Smarty/immagini/site/logo.png" class="centerLogo"><br>
    {if $userType=='interno'}
        <a href="?controller=Inbox&task=getInbox&id={$id}" class=cta>
            <span>La tua inbox!</span>
            <svg width="13px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
            </svg>
        </a>
    {/if}
    {if $userType!='interno'}
        <a href="?controller=sfogliaPercorsi&task=sfoglia" class=cta>
            <span>Sfoglia i percorsi!</span>
            <svg width="13px" height="10px" viewBox="0 0 13 10">
                <path d="M1,5 L11,5"></path>
                <polyline points="8 1 12 5 8 9"></polyline>
            </svg>
        </a>
    {/if}
</div>
</body>
</html>
