<?php 

$files = shell_exec('find /etc /var/log /opt /usr/share -type f 2>/dev/null');
$files = explode("\n", trim($files));

if (isset($_POST['filepath']) && file_exists($_POST['filepath'])) {
    $content = file_get_contents($_POST['filepath']);
}

if (isset($_POST['action']) && $_POST['action'] == 'save') {
    file_put_contents($_POST['filepath'], $_POST['content']);
    header('location: expert.php');
}

if (isset($_POST['action']) && $_POST['action'] == 'cancel') {    
    header('location: expert.php');
}

if (isset($_POST['svxlink'])) {
    system('service svxlink ' . $_POST['svxlink']);    
}

if (isset($_POST['system'])) {
    system($_POST['system']);
}

$svxlink = system('systemctl is-active svxlink');



require('header.php');
?>

<?php if (!isset($content)): ?>
    <form action="" method="POST">
        <h4>Editeur de fichier système</h4>
        <input type="text" list="files" class="form-control mb-3" name="filepath" autofocus required>
        <datalist id="files">
            <?php foreach($files as $file): ?>
                <option value="<?=$file?>"></option>
            <?php endforeach ?>
        </datalist>
        <button type="submit" class="btn btn-primary mb-5">Ouvrir le fichier</button>
    </form>

    <div class="row">
        <div class="col-md-6">
            <h4 class="mb-3">SvxLink SA818</h4>
            <form action="" method="POST">
                <button type="submit" class="btn btn-success btn-sm" name="svxlink" value="start">Démarrer</button>
                <button type="submit" class="btn btn-warning btn-sm" name="svxlink" value="restart">Redémarrer</button>
                <button type="submit" class="btn btn-danger btn-sm" name="svxlink" value="stop">Arrêter</button>
                <strong>Status: </strong><?= $svxlink ?>
            </form>    
        </div>
        <div class="col-md-6">
            <h4 class="mb-3">Système d'exploitation</h4>
            <form action="" method="POST">
                <button type="submit" class="btn btn-warning btn-sm" name="system" value="reboot">Redémarrer</button>
                <button type="submit" class="btn btn-danger btn-sm" name="system" value="poweroff">Arrêter</button>
        </div>
    </div>

<?php else: ?>

    <form action="" method="POST">
        <input type="hidden" name="filepath" value="<?=$_POST['filepath']?>">
        <textarea class="form-control mb-3" rows="14" name="content"><?=$content?></textarea>
        <button class="btn btn-success mb-3" name="action" value="save">Enregistrer</button>
        <button class="btn btn-success mb-3" name="action" value="cancel">Annuler</button>
    </form>

<?php endif ?>

<?php require('footer.php') ?>