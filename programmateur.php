<?php

if (isset($_POST['add'])) {
    $day = $_POST['day'];
    $time = explode(':', $_POST['hour']);
    $macro = str_pad($_POST['macro'], 2, '0', STR_PAD_LEFT);
    $cron =  "$time[1] $time[0] * * $day echo D$macro# > /tmp/svxlink";
    system("(crontab -l; echo '$cron') | crontab -");
    header('location: /programmateur.php');
    exit(0);
}

if (isset($_POST['delete'])) {
    $cron = $_POST['cron'];
    system("crontab -l | grep -Fv '$cron' | crontab -");
    header('location: /programmateur.php');
    exit(0);
}

require('functions.php');
require('header.php');

$days = [
    "0" => "Lundi", "2" => "Mardi", "3" => "Mercredi", "4" => "Jeudi", "5" => "Vendredi", 
    "6" => "Samedi", "7" => "Dimanche", "*" => "Tous les jours"
];

$crons = trim(shell_exec('crontab -l'));
if (empty($crons)) $crons = [];
else $crons = explode("\n",$crons);
?>

<div class="row">
    <div class="col-md-6">
        <fieldset class="border p-3 rounded">
            <legend class="w-auto mb-3">Programme de la semaine</legend>
            <table class="table text-center">
                <thead>
                    <tr class="d-none d-md-table-row">
                        <th>Jour</th>
                        <th>Heure</th>
                        <th>Macro</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($crons as $cron): ?>
                        <?php $cron = explode(' ', $cron) ?>
                        <tr>
                            <td><?= $days[$cron[4]] ?></td>
                            <td><?= "$cron[1]:$cron[0]" ?></td>
                            <td><?= str_replace(["'", "#"], "", $cron[6]) ?></td>
                            <td>
                                <form action="" method="POST">
                                    <input type="hidden" name="cron" value="<?= implode(' ', $cron) ?>">
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
        <fieldset class="border p-3 rounded">
            <legend class="w-auto mb-3">Ajout d'une programmation</legend>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="day" class="form-label">Jour</label>
                    <select id="day" name="day" class="form-control" required>
                        <option value="*">Tous les jours</option>
                        <option value="1">Lundi</option>
                        <option value="2">Mardi</option>
                        <option value="3">Mercredi</option>
                        <option value="4">Jeudi</option>
                        <option value="5">Vendredi</option>
                        <option value="6">Samedi</option>
                        <option value="7">Dimanche</option>
                    </select>
                </div>
                <div class="form-group mt-4">
                    <label for="hour" class="form-label">Heure</label>
                    <input type="time" id="hour" name="hour" class="form-control" required>
                </div>
                <div class="form-group mt-4">
                    <label for="macro" class="form-label">Macro</label>
                    <input type="number" min="00" max="999" id="macro" name="macro" class="form-control" required>
                </div>
                <button name="add" type="submit" class="btn btn-primary mt-4">Ajouter a la programmation</button>
            </form>
        </fieldset>
    </div>
</div>
<?php require('footer.php') ?>