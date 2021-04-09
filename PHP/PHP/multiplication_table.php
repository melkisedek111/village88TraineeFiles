<?php

function multiplication_table()
{
    $html = "<table><tbody>";
    for ($i=1; $i < 10; $i++) {
        if ($i === 1) {
            $html .= "<tr>";
        }
        for ($x=1; $x < 10; $x++) {
            if ($x === 1 && $i === 1) {
                $html .= "<td></td>";
            }
            if ($i === 1) {
                $html .= "<td>$x</td>";
            }
        }
        if ($i === 1) {
            $html .= "</tr>";
        }
        $html .= "<tr>";
        for ($x=1; $x < 10; $x++) {
            if ($x === 1) {
                $html .= "<td>$i</td>";
            }
            $html .= "<td>".$i * $x."</td>";
        }
        $html .= "</tr>";
    }
    $html .= "</tbody></table>";
    echo $html;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multiplication Table</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        table{
            margin: 100px;
            background-color: black;
        }
        tr:nth-child(even) {
            background-color: gray !important;
        }
        tr:nth-child(odd) {
            background-color: white !important;
        }
        tr td:nth-child(1), tr:nth-child(1){
            font-weight: bolder;
            font-size: 25px;
        }
        td {
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php multiplication_table(); ?>

    <table>
        <tbody>
            <?php for($i = 1; $i <= 9; $i++): ?>
                <tr>
                    <td><?= $i?></td>
                    <td><?= $i*1 ?></td>
                    <td><?= $i*2 ?></td>
                    <td><?= $i*3 ?></td>
                    <td><?= $i*4 ?></td>
                    <td><?= $i*5 ?></td>
                    <td><?= $i*6 ?></td>
                    <td><?= $i*7 ?></td>
                    <td><?= $i*8 ?></td>
                    <td><?= $i*9 ?></td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</body>
</html>