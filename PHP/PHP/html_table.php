<?php
$users = array(
    array('first_name' => 'Michael', 'last_name' => 'Choi'),
    array('first_name' => 'John', 'last_name' => 'Supsupin'),
    array('first_name' => 'Mark', 'last_name' => 'Guillen'),
    array('first_name' => 'KB', 'last_name' => 'Tonel'),
    array('first_name' => 'Jake', 'last_name' => 'Smith'),
    array('first_name' => 'Brad', 'last_name' => 'Johnson'),
    array('first_name' => 'Aileen', 'last_name' => 'Mores'),
    array('first_name' => 'Yami', 'last_name' => 'Kazaki'),
    array('first_name' => 'Asta', 'last_name' => 'Darkmoore'),
    array('first_name' => 'Carina', 'last_name' => 'San Jose'),
    array('first_name' => 'Kimberly', 'last_name' => 'Pangan'),
    array('first_name' => 'Camille', 'last_name' => 'Roxas'),
    array('first_name' => 'Jack', 'last_name' => 'Daniels'),
    array('first_name' => 'Angelika', 'last_name' => 'Yap'),
    array('first_name' => 'Yuri', 'last_name' => 'Kanao'),
 );
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>HTML Table</title>
     <style>
         body {
             font-family: 'Arial';
         }
         table {
        border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 5px;
        }
        tbody tr:nth-child(5n) {
            color: white;
            background-color: black;
        }
     </style>
 </head>
 <body>
    <table>
        <thead>
            <tr>
                <th>User#</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Full Name</th>
                <th>Full Name in upper case</th>
                <th>length of full name (without spaces)</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i=0; $i < count($users) ; $i++): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><?= $users[$i]['first_name'] ?></td>
                    <td><?= $users[$i]['last_name'] ?></td>
                    <td><?= $users[$i]['first_name'] . ' ' . $users[$i]['last_name'] ?></td>
                    <td><?= strtoupper($users[$i]['first_name'] . ' ' . $users[$i]['last_name']) ?></td>
                    <td><?= strlen($users[$i]['first_name'] . '' . $users[$i]['last_name']) ?></td>
                </tr>
            <?php endfor;?>
        </tbody>
    </table>
 </body>
 </html>