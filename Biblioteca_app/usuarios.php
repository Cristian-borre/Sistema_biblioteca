<?php
require_once('index.php');

use Controller\UsuarioController;

require_once(__DIR__ . '/vendor/autoload.php');
?>

<div class="ml-0 md:ml-[240px]">
    <div class="bg-[#1E1A34] w-full h-16 shadow-xl border-l-2 border-b-2 border-gray-400 grid place-items-center text-2xl font-semibold text-white">Lista de Usuarios</div>
    <div class="mt-4 md:p-2 lg:p-4 xl:p-10">
        <button type="button" class="bg-blue-600 hover:bg-blue-700 ml-10 md:ml-8 xl:ml-18 2xl:ml-20 text-white px-4 py-2 font-semibold rounded-lg" data-toggle="modal" data-target="#AddModal" data-bs-whatever="@mdo">Nuevo Usuario</button>
        <div class="mx-4 lg:mx-4 xl:mx-8 2xl:mx-16 mt-8">
            <div class="table-auto overflow-x-auto">
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
                                            <button type="button" data-toggle="modal" data-target="#editarModal" data-bs-whatever="@mdo" class="editbtn py-1 px-3 rounded-lg bg-cyan-500 hover:bg-cyan-600 text-lg text-white bx bx-pencil"></button>
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
    <div id="AddModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="headers modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                </div>
                <div class="modal-body">
                    <form action="./addusuariocontroller" method="POST">
                        <div class="fields">
                            <div class="input mb-2">
                                <label class="col-form-label">Identificacion:</label>
                                <input type="number" class="form-control" id="documento" name="documento" required>
                            </div>
                            <div class="input mb-2">
                                <label class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control text-dark" id="nombre" name="nombre" required>
                            </div>
                            <div class="input mb-2">
                                <label class="col-form-label">Apellido:</label>
                                <input type="text" class="form-control text-dark" id="apellido" name="apellido" required>
                            </div>
                            <div class="input mb-2">
                                <label class="col-form-label">Correo:</label>
                                <input type="text" class="form-control text-dark" id="correo" name="correo" required>
                            </div>
                            <div class="input mb-2">
                                <label class="col-form-label">Telefono:</label>
                                <input type="text" class="form-control text-dark" id="telefono" name="telefono" required>
                            </div>
                            <div class="input mb-2">
                                <label class="col-form-label">Contraseña:</label>
                                <input type="text" class="form-control text-dark" id="password" name="password" required>
                            </div>
                            <div class="input mb-2">
                                <label class="col-form-label">Cargo:</label>
                                <select class="form-control text-dark" name="cargo" id="cargo">
                                    <option value="">--seleccione--</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Empleado</option>
                                    <option value="3">Natural</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control text-dark" id="token" name="token" value="<?php echo $_SESSION['token'] ?>" required>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="AddModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="headers modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                </div>
                <div class="modal-body">
                    <form action="./editusuariocontroller" method="POST">
                        <div class="fields">
                            <div class="input mb-2">
                                <label class="col-form-label">Identificacion:</label>
                                <input type="hidden" class="documento form-control" id="documento" name="documento" required>
                                <input type="text" disabled class="documento form-control" id="documento" name="documento" required>
                            </div>
                            <div class="input mb-2">
                                <label class="col-form-label">Nombre:</label>
                                <input type="text" class="nombre form-control text-dark" id="nombre" name="nombre" required>
                            </div>
                            <div class="input mb-2">
                                <label class="col-form-label">Apellido:</label>
                                <input type="text" class="apellido form-control text-dark" id="apellido" name="apellido" required>
                            </div>
                            <div class="input mb-2">
                                <label class="col-form-label">Correo:</label>
                                <input type="text" class="correo form-control text-dark" id="correo" name="correo" required>
                            </div>
                            <div class="input mb-2">
                                <label class="col-form-label">Telefono:</label>
                                <input type="text" class="telefono form-control text-dark" id="telefono" name="telefono" required>
                            </div>
                            <div class="input mb-2">
                                <label class="col-form-label">Contraseña:</label>
                                <input type="text" class="form-control text-dark" id="password" name="password" required>
                            </div>
                            <div class="input mb-2">
                                <label class="col-form-label">Cargo:</label>
                                <select class="form-control text-dark N_cargo" name="cargo" id="cargo">
                                    <option value="">--seleccione--</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Empleado</option>
                                    <option value="3">Natural</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control text-dark" id="token" name="token" value="<?php echo $_SESSION['token'] ?>" required>
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
            $('.documento').val(datos[0]);
            $('.nombre').val(datos[1]);
            $('.apellido').val(datos[2]);
            $('.correo').val(datos[3]);
            $('.telefono').val(datos[4]);
            $('.N_cargo').val(datos[5]);
        });
    </script>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</div>