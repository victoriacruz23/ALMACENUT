   <?php
    include_once("conexion.php");
    // Verificar si se ha pasado un ID de producto en la URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        include("Connection/connection.php");

        // Obtener el ID del producto desde la URL
        $producto_id = $_GET['id'];

        // Consultar el nombre del producto utilizando el ID
        $sql = "SELECT nombreProducto, stock FROM productos WHERE id = $producto_id";
        $query = mysqli_query($conexion, $sql);

        // Verificar si se encontró el producto
        if ($query && mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            $nombre_producto = $row['nombreProducto'];
            $stock_actual = $row['stock'];

            // Procesar el formulario si se ha enviado
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cantidad']) && is_numeric($_POST['cantidad'])) {
                // Obtener la cantidad del formulario
                $cantidad = intval($_POST['cantidad']);

                // Verificar si la cantidad es positiva
                if ($cantidad >= 0) {
                    // Actualizar el campo 'salida' en la base de datos
                    $sql_actualizar_salidas = "UPDATE productos SET salida = salida + $cantidad WHERE id = $producto_id";
                    $query_actualizar_salidas = mysqli_query($conexion, $sql_actualizar_salidas);

                    // Actualizar el campo 'stock' restando la cantidad de salidas
                    $nuevo_stock = $stock_actual - $cantidad;
                    $sql_actualizar_stock = "UPDATE productos SET stock = $nuevo_stock WHERE id = $producto_id";
                    $query_actualizar_stock = mysqli_query($conexion, $sql_actualizar_stock);

                    if ($query_actualizar_salidas && $query_actualizar_stock) {
                        // Mostrar Sweet Alert de éxito
                        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                                <script language='JavaScript'>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Salidas Agregadas',
                                        text: 'Se designaron $cantidad salidas al producto \"$nombre_producto\".',
                                        showCancelButton: false,
                                        confirmButtonColor: '#4c5dac',
                                        confirmButtonText: 'OK',
                                    }).then(() => {
                                        location.assign('../almacenista/productos.php');
                                    });
                                });
                                </script>";
                    } else {
                        // Mostrar Sweet Alert de error
                        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                                <script language='JavaScript'>
                                document.addEventListener('DOMContentLoaded', function() {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Ocurrio un error al agragar  las salidas',
                                        showCancelButton: false,
                                        confirmButtonColor: '#4c5dac',
                                        confirmButtonText: 'OK',
                                    }).then(() => {
                                        location.assign('../almacenista/productos.php');
                                    });
                                });
                                </script>";;
                    }
                } else {
                    // Mostrar Sweet Alert de error
                    echo "<script>
                                Swal.fire(
                                  'Error',
                                  'Ocurrió un error al agregar las entradas.',
                                  'error'
                                );
                              </script>";
                }
            }
    ?>
           <!-- Mostrar el nombre del producto -->
           <p>Producto: <strong><?php echo $nombre_producto; ?></strong></p>

           <!-- Formulario para agregar salidas -->
           <form id="agregar-salidas-form" action="" method="POST">
               <input type="hidden" name="producto_id" value="<?php echo $producto_id; ?>">
               <!-- Otros campos del formulario -->
               <label for="cantidad">Cantidad a designar:</label>
               <!-- Utilizar el atributo pattern para restringir a números enteros y positivos -->
               <input type="number" id="cantidad" name="cantidad" min="0" required pattern="\d+" oninput="validarCantidad(this)">
               <br>
               <input type="submit" value="Agregar Salidas">
           </form>


   <?php
        } else {
            // Si no se encontró el producto, mostrar un mensaje de error
            echo "<p>Producto no encontrado.</p>";
        }
    } else {
        // Si no se proporcionó un ID de producto en la URL, mostrar un mensaje de error
        echo "<p>El ID de producto no se proporcionó.</p>";
    }
    ?>
   </div>

   <div style="text-align: center; margin-top: 20px;">
       <a href="index.php" class="back-button">Regresar</a>
   </div>

   <script>
       function validarCantidad(input) {
           // Eliminar los caracteres "." y "-" si se ingresan
           input.value = input.value.replace(/[.-]/g, '');
       }
   </script>