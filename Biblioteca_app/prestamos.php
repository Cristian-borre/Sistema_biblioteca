<?php
require_once 'index.php';

use Controller\PrestamosController;
use Controller\LibrosController;
use Controller\UsuarioController;

require_once(__DIR__ . '/vendor/autoload.php');
?>

<div class="ml-0 md:ml-[240px]">
    <div class="bg-[#1E1A34] w-full h-16 shadow-xl border-l-2 border-b-2 border-gray-400 grid place-items-center text-2xl font-semibold text-white">Lista de Prestamos</div>
    <div class="mt-4 md:p-2 lg:p-4 xl:p-10 h-[620px]">
        <button type="button" class="bg-blue-600 hover:bg-blue-700 ml-10 md:ml-8 xl:ml-18 2xl:ml-20 text-white px-4 py-2 font-semibold rounded-lg" id="Addmodal">Nuevo Prestamo</button>
        <div class="mx-4 lg:mx-4 xl:mx-8 2xl:mx-16 h-[500px] mt-8 ">
            <div class="table-auto overflow-y-auto overflow-x-auto h-[550px]">
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
                                            <button type="button" class="Editmodal py-1 px-3 rounded-lg bg-cyan-500 hover:bg-cyan-600 text-lg text-white"><i class="bx bx-pencil"></i> </button>
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
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-40 hidden" id="modal-overlay"></div>
    <div id="AddModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-8 w-72 md:w-full max-w-2xl max-h-full">
            <div>
                <div class="flex justify-between h-10 border-b border-gray-300 mb-4">
                    <h5 class="font-semibold text-2xl" id="exampleModalLabel">Nuevo Prestamo</h5>
                    <button type="button" class="text-gray-500 font-semibold hover:text-red-500 cursor-pointer text-4xl bx bx-x" id="closeAddmodal"></button>
                </div>
                <div>
                    <form action="./addprestamoscontroller" method="POST">
                        <div>
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="libro" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Libro:</label>
                                    <select id="libro" name="libro" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
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
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="persona" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Persona:</label>
                                    <select id="persona" name="persona" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
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
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fecha">
                                        Fecha:
                                    </label>
                                    <input id="fecha" name="fecha" disabled value="<?php echo date('Y-m-d') ?>" required class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="text">
                                    <input id="fecha" name="fecha" value="<?php echo date('Y-m-d') ?>" required class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="hidden">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="estado" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Estado:</label>
                                    <select id="estado" name="estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
                                        <option value="2">Pendiente</option>
                                        <option value="3">Reservar</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end border-t border-gray-300 pt-4">
                            <input type="hidden" class="form-control text-dark" id="token" name="token" value="<?php echo $_SESSION['token'] ?>" required>
                            <input type="hidden" name="url" value="./prestamos">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-lg text-white py-2 px-5 rounded-lg">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="EditModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-8 w-72 md:w-full max-w-2xl max-h-full">
            <div>
                <div class="flex justify-between h-10 border-b border-gray-300 mb-4">
                    <h5 class="font-semibold text-2xl" id="exampleModalLabel">Editar Prestamo</h5>
                    <button type="button" class="text-gray-500 font-semibold hover:text-red-500 cursor-pointer text-4xl bx bx-x closeEditmodal"></button>
                </div>
                <div>
                    <form action="./editprestamocontroller" method="POST">
                        <div>
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="libro" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Libro:</label>
                                    <select id="libro" name="libro" class="libro bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
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
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="persona" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Persona:</label>
                                    <select id="persona" name="persona" class="persona bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
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
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="fecha">
                                        Fecha:
                                    </label>
                                    <input id="fecha" name="fecha" min="<?php echo date('Y-m-d') ?>" required class="fecha appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="date">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="estado" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Estado:</label>
                                    <select id="estado" name="estado" class="estado bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
                                        <option value="1">Entregado</option>
                                        <option value="2">Pendiente</option>
                                        <option value="3">Reservado</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end border-t border-gray-300 pt-4">
                            <input type="hidden" class="form-control text-dark" id="token" name="token" value="<?php echo $_SESSION['token'] ?>" required>
                            <input id="id" name="id" required class="id appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="hidden">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-lg text-white py-2 px-5 rounded-lg">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.Editmodal').on('click', function() {
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
    <script>
        const openAddModalBtn = document.getElementById('Addmodal');
        const openEditModalBtn = document.querySelectorAll('.Editmodal');
        const closeAddModalBtn = document.getElementById('closeAddmodal');
        const closeEditModalBtn = document.querySelectorAll('.closeEditmodal');
        const Addmodal = document.getElementById('AddModal');
        const Editmodal = document.getElementById('EditModal');
        const modalOverlay = document.getElementById('modal-overlay');

        function openAddModal() {
            Addmodal.classList.remove('hidden');
            modalOverlay.classList.remove('hidden');
        }

        function openEditModal() {
            Editmodal.classList.remove('hidden');
            modalOverlay.classList.remove('hidden');
        }

        function closeAddModal() {
            Addmodal.classList.add('hidden');
            modalOverlay.classList.add('hidden');
        }

        function closeEditModal() {
            Editmodal.classList.add('hidden');
            modalOverlay.classList.add('hidden');
        }

        openAddModalBtn.addEventListener('click', openAddModal);
        closeAddModalBtn.addEventListener('click', closeAddModal);

        openEditModalBtn.forEach(button => {
            button.addEventListener('click', openEditModal);
        });
        closeEditModalBtn.forEach(button => {
            button.addEventListener('click', closeEditModal);
        });

    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
</div>