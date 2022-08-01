$(function(){
    var i = 0;
    $(".semanal").on('change', function(){
        var semanal = $(".semanal").val();
        var nuevoValor = ((semanal / 7) * 30);
        $(".mensual").val(Math.round(nuevoValor));
    });
    // $("#adicional").on('click', function(){
    //     $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
    // });

    // $("#eliminar").on('click', function(){
    //     $("#tabla tbody tr:eq(0)").remove();
    // });
});

function displayForm(c) {
    if (c.value == "2") {    
        jQuery('#memberForm').toggle('show');
        jQuery('#requestForm').hide();
    }
        if (c.value == "1") {
        jQuery('#requestForm').toggle('show');
        jQuery('#memberForm').hide();
    }
};