$(function(){
    //Obtener el token de la pagina para poder realizar ajax.
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

    $(document).ready(function () {
        obtenerDEP();
        recargarModelosDepsActualizar();

        const fecha = Date.now();
        const hoy = new Date(fecha);
        $("#fechaHoy").text(hoy.toLocaleDateString());
    });

    function obtenerValorPaginaDepBBDD(){
        //Obtener el valor de la pagina DEP e introducir a la base de datos
        fetch('obtenervalordep',{
            method : 'POST',
            body: JSON.stringify({texto : $(".pedtotaldepreciacionmensual").val()}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            return data.success;
        }).catch(error =>console.error(error));
    }

    function vaciarCamposDep(){
        $("#clavedepactivoregistrar").val("");
        $("#clavedepafecharegistrar").val("");
        $("#clavedepcostodolarregistrar").val(0);
        $("#clavedepcambiodolarfechacompraregistrar").val(0);
        $("#clavedepcostosolesregistrar").val(0);
        $("#clavedepunidadesregistrar").val(0);
        $("#clavedepcostototalregistrar").val(0);
        $("#clavedepaniosadepreciarregistrar").val(0);
        $("#clavedepvalorresidualregistrar").val(0);
        $("#clavedepdepreciacionanualregistrar").val(0);
    }

    //Ver o Registrar en la tabla
    $("#displayFormdep").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormdep').toggle('show');
            jQuery('#requestFormdep').hide();
        }
        else {
            jQuery('#requestFormdep').toggle('show');
            jQuery('#memberFormdep').hide();
        }
    })

    //Refrescar datos para la tabla DEP
    function recargarModelosDepsActualizar(){
        var padreped = $(".cuerpopadredep tr").length;
        var totalped = 0;
        var costoTotalDep = 0;
        for (let index = 1; index <= padreped; index++) {
            $(".depfecha-"+index+", .depcostodolar-"+index+", .depccambiodolar-"+index+", .depcostosoles-"+index+", .depunidades-"+index+", .depaniosdepreciar-"+index+", .depvalorresidual-"+index+"").on('change', function(){
                var costoDolar = parseFloat($(".depcostodolar-"+index+"").val());
                var cambiodolar = parseFloat($(".depccambiodolar-"+index+"").val());
                var costoSoles = parseFloat($(".depcostosoles-"+index+"").val());
                var unidades = $(".depunidades-"+index+"").val();
                if(costoDolar == 0  && costoSoles == 0){
                    $(".depcostototal-"+index+"").val(Math.round((0 + Number.EPSILON) * 100) / 100);
                }else{
                    if(costoDolar > 0){
                        $(".depcostototal-"+index+"").val(Math.round(((costoDolar*cambiodolar*unidades) + Number.EPSILON) * 100) / 100);
                    }else{
                        $(".depcostototal-"+index+"").val(Math.round(((costoSoles*unidades) + Number.EPSILON) * 100) / 100);
                    }
                }

                var fechaAnterior = $(".depfecha-"+index+"").val();
                var aniosdepreciacion = parseFloat($(".depaniosdepreciar-"+index+"").val());
                var valorresidual = parseFloat($(".depvalorresidual-"+index+"").val());
                var fechaActual = new Date();
                const formatDate = (date)=>{
                    let formatted_date = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate()
                    return formatted_date;
                }
                var day1 = new Date(fechaAnterior); 
                var day2 = new Date(formatDate(fechaActual));
                var difference= Math.abs(day2-day1);
                days = difference/(1000 * 3600 * 24)
                var direnciaAños = days/366;

                if(fechaAnterior == ""){
                    $(".depdepreciacionanual-"+index+"").val(0);
                }else{
                    if(direnciaAños>=aniosdepreciacion){
                        $(".depdepreciacionanual-"+index+"").val(0);
                    }else{
                        if($(".depcostototal-"+index+"").val() == 0 || aniosdepreciacion == 0){
                            $(".depdepreciacionanual-"+index+"").val(0);
                        }else{
                            $(".depdepreciacionanual-"+index+"").val(Math.round((((parseFloat($(".depcostototal-"+index+"").val())-valorresidual)/aniosdepreciacion) + Number.EPSILON) * 100) / 100);
                            
                        }
                    }
                }
            });
            totalped = parseFloat($(".depdepreciacionanual-"+index+"").val());
            costoTotalDep = costoTotalDep + totalped; 
        }
        $(".pedtotaldepreciacionmensual").val(Math.round(((costoTotalDep/12) + Number.EPSILON) * 100) / 100);
    }
    
    //Refrescar valores de la tabla al momento de insertar un DEP
    $(".depfecha, .depcostodolar, .depccambiodolar, .depcostosoles, .depunidades, .depaniosdepreciar, .depvalorresidual").on('change', function(){
        var costoDolar = parseFloat($(".depcostodolar").val());
        var cambiodolar = parseFloat($(".depccambiodolar").val());
        var costoSoles = parseFloat($(".depcostosoles").val());
        var unidades = $(".depunidades").val();
        if(costoDolar == 0  && costoSoles == 0){
            $(".depcostototal").val(Math.round((0 + Number.EPSILON) * 100) / 100);
        }else{
            if(costoDolar > 0){
                $(".depcostototal").val(Math.round(((costoDolar*cambiodolar*unidades) + Number.EPSILON) * 100) / 100);
            }else{
                $(".depcostototal").val(Math.round(((costoSoles*unidades) + Number.EPSILON) * 100) / 100);
            }
        }

        var fechaAnterior = $(".depfecha").val();
        var aniosdepreciacion = parseFloat($(".depaniosdepreciar").val());
        var valorresidual = parseFloat($(".depvalorresidual").val());
        var fechaActual = new Date();
        const formatDate = (date)=>{
            let formatted_date = date.getFullYear() + "-" + (date.getMonth() + 1) + "-" + date.getDate()
            return formatted_date;
        }
        var day1 = new Date(fechaAnterior); 
        var day2 = new Date(formatDate(fechaActual));
        var difference= Math.abs(day2-day1);
        days = difference/(1000 * 3600 * 24)
        var direnciaAños = days/366;

        if(fechaAnterior == ""){
            $(".depdepreciacionanual").val(0);
        }else{
            if(direnciaAños>=aniosdepreciacion){
                $(".depdepreciacionanual").val(0);
            }else{
                if($(".depcostototal").val() == 0 || aniosdepreciacion == 0){
                    $(".depdepreciacionanual").val(0);
                }else{
                    $(".depdepreciacionanual").val(Math.round((((parseFloat($(".depcostototal").val())-valorresidual)/aniosdepreciacion) + Number.EPSILON) * 100) / 100);
                    
                }
            }
        }
    });

    //------------------------------------ DEP ----------------------------------------------
    //ver DEP
    function obtenerDEP(){
        var contenido = document.querySelector("#cuerpopadredep")
        var deps = [];
        var i = 0;
        fetch('obtenerDeps')
        .then(response =>{
            return response.json()
        }).then( data =>{
            deps = data.deps
            
            contenido.innerHTML = "";
            for (let dep of deps) {
                i++;
                contenido.innerHTML += 
                `
                <tr>
                    <input hidden name="id[]" value="${dep.id}" id="claveidsdepactualizar-${i}">
                    <td><input type="text" class="form-control tamano-texto-cuerpo-lista" name="activo[${dep.id}]" value="${dep.activo}" id="clavedepactivoactualizar-${i}"></td>
                    <td><input type="date" class="depfecha-${i} form-control tamano-texto-cuerpo-lista" name="fecha[${dep.id}]" value="${dep.fecha}" id="clavedepfechaactualizar-${i}"></td>
                    <td><input class="depcostodolar-${i} form-control tamano-texto-cuerpo-lista" name="costodolar[${dep.id}]" value="${dep.costodolar}" id="clavedepcostodolaractualizar-${i}"></td>
                    <td><input class="depccambiodolar-${i} form-control tamano-texto-cuerpo-lista" name="cambiodolarfechacompra[${dep.id}]" value="${dep.cambiodolarfechacompra}" id="clavedepcambiodolarfechacompraactualizar-${i}"></td>
                    <td><input class="depcostosoles-${i} form-control tamano-texto-cuerpo-lista" name="costosoles[${dep.id}]" value="${dep.costosoles}" id="clavedepcostosolesactualizar-${i}"></td>
                    <td><input type="number" class="depunidades-${i} form-control tamano-texto-cuerpo-lista" name="unidades[${dep.id}]" value="${dep.unidades}" id="clavedepunidadesactualizar-${i}"></td>
                    <td><input readonly class="depcostototal-${i} form-control tamano-texto-cuerpo-lista" name="costototal[${dep.id}]" value="${dep.costototal}" id="clavedepcostototalactualizar-${i}"></td>
                    <td><input type="number" class="depaniosdepreciar-${i} form-control tamano-texto-cuerpo-lista" name="aniosadepreciar[${dep.id}]" value="${dep.aniosadepreciar}" id="clavedepaniosadepreciaractualizar-${i}"></td>
                    <td><input class="depvalorresidual-${i} form-control tamano-texto-cuerpo-lista" name="valorresidual[${dep.id}]" value="${dep.valorresidual}" id="clavedepvalorresidualactualizar-${i}"></td>
                    <td><input readonly class="depdepreciacionanual-${i} form-control tamano-texto-cuerpo-lista" name="depreciacionanual[${dep.id}]" value="${dep.depreciacionanual}" id="clavedepdepreciacionanualactualizar-${i}"></td>
                </tr>
                ` 
            }
            recargarModelosDepsActualizar();
            obtenerValorPaginaDepBBDD();
            return [data.deps];
        }).catch(error =>console.error(error));
    }

    //registrar DEP
    $("#clavebotonaguardardep").click(function () { 
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var activo = $("#clavedepactivoregistrar").val();
        var fecha = $("#clavedepafecharegistrar").val();
        var costodolar = $("#clavedepcostodolarregistrar").val();
        var cambiodolar = $("#clavedepcambiodolarfechacompraregistrar").val();
        var costosoles = $("#clavedepcostosolesregistrar").val();
        var unidades = $("#clavedepunidadesregistrar").val();
        var costototal = $("#clavedepcostototalregistrar").val();
        var aniosadepreciar = $("#clavedepaniosadepreciarregistrar").val();
        var valorresidual = $("#clavedepvalorresidualregistrar").val();
        var depreciacionanual = $("#clavedepdepreciacionanualregistrar").val();

        fetch('dep',{
            method : 'POST',
            body: JSON.stringify({activo : activo, fecha: fecha, costodolar: costodolar, cambiodolarfechacompra: cambiodolar, costosoles: costosoles, unidades : unidades, costototal: costototal, aniosadepreciar: aniosadepreciar, valorresidual: valorresidual, depreciacionanual: depreciacionanual}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            console.log(data.success)
            if(data.success == true){
                vaciarCamposDep();
                obtenerDEP();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true
                })
            }else if(data.success == false) {
                Swal.fire({
                    title: data.mensaje,
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true
                })
            }
            return data.success;
        }).catch(error => console.error(error));
    });

    //editar y eliminar Dep
    $("#clavebotonactualizareliminardep").click(function (e) {
        e.preventDefault();
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var ids= [];
        var activos = [];
        var fechas = [];
        var costodolares = [];
        var cambiodolarfechacompras = [];
        var costosoles = [];
        var unidades = [];
        var costototales = [];
        var aniosadepreciars = [];
        var valorresiduales = [];
        var depreciacionanuales = [];

        var padre = $(".cuerpopadredep tr").length;
        for (let index = 1; index <= padre; index++) {
            ids.push($("#claveidsdepactualizar-"+index+"").val());
            activos[$("#claveidsdepactualizar-"+index+"").val()] = $("#clavedepactivoactualizar-"+index+"").val();
            fechas[$("#claveidsdepactualizar-"+index+"").val()] = $("#clavedepfechaactualizar-"+index+"").val()
            costodolares[$("#claveidsdepactualizar-"+index+"").val()] = $("#clavedepcostodolaractualizar-"+index+"").val();
            cambiodolarfechacompras[$("#claveidsdepactualizar-"+index+"").val()] = $("#clavedepcambiodolarfechacompraactualizar-"+index+"").val()
            costosoles[$("#claveidsdepactualizar-"+index+"").val()] = $("#clavedepcostosolesactualizar-"+index+"").val();
            unidades[$("#claveidsdepactualizar-"+index+"").val()] = $("#clavedepunidadesactualizar-"+index+"").val();
            costototales[$("#claveidsdepactualizar-"+index+"").val()] = $("#clavedepcostototalactualizar-"+index+"").val()
            aniosadepreciars[$("#claveidsdepactualizar-"+index+"").val()] = $("#clavedepaniosadepreciaractualizar-"+index+"").val();
            valorresiduales[$("#claveidsdepactualizar-"+index+"").val()] = $("#clavedepvalorresidualactualizar-"+index+"").val()
            depreciacionanuales[$("#claveidsdepactualizar-"+index+"").val()] = $("#clavedepdepreciacionanualactualizar-"+index+"").val();
        }

        fetch('dep/actualizar',{
            method : 'POST',
            body: JSON.stringify({id: ids, activo: activos, fecha: fechas, costodolar: costodolares, cambiodolarfechacompra: cambiodolarfechacompras, costosoles: costosoles, unidades: unidades, costototal: costototales, aniosadepreciar: aniosadepreciars, valorresidual: valorresiduales, depreciacionanual: depreciacionanuales}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                obtenerDEP();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true
                })
            }else if(data.success == false) {
                obtenerDEP();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true
                })
            }
            return data.success;
        }).catch(error => {
            obtenerDEP();
        });
    });
    //------------------------------------ Fin DEP ----------------------------------------------
});