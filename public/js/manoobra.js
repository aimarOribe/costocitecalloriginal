$(function(){
    $("#adicionalManoObra").on('click', function(){
        $("#tablaManoObra tbody tr:eq(0)").clone().removeClass('fila-fija-manoObra').appendTo("#tablaManoObra");
    });

    $("#eliminarManoObra").on('click', function(){
        $("#tablaManoObra tbody tr:eq(0)").remove();
    });

});

$(function(){
    $('#familiaSeleccionado').on('change', onSelectFamilyChange);
});

function onSelectFamilyChange(){
    
}

function displayFormManoObra(c) {
    if (c.value == "2") {    
        jQuery('#memberFormManoObra').toggle('show');
        jQuery('#requestFormManoObra').hide();
    }
        if (c.value == "1") {
        jQuery('#requestFormManoObra').toggle('show');
        jQuery('#memberFormManoObra').hide();
    }
};