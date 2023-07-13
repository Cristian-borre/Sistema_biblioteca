# Biblioteca-App
App de biblioteca Realiza el proceso de consulta, registro, edición y eliminación . Los registros no se deberían de eliminar, se debe agregar un campo de estado para anular los registros deseados, pero estos deben de quedar en base de datos.

Modulos existentes:

Prestamo: Se realiza el procesor de consultar, registro, edicion y eliminacion de prestamos en la biblioteca el cual cuenta con un campo de estado para la manipulacion de los libros(Pendiente, Entregado, Reservado).

Libro: Se realiza el procesor de consultar, registro, edicion y eliminacion de libros el cual cuenta con un campo de estado para la anulacion a los registros deseados, El cual esta conformado por los 4 siguientes modulos de abajo.

Autor: Se realiza el procesor de consultar, registro, edicion y eliminacion el cual cuenta con un campo de estado para la anulacion a los registros deseados. 

Categoria: Se realiza el procesor de consultar, registro, edicion y eliminacion el cual cuenta con un campo de estado para la anulacion a los registros deseados. 

Encuadernado: Se realiza el procesor de consultar, registro, edicion y eliminacion el cual cuenta con un campo de estado para la anulacion a los registros deseados. 

Editorial: Se realiza el procesor de consultar, registro, edicion y eliminacion el cual cuenta con un campo de estado para la anulacion a los registros deseados.

Usuarios: El cual cuenta con 3 roles distintos.

Admin: Privilegio de todos los modulos anteriormente mencionados para consultar, registro, edicion y eliminacion el cual cuenta con un campo de estado para la anulacion a los registros deseados.

Empleado: Privilegio solo para consultar en los modulos usuarios, libros y prestamos, en el modulo prestamos tiene el privilegio de agregar y cambiar estado del prestamo (entregado, pendiente, reservado)

Natural: Privilegio solo para consultar libros y hacer reservas de ellos.

NOTA: Crear una carpeta llamada 'upload' antes de registrar un libro ya que es donde se alojan las imagenes de los libros.