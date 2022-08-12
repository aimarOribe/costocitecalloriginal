$(function(){

    $("#displayFormListaUnidadMedida").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormListaUnidadDeMedidas').toggle('show');
            jQuery('#requestFormListaUnidadDeMedidas').hide();
        }
        else {
            jQuery('#requestFormListaUnidadDeMedidas').toggle('show');
            jQuery('#memberFormListaUnidadDeMedidas').hide();
        }
    })

    $("#displayFormListaProcesos").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormListaProcesos').toggle('show');
            jQuery('#requestFormListaProcesos').hide();
        }
        else {
            jQuery('#requestFormListaProcesos').toggle('show');
            jQuery('#memberFormListaProcesos').hide();
        }
    })

    $("#displayFormListaClasificacion").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormistaClasificacions').toggle('show');
            jQuery('#requestFormListaClasificacions').hide();
        }
        else {
            jQuery('#requestFormListaClasificacions').toggle('show');
            jQuery('#memberFormistaClasificacions').hide();
        }
    })

    $("#displayFormListaUnidadConsumo").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormListaUnidadConsumo').toggle('show');
            jQuery('#requestFormListaUnidadConsumo').hide();
        }
        else {
            jQuery('#requestFormListaUnidadConsumo').toggle('show');
            jQuery('#memberFormListaUnidadConsumo').hide();
        }
    })

    $("#displayFormListaFamiliasMateriales").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormListaFamiliasMateriales').toggle('show');
            jQuery('#requestFormListaFamiliasMateriales').hide();
        }
        else {
            jQuery('#requestFormListaFamiliasMateriales').toggle('show');
            jQuery('#memberFormListaFamiliasMateriales').hide();
        }
    })

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

