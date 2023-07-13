<?php
require_once('index.php');
use Controller\PrestamosController;
use Controller\LibrosController;
use Controller\UsuarioController;
use Core\Core;
require_once(__DIR__.'/vendor/autoload.php'); 
?>

<div class="main_content">
    <div class="container mt-3">
        <div class="">
            <div class="container ">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-bs-whatever="@mdo">Nuevo Prestamo</button>
                <div id="menu_tabla_ingresos"class="header text-center text-dark">Lista de Prestamos </div>
                <br>
                <table class="table table-bordered" id="tabla_ingresos">
                    <thead class="table-primary">
                        <tr>
                          <th>#</th>
                          <th>Libro</th>
                          <th>Persona</th>
                          <th>F_Prestamo</th>
                          <th>estado</th>
                          <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $prestamos = PrestamosController::GetAllPrestamos($_SESSION['token']);
                        ?>
                        <?php
                        if($prestamos['message'] == 'Prestamos listados'){
                            foreach($prestamos['data'] as $prestamo) {?>
                        <tr>
                        <form class="form-inline">
                            <td class="text-center"><?php echo $prestamo['id'] ?></td>
                            <td class="text-center"><?php echo $prestamo['libro'] ?></td>
                            <td class="text-center"><?php echo $prestamo['persona'] ?></td>
                            <td class="text-center"><?php echo $prestamo['fecha_prestamo'] ?></td>
                            <td class="text-center"><?php echo $prestamo['estado_prestamo'] ?></td>
                            <?php if($prestamo['estado_prestamo'] == 1){ ?>
                                <td class="text-center">
                                    <button type="button" class="editbtn btn btn-success text-white bx bx-check-square"></button>
                                </td>
                            <?php }elseif($prestamo['estado_prestamo'] == 2){ ?>
                                <td class="text-center">
                                    <a href="./editestadoprestamocontroller?id=<?php echo $prestamo['id']?>&token=<?php echo $_SESSION['token']?>" class="editbtn btn btn-danger text-white bx bx-book-reader"></a>
                                </td>
                            <?php }elseif($prestamo['estado_prestamo'] == 3){ ?>
                                <td class="text-center">
                                    <a href="./editestadoprestamocontroller?id=<?php echo $prestamo['id']?>&token=<?php echo $_SESSION['token']?>" class="btn btn-primary text-white bx bx-calendar"></a>
                                </td>
                            <?php }?>
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
                                                    if($libros['message'] == 'Libros listados'){ 
                                                        foreach($libros['data'] as $libro) 
                                                        if ($libro['estado'] == true){ ?>
                                                        <option value="<?php echo $libro['id'] ?>"><?php echo $libro['titulo'] ?></option>
                                                <?php } 
                                                }else{ ?>
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
                                                    if($personas['message'] == 'Usuarios listados'){ 
                                                        foreach($personas['data'] as $persona) 
                                                        if ($persona['estado'] == true){ ?>
                                                        <option value="<?php echo $persona['documento'] ?>"><?php echo $persona['nombre'].' '.$persona['apellido'] ?></option>
                                                <?php } 
                                                }else{ ?>
                                                    <div class=" alert alert-danger">
                                                        No existen registros
                                                    </div>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="inputs mb-2">
                                            <label class="col-form-label">Fecha:</label>
                                            <input type="hidden" class="form-control" value="<?php echo date('Y-m-d')?>" id="fecha" name="fecha" required>
                                            <input type="text" disabled class="form-control" value="<?php echo date('Y-m-d')?>" id="fecha" name="fecha" required>
                                        </div>
                                        <div class="inputs mb-2">
                                            <label class="col-form-label">Estado:</label>
                                            <select  class="form-control text-dark" name="estado" id="estado">
                                                <option value="">--seleccione--</option>
                                                <option value="2">Pendiente</option>
                                                <option value="3">Reservar</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                                        <input type="hidden" name="url" value="./prestamos2">
                                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

                <!-- Option 2: Separate Popper and Bootstrap JS -->
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
            </div>
        </div>
    </div>
</div>