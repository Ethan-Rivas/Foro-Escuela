// Actualizar imagen al subirla (solo visualmente)
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    $("#imageUpload").on('change', function () {
        readURL(this);
        console.log("verga");
    });
});