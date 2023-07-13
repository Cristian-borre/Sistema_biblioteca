$(document).ready(function () {
  var tabla_gastos= $('#tabla_ingresos').DataTable({
   extend: 'collection',
   processing: true,
   'processing': true,
   "ordering": false,
   "order": [[ 0, "desc" ]],
   "bDestroy": true,
   buttons: [
     {extend :'excel',
       className: 'bg-light btn btn-outline-info mr-2' },
     { extend: 'pdf',
       className: 'bg-light btn btn-outline-info mr-2' }
   ],});
   
  tabla_gastos.buttons(0, null).containers().appendTo('#menu_tabla_ingresos');
});
