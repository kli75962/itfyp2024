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
        <a href="#" class="nav-link active">Book</a>
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
    <section>
      <div class="app-actions-line">
        <div class="search-wrapper">
          <button class="loaction-btn">
            <svg class="btn-icon" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin" viewBox="0 0 24 24">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z" />
              <circle cx="12" cy="10" r="3" />
            </svg>
          </button>
          <input type="text" class="search-input">
          <button class="search-btn" id="mySearch" onclick="search()">Find centre</button>
        </div>
        <select name="facility" id="facilitySelect" class="filter-btn" onchange="selectFacilityAndDistrict()">
          <option value="">All Facility</option>
          <?php
          while ($row = mysqli_fetch_assoc($all_facilities)) {
            ?>
            <option value="<?php echo $row['facility']; ?>">
              <?php echo $row['facility']; ?>
            </option>
            <?php
          }
          ?>
        </select>
        <select name="district" id="districtSelect" class="filter-btn" onclick="selectFacilityAndDistrict()">
          <option value="">All District</option>
          <?php
          while ($row = mysqli_fetch_assoc($all_district)) {
            ?>
            <option value="<?php echo $row['all_district']; ?>">
              <?php echo $row['all_district']; ?>
            </option>
            <?php
          }
          ?>
        </select>
      </div>
    </section>
    <section class="app-main">
      <div class="app-main-left cards-area">
        <?php
        while ($row = mysqli_fetch_assoc($all_centre)) {
          ?>
          <div class="card-wrapper main-card">
          <a class="card cardItemjs" href="bookingdetail.php?cardname=<?php echo $row['centre_name']?>&cardaddress=<?php echo $row['address']?>&cardlink=<?php echo $row['googlemap']?>">
              <div class="card-info">
                <div class="card-text big cardText-js">
                  <?php echo $row['centre_name']; ?>
                </div>
                <div class="card-text small cardAddress-js">
                  Address:<br/>
                  <?php echo $row['address']; ?>
                </div>
              </div>
            </a>
          </div>
          <?php
        }
        ?>
      </div>
    </section>
  </div>
  <script src="booking.js"></script>
  <script>
    var facilities = <?php echo json_encode($facilities); ?>;
    var districts = <?php echo json_encode($districts); ?>;
  </script>
</body>

</html>