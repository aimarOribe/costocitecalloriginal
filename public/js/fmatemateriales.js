$(function(){

    //Materiales
    $("#adicionalfmmateriales").on('click', function(){
        $("#tablafmmateriales tbody tr:eq(0)").clone().removeClass('fila-fija-fmmateriales').appendTo("#tablafmmateriales");
    });

    $("#eliminarfmmateriales").on('click', function(){
        $("#tablafmmateriales tbody tr:eq(0)").remove();
    });

});

//Materiales
function displayFormfmmateriales(c) {
    if (c.value == "2") {    
        jQuery('#memberFormfmmateriales').toggle('show');
        jQuery('#requestFormfmmateriales').hide();
    }
        if (c.value == "1") {
        jQuery('#requestFormfmmateriales').toggle('show');
        jQuery('#memberFormfmmateriales').hide();
    }
};