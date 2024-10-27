<?php
// Path to the config file
$configFile = 'config.json';
function getStatus($type) {
    global $configFile;
    if (file_exists($configFile)) {
        $config = json_decode(file_get_contents($configFile), true);
        return $config[$type] ?? 'unknown';
    }
    return 'unknown';
}
function updaterefnoc() {
    global $configFile;
    $config = [
        'status' => getStatus('status'),
        'vdo' => getStatus('vdo'),
        'refnoc' => bin2hex(random_bytes(32))
    ];
    file_put_contents($configFile, json_encode($config));
}
updaterefnoc();
?>