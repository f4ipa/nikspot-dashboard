<?php

$content = file_get_contents('/etc/svxlink/svxlink.conf');
preg_match('/^CALLSIGN=(.*)$/m', $content, $matches);
$callsign = $matches[1] ?? '';

if (isset($_POST['callsign'])) {
    $callsign = trim($_POST['callsign']);
    $content = preg_replace('/^CALLSIGN=.*/m', "CALLSIGN=$callsign", $content);
    file_put_contents('/etc/svxlink/svxlink.conf', $content);
    system('service svxlink restart');
}

require('header.php') 
?>

    <form action="" method="POST">
        <h4 class="mb-3">Votre indicatif</h4>
        <input type="text" name="callsign" class="form-control mb-3" value="<?= $callsign ?>">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
    
<?php require('footer.php') ?>