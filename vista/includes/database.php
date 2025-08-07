<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'cotizaciones');
define('DB_USER', 'admin');
define('DB_PASS', 'admin');
define('DB_CHARSET', 'utf8');

class Database {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        } catch (PDOException $e) {
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    // Método para ejecutar consultas SELECT
    public function query($sql, $params = []) {
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            throw new Exception("Error en consulta: " . $e->getMessage());
        }
    }
    
    // Método para obtener todos los registros
    public function fetchAll($sql, $params = []) {
        return $this->query($sql, $params)->fetchAll();
    }
    
    // Método para obtener un solo registro
    public function fetch($sql, $params = []) {
        return $this->query($sql, $params)->fetch();
    }
    
    // Método para insertar datos
    public function insert($table, $data) {
        $fields = implode(',', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
        
        return $this->connection->lastInsertId();
    }
    
    // Método para actualizar datos
    public function update($table, $data, $where, $whereParams = []) {
        $fields = [];
        foreach (array_keys($data) as $key) {
            $fields[] = "$key = :$key";
        }
        $fields = implode(', ', $fields);
        
        $sql = "UPDATE $table SET $fields WHERE $where";
        $params = array_merge($data, $whereParams);
        
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($params);
    }
    
    // Método para eliminar datos
    public function delete($table, $where, $params = []) {
        $sql = "DELETE FROM $table WHERE $where";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($params);
    }
    
    // Método para obtener el último ID insertado
    public function lastInsertId() {
        return $this->connection->lastInsertId();
    }
    
    // Método para iniciar transacción
    public function beginTransaction() {
        return $this->connection->beginTransaction();
    }
    
    // Método para confirmar transacción
    public function commit() {
        return $this->connection->commit();
    }
    
    // Método para deshacer transacción
    public function rollback() {
        return $this->connection->rollback();
    }
}

// Función auxiliar para obtener la conexión fácilmente
function getDB() {
    return Database::getInstance();
}

// Función para escapar datos de salida (prevenir XSS)
function escape($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Función para generar números de cotización
function generarNumeroCotizacion() {
    $año = date('Y');
    $db = getDB();
    
    // Obtener el último número de cotización del año
    $sql = "SELECT MAX(CAST(SUBSTRING(numero, 10) AS UNSIGNED)) as ultimo_numero 
            FROM cotizaciones 
            WHERE numero LIKE 'COT-$año-%'";
    
    $result = $db->fetch($sql);
    $ultimoNumero = $result['ultimo_numero'] ?? 0;
    $nuevoNumero = $ultimoNumero + 1;
    
    return "COT-$año-" . str_pad($nuevoNumero, 3, '0', STR_PAD_LEFT);
}

// Función para calcular impuestos
function calcularImpuesto($subtotal, $porcentaje = 18) {
    return $subtotal * ($porcentaje / 100);
}

// Función para formatear moneda
function formatearMoneda($cantidad) {
    return '$' . number_format($cantidad, 2);
}
?>
