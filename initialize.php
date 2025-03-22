<?php

require_once('./vendor/autoload.php');

$db = new app\Core\Database();
$conn = $db->getConnection();

// create tables in database
$sqlFile = 'sql/schema.sql';
$sql = file_get_contents($sqlFile);

if ($sql === false) {
    die("Error reading file.");
}

try {
    $conn->exec($sql);
    echo "SQL file executed successfully.";
} catch (PDOException $e) {
    echo "<br>" . $e->getMessage();
}
