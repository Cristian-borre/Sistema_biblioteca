<?php
require_once('index.php');
use Controller\CategoriaController;
require_once(__DIR__.'/vendor/autoload.php'); 
?>

<div class="main_content">
    <div class="container mt-3">
        <div class="">
            <div class="container col-xl-13">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-bs-whatever="@mdo">Nueva Categoria</button>
                <div id="menu_tabla_ingresos" class="header text-center text-dark">Lista de Categoria </div>
                <br>
                <table class="table table-bordered" id="tabla_ingresos">
                    <thead class="table-primary">
                        <tr>
                            <th>#</th>
                            <th>Categoria</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $categorias = CategoriaController::GetAllCategoria($_SESSION['token']);
                        ?>
                        <?php
                        if($categorias['message'] == 'Categorias listadas'){
                            foreach($categorias['data'] as $categoria) {?>
                            <tr>
                        <form class="form-inline">
                            <td class="text-center"><?php echo $categoria['id'] ?></td>
                            <td class="text-center"><?php echo $categoria['categoria'] ?></td>
                            <td class="text-center">
                                <button type="button" data-toggle="modal" data-target="#editarModal" data-bs-whatever="@mdo" class="editbtn btn btn-info text-white"><i class="bx bx-pencil" ></i> </button>
                            </td>
                            <td class="text-center">
                            <?php
                                if($categoria['estado']){ ?>
                                    <a href="./deletecategoriacontroller?id=<?php echo $categoria['id']?>&jwt=<?php echo $_SESSION['token']?>" class="btn btn-success bx bx-user-check"></a>
                            <?php }else{ ?>
                                    <a href="./deletecategoriacontroller?id=<?php echo $categoria['id']?>&jwt=<?php echo $_SESSION['token']?>" class="btn btn-danger bx bx-user-x"></a>
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
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="headers modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nueva Categoria</h5>
                            </div>
                            <div class="modal-body">
                                <form action="./addcategoriacontroller" method="POST">
                                    <div class="fields">
                                        <div class="inputs mb-2">
                                            <label class="col-form-label">Id:</label>
                                            <input type="text" class="form-control" id="id" name="id" required>
                                        </div>
                                        <div class="inputs mb-2">
                                            <label class="col-form-label">Categoria:</label>
                                            <input type="text" class="form-control text-dark" id="categoria" name="categoria" required>
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
                    <div class="modal-dialog ">
                        <div class="modal-content">
                            <div class="headers modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Editar Categoria</h5>
                            </div>
                            <div class="modal-body">
                                <form action="./editcategoriacontroller" method="POST">
                                    <div class="fields">
                                        <div class="inputs mb-2">
                                            <label class="col-form-label">Id:</label>
                                            <input type="hidden" class="id form-control" id="id" name="id" required>
                                            <input type="text" disabled class="id form-control" id="id" name="id" required>
                                        </div>
                                        <div class="inputs mb-2">
                                            <label class="col-form-label">Categoria:</label>
                                            <input type="text" class="categoria form-control text-dark" id="categoria" name="categoria" required>
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
                $('.editbtn').on('click',function (){
                    $tr=$(this).closest('tr');
                    var datos=$tr.children("td").map(function (){
                        return $(this).text();
                    });
                    $('.id').val(datos[0]);
                    $('.categoria').val(datos[1]);
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