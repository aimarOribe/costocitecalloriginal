$(function(){

    //Modelos
    $("#displayFormModelosInsumosModelos").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormModelosInsumosModelos').toggle('show');
            jQuery('#requestFormModelosInsumosModelos').hide();
        }
        else {
            jQuery('#requestFormModelosInsumosModelos').toggle('show');
            jQuery('#memberFormModelosInsumosModelos').hide();
        }
    })

    //Insumos
    $("#displayFormModelosInsumosInsumos").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormModelosInsumosInsumos').toggle('show');
            jQuery('#requestFormModelosInsumosInsumos').hide();
        }
        else {
            jQuery('#requestFormModelosInsumosInsumos').toggle('show');
            jQuery('#memberFormModelosInsumosInsumos').hide();
        }
    })

    //Modelos
    $("#adicionalmodeloseinsumosmodelos").on('click', function(){
        $("#tablamodeloseinsumosmodelos tbody tr:eq(0)").clone().removeClass('fila-fija-modeloseinsumosmodelos').appendTo("#tablamodeloseinsumosmodelos");
    });

    $("#eliminarmodeloseinsumosmodelos").on('click', function(){
        $("#tablamodeloseinsumosmodelos tbody tr:eq(0)").remove();
    });

    //Insumos
    $("#adicionalmodeloseinsumosinsumos").on('click', function(){
        $("#tablamodeloseinsumosinsumos tbody tr:eq(0)").clone().removeClass('fila-fija-modeloseinsumosinsumos').appendTo("#tablamodeloseinsumosinsumos");
    });

    $("#eliminarmodeloseinsumosinsumos").on('click', function(){
        $("#tablamodeloseinsumosinsumos tbody tr:eq(0)").remove();
    });

});



