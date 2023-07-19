$(document).ready(function () {
  $('#tabla_ingresos').DataTable({
    responsive: true,
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, 'All']]
  });

  $('#tabla_ingresos_length, #tabla_ingresos_info').addClass('hidden md:block');
  $('#tabla_ingresos_length select').addClass('bg-white border border-gray-300 px-2 py-1 rounded');
  $('#tabla_ingresos_wrapper').addClass('overflow-x-auto');
  $('#tabla_ingresos_filter input').addClass('bg-white border border-gray-300 px-2 py-1 rounded');
  $('#tabla_ingresos_paginate .pagination').addClass('flex')
  $('#tabla_ingresos_paginate .paginate_button')
    .addClass('border border-gray-300 text-black hover:bg-gray-300 mr-2 px-3 py-1 rounded');

  $('#tabla_ingresos').on('draw.dt', function () {
    $('#tabla_ingresos_paginate .paginate_button')
      .addClass('border border-gray-300 text-black hover:bg-gray-300 mr-2 px-3 py-1 rounded');
    $('#tabla_ingresos_paginate .pagination').addClass('flex')
  });
});
