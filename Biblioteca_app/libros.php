<?php
require_once('index.php');
use Controller\LibrosController;
use Controller\AutoresController;
use Controller\CategoriaController;
use Controller\EditorialController;
use Controller\EncuadernadoController;
require_once(__DIR__.'/vendor/autoload.php'); 
?>

<div class="main_content">
    <div class="container mt-3">
        <div class="">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-bs-whatever="@mdo">Nuevo Libro</button>
            <div id="menu_tabla_ingresos" class="header text-center text-dark">Lista de Libros </div>
            <br>
            <table class="table table-bordered" id="tabla_ingresos">
                <thead class="table-primary table">
                    <tr>
                        <th class="">#</th>
                        <th class="">Titulo</th>
                        <th class="">#</th>
                        <th class="">Autor</th>
                        <th class="">#</th>
                        <th class="">Categoria</th>
                        <th class="">#</th>
                        <th class="">Editorial</th>
                        <th class="">#</th>
                        <th class="">Encuadernado</th>
                        <th class="">cant</th>
                        <th class=""></th>
                        <th class=""></th>
                    </tr>
                </thead>
                <tbody class="">
                    <?php
                        $libros = LibrosController::GetAllLibros($_SESSION['token']);
                    ?>
                    <?php
                    if($libros['message'] == 'Libros listados'){
                        foreach($libros['data'] as $libro) {?>
                        <tr>
                    <form class="form-inline">
                        <td class="text-center"><?php echo $libro['id']?></td>
                        <td class="text-center"><?php echo $libro['titulo']?></td>
                        <td class="text-center"><?php echo $libro['autor_id']?></td>
                        <td class="text-center"><?php echo $libro['autor']?></td>
                        <td class="text-center"><?php echo $libro['categoria_id']?></td>
                        <td class="text-center"><?php echo $libro['categoria']?></td>
                        <td class="text-center"><?php echo $libro['editorial_id']?></td>
                        <td class="text-center"><?php echo $libro['editorial']?></td>
                        <td class="text-center"><?php echo $libro['encuadernado_id']?></td>
                        <td class="text-center"><?php echo $libro['encuadernado']?></td>
                        <td class="text-center"><?php echo $libro['ejemplares']?></td>
                        <td class="text-center">
                           <button type="button" data-toggle="modal" data-target="#editarModal" data-bs-whatever="@mdo" class="editbtn btn btn-info text-white bx bx-pencil"></button>
                        </td>
                        <td class="text-center ">
                            <?php
                                if($libro['estado']){ ?>
                                    <a href="./deletelibroscontroller?id=<?php echo $libro['id']?>&jwt=<?php echo $_SESSION['token']?>" class="btn btn-success bx bx-user-check"></a>
                            <?php }else{ ?>
                                    <a href="./deletelibroscontroller?id=<?php echo $libro['id']?>&jwt=<?php echo $_SESSION['token']?>" class="btn btn-danger bx bx-user-x"></a>
                            <?php } ?>
                        </td>
                    </form>
                    </tr>
                    <?php }
                    }else{?>
                    <div class=" alert alert-danger">
                      No existen registros
                    </div>
                    <?php }?>
                </tbody>
            </table>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                if($autores['message'] == 'Autores listados'){ 
                                                    foreach($autores['data'] as $autor) 
                                                    if ($autor['estado'] == true){ ?>
                                                    <option value="<?php echo $autor['id'] ?>"><?php echo $autor['autor'] ?></option>
                                            <?php } 
                                            }else{ ?>
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
                                                if($categorias['message'] == 'Categorias listadas'){ 
                                                    foreach($categorias['data'] as $categoria) 
                                                    if ($categoria['estado'] == true){?>
                                                    <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                                            <?php }
                                            }else{ ?>
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
                                                if($editorial['message'] == 'Editoriales listados'){ 
                                                    foreach($editorial['data'] as $editorial) 
                                                    if ($editorial['estado'] == true){?>
                                                    <option value="<?php echo $editorial['id'] ?>"><?php echo $editorial['editorial'] ?></option>
                                            <?php }
                                            }else{ ?>
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
                                                if($encuadernado['message'] == 'Encuadernados listados'){ 
                                                    foreach($encuadernado['data'] as $encuadernado) 
                                                    if ($encuadernado['estado'] == true){?>
                                                    <option value="<?php echo $encuadernado['id'] ?>"><?php echo $encuadernado['encuadernado'] ?></option>
                                            <?php }
                                            }else{ ?>
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
            <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                if($autores['message'] == 'Autores listados'){ 
                                                    foreach($autores['data'] as $autor) 
                                                    if ($autor['estado'] == true){ ?>
                                                    <option value="<?php echo $autor['id'] ?>"><?php echo $autor['autor'] ?></option>
                                            <?php }
                                            }else{ ?>
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
                                                if($categorias['message'] == 'Categorias listadas'){ 
                                                    foreach($categorias['data'] as $categoria)
                                                    if ($categoria['estado'] == true){  ?>
                                                    <option value="<?php echo $categoria['id'] ?>"><?php echo $categoria['categoria'] ?></option>
                                            <?php }
                                            }else{ ?>
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
                                                if($editorial['message'] == 'Editoriales listados'){ 
                                                    foreach($editorial['data'] as $editorial) 
                                                    if ($editorial['estado'] == true){ ?>
                                                    <option value="<?php echo $editorial['id'] ?>"><?php echo $editorial['editorial'] ?></option>
                                            <?php }
                                            }else{ ?>
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
                                                if($encuadernado['message'] == 'Encuadernados listados'){ 
                                                    foreach($encuadernado['data'] as $encuadernado) 
                                                    if ($encuadernado['estado'] == true){ ?>
                                                    <option value="<?php echo $encuadernado['id'] ?>"><?php echo $encuadernado['encuadernado'] ?></option>
                                            <?php }
                                            }else{ ?>
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
            $('.editbtn').on('click',function (){
                $tr=$(this).closest('tr');
                var datos=$tr.children("td").map(function (){
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