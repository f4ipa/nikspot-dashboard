<?php
require('header.php');

if (isset($_POST['action']) && $_POST['action'] == 'scan') {
    $networks = shell_exec('nmcli -t -f bars,ssid device wifi list');
    $networks = explode(PHP_EOL, $networks);    
}

if (isset($_POST['action']) && $_POST['action'] == 'connect') {
    $ssid = $_POST['ssid'];
    $pass = $_POST['pass'];
    shell_exec("nmcli device wifi connect '$ssid' password '$pass'");
    sleep(2);
    header('location: wifi.php');
}


if (isset($_POST['action']) && $_POST['action'] == 'disconnect') {
    $ssid = trim($_POST['ssid']);
    shell_exec("nmcli connection delete '$ssid'");
    sleep(3);
    header('location: wifi.php');
}


$connected = trim(shell_exec('iwgetid -r')) ?? 'aucun';
?>

<?php if (!empty($connected)): ?>
    <h4 class="mb-3">Réseau wifi connecté</h4>    
    <div class="mb-3 ml-1">
        <?= $connected ?>
    </div>        
    <form action="" method="POST">
        <input type="hidden" name="ssid" value="<?=$connected?>">
        <button name="action" value="disconnect" class="btn btn-danger" type="submit">Se déconnecter</button>
    </form>
    <hr class="mb-4">
<?php endif ?>

<h4 class="mb-3">Connexion à un réseau wifi</h4>
<form action="" method="POST" class="mb-3">
    <button class="btn btn-primary" name="action" value="scan">
        Actualiser la liste des réseaux wifi
    </button>
</form>

<form action="" method="POST">
    <div class="mb-3">
        <label for="ssid" class="form-label">Nom du réseau wifi</label>
        <select class="form-control" name="ssid" id="ssid" required>
            <?php foreach($networks as $network): ?>
                <option value="<?= explode(':', $network)[1] ?>"><?= $network ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label">Clé de sécurité</label>
        <input class="form-control" type="text" name="pass" id="pass" required>
    </div>
    <button class="btn btn-success" name="action" value="connect">Se connecter</button>
</form>

<?php require('footer.php') ?>