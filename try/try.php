<?php
$node_path = (PHP_OS === 'WINNT') ? shell_exec('where node') : shell_exec('which node');
$node_path = trim($node_path); // Remove extra spaces/newlines

echo "Node.js path: $node_path\n";

$root_dir = $_SERVER['DOCUMENT_ROOT'] . '/SmileSync';
require_once $root_dir . '/vendor/autoload.php';

// Define the command to start the server
$command = $node_path . ' ' . $root_dir . '/try.js';

// Execute the command
exec($command, $output, $status);
echo implode("\n", $output);  // Output logs for debugging
?>

<?php



use GuzzleHttp\Client;

$client = new Client();

$data = [
    'to' => 'yoroizumi@gmail.com',
    'subject' => 'Test Email from Guzzle and Nodemailer',
    'text' => 'Hello, this is a test email sent via Nodemailer and triggered using Guzzle.',
];

try {
    $response = $client->post('http://localhost:3000/send-email', [
        'json' => $data,
    ]);

    if ($response->getStatusCode() === 200) {
        echo "Email sent successfully!";
    } else {
        echo "Failed to send email. Status: " . $response->getStatusCode();
    }
} catch (\GuzzleHttp\Exception\RequestException $e) {
    echo "Request Error: " . $e->getMessage();
}
