<?php

$svxlink = file_get_contents('/etc/svxlink/svxlink.conf');
$echolink = file_get_contents('/etc/svxlink/svxlink.d/ModuleEchoLink.conf');
preg_match_all('/^([A-Z_]*)=(.*)$/mi', $echolink, $matches);
$lines = array_combine($matches[1], $matches[2]);
foreach($lines as $key => $value) $$key = $value ?? '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $callsign = $_POST['CALLSIGN'];
    $svxlink = preg_replace('/^(CALLSIGN=).*/m', '$1'.$callsign, $svxlink);
    file_put_contents('/etc/svxlink/svxlink.conf', $svxlink);    

    foreach ($_POST as $key => $value)
        $echolink = preg_replace("/^(${key}=).*/m", "$key=$value", $echolink);    
    file_put_contents('/etc/svxlink/svxlink.d/ModuleEchoLink.conf', $echolink);

    header("Location: " . $_SERVER['PHP_SELF']);
    system('service svxlink restart');
}

require('header.php') 
?>

<form action="" method="POST">
    <div class="row">
        <div class="offset-md-2 col-md-4">
            <fieldset class="border p-3 rounded">
                <legend class="w-auto mb-3">Authentification</legend>
                <div class="form-group mt-4">
                    <label for="callsign">Indicatif</label>
                    <input type="text" name="CALLSIGN" id="callsign" class="form-control" value="<?= $CALLSIGN ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="PASSWORD" id="password" class="form-control" value="<?= $PASSWORD ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="location">Localité</label>
                    <input type="text" name="LOCATION" id="location" class="form-control" value="<?= $LOCATION ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="sysopname">Prénom</label>
                    <input type="text" name="SYSOPNAME" id="sysopname" class="form-control" value="<?= $SYSOPNAME ?>">
                </div>

            </fieldset>
        </div>
        <div class="col-md-4">
            <fieldset class="border p-3 rounded">
                <legend class="w-auto mb-3">Serveur proxy</legend>
                <div class="form-group mt-4">
                    <label for="proxy_server">Adresse</label>
                    <input type="text" name="PROXY_SERVER" id="proxy_server" class="form-control" value="<?= $PROXY_SERVER ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="proxy_port">Port</label>
                    <input type="text" name="PROXY_PORT" id="proxy_port" class="form-control" value="<?= $PROXY_PORT ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="proxy_password">Mot de passe</label>
                    <input type="password" name="PROXY_PASSOWRD" id="proxy_password" class="form-control" value="<?= $PROXY_PASSWORD ?>">
                </div>
            </fieldset>

        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary btn-lg m-3">Enregistrer et redémarrer EchoLink</button>
    </div>
</form>
    
<?php require('footer.php') ?>