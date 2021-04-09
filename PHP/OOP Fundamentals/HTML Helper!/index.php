<?php

class HTML_Helper
{
    public $headers;
    public $table_data;
    public $arrays;
    public $tag_type;
    public function __construct($arrays, $type = null)
    {
        if ($type == "table") {
            foreach ($arrays as $array) {
                foreach ($array as $key => $_) {
                    $this->headers[] = $key;
                }
                break;
            }
            $this->table_data = $arrays;
        }
        $this->tag_type = $type;
        $this->table_data = $arrays;
    }

    public function print_table($class = "table")
    {
        if($this->tag_type === "table") {
            $HTML_table = "<table class='$class'><thead class='table-dark'><tr>";
            foreach ($this->headers as $headers) {
                $HTML_table .= "<th>$headers</th>";
            }
            $HTML_table .= "</tr></thead><tbody>";
            foreach($this->table_data as $tbody) {
                $HTML_table .= "<tr>";
                foreach($tbody as $td) {
                    $HTML_table .= "<td>$td</td>";
                }
                $HTML_table .= "</tr>";
            }
            $HTML_table .= "</tbody></table>";
            return $HTML_table;
        }
        return "Invalid Tag Format";
    }

    public function print_select($class, $name) {
        if($this->tag_type == "select") {
            $HTML_select = "<select name='$name' class='$class'>
            <option value=''>Please select</option>
            ";
            foreach($this->table_data as $data) {
                $HTML_select .= "<option value='$data'>$data</option>";
            }
            $HTML_select .= "</select>";
            return $HTML_select;
        }
        return "Invalid Tag Format";
    }
}

$table_data = [
    ["first_name" => "John", "last_name" => "Doe", "nick_name" => "Dough"],
    ["first_name" => "Melvin", "last_name" => "Smith", "nick_name" => "Melvs"],
    ["first_name" => "Jane", "last_name" => "Rojas", "nick_name" => "Jan"],
    ["first_name" => "Michael", "last_name" => "Choi", "nick_name" => "Sensei"],
    ["first_name" => "Kim", "last_name" => "Lee", "nick_name" => "Kil"],
    ["first_name" => "Greg", "last_name" => "Joerge", "nick_name" => "Gr"],
];
$select_data = ['CA', 'NY', 'PH'];
$table = new HTML_Helper($table_data, "table");
$select = new HTML_Helper($select_data, "select");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://bootswatch.com/4/lux/bootstrap.min.css" rel="stylesheet" />
    <title>HTML_Helper</title>
</head>
<body>
    <div class="container">
        <?= $table->print_table("table table-hover"); ?>
        <?= $select->print_select("form-control", "select"); ?>
    </div>
</body>
</html>