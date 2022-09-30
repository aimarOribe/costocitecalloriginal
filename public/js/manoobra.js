$(function () {

    $(document).ready(function () {
        obtenerManoObra();
    });

    function vaciarCamposManoObra(){
        $(".clavemanoobrafamiliaregistrar").val("");
        $(".clavemanoobramodeloregistrar").val("");
        $("#clavemanoobraprocesoregistrar").val("");
        $("#clavemanoobratiempohorasregistrar").val("");
        $("#clavemanoobracostoregistrar").val("");
    }

    $("#displayFormManoObra").change(function () {
        var agreed = $(this).is(':checked');
        if (agreed === true) {
            jQuery('#memberFormManoObra').toggle('show');
            jQuery('#requestFormManoObra').hide();
        }
        else {
            jQuery('#requestFormManoObra').toggle('show');
            jQuery('#memberFormManoObra').hide();
        }
    })

    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    document.getElementById('familiaSeleccionado').addEventListener('change', (e) => {
        fetch('modelos', {
            method: 'POST',
            body: JSON.stringify({ texto: e.target.value }),
            headers: {
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response => {
            return response.json()
        }).then(data => {
            var opciones = "<option value=''>--</option>";
            data.lista.forEach(modelo => {
                opciones += '<option value="' + modelo.id + '">' + modelo.modelo + '</option>';
            });
            document.getElementById("modeloSeleccionado").innerHTML = opciones;
        }).catch(error => console.error(error));
    })

    function recargarModelosFamiliasActualizar(){
        var padre = $(".cuerpopadremanoobra tr").length;
        for (let index = 1; index <= padre; index++) {
            const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
            $(".opcionfamilia-" + index + "").on('mouseenter mouseleave', (e) => {
                var vamos = $(".vamos-" + index + "").val();
                console.log(vamos);
                fetch('modelos', {
                    method: 'POST',
                    body: JSON.stringify({ texto: e.target.value }),
                    headers: {
                        'Content-Type': 'application/json',
                        "X-CSRF-Token": csrfToken
                    }
                }).then(response => {
                    return response.json()
                }).then(data => {
                    var opciones = "<option value=''>--</option>";
                    for (let index = 0; index < data.lista.length; index++) {
                        opciones += '<option value="' + data.lista[index].id + '" ' + (data.lista[index].id == vamos ? selected = "selected" : "") + '>' + data.lista[index].modelo + '</option>';
                    }
                    $(".opcionmodelo-" + index + "").html(opciones);
                }).catch(error => console.error(error));
            })
        }
    }

    //------------------------------------ Mano de Obra ----------------------------------------------
    //ver Mano de Obra
    function obtenerManoObra(){
        var contenido = document.querySelector("#cuerpopadremanoobra")
        var manoobras = [];
        var familias = [];
        var modelos = [];
        var procesos = [];
        var i = 0;
        fetch('obtenermanoobra')
        .then(response =>{
            return response.json()
        }).then( data =>{
            manoobras = data.manoobras
            familias = data.familias
            modelos = data.modelos
            procesos = data.procesos
            
            contenido.innerHTML = "";
            for (let manoobra of manoobras) {
                i++;
                contenido.innerHTML += 
                `
                <tr>
                    <input hidden class="vamos-${i}" value="${manoobra.modelo_id}">
                    <input hidden name="id[]" value="${manoobra.id}" id="claveidsmanoobraactualizar-${i}">
                    <td>
                        <select class="opcionfamilia-${i} form-control tamano-texto-cuerpo-lista" name="familia_id[${manoobra.id}]" id="clavemanoobrafamiliaactualizar-${i}">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            ${familias.map(familia => `
                                <option class="tamano-texto-cuerpo-lista" value="${familia.id}" ${(familia.id === manoobra.familia_id) ? "selected='selected'": ""}>
                                    ${familia.nombre}
                                </option>
                            `).join('')}
                        </select>
                    </td>
                    <td>
                        <select class="opcionmodelo-${i} form-control tamano-texto-cuerpo-lista" name="modelo_id[${manoobra.id}]" id="clavemanoobramodeloactualizar-${i}">
                        </select>
                    </td>
                    <td>
                        <select class="form-control tamano-texto-cuerpo-lista" name="proceso_id[${manoobra.id}]" id="clavemanoobraprocesoactualizar-${i}">
                            <option class="tamano-texto-cuerpo-lista" value="">--</option>
                            ${procesos.map(proceso => `
                                <option class="tamano-texto-cuerpo-lista" value="${proceso.id}" ${(proceso.id === manoobra.proceso_id) ? "selected='selected'": ""}>
                                    ${proceso.nombre}
                                </option>
                            `).join('')}
                        </select>
                    </td>
                    <td><input type="number" class="form-control tamano-texto-cuerpo-lista" name="tiempohoras[${manoobra.id}]" value="${manoobra.tiempohoras}" id="clavemanoobratiempohorasactualizar-${i}"></td>
                    <td><input class="form-control tamano-texto-cuerpo-lista" name="costo[${manoobra.id}]" value="${manoobra.costo}" id="clavemanoobracostoactualizar-${i}"></td>
                </tr>
                ` 
            }
            recargarModelosFamiliasActualizar();
            return [data.manoobras, data.familias, data.modelos, data.procesos];
        }).catch(error =>console.error(error));
    }

    //registrar Mano de Obra
    $("#clavebotonaguardarmanoobra").click(function () { 
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var familia = $(".clavemanoobrafamiliaregistrar").val();
        var modelo = $(".clavemanoobramodeloregistrar").val();
        var proceso = $("#clavemanoobraprocesoregistrar").val();
        var horas = $("#clavemanoobratiempohorasregistrar").val();
        var costo = $("#clavemanoobracostoregistrar").val();

        console.log(familia);
        console.log(modelo);
        console.log(proceso);
        console.log(horas);
        console.log(costo);

        fetch('manoobra',{
            method : 'POST',
            body: JSON.stringify({familia_id : familia, modelo_id: modelo, proceso_id: proceso, tiempohora: horas, costo: costo}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            console.log(data.success)
            if(data.success == true){
                vaciarCamposManoObra();
                obtenerManoObra();
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

    //editar y eliminar Mano de Obra
    $("#clavebotonaactualizareliminarmanoobra").click(function (e) {
        e.preventDefault();
        //Obtener el token de la pagina para poder realizar ajax.
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        //obtener los valores de los inputs
        var ids= [];
        var familias = [];
        var modelos = [];
        var procesos = [];
        var tiempoHoras = [];
        var costo = [];

        var padre = $(".cuerpopadremanoobra tr").length;
        for (let index = 1; index <= padre; index++) {
            ids.push($("#claveidsmanoobraactualizar-"+index+"").val());
            familias[$("#claveidsmanoobraactualizar-"+index+"").val()] = $("select#clavemanoobrafamiliaactualizar-"+index+"").val();
            modelos[$("#claveidsmanoobraactualizar-"+index+"").val()] = $("select#clavemanoobramodeloactualizar-"+index+"").val()
            procesos[$("#claveidsmanoobraactualizar-"+index+"").val()] = $("select#clavemanoobraprocesoactualizar-"+index+"").val();
            tiempoHoras[$("#claveidsmanoobraactualizar-"+index+"").val()] = $("#clavemanoobratiempohorasactualizar-"+index+"").val()
            costo[$("#claveidsmanoobraactualizar-"+index+"").val()] = $("#clavemanoobracostoactualizar-"+index+"").val();
        }

        fetch('manoobra/actualizar',{
            method : 'POST',
            body: JSON.stringify({id: ids, familia_id: familias, modelo_id: modelos, proceso_id: procesos, tiempohoras: tiempoHoras, costo: costo}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            if(data.success == true){
                obtenerManoObra();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'success',
                    timer: 3000,
                    timerProgressBar: true
                })
            }else if(data.success == false) {
                obtenerManoObra();
                Swal.fire({
                    title: data.mensaje,
                    icon: 'error',
                    timer: 3000,
                    timerProgressBar: true
                })
            }
            return data.success;
        }).catch(error => {
            obtenerManoObra();
        });
    });
    //------------------------------------ Fin Mano de Obra ----------------------------------------------

});