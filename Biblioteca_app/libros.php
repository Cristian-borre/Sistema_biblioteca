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
    <div class="md:p-2 lg:p-4 xl:p-10 h-[600px]">
        <button type="button" class="bg-blue-600 hover:bg-blue-700 ml-10 md:ml-8 xl:ml-18 2xl:ml-20 text-white px-4 py-2 font-semibold rounded-lg" id="Addmodal">Nuevo Libro</button>
        <div class="mx-4 lg:mx-4 xl:mx-8 2xl:mx-16 mt-8 h-[500px]">
            <div class="table-auto overflow-x-auto h-[580px]">
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
                                            <button type="button" class="Editmodal py-1 px-3 rounded-lg bg-cyan-500 hover:bg-cyan-600 text-lg text-white bx bx-pencil"></button>
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
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-40 hidden" id="modal-overlay"></div>
    <div id="AddModal" tabindex="-1" aria-hidden="true" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-8 w-72 md:w-full max-w-2xl max-h-full">
            <div>
                <div class="flex justify-between h-10 border-b border-gray-300 mb-4">
                    <h5 class="font-semibold text-2xl" id="exampleModalLabel">Nuevo Libro</h5>
                    <button type="button" class="text-gray-500 font-semibold hover:text-red-500 cursor-pointer text-4xl bx bx-x" id="closeAddmodal"></button>
                </div>
                <div>
                    <form action="./addlibroscontroller" enctype="multipart/form-data" method="POST">
                        <div>
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="titulo">
                                        Titulo:
                                    </label>
                                    <input id="titulo" name="titulo" required class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="text">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="autor" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Autor:</label>
                                    <select id="autor" name="autor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
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
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="categoria" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Categoria:</label>
                                    <select id="categoria" name="categoria" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
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
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="editorial" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Editorial:</label>
                                    <select id="editorial" name="editorial" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
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
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="encuadernado" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Encuadernado:</label>
                                    <select id="encuadernado" name="encuadernado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
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
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="ejemplares">
                                        Ejemplares:
                                    </label>
                                    <input id="ejemplares" name="ejemplares" required class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="number">
                                </div>
                            </div>
                            <div class="w-full mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900" for="image">Image:</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="image" name="img" type="file">
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
                    <h5 class="font-semibold text-2xl" id="exampleModalLabel">Editar Libro</h5>
                    <button type="button" class="text-gray-500 font-semibold hover:text-red-500 cursor-pointer text-4xl bx bx-x closeEditmodal"></button>
                </div>
                <div>
                    <form action="./editlibroscontroller" enctype="multipart/form-data" method="POST">
                        <div>
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="titulo">
                                        Titulo:
                                    </label>
                                    <input id="titulo" name="titulo" required class="titulo appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="text">
                                </div>
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="autor" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Autor:</label>
                                    <select id="autor" name="autor" class="n_autor bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
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
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="categoria" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Categoria:</label>
                                    <select id="categoria" name="categoria" class="n_categoria bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
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
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="editorial" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Editorial:</label>
                                    <select id="editorial" name="editorial" class="n_editorial bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
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
                            <div class="flex flex-wrap -mx-3 mb-3">
                                <div class="w-full md:w-1/2 px-3">
                                    <label for="encuadernado" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Encuadernado:</label>
                                    <select id="encuadernado" name="encuadernado" class="n_encuadernado bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                                        <option value="">--seleccione--</option>
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
                                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="ejemplares">
                                        Ejemplares:
                                    </label>
                                    <input id="ejemplares" name="ejemplares" required class="ejemplares appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="number">
                                </div>
                            </div>
                            <div class="w-full mb-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900" for="image">Image:</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="image" name="img" type="file">
                            </div>
                        </div>
                        <div class="flex justify-end border-t border-gray-300 pt-4">
                            <input type="hidden" class="form-control text-dark" id="token" name="token" value="<?php echo $_SESSION['token'] ?>" required>
                            <input type="hidden" class="id form-control text-dark" id="id" name="id" required>
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
            $('.titulo').val(datos[1]);
            $('.n_autor').val(datos[2]);
            $('.n_categoria').val(datos[4]);
            $('.n_editorial').val(datos[6]);
            $('.n_encuadernado').val(datos[8]);
            $('.ejemplares').val(datos[10]);
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
</div>
</div>