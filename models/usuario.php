<?php
class Usuario {
    private $db;
    public function __construct($conexion) { $this->db = $conexion; }

    // Crea un nuevo usuario. Encripta la contraseña con password_hash() antes de guardarla
    public function registrar($nombre, $email, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT); // Método obligatorio [cite: 22]
        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nombre, $email, $passwordHash]);
    }
// Busca un usuario por su correo electrónico. Retorna todos sus datos o false si no existe
    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>