$(function(){
    //Obtener el token de la pagina para poder realizar ajax.
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;

    $(document).ready(function () {
        const fecha = Date.now();
        const hoy = new Date(fecha);
        $("#fechaHoy").text(hoy.toLocaleDateString());

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
    });
});

$(function(){

    //Refrescar datos para la tabla DEP
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
});

function displayFormdep(c) {
    if (c.value == "2") {    
        jQuery('#memberFormdep').toggle('show');
        jQuery('#requestFormdep').hide();
    }
        if (c.value == "1") {
        jQuery('#requestFormdep').toggle('show');
        jQuery('#memberFormdep').hide();
    }
};