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
                    <li class="nav-item">
                            <a class="nav-link"
                               href="Utente/getPaginaUtente/{$idUtente}/true">{$username}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Logout/logout">Logout</a>
                    </li>
                    <li class="nav-item">
                        <img src="{$picture}" alt="" width="50" height="50">
                    </li>

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
                <h2 class="heading-section">Pagina {$ruolo}</h2>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-wrap">
                    <table class="table table-responsive-xl">
                        <thead>
                        <tr>
                            <th>&nbsp;</th>
                            {if $ruolo=='moderatore'}
                                <th>Nome Percorso</th>
                                <th>Creatore</th>
                                <th>Visualizza</th>
                                <th>Approva</th>
                                <th>Rifiuta</th>
                            {/if}

                            {if $ruolo=='amministratore'}
                                <th>Nome utente</th>
                                <th>Tipo</th>
                                <th>Email</th>
                                <th>Approva</th>
                                <th>Rifiuta</th>
                            {/if}
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>

                        {if $inbox!=false}
                            {for $i= 0 to $inbox|count-1}
                                <tr class="alert" role="alert">
                                    <td></td>
                                    {if $ruolo=='moderatore'}
                                        <td>
                                            <span>{$inbox[$i]['nomePercorso']}</span>
                                        </td>
                                        <td>
                                            <span> <a href="Utente/getPaginaUtente/{$inbox[$i]['idCreatore']}">{$inbox[$i]['nomeCreatore']}</a></span>
                                        </td>
                                        <td>
                                            <span><a href="VisualizzaPercorso/impostaPaginaVisualizzazione/{$inbox[$i]['idPercorso']}">Visualizza</a></span>
                                        </td>
                                        <td>
                                            <span><a href="Inbox/attivaPercorso/{$inbox[$i]['idPercorso']}">Attiva</a></span>
                                        </td>
                                        <td>
                                            <span><a href="Inbox/rifiutaPercorso/{$inbox[$i]['idPercorso']}">Rifiuta</a></span>
                                        </td>
                                    {/if}
                                    {if $ruolo=='amministratore'}
                                        <td>
                                            <a href="Utente/getPaginaUtente/{$inbox[$i]['idUtente']}">{$inbox[$i]['username']}</a>
                                        </td>
                                        <td>
                                            <span>{$inbox[$i]['tipo']}</span>
                                        </td>
                                        <td>
                                            <span> <a href="mailto:{$inbox[$i]['email']}">{$inbox[$i]['email']}</a></span>
                                        </td>
                                        <td>
                                            <span> <a href="Inbox/attivaUtente/{$inbox[$i]['idUtente']}/{$inbox[$i]['tipo']}">Attiva</a></span>
                                        </td>
                                        <td>
                                            <span> <a href="Inbox/rifiutaUtente/{$inbox[$i]['idUtente']}/{$inbox[$i]['tipo']}">Rifiuta</a></span>
                                        </td>
                                    {/if}
                                    <td></td>
                                </tr>
                            {/for}
                        {/if}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>


</body>
</html>
