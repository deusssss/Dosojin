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
                        <a class="nav-link" href="CreaPercorso/getFormCreaPercorso">Crea
                            <span class="sr-only">(current)</span></a>
                    </li>
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
    <noscript>


        <div class=" signup-form" style="display: block" id="formTappe">
            <form action="CreaPercorso/editNewPercorso" method="post">
                <h2>Aggiungi una tappa!</h2>
                <hr>
                <p>Dai un nome alla tua tappa </p>

                <div class="form-group">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                            </div>
                            <input type="text" class="form-control" name="nome" placeholder="Nome tappa"
                                   required="required">
                        </div>
                    </div>
                    <p>inserisci l'indirizzo della tappa o il link di google maps ad essa </p>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                            </div>
                            <input type="text" class="form-control" name="indirizzo" placeholder="Indirizzo"
                                   required="required">
                        </div>
                    </div>
                    <p>Per quanto tempo consigli la permanenza? </p>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                            </div>
                            <input type="text" class="form-control" name="permanenzaConsigliata"
                                   placeholder="permanenza consigliata" required="required">
                        </div>
                    </div>
                    <p>Descrivi brevemente il luogo </p>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                            </div>
                            <input type="text" class="form-control" name="informazioni" placeholder="Informazioni"
                                   required="required">
                        </div>
                    </div>
                    <p>inserisci qui eventuali link e risorse utili </p>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                            </div>
                            <input type="text" class="form-control" name="risorse" placeholder="Risorse"
                                   required="required">
                        </div>
                    </div>


                    <div class="form-group">
                        <input type="hidden" name="add" value="tappa">

                        <button type="submit" class="btn btn-primary btn-lg">Aggiungi!</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="signup-form" style="display: block" id="formTrasporti">
            <form action="CreaPercorso/editNewPercorso" method="post">
                <h2>Aggiungi un mezzo di trasporto!</h2>
                <hr>
                <p>Con quale mezzo consigli di spostarsi? </p>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                        </div>
                        <input type="text" class="form-control" name="mezzo" placeholder="Mezzo" required="required">
                    </div>
                </div>
                <p>A partire da quale delle tue tappe? </p>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                        </div>

                        <select name="partenza">
                            {for $t=0 to $tappe|count-1}
                                <option value="{$tappe[$t]['ID_tappa']}">{$tappe[$t]['nome']}</option>
                            {/for}
                        </select>
                    </div>
                </div>
                <p>Fino a quale delle tue tappe? </p>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                        </div>

                        <select name="arrivo">
                            {for $t=0 to $tappe|count-1}
                                <option value="{$tappe[$t]['ID_tappa']}">{$tappe[$t]['nome']}</option>
                            {/for}
                        </select>
                    </div>
                </div>
                <p>Descrivi brevemente il viaggio </p>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                        </div>
                        <input type="text" class="form-control" name="informazioni" placeholder="Informazioni"
                               required="required">
                    </div>
                </div>
                <p>inserisci qui eventuali link e risorse utili </p>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                        </div>
                        <input type="text" class="form-control" name="risorse" placeholder="Risorse" required="required">
                    </div>
                </div>
                <p>A che ora consigli la partenza? </p>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                        </div>
                        <input type="time" class="form-control" name="ora_partenza" required="required">
                    </div>
                </div>
                <p>A che ora prevedi l'arrivo? </p>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                        </div>
                        <input type="time" class="form-control" name="ora_arrivo" required="required">
                    </div>
                </div>
                <p>Quanto è lungo il tragitto? (esprimilo in numero di Km)</p>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                        </div>
                        <input type="text" class="form-control" name="lunghezza_tragitto" required="required">
                    </div>
                </div>

                <div class="form-group">
                    <input type="hidden" name="add" value="trasporto">

                    <button type="submit" class="btn btn-primary btn-lg">Aggiungi!</button>
                </div>
            </form>
        </div>


    </noscript>
    <button type="button" class="btn btn-primary btn-lg" onclick="addTappa()">Aggiungi tappa</button>
    <button type="button" class="btn btn-primary btn-lg" onclick="addTrasporto()">Aggiungi trasporto</button>

    <div class=" signup-form" style="display: none" id="formTappe">
        <form action="CreaPercorso/editNewPercorso" method="post">
            <h2>Aggiungi una tappa!</h2>
            <hr>
            <p>Dai un nome alla tua tappa </p>

            <div class="form-group">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                        </div>
                        <input type="text" class="form-control" name="nome" placeholder="Nome tappa"
                               required="required">
                    </div>
                </div>
                <p>inserisci l'indirizzo della tappa o il link di google maps ad essa </p>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                        </div>
                        <input type="text" class="form-control" name="indirizzo" placeholder="Indirizzo"
                               required="required">
                    </div>
                </div>
                <p>Per quanto tempo consigli la permanenza? </p>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                        </div>
                        <input type="text" class="form-control" name="permanenzaConsigliata"
                               placeholder="permanenza consigliata" required="required">
                    </div>
                </div>
                <p>Descrivi brevemente il luogo </p>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                        </div>
                        <input type="text" class="form-control" name="informazioni" placeholder="Informazioni"
                               required="required">
                    </div>
                </div>
                <p>inserisci qui eventuali link e risorse utili </p>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                        </div>
                        <input type="text" class="form-control" name="risorse" placeholder="Risorse"
                               required="required">
                    </div>
                </div>


                <div class="form-group">
                    <input type="hidden" name="add" value="tappa">

                    <button type="submit" class="btn btn-primary btn-lg">Aggiungi!</button>
                </div>
            </div>
        </form>
    </div>

    <div class="signup-form" style="display: none" id="formTrasporti">
        <form action="CreaPercorso/editNewPercorso" method="post">
            <h2>Aggiungi un mezzo di trasporto!</h2>
            <hr>
            <p>Con quale mezzo consigli di spostarsi? </p>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                    </div>
                    <input type="text" class="form-control" name="mezzo" placeholder="Mezzo" required="required">
                </div>
            </div>
            <p>A partire da quale delle tue tappe? </p>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                    </div>

                    <select name="partenza">
                        {for $t=0 to $tappe|count-1}
                            <option value="{$tappe[$t]['ID_tappa']}">{$tappe[$t]['nome']}</option>
                        {/for}
                    </select>
                </div>
            </div>
            <p>Fino a quale delle tue tappe? </p>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                    </div>

                    <select name="arrivo">
                        {for $t=0 to $tappe|count-1}
                            <option value="{$tappe[$t]['ID_tappa']}">{$tappe[$t]['nome']}</option>
                        {/for}
                    </select>
                </div>
            </div>
            <p>Descrivi brevemente il viaggio </p>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                    </div>
                    <input type="text" class="form-control" name="informazioni" placeholder="Informazioni"
                           required="required">
                </div>
            </div>
            <p>inserisci qui eventuali link e risorse utili </p>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                    </div>
                    <input type="text" class="form-control" name="risorse" placeholder="Risorse" required="required">
                </div>
            </div>
            <p>A che ora consigli la partenza? </p>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                    </div>
                    <input type="time" class="form-control" name="ora_partenza" required="required">
                </div>
            </div>
            <p>A che ora prevedi l'arrivo? </p>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                    </div>
                    <input type="time" class="form-control" name="ora_arrivo" required="required">
                </div>
            </div>
            <p>Quanto è lungo il tragitto? (esprimilo in numero di Km)</p>

            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
					<span class="input-group-text">
						<i class="fa fa-paper-plane"></i>
					</span>
                    </div>
                    <input type="text" class="form-control" name="lunghezza_tragitto" required="required">
                </div>
            </div>

            <div class="form-group">
                <input type="hidden" name="add" value="trasporto">

                <button type="submit" class="btn btn-primary btn-lg">Aggiungi!</button>
            </div>
        </form>
    </div>
    <a href="CreaPercorso/crea">
        <button class="btn btn-primary btn-lg">Finalizza la creazione ed invia!</button>
    </a>
</div>

<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Tappe</h2>
            </div>
        </div>
        {if $tappe|count>0}
            {for $t=0 to $tappe|count-1}
                <table class="table table-responsive-xl">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>N</th>
                        <th>Nome</th>
                        <th>Indirizzo</th>
                        <th>Permaneza Consigliata</th>
                        <th>Informazioni</th>
                        <th>Risorse</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="alert" role="alert">

                        <td></td>
                        <td>{$tappe[$t]['ID_tappa']}</td>
                        <td>{$tappe[$t]['nome']}</td>
                        <td>{$tappe[$t]['indirizzo']}</td>
                        <td>{$tappe[$t]['permanenzaConsigliata']}</td>
                        <td>{$tappe[$t]['informazioni']}</td>
                        <td>{$tappe[$t]['risorse']}</td>
                        <td></td>

                    </tr>
                    </tbody>
                </table>
            {/for}
        {/if}

    </div>
</section>
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Trasporti</h2>
            </div>
        </div>
        {if $trasporti|count>0}

            {for $t=0 to $trasporti|count-1}
                <table class="table table-responsive-xl">
                    <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>N</th>
                        <th>Mezzo</th>
                        <th>Da</th>
                        <th>A</th>
                        <th>Informazioni</th>
                        <th>Risorse</th>
                        <th>Ora partenza</th>
                        <th>Ora arrivo</th>
                        <th>&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="alert" role="alert">

                        <td></td>
                        <td> {$t}</td>
                        <td>{$trasporti[$t]['mezzo']}</td>
                        <td>{$trasporti[$t]['partenza']}</td>
                        <td>{$trasporti[$t]['arrivo']}</td>
                        <td>{$trasporti[$t]['informazioni']}</td>
                        <td>{$trasporti[$t]['risorse']}</td>
                        <td>{$trasporti[$t]['ora_partenza']}</td>
                        <td>{$trasporti[$t]['ora_arrivo']}</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            {/for}
        {/if}

    </div>
</section>
</body>
</html>
