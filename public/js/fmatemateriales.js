$(function(){

    //Materiales
    $("#displayFormfmmateriales").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormfmmateriales').toggle('show');
            jQuery('#requestFormfmmateriales').hide();
        }
        else {
            jQuery('#requestFormfmmateriales').toggle('show');
            jQuery('#memberFormfmmateriales').hide();
        }
    })

    //Materiales
    $("#adicionalfmmateriales").on('click', function(){
        $("#tablafmmateriales tbody tr:eq(0)").clone().removeClass('fila-fija-fmmateriales').appendTo("#tablafmmateriales");
    });

    $("#eliminarfmmateriales").on('click', function(){
        $("#tablafmmateriales tbody tr:eq(0)").remove();
    });

});

