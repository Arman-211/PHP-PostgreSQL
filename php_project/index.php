<?php
$host = 'localhost';
$dbname = 'postgres';
$username = 'user';
$password = 'password';

try {
    $dsn = "pgsql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);


    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql1 = "SELECT u.*
            FROM users u
            INNER JOIN users inviter ON u.invited_by_user_id = inviter.id
            WHERE u.posts_qty > inviter.posts_qty";

    $stmt1 = $pdo->query($sql1);

    echo "<h2>Результаты первого запроса:</h2>";
    echo "<ul>";
    while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>";
        foreach ($row as $key => $value) {
            echo "<strong>$key:</strong> $value, ";
        }
        echo "</li>";
    }
    echo "</ul>";

    $sql2 = "SELECT u.*
            FROM users u
            JOIN (
                SELECT group_id, MAX(posts_qty) AS max_posts
                FROM users
                GROUP BY group_id
            ) max_posts_per_group ON u.group_id = max_posts_per_group.group_id AND u.posts_qty = max_posts_per_group.max_posts";

    // Подготовка и выполнение второго запроса
    $stmt2 = $pdo->query($sql2);

    // Вывод результатов второго запроса
    echo "<h2>Результаты второго запроса:</h2>";
    echo "<ul>";
    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>";
        foreach ($row as $key => $value) {
            echo "<strong>$key:</strong> $value, ";
        }
        echo "</li>";
    }
    echo "</ul>";

    // Третий запрос
    $sql3 = "SELECT group_id, COUNT(*) AS user_count
             FROM users
             GROUP BY group_id
             HAVING COUNT(*) > 10000";

    // Подготовка и выполнение третьего запроса
    $stmt3 = $pdo->query($sql3);

    // Вывод результатов третьего запроса
    echo "<h2>Результаты третьего запроса:</h2>";
    echo "<ul>";
    while ($row = $stmt3->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>";
        foreach ($row as $key => $value) {
            echo "<strong>$key:</strong> $value, ";
        }
        echo "</li>";
    }
    echo "</ul>";

    // Четвертый запрос
    $sql4 = "SELECT u.*
             FROM users u
             INNER JOIN users inviter ON u.invited_by_user_id = inviter.id
             WHERE u.group_id <> inviter.group_id";

    // Подготовка и выполнение четвертого запроса
    $stmt4 = $pdo->query($sql4);

    // Вывод результатов четвертого запроса
    echo "<h2>Результаты четвертого запроса:</h2>";
    echo "<ul>";
    while ($row = $stmt4->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>";
        foreach ($row as $key => $value) {
            echo "<strong>$key:</strong> $value, ";
        }
        echo "</li>";
    }
    echo "</ul>";

    // Пятый запрос
    $sql5 = "SELECT u.group_id, g.name, MAX(u.posts_qty) AS max_posts
             FROM users u
             JOIN groups g ON u.group_id = g.id
             GROUP BY u.group_id, g.name";

    // Подготовка и выполнение пятого запроса
    $stmt5 = $pdo->query($sql5);

    // Вывод результатов пятого запроса
    echo "<h2>Результаты пятого запроса:</h2>";
    echo "<ul>";
    while ($row = $stmt5->fetch(PDO::FETCH_ASSOC)) {
        echo "<li>";
        foreach ($row as $key => $value) {
            echo "<strong>$key:</strong> $value, ";
        }
        echo "</li>";
    }
    echo "</ul>";

}  catch (PDOException $e) {
    // Обработка ошибок подключения к базе данных
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}

