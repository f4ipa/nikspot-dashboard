<?php

function update_echolink_current_logins() {
    $html = file_get_contents("https://www.echolink.org/logins.jsp");
    $html = str_replace(["\n", "\r"], "", $html);
    $nodes = [];
    preg_match_all('/<tr>(.*?)<\/tr>/', $html, $rows);
    foreach ($rows[1] as $row) {
        preg_match_all('/<td[^>]*>(.*?)<\/td>/', $row, $cols);
        if (count($cols[1]) >= 5) {
            $node_id = strip_tags($cols[1][4]);
            $nodes[$node_id] = [
                "callsign" => strip_tags($cols[1][0]),
                "name"     => strip_tags($cols[1][1])
            ];
        }
    }
    $nodes = json_encode($nodes);
    file_put_contents("/etc/svxlink/nodes.json", $nodes);
}

?>
