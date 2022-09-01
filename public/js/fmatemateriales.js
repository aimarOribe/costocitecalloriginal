$(function(){

    $(document).ready(function () {
        obtenerMateriales();
    });

    function vaciarCamposfmmateriales(){
        $("#clavefmmfamiliamaterialesregistrar").val("");
        $("#clavefmmnombreregistrar").val("");
        $("#clavefmmunidadmedidasregistrar").val("");
        $("#clavefmmpresentacionregistrar").val("");
    }

    //Materiales
    $("#displayFormfmmateriales").change(function(){
        var agreed = $(this).is(':checked');
        if(agreed === true) { 
            jQuery('#memberFormfmmateriales').toggle('show');
            jQuery('#requestFormfmmateriales').hide();
        }
        else {
            jQuery('#requestFormfmmateriales').toggle('show');
            jQuery('#memberFormfmmateriales').hide();
        }
    })

    //------------------------------------ Materiales ----------------------------------------------
    //ver Materiales
    function obtenerMateriales(){
        var contenido = document.querySelector("#cuerpopadrefmaterialesmateriales")
        var familiaMateriales = [];
        var fmmateriales = [];
        var unidadmedidas = [];
        var i = 0;
        fetch('obtenerfamiliamaterialesmateriales')
        .then(response =>{
            return response.json()
        }).then( data =>{
            fmmateriales = data.fmmateriales
            familiaMateriales = data.familiasmateriales
            unidadmedidas = data.unidadesmedidas
            
            contenido.innerHTML = "";
            for (let material of fmmateriales) {
                i++;
                contenido.innerHTML += 
                `
                <tr>
                    <input hidden name="id[]" value="${material.id}" id="claveidsfmmaterialmateriales-${i}">
                    <td>
                        <select class="form-control tamano-texto-cuerpo-lista" name="familiamateriales_id[${material.id}]" id="clavefmmfamiliamaterialesactualizar-${i}">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            ${familiaMateriales.map(familiamaterial => `
                                <option class="tamano-texto-cuerpo-lista" value="${familiamaterial.id}" ${(familiamaterial.id === material.familiamateriales_id) ? "selected='selected'": ""}>
                                    ${familiamaterial.nombre}
                                </option>
                            `).join('')}
                        </select>
                    </td>
                    <td><input class="form-control tamano-texto-cuerpo-lista" type="text" name="nombre[${material.id}]" value="${material.nombre}" id="clavefmmnombreactualizar-${i}"></td>
                    <td>
                        <select class="form-control tamano-texto-cuerpo-lista" name="unidadesmedidas_id[${material.id}]" id="clavefmmunidadmedidasactualizar-${i}">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            ${unidadmedidas.map(unidadmedida => `
                                <option class="tamano-texto-cuerpo-lista" value="${unidadmedida.id}" ${(unidadmedida.id === material.listaunidadmedida_id) ? "selected='selected'": ""}>
                                    ${unidadmedida.nombre}
                                </option>
                            `).join('')}
                        </select>
                    </td>
                    <td><input class="form-control tamano-texto-cuerpo-lista" type="text" name="presentacion[${material.id}]" value="${material.presentacion}" id="clavefmmpresentacionactualizar-${i}"></td>
                    <td><input readonly class="form-control tamano-texto-cuerpo-lista" type="number" name="stock[${material.id}]" value="${material.stock}" id="clavefmmstockactualizar-${i}"></td>
                    <td><input readonly class="form-control tamano-texto-cuerpo-lista" type="text" name="costopromedio[${material.id}]" value="${material.costopromedio}" id="clavefmmcostopromedioactualizar-${i}"></td>
                    <td><input readonly class="form-control tamano-texto-cuerpo-lista" type="number" name="costoreal[${material.id}]" value="${material.costoreal}" id="clavefmmcostorealactualizar-${i}"></td>
                </tr>
                ` 
            }
            return [data.fmmateriales, data.familiasmateriales, data.unidadesmedidas];
        }).catch(error =>console.error(error));
    }

    //registrar un material
    $("#clavebotonguardarfmmateriales").click(function () { 
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var familiamaterial = $("#clavefmmfamiliamaterialesregistrar").val();
        var nombre = $("#clavefmmnombreregistrar").val();
        var unidadmedida = $("#clavefmmunidadmedidasregistrar").val();
        var presentacion = $("#clavefmmpresentacionregistrar").val();

        fetch('familiamaterialesmateriales',{
            method : 'POST',
            body: JSON.stringify({familiamateriales_id : familiamaterial, nombre: nombre, unidadesmedidas_id: unidadmedida, presentacion: presentacion}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            console.log(data.success)
            if(data.success == true){
                vaciarCamposfmmateriales();
                obtenerMateriales();
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

    //editar y eliminar materiales
    $("#clavebotonactualizareliminarfmmateriales").click(function (e) {
        e.preventDefault();
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var ids= [];
        var familiamateriales = [];
        var nombres = [];
        var uinidadmedidas = [];
        var presentaciones = [];

        var padre = $(".cuerpopadrefmaterialesmateriales tr").length;
        for (let index = 1; index <= padre; index++) {
            ids.push($("#claveidsfmmaterialmateriales-"+index+"").val());
            familiamateriales[$("#claveidsfmmaterialmateriales-"+index+"").val()] = $("select#clavefmmfamiliamaterialesactualizar-"+index+"").val();
            nombres[$("#claveidsfmmaterialmateriales-"+index+"").val()] = $("#clavefmmnombreactualizar-"+index+"").val()
            uinidadmedidas[$("#claveidsfmmaterialmateriales-"+index+"").val()] = $("select#clavefmmunidadmedidasactualizar-"+index+"").val();
            presentaciones[$("#claveidsfmmaterialmateriales-"+index+"").val()] = $("#clavefmmpresentacionactualizar-"+index+"").val()
        }

        fetch('familiamaterialesmateriales/actualizar',{
            method : 'POST',
            body: JSON.stringify({id: ids, familiamateriales_id: familiamateriales, nombre: nombres, unidadesmedidas_id: uinidadmedidas, presentacion: presentaciones}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                obtenerMateriales();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true
                })
            }else if(data.success == false) {
                obtenerMateriales();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true
                })
            }
            return data.success;
        }).catch(error => {
            obtenerMateriales();
        });
    });
    //------------------------------------ Fin Insumos ----------------------------------------------

});

