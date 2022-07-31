$(function(){
    $("#adicional").on('click', function(){
        $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
    });

    $("#eliminar").on('click', function(){
        $("#tabla tbody tr:eq(0)").remove();
    });

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