<?php
ini_set('auto_detect_line_endings', true);
$fopen = fopen('us-500.csv', 'r');
$records = [];
while (!feof($fopen)) {
    $ar=fgetcsv($fopen);
    $records[] = $ar ;
}
fclose($fopen);
$pages = count($records) / 50;
if(@$_GET['page']) {
    $current_page = $_GET['page'];
    $item_page_from = $current_page == 1 ? 1 : ($current_page * 50) - 49;
    $item_page_to = $item_page_from + 50;
} else {
    $item_page_from = 1;
    $item_page_to = 50;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://bootswatch.com/4/sketchy/bootstrap.min.css" rel="stylesheet" />
    <title>CSV</title>
    <style>
        .wrapper {
            width: 1200px;
            margin-left: 250px;
            padding: 50px 0;
        }
        .pagination {
            margin-left: 470px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th><?= $records[0][0] ?></th>
                    <th><?= $records[0][1] ?></th>
                    <th><?= $records[0][2] ?></th>
                    <th><?= $records[0][3] ?></th>
                    <th><?= $records[0][4] ?></th>
                    <th><?= $records[0][5] ?></th>
                    <th><?= $records[0][6] ?></th>
                    <th><?= $records[0][7] ?></th>
                    <th><?= $records[0][8] ?></th>
                    <th><?= $records[0][9] ?></th>
                    <th><?= $records[0][10] ?></th>
                    <th><?= $records[0][11] ?></th>
                </tr>
            </thead>
            <tbody>
                <?php for ($i = $item_page_from; $i < $item_page_to; $i++): ?>
                    <?php if ($records[$i]): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $records[$i][0] ?></td>
                            <td><?= $records[$i][1] ?></td>
                            <td><?= $records[$i][2] ?></td>
                            <td><?= $records[$i][3] ?></td>
                            <td><?= $records[$i][4] ?></td>
                            <td><?= $records[$i][5] ?></td>
                            <td><?= $records[$i][6] ?></td>
                            <td><?= $records[$i][7] ?></td>
                            <td><?= $records[$i][8] ?></td>
                            <td><?= $records[$i][9] ?></td>
                            <td><?= $records[$i][10] ?></td>
                            <td><?= $records[$i][11] ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endfor; ?>
            </tbody>
        </table>
        <div class="text-center">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="index.php?page=<?= $_GET['page'] == 1 ? $_GET['page'] : $_GET['page'] - 1 ?>">&laquo;</a>
                </li>
                <?php for($i = 1; $i <= $pages; $i++): ?>
                    <li class="page-item <?= @$_GET['page'] == $i ? "active" : "" ?>">
                        <a class="page-link" href="index.php?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item">
                    <a class="page-link" href="index.php?page=<?= $_GET['page'] == intval($pages) ? $_GET['page'] : $_GET['page'] + 1 ?>">&raquo;</a>
                </li>
            </ul>
        </div>
    </div>
</body>
</html>
