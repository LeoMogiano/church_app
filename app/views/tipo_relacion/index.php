


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iglesia App</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora&display=swap">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/tipo_relacion.css">
</head>

<body>
    <header>
        <div class="container ">
            <h1>Iglesia App</h1>
        </div>
    </header>
    <nav>
        <div class="container">
            <ul>
                <li><a href="/">Inicio</a></li>
                <li><a href="/tipo_relacion">Tipo Relación</a></li>
                <li><a href="/cargos">Cargos</a></li>
                <li><a href="/usuarios">Usuarios</a></li>
                <li><a href="/eventos">Eventos</a></li>
                <li><a href="/relaciones">Relaciones</a></li>
                <li><a href="/ingresos">Ingresos</a></li> 
            </ul>
        </div>
    </nav>
    <main>
        <div class="container">
            <h2>Nuevo Tipo de Relación</h2>
            <div id='form_tipo'>
            <form action="/tipo_relacion" method="post">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label for="nombre">Nombres</label>
                        <input name="nombre" type="text" id="nombre" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 d-flex justify-content-end">
                        <button  class="add-button" type="submit" >Agregar</button>
                        <!-- <input type="reset" value="Reset"> -->
                    </div>
                </div>
            </form>
            </div>
            
            <h1><?= $title ?></h1>
            <table>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombres</th>
                    </tr>
                </thead>
                <?= $tbody ?>
            </table>
        </div>
    </main>
    <footer>
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> IglesiaApp</p>
        </div>
    </footer>
    <script>
        function confirmarEliminar(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este tipo relaciòn?')) {
                // Si el usuario confirma, enviar el formulario de eliminación
                document.querySelector('form[action="/eliminar_tipo_relacion"] input[name="id"]').value = id;
                document.querySelector('form[action="/eliminar_tipo_relacion"]').submit();
            }
        }
    </script>
</body>

</html>
