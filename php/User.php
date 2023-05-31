<?php
declare(strict_types=1);

class User
{
    public string $name;
    public int $day, $month, $year;

    public function __construct(string $name, string $day, string $month, string $year)
    {
        $this->name = $name;
        $this->day = intval($day);
        $this->month = intval($month);
        $this->year = intval($year);
    }

    private function isValidInput(): bool
    {
        return checkdate($this->month, $this->day, $this->year);
    }

    public function calculateLivedDays(): int
    {
        $currentDate = date('Y-m-d H:i:s');
        $usersDate = DateTime::createFromFormat('Y-m-d H:i:s', "$this->year-$this->month-$this->day 00:00:00");
        $interval = date_diff(new DateTime($currentDate), $usersDate);
        $livedDays = $interval->days;
        if (strtotime($currentDate) < strtotime("$this->year-$this->month-$this->day 00:00:00"))
            $livedDays *= -1;
        return $livedDays + 1;
    }

    private function formAnswer(int $livedDays): string
    {
        if ($livedDays == 1)
            return "You have been alive for $livedDays day.";
        if ($livedDays > 0)
            return "You have been alive for $livedDays days.";
        if ($livedDays < 0)
            return "You were never born";
        return "Happy birthday to you!";
    }

    public function getBirthdayInSQLFormat(): string
    {
        return "$this->year-$this->month-$this->day";
    }

    public function getAnswer(): string
    {
        if ($this->isValidInput() == false) {
            return "Input is NOT VALID";
        }
        $livedDays = $this->calculateLivedDays();
        return $this->formAnswer($livedDays);
    }
}