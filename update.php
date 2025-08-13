<?php 

require('header.php');

if (!empty($_POST)) {
    header('Content-Type: text/html; charset=utf-8');
    header('Cache-Control: no-cache');    
    //ob_implicit_flush(true);
    //@ob_end_flush();    
    set_time_limit(0);
    $command = 'curl https://49.f4ipa.fr/extra/nikspot-update.sh |bash';
    $handle = popen($command, 'r');
    echo '<pre>';
    while (!feof($handle)) {
        echo fgets($handle);
        ob_flush();
        flush();
        sleep(1);
    }
    echo '</pre>';
    pclose($handle);
}

?>

<div class="text-center">
    <form action="" method="POST">
        <input type="hidden" name="update" value="true">
        <button class="btn btn-lg btn-primary" type="submit">
            Mettre à jour la NikSpot
        </button>
    </form>
</div>

<?php require('footer.php') ?>