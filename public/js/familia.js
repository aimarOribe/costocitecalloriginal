$(function(){
    
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

});