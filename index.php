<?php
require_once __DIR__."/php/main.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>How Many Days You Live</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<div class="container">
    <div class="row">
        <form method="post" class="needs-validation myform" novalidate>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
                <div class="invalid-feedback">Input name</div>
            </div>
            <h3>Input your birthday</h3>
            <div class="form-group">
                <label for="day">Day:</label>
                <input type="number" class="form-control" name="day" id="day" placeholder="01" required>
                <div class="invalid-feedback">Input day</div>
            </div>
            <div class="form-group">
                <label for="month">Month:</label>
                <input type="number" class="form-control" name="month" id="month" placeholder="01" required>
                <div class="invalid-feedback">Input month</div>
            </div>
            <div class="form-group">
                <label for="year">Year:</label>
                <input type="number" class="form-control" name="year" id="year" placeholder="2000" required>
                <div class="invalid-feedback">Input year</div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php if(isset($user) && isset($mrBase)): ?>
            <p name="answer">
                    <?php
                    $answer = $user->getAnswer();
                    if($answer=="Input is NOT VALID") {
                        echo $answer;
                        die();
                    }
                    echo "Your name is {$user->name}.<br>";
                    echo "You were born {$user->getBirthdayInSQLFormat()}. ";
                    echo $answer . "<br>";
                    echo "If you were a part of the Kardashian family then...";
                    $mrBase->printOlderKardashiansMessage($user->getBirthdayInSQLFormat());
                    $mrBase->printYoungerKardashiansMessage($user->getBirthdayInSQLFormat());
                    ?>
            </p>
        <?php endif;?>
    </div>
</div>
<?php if(isset($mrBase)): ?>
    <?php
        $mrBase->deleteUsersFromKardashians();
        $mrBase->close();
    ?>
<?php endif;?>
<script src="js/validation.js"></script>
</body>
</html>