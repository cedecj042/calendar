<?php
date_default_timezone_set('Asia/Manila');
define('NUM_SEC_DAY', 86400);

//get the currentMonth based on GET method if no query from GET then get the current Date
$currentMonth = isset($_GET['date']) ? intval($_GET['date']) : date('m');
$currentYear = date('Y');

// Ensure $currentMonth is within a valid range (1-12)
if ($currentMonth < 1) {
    $currentMonth = 12; // Set to December if less than 1
    $currentYear--; 
} elseif ($currentMonth > 12) {
    $currentMonth = 1; // Set to January if greater than 12
    $currentYear++; 
}

//Get the name of the month based on $currentMonth
$currentMonthName = date('F', mktime(0, 0, 0, $currentMonth, 1, date('Y')));

function calculateDayofMonth($n)
{
    $currentMonthDate = mktime(0, 0, 0, date($n), date('d'), date('Y'));
    $nextMonthDate = mktime(0, 0, 0, date($n) + 1, date('d'), date('Y'));
    $numDayofCurrentMonth = ($nextMonthDate - $currentMonthDate) / NUM_SEC_DAY;

    return $numDayofCurrentMonth;
}
function getFirstDayOfMonth($n){
    if ($n < 1 || $n > 12) {
        return false;
    }
    $firstDayOfMonth = date('w', strtotime(date("Y-$n-01")));
    return intval($firstDayOfMonth);
}

$previousDays = calculateDayofMonth($currentMonth-1);
$firstcounter = ($previousDays - getFirstDayOfMonth($currentMonth)) + 1;
$counter = 1;
$lastcounter = 1 ;

$days = ['Sun','Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    echo "<div class='container'>";
    echo "<h1>" . $currentMonthName . " " . $currentYear . "</h1>";
    echo "<hr>";
    echo "<table>";
    echo "<thead> <tr>";
    foreach ($days as $day) {
        echo "<th> <h2>" . $day . "</h2></th>";
    }
    echo " </tr></thead>";
    echo " <tbody>";
    for ($i = 0; $i < 6; $i++) {
        echo "<tr>";
        for ($j = 0; $j < 7; $j++) {
            echo "<td>";
            if ($counter === 1) {
                if ($i === 0 && $j == getFirstDayOfMonth($currentMonth)) {
                    echo "<h4>". $counter++;
                }else {
                    echo "<h4 class='extra'>". $firstcounter++;
                }
            }
            else {
                if ($counter <= calculateDayofMonth($currentMonth)) {
                    echo"<h4>". $counter++;
                }else {
                    echo "<h4 class='extra'>". $lastcounter++;
                }
            }
            echo "</h4></td>";
        }
        echo "</tr>";
    }
    echo " </tbody>";
    echo "</table>";
    echo "</div>";
    ?>
    <div class="buttons">
        <form method="GET">
            <input type='text' name='date' hidden value="<?php echo $currentMonth - 1; ?>">
            <button type="submit"><i class="previous"></i></button>
        </form>
        <form method="GET" class="today">
            <input type='text' name='date' hidden value="<?php echo date('m'); ?>">
            <button type="submit">Today</button>
        </form>
        <form method="GET">
            <input type='text' name='date' hidden value="<?php echo $currentMonth + 1; ?>">
            <button type="submit"><i class="next"></i></button>
        </form>
    </div>
</body>

</html>