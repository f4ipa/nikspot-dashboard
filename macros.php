<?php

$svxlink = "/etc/svxlink/svxlink.conf";

if (isset($_POST['add'])) {
    extract($_POST);
    system("sed -i '/\[Macros\]/a $macro=:##$node#' $svxlink");
    header('location: /macros.php');
    exit(0);
}

if (isset($_POST['delete'])) {
    $macro = $_POST['macro'];
    system("sed -i '/$macro/d' $svxlink");
    header('location: /macros.php');
    exit(0);
}

if (isset($_POST['restart'])) {
    system("service svxlink restart");
    header('location: /macros.php');
    exit(0);
}


require('functions.php');
require('header.php');

$content = file_get_contents($svxlink);
preg_match_all("/(\d{2,3})=:##(\d{4,6})#/", $content, $matches);
$macros = array_combine($matches[1], $matches[2]);
ksort($macros);
?>

<div class="row">
    <div class="col-md-6">
        <fieldset class="border p-3 rounded">
            <legend class="w-auto mb-3">Liste des macros</legend>
            <table class="table text-center">
                <thead>
                    <tr class="d-none d-md-table-row">
                        <th>Macro</th>
                        <th>Station</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($macros as $macro => $node): ?>
                        <tr>
                            <td><?= $macro ?></td>
                            <td><?= $node ?></td>
                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" name="macro" value="<?= "$macro=:##$node#" ?>">
                                    <button name="delete" type="submit" class="d-none d-lg-inline btn btn-sm btn-danger">🗑️ SUPPRIMER</button>
                                    <button name="delete" type="submit" class="d-lg-none btn btn-sm btn-danger">🗑️</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </fieldset>
    </div>
    <div class="col-md-6">
        <fieldset class="border p-3 rounded sticky-top">
            <legend class="w-auto mb-3">Ajout d'une macro</legend>
            <form action="" method="POST">
                <div class="form-group mt-4">
                    <label for="macro" class="form-label">Macro</label>
                    <input type="number" min="00" max="999" id="macro" name="macro" class="form-control" required>
                </div>
                <div class="form-group mt-4">
                    <label for="node" class="form-label">Station</label>
                    <input type="number" min="1000" max="999999" id="node" name="node" class="form-control" required>
                </div>
                <button name="add" type="submit" class="w-100 btn btn-primary mt-4">Ajouter a la programmation</button>
            </form>
            <form action="" method="POST">
                <button name="restart" type="submit" class="w-100 btn btn-warning mt-4">Redémarrer SvxLink</button>
            </form>

        </fieldset>
    </div>
</div>
<?php require('footer.php') ?>