<?php

require_once 'connection.php';

$record = "select * from record";
$all_record = $conn->query($record);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="booking.css" />
</head>

<body>
    <div class="app-container">
        <section class="navigation">
            <a href="booking.php" class="app-main">Book</a>
            <div class="navigation-links">
                <a href="booking.php" class="nav-link">Book</a>
                <a href="#" class="nav-link active">Record</a>
                <a href="about.php" class="nav-link">About</a>
            </div>
            <div class="flex">
                <button class="mode-switch">
                    <svg class="sun" fill="none" stroke="#fbb046" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="feather feather-sun" viewBox="0 0 24 24">
                        <defs />
                        <circle cx="12" cy="12" r="5" />
                        <path
                            d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" />
                    </svg>
                    <svg class="moon" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="feather feather-moon" viewBox="0 0 24 24">
                        <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                    </svg>
                </button>
                <button class="profile-btn">
                    <span>Ryan Evans</span>
                    <img src="https://i.pinimg.com/originals/38/47/9c/38479c637a4ef9c5ced95ca66ffa2f41.png" alt="pp">
                </button>
            </div>
        </section>
        <section class="">
            <div class="app-actions-line">
                <div class="search-wrapper">
                    <input type="text" class="search-input">
                    <button class="search-btn" id="mySearch" onclick="myFunction()">Find record</button>
                </div>
        </section>
        <section class="app-main">
            <div class="app-main-left cards-area">
                <table class="record-table">
                    <tr>
                        <td class="card-text big">Centre</td>
                        <td class="card-text big">Facility</td>
                        <td class="card-text big">Date</td>
                        <td class="card-text big">Time from</td>
                        <td class="card-text big">Time to</td>
                    </tr>
                    <tr>
                        <?php
                        while ($row = mysqli_fetch_assoc($all_record)) {
                            ?>
                            <td class="card-text big">
                                <?php echo $row['centre']; ?>
                            </td>
                            <td class="card-text big">
                                <?php echo $row['facility']; ?>
                            </td>
                            <td class="card-text big">
                                <?php echo $row['date']; ?>
                            </td>
                            <td class="card-text big">
                                <?php echo $row['timefrom']; ?>
                            </td>
                            <td class="card-text big">
                                <?php echo $row['timeto']; ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                </table>
            </div>
        </section>
    </div>
    <script src="booking.js">
    </script>
</body>

</html>