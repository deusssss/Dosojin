<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>D&#333sojin</title>
    <base href="https://localhost/Dosojin/">
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
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
                            <a class="nav-link" href="Login/getLoginForm">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Registrazione/getSignUpForm">Registrati</a>
                        </li>
                    {/if}
                    {if $logged==true}
                        {if $userType!='interno'}
                            {if $userType=='utente'}
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="SfogliaPercorsi/getPercorsiSalvati/{$idUtente}">Salvati</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                       href="PercorsoSeguito/getPercorsoSeguito">Seguito</a>
                                </li>
                            {/if}
                            <li class="nav-item">
                                <a class="nav-link" href="CreaPercorso/getFormCreaPercorso">Crea</a>
                            </li>
                        {/if}
                        {if $userType=='interno'}
                            <li class="nav-item">
                                <a class="nav-link"
                                   href="Inbox/getMyInbox">Inbox</a>
                            </li>
                        {/if}
                        <li class="nav-item">
                            {if $userType=='interno'}
                                <a class="nav-link"
                                   href="Utente/getPaginaUtente/{$idUtente}/true">{$username}</a>
                            {/if}
                            {if $userType!='interno'}
                                <a class="nav-link"
                                   href="Utente/getPaginaUtente/{$idUtente}">{$username}</a>
                            {/if}
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="Logout/logout">Logout</a>
                        </li>
                        <li class="nav-item">
                            <img src="{$picture}" alt="" width="50" height="50">
                        </li>
                    {/if}


                </ul>
            </div>
        </div>
    </nav>
</div>
<br><br><br><br>
<div class="container">

    <div id="notfound">
        <div class="notfound">
            <img src="Smarty/immagini/site/monkey.jpg" class="centerLogo" alt=""><br>
            <div class="notfound-404">
                <h3>Oops! pagina non trovata</h3>
                <h1><span>4</span><span>0</span><span>4</span></h1>
            </div>
            <h2>{$errmex}</h2>
        </div>
    </div>


</div>
</body>
</html>
