$(function(){

    //Ver o Registrar Gif
    $("#displayFormgifempleadosconsinbeneficios").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormempleadosconsinbeneficios').toggle('show');
            jQuery('#requestFormempleadosconsinbeneficios').hide();
        }
        else {
            jQuery('#requestFormempleadosconsinbeneficios').toggle('show');
            jQuery('#memberFormempleadosconsinbeneficios').hide();
        }
    })

    $("#displayFormgifempleadosconsinbeneficiosmodal").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormempleadosconsinbeneficiosmodal').toggle('show');
            jQuery('#requestFormempleadosconsinbeneficiosmodal').hide();
        }
        else {
            jQuery('#requestFormempleadosconsinbeneficiosmodal').toggle('show');
            jQuery('#memberFormempleadosconsinbeneficiosmodal').hide();
        }
    })

    $("#displayFormgifempleadosconbeneficios").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormempleadosconbeneficios').toggle('show');
            jQuery('#requestFormempleadosconbeneficios').hide();
        }
        else {
            jQuery('#requestFormempleadosconbeneficios').toggle('show');
            jQuery('#memberFormempleadosconbeneficios').hide();
        }
    })

    $("#displayFormgifempleadosconbeneficiosmodal").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormempleadosconbeneficiosmodal').toggle('show');
            jQuery('#requestFormempleadosconbeneficiosmodal').hide();
        }
        else {
            jQuery('#requestFormempleadosconbeneficiosmodal').toggle('show');
            jQuery('#memberFormempleadosconbeneficiosmodal').hide();
        }
    })

    $("#displayFormhmsidfmodelajeseriado").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormhmsidfmodelajeseriado').toggle('show');
            jQuery('#requestFormhmsidfmodelajeseriado').hide();
        }
        else {
            jQuery('#requestFormhmsidfmodelajeseriado').toggle('show');
            jQuery('#memberFormhmsidfmodelajeseriado').hide();
        }
    })

    $("#displayFormhmsidfcorte").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormhmsidfcorte').toggle('show');
            jQuery('#requestFormhmsidfcorte').hide();
        }
        else {
            jQuery('#requestFormhmsidfcorte').toggle('show');
            jQuery('#memberFormhmsidfcorte').hide();
        }
    })

    $("#displayFormhmsidfaparado").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormhmsidfaparado').toggle('show');
            jQuery('#requestFormhmsidfaparado').hide();
        }
        else {
            jQuery('#requestFormhmsidfaparado').toggle('show');
            jQuery('#memberFormhmsidfaparado').hide();
        }
    })

    $("#displayFormhmsidfarmado").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormhmsidfarmado').toggle('show');
            jQuery('#requestFormhmsidfarmado').hide();
        }
        else {
            jQuery('#requestFormhmsidfarmado').toggle('show');
            jQuery('#memberFormhmsidfarmado').hide();
        }
    })

    $("#displayFormhmsidfalistado").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormhmsidfalistado').toggle('show');
            jQuery('#requestFormhmsidfalistado').hide();
        }
        else {
            jQuery('#requestFormhmsidfalistado').toggle('show');
            jQuery('#memberFormhmsidfalistado').hide();
        }
    })

    $("#displayFormhmsidflimpieza").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormhmsidflimpieza').toggle('show');
            jQuery('#requestFormhmsidflimpieza').hide();
        }
        else {
            jQuery('#requestFormhmsidflimpieza').toggle('show');
            jQuery('#memberFormhmsidflimpieza').hide();
        }
    })

    $("#displayFormhmsidfeppersonal").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormhmsidfeppersonal').toggle('show');
            jQuery('#requestFormhmsidfeppersonal').hide();
        }
        else {
            jQuery('#requestFormhmsidfeppersonal').toggle('show');
            jQuery('#memberFormhmsidfeppersonal').hide();
        }
    })

    $("#displayFormrmcorte").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormrmcorte').toggle('show');
            jQuery('#requestFormrmcorte').hide();
        }
        else {
            jQuery('#requestFormrmcorte').toggle('show');
            jQuery('#memberFormrmcorte').hide();
        }
    })

    $("#displayFormrmaparado").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormrmaparado').toggle('show');
            jQuery('#requestFormrmaparado').hide();
        }
        else {
            jQuery('#requestFormrmaparado').toggle('show');
            jQuery('#memberFormrmaparado').hide();
        }
    })

    $("#displayFormrmarmado").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormrmarmado').toggle('show');
            jQuery('#requestFormrmarmado').hide();
        }
        else {
            jQuery('#requestFormrmarmado').toggle('show');
            jQuery('#memberFormrmarmado').hide();
        }
    })

    //Obtener el token de la pagina para poder realizar ajax.
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

    var sumaTodoshmsirf = 0;
    var sumaTodosrm = 0;

    //Refrescar datos para la tabla Mano de Obra sin Beneficios
    var padre = $(".cuerpopadregif tr").length;
    var valorSinBeneficio = 0;
    var totalCostoManoObraIndirectaSinBeneficios = 0;
    var rounded = 0;
    var total = 0;
    for (let index = 1; index <= padre; index++) {
        var sueldo = $(".sueldo-"+index+"").val();
        var ntrabajadores = $(".ntrabajadores-"+index+"").val();
        var regimenlaboral = $(".regimenlaboral-"+index+"").val();
        valorSinBeneficio = sueldo*(1+regimenlaboral/100)*ntrabajadores;
        rounded = Math.round((valorSinBeneficio + Number.EPSILON) * 100) / 100;
        $(".totalgastomensual-"+index+"").val(rounded);

        $(".sueldo-"+index+", .ntrabajadores-"+index+", .regimenlaboral-"+index+"").on('change',function(){
            var sueldo = $(".sueldo-"+index+"").val();
            var ntrabajadores = $(".ntrabajadores-"+index+"").val();
            var regimenlaboral = $(".regimenlaboral-"+index+"").val();
            valorSinBeneficio = sueldo*(1+regimenlaboral/100)*ntrabajadores;
            rounded = Math.round((valorSinBeneficio + Number.EPSILON) * 100) / 100;
            $(".totalgastomensual-"+index+"").val(rounded);
        })

        total = parseFloat($(".totalgastomensual-"+index+"").val());
        totalCostoManoObraIndirectaSinBeneficios = totalCostoManoObraIndirectaSinBeneficios + total
        $(".costomanoobrasinbeneficios").val(Math.round((totalCostoManoObraIndirectaSinBeneficios + Number.EPSILON) * 100) / 100);
    }

    //Refrescar datos para la tabla Mano de Obra con Beneficios
    var padreConBeneficios = $(".cuerpopadregifconbeneficios tr").length;
    var totalCostoManoObraIndirectaConBeneficios = 0;
    var valorConBeneficio = 0;
    var roundedConBeneficio = 0;
    var totalConBeneficios = 0;
    for (let index = 1; index <= padreConBeneficios; index++) {
        var sueldo = $(".sueldoconbeneficios-"+index+"").val();
        var ntrabajadores = $(".ntrabajadoresconbeneficios-"+index+"").val();
        var regimenlaboral = $(".regimenlaboralconbeneficios-"+index+"").val();
        valorConBeneficio = sueldo*(1+regimenlaboral/100)*ntrabajadores;
        roundedConBeneficio = Math.round((valorConBeneficio + Number.EPSILON) * 100) / 100;
        $(".totalgastomensualconBeneficio-"+index+"").val(roundedConBeneficio);

        $(".sueldoconbeneficios-"+index+", .ntrabajadoresconbeneficios-"+index+", .regimenlaboralconbeneficios-"+index+"").on('change',function(){
            var sueldo = $(".sueldoconbeneficios-"+index+"").val();
            var ntrabajadores = $(".ntrabajadoresconbeneficios-"+index+"").val();
            var regimenlaboral = $(".regimenlaboralconbeneficios-"+index+"").val();
            valorConBeneficio = sueldo*(1+regimenlaboral/100)*ntrabajadores;
            roundedConBeneficio = Math.round((valorConBeneficio + Number.EPSILON) * 100) / 100;
            $(".totalgastomensualconBeneficio-"+index+"").val(roundedConBeneficio);
        })

        totalConBeneficios = parseFloat($(".totalgastomensualconBeneficio-"+index+"").val());
        totalCostoManoObraIndirectaConBeneficios = totalCostoManoObraIndirectaConBeneficios + totalConBeneficios
        $(".costomanoobraconbeneficios").val( Math.round((totalCostoManoObraIndirectaConBeneficios + Number.EPSILON) * 100) / 100);
    }

    //Refrescar datos para la tabla HERRAMIENTAS, MATERIALES O SUMINISTROS INDIRECTOS DE FABRICACIÓN - MENSUAL -> MODELAJE Y SERIADO
    var padrehmsidfmodelajeseriado = $(".cuerpopadregifmodelajeseriado tr").length;
    var totalCostohmsidfmodelajeseriado = 0;
    var valorhmsidfmodelajeseriado = 0;
    var roundedhmsidfmodelajeseriado = 0;
    var totalhmsidfmodelajeseriado = 0;
    for (let index = 1; index <= padrehmsidfmodelajeseriado; index++) {
        var valorunitario = $(".modelajeseriadovalorunitario-"+index+"").val();
        var consumo = $(".modelajeseriadoconsumo-"+index+"").val();
        var cantidadmeses = $(".modelajeseriadocantidadmeses-"+index+"").val();
        if(cantidadmeses > 0){
            valorhmsidfmodelajeseriado = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
        }else{
            valorhmsidfmodelajeseriado = 0
        }
        roundedhmsidfmodelajeseriado = Math.round((valorhmsidfmodelajeseriado + Number.EPSILON) * 100) / 100;
        $(".totalgastomensualmodelajeseriado-"+index+"").val(roundedhmsidfmodelajeseriado);

        $(".modelajeseriadovalorunitario-"+index+", .modelajeseriadoconsumo-"+index+", .modelajeseriadocantidadmeses-"+index+"").on('change',function(){
            var valorunitario = $(".modelajeseriadovalorunitario-"+index+"").val();
            var consumo = $(".modelajeseriadoconsumo-"+index+"").val();
            var cantidadmeses = $(".modelajeseriadocantidadmeses-"+index+"").val();
            if(cantidadmeses > 0){
                valorhmsidfmodelajeseriado = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
            }else{
                valorhmsidfmodelajeseriado = 0
            }
            roundedhmsidfmodelajeseriado = Math.round((valorhmsidfmodelajeseriado + Number.EPSILON) * 100) / 100;
            $(".totalgastomensualmodelajeseriado-"+index+"").val(roundedhmsidfmodelajeseriado);
        })

        totalhmsidfmodelajeseriado = parseFloat($(".totalgastomensualmodelajeseriado-"+index+"").val());
        totalCostohmsidfmodelajeseriado = totalCostohmsidfmodelajeseriado + totalhmsidfmodelajeseriado
    }

    //Refrescar datos para la tabla HERRAMIENTAS, MATERIALES O SUMINISTROS INDIRECTOS DE FABRICACIÓN - MENSUAL -> CORTE
    var padrehmsidfcorte = $(".cuerpopadregifhmsidfcorte tr").length;
    var totalCostohmsidfcorte = 0;
    var valorhmsidfcorte = 0;
    var roundedhmsidfcorte = 0;
    var totalhmsidfcorte = 0;
    for (let index = 1; index <= padrehmsidfcorte; index++) {
        var valorunitario = $(".hmsidfcortevalorunitario-"+index+"").val();
        var consumo = $(".hmsidfcorteconsumo-"+index+"").val();
        var cantidadmeses = $(".hmsidfcortecantidadmeses-"+index+"").val();
        if(cantidadmeses > 0){
            valorhmsidfcorte = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
        }else{
            valorhmsidfcorte = 0
        }
        roundedhmsidfcorte = Math.round((valorhmsidfcorte + Number.EPSILON) * 100) / 100;
        $(".totalgastomensualhmsidfcorte-"+index+"").val(roundedhmsidfcorte);

        $(".hmsidfcortevalorunitario-"+index+", .hmsidfcorteconsumo-"+index+", .hmsidfcortecantidadmeses-"+index+"").on('change',function(){
            var valorunitario = $(".hmsidfcortevalorunitario-"+index+"").val();
            var consumo = $(".hmsidfcorteconsumo-"+index+"").val();
            var cantidadmeses = $(".hmsidfcortecantidadmeses-"+index+"").val();
            if(cantidadmeses > 0){
                valorhmsidfcorte = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
            }else{
                valorhmsidfcorte = 0
            }
            roundedhmsidfcorte = Math.round((valorhmsidfcorte + Number.EPSILON) * 100) / 100;
            $(".totalgastomensualhmsidfcorte-"+index+"").val(roundedhmsidfcorte);
        })

        totalhmsidfcorte = parseFloat($(".totalgastomensualhmsidfcorte-"+index+"").val());
        totalCostohmsidfcorte = totalCostohmsidfcorte + totalhmsidfcorte
    }

    //Refrescar datos para la tabla HERRAMIENTAS, MATERIALES O SUMINISTROS INDIRECTOS DE FABRICACIÓN - MENSUAL -> APARADO
    var padrehmsidfaparado = $(".cuerpopadregifhmsidfaparado tr").length;
    var totalCostohmsidfaparado = 0;
    var valorhmsidfaparado = 0;
    var roundedhmsidfaparado = 0;
    var totalhmsidfaparado = 0;
    for (let index = 1; index <= padrehmsidfaparado; index++) {
        var valorunitario = $(".hmsidfaparadovalorunitario-"+index+"").val();
        var consumo = $(".hmsidfaparadoconsumo-"+index+"").val();
        var cantidadmeses = $(".hmsidfaparadocantidadmeses-"+index+"").val();
        if(cantidadmeses > 0){
            valorhmsidfaparado = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
        }else{
            valorhmsidfaparado = 0
        }
        roundedhmsidfaparado = Math.round((valorhmsidfaparado + Number.EPSILON) * 100) / 100;
        $(".totalgastomensualhmsidfaparado-"+index+"").val(roundedhmsidfaparado);

        $(".hmsidfaparadovalorunitario-"+index+", .hmsidfaparadoconsumo-"+index+", .hmsidfaparadocantidadmeses-"+index+"").on('change',function(){
            var valorunitario = $(".hmsidfaparadovalorunitario-"+index+"").val();
            var consumo = $(".hmsidfaparadoconsumo-"+index+"").val();
            var cantidadmeses = $(".hmsidfaparadocantidadmeses-"+index+"").val();
            if(cantidadmeses > 0){
                valorhmsidfaparado = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
            }else{
                valorhmsidfaparado = 0
            }
            roundedhmsidfaparado = Math.round((valorhmsidfaparado + Number.EPSILON) * 100) / 100;
            $(".totalgastomensualhmsidfaparado-"+index+"").val(roundedhmsidfaparado);
        })

        totalhmsidfaparado = parseFloat($(".totalgastomensualhmsidfaparado-"+index+"").val());
        totalCostohmsidfaparado = totalCostohmsidfaparado + totalhmsidfaparado
    }

    //Refrescar datos para la tabla HERRAMIENTAS, MATERIALES O SUMINISTROS INDIRECTOS DE FABRICACIÓN - MENSUAL -> ARMADO
    var padrehmsidfarmado = $(".cuerpopadregifhmsidfarmado tr").length;
    var totalCostohmsidfarmado = 0;
    var valorhmsidfarmado = 0;
    var roundedhmsidfarmado = 0;
    var totalhmsidfarmado = 0;
    for (let index = 1; index <= padrehmsidfarmado; index++) {
        var valorunitario = $(".hmsidfarmadovalorunitario-"+index+"").val();
        var consumo = $(".hmsidfarmadoconsumo-"+index+"").val();
        var cantidadmeses = $(".hmsidfarmadocantidadmeses-"+index+"").val();
        if(cantidadmeses > 0){
            valorhmsidfarmado = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
        }else{
            valorhmsidfarmado = 0
        }
        roundedhmsidfarmado = Math.round((valorhmsidfarmado + Number.EPSILON) * 100) / 100;
        $(".totalgastomensualhmsidfarmado-"+index+"").val(roundedhmsidfarmado);

        $(".hmsidfarmadovalorunitario-"+index+", .hmsidfarmadoconsumo-"+index+", .hmsidfarmadocantidadmeses-"+index+"").on('change',function(){
            var valorunitario = $(".hmsidfarmadovalorunitario-"+index+"").val();
            var consumo = $(".hmsidfarmadoconsumo-"+index+"").val();
            var cantidadmeses = $(".hmsidfarmadocantidadmeses-"+index+"").val();
            if(cantidadmeses > 0){
                valorhmsidfarmado = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
            }else{
                valorhmsidfarmado = 0
            }
            roundedhmsidfarmado = Math.round((valorhmsidfarmado + Number.EPSILON) * 100) / 100;
            $(".totalgastomensualhmsidfarmado-"+index+"").val(roundedhmsidfarmado);
        })

        totalhmsidfarmado = parseFloat($(".totalgastomensualhmsidfarmado-"+index+"").val());
        totalCostohmsidfarmado = totalCostohmsidfarmado + totalhmsidfarmado
    }

    //Refrescar datos para la tabla HERRAMIENTAS, MATERIALES O SUMINISTROS INDIRECTOS DE FABRICACIÓN - MENSUAL -> ALISTADO
    var padrehmsidfalistado = $(".cuerpopadregifhmsidfalistado tr").length;
    var totalCostohmsidfalistado = 0;
    var valorhmsidfalistado = 0;
    var roundedhmsidfalistado = 0;
    var totalhmsidfalistado = 0;
    for (let index = 1; index <= padrehmsidfalistado; index++) {
        var valorunitario = $(".hmsidfalistadovalorunitario-"+index+"").val();
        var consumo = $(".hmsidfalistadoconsumo-"+index+"").val();
        var cantidadmeses = $(".hmsidfalistadocantidadmeses-"+index+"").val();
        if(cantidadmeses > 0){
            valorhmsidfalistado = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
        }else{
            valorhmsidfalistado = 0
        }
        roundedhmsidfalistado = Math.round((valorhmsidfalistado + Number.EPSILON) * 100) / 100;
        $(".totalgastomensualhmsidfalistado-"+index+"").val(roundedhmsidfalistado);

        $(".hmsidfalistadovalorunitario-"+index+", .hmsidfalistadoconsumo-"+index+", .hmsidfalistadocantidadmeses-"+index+"").on('change',function(){
            var valorunitario = $(".hmsidfalistadovalorunitario-"+index+"").val();
            var consumo = $(".hmsidfalistadoconsumo-"+index+"").val();
            var cantidadmeses = $(".hmsidfalistadocantidadmeses-"+index+"").val();
            if(cantidadmeses > 0){
                valorhmsidfalistado = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
            }else{
                valorhmsidfalistado = 0
            }
            roundedhmsidfalistado = Math.round((valorhmsidfalistado + Number.EPSILON) * 100) / 100;
            $(".totalgastomensualhmsidfalistado-"+index+"").val(roundedhmsidfalistado);
        })

        totalhmsidfalistado = parseFloat($(".totalgastomensualhmsidfalistado-"+index+"").val());
        totalCostohmsidfalistado = totalCostohmsidfalistado + totalhmsidfalistado
    }

    //Refrescar datos para la tabla HERRAMIENTAS, MATERIALES O SUMINISTROS INDIRECTOS DE FABRICACIÓN - MENSUAL -> LIMPIEZA
    var padrehmsidflimpieza = $(".cuerpopadregifhmsidflimpieza tr").length;
    var totalCostohmsidflimpieza = 0;
    var valorhmsidflimpieza = 0;
    var roundedhmsidflimpieza = 0;
    var totalhmsidflimpieza = 0;
    for (let index = 1; index <= padrehmsidflimpieza; index++) {
        var valorunitario = $(".hmsidflimpiezavalorunitario-"+index+"").val();
        var consumo = $(".hmsidflimpiezaconsumo-"+index+"").val();
        var cantidadmeses = $(".hmsidflimpiezacantidadmeses-"+index+"").val();
        if(cantidadmeses > 0){
            valorhmsidflimpieza = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
        }else{
            valorhmsidflimpieza = 0
        }
        roundedhmsidflimpieza = Math.round((valorhmsidflimpieza + Number.EPSILON) * 100) / 100;
        $(".totalgastomensualhmsidflimpieza-"+index+"").val(roundedhmsidflimpieza);

        $(".hmsidflimpiezavalorunitario-"+index+", .hmsidflimpiezaconsumo-"+index+", .hmsidflimpiezacantidadmeses-"+index+"").on('change',function(){
            var valorunitario = $(".hmsidflimpiezavalorunitario-"+index+"").val();
            var consumo = $(".hmsidflimpiezaconsumo-"+index+"").val();
            var cantidadmeses = $(".hmsidflimpiezacantidadmeses-"+index+"").val();
            if(cantidadmeses > 0){
                valorhmsidflimpieza = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
            }else{
                valorhmsidflimpieza = 0
            }
            roundedhmsidflimpieza = Math.round((valorhmsidflimpieza + Number.EPSILON) * 100) / 100;
            $(".totalgastomensualhmsidflimpieza-"+index+"").val(roundedhmsidflimpieza);
        })

        totalhmsidflimpieza = parseFloat($(".totalgastomensualhmsidflimpieza-"+index+"").val());
        totalCostohmsidflimpieza = totalCostohmsidflimpieza + totalhmsidflimpieza
    }

    //Refrescar datos para la tabla HERRAMIENTAS, MATERIALES O SUMINISTROS INDIRECTOS DE FABRICACIÓN - MENSUAL -> EQUIPOS DE PROTECCION PERSONAL
    var padrehmsidfeppersonal = $(".cuerpopadregifhmsidfeppersonal tr").length;
    var totalCostohmsidfeppersonal = 0;
    var valorhmsidfeppersonal = 0;
    var roundedhmsidfeppersonal = 0;
    var totalhmsidfeppersonal = 0;
    for (let index = 1; index <= padrehmsidfeppersonal; index++) {
        var valorunitario = $(".hmsidfeppersonalvalorunitario-"+index+"").val();
        var consumo = $(".hmsidfeppersonalconsumo-"+index+"").val();
        var cantidadmeses = $(".hmsidfeppersonalcantidadmeses-"+index+"").val();
        if(cantidadmeses > 0){
            valorhmsidfeppersonal = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
        }else{
            valorhmsidfeppersonal = 0
        }
        roundedhmsidfeppersonal = Math.round((valorhmsidfeppersonal + Number.EPSILON) * 100) / 100;
        $(".totalgastomensualhmsidfeppersonal-"+index+"").val(roundedhmsidfeppersonal);

        $(".hmsidfeppersonalvalorunitario-"+index+", .hmsidfeppersonalconsumo-"+index+", .hmsidfeppersonalcantidadmeses-"+index+"").on('change',function(){
            var valorunitario = $(".hmsidfeppersonalvalorunitario-"+index+"").val();
            var consumo = $(".hmsidfeppersonalconsumo-"+index+"").val();
            var cantidadmeses = $(".hmsidfeppersonalcantidadmeses-"+index+"").val();
            if(cantidadmeses > 0){
                valorhmsidfeppersonal = (parseFloat(consumo)/parseFloat(cantidadmeses))*parseFloat(valorunitario)
            }else{
                valorhmsidfeppersonal = 0
            }
            roundedhmsidfeppersonal = Math.round((valorhmsidfeppersonal + Number.EPSILON) * 100) / 100;
            $(".totalgastomensualhmsidfeppersonal-"+index+"").val(roundedhmsidfeppersonal);
        })

        totalhmsidfeppersonal = parseFloat($(".totalgastomensualhmsidfeppersonal-"+index+"").val());
        totalCostohmsidfeppersonal = totalCostohmsidfeppersonal + totalhmsidfeppersonal
    }

    //Acumular el total en la parte de GIF hmsief
    sumaTodoshmsirf = totalCostohmsidfmodelajeseriado + totalCostohmsidfcorte + totalCostohmsidfaparado + totalCostohmsidfarmado + totalCostohmsidfalistado + totalCostohmsidflimpieza + totalCostohmsidfeppersonal;
    $(".costohmsidf").val( Math.round((sumaTodoshmsirf + Number.EPSILON) * 100) / 100);

    //Refrescar datos para la tabla REPUESTOS Y MANTENIMIENTO -> Corte
    var padrermcorte = $(".cuerpopadregifrmcorte tr").length;
    var totalCostormcorte = 0;
    var valorrmcorte = 0;
    var roundedrmcorte = 0;
    var totalrmcorte = 0;
    for (let index = 1; index <= padrermcorte; index++) {
        var cantidad = $(".rmcortecantidad-"+index+"").val();
        var gastomantenimiento = $(".rmcortegastomanetenimiento-"+index+"").val();
        var frecuenciaanual = $(".rmcortefrecuenciaanual-"+index+"").val();

        valorrmcorte = (parseFloat(gastomantenimiento)*parseFloat(frecuenciaanual)*parseFloat(cantidad))/12;
        roundedrmcorte = Math.round((valorrmcorte + Number.EPSILON) * 100) / 100;

        $(".totalgastomensualrmcorte-"+index+"").val(roundedrmcorte);

        $(".rmcortecantidad-"+index+", .rmcortegastomanetenimiento-"+index+", .rmcortefrecuenciaanual-"+index+"").on('change',function(){
            var cantidad = $(".rmcortecantidad-"+index+"").val();
            var gastomantenimiento = $(".rmcortegastomanetenimiento-"+index+"").val();
            var frecuenciaanual = $(".rmcortefrecuenciaanual-"+index+"").val();

            valorrmcorte = (parseFloat(gastomantenimiento)*parseFloat(frecuenciaanual)*parseFloat(cantidad))/12;
            roundedrmcorte = Math.round((valorrmcorte + Number.EPSILON) * 100) / 100;

            $(".totalgastomensualrmcorte-"+index+"").val(roundedrmcorte);
        })

        totalrmcorte = parseFloat($(".totalgastomensualrmcorte-"+index+"").val());
        totalCostormcorte = totalCostormcorte + totalrmcorte
    }

    //Refrescar datos para la tabla REPUESTOS Y MANTENIMIENTO -> Aparado
    var padrermaparado = $(".cuerpopadregifrmaparado tr").length;
    var totalCostormaparado = 0;
    var valorrmaparado = 0;
    var roundedrmaparado = 0;
    var totalrmaparado = 0;
    for (let index = 1; index <= padrermaparado; index++) {
        var cantidad = $(".rmaparadocantidad-"+index+"").val();
        var gastomantenimiento = $(".rmaparadogastomanetenimiento-"+index+"").val();
        var frecuenciaanual = $(".rmaparadofrecuenciaanual-"+index+"").val();

        valorrmaparado = (parseFloat(gastomantenimiento)*parseFloat(frecuenciaanual)*parseFloat(cantidad))/12;
        roundedrmaparado = Math.round((valorrmaparado + Number.EPSILON) * 100) / 100;

        $(".totalgastomensualrmaparado-"+index+"").val(roundedrmaparado);

        $(".rmaparadocantidad-"+index+", .rmaparadogastomanetenimiento-"+index+", .rmaparadofrecuenciaanual-"+index+"").on('change',function(){
            var cantidad = $(".rmaparadocantidad-"+index+"").val();
            var gastomantenimiento = $(".rmaparadogastomanetenimiento-"+index+"").val();
            var frecuenciaanual = $(".rmaparadofrecuenciaanual-"+index+"").val();

            valorrmaparado = (parseFloat(gastomantenimiento)*parseFloat(frecuenciaanual)*parseFloat(cantidad))/12;
            roundedrmaparado = Math.round((valorrmaparado + Number.EPSILON) * 100) / 100;

            $(".totalgastomensualrmaparado-"+index+"").val(roundedrmaparado);
        })

        totalrmaparado = parseFloat($(".totalgastomensualrmaparado-"+index+"").val());
        totalCostormaparado = totalCostormaparado + totalrmaparado
    }

    //Refrescar datos para la tabla REPUESTOS Y MANTENIMIENTO -> Armado
    var padrermarmado = $(".cuerpopadregifrmarmado tr").length;
    var totalCostormarmado = 0;
    var valorrmarmado = 0;
    var roundedrmarmado = 0;
    var totalrmarmado = 0;
    for (let index = 1; index <= padrermarmado; index++) {
        var cantidad = $(".rmarmadocantidad-"+index+"").val();
        var gastomantenimiento = $(".rmarmadogastomanetenimiento-"+index+"").val();
        var frecuenciaanual = $(".rmarmadofrecuenciaanual-"+index+"").val();

        valorrmarmado = (parseFloat(gastomantenimiento)*parseFloat(frecuenciaanual)*parseFloat(cantidad))/12;
        roundedrmarmado = Math.round((valorrmarmado + Number.EPSILON) * 100) / 100;

        $(".totalgastomensualrmarmado-"+index+"").val(roundedrmarmado);

        $(".rmarmadocantidad-"+index+", .rmarmadogastomanetenimiento-"+index+", .rmarmadofrecuenciaanual-"+index+"").on('change',function(){
            var cantidad = $(".rmarmadocantidad-"+index+"").val();
            var gastomantenimiento = $(".rmarmadogastomanetenimiento-"+index+"").val();
            var frecuenciaanual = $(".rmarmadofrecuenciaanual-"+index+"").val();

            valorrmarmado = (parseFloat(gastomantenimiento)*parseFloat(frecuenciaanual)*parseFloat(cantidad))/12;
            roundedrmarmado = Math.round((valorrmarmado + Number.EPSILON) * 100) / 100;

            $(".totalgastomensualrmarmado-"+index+"").val(roundedrmarmado);
        })

        totalrmarmado = parseFloat($(".totalgastomensualrmarmado-"+index+"").val());
        totalCostormarmado = totalCostormarmado + totalrmarmado
    }

    //Acumular el total en la parte de GIF rm
    sumaTodosrm = totalCostormcorte + totalCostormaparado + totalCostormarmado;
    $(".costorm").val( Math.round((sumaTodosrm + Number.EPSILON) * 100) / 100);

    //Refrescar el total de la pagina GIF
    var totalGif  = totalCostoManoObraIndirectaSinBeneficios + totalCostoManoObraIndirectaConBeneficios + sumaTodoshmsirf + sumaTodosrm;
    $(".costototalgif").val(Math.round((totalGif + Number.EPSILON) * 100) / 100);

    //Obtener el valor de la pagina GIF e introducir a la base de datos
    $(document).ready(function () {
        fetch('obtenervalorgif',{
            method : 'POST',
            body: JSON.stringify({texto : $(".costototalgif").val()}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            return data.success;
        }).catch(error =>console.error(error));
    });
});