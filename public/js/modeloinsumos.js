$(function(){

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

//Modelos
function displayFormModelosInsumosModelos(c) {
    if (c.value == "2") {    
        jQuery('#memberFormModelosInsumosModelos').toggle('show');
        jQuery('#requestFormModelosInsumosModelos').hide();
    }
        if (c.value == "1") {
        jQuery('#requestFormModelosInsumosModelos').toggle('show');
        jQuery('#memberFormModelosInsumosModelos').hide();
    }
};

//Insumos
function displayFormModelosInsumosInsumos(c) {
    if (c.value == "2") {    
        jQuery('#memberFormModelosInsumosInsumos').toggle('show');
        jQuery('#requestFormModelosInsumosInsumos').hide();
    }
        if (c.value == "1") {
        jQuery('#requestFormModelosInsumosInsumos').toggle('show');
        jQuery('#memberFormModelosInsumosInsumos').hide();
    }
};