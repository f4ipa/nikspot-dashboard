<?php

if (!empty($_POST)) {
    shell_exec('amixer sset "Line Out" ' . $_POST['output']);
    shell_exec('amixer sset "Mic1" ' . $_POST['input']);
    shell_exec('alsactl store');
}

$output = shell_exec('amixer sget "Line Out" |tail -n1');
$output = explode(" ", $output)[5];
$input = shell_exec('amixer sget "Mic1" |tail -n1');
$input = explode(" ", $input)[5];

require('header.php');
?>

<form action="" method="POST">
    <h4 class="mb-3">Niveau de la sortie audio</h4>
    <input type="range" class="form-range mb-4" name="output" min="0" max="31" step="1" value="<?=$output?>">

    <h4 class="mb-3">Niveau de l'entrée audio</h4>
    <input type="range" class="form-range mb-4" name="input" min="0" max="7" step="1" value="<?=$input?>">

    <button type="submit" class="btn btn-primary">Enrgistrer</button>
</form>
<?php require('footer.php') ?>
