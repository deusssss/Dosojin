<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <title>D&#333sojin</title>
    <base href="https://localhost/Dosojin/">

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <link href="Smarty/css/DosojinBase.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="Smarty/javascript/DosojinScript.js"></script>
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
                        <a class="nav-link" href="/CreaPercorso/getFormCreaPercorso">Crea
                            <span class="sr-only">(current)</span></a>
                    </li>
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


                </ul>
            </div>
        </div>
    </nav>
</div>
<br><br><br><br>
<div class="container">

    <p class="text-muted">
        {$errmex}
    </p>

    <div class="signup-form">
        <form action="CreaPercorso/getFormEditPercorso" method="post">
            <h2>Crea il tuo percorso</h2>
            <hr>


            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                    </div>
                    <input type="text" class="form-control" name="nome" placeholder="Nome percorso" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                    </div>
                    <input type="text" class="form-control" name="luogo" placeholder="Zona" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                    </div>
                    <input type="text" class="form-control" name="descrizione" placeholder="descrizione" required="required">
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                    </div>
                    <input type="text" class="form-control" name="periodoConsigliato" placeholder="Periodo consigliato" required="required">
                </div>
            </div>


            <div class="form-group">
                <input type="hidden" name="add" value="none">

                <button type="submit" class="btn btn-primary btn-lg">Crea il tuo viaggio!</button>
            </div>
        </form>


    </div>
</body>
</html>
