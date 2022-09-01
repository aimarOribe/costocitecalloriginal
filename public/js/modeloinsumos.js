$(function(){

    $(document).ready(function () {
        obtenerModelos();
        obtenerInsumos();
    });

    //Modelos
    $("#displayFormModelosInsumosModelos").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormModelosInsumosModelos').toggle('show');
            jQuery('#requestFormModelosInsumosModelos').hide();
        }
        else {
            jQuery('#requestFormModelosInsumosModelos').toggle('show');
            jQuery('#memberFormModelosInsumosModelos').hide();
        }
    })

    //Insumos
    $("#displayFormModelosInsumosInsumos").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormModelosInsumosInsumos').toggle('show');
            jQuery('#requestFormModelosInsumosInsumos').hide();
        }
        else {
            jQuery('#requestFormModelosInsumosInsumos').toggle('show');
            jQuery('#memberFormModelosInsumosInsumos').hide();
        }
    })

    //vaciar campos
    function vaciarCamposModelos(){
        $("#clavemodelofamiliaregistrar").val("");
        $("#clavemodelomodeloregistrar").val("");
    }

    function vaciarCamposInsumos(){
        $("#clavefamiliainsumoregistrar").val("");
        $("#clavefamiliamaterialesinsumoregistrar").val("");
    }

    //------------------------------------ Modelos ----------------------------------------------
    //ver Modelos
    function obtenerModelos(){
        var contenido = document.querySelector("#cuerpopadremodeloinsumosmodelo")
        var modelos = [];
        var familias = [];
        var i = 0;
        fetch('obtenerModelosInsumosModelos')
        .then(response =>{
            return response.json()
        }).then( data =>{
            modelos = data.modeloinsumomodelo
            familias = data.familias

            contenido.innerHTML = "";
            for (let modelo of modelos) {
                i++;
                contenido.innerHTML += 
                `
                <tr>
                    <input hidden name="id[]" value="${modelo.id}" id="claveidsmodelosinsumosmodelos-${i}">
                    <td>
                        <select class="form-control tamano-texto-cuerpo-lista" name="familia_id[${modelo.id}]" id="clavemodelofamiliaactualizar-${i}">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            ${familias.map(familia => `
                                <option class="tamano-texto-cuerpo-lista" value="${familia.id}" ${(familia.id === modelo.familia_id) ? "selected='selected'": ""}>
                                    ${familia.nombre}
                                </option>
                            `).join('')}
                        </select>
                    </td>
                    <td><input class="form-control tamano-texto-cuerpo-lista" type="text" name="modelo[${modelo.id}]" value="${modelo.modelo}" id="clavemodelomodeloactualizar-${i}"></td>
                </tr>
                ` 
            }
            return [data.modeloinsumomodelo, data,familias];
        }).catch(error =>console.error(error));
    }

    //registrar un modelo
    $("#clavebotonguardarmodeloinsumosmodelo").click(function () { 
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var familia = $("#clavemodelofamiliaregistrar").val();
        var modelo = $("#clavemodelomodeloregistrar").val();

        fetch('modeloseinsumosmodelos',{
            method : 'POST',
            body: JSON.stringify({familia_id : familia, modelo: modelo}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            console.log(data.success)
            if(data.success == true){
                vaciarCamposModelos();
                obtenerModelos();
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

    //editar y eliminar mdelos
    $("#clavebotonactualizareliminarmodeloinsumosmodelo").click(function (e) {
        e.preventDefault();
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var ids= [];
        var familias = [];
        var modelos = [];

        var padre = $(".cuerpopadremodeloinsumosmodelo tr").length;
        for (let index = 1; index <= padre; index++) {
            ids.push($("#claveidsmodelosinsumosmodelos-"+index+"").val());
            familias[$("#claveidsmodelosinsumosmodelos-"+index+"").val()] = $("select#clavemodelofamiliaactualizar-"+index+"").val();
            modelos[$("#claveidsmodelosinsumosmodelos-"+index+"").val()] = $("#clavemodelomodeloactualizar-"+index+"").val()
        }

        fetch('modeloseinsumosmodelos/actualizar',{
            method : 'POST',
            body: JSON.stringify({id: ids, familia_id: familias, modelo: modelos}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                obtenerModelos();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true
                })
            }else if(data.success == false) {
                obtenerModelos();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true
                })
            }
            return data.success;
        }).catch(error => {
            obtenerModelos();
        });
    });
    //------------------------------------ Fin Modelos ----------------------------------------------

    //------------------------------------ Inusmos ----------------------------------------------
    //ver Modelos
    function obtenerInsumos(){
        var contenido = document.querySelector("#cuerpopadremodeloinsumosinsumos")
        var insumofamilias = [];
        var familias = [];
        var familiaMateriales = [];
        var i = 0;
        fetch('obtenerModelosInsumosInsumos')
        .then(response =>{
            return response.json()
        }).then( data =>{
            insumofamilias = data.insumofamilias
            familias = data.familias
            familiaMateriales = data.familiasMateriales
            
            contenido.innerHTML = "";
            for (let insumo of insumofamilias) {
                i++;
                contenido.innerHTML += 
                `
                <tr>
                    <input hidden name="id[]" value="${insumo.id}" id="claveidsmodelosinsumosinsumos-${i}">
                    <td>
                        <select class="form-control tamano-texto-cuerpo-lista" name="familia_id[${insumo.id}]" id="claveinsumofamiliaactualizar-${i}">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            ${familias.map(familia => `
                                <option class="tamano-texto-cuerpo-lista" value="${familia.id}" ${(familia.id === insumo.familia_id) ? "selected='selected'": ""}>
                                    ${familia.nombre}
                                </option>
                            `).join('')}
                        </select>
                    </td>
                    <td>
                        <select class="form-control tamano-texto-cuerpo-lista" name="listafamiliamateriales_id[${insumo.id}]" id="claveinsumofamiliamaterialesactualizar-${i}">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            ${familiaMateriales.map(familiamaterial => `
                                <option class="tamano-texto-cuerpo-lista" value="${familiamaterial.id}" ${(familiamaterial.id === insumo.listafamiliamateriales_id) ? "selected='selected'": ""}>
                                    ${familiamaterial.nombre}
                                </option>
                            `).join('')}
                        </select>
                    </td>
                </tr>
                ` 
            }
            return [data.insumofamilias, data.familias, data.familiasMateriales];
        }).catch(error =>console.error(error));
    }

    //registrar un insumo
    $("#clavebotonguardarmodeloinsumosinsumos").click(function () { 
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var familia = $("#clavefamiliainsumoregistrar").val();
        var familiamaterial = $("#clavefamiliamaterialesinsumoregistrar").val();

        fetch('modeloseinsumosinsumos',{
            method : 'POST',
            body: JSON.stringify({familia_id : familia, listafamiliamateriales_id: familiamaterial}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            console.log(data.success)
            if(data.success == true){
                vaciarCamposInsumos();
                obtenerInsumos();
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

    //editar y eliminar insumos
    $("#clavebotonactualizareliminarmodeloinsumosinsumos").click(function (e) {
        e.preventDefault();
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var ids= [];
        var familias = [];
        var familiamateriales = [];

        var padre = $(".cuerpopadremodeloinsumosinsumos tr").length;
        for (let index = 1; index <= padre; index++) {
            ids.push($("#claveidsmodelosinsumosinsumos-"+index+"").val());
            familias[$("#claveidsmodelosinsumosinsumos-"+index+"").val()] = $("select#claveinsumofamiliaactualizar-"+index+"").val();
            familiamateriales[$("#claveidsmodelosinsumosinsumos-"+index+"").val()] = $("#claveinsumofamiliamaterialesactualizar-"+index+"").val()
        }

        fetch('modeloseinsumosinsumos/actualizar',{
            method : 'POST',
            body: JSON.stringify({id: ids, familia_id: familias, listafamiliamateriales_id: familiamateriales}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                obtenerInsumos();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true
                })
            }else if(data.success == false) {
                obtenerInsumos();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true
                })
            }
            return data.success;
        }).catch(error => {
            obtenerInsumos();
        });
    });
    //------------------------------------ Fin Insumos ----------------------------------------------
});



