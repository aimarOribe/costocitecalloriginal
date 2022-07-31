$(function(){
    $("#adicionalFlujoCaja").on('click', function(){
        $("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
    });

    $("#eliminarFlujoCaja").on('click', function(){
        $("#tabla tbody tr:eq(0)").remove();
    });

});

function displayForm(c) {
    if (c.value == "2") {    
        jQuery('#memberFormFlujoCaja').toggle('show');
        jQuery('#requestFormFlujoCaja').hide();
    }
        if (c.value == "1") {
        jQuery('#requestFormFlujoCaja').toggle('show');
        jQuery('#memberFormFlujoCaja').hide();
    }
};