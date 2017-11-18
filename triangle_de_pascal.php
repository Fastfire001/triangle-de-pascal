<?php
//récupération de la profondeur
$depth = '';
$depthvalue = $_POST ;
foreach ($depthvalue as $data){
    $depth = $data;
}
$formvalue = $depth;
if ($depth > 30){
    $depth = 30;
}
//fonction de calcul de la ligne suivante: $array = ligne précédente
function pascal($array){
    //variable tmp
    $tablecellfirst = [1];
    $tablecelllast = [1];
    $a = null;
    $b = null;
    $arrayTmp = [];
    //calcul ligne
    foreach ($array as $value) {
        if ($a == null) {
            $a = $value;
        } elseif ($b == null) {
            $b = $value;
        }
        if ($a !== null and $b !== null) {
            $arrayTmp[] = $a + $b;
            $a = $b;
            $b = null;
        }
    }
    //ajout des "1"
    $array = array_merge($tablecellfirst, $arrayTmp, $tablecelllast);
    //renvoie de la ligne
    return $array;
}
//affichage : $array = ligne à afficher, $line = numero de la ligne à afficher, $depth = profondeur du triangle
function display($array, $line, $depth){
    echo "<tr>";
    $colspan = ($depth * $depth) / ($line + 1);
    foreach ($array as $value){
        echo "<td colspan='$colspan'>$value</td>";
    }
    echo "</tr>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Triangle de pascal</title>
    <meta name="author" content="Maxime Maréchal">
    <meta name="description" content="Triangle de Pascal">
    <style>
        table{
            border-collapse: collapse;
            display: table;
            border-spacing: 2px;
            border-color: grey;
            text-align: center;
        }
        td{
            text-align: center;
            padding: 0px 5px;
            border: 1px solid black;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<form action="triangle_de_pascal.php" method="POST">
    <label for="depth">Profondeur : </label>
    <input type="number" name="depthvalue" id="depth" min="1" max="100" value="<?php echo $formvalue?>">
    <input type="submit">
</form>
<?php

if ($depth == 0){
    //Nothing
}
else{
    echo "<h1>Triangle de profondeur $depth</h1>";
    echo "<table>";
    $array = [1];
    for ($line = 0; $line < $depth; $line++) {
        display($array, $line, $depth);  //affichage ligne
        $array = pascal($array);        //calcul ligne suivante
    }
}
echo "</table>";

?>

</body>
</html>