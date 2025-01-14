<!DOCTYPE html>
<html>
<head>
    <title>Календарь</title>
    <style>
        .calendar {
            border-collapse: collapse;
            margin: 20px;
        }
        .calendar th, .calendar td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        .weekend {
            background-color: #ffebee;
        }
        .holiday {
            background-color: #e8f5e9;
        }
        .controls {
            margin: 20px;
        }
        .controls select {
            padding: 5px;
            margin-right: 10px;
        }
        .controls button {
            padding: 5px 15px;
        }
    </style>
</head>
<body>
    <div class="controls">
        <form method="GET">
            <select name="month">
                <?php
                $months = [
                    1 => 'Январь', 2 => 'Февраль', 3 => 'Март',
                    4 => 'Апрель', 5 => 'Май', 6 => 'Июнь',
                    7 => 'Июль', 8 => 'Август', 9 => 'Сентябрь',
                    10 => 'Октябрь', 11 => 'Ноябрь', 12 => 'Декабрь'
                ];
                foreach ($months as $num => $name) {
                    $selected = ($num == ($_GET['month'] ?? date('n'))) ? 'selected' : '';
                    echo "<option value='$num' $selected>$name</option>";
                }
                ?>
            </select>
            
            <select name="year">
                <?php
                $currentYear = date('Y');
                for ($year = $currentYear - 5; $year <= $currentYear + 5; $year++) {
                    $selected = ($year == ($_GET['year'] ?? $currentYear)) ? 'selected' : '';
                    echo "<option value='$year' $selected>$year</option>";
                }
                ?>
            </select>
            
            <button type="submit">Показать</button>
        </form>
    </div>
    
    <?php
    // Получаем выбранные месяц и год
    $selectedMonth = $_GET['month'] ?? date('n');
    $selectedYear = $_GET['year'] ?? date('Y');
    
    function showCalendar($month = null, $year = null) {
        // Если параметры не заданы, используем текущую дату
        if ($month === null) $month = date('n');
        if ($year === null) $year = date('Y');

        // Массив праздничных дней (можно дополнить)
        $holidays = array(
            '01-01', // Новый год
            '02-23', // День защитника отечества
            '03-08', // Международный женский день
            '05-01', // Праздник весны и труда
            '05-09', // День победы
            '06-12', // День России
            '11-04'  // День народного единства
        );

        $firstDay = mktime(0, 0, 0, $month, 1, $year);
        $daysInMonth = date('t', $firstDay);
        $dayOfWeek = date('w', $firstDay);
        $monthName = date('F Y', $firstDay);

        echo "<h2>$monthName</h2>";
        echo "<table class='calendar'>";
        echo "<tr>
                <th>Пн</th>
                <th>Вт</th>
                <th>Ср</th>
                <th>Чт</th>
                <th>Пт</th>
                <th>Сб</th>
                <th>Вс</th>
              </tr>";

        // Корректировка для понедельника как первого дня недели
        $dayOfWeek = ($dayOfWeek == 0) ? 6 : $dayOfWeek - 1;

        echo "<tr>";
        // Пустые ячейки до первого дня месяца
        for ($i = 0; $i < $dayOfWeek; $i++) {
            echo "<td></td>";
        }

        // Заполнение дней
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $currentDayOfWeek = ($dayOfWeek + $day - 1) % 7;
            $date = sprintf("%02d-%02d", $month, $day);
            
            $class = '';
            if ($currentDayOfWeek >= 5) { // Суббота и воскресенье
                $class = 'weekend';
            }
            if (in_array($date, $holidays)) {
                $class = 'holiday';
            }

            echo "<td class='$class'>$day</td>";

            if ($currentDayOfWeek == 6) {
                echo "</tr>";
                if ($day != $daysInMonth) {
                    echo "<tr>";
                }
            }
        }

        // Добавление пустых ячеек в конце
        if ($currentDayOfWeek != 6) {
            for ($i = $currentDayOfWeek + 1; $i <= 6; $i++) {
                echo "<td></td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }

    showCalendar($selectedMonth, $selectedYear);
    ?>
</body>
</html> 