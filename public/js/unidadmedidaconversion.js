$(function(){

    $(document).ready(function () {
        obtenerUnidadesConversion();
    });

    function vaciarCamposUnidadesConversion(){
        $("#claveunidadconversionmaterialregistrar").val("");
        $("#claveunidadconversionunidadmedidaactualizar").val("");
        $("#claveunidadconversionconversionregistrar").val("");
    }

    //Unidades de Conversion
    $("#displayFormlistaunidadmedidaconversion").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormlistaunidadmedidaconversion').toggle('show');
            jQuery('#requestFormlistaunidadmedidaconversion').hide();
        }
        else {
            jQuery('#requestFormlistaunidadmedidaconversion').toggle('show');
            jQuery('#memberFormlistaunidadmedidaconversion').hide();
        }
    })

    //------------------------------------ Unidades de Conversion ----------------------------------------------
    //ver Unidades de Conversion
    function obtenerUnidadesConversion(){
        var contenido = document.querySelector("#cuerpopadreunidadmedidaconversion")
        var unidadesmedidaconversion = [];
        var fmmateriales = [];
        var unidadmedidas = [];
        var i = 0;
        fetch('obtenerunidadesmedidaconversion')
        .then(response =>{
            return response.json()
        }).then( data =>{
            unidadesmedidaconversion = data.unidadesmedidaconversiones
            fmmateriales = data.fmmateriales
            unidadmedidas = data.unidadesmedidas
            
            contenido.innerHTML = "";
            for (let conversion of unidadesmedidaconversion) {
                i++;
                contenido.innerHTML += 
                `
                <tr>
                    <input hidden name="id[]" value="${conversion.id}" id="claveidsunidadesmedidaconversion-${i}">
                    <td>
                        <select class="form-control tamano-texto-cuerpo-lista" name="material_id[${conversion.id}]" id="claveunidadconversionmaterialactualizar-${i}">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            ${fmmateriales.map(material => `
                                <option class="tamano-texto-cuerpo-lista" value="${material.id}" ${(material.id === conversion.material_id) ? "selected='selected'": ""}>
                                    ${material.nombre}
                                </option>
                            `).join('')}
                        </select>
                    </td>
                    <td>
                        <select class="form-control tamano-texto-cuerpo-lista" name="unidadesmedidas_id[${conversion.id}]" id="claveunidadconversionunidadmedidaactualizar-${i}">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            ${unidadmedidas.map(unidadmedida => `
                                <option class="tamano-texto-cuerpo-lista" value="${unidadmedida.id}" ${(unidadmedida.id === conversion.listaunidadmedida_id) ? "selected='selected'": ""}>
                                    ${unidadmedida.nombre}
                                </option>
                            `).join('')}
                        </select>
                    </td>
                    <td><input class="form-control tamano-texto-cuerpo-lista" type="text" name="conversion[${conversion.id}]" value="${conversion.conversion}" id="claveunidadconversionconversionactualizar-${i}"></td>
                </tr>
                ` 
            }
            return [data.unidadesmedidaconversiones, data.fmmateriales, data.unidadesmedidas];
        }).catch(error =>console.error(error));
    }

    //registrar un unidades de conversion
    $("#clavebotonaguardarunidadesmedidaconversion").click(function () { 
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var material = $("#claveunidadconversionmaterialregistrar").val();
        var unidadamedida = $("#claveunidadconversionunidadmedidaactualizar").val();
        var conversion = $("#claveunidadconversionconversionregistrar").val();

        fetch('unidadesmedidaconversion',{
            method : 'POST',
            body: JSON.stringify({material_id : material, unidadesmedidas_id: unidadamedida, conversion: conversion}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            console.log(data.success)
            if(data.success == true){
                vaciarCamposUnidadesConversion();
                obtenerUnidadesConversion();
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

    //editar y eliminar Unidades de Conversion
    $("#clavebotonactualizareliminarunidadesmedidaconversion").click(function (e) {
        e.preventDefault();
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var ids= [];
        var materiales = [];
        var unidadesmedida = [];
        var conversiones = [];

        var padre = $(".cuerpopadreunidadmedidaconversion tr").length;
        for (let index = 1; index <= padre; index++) {
            ids.push($("#claveidsunidadesmedidaconversion-"+index+"").val());
            materiales[$("#claveidsunidadesmedidaconversion-"+index+"").val()] = $("select#claveunidadconversionmaterialactualizar-"+index+"").val();
            unidadesmedida[$("#claveidsunidadesmedidaconversion-"+index+"").val()] = $("select#claveunidadconversionunidadmedidaactualizar-"+index+"").val()
            conversiones[$("#claveidsunidadesmedidaconversion-"+index+"").val()] = $("#claveunidadconversionconversionactualizar-"+index+"").val();
        }

        fetch('unidadesmedidaconversion/actualizar',{
            method : 'POST',
            body: JSON.stringify({id: ids, material_id: materiales, unidadesmedidas_id: unidadesmedida, conversion: conversiones}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                obtenerUnidadesConversion();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true
                })
            }else if(data.success == false) {
                obtenerUnidadesConversion();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true
                })
            }
            return data.success;
        }).catch(error => {
            obtenerUnidadesConversion();
        });
    });
    //------------------------------------ Fin Insumos ----------------------------------------------

});