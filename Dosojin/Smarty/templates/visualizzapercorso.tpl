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
    <link href='https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap' id="bootstrap-css">
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


<div class="container d-flex align-items-stretch">
    <nav id="sidebar" class="img" style="background-image: Smarty/immagini/images/bg_1.jpg">
        <div class="p-4">
            <h1><span class="logo">Tappe</span></h1>
            <ul class="list-unstyled components mb-5">
                {for $t=0 to $nomiTappe|count-1}
                    <li>
                        {if $t!=$tappe['ID_tappa']}
                            <a href="VisualizzaPercorso/impostaPaginaVisualizzazione/{$idPercorso}/{$t}"><span
                                        class="fa fa-plane mr-3"></span> {$nomiTappe[$t]}</a>
                        {/if}
                        {if $t==$tappe['ID_tappa']}
                            <span class="fa fa-plane mr-3"></span>
                            <b>{$nomiTappe[$t]}</b>
                        {/if}
                    </li>
                {/for}
                <li><span
                            class="fa  mr-3"></span></li>
                <li><span
                            class="fa  mr-3"></span></li>
                {if $seguito==false && $userType=='utente' && $logged==true}
                    <li>
                        <a href="Percorso/salvaPercorso/{$idPercorso}"><span
                                    class="fa fa-plane mr-3"></span> Salva percorso</a>
                    </li>
                    <li>
                        <a href="Percorso/seguiPercorso/{$idPercorso}"><span
                                    class="fa fa-plane mr-3"></span> Segui percorso</a>
                    </li>
                {/if}
                {if $seguito==true && $tappe['ID_tappa']!=$nomiTappe|count-1}
                    <li>
                        <a href="PercorsoSeguito/prossimaTappa"><span
                                    class="fa fa-plane mr-3"></span> Prossima Tappa</a>
                    </li>
                {/if}
            </ul>
        </div>
    </nav>
    <!-- Page Content  -->
    <div class=" p-4 p-md-5 pt-5">
        <h1>
            <span>{$nome}</span>
        </h1>
        {if $approvato==0}
            <span><b>In attesa di approvazione di un moderatore</b><br></span>
            <br>
        {/if}
        <span><b>creatore:</b> <br><a
                    href="Utente/getPaginaUtente/{$creatoreId}">{$creatoreNome}</a></span><br>
        <span><b>luogo:</b> <br>{$luogo}</span><br>
        <span><b>Descrizione:</b> <br>{$descrizione}</span><br>
        <span><b>Periodo consigliato:</b> <br>{$periodoConsigliato}</span><br>
        <span><b>Rating:</b> <br>{$rating}</span><br>
        <span><b>Lunghezza totale:</b> <br>{$lunghezza} Km</span><br>
        <span><b>Durata totale secondo l'itinerario:</b> <br>{$durata}</span><br>

        <h1>
            <span>{$tappe['nome']}</span>
        </h1>

        <span><b>Posizione:</b> <br>{$tappe['indirizzo']}</span><br>
        <span><b>Per quanto rimanere:</b> <br>{$tappe['permanenza_consigliata']}</span><br>
        <span><b>Descrizione:</b> <br>{$tappe['informazioni']}</span><br>
        <span><b>Risorse utili:</b> <br>{$tappe['risorse']}</span><br>
        {foreach $trasporti as $t}
            {if $t['partenza']==$tappe['ID_tappa']}
                <div class=" p-4 p-md-5 pt-5">
                    <h2>
                        <span>Come arrivare</span>
                    </h2>
                    <span><b>Mezzo:</b> <br>{$t['mezzo']}</span><br>
                    <span><b>Ora di partenza consigliata:</b> <br>{$t['ora_partenza']}</span><br>
                    <span><b>Ora di arrivo prevista:</b> <br>{$t['ora_partenza']}</span><br>
                    <span><b>Durata viaggio prevista:</b> <br>{$t['durataViaggio']}</span><br>
                    <span><b>Lunghezza tragitto:</b> <br>{$t['lunghezza_tragitto']}</span><br>
                    <span><b>Informazioni:</b> <br>{$t['informazioni']}</span><br>
                    <span><b>Risorse utili:</b> <br>{$t['risorse']}</span><br>
                </div>
            {/if}
            {if $t['arrivo']==$tappe['ID_tappa']}
                <div class=" p-4 p-md-5 pt-5">
                    <h2>
                        <span>Come partire</span>
                    </h2>
                    <span><b>Mezzo:</b> <br>{$t['mezzo']}</span><br>
                    <span><b>Ora di partenza consigliata:</b> <br>{$t['ora_partenza']}</span><br>
                    <span><b>Ora di arrivo prevista:</b> <br>{$t['ora_partenza']}</span><br>
                    <span><b>Durata viaggio prevista:</b> <br>{$t['durataViaggio']}</span><br>
                    <span><b>Lunghezza tragitto:</b> <br>{$t['lunghezza_tragitto']} km</span><br>
                    <span><b>Informazioni:</b> <br>{$t['informazioni']}</span><br>
                    <span><b>Risorse utili:</b> <br>{$t['risorse']}</span><br>
                </div>
            {/if}
        {/foreach}
    </div>
</div>

<div class="container mb-5 mt-5">
    <div class="col-md-12">
        <h3 class="text-center mb-5"> Commenti </h3>

        <div class="col-md-12">
            <ul class="list-unstyled components mb-5">

                {if $commenti|count>0}
                    {foreach $commenti as $c}
                        <li>
                            <div class="media">
                                <img src="{$c['propic']}" alt="" width="50" height="50"
                                     class="mr-3 rounded-circle">
                                <div class="media-body">
                                    <div class="col-8 d-flex">
                                        <h5>
                                            <a href="Utente/getPaginaUtente/{$c['idUtente']}"
                                               class="profile-link"> {$c['nomeUtente']} </a>
                                        </h5>
                                        <span>- {$c['data']}</span> <span>- rating: {$c['rating']}</span>
                                    </div> {$c['testo']}
                                </div>
                            </div>
                        </li>
                    {/foreach}
                {/if}
            </ul>
            <br><br><br><br>
            {if $logged==true}
            <div class="media"><img src="{$picture}" alt="" width="50" height="50"
                                    class="mr-3 rounded-circle">
                <div class="media-body">
                    <div class="row">
                        <div class="col-8 d-flex">
                            <h5>Lascia un commento</h5>
                            <br>
                            <form action="Commento/pubblicaCommento" method="post">
                                <select name="rating" required="required" class="selectpicker">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select> La tua valutazione<br><br><br>
                                <textarea name="testo" rows="4" cols="150"
                                          required="required"></textarea>
                                <br>
                                <input type="hidden" name="tappa" value="{$tappe['ID_tappa']}">
                                <input type="hidden" name="seguito" value="{$seguito}">
                                <input type="hidden" name="percorso" value={$idPercorso}>
                                <button type="submit" class="btn btn-primary btn-lg">Invia
                                    commento!
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            {/if}
        </div>
    </div>
</div>
</body>
</html>
