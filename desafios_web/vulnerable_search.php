<?php
// vulnerable_search.php - example vulnerable code for learning purposes only
$db = new PDO('sqlite:ctf_users.db');
$q = isset($_GET['q']) ? $_GET['q'] : '';
$sql = "SELECT username, fullname FROM users WHERE username LIKE '%$q%' OR fullname LIKE '%$q%' LIMIT 10;";
// This is intentionally insecure (string interpolation) for CTF purposes.
foreach ($db->query($sql) as $row) {
    echo "<div>User: ".htmlspecialchars($row['username'])." - ".htmlspecialchars($row['fullname'])."</div>";
}
?>