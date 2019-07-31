if (document.URL.includes('/addChapter')){
    var editor = new FroalaEditor('#editor');
} else if (document.URL.includes('/updateChapter/?id')) {
    var editor = new FroalaEditor('#editor');
}
if (document.URL.includes('/addComment') || document.URL.includes('?action=addsmth')) {
    var editor = new FroalaEditor('#editor');
}
if(document.URL.includes('/updateChapter' || '/moderate')) {
    const deleteButtons = Array.from(document.querySelectorAll('.delete'));
    deleteButtons.map(button => {
        button.addEventListener('click', function (e) {
            if (!window.confirm('Etes-vous sur de vouloir supprimer ce chapitre ?')) {
                e.preventDefault();
            };
    
        })
    })
}