<?php

if (isset($_POST['update'])) {
    extract($_POST);
    system("sa818 --port $port radio --frequency $freq $squelch $ctcss $band --tail close");
    system("sa818 --port $port volume --level $volume");
    system("sa818 --port $port filters --emphasis enable --highpass disable --lowpass disable");
    header('location: /radio.php');
    exit(0);
}

require('functions.php');
require('header.php');

?>

<div class="row">
    <div class="col-12 offset-md-3 col-md-6">
        <form action="" method="POST">
            <fieldset class="border p-3 rounded">
            <legend class="w-auto mb-3">Programmation SA818</legend>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group mt-4">
                            <label for="port" class="form-label">Port COM</label>
                            <input type="text" id="port" name="port" class="form-control" value="/dev/ttyS2" required>
                        </div>
                        <div class="form-group mt-4">
                            <label for="freq" class="form-label">Fréquence en MHz</label>
                            <input type="text" pattern="(14[45]|43[0-9])\.[0-9](000|125|250|375|500|625|750|875)" id="freq" name="freq" class="form-control" placeholder="XXX.XXXX" required>
                        </div>
                        <div class="form-group mt-4">
                            <label for="ctcss" class="form-label">CTCSS / DCS</label>
                            <select id="ctcss" name="ctcss" class="form-control" required>
                                <option value="--ctcss 67.0">CTCSS 67.0 Hz</option>
                                <option value="--ctcss 71.9" selected>CTCSS 71.9 Hz</option>
                                <option value="--ctcss 74.4">CTCSS 74.4 Hz</option>
                                <option value="--ctcss 77.0">CTCSS 77.0 Hz</option>
                                <option value="--ctcss 79.7">CTCSS 79.7 Hz</option>
                                <option value="--ctcss 82.5">CTCSS 82.5 Hz</option>
                                <option value="--ctcss 85.4">CTCSS 85.4 Hz</option>
                                <option value="--ctcss 88.5">CTCSS 88.5 Hz</option>
                                <option value="--ctcss 91.5">CTCSS 91.5 Hz</option>
                                <option value="--ctcss 94.8">CTCSS 94.8 Hz</option>
                                <option value="--ctcss 97.4">CTCSS 97.4 Hz</option>
                                <option value="--ctcss 100.0">CTCSS 100.0 Hz</option>
                                <option value="--ctcss 103.5">CTCSS 103.5 Hz</option>
                                <option value="--ctcss 107.2">CTCSS 107.2 Hz</option>
                                <option value="--ctcss 110.9">CTCSS 110.9 Hz</option>
                                <option value="--ctcss 114.8">CTCSS 114.8 Hz</option>
                                <option value="--ctcss 118.8">CTCSS 118.8 Hz</option>
                                <option value="--ctcss 123.0">CTCSS 123.0 Hz</option>
                                <option value="--ctcss 127.3">CTCSS 127.3 Hz</option>
                                <option value="--ctcss 131.8">CTCSS 131.8 Hz</option>
                                <option value="--ctcss 136.5">CTCSS 136.5 Hz</option>
                                <option value="--ctcss 141.3">CTCSS 141.3 Hz</option>
                                <option value="--ctcss 146.2">CTCSS 146.2 Hz</option>
                                <option value="--ctcss 151.4">CTCSS 151.4 Hz</option>
                                <option value="--ctcss 156.7">CTCSS 156.7 Hz</option>
                                <option value="--ctcss 162.2">CTCSS 162.2 Hz</option>
                                <option value="--ctcss 167.9">CTCSS 167.9 Hz</option>
                                <option value="--ctcss 173.8">CTCSS 173.8 Hz</option>
                                <option value="--ctcss 179.9">CTCSS 179.9 Hz</option>
                                <option value="--ctcss 186.2">CTCSS 186.2 Hz</option>
                                <option value="--ctcss 192.8">CTCSS 192.8 Hz</option>
                                <option value="--ctcss 203.5">CTCSS 203.5 Hz</option>
                                <option value="--ctcss 210.7">CTCSS 210.7 Hz</option>
                                <option value="--ctcss 218.1">CTCSS 218.1 Hz</option>
                                <option value="--ctcss 225.7">CTCSS 225.7 Hz</option>
                                <option value="--ctcss 233.6">CTCSS 233.6 Hz</option>
                                <option value="--ctcss 241.8">CTCSS 241.8 Hz</option>
                                <option value="--ctcss 250.3">CTCSS 250.3 Hz</option>
                                <option value="--dcs 023N">DCS 023 N</option>
                                <option value="--dcs 025N">DCS 025 N</option>
                                <option value="--dcs 026N">DCS 026 N</option>
                                <option value="--dcs 031N">DCS 031 N</option>
                                <option value="--dcs 032N">DCS 032 N</option>
                                <option value="--dcs 036N">DCS 036 N</option>
                                <option value="--dcs 043N">DCS 043 N</option>
                                <option value="--dcs 047N">DCS 047 N</option>
                                <option value="--dcs 051N">DCS 051 N</option>
                                <option value="--dcs 053N">DCS 053 N</option>
                                <option value="--dcs 054N">DCS 054 N</option>
                                <option value="--dcs 065N">DCS 065 N</option>
                                <option value="--dcs 071N">DCS 071 N</option>
                                <option value="--dcs 072N">DCS 072 N</option>
                                <option value="--dcs 073N">DCS 073 N</option>
                                <option value="--dcs 074N">DCS 074 N</option>
                                <option value="--dcs 114N">DCS 114 N</option>
                                <option value="--dcs 115N">DCS 115 N</option>
                                <option value="--dcs 116N">DCS 116 N</option>
                                <option value="--dcs 125N">DCS 125 N</option>
                                <option value="--dcs 131N">DCS 131 N</option>
                                <option value="--dcs 132N">DCS 132 N</option>
                                <option value="--dcs 134N">DCS 134 N</option>
                                <option value="--dcs 143N">DCS 143 N</option>
                                <option value="--dcs 152N">DCS 152 N</option>
                                <option value="--dcs 155N">DCS 155 N</option>
                                <option value="--dcs 156N">DCS 156 N</option>
                                <option value="--dcs 162N">DCS 162 N</option>
                                <option value="--dcs 165N">DCS 165 N</option>
                                <option value="--dcs 172N">DCS 172 N</option>
                                <option value="--dcs 174N">DCS 174 N</option>
                                <option value="--dcs 205N">DCS 205 N</option>
                                <option value="--dcs 223N">DCS 223 N</option>
                                <option value="--dcs 226N">DCS 226 N</option>
                                <option value="--dcs 243N">DCS 243 N</option>
                                <option value="--dcs 244N">DCS 244 N</option>
                                <option value="--dcs 245N">DCS 245 N</option>
                                <option value="--dcs 251N">DCS 251 N</option>
                                <option value="--dcs 261N">DCS 261 N</option>
                                <option value="--dcs 263N">DCS 263 N</option>
                                <option value="--dcs 265N">DCS 265 N</option>
                                <option value="--dcs 271N">DCS 271 N</option>
                                <option value="--dcs 306N">DCS 306 N</option>
                                <option value="--dcs 311N">DCS 311 N</option>
                                <option value="--dcs 315N">DCS 315 N</option>
                                <option value="--dcs 331N">DCS 331 N</option>
                                <option value="--dcs 343N">DCS 343 N</option>
                                <option value="--dcs 346N">DCS 346 N</option>
                                <option value="--dcs 351N">DCS 351 N</option>
                                <option value="--dcs 364N">DCS 364 N</option>
                                <option value="--dcs 365N">DCS 365 N</option>
                                <option value="--dcs 371N">DCS 371 N</option>
                                <option value="--dcs 411N">DCS 411 N</option>
                                <option value="--dcs 412N">DCS 412 N</option>
                                <option value="--dcs 413N">DCS 413 N                        
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group mt-4">
                            <label for="band" class="form-label">Largeur de bande</label>
                            <select id="band" name="band" class="form-control" required>
                                <option value="--bw 0">Narrow 12.5 kHz</option>
                                <option value="--bw 1" selected>Wide 25 kHz</option>
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label for="squelch" class="form-label">Niveau de squelch</label>
                            <select id="squelch" name="squelch" class="form-control" required>
                                <option value="--squelch 0">Squelch 0</option>
                                <option value="--squelch 1">Squelch 1</option>
                                <option value="--squelch 2">Squelch 2</option>
                                <option value="--squelch 3">Squelch 3</option>
                                <option value="--squelch 4" selected>Squelch 4</option>
                                <option value="--squelch 5">Squelch 5</option>
                                <option value="--squelch 6">Squelch 6</option>
                                <option value="--squelch 7">Squelch 7</option>                        
                                <option value="--squelch 8">Squelch 8</option>                        
                            </select>
                        </div>
                        <div class="form-group mt-4">
                            <label for="volume" class="form-label">Niveau du volume</label>
                            <select id="volume" name="volume" class="form-control" required>
                                <option value="--level 1">Volume 1</option>
                                <option value="--level 2" selected>Volume 2</option>
                                <option value="--level 3">Volume 3</option>
                                <option value="--level 4">Volume 4</option>
                                <option value="--level 5">Volume 5</option>
                                <option value="--level 6">Volume 6</option>
                                <option value="--level 7">Volume 7</option>                        
                                <option value="--level 8">Volume 8</option>                        
                            </select>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="update">
                <button type="submit" class="w-100 btn btn-primary mt-4">
                    Programmer le SA818
                </button>
            </fieldset>
        </form>
    </div>
</div>
<?php require('footer.php') ?>