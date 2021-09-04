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
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Smarty/css/sidebar.css">
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
                            <a class="nav-link"
                               href="Utente/getPaginathisUtente">{$username}</a>
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
    <div class=" p-4 p-md-5 pt-5">
        <h1>
            <span>{$usernameUtenteVisualizzato}</span>
        </h1>
        {if $attivoUtenteVisualizzato==0}
            <span><b>In attesa di approvazione</b><br></span>
            <br>
        {/if}
        <img src="{$propicUtenteVisualizzato}" alt="" width="200" height="200">
        {if $idUtente==$idUtenteVisualizzato && $userType==$tipoUtenteVisualizzato}
            <form action="Utente/aggiornaImmagineProfilo" method="post" enctype="multipart/form-data">
                <input type="file" name="immagine" accept="image/png" required="required">
                <button type="submit" class="btn btn-success btn-sm rounded-0" data-toggle="tooltip"
                        data-placement="top"
                        title="Modifica"><i class="fa fa-edit">Aggiorna immagine di profilo</i></button>
            </form>
        {/if}
        <div>
            <span><b>ID:</b> <br>{$idUtenteVisualizzato}</span><br>
            <span><b>Username:</b> <br>{$usernameUtenteVisualizzato}</span><br>
            {if $tipoUtenteVisualizzato!='moderatore'&& $tipoUtenteVisualizzato!='amministratore'}
                <span><b>Nome:</b> <br>{$nomeUtenteVisualizzato}</span>
                <br>
                <span><b>Cognome:</b> <br>{$cognomeUtenteVisualizzato}</span>
                <br>
            {/if}
            <span><b>Email:</b> <br>{$emailUtenteVisualizzato}</span><br>

            <span><b>Tipo account:</b> <br>{$tipoUtenteVisualizzato}</span><br>
            {if $tipoUtenteVisualizzato!='moderatore'&& $tipoUtenteVisualizzato!='amministratore'}
                {if $idUtente==$idUtenteVisualizzato && $userType==$tipoUtenteVisualizzato}
                    <form action="Utente/aggiornaInfoProfilo" method="post">
                        <br>
                        <textarea name="informazioni" rows="4" cols="150" required="required"
                                  placeholder="{$informazioniUtenteVisualizzato}"></textarea>
                        <button type="submit" class="btn btn-success btn-sm rounded-0" data-toggle="tooltip"
                                data-placement="top"
                                title="Modifica"><i class="fa fa-edit">Aggiorna le informazioni</i></button>
                    </form>
                {/if}
                {if $idUtente!=$idUtenteVisualizzato}
                    <br>
                    <span><b>Informazioni:</b> <br>{$informazioniUtenteVisualizzato}</span>
                    <br>
                {/if}
            {/if}
        </div>
    </div>
</div>
{if  $tipoUtenteVisualizzato!='moderatore'&& $tipoUtenteVisualizzato!='amministratore' && $creati|count>0}
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Percorsi creati</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-wrap">
                        <table class="table table-responsive-xl">
                            <thead>
                            <tr>
                                <th></th>
                                <th>N</th>
                                <th>Nome</th>
                                {if $idUtente==$idUtenteVisualizzato && $userType==$tipoUtenteVisualizzato}
                                    <th>Approvato</th>
                                    <th>Visibile</th>
                                {/if}
                                <th>Luogo</th>
                                <th>Rating</th>
                                <th>Numero tappe</th>
                                <th>Numero trasporti</th>
                                <th>Visuazizza</th>
                                {if $idUtente==$idUtenteVisualizzato && $userType==$tipoUtenteVisualizzato}
                                    <th>Elimina</th>
                                    <td>Visibilità</td>
                                {/if}
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            {for $i=0 to $creati|count-1}
                                {if ($idUtente==$idUtenteVisualizzato && $userType==$tipoUtenteVisualizzato) || ($creati[$i]['visibile']==1 && $creati[$i]['approvato']==1)}
                                    <tr>
                                        <td></td>
                                        <td>{$i}</td>
                                        <td>{$creati[$i]['nome']}</td>
                                        {if $idUtente==$idUtenteVisualizzato && $userType==$tipoUtenteVisualizzato}
                                            {if $creati[$i]['approvato']==1}
                                                <td>Si</td>
                                            {/if}
                                            {if $creati[$i]['approvato']==0}
                                                <td>No</td>
                                            {/if}
                                            {if $creati[$i]['visibile']==1}
                                                <td>Si</td>
                                            {/if}
                                            {if $creati[$i]['visibile']==0}
                                                <td>No</td>
                                            {/if}
                                        {/if}
                                        <td>{$creati[$i]['luogo']}</td>
                                        <td>{$creati[$i]['rating']}</td>
                                        <td>{$creati[$i]['tappe']}</td>
                                        <td>{$creati[$i]['trasporti']}</td>

                                        <td>
                                            <a href="VisualizzaPercorso/impostaPaginaVisualizzazione/{$creati[$i]['id']}">Visualizza</a>
                                        </td>
                                        {if $idUtente==$idUtenteVisualizzato && $userType==$tipoUtenteVisualizzato}
                                            <td>
                                                <a href="Percorso/eliminaPercorso/{$creati[$i]['id']}">Elimina</a>
                                            </td>
                                            {if $creati[$i]['visibile']==1 && $creati[$i]['approvato']==1}
                                                <td>
                                                    <a href="Percorso/nascondiPercorso/{$creati[$i]['id']}">Nascondi</a>
                                                </td>
                                            {/if}
                                            {if $creati[$i]['visibile']==0 && $creati[$i]['approvato']==1}
                                                <td>
                                                    <a href="Percorso/mostraPercorso/{$creati[$i]['id']}">Mostra</a>
                                                </td>
                                            {/if}
                                        {/if}
                                        <td></td>
                                    </tr>
                                {/if}
                            {/for}
                            <tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
{/if}
</body>
</html>
