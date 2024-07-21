<?php
function anti_injection($data) {
    // // Example implementation
    // if ($type === 'string') {
        $data = stripslashes($data);
        $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    // } elseif ($type === 'integer') {
        // $data = intval($data);
    // }
    // Add more sanitization based on $type
    return $data;
}
?>