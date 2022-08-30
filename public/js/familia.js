$(function(){

    $(document).ready(function () {
        obtenerFamilias();
        obtenerDetalleDocumento();
    });

    function obtenerDetalleDocumento(){
        $(".semanal").on('change', function(){
            var semanal = $(".semanal").val();
            var nuevoValor = ((semanal / 7) * 30);
            $(".mensual").val(Math.round(nuevoValor));
            
        });
    
        var padre = $(".cuerpopadrefamilia tr").length;
        console.log(padre);
        for (let index = 1; index <= padre; index++) {
            $(".semanal-"+index+"").on('change', function(){
                var semanal = $(".semanal-"+index+"").val();
                var nuevoValor = ((semanal / 7) * 30);
                $(".mensual-"+index+"").val(Math.round(nuevoValor));
            })  
        }
    }

    $("#displayForm").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberForm').toggle('show');
            jQuery('#requestForm').hide();
        }
        else {
            jQuery('#requestForm').toggle('show');
            jQuery('#memberForm').hide();
        }
    })

    //vaciar campos
    function vaciarCampos(){
        $("#clavenombrefamiliaregistrar").val("");
        $("#clavecapprosemdocenasfamiliaregistrar").val("");
        $("#clavecapprodmensualfamiliaregistrar").val("");
    }

    //ver familias
    function obtenerFamilias(){
        var contenido = document.querySelector("#cuerpopadrefamilia")
        var familias = [];
        var i = 0;
        fetch('obtenerFamilias')
        .then(response =>{
            return response.json()
        }).then( data =>{
            familias = data.familias
            contenido.innerHTML = "";
            for (let valor of familias) {
                i++;
                contenido.innerHTML += `
                <tr>
                    <input hidden name="ids[]" value="${valor.id}" id="claveidsfamilias-${i}">
                    <td><input type="text" class="form-control tamano-texto-cuerpo-lista" name="nombres[${valor.id}]" value="${valor.nombre}" id="clavenombrefamiliaactualizar-${i}"></td>
                    <td><input type="number" class="semanal-${i} form-control familianumeroslista tamano-texto-cuerpo-lista" name="capprosemdocenass[${valor.id}]" value="${valor.capprosemdocenas}" id="clavesemanalfamiliaactualizar-${i}"></td>
                    <td><input type="number" class="mensual-${i} form-control familianumeroslista tamano-texto-cuerpo-lista" name="capprodmensuals[${valor.id}]" value="${valor.capprodmensual}" id="clavemensualfamiliaactualizar-${i}"></td>
                </tr>
                ` 
            }
            obtenerDetalleDocumento()
            return data.familias;
        }).catch(error =>console.error(error));
    }

    //registrar una familia
    $("#clavebotonguardarfamilia").click(function () { 
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var nombre = $("#clavenombrefamiliaregistrar").val();
        var semanal = $("#clavecapprosemdocenasfamiliaregistrar").val();
        var mensual = $("#clavecapprodmensualfamiliaregistrar").val();
        fetch('familias',{
            method : 'POST',
            body: JSON.stringify({nombre : nombre, capprosemdocenas: semanal, capprodmensual: mensual}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            console.log(data.success)
            if(data.success == true){
                vaciarCampos();
                obtenerFamilias();
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

    //editar y eliminar familias
    $("#clavebotoneditareliminarfamilia").click(function (e) {
        e.preventDefault();
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var ids= [];
        var nombres = [];
        var semanales = [];
        var mensuales = [];

        var padre = $(".cuerpopadrefamilia tr").length;
        for (let index = 1; index <= padre; index++) {
            ids.push($("#claveidsfamilias-"+index+"").val());
            nombres[$("#claveidsfamilias-"+index+"").val()] = $("#clavenombrefamiliaactualizar-"+index+"").val()
            semanales[$("#claveidsfamilias-"+index+"").val()] = $("#clavesemanalfamiliaactualizar-"+index+"").val()
            mensuales[$("#claveidsfamilias-"+index+"").val()] = $("#clavemensualfamiliaactualizar-"+index+"").val()
        }

        fetch('familias/actualizar',{
            method : 'POST',
            body: JSON.stringify({id: ids, nombre: nombres, capprosemdocenas: semanales, capprodmensual: mensuales}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                obtenerFamilias();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true
                })
            }else if(data.success == false) {
                obtenerFamilias();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true
                })
            }
            return data.success;
        }).catch(error => {
            obtenerFamilias();
        });
    });

}());