<?php

$dbPath = 'D:\\07_ProjectKuliah\\yuwaraja2026\\database\\database.sqlite';
$schemaFile = 'D:\\07_ProjectKuliah\\yuwaraja2026\\database\\schema\\mysql-schema.sql';

$pdo = new PDO('sqlite:' . $dbPath);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = file_get_contents($schemaFile);

// Remove MySQL SET statements and version comments
$sql = preg_replace('/\/\*!\d+\s+[^*]+\*\//', '', $sql);
$sql = preg_replace('/SET\s+[^;]+;/i', '', $sql);

// Replace MySQL-specific column definitions
$sql = preg_replace('/`(\w+)`\s+BIGINT\s+UNSIGNED\s+NOT\s+NULL\s+AUTO_INCREMENT/i', '"$1" INTEGER PRIMARY KEY AUTOINCREMENT', $sql);
$sql = preg_replace('/`(\w+)`\s+INT\s+UNSIGNED\s+NOT\s+NULL\s+AUTO_INCREMENT/i', '"$1" INTEGER PRIMARY KEY AUTOINCREMENT', $sql);
$sql = preg_replace('/`(\w+)`\s+BIGINT UNSIGNED/i', '"$1" INTEGER', $sql);
$sql = preg_replace('/`(\w+)`\s+INT UNSIGNED/i', '"$1" INTEGER', $sql);
$sql = preg_replace('/`(\w+)`\s+INT\s+NOT\s+NULL/i', '"$1" INTEGER NOT NULL', $sql);
$sql = preg_replace('/`(\w+)`\s+INT\s+NOT/i', '"$1" INTEGER NOT', $sql);
$sql = preg_replace('/`(\w+)`\s+INT\b/i', '"$1" INTEGER', $sql);
$sql = preg_replace('/`(\w+)`\s+VARCHAR\(\d+\)/i', '"$1" TEXT', $sql);
$sql = preg_replace('/ENUM\([^)]+\)/i', 'TEXT', $sql);
$sql = preg_replace('/`(\w+)`\s+DATETIME/i', '"$1" TEXT', $sql);
$sql = preg_replace('/`(\w+)`\s+TIMESTAMP/i', '"$1" TEXT', $sql);
$sql = preg_replace('/`(\w+)`\s+DATE\b/i', '"$1" TEXT', $sql);
$sql = preg_replace('/`(\w+)`\s+TIME\b/i', '"$1" TEXT', $sql);
$sql = preg_replace('/`(\w+)`\s+MEDIUMTEXT/i', '"$1" TEXT', $sql);
$sql = preg_replace('/`(\w+)`\s+LONGTEXT/i', '"$1" TEXT', $sql);
$sql = preg_replace('/`(\w+)`\s+JSON\b/i', '"$1" TEXT', $sql);

// Backtick to double-quote
$sql = preg_replace('/`/', '"', $sql);

// Remove MySQL engine/COLLATE suffixes
$sql = preg_replace('/ENGINE=InnoDB/i', '', $sql);
$sql = preg_replace('/CHARACTER SET \w+ COLLATE \w+/i', '', $sql);
$sql = preg_replace('/CHARSET=\w+/i', '', $sql);

// Remove DEFAULT CHARSET stuff
$sql = preg_replace('/DEFAULT CHARSET=\w+/i', '', $sql);

// Split by statements (handling semicolons inside strings roughly)
$statements = preg_split('/;\s*(?=CREATE|DROP|INSERT|KEY|UNIQUE|CONSTRAINT|PRIMARY|ALTER|$)/', $sql, -1, PREG_SPLIT_NO_EMPTY);

$count = 0;
$errors = 0;
foreach ($statements as $stmt) {
    $stmt = trim($stmt);
    if (empty($stmt)) continue;
    // Ensure statement ends with semicolon
    if (substr($stmt, -1) !== ';') {
        $stmt .= ';';
    }
    try {
        $pdo->exec($stmt);
        $count++;
    } catch (Exception $e) {
        $errors++;
        echo "ERROR: " . $e->getMessage() . "\n";
        echo "STMT: " . substr($stmt, 0, 200) . "\n\n";
    }
}

echo "Done. Executed: $count statements, Errors: $errors\n";
