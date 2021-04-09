<?php
ini_set('auto_detect_line_endings', true);
$fopen = fopen('us-500/us-500.csv', 'r'); // Yung file driectory ng CSV file
$records = [];
while(!feof($fopen)){
    $ar=fgetcsv($fopen);
    $records[] = $ar ;
}
fclose($fopen);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV</title>
</head>
<body>
    <?php for($i = 0; $i < count($records); $i++): ?>
        <?php if($records[$i]): ?>
            <h1>Record <?= $i + 1; ?></h1>
            <ul>
                <li><?= $records[$i][0] ?></li>
                <li><?= $records[$i][1] ?></li>
                <li><?= $records[$i][2] ?></li>
                <li><?= $records[$i][3] ?></li>
                <li><?= $records[$i][4] ?></li>
                <li><?= $records[$i][5] ?></li>
                <li><?= $records[$i][6] ?></li>
                <li><?= $records[$i][7] ?></li>
                <li><?= $records[$i][8] ?></li>
                <li><?= $records[$i][9] ?></li>
                <li><?= $records[$i][10] ?></li>
                <li><?= $records[$i][11] ?></li>
            </ul>
        <?php endif; ?>
    <?php endfor; ?>
</body>
</html>
