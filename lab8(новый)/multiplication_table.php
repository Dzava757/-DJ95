<!DOCTYPE html>
<html>
<head>
    <title>Таблица умножения</title>
    <style>
        table {
            border-collapse: collapse;
            margin: 20px;
        }
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            padding: 8px;
        }
    </style>
</head>
<body>
    <h2>Таблица умножения</h2>
    <table>
        <?php
        // Заголовок таблицы
        echo "<tr><th>×</th>";
        for ($i = 0; $i <= 10; $i++) {
            echo "<th>$i</th>";
        }
        echo "</tr>";

        // Содержимое таблицы
        for ($i = 0; $i <= 10; $i++) {
            echo "<tr>";
            echo "<th>$i</th>";
            for ($j = 0; $j <= 10; $j++) {
                echo "<td>" . ($i * $j) . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html> 