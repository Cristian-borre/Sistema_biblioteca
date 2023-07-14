<?php
require_once('index.php');

use Controller\LibrosController;
use Controller\AutoresController;
use Controller\CategoriaController;
use Controller\EditorialController;
use Controller\EncuadernadoController;

require_once(__DIR__ . '/vendor/autoload.php');
?>

<div class="ml-0 md:ml-[240px]">
    <div class="bg-[#1E1A34] w-full h-16 shadow-xl border-l-2 border-b-2 border-gray-400 grid place-items-center text-2xl font-semibold text-white">Lista de Libros</div>
    <div class="mt-4 md:p-2 lg:p-4 xl:p-10">
        <button type="button" class="bg-blue-600 hover:bg-blue-700 ml-10 md:ml-8 xl:ml-18 2xl:ml-20 text-white px-4 py-2 font-semibold rounded-lg" data-toggle="modal" data-target="#AddModal" data-bs-whatever="@mdo">Nuevo Libro</button>
        <div class="mx-4 lg:mx-4 xl:mx-8 2xl:mx-16 mt-8">
            <div class="table-auto overflow-x-auto">
                <table class="w-full md:w-full" id="tabla_ingresos">
                    <thead class="bg-blue-200">
                        <tr>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">#</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Titulo</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">#</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Autor</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">#</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Categoria</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">#</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Editorial</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">#</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Encuadernado</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">cant</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left"></th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $libros = LibrosController::GetAllLibros($_SESSION['token']);
                        ?>
                        <?php
                        if ($libros['message'] == 'Libros listados') {
                            foreach ($libros['data'] as $libro) { ?>
                                <tr>
                                    <form>
                                        <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800 font-bold"><?php echo $libro['id'] ?></td>
                                        <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libro['titulo'] ?></td>
                                        <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libro['autor_id'] ?></td>
                                        <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libro['autor'] ?></td>
                                        <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libro['categoria_id'] ?></td>
                                        <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libro['categoria'] ?></td>
                                        <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libro['editorial_id'] ?></td>
                                        <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libro['editorial'] ?></td>
                                        <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libro['encuadernado_id'] ?></td>
                                        <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libro['encuadernado'] ?></td>
                                        <td class="p-3 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $libro['ejemplares'] ?></td>
                                        <td class="text-center border border-gray-300">
                                            <button type="button" data-toggle="modal" data-target="#editarModal" data-bs-whatever="@mdo" class="editbtn py-1 px-3 rounded-lg bg-cyan-500 hover:bg-cyan-600 text-lg text-white bx bx-pencil"></button>
                                        </td>
                                        <td class="text-center border border-gray-300 ">
                                            <?php
                                            if ($libro['estado']) { ?>
                                                <a href="./deletelibroscontroller?id=<?php echo $libro['id'] ?>&jwt=<?php echo $_SESSION['token'] ?>" class="py-1 px-3 rounded-lg bg-red-600 hover:bg-red-700 text-lg text-white bx bx-trash"></a>
                                            <?php } else { ?>
                                                <a href="./deletelibroscontroller?id=<?php echo $libro['id'] ?>&jwt=<?php echo $_SESSION['token'] ?>" class="py-1 px-3 rounded-lg bg-green-500 hover:bg-green-600 text-lg text-white bx bx-refresh"></a>
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
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Libro</h5>
                </div>
                <div class="modal-body">
                    <form action="./addlibroscontroller" enctype="multipart/form-data" method="POST">
                        <div class="fields row">
                            <div class="input col mb-2">
                                <label class="col-form-label">Titulo:</label>
                                <input type="text" class="form-control" id="titulo" name="titulo" required>
                            </div>
                            <div class="input col mb-2">
                                <label class="col-form-label">Autor:</label>
                                <select class="form-control" id="autor" name="autor">
                                    <option value="">--- seleccione ---</option>
                                    <?php
                                    $autores = AutoresController::GetAllAutores($_SESSION['token']);
                                    if ($autores['message'] == 'Autores listados') {
                                        foreach ($autores['data'] as $autor)
                                            if ($autor['estado'] == true) { ?>
                                            <option value="<?php echo $autor['id'] ?>"><?php echo $autor['autor'] ?></option>
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
                        <div class="fields row">
                            <div class="input col mb-2">
                                <label class="col-form-label">Categoria:</label>
                                <select class="form-control" id="categoria" name="categoria">
                                    <option value="">--- seleccione ---</option>
                                    <?php
                                    $categorias = CategoriaController::GetAllCategoria($_SESSION['token']);
                                    if ($categorias['message'] == 'Categorias listadas') {
                                        foreach ($categorias['data'] as $categoria)
                                            if ($categoria['estado'] == true) { ?>
                                            <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                                        <?php }
                                    } else { ?>
                                        <div class=" alert alert-danger">
                                            No existen registros
                                        </div>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="input col mb-2">
                                <label class="col-form-label">Editorial:</label>
                                <select class="form-control" id="editorial" name="editorial">
                                    <option value="">--- seleccione ---</option>
                                    <?php
                                    $editorial = EditorialController::GetAllEditorial($_SESSION['token']);
                                    if ($editorial['message'] == 'Editoriales listados') {
                                        foreach ($editorial['data'] as $editorial)
                                            if ($editorial['estado'] == true) { ?>
                                            <option value="<?php echo $editorial['id'] ?>"><?php echo $editorial['editorial'] ?></option>
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
                        <div class="fields row">
                            <div class="input col mb-2">
                                <label class="col-form-label">Encuadernado:</label>
                                <select class="form-control" id="encuadernado" name="encuadernado">
                                    <option value="">--- seleccione ---</option>
                                    <?php
                                    $encuadernado = EncuadernadoController::GetAllEncuadernado($_SESSION['token']);
                                    if ($encuadernado['message'] == 'Encuadernados listados') {
                                        foreach ($encuadernado['data'] as $encuadernado)
                                            if ($encuadernado['estado'] == true) { ?>
                                            <option value="<?php echo $encuadernado['id'] ?>"><?php echo $encuadernado['encuadernado'] ?></option>
                                        <?php }
                                    } else { ?>
                                        <div class=" alert alert-danger">
                                            No existen registros
                                        </div>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="input col mb-2">
                                <label class="col-form-label">Ejemplares:</label>
                                <input type="number" class="form-control" id="ejemplares" name="ejemplares" required>
                            </div>
                        </div>
                        <div class="fields row">
                            <div class="input col mb-2">
                                <label class="col-form-label">Image:</label>
                                <input type="File" class="form-control" id="img" name="img" required>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Libro</h5>
                </div>
                <div class="modal-body">
                    <form action="./editlibroscontroller" enctype="multipart/form-data" method="POST">
                        <div class="fields row">
                            <div class="input col mb-2">
                                <label class="col-form-label">Titulo:</label>
                                <input type="text" class="titulo form-control" id="titulo" name="titulo" required>
                            </div>
                            <div class="input col mb-2">
                                <label class="col-form-label">Autor:</label>
                                <select class="n_autor form-control" id="autor" name="autor">
                                    <option value="<?php echo $autor['id'] ?>"><?php echo $autor['autor'] ?></option>
                                    <?php
                                    $autores = AutoresController::GetAllAutores($_SESSION['token']);
                                    if ($autores['message'] == 'Autores listados') {
                                        foreach ($autores['data'] as $autor)
                                            if ($autor['estado'] == true) { ?>
                                            <option value="<?php echo $autor['id'] ?>"><?php echo $autor['autor'] ?></option>
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
                        <div class="fields row">
                            <div class="input col mb-2">
                                <label class="col-form-label">Categoria:</label>
                                <select class="n_categoria form-control" id="categoria" name="categoria">
                                    <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                                    <?php
                                    $categorias = CategoriaController::GetAllCategoria($_SESSION['token']);
                                    if ($categorias['message'] == 'Categorias listadas') {
                                        foreach ($categorias['data'] as $categoria)
                                            if ($categoria['estado'] == true) {  ?>
                                            <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                                        <?php }
                                    } else { ?>
                                        <div class=" alert alert-danger">
                                            No existen registros
                                        </div>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="input col mb-2">
                                <label class="col-form-label">Editorial:</label>
                                <select class="n_editorial form-control" id="editorial" name="editorial">
                                    <option value="<?php echo $editorial['id'] ?>"><?php echo $editorial['editorial'] ?></option>
                                    <?php
                                    $editorial = EditorialController::GetAllEditorial($_SESSION['token']);
                                    if ($editorial['message'] == 'Editoriales listados') {
                                        foreach ($editorial['data'] as $editorial)
                                            if ($editorial['estado'] == true) { ?>
                                            <option value="<?php echo $editorial['id'] ?>"><?php echo $editorial['editorial'] ?></option>
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
                        <div class="fields row">
                            <div class="input col mb-2">
                                <label class="col-form-label">Encuadernado:</label>
                                <select class="n_encuadernado form-control" id="encuadernado" name="encuadernado">
                                    <option value="<?php echo $encuadernado['id'] ?>"><?php echo $encuadernado['encuadernado'] ?></option>
                                    <?php
                                    $encuadernado = EncuadernadoController::GetAllEncuadernado($_SESSION['token']);
                                    if ($encuadernado['message'] == 'Encuadernados listados') {
                                        foreach ($encuadernado['data'] as $encuadernado)
                                            if ($encuadernado['estado'] == true) { ?>
                                            <option value="<?php echo $encuadernado['id'] ?>"><?php echo $encuadernado['encuadernado'] ?></option>
                                        <?php }
                                    } else { ?>
                                        <div class=" alert alert-danger">
                                            No existen registros
                                        </div>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="input col mb-2">
                                <label class="col-form-label">Ejemplares:</label>
                                <input type="number" class="ejemplares form-control" id="ejemplares" name="ejemplares" required>
                            </div>
                        </div>
                        <div class="fields row">
                            <div class="input col mb-2">
                                <label class="col-form-label">Image:</label>
                                <input type="File" class="img form-control" id="img" name="img" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control text-dark" id="token" name="token" value="<?php echo $_SESSION['token'] ?>" required>
                            <input type="hidden" class="id form-control text-dark" id="id" name="id" required>
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
            $('.titulo').val(datos[1]);
            $('.n_autor').val(datos[2]);
            $('.n_categoria').val(datos[4]);
            $('.n_editorial').val(datos[6]);
            $('.n_encuadernado').val(datos[8]);
            $('.ejemplares').val(datos[10]);
        });
    </script>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</div>
</div>
</div>