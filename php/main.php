<?php
declare(strict_types=1);

require_once __DIR__ . "/../php/User.php";
require_once __DIR__ . "/../php/MrDataBase.php";

if (empty($_POST) == false) {
    foreach ($_POST as $element) {
        $element = trim(htmlspecialchars($element));
    }

    $serverName = "localhost";
    $username = "root";
    $password = "";
    $dataBaseNeme = "KardashianFamily";
    $user = new User($_POST['name'], $_POST['day'], $_POST['month'], $_POST['year']);
    $mrBase = new MrDataBase($serverName, $username, $password, $dataBaseNeme);

    $mrBase->addUsertoUsers($user);
    $lastUserID = $mrBase->conn->insert_id;
    $mrBase->addUserToKardashians($user);
    $lastKardashianID = $mrBase->conn->insert_id;
}
?>






















