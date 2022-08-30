$(function(){

    $(document).ready(function () {
        obtenerListaUnidadesMedida();
        obtenerListaProcesos();
        obtenerListaClasificacion();
        obtenerListaUnidadConsumo();
        obtenerListaFamiliaMateriales();
    });

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

    //vaciar campos
    function vaciarCampos(){
        $("#claveunidadmedidalistaregistrar").val("");
        $("#claveprocesoslistaregistrar").val("");
        $("#claveclasificacionlistaregistrar").val("");
        $("#claveunidadconsumolistaregistrar").val("");
        $("#clavefamiliamaterialeslistaregistrar").val("");
    }

    //------------------------------------- LISTA UNIDAD DE MEDIDA -----------------------------------------
    //ver familias
    function obtenerListaUnidadesMedida(){
        var contenido = document.querySelector("#cuerpopadrelistaunidadmedida")
        var listaUnidadDeMedidas = [];
        var i = 0;
        fetch('listasUnidadMedida')
        .then(response =>{
            return response.json()
        }).then( data =>{
            listaUnidadDeMedidas = data.listaUnidadDeMedidas
            contenido.innerHTML = "";
            for (let unidadmedida of listaUnidadDeMedidas) {
                i++;
                contenido.innerHTML += `
                <tr>
                    <input hidden name="ids[]" value="${unidadmedida.id}" id="claveidslistaunidadmedida-${i}">
                    <td><input type="text" class="form-control unidadDeMedidatextolista tamano-texto-cuerpo-lista" name="nombres[${unidadmedida.id}]" value="${unidadmedida.nombre}" id="claveunidadmedidalistaractualizar-${i}"></td>
                </tr>
                ` 
            }
            return data.listaUnidadDeMedidas;
        }).catch(error =>console.error(error));
    }
    //registrar una unidad de medida
    $("#clavebotonguardarlistaunidadmedida").click(function () { 
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var nombre = $("#claveunidadmedidalistaregistrar").val();

        fetch('listaUnidadMedidas',{
            method : 'POST',
            body: JSON.stringify({nombre : nombre}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                vaciarCampos();
                obtenerListaUnidadesMedida();
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

    //editar y eliminar unidad de medidas
    $("#clavebotoneditareliminarlistaunidadmedida").click(function (e) {
        e.preventDefault();
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var ids= [];
        var nombres = [];

        var padre = $("#cuerpopadrelistaunidadmedida tr").length;
        console.log(padre);
        for (let index = 1; index <= padre; index++) {
            ids.push($("#claveidslistaunidadmedida-"+index+"").val());
            nombres[$("#claveidslistaunidadmedida-"+index+"").val()] = $("#claveunidadmedidalistaractualizar-"+index+"").val()
        }

        console.log(ids);
        console.log(nombres);

        fetch('listaUnidadMedidas/actualizar',{
            method : 'POST',
            body: JSON.stringify({id: ids, nombre: nombres}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                obtenerListaUnidadesMedida();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true
                })
            }else if(data.success == false) {
                obtenerListaUnidadesMedida();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true
                })
            }
            return data.success;
        }).catch(error => {
            obtenerListaUnidadesMedida();
        });
    });
    //-------------------------------------  FIN LISTA UNIDAD DE MEDIDA -----------------------------------------


    //------------------------------------- LISTA PROCESOS -----------------------------------------
    //ver procesos
    function obtenerListaProcesos(){
        var contenido = document.querySelector("#cuerpopadrelistaprocesos")
        var listaProcesos = [];
        var i = 0;
        fetch('listasProcesos')
        .then(response =>{
            return response.json()
        }).then( data =>{
            listaProcesos = data.listaProcesos
            contenido.innerHTML = "";
            for (let proceso of listaProcesos) {
                i++;
                contenido.innerHTML += `
                <tr>
                    <input hidden name="ids[]" value="${proceso.id}" id="claveidslistaproceso-${i}">
                    <td><input type="text" class="form-control listaProcesostextolista tamano-texto-cuerpo-lista" name="nombre[${proceso.id}]" value="${proceso.nombre}" id="claveprocesolistaractualizar-${i}"></td>
                </tr>
                ` 
            }
            return data.listaProcesos;
        }).catch(error =>console.error(error));
    }
    //registrar un proceso
    $("#clavebotonguardarlistaproceso").click(function () { 
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var nombre = $("#claveprocesoslistaregistrar").val();

        fetch('listaProcesos',{
            method : 'POST',
            body: JSON.stringify({nombre : nombre}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                vaciarCampos();
                obtenerListaProcesos();
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

    //editar y eliminar procesos
    $("#clavebotoneditareliminarlistaproceso").click(function (e) {
        e.preventDefault();
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var ids= [];
        var nombres = [];

        var padre = $("#cuerpopadrelistaprocesos tr").length;

        for (let index = 1; index <= padre; index++) {
            ids.push($("#claveidslistaproceso-"+index+"").val());
            nombres[$("#claveidslistaproceso-"+index+"").val()] = $("#claveprocesolistaractualizar-"+index+"").val()
        }

        fetch('listaProcesos/actualizar',{
            method : 'POST',
            body: JSON.stringify({id: ids, nombre: nombres}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                obtenerListaProcesos();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true
                })
            }else if(data.success == false) {
                obtenerListaProcesosa();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true
                })
            }
            return data.success;
        }).catch(error => {
            obtenerListaProcesos();
        });
    });
    //-------------------------------------  FIN LISTA PROCESOS -----------------------------------------

    //------------------------------------- LISTA CLASIFICACION -----------------------------------------
    //ver clasificacion
    function obtenerListaClasificacion(){
        var contenido = document.querySelector("#cuerpopadrelistaclasificacion")
        var listaClasificacion = [];
        var i = 0;
        fetch('listasClasificacion')
        .then(response =>{
            return response.json()
        }).then( data =>{
            listaClasificacion = data.listaClasificacions
            contenido.innerHTML = "";
            for (let clasificacion of listaClasificacion) {
                i++;
                contenido.innerHTML += `
                <tr>
                    <input hidden name="id[]" value="${clasificacion.id}" id="claveidslistaclasificacion-${i}">
                    <td><input type="text" class="form-control listaClasificacionstextolista tamano-texto-cuerpo-lista" name="nombre[${clasificacion.id}]"value="${clasificacion.nombre}" id="claveclasificacionlistaractualizar-${i}"></td>
                </tr>
                ` 
            }
            return data.listaClasificacions;
        }).catch(error =>console.error(error));
    }
    //registrar un clasificacion
    $("#clavebotonguardarlistaclasificacion").click(function () { 
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var nombre = $("#claveclasificacionlistaregistrar").val();

        fetch('listaClasificacions',{
            method : 'POST',
            body: JSON.stringify({nombre : nombre}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                vaciarCampos();
                obtenerListaClasificacion();
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

    //editar y eliminar clasificacion
    $("#clavebotoneditareliminarlistaclasificacion").click(function (e) {
        e.preventDefault();
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var ids= [];
        var nombres = [];

        var padre = $("#cuerpopadrelistaclasificacion tr").length;

        for (let index = 1; index <= padre; index++) {
            ids.push($("#claveidslistaclasificacion-"+index+"").val());
            nombres[$("#claveidslistaclasificacion-"+index+"").val()] = $("#claveclasificacionlistaractualizar-"+index+"").val()
        }

        fetch('listaClasificacions/actualizar',{
            method : 'POST',
            body: JSON.stringify({id: ids, nombre: nombres}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                obtenerListaClasificacion();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true
                })
            }else if(data.success == false) {
                obtenerListaClasificacion();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true
                })
            }
            return data.success;
        }).catch(error => {
            obtenerListaClasificacion();
        });
    });
    //-------------------------------------  FIN LISTA CLASIFICACION -----------------------------------------

    //------------------------------------- LISTA UNIDAD DE CONSUMO -----------------------------------------
    //ver unidad de consumo
    function obtenerListaUnidadConsumo(){
        var contenido = document.querySelector("#cuerpopadrelistaunidadconsumo")
        var listaUnidadConsumo = [];
        var i = 0;
        fetch('listasUnidadConsumo')
        .then(response =>{
            return response.json()
        }).then( data =>{
            listaUnidadConsumo = data.listaUnidadConsumos
            contenido.innerHTML = "";
            for (let unidadconsumo of listaUnidadConsumo) {
                i++;
                contenido.innerHTML += `
                <tr>
                    <input hidden name="id[]" value="${unidadconsumo.id}" id="claveidslistaunidadconsumo-${i}">
                    <td><input type="text" class="form-control listaUnidadConsumoStextolista tamano-texto-cuerpo-lista" name="nombre[${unidadconsumo.id}]" value="${unidadconsumo.nombre}" id="claveunidadconsumolistaractualizar-${i}"></td>
                </tr>
                ` 
            }
            return data.listaUnidadConsumos;
        }).catch(error =>console.error(error));
    }
    //registrar una unidad de proceso
    $("#clavebotonguardarlistaunidadconsumo").click(function () { 
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var nombre = $("#claveunidadconsumolistaregistrar").val();

        fetch('listaUnidadConsumo',{
            method : 'POST',
            body: JSON.stringify({nombre : nombre}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                vaciarCampos();
                obtenerListaUnidadConsumo();
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

    //editar y eliminar procesos
    $("#clavebotoneditareliminarlistaunidadconsumo").click(function (e) {
        e.preventDefault();
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var ids= [];
        var nombres = [];

        var padre = $("#cuerpopadrelistaunidadconsumo tr").length;

        for (let index = 1; index <= padre; index++) {
            ids.push($("#claveidslistaunidadconsumo-"+index+"").val());
            nombres[$("#claveidslistaunidadconsumo-"+index+"").val()] = $("#claveunidadconsumolistaractualizar-"+index+"").val()
        }

        fetch('listaUnidadConsumo/actualizar',{
            method : 'POST',
            body: JSON.stringify({id: ids, nombre: nombres}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                obtenerListaUnidadConsumo();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true
                })
            }else if(data.success == false) {
                obtenerListaUnidadConsumo();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true
                })
            }
            return data.success;
        }).catch(error => {
            obtenerListaUnidadConsumo();
        });
    });
    //-------------------------------------  FIN LISTA UNIDAD DE CONSUMO -----------------------------------------

    //------------------------------------- LISTA FAMILIAS DE MATERIALES -----------------------------------------
    //ver familias de materiales
    function obtenerListaFamiliaMateriales(){
        var contenido = document.querySelector("#cuerpopadrelistafamiliamateriales")
        var listaFamiliaMateriales = [];
        var i = 0;
        fetch('listasFamiliasMateriales')
        .then(response =>{
            return response.json()
        }).then( data =>{
            listaFamiliaMateriales = data.listaFamiliasMateriales
            contenido.innerHTML = "";
            for (let familiamateriales of listaFamiliaMateriales) {
                i++;
                contenido.innerHTML += `
                <tr>
                    <input hidden name="id[]" value="${familiamateriales.id}" id="claveidslistafamiliamateriales-${i}">
                    <td><input type="text" class="form-control listaFamiliaMaterialesStextolista tamano-texto-cuerpo-lista" name="nombre[${familiamateriales.id}]" value="${familiamateriales.nombre}" id="clavefamiliamaterialeslistaractualizar-${i}"></td>
                </tr>
                ` 
            }
            return data.listaFamiliasMateriales;
        }).catch(error =>console.error(error));
    }
    //registrar una familia de materiales
    $("#clavebotonguardarlistafamiliameteriales").click(function () { 
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var nombre = $("#clavefamiliamaterialeslistaregistrar").val();

        fetch('listaFamiliasMateriales',{
            method : 'POST',
            body: JSON.stringify({nombre : nombre}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                vaciarCampos();
                obtenerListaFamiliaMateriales();
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

    //editar y eliminar procesos
    $("#clavebotoneditareliminarlistafamiliamateriales").click(function (e) {
        e.preventDefault();
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var ids= [];
        var nombres = [];

        var padre = $("#cuerpopadrelistafamiliamateriales tr").length;

        for (let index = 1; index <= padre; index++) {
            ids.push($("#claveidslistafamiliamateriales-"+index+"").val());
            nombres[$("#claveidslistafamiliamateriales-"+index+"").val()] = $("#clavefamiliamaterialeslistaractualizar-"+index+"").val()
        }

        fetch('listaFamiliasMateriales/actualizar',{
            method : 'POST',
            body: JSON.stringify({id: ids, nombre: nombres}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                obtenerListaFamiliaMateriales();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true
                })
            }else if(data.success == false) {
                obtenerListaFamiliaMateriales();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true
                })
            }
            return data.success;
        }).catch(error => {
            obtenerListaFamiliaMateriales();
        });
    });
    //-------------------------------------  FIN LISTA FAMILIAS DE MATERIALES -----------------------------------------
});

