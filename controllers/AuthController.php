
<?php
require_once 'models/usuario.php';
// Gestiona todo lo relacionado con el 
//inicio de sesión, registro y cierre de sesión
// de los usuarios en Tecamochas.
class AuthController {
    private $usuarioModel;

    public function __construct($db) {
        $this->usuarioModel = new Usuario($db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $usuario = $this->usuarioModel->buscarPorEmail($_POST['email']);

            // Validación con password_verify 
            if ($usuario && password_verify($_POST['password'], $usuario['password'])) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nombre'] = $usuario['nombre'];
                header("Location: index.php?accion=catalogo");
                exit();
            } else {
                echo "<script>alert('Datos incorrectos');</script>";
            }
        }
        require_once 'views/login.php';
    }

    public function registro() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // El modelo se encarga de aplicar password_hash() [cite: 31]
            if ($this->usuarioModel->registrar($_POST['nombre'], $_POST['email'], $_POST['password'])) {
                header("Location: index.php?accion=login");
                exit();
            }
        }
        require_once 'views/registro.php';
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?accion=catalogo");
        exit();
    }
}