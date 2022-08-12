$(function(){

    $("#displayFormgggasueldosadministrativosmodal").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormgggasueldosadministrativosmodal').toggle('show');
            jQuery('#requestFormgggasueldosadministrativosmodal').hide();
        }
        else {
            jQuery('#requestFormgggasueldosadministrativosmodal').toggle('show');
            jQuery('#memberFormgggasueldosadministrativosmodal').hide();
        }
    })

    $("#displayFormggvsueldosadministrativosmodal").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormggvsueldosadministrativosmodal').toggle('show');
            jQuery('#requestFormggvsueldosadministrativosmodal').hide();
        }
        else {
            jQuery('#requestFormggvsueldosadministrativosmodal').toggle('show');
            jQuery('#memberFormggvsueldosadministrativosmodal').hide();
        }
    })

    $("#displayFormgggasueldosadministrativos").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormgggasueldosadministrativos').toggle('show');
            jQuery('#requestFormgggasueldosadministrativos').hide();
        }
        else {
            jQuery('#requestFormgggasueldosadministrativos').toggle('show');
            jQuery('#memberFormgggasueldosadministrativos').hide();
        }
    })

    $("#displayFormgggautilesescritorio").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormgggautilesescritorio').toggle('show');
            jQuery('#requestFormgggautilesescritorio').hide();
        }
        else {
            jQuery('#requestFormgggautilesescritorio').toggle('show');
            jQuery('#memberFormgggautilesescritorio').hide();
        }
    })

    $("#displayFormgggaeventosanuales").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormgggaeventosanuales').toggle('show');
            jQuery('#requestFormgggaeventosanuales').hide();
        }
        else {
            jQuery('#requestFormgggaeventosanuales').toggle('show');
            jQuery('#memberFormgggaeventosanuales').hide();
        }
    })

    $("#displayFormggvsueldosadministrativos").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormggvsueldosadministrativos').toggle('show');
            jQuery('#requestFormggvsueldosadministrativos').hide();
        }
        else {
            jQuery('#requestFormggvsueldosadministrativos').toggle('show');
            jQuery('#memberFormggvsueldosadministrativos').hide();
        }
    })

    $("#displayFormggvalmuerzoejecutivo").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormggvalmuerzoejecutivo').toggle('show');
            jQuery('#requestFormggvalmuerzoejecutivo').hide();
        }
        else {
            jQuery('#requestFormggvalmuerzoejecutivo').toggle('show');
            jQuery('#memberFormggvalmuerzoejecutivo').hide();
        }
    })

    $("#displayFormggvotrogastoventa").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormggvotrogastoventa').toggle('show');
            jQuery('#requestFormggvotrogastoventa').hide();
        }
        else {
            jQuery('#requestFormggvotrogastoventa').toggle('show');
            jQuery('#memberFormggvotrogastoventa').hide();
        }
    })

    $("#displayFormggtpasajecombustible").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormggtpasajecombustible').toggle('show');
            jQuery('#requestFormggtpasajecombustible').hide();
        }
        else {
            jQuery('#requestFormggtpasajecombustible').toggle('show');
            jQuery('#memberFormggtpasajecombustible').hide();
        }
    })

    $("#displayFormggtmantenimientoauto").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormggtmantenimientoauto').toggle('show');
            jQuery('#requestFormggtmantenimientoauto').hide();
        }
        else {
            jQuery('#requestFormggtmantenimientoauto').toggle('show');
            jQuery('#memberFormggtmantenimientoauto').hide();
        }
    })

    $("#displayFormggserviciobasico").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormggserviciobasico').toggle('show');
            jQuery('#requestFormggserviciobasico').hide();
        }
        else {
            jQuery('#requestFormggserviciobasico').toggle('show');
            jQuery('#memberFormggserviciobasico').hide();
        }
    })

    //Obtener el token de la pagina para poder realizar ajax.
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

    var sumaTodosggga = 0;
    var sumaTodosv = 0;
    var sumaTodost = 0;
    var sumaTodosserviciosbasicos = 0;
    var totalGg = 0;

    //Refrescar datos para la tabla Sueldos Administrativos
    var padregggasueldosadministrativos = $(".cuerpopadregggasueldosadministrativos tr").length;
    var valorgggasueldosadministrativos = 0;
    var totalCostogggasueldosadministrativos = 0;
    var roundedgggasueldosadministrativos = 0;
    var totalgggasueldosadministrativos = 0;
    for (let index = 1; index <= padregggasueldosadministrativos; index++) {
        var sueldoconplanilla = $(".gggasueldomensualplanilla-"+index+"").val();
        var sueldosinplanilla = $(".gggasueldosinplanilla-"+index+"").val();
        var regimenlaboral = $(".gggaregimenlaboral-"+index+"").val();
        valorgggasueldosadministrativos = parseFloat(sueldoconplanilla)*(1+ parseFloat(regimenlaboral)/100)+parseFloat(sueldosinplanilla);
        roundedgggasueldosadministrativos = Math.round((valorgggasueldosadministrativos + Number.EPSILON) * 100) / 100;
        $(".gggatotalgastomensual-"+index+"").val(roundedgggasueldosadministrativos);

        $(".gggasueldomensualplanilla-"+index+", .gggasueldosinplanilla-"+index+", .gggaregimenlaboral-"+index+"").on('change',function(){
            var sueldoconplanilla = $(".gggasueldomensualplanilla-"+index+"").val();
            var sueldosinplanilla = $(".gggasueldosinplanilla-"+index+"").val();
            var regimenlaboral = $(".gggaregimenlaboral-"+index+"").val();
            valorgggasueldosadministrativos = parseFloat(sueldoconplanilla)*(1+ parseFloat(regimenlaboral)/100)+parseFloat(sueldosinplanilla);
            roundedgggasueldosadministrativos = Math.round((valorgggasueldosadministrativos + Number.EPSILON) * 100) / 100;
            $(".gggatotalgastomensual-"+index+"").val(roundedgggasueldosadministrativos);
        })

        totalgggasueldosadministrativos = parseFloat($(".gggatotalgastomensual-"+index+"").val());
        totalCostogggasueldosadministrativos = totalCostogggasueldosadministrativos + totalgggasueldosadministrativos
    }

    //Refrescar datos para la tabla Utiles de Escritorio
    var padregggautilesescritorio = $(".cuerpopadregggautilesescritorio tr").length;
    var valorgggautilesescritorio = 0;
    var totalCostogggautilesescritorio = 0;
    var roundedgggautilesescritorio = 0;
    var totalgggautilesescritorio = 0;
    for (let index = 1; index <= padregggautilesescritorio; index++) {
        var gasto = $(".gggausgasto-"+index+"").val();
        var cantidad = $(".gggauscantidad-"+index+"").val();
        var periodoanual = $(".gggausperiodoanual-"+index+"").val();
        valorgggautilesescritorio = (parseFloat(gasto)*parseFloat(cantidad)*parseFloat(periodoanual))/12;
        roundedgggautilesescritorio = Math.round((valorgggautilesescritorio + Number.EPSILON) * 100) / 100;
        $(".gggaustotalgastomensual-"+index+"").val(roundedgggautilesescritorio);

        $(".gggausgasto-"+index+", .gggauscantidad-"+index+", .gggausperiodoanual-"+index+"").on('change',function(){
            var gasto = $(".gggausgasto-"+index+"").val();
            var cantidad = $(".gggauscantidad-"+index+"").val();
            var periodoanual = $(".gggausperiodoanual-"+index+"").val();
            valorgggautilesescritorio = (parseFloat(gasto)*parseFloat(cantidad)*parseFloat(periodoanual))/12;
            roundedgggautilesescritorio = Math.round((valorgggautilesescritorio + Number.EPSILON) * 100) / 100;
            $(".gggaustotalgastomensual-"+index+"").val(roundedgggautilesescritorio);
        })

        totalgggautilesescritorio = parseFloat($(".gggaustotalgastomensual-"+index+"").val());
        totalCostogggautilesescritorio = totalCostogggautilesescritorio + totalgggautilesescritorio
    }

    //Refrescar datos para la tabla Eventos Anuales para el Personal
    var padregggaeventosanuales = $(".cuerpopadregggaeventosanuales tr").length;
    var valorgggaeventosanuales = 0;
    var totalCostogggaeventosanuales = 0;
    var roundedgggaeventosanuales = 0;
    var totalgggaeventosanuales = 0;
    for (let index = 1; index <= padregggaeventosanuales; index++) {
        var gasto = $(".gggaeapgasto-"+index+"").val();
        var periodoanual = $(".gggaeapperiodoanual-"+index+"").val();
        valorgggaeventosanuales = (parseFloat(gasto)*parseFloat(periodoanual))/12;
        roundedgggaeventosanuales = Math.round((valorgggaeventosanuales + Number.EPSILON) * 100) / 100;
        $(".gggaeaptotalgastomensual-"+index+"").val(roundedgggaeventosanuales);

        $(".gggaeapgasto-"+index+", .gggaeapperiodoanual-"+index+"").on('change',function(){
            var gasto = $(".gggaeapgasto-"+index+"").val();
            var periodoanual = $(".gggaeapperiodoanual-"+index+"").val();
            valorgggaeventosanuales = (parseFloat(gasto)*parseFloat(periodoanual))/12;
            roundedgggaeventosanuales = Math.round((valorgggaeventosanuales + Number.EPSILON) * 100) / 100;
            $(".gggaeaptotalgastomensual-"+index+"").val(roundedgggaeventosanuales);
        })

        totalgggaeventosanuales = parseFloat($(".gggaeaptotalgastomensual-"+index+"").val());
        totalCostogggaeventosanuales = totalCostogggaeventosanuales + totalgggaeventosanuales
    }

    sumaTodosggga = totalCostogggasueldosadministrativos + totalCostogggautilesescritorio + totalCostogggaeventosanuales;

    //Refrescar datos para la tabla Sueldos Administrativos de Ventas
    var padreggvsueldoadministrativo = $(".cuerpopadreggvsueldosadministrativos tr").length;
    var valorggvsueldoadministrativo = 0;
    var totalCostoggvsueldoadministrativo = 0;
    var roundedggvsueldoadministrativo = 0;
    var totalggvsueldoadministrativo = 0;
    for (let index = 1; index <= padreggvsueldoadministrativo; index++) {
        var sueldoconplanilla = $(".ggvsasueldomensualplanilla-"+index+"").val();
        var honorariosmensuales = $(".ggvsahonoratiosmensuales-"+index+"").val();
        var regimenlaboral = $(".ggvsaregimenlaboral-"+index+"").val();
        valorggvsueldoadministrativo = parseFloat(sueldoconplanilla)*(1+parseFloat(regimenlaboral)/100)+parseFloat(honorariosmensuales);
        roundedggvsueldoadministrativo = Math.round((valorggvsueldoadministrativo + Number.EPSILON) * 100) / 100;
        $(".ggvsatotalgastomensual-"+index+"").val(roundedggvsueldoadministrativo);

        $(".ggvsasueldomensualplanilla-"+index+", .ggvsahonoratiosmensuales-"+index+", .ggvsaregimenlaboral-"+index+"").on('change',function(){
            var sueldoconplanilla = $(".ggvsasueldomensualplanilla-"+index+"").val();
            var honorariosmensuales = $(".ggvsahonoratiosmensuales-"+index+"").val();
            var regimenlaboral = $(".ggvsaregimenlaboral-"+index+"").val();
            valorggvsueldoadministrativo = parseFloat(sueldoconplanilla)*(1+parseFloat(regimenlaboral)/100)+parseFloat(honorariosmensuales);
            roundedggvsueldoadministrativo = Math.round((valorggvsueldoadministrativo + Number.EPSILON) * 100) / 100;
            $(".ggvsatotalgastomensual-"+index+"").val(roundedggvsueldoadministrativo);
        })

        totalggvsueldoadministrativo = parseFloat($(".ggvsatotalgastomensual-"+index+"").val());
        totalCostoggvsueldoadministrativo = totalCostoggvsueldoadministrativo + totalggvsueldoadministrativo
    }

    //Refrescar datos para la tabla Almuerzos Ejecutivos de Ventas
    var padreggvalmuerzoejecutivo = $(".cuerpopadreggvalmuerzoejecutivo tr").length;
    var valorggvalmuerzoejecutivo = 0;
    var totalCostoggvalmuerzoejecutivo = 0;
    var roundedggvalmuerzoejecutivo = 0;
    var totalggvalmuerzoejecutivo = 0;
    for (let index = 1; index <= padreggvalmuerzoejecutivo; index++) {
        var gasto = $(".ggvaegasto-"+index+"").val();
        var periodoanual = $(".ggvaeperiodoanual-"+index+"").val();
        valorggvalmuerzoejecutivo = (parseFloat(gasto)*parseFloat(periodoanual))/12;
        roundedggvalmuerzoejecutivo = Math.round((valorggvalmuerzoejecutivo + Number.EPSILON) * 100) / 100;
        $(".ggvaetotalgastomensual-"+index+"").val(roundedggvalmuerzoejecutivo);

        $(".ggvaegasto-"+index+", .ggvaeperiodoanual-"+index+"").on('change',function(){
            var gasto = $(".ggvaegasto-"+index+"").val();
            var periodoanual = $(".ggvaeperiodoanual-"+index+"").val();
            valorggvalmuerzoejecutivo = (parseFloat(gasto)*parseFloat(periodoanual))/12;
            roundedggvalmuerzoejecutivo = Math.round((valorggvalmuerzoejecutivo + Number.EPSILON) * 100) / 100;
            $(".ggvaetotalgastomensual-"+index+"").val(roundedggvalmuerzoejecutivo);
        })

        totalggvalmuerzoejecutivo = parseFloat($(".ggvaetotalgastomensual-"+index+"").val());
        totalCostoggvalmuerzoejecutivo = totalCostoggvalmuerzoejecutivo + totalggvalmuerzoejecutivo
    }

    //Refrescar datos para la tabla Otro Gastos Ventas de Ventas
    var padreggvotrogastoventa = $(".cuerpopadreggvotrogastoventa tr").length;
    var valorggvotrogastoventa = 0;
    var totalCostoggvotrogastoventa = 0;
    var roundedggvotrogastoventa = 0;
    var totalggvotrogastoventa = 0;
    for (let index = 1; index <= padreggvotrogastoventa; index++) {
        var gasto = $(".ggvogvgasto-"+index+"").val();
        var periodoanual = $(".ggvogvperiodoanual-"+index+"").val();
        valorggvotrogastoventa = (parseFloat(gasto)*parseFloat(periodoanual))/12;
        roundedggvotrogastoventa = Math.round((valorggvotrogastoventa + Number.EPSILON) * 100) / 100;
        $(".ggvogvtotalgastomensual-"+index+"").val(roundedggvotrogastoventa);

        $(".ggvogvgasto-"+index+", .ggvogvperiodoanual-"+index+"").on('change',function(){
            var gasto = $(".ggvogvgasto-"+index+"").val();
            var periodoanual = $(".ggvogvperiodoanual-"+index+"").val();
            valorggvotrogastoventa = (parseFloat(gasto)*parseFloat(periodoanual))/12;
            roundedggvotrogastoventa = Math.round((valorggvotrogastoventa + Number.EPSILON) * 100) / 100;
            $(".ggvogvtotalgastomensual-"+index+"").val(roundedggvotrogastoventa);
        })

        totalggvotrogastoventa = parseFloat($(".ggvogvtotalgastomensual-"+index+"").val());
        totalCostoggvotrogastoventa = totalCostoggvotrogastoventa + totalggvotrogastoventa
    }

    sumaTodosv = totalCostoggvsueldoadministrativo + totalCostoggvalmuerzoejecutivo + totalCostoggvotrogastoventa;

    //Refrescar datos para la tabla Pasajes y Combustible de Transporte
    var padreggtpasajecombustible = $(".cuerpopadreggtpasajecombustible tr").length;
    var valorggtpasajecombustible = 0;
    var totalCostoggtpasajecombustible = 0;
    var roundedggtpasajecombustible = 0;
    var totalggtpasajecombustible = 0;
    for (let index = 1; index <= padreggtpasajecombustible; index++) {
        var gasto = $(".ggtpcgasto-"+index+"").val();
        var periodoanual = $(".ggtpcperiodoanual-"+index+"").val();
        valorggtpasajecombustible = (parseFloat(gasto)*parseFloat(periodoanual))/12;
        roundedggtpasajecombustible = Math.round((valorggtpasajecombustible + Number.EPSILON) * 100) / 100;
        $(".ggtpctotalgastomensual-"+index+"").val(roundedggtpasajecombustible);

        $(".ggtpcgasto-"+index+", .ggtpcperiodoanual-"+index+"").on('change',function(){
            var gasto = $(".ggtpcgasto-"+index+"").val();
            var periodoanual = $(".ggtpcperiodoanual-"+index+"").val();
            valorggtpasajecombustible = (parseFloat(gasto)*parseFloat(periodoanual))/12;
            roundedggtpasajecombustible = Math.round((valorggtpasajecombustible + Number.EPSILON) * 100) / 100;
            $(".ggtpctotalgastomensual-"+index+"").val(roundedggtpasajecombustible);
        })

        totalggtpasajecombustible = parseFloat($(".ggtpctotalgastomensual-"+index+"").val());
        totalCostoggtpasajecombustible = totalCostoggtpasajecombustible + totalggtpasajecombustible
    }

    //Refrescar datos para la tabla Mantenimiento de Autos de Transporte
    var padreggtmantenimientoauto = $(".cuerpopadreggtmantenimientoauto tr").length;
    var valorggtmantenimientoauto = 0;
    var totalCostoggtmantenimientoauto = 0;
    var roundedggtmantenimientoauto = 0;
    var totalggtmantenimientoauto = 0;
    for (let index = 1; index <= padreggtmantenimientoauto; index++) {
        var gasto = $(".ggtmagasto-"+index+"").val();
        var periodoanual = $(".ggtmaperiodoanual-"+index+"").val();
        var porcentajeuso = $(".ggtmaporcentajeuso-"+index+"").val();
        valorggtmantenimientoauto = (parseFloat(gasto)*(parseFloat(periodoanual)/12))*(parseFloat(porcentajeuso)/100);
        roundedggtmantenimientoauto = Math.round((valorggtmantenimientoauto + Number.EPSILON) * 100) / 100;
        $(".ggtmatotalgastomensual-"+index+"").val(roundedggtmantenimientoauto);

        $(".ggtmagasto-"+index+", .ggtmaperiodoanual-"+index+", .ggtmaporcentajeuso-"+index+"").on('change',function(){
            var gasto = $(".ggtmagasto-"+index+"").val();
            var periodoanual = $(".ggtmaperiodoanual-"+index+"").val();
            var porcentajeuso = $(".ggtmaporcentajeuso-"+index+"").val();
            valorggtmantenimientoauto = (parseFloat(gasto)*(parseFloat(periodoanual)/12))*(parseFloat(porcentajeuso)/100);
            roundedggtmantenimientoauto = Math.round((valorggtmantenimientoauto + Number.EPSILON) * 100) / 100;
            $(".ggtmatotalgastomensual-"+index+"").val(roundedggtmantenimientoauto);
        })

        totalggtmantenimientoauto = parseFloat($(".ggtmatotalgastomensual-"+index+"").val());
        totalCostoggtmantenimientoauto = totalCostoggtmantenimientoauto + totalggtmantenimientoauto
    }

    sumaTodost = totalCostoggtpasajecombustible + totalCostoggtmantenimientoauto;

    //Refrescar datos para la tabla Servicios Basicos
    var padreggserviciobasico = $(".cuerpopadreggserviciobasico tr").length;
    var valorggserviciobasico = 0;
    var totalCostoggserviciobasico = 0;
    var roundedggserviciobasico = 0;
    var totalggserviciobasico = 0;
    for (let index = 1; index <= padreggserviciobasico; index++) {
        var costoservicio = $(".ggsbcostoservicio-"+index+"").val();
        var porcentajeuso = $(".ggsbporcentajeuso-"+index+"").val();
        valorggserviciobasico = parseFloat(costoservicio)*(parseFloat(porcentajeuso)/100);
        roundedggserviciobasico = Math.round((valorggserviciobasico + Number.EPSILON) * 100) / 100;
        $(".ggsbtotalgastomensual-"+index+"").val(roundedggserviciobasico);

        $(".ggsbcostoservicio-"+index+", .ggsbporcentajeuso-"+index+"").on('change',function(){
            var costoservicio = $(".ggsbcostoservicio-"+index+"").val();
            var porcentajeuso = $(".ggsbporcentajeuso-"+index+"").val();
            valorggserviciobasico = parseFloat(costoservicio)*(parseFloat(porcentajeuso)/100);
            roundedggserviciobasico = Math.round((valorggserviciobasico + Number.EPSILON) * 100) / 100;
            $(".ggsbtotalgastomensual-"+index+"").val(roundedggserviciobasico);
        })

        totalggserviciobasico = parseFloat($(".ggsbtotalgastomensual-"+index+"").val());
        totalCostoggserviciobasico = totalCostoggserviciobasico + totalggserviciobasico
    }

    sumaTodosserviciosbasicos = totalCostoggserviciobasico;

    //Refrescar Input de GGGA
    $(".costoggga").val(Math.round((sumaTodosggga + Number.EPSILON) * 100) / 100);

    //Refrescar Input de GGV
    $(".costoggv").val(Math.round((sumaTodosv + Number.EPSILON) * 100) / 100);

    //Refrescar Input de GGT
    $(".costoggt").val(Math.round((sumaTodost + Number.EPSILON) * 100) / 100);

    //Refrescar Input de GGServicios Basicos
    $(".costoggserviciosbasicos").val(Math.round((sumaTodosserviciosbasicos + Number.EPSILON) * 100) / 100);

    //Refrescar el total de la pagina GG
    totalGg  = sumaTodosggga + sumaTodosv + sumaTodost + sumaTodosserviciosbasicos;
    $(".costototalgg").val(Math.round((totalGg + Number.EPSILON) * 100) / 100);

    //Obtener el valor de la pagina GIF e introducir a la base de datos
    $(document).ready(function () {
        fetch('obtenervalorgg',{
            method : 'POST',
            body: JSON.stringify({texto : $(".costototalgg").val()}),
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