$(function(){
    //Unidades de Medida
    $("#adicionalListaUnidadMedida").on('click', function(){
        $("#tablaListaUnidadMedida tbody tr:eq(0)").clone().removeClass('fila-fija-listaUnidadDeMedidas').appendTo("#tablaListaUnidadMedida");
    });

    $("#eliminarListaUnidadMedida").on('click', function(){
        $("#tablaListaUnidadMedida tbody tr:eq(0)").remove();
    });

    //Procesos
    $("#adicionalListaProcesos").on('click', function(){
        $("#tablaListaProcesos tbody tr:eq(0)").clone().removeClass('fila-fija-listaProcesos').appendTo("#tablaListaProcesos");
    });

    $("#eliminarListaProcesos").on('click', function(){
        $("#tablaListaProcesos tbody tr:eq(0)").remove();
    });

    //Clasificacions
    $("#adicionalListaClasificacions").on('click', function(){
        $("#tablaListaClasificacions tbody tr:eq(0)").clone().removeClass('fila-fija-listaClasificacions').appendTo("#tablaListaClasificacions");
    });

    $("#eliminarListaClasificacions").on('click', function(){
        $("#tablaListaClasificacions tbody tr:eq(0)").remove();
    });

    //Unidad de Consumo
    $("#adicionalListaUnidadConsumos").on('click', function(){
        $("#tablaListaUnidadConsumos tbody tr:eq(0)").clone().removeClass('fila-fija-listaUnidadConsumos').appendTo("#tablaListaUnidadConsumos");
    });

    $("#eliminarListaUnidadConsumos").on('click', function(){
        $("#tablaListaUnidadConsumos tbody tr:eq(0)").remove();
    });

    //Familias de Materiales
    $("#adicionalListaFamiliasMateriales").on('click', function(){
        $("#tablaListaFamiliasMateriales tbody tr:eq(0)").clone().removeClass('fila-fija-listaFamiliasMateriales').appendTo("#tablaListaFamiliasMateriales");
    });

    $("#eliminarListaFamiliasMateriales").on('click', function(){
        $("#tablaListaFamiliasMateriales tbody tr:eq(0)").remove();
    });
});

function displayFormListaUnidadMedida(c) {
    if (c.value == "2") {    
        jQuery('#memberFormListaUnidadDeMedidas').toggle('show');
        jQuery('#requestFormListaUnidadDeMedidas').hide();
    }
        if (c.value == "1") {
        jQuery('#requestFormListaUnidadDeMedidas').toggle('show');
        jQuery('#memberFormListaUnidadDeMedidas').hide();
    }
};

function displayFormListaProcesos(c) {
    if (c.value == "2") {    
        jQuery('#memberFormListaProcesos').toggle('show');
        jQuery('#requestFormListaProcesos').hide();
    }
        if (c.value == "1") {
        jQuery('#requestFormListaProcesos').toggle('show');
        jQuery('#memberFormListaProcesos').hide();
    }
};

function displayFormListaClasificacion(c) {
    if (c.value == "2") {    
        jQuery('#memberFormistaClasificacions').toggle('show');
        jQuery('#requestFormListaClasificacions').hide();
    }
        if (c.value == "1") {
        jQuery('#requestFormListaClasificacions').toggle('show');
        jQuery('#memberFormistaClasificacions').hide();
    }
};

function displayFormListaUnidadConsumo(c) {
    if (c.value == "2") {    
        jQuery('#memberFormListaUnidadConsumo').toggle('show');
        jQuery('#requestFormListaUnidadConsumo').hide();
    }
        if (c.value == "1") {
        jQuery('#requestFormListaUnidadConsumo').toggle('show');
        jQuery('#memberFormListaUnidadConsumo').hide();
    }
};

function displayFormListaFamiliasMateriales(c) {
    if (c.value == "2") {    
        jQuery('#memberFormListaFamiliasMateriales').toggle('show');
        jQuery('#requestFormListaFamiliasMateriales').hide();
    }
        if (c.value == "1") {
        jQuery('#requestFormListaFamiliasMateriales').toggle('show');
        jQuery('#memberFormListaFamiliasMateriales').hide();
    }
};

