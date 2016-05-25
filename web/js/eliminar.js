$(function() {
    $('a#eliminarItem').click(function() {
        var x = confirm('Desea eliminar el item');
        if (x == true) {
            var direccion = $(this).attr('href');
            return window.location = direccion;
        }
        else {
            return false;
        }
    });
});