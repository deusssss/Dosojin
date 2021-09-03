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
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                {if $salvati==false}
                    <h2 class="heading-section">Sfoglia i percorsi</h2>
                {/if}
                {if $salvati==true}
                    <h2 class="heading-section">Percorsi salvati</h2>
                {/if}
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table table-responsive-xl">
                        <thead>
                        <tr>
                            <th></th>

                            <th>Nome</th>
                            <th>Creatore</th>
                            <th>Luogo</th>
                            <th>Lunghezza</th>
                            <th>Rating</th>
                            <th>Numero tappe</th>
                            <th>Numero trasporti</th>
                            <th>Periodo consigliato</th>
                            <th>Visuazizza</th>
                            {if $userType=='utente' && $logged==true}
                                {if $salvati==false}
                                    <th>Salva</th>
                                {/if}
                                <th>Segui</th>
                            {/if}
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tbody>
                        {if ($percorsi|count>0)}
                            <form action="SfogliaPercorsi/sfogliaPercorsi" method="POST">
                                <p class="text-muted"> Filtra per </p>
                                <select name="filtro">
                                    <option value="nome">Nome</option>
                                    <option value="luogo">Luogo</option>
                                </select>
                                <input type="text" name="valore">

                                <p class="text-muted"> Ordina per </p>
                                <select name="ordinamento">
                                    <option value="nome">Nome</option>
                                    <option value="luogo">Luogo</option>
                                    <option value="periodoConsigliato">Periodo consigliato</option>
                                </select><br>
                                <button type="submit" class="btn btn-primary btn-lg"> Cerca</button>
                            </form>
                            {for $i=0 to $percorsi|count-1}
                                <tr>
                                    <td></td>
                                    <td>{$percorsi[$i]['nome']}</td>
                                    <td>
                                        <a href="Utente/getPaginaUtente/{$percorsi[$i]['idCreatore']}">{$percorsi[$i]['creatore']}</a>
                                    </td>
                                    <td>{$percorsi[$i]['luogo']}</td>
                                    <td>{$percorsi[$i]['lunghezza']}</td>
                                    <td>{$percorsi[$i]['rating']}</td>
                                    <td>{$percorsi[$i]['tappe']}</td>
                                    <td>{$percorsi[$i]['trasporti']}</td>
                                    <td>{$percorsi[$i]['periodoConsigliato']}</td>

                                    <td>
                                        <a href="VisualizzaPercorso/impostaPaginaVisualizzazione/{$percorsi[$i]['id']}">Visualizza</a>
                                    </td>
                                    {if $userType=='utente' && $logged==true}

                                        {if $salvati==false}
                                            <td>
                                                <a href="Percorso/salvaPercorso/{$percorsi[$i]['id']}">Salva</a>
                                            </td>
                                        {/if}
                                        <td>
                                            <a href="Percorso/seguiPercorso/{$percorsi[$i]['id']}">Segui</a>
                                        </td>
                                    {/if}
                                    <td></td>
                                </tr>
                            {/for}
                        {/if}
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
