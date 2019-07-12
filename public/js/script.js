if (document.URL.includes('?action=addChapter') || document.URL.includes('?action=updateChapter')) {
    var editor = new FroalaEditor('#editor');
}

const deleteButtons = Array.from(document.querySelectorAll('.delete'));
deleteButtons.map(button => {
    button.addEventListener('click', function (e) {
        if (!window.confirm('Etes-vous sur de vouloir supprimer ce chapitre ?')) {
            e.preventDefault();
        };

    })
})