<?php
require_once('../app/controllers/CHome.php');
require_once('../app/controllers/CTipoRelacion.php');
require_once('../app/controllers/CCargo.php');
require_once('../app/controllers/CEvento.php');
require_once('../app/controllers/CUsuario.php');
require_once('../app/controllers/CRelacion.php');
require_once('../app/controllers/CIngreso.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/') {
    $home = new CHome();
    $home->index();
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/tipo_relacion') {
    $tipo_relacion = new CTipoRelacion();
    $tipo_relacion->mostrarTipoRelacionC();
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/tipo_relacion') {
    $tipo_relacion = new CTipoRelacion();
    
    $tipo_relacion->agregarTipoRelacionC($_POST['nombre']);
    
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eliminar_tipo_relacion') {
    $categoria = new CTipoRelacion();
    $categoria->eliminarTipoRelacionC($_POST['id']);
    // Puedes realizar una redirección o mostrar un mensaje de confirmación después de la eliminación.
    return;
}

if($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/editar_tipo_relacion\?id=\d+/', $_SERVER['REQUEST_URI'])) {
    
    $params = $_GET;
    $id = $params['id'];

    $categoria = new CTipoRelacion();
    $categoria->updateEstudiante($id);
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/actualizar_tipo_relacion') {
    $categoria = new CTipoRelacion();
    $categoria->editarTipoRelacionC($_POST['id'], $_POST['nombre']);
        
    return;
}



if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/cargos') { // Cambiado a '/cargos'
    $cargo = new CCargo(); 
    $cargo->mostrarCargosC(); // Cambiado a mostrarCargosC
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/cargos') { // Cambiado a '/cargos'
    $cargo = new CCargo(); 
    
    $cargo->agregarCargoC($_POST['nombre'], $_POST['descripcion']); // Cambiado a agregarCargoC
    
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eliminar_cargo') { // Cambiado a '/eliminar_cargo'
    $cargo = new CCargo(); 
    $cargo->eliminarCargoC($_POST['id']); // Cambiado a eliminarCargoC
    // Puedes realizar una redirección o mostrar un mensaje de confirmación después de la eliminación.
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/editar_cargo\?id=\d+/', $_SERVER['REQUEST_URI'])) { // Cambiado a '/editar_cargo'
    
    $params = $_GET;
    $id = $params['id'];

    $cargo = new CCargo(); 
    $cargo->updateCargoC($id); // Cambiado a mostrarFormularioEdicionC
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/actualizar_cargo') { 
    $cargo = new CCargo(); 
    $cargo->editarCargoC($_POST['id'], $_POST['nombre'], $_POST['descripcion']); // Cambiado a editarCargoC
        
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/usuarios') { // Cambiado a '/cargos'
    $cargo = new CUsuario(); 
    $cargo->mostrarUsuariosC(); 
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/usuarios') { 
    $cargo = new CUsuario(); 
    
    $cargo->agregarUsuarioC($_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['ci'], $_POST['cargo']); // Cambiado a agregarCargoC
    
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eliminar_usuario') { // Cambiado a '/eliminar_cargo'
    $cargo = new CUsuario(); 
    $cargo->eliminarUsuarioC($_POST['id']); // Cambiado a eliminarCargoC
    // Puedes realizar una redirección o mostrar un mensaje de confirmación después de la eliminación.
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/editar_usuario\?id=\d+/', $_SERVER['REQUEST_URI'])) { // Cambiado a '/editar_cargo'
    
    $params = $_GET;
    $id = $params['id'];

    $cargo = new CUsuario(); 
    $cargo->updateUsuarioC($id); // Cambiado a mostrarFormularioEdicionC
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/actualizar_usuario') { // Cambiado a '/actualizar_cargo'
    $cargo = new CUsuario(); 
    $cargo->editarUsuarioC($_POST['id'], $_POST['nombre'], $_POST['apellido'], $_POST['email'], $_POST['ci'], $_POST['cargo']); // Cambiado a editarCargoC
        
    return;
}


if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/eventos') {
    $evento = new CEvento();
    $evento->mostrarEventosC();
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eventos') {
    $evento = new CEvento();
    $evento->agregarEventoC($_POST['nombre'], $_POST['fecha'], $_POST['descripcion'], $_POST['usuario_id']);
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eliminar_evento') {
    $evento = new CEvento();
    $evento->eliminarEventoC($_POST['id']);
    // Puedes realizar una redirección o mostrar un mensaje de confirmación después de la eliminación.
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/editar_evento\?id=\d+/', $_SERVER['REQUEST_URI'])) {
    $params = $_GET;
    $id = $params['id'];
    $evento = new CEvento();
    $evento->updateEventoC($id);
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/actualizar_evento') {
    $evento = new CEvento();
    $evento->editarEventoC($_POST['id'], $_POST['nombre'], $_POST['fecha'], $_POST['descripcion'], $_POST['usuario_id']);
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/relaciones') {
    $relacion = new CRelacion();
    $relacion->mostrarRelacionesC();
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/relaciones') {
    $relacion = new CRelacion();
    $relacion->agregarRelacionC($_POST['usuarioA'], $_POST['usuarioB'], $_POST['tipoRelacionA'], $_POST['tipoRelacionB']);
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eliminar_relacion') {
    $relacion = new CRelacion();
    $relacion->eliminarRelacionC($_POST['id']);
    // Puedes realizar una redirección o mostrar un mensaje de confirmación después de la eliminación.
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/editar_relacion\?id=\d+/', $_SERVER['REQUEST_URI'])) {
    $params = $_GET;
    $id = $params['id'];
    $relacion = new CRelacion();
    $relacion->updateRelacionC($id);
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/actualizar_relacion') {
    $relacion = new CRelacion();
    $relacion->editarRelacionC($_POST['id'], $_POST['usuarioA'], $_POST['usuarioB'], $_POST['tipoRelacionA'], $_POST['tipoRelacionB']);
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_SERVER['REQUEST_URI'] == '/ingresos') {
    $ingreso = new CIngreso();
    $ingreso->mostrarIngresosC();
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/ingresos') {
    $ingreso = new CIngreso();
    $ingreso->agregarIngresoC($_POST['tipoIngreso'], $_POST['monto'], $_POST['evento_id']);
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/eliminar_ingreso') {
    $ingreso = new CIngreso();
    $ingreso->eliminarIngresoC($_POST['id']);
    // Puedes realizar una redirección o mostrar un mensaje de confirmación después de la eliminación.
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && preg_match('/\/editar_ingreso\?id=\d+/', $_SERVER['REQUEST_URI'])) {
    $params = $_GET;
    $id = $params['id'];
    $ingreso = new CIngreso();
    $ingreso->updateIngresoC($id);
    return;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SERVER['REQUEST_URI'] == '/actualizar_ingreso') {
    $ingreso = new CIngreso();
    $ingreso->editarIngresoC($_POST['id'], $_POST['tipoIngreso'], $_POST['monto'], $_POST['evento_id']);
    return;
}






