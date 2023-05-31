<?php
declare(strict_types=1);

class MrDataBase
{
    public mysqli $conn;

    public function __construct(string $serverName, string $username, string $password, string $dataBaseNeme)
    {
        $this->conn = new mysqli($serverName, $username, $password, $dataBaseNeme);
    }

    public function addUsertoKardashians($user): void
    {
        $sql = "INSERT INTO kardashians(name, birthday) 
                VALUES ('{$user->name}', '{$user->getBirthdayInSQLFormat()}')";
        $this->conn->query($sql);
    }

    public function deleteUsersFromKardashians(): void
    {
        $sql = "DELETE FROM kardashians
                WHERE member_id > 16";
        $this->conn->query($sql);
    }

    public function addUserToUsers(User $user): void
    {
        $sql = "INSERT INTO users(name, birthday) VALUES ('{$user->name}', '{$user->getBirthdayInSQLFormat()}');";
        $this->conn->query($sql);
    }

    public function printYoungerKardashiansMessage(string $usersBirthday): void
    {
        $sql = "SELECT name, surname FROM `kardashians` WHERE birthday > '$usersBirthday'";
        $result = $this->conn->query($sql); //число рядов результирующей выборки
        if ($result->num_rows > 0) {
            echo "<br>These family members would be younger than you: ";
            //fetch_assoc() помещает все результаты в ассоциативный массив, а потом каждый раз при вызове
            //перемещает указатель на новую строку
            $answer = array();
            while ($row = $result->fetch_assoc()) {
                $answer[] = $row["name"] . " " . $row["surname"];
            }
            for ($i = 0; $i < count($answer) - 1; $i++) {
                echo $answer[$i] . ", ";
            }
            echo $answer[count($answer) - 1] . ".";
        }
    }

    public function printOlderKardashiansMessage(string $usersBirthday): void
    {
        $sql = "SELECT name, surname FROM `kardashians` WHERE birthday < '$usersBirthday'";
        $result = $this->conn->query($sql); //число рядов результирующей выборки
        if ($result->num_rows > 0) {
            echo "<br>These family members would be older than you: ";
            $answer = array();
            while ($row = $result->fetch_assoc()) {
                $answer[] = $row["name"] . " " . $row["surname"];
            }
            for ($i = 0; $i < count($answer) - 1; $i++) {
                echo $answer[$i] . ", ";
            }
            echo $answer[count($answer) - 1] . ".";
        }
    }

    public function close(): void
    {
        $this->conn->close();
    }
}