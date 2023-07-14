<?php
require_once 'index.php';

use Controller\PrestamosController;
use Controller\LibrosController;
use Controller\UsuarioController;

require_once(__DIR__ . '/vendor/autoload.php');
?>

<div class="ml-0 md:ml-[240px]">
    <div class="bg-[#1E1A34] w-full h-16 shadow-xl border-l-2 border-b-2 border-gray-400 grid place-items-center text-2xl font-semibold text-white">Lista de Prestamos</div>
    <div class="mt-4 md:p-2 lg:p-4 xl:p-10">
        <button type="button" class="bg-blue-600 hover:bg-blue-700 ml-10 md:ml-8 xl:ml-18 2xl:ml-20 text-white px-4 py-2 font-semibold rounded-lg" data-toggle="modal" data-target="#AddModal" data-bs-whatever="@mdo">Nuevo Prestamo</button>
        <div class="mx-4 lg:mx-4 xl:mx-8 2xl:mx-16 mt-8">
            <div class="table-auto overflow-x-auto" >
                <table class="w-full md:w-full" id="tabla_ingresos">
                    <thead class="bg-blue-200">
                        <tr>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">#</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">N_Libro</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Libro</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Documento</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Persona</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">F_Prestamo</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">ID_estado</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">estado</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $prestamos = PrestamosController::GetAllPrestamos($_SESSION['token']);
                        ?>
                        <?php
                        if ($prestamos['message'] == 'Prestamos listados') {
                            foreach ($prestamos['data'] as $prestamo) { ?>
                                <tr>
                                    <form>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800 font-bold"><?php echo $prestamo['id'] ?></td>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800 "><?php echo $prestamo['libro_id'] ?></td>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800 "><?php echo $prestamo['libro'] ?></td>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800 "><?php echo $prestamo['persona_id'] ?></td>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800 "><?php echo $prestamo['persona'] ?></td>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800 "><?php echo $prestamo['fecha_prestamo'] ?></td>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800 "><?php echo $prestamo['estado_prestamo'] ?></td>
                                        <?php if ($prestamo['estado_prestamo'] == 1) { ?>
                                            <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800 ">entregado</td>
                                        <?php } elseif ($prestamo['estado_prestamo'] == 2) { ?>
                                            <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800 ">pendiente</td>
                                        <?php } elseif ($prestamo['estado_prestamo'] == 3) { ?>
                                            <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800 ">reservado</td>
                                        <?php } ?>
                                        <td class="text-center border border-gray-300">
                                            <button type="button" data-toggle="modal" data-target="#editarModal" data-bs-whatever="@mdo" class="editbtn py-1 px-3 rounded-lg bg-cyan-500 hover:bg-cyan-600 text-lg text-white"><i class="bx bx-pencil"></i> </button>
                                        </td>
                                    </form>
                                </tr>
                            <?php }
                        } else { ?>
                            <div class="font-bold bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                                No existen registros
                            </div>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div id="AddModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="headers modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Prestamo</h5>
                </div>
                <div class="modal-body">
                    <form action="./addprestamoscontroller" method="POST">
                        <div class="fields">
                            <div class="inputs mb-2">
                                <label class="col-form-label">Libro:</label>
                                <select class="form-control" id="libro" name="libro">
                                    <option value="">--- seleccione ---</option>
                                    <?php
                                    $libros = LibrosController::GetAllLibros($_SESSION['token']);
                                    if ($libros['message'] == 'Libros listados') {
                                        foreach ($libros['data'] as $libro)
                                            if ($libro['estado'] == true) { ?>
                                            <option value="<?php echo $libro['id'] ?>"><?php echo $libro['titulo'] ?></option>
                                        <?php }
                                    } else { ?>
                                        <div class=" alert alert-danger">
                                            No existen registros
                                        </div>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="inputs mb-2">
                                <label class="col-form-label">Persona:</label>
                                <select class="form-control" id="persona" name="persona">
                                    <option value="">--- seleccione ---</option>
                                    <?php
                                    $personas = UsuarioController::GetAllPersona($_SESSION['token']);
                                    if ($personas['message'] == 'Usuarios listados') {
                                        foreach ($personas['data'] as $persona)
                                            if ($persona['estado'] == true) { ?>
                                            <option value="<?php echo $persona['documento'] ?>"><?php echo $persona['nombre'] . ' ' . $persona['apellido'] ?></option>
                                        <?php }
                                    } else { ?>
                                        <div class=" alert alert-danger">
                                            No existen registros
                                        </div>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="inputs mb-2">
                                <label class="col-form-label">Fecha:</label>
                                <input type="hidden" class="form-control" value="<?php echo date('Y-m-d') ?>" id="fecha" name="fecha" required>
                                <input type="text" disabled class="form-control" value="<?php echo date('Y-m-d') ?>" id="fecha" name="fecha" required>
                            </div>
                            <div class="inputs mb-2">
                                <label class="col-form-label">Estado:</label>
                                <select class="form-control text-dark" name="estado" id="estado">
                                    <option value="">--seleccione--</option>
                                    <option value="2">Pendiente</option>
                                    <option value="3">Reservar</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                            <input type="hidden" name="url" value="./prestamos">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="defaultModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="headers modal-header">
                    <h5 class="modal-title" id="editarModalLabel">Editar Prestamo</h5>
                </div>
                <div class="modal-body">
                    <form action="./editprestamocontroller" method="POST">
                        <div class="fields">
                            <input type="hidden" class="id" name="id">
                            <div class="inputs mb-2">
                                <label class="col-form-label">Libro:</label>
                                <select class="libro form-control" id="libro" name="libro">
                                    <option value="">--- seleccione ---</option>
                                    <?php
                                    $libros = LibrosController::GetAllLibros($_SESSION['token']);
                                    if ($libros['message'] == 'Libros listados') {
                                        foreach ($libros['data'] as $libro)
                                            if ($libro['estado'] == true) { ?>
                                            <option value="<?php echo $libro['id'] ?>"><?php echo $libro['titulo'] ?></option>
                                        <?php }
                                    } else { ?>
                                        <div class=" alert alert-danger">
                                            No existen registros
                                        </div>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="inputs mb-2">
                                <label class="col-form-label">Persona:</label>
                                <select class="persona form-control" id="persona" name="persona">
                                    <option value="">--- seleccione ---</option>
                                    <?php
                                    $personas = UsuarioController::GetAllPersona($_SESSION['token']);
                                    if ($personas['message'] == 'Usuarios listados') {
                                        foreach ($personas['data'] as $persona)
                                            if ($persona['estado'] == true) { ?>
                                            <option value="<?php echo $persona['documento'] ?>"><?php echo $persona['nombre'] . ' ' . $persona['apellido'] ?></option>
                                        <?php }
                                    } else { ?>
                                        <div class=" alert alert-danger">
                                            No existen registros
                                        </div>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="inputs mb-2">
                                <label class="col-form-label">Fecha:</label>
                                <input type="date" class="form-control fecha" min="<?php echo date('Y-m-d') ?>" id="fecha" name="fecha" required>
                            </div>
                            <div class="inputs mb-2">
                                <label class="col-form-label">Estado:</label>
                                <select class="estado form-control text-dark estado" name="estado" id="estado">
                                    <option value="">--seleccione--</option>
                                    <option value="1">Entregado</option>
                                    <option value="2">Pendiente</option>
                                    <option value="3">Reservar</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.editbtn').on('click', function() {
            $tr = $(this).closest('tr');
            var datos = $tr.children("td").map(function() {
                return $(this).text();
            });
            $('.id').val(datos[0]);
            $('.libro').val(datos[1]);
            $('.persona').val(datos[3]);
            $('.fecha').val(datos[5]);
            $('.estado').val(datos[6]);
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
</div>