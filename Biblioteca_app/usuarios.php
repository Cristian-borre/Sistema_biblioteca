<?php
require_once('index.php');

use Controller\UsuarioController;

require_once(__DIR__ . '/vendor/autoload.php');
?>

<div class="ml-0 md:ml-[240px]">
    <div class="bg-[#1E1A34] w-full h-16 shadow-xl border-l-2 border-b-2 border-gray-400 grid place-items-center text-2xl font-semibold text-white">Lista de Usuarios</div>
    <div class="mt-4 md:p-2 lg:p-4 xl:p-10 h-[620px]">
        <button type="button" class="bg-blue-600 hover:bg-blue-700 ml-10 md:ml-8 xl:ml-18 2xl:ml-20 text-white px-4 py-2 font-semibold rounded-lg" id="Addmodal">Nuevo Usuario</button>
        <div class="mx-4 lg:mx-4 xl:mx-8 2xl:mx-16 mt-8 h-[500px]">
            <div class="table-auto overflow-x-auto overflow-y-auto h-[550px]">
                <table class="w-full md:w-full" id="tabla_ingresos">
                    <thead class="bg-blue-200">
                        <tr>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Identificacion</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Nombre</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Apellido</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Correo</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Telefono</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">ID Cargo</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Cargo</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left"></th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $usuarios = UsuarioController::GetAllUsuario($_SESSION['token']);
                        ?>
                        <?php
                        if ($usuarios['message'] == 'Usuarios listados') {
                            foreach ($usuarios['data'] as $usuario) { ?>
                                <tr>
                                    <form>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800 font-bold"><?php echo $usuario['documento'] ?></td>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $usuario['nombre'] ?></td>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $usuario['apellido'] ?></td>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $usuario['email'] ?></td>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $usuario['telefono'] ?></td>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $usuario['cargo'] ?></td>
                                        <?php if ($usuario['cargo'] == 1) {
                                            $cargo = 'admin';
                                        ?>
                                            <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $cargo ?></td>
                                        <?php } else if ($usuario['cargo'] == 2) {
                                            $cargo = 'empleado';
                                        ?>
                                            <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $cargo ?></td>
                                        <?php } else if ($usuario['cargo'] == 3) {
                                            $cargo = 'natural';
                                        ?>
                                            <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $cargo ?></td>
                                        <?php } ?>
                                        <td class="text-center border border-gray-300">
                                            <button type="button" class="Editmodal py-1 px-3 rounded-lg bg-cyan-500 hover:bg-cyan-600 text-lg text-white bx bx-pencil"></button>
                                        </td>
                                        <td class="text-center border border-gray-300">
                                            <?php
                                            if ($usuario['estado']) { ?>
                                                <a href="./deleteusuariocontroller?id=<?php echo $usuario['documento'] ?>&jwt=<?php echo $_SESSION['token'] ?>" class="py-1 px-3 rounded-lg bg-green-500 hover:bg-green-600 text-lg text-white bx bx-user-check"></a>
                                            <?php } else { ?>
                                                <a href="./deleteusuariocontroller?id=<?php echo $usuario['documento'] ?>&jwt=<?php echo $_SESSION['token'] ?>" class="py-1 px-3 rounded-lg bg-red-600 hover:bg-red-700 text-lg text-white bx bx-user-x"></a>
                                            <?php } ?>
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
                    <h5 class="font-semibold text-2xl" id="exampleModalLabel">Nuevo Usuario</h5>
                    <button type="button" class="text-gray-500 font-semibold hover:text-red-500 cursor-pointer text-4xl bx bx-x" id="closeAddmodal"></button>
                </div>
                <div>
                    <form action="./addusuariocontroller" method="POST">
                        <div>
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="documento">
                                        Identificacion:
                                    </label>
                                    <input id="documento" name="documento" required class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="number">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">
                                        Nombre:
                                    </label>
                                    <input id="nombre" name="nombre" required class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:border-blue-500" type="text">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="apellido">
                                        Apellido:
                                    </label>
                                    <input id="apellido" name="apellido" required class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="text">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="correo">
                                        Correo:
                                    </label>
                                    <input id="correo" name="correo" required class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:border-blue-500" type="text">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="telefono">
                                        Telefono:
                                    </label>
                                    <input id="telefono" name="telefono" required class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="number">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                                        Contraseña:
                                    </label>
                                    <input id="password" name="password" required class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:border-blue-500" type="password">
                                </div>
                            </div>
                            <div class="w-full mb-4">
                                <label for="cargo" class="block mb-2 text-sm font-medium text-gray-900">Cargo:</label>
                                <select id="cargo" name="cargo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">--seleccione--</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Empleado</option>
                                    <option value="3">Natural</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end border-t border-gray-300 pt-4">
                            <input type="hidden" class="form-control text-dark" id="token" name="token" value="<?php echo $_SESSION['token'] ?>" required>
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
                    <h5 class="font-semibold text-2xl" id="exampleModalLabel">Editar Usuario</h5>
                    <button type="reset" class="text-gray-500 font-semibold hover:text-red-500 cursor-pointer text-4xl bx bx-x closeEditmodal"></button>
                </div>
                <div class="modal-body">
                    <form action="./editusuariocontroller" method="POST">
                        <div>
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="documento">
                                        Identificacion:
                                    </label>
                                    <input id="documento" name="documento" disabled required class="documento appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="number">
                                    <input id="documento" name="documento" required class="documento appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="hidden">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nombre">
                                        Nombre:
                                    </label>
                                    <input id="nombre" name="nombre" required class="nombre appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:border-blue-500" type="text">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="apellido">
                                        Apellido:
                                    </label>
                                    <input id="apellido" name="apellido" required class="apellido appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="text">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="correo">
                                        Correo:
                                    </label>
                                    <input id="correo" name="correo" required class="correo appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:border-blue-500" type="text">
                                </div>
                            </div>
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="telefono">
                                        Telefono:
                                    </label>
                                    <input id="telefono" name="telefono" required class="telefono appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="number">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                                        Contraseña:
                                    </label>
                                    <input id="password" name="password" required class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:border-blue-500" type="password">
                                </div>
                            </div>
                            <div class="w-full mb-4">
                                <label for="cargo" class="block mb-2 text-sm font-medium text-gray-900">Cargo:</label>
                                <select id="cargo" name="cargo" class="N_cargo bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="">--seleccione--</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Empleado</option>
                                    <option value="3">Natural</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex justify-end border-t border-gray-300 pt-4">
                            <input type="hidden" class="form-control text-dark" id="token" name="token" value="<?php echo $_SESSION['token'] ?>" required>
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
            $('.documento').val(datos[0]);
            $('.nombre').val(datos[1]);
            $('.apellido').val(datos[2]);
            $('.correo').val(datos[3]);
            $('.telefono').val(datos[4]);
            $('.N_cargo').val(datos[5]);
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
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</div>