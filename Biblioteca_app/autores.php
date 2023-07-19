<?php
require_once('index.php');

use Controller\AutoresController;

require_once(__DIR__ . '/vendor/autoload.php');
?>

<div class="ml-0 md:ml-[240px]">
    <div class="bg-[#1E1A34] w-full h-16 shadow-xl border-l-2 border-b-2 border-gray-400 grid place-items-center text-2xl font-semibold text-white">Lista de Autores</div>
    <div class="mt-4 md:p-2 lg:p-4 xl:p-10 h-[620px]">
        <button type="button" class="bg-blue-600 hover:bg-blue-700 ml-10 md:ml-8 xl:ml-18 2xl:ml-20 text-white px-4 py-2 font-semibold rounded-lg" id="Addmodal">Nuevo Autor</button>
        <div class="mx-4 lg:mx-4 xl:mx-8 2xl:mx-16 mt-8 h-[500px]">
            <div class="table-auto overflow-x-auto h-[550px]">
                <table class="w-full md:w-full" id="tabla_ingresos">
                    <thead class="bg-blue-200">
                        <tr>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">#</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left">Autores</th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left"></th>
                            <th class="p-3 text-lg font-semibold tracking-wide border-b-gray-300 border border-blue-300 text-left"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $autores = AutoresController::GetAllAutores($_SESSION['token']);
                        ?>
                        <?php
                        if ($autores['message'] == 'Autores listados') {
                            foreach ($autores['data'] as $autor) { ?>
                                <tr>
                                    <form>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800 font-bold"><?php echo $autor['id'] ?></td>
                                        <td class="p-4 text-base border border-gray-300 font-semibold text-gray-800"><?php echo $autor['autor'] ?></td>
                                        <td class="text-center border border-gray-300">
                                            <button type="button" class="Editmodal py-1 px-3 rounded-lg bg-cyan-500 hover:bg-cyan-600 text-lg text-white bx bx-pencil"></button>
                                        </td>
                                        <td class="text-center border border-gray-300">
                                            <?php
                                            if ($autor['estado']) { ?>
                                                <a href="./deleteautorescontroller?id=<?php echo $autor['id'] ?>&jwt=<?php echo $_SESSION['token'] ?>" class="py-1 px-3 rounded-lg bg-red-600 hover:bg-red-700 text-lg text-white bx bx-trash"></a>
                                            <?php } else { ?>
                                                <a href="./deleteautorescontroller?id=<?php echo $autor['id'] ?>&jwt=<?php echo $_SESSION['token'] ?>" class="py-1 px-3 rounded-lg bg-green-500 hover:bg-green-600 text-lg text-white bx bx-refresh"></a>
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
        <div class="bg-white rounded-lg p-8 w-74 md:w-full max-w-2xl max-h-full">
            <div>
                <div class="flex justify-between h-10 border-b border-gray-300 mb-4">
                    <h5 class="font-semibold text-2xl" id="exampleModalLabel">Nuevo Autor</h5>
                    <button type="button" class="text-gray-500 font-semibold hover:text-red-500 cursor-pointer text-4xl bx bx-x" id="closeAddmodal"></button>
                </div>
                <div>
                    <form action="./addautorescontroller" method="POST">
                        <div>
                            <div class="w-full mb-4">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="id">
                                    ID:
                                </label>
                                <input id="id" name="id" required class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="number">
                            </div>
                            <div class="w-full mb-4">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="autor">
                                    Autor:
                                </label>
                                <input id="autor" name="autor" required class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:border-blue-500" type="text">
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
        <div class="bg-white rounded-lg p-8 w-74 md:w-full max-w-2xl max-h-full">
            <div>
                <div class="flex justify-between h-10 border-b border-gray-300 mb-4">
                    <h5 class="font-semibold text-2xl" id="exampleModalLabel">Editar Autor</h5>
                    <button type="reset" class="text-gray-500 font-semibold hover:text-red-500 cursor-pointer text-4xl bx bx-x closeEditmodal"></button>
                </div>
                <div class="modal-body">
                    <form action="./editautorescontroller" method="POST">
                        <div>
                            <div class="w-full mb-4">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="id">
                                    ID:
                                </label>
                                <input id="id" name="id" disabled required class="id appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="number">
                                <input id="id" name="id" required class="id appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 leading-tight focus:outline-none focus:border-blue-500" type="hidden">
                            </div>
                            <div class="w-full mb-4">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="autor">
                                    Autor:
                                </label>
                                <input id="autor" name="autor" required class="autor appearance-none block w-full text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:border-blue-500" type="text">
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
            $('.id').val(datos[0]);
            $('.autor').val(datos[1]);
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
</div>