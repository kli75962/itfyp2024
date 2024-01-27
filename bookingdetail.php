<?php

require_once 'connection.php';

$centre = "select * from centre";
$all_centre = $conn->query($centre);

$facilities = "select * from facilities";
$all_facilities = $conn->query($facilities);

$districts = "select * from districts";
$all_district = $conn->query($districts);

$sql = "SELECT c.centre_name, GROUP_CONCAT(f.facility SEPARATOR ', ') AS facilities
        FROM centre c
        JOIN centre_facilities cf ON c.centre_id = cf.centre_id
        JOIN facilities f ON cf.facility_id = f.facility_id
        GROUP BY c.centre_id";
$result = mysqli_query($conn, $sql);

$facilities = array();
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $facilities[$row['centre_name']] = $row['facilities'];
  }
}
json_encode($facilities);

$sql1 = "SELECT c.centre_name, d.all_district AS districts
        FROM centre c
        JOIN centre_districts cd ON c.centre_id = cd.centre_id
        JOIN districts d ON cd.districts_id = d.districts_id
        GROUP BY c.centre_id";
$result1 = mysqli_query($conn, $sql1);

$districts = array();
if (mysqli_num_rows($result1) > 0) {
  while ($row = mysqli_fetch_assoc($result1)) {
    $districts[$row['centre_name']] = $row['districts'];
  }
}
json_encode($districts);
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
        <a href="booking.php" class="nav-link active">Book</a>
        <a href="record.php" class="nav-link">Record</a>
        <a href="about.php" class="nav-link">About</a>
      </div>
      <div class="flex">
        <button class="mode-switch">
          <svg class="sun" fill="none" stroke="#fbb046" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            class="feather feather-sun" viewBox="0 0 24 24">
            <defs />
            <circle cx="12" cy="12" r="5" />
            <path
              d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42" />
          </svg>
          <svg class="moon" fill="none" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            class="feather feather-moon" viewBox="0 0 24 24">
            <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
          </svg>
        </button>
        <button class="profile-btn">
          <span>Ryan Evans</span>
          <img src="https://i.pinimg.com/originals/38/47/9c/38479c637a4ef9c5ced95ca66ffa2f41.png" alt="pp">
        </button>
      </div>
    </section>
    <section class="app-main">
      <div class="app-main-left cards-area">
        <div>
          <?php $card_name = $_GET['cardname'];
          $card_address = $_GET['cardaddress'];
          $card_link = $_GET['cardlink'];
          $encoded_card_link = urlencode($card_link); ?>
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.6404307416815!2d114.213926610808!3d22.329434541754093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x340407eb2d1d81ff%3A0xd885438cfc90b485!2z5b2p5qau6Lev6auU6IKy6aSo!5e0!3m2!1szh-TW!2shk!4v1706080142073!5m2!1szh-TW!2shk"
            style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="left-side">
          <h1>
            <?php echo $card_name ?>
          </h1>
          <p>Address:<br />
            <?php echo $card_address ?>
          </p>
          <button class="btn-book" onclick="window.location.href='payment.php'">Book Now</button>
        </div>
      </div>
      <div class="app-main-right cards-area">
        <h1>Select time</h1>
        <select name="date" id="dateSelect" class="date-btn">
          <option value="">Select date</option>
          <option value="">30/1/2024</option>
          <option value="">31/1/2024</option>
          <option value="">1/2/2024</option>
          <option value="">2/2/2024</option>
          <option value="">3/2/2024</option>
          <option value="">4/2/2024</option>
          <option value="">5/2/2024</option>
        </select>
        <div class="detail-card-wrapper">
          <div class="card">
            <div class="card-info">
              <div class="card-text big">
                <h1>09:00-12:00</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="detail-card-wrapper">
          <div class="card">
            <div class="card-info">
              <div class="card-text big">
                <h1>12:00-15:00</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="detail-card-wrapper">
          <div class="card">
            <div class="card-info">
              <div class="card-text big">
                <h1>15:00-18:00</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="detail-card-wrapper">
          <div class="card">
            <div class="card-info">
              <div class="card-text big">
                <h1>18:00-21:00</h1>
              </div>
            </div>
          </div>
        </div>
    </section>
  </div>
  <div id="modal-window" class="shadow">
    <div class="main-modal">123</div>
    <button class="btn btn-close" onclick="closeM()">
      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
  </div>
  <script src="booking.js"></script>
  <script>
    let ini = document.querySelector('#modal-window');
    ini.classList.add("hideModal");
  </script>
</body>

</html>