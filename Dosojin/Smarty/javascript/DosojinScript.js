function informativa(checkboxElem) {
    if (checkboxElem.checked) {
        alert("La registrazione come azienda impedisce di salvare e seguire percorsi,ma solo di crearne." +
            "La tua richiesta verrà presa in considerazione da un amministratore, che ti contatterà il prima possibile." +
            "Registrati come utente normale per avere accesso a tutte le funzionalità offerte");
    }
}


function addTappa(){
    document.getElementById("formTappe").style.display = 'block'
    document.getElementById("formTrasporti").style.display = 'none'
}
function addTrasporto(){
    document.getElementById("formTappe").style.display = 'none'
    document.getElementById("formTrasporti").style.display = 'block'

}
