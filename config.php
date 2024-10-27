<?php
// Path to the config file
$configFile = 'config.json';

// Function to get the current status from the config file
function getStatus() {
    global $configFile;
    if (file_exists($configFile)) {
        $config = json_decode(file_get_contents($configFile), true);
        return $config['status'] ?? 'unknown';
    }
    return 'unknown';
}

// Function to update the status in the config file
function updateStatus($newStatus) {
    global $configFile;
    $config = ['status' => $newStatus,'refnoc' => bin2hex(random_bytes(32))];
    file_put_contents($configFile, json_encode($config));
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newStatus = $_POST['status'] ?? 'unknown';
    updateStatus($newStatus);
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Get the current status
$currentStatus = getStatus();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Status Page</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'IBM Plex Sans Thai', sans-serif;
        }
    </style>
</head>
<body style="display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100vh;">
    <h1>Current Status: <?php echo htmlspecialchars($currentStatus); ?></h1>
    <form method="post">
        <label for="status">Change Status:</label>
        <div>
            <button type="submit" name="status" value="same" style="border-radius: 10px; padding: 10px;">Same</button><br>
            <button type="submit" name="status" value="black" style="border-radius: 10px; padding: 10px;">Black</button><br>
            <button type="submit" name="status" value="each" style="border-radius: 10px; padding: 10px;">Each</button>
        </div>
    </form>
</body>
</html>