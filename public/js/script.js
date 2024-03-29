if (document.URL.includes('/addChapter')) {
    var editor = new FroalaEditor('#editor', {
        attribution: false
    });
} else if (document.URL.includes('/updateChapter/?id')) {
    var editor = new FroalaEditor('#editor', {
        attribution: false
    });
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
    if (document.URL.includes(`err=${nmb}`)) {
        new Noty({
            type: 'error',
            text: message,
            timeout: 5000
        }).show();
    }
}

function success(message, nmb) {
    if (document.URL.includes(`success=${nmb}`)) {
        new Noty({
            type: 'success',
            text: message,
            timeout: 5000
        }).show();
    }
}

error('Merci de renseigner tous les champs demandés', 1);
error('Le nom d\'utilisateur ou email que vous avez renseigné existe déjà.', 2);
error('Aucun compte ne correspond à votre addresse mail. Merci d\'en renseigner un autre.', 3);
error('Le mot de passe ou nom d\'utilisateur est incorrect', 4);

success('Merci, un email vous a été envoyer avec un lien d\'activation', 1);
success('Votre mot de passe à été mis à jour avec succès', 2);
success('Merci, vous pouvez maintenez vous connecter à votre compte', 3)



function toggle() {
    if (menu.classList == 'fas fa-bars') {
        menu.classList.remove('fa-bars');
        menu.classList.add('fa-times');
        document.querySelector('.menu-list-container').style.display = 'flex';
        menuH2.classList.add('animationLeftOut');
    } else {
        menu.classList.add('fa-bars');
        document.querySelector('.menu-list-container').style.display = 'none';
        menu.classList.remove('fa-times');
        menuH2.classList.remove('animationLeftOut');
    }
}

const menu = document.querySelector('.fa-bars');
const menuH2 = document.querySelector('.menu div h2');
menu.addEventListener('click', toggle);