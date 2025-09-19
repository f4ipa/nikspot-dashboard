<?php 

if (isset($_GET['dtmf'])) {
    system('echo "D' . $_GET['dtmf'] . '#" > /tmp/svxlink');
    header('location: /');
    exit();
}

require('functions.php');
require('header.php');

$svxlink_file = '/etc/svxlink/svxlink.conf';
$content = file_get_contents($svxlink_file);
preg_match_all('/(\d+)=:##(\d+)#/', $content, $macros);

$nodes_file = '/etc/svxlink/nodes.json';
if (time() - filemtime($nodes_file) > 300)
    update_echolink_current_logins();
$content = file_get_contents($nodes_file);
$nodes = json_decode($content, true);

?>

<ul class="row gx-3 gy-3 list-unstyled text-center text-dark">
    <?php foreach ($macros[1] as $k => $dtmf): ?>
        <?php if (isset($nodes[$macros[2][$k]])): ?>
            <li class="col-12 col-sm-6 col-md-4 col-lg-3">
                <a href="?dtmf=<?= $dtmf ?>" class="d-block p-3 bg-light bg-gradient border rounded text-decoration-none">
                    <strong class="fs-5"><?= $nodes[$macros[2][$k]]['callsign'] ?> (D<?= $dtmf ?>)</strong>
                    <br>
                    <?= $nodes[$macros[2][$k]]['name'] ?>
                </a>
            </li>
        <?php endif ?>
    <?php endforeach ?>
</ul>
    

<script>

    window.addEventListener("beforeunload", function () {
        localStorage.setItem("scrollY", window.scrollY)
    })

    window.addEventListener("load", function () {
        const scrollY = localStorage.getItem("scrollY")
        if (scrollY !== null)
            window.scrollTo(0, parseInt(scrollY))       
    })  

</script>


<?php require('footer.php') ?>