// Mostrar formulario para crear comentario
const button = $('#create-comment > button');

button.on('click', function() {
    $('#new-comment').show();
    $(this).hide();

    $('#title').focus();
});

// Reiniciar formulario al presionar botón de cancelar
$('#cancel-comment').on('click', function() {
    $('#new-comment').hide();

    const form = $('form');
    form.trigger("reset");
    form.parent().find('button#publish-comment').prop('disabled', false);

    button.show();
});

// Mostrar únicamente controles de video al pasar el cursor en el video
$('#video-player').hover(function toggleControls() {
    if (this.hasAttribute("controls")) {
        this.removeAttribute("controls")
    } else {
        this.setAttribute("controls", "controls")
    }
})