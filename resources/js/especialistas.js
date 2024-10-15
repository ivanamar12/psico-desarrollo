$(document).ready(function(){
    var tablaEspecialista = $('#tab-especialista').DataTable({
        processing:true,
        serverSide:true,
        ajax:{
            url: "{{ route('especialista.index')}}",
        },
        columns:[
            {data: 'id'},
            {data: 'nombre'},
            {data: 'apellido'},
            {data: 'ci'},
            {data: 'email'},
            {data: 'telefono'},
            {data: 'action', orderable: false}
        ]
    });
});
