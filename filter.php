<?php
header('Content-Type: application/json');

// Конфигурация базы данных
$db_host = 'localhost';
$db_user = 'root';
$db_pass = ''; // Укажите ваш пароль, если есть
$db_name = 'shop';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $query = isset($_GET['q']) ? trim($_GET['q']) : '';
    
    if (mb_strlen($query) < 3) {
        throw new Exception('Введите минимум 3 символа');
    }
    
    $stmt = $pdo->prepare("SELECT * FROM products WHERE name LIKE :query OR description LIKE :query LIMIT 10");
    $stmt->execute([':query' => "%$query%"]);
    $results = $stmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'count' => count($results),
        'results' => array_map(function($item) {
            return [
                'url' => 'product.php?id='.$item['id'],
                'image' => 'images/'.$item['image'],
                'name' => $item['name'],
                'description' => $item['description'],
                'category' => $item['category'],
                'price' => number_format($item['price'], 0, '', ' ').' ₽'
            ];
        }, $results)
    ]);
    
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Ошибка БД: '.$e->getMessage()
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}