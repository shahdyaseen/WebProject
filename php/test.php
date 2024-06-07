<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dynamic Divs with PHP</title>
    <style>
        .box {
            width: 100px;
            height: 100px;
            margin: 10px;
            background-color: #f0f0f0;
            display: inline-block;
            text-align: center;
            line-height: 100px;
            font-family: Arial, sans-serif;
        }
    </style>
</head>
<body>

<?php
$numOfDivs = 10;

for ($i = 1; $i <= $numOfDivs; $i++) {
    echo '<div class="box">Div ' . $i . '</div>';
}
?>

</body>
</html>
