<?php
declare(strict_types=1);

$config = require __DIR__ . '/con_db.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $driver = $config['driver'] ?? 'mysql';
    $host = $config['host'] ?? '127.0.0.1';
    $port = $config['port'] ?? ($driver === 'pgsql' ? 5432 : 3306);
    $database = $config['database'] ?? '';
    $username = $config['username'] ?? '';
    $password = $config['password'] ?? '';
    $charset = $config['charset'] ?? 'utf8mb4';

    if ($driver === 'pgsql') {
        $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $host, $port, $database);
    } else {
        $dsn = sprintf('%s:host=%s;port=%s;dbname=%s;charset=%s', $driver, $host, $port, $database, $charset);
    }

    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $sql = <<<SQL
        SELECT
            r.codigo,
            r.subtipo,
            r.destaque,
            i.link_thumb
        FROM registros r
        LEFT JOIN images i ON i.codigo_reg = r.codigo AND i.flag = 0
        WHERE r.destaque = :destaque
        ORDER BY r.codigo
    SQL;

    $statement = $pdo->prepare($sql);
    $statement->execute(['destaque' => 'Destaque']);

    echo json_encode($statement->fetchAll(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
} catch (Throwable $exception) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Database connection failed.',
        'message' => $exception->getMessage(),
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
