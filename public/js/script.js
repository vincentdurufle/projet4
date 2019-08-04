if (document.URL.includes('/addChapter')) {
    var editor = new FroalaEditor('#editor');
} else if (document.URL.includes('/updateChapter/?id')) {
    var editor = new FroalaEditor('#editor');
}
if (document.URL.includes('/addComment') || document.URL.includes('?action=addsmth')) {
    var editor = new FroalaEditor('#editor');
}
if (document.URL.includes('/updateChapter' || '/moderate')) {
    const deleteButtons = Array.from(document.querySelectorAll('.delete'));
    deleteButtons.map(button => {
        button.addEventListener('click', function (e) {
            if (!window.confirm('Etes-vous sur de vouloir supprimer ce chapitre ?')) {
                e.preventDefault();
            };

        })
    })
}

function error(message, nmb) {
    if(document.URL.includes(`?err=${nmb}`)) {
        new Noty({
            type: 'error',
            text: message,
            timeout: 3000
        }).show();
    }
}

function success(message, nmb) {
    if(document.URL.includes(`?success=${nmb}`)) {
        new Noty({
            type: 'success',
            text: message,
            timeout: 3000
        }).show();
    }
}

error('Merci de renseigner tous les champs demandés;', 1);
error('Le nom d\'utilisateur ou email que vous avez renseigné existe déjà.', 2);

success('Merci, un message vous a été envoyer avec un lien d\'activation', 1);