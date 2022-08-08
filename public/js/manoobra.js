$(function(){
    const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
    document.getElementById('familiaSeleccionado').addEventListener('change',(e)=>{
        fetch('modelos',{
            method : 'POST',
            body: JSON.stringify({texto : e.target.value}),
            headers:{
                'Content-Type': 'application/json',
                "X-CSRF-Token": csrfToken
            }
        }).then(response =>{
            return response.json()
        }).then( data =>{
            var opciones ="<option value=''>--</option>";
            data.lista.forEach(modelo => {
                opciones+= '<option value="'+modelo.id+'">'+modelo.modelo+'</option>';
            });
            document.getElementById("modeloSeleccionado").innerHTML = opciones;
        }).catch(error =>console.error(error));
    })

    var padre = $(".cuerpopadremanoobra tr").length;
    console.log(padre);
    for (let index = 1; index <= padre; index++) {
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        $(".opcionfamilia-"+index+"").on('mouseenter',(e)=>{
            var vamos = $(".vamos-"+index+"").val();
            console.log(vamos);
            fetch('modelos',{
                method : 'POST',
                body: JSON.stringify({texto : e.target.value}),
                headers:{
                    'Content-Type': 'application/json',
                    "X-CSRF-Token": csrfToken
                }
            }).then(response =>{
                return response.json()
            }).then( data =>{
                var opciones ="<option value=''>--</option>";
                for (let index = 0; index < data.lista.length; index++) {
                    opciones+= '<option value="'+data.lista[index].id+'" '+ (data.lista[index].id == vamos ? selected="selected":"") + '>'+data.lista[index].modelo+'</option>';
                }
                $(".opcionmodelo-"+index+"").html(opciones);
            }).catch(error =>console.error(error));
        })
    }
});

function displayFormManoObra(c) {
    if (c.value == "2") {    
        jQuery('#memberFormManoObra').toggle('show');
        jQuery('#requestFormManoObra').hide();
    }
        if (c.value == "1") {
        jQuery('#requestFormManoObra').toggle('show');
        jQuery('#memberFormManoObra').hide();
    }
};