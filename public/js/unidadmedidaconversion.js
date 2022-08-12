$(function(){

    //Unidades de Conversion
    $("#displayFormlistaunidadmedidaconversion").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormlistaunidadmedidaconversion').toggle('show');
            jQuery('#requestFormlistaunidadmedidaconversion').hide();
        }
        else {
            jQuery('#requestFormlistaunidadmedidaconversion').toggle('show');
            jQuery('#memberFormlistaunidadmedidaconversion').hide();
        }
    })

    //Unidades de Conversion
    $("#adicionallistaunidadmedidaconversion").on('click', function(){
        $("#tablalistaunidadmedidaconversion tbody tr:eq(0)").clone().removeClass('fila-fija-listaunidadmedidaconversion').appendTo("#tablalistaunidadmedidaconversion");
    });

    $("#eliminarlistaunidadmedidaconversion").on('click', function(){
        $("#tablalistaunidadmedidaconversion tbody tr:eq(0)").remove();
    });

});