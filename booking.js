document.addEventListener('DOMContentLoaded', function () {
  var modeSwitch = document.querySelector('.mode-switch');

  modeSwitch.addEventListener('click', function () {
    document.documentElement.classList.toggle('dark');
  });
});

function selectFacilityAndDistrict() {
  var selectedFacility = document.getElementById("facilitySelect").value;
  var selectedDistrict = document.getElementById("districtSelect").value;
  var centreDivs = document.querySelectorAll(".main-card");

  for (var i = 0; i < centreDivs.length; i++) {
    var key = Object.keys(facilities)[i];
    var centreFacilities = facilities[key];
    var centreDistricts = districts[key];

    var hasFacility = centreFacilities && centreFacilities.indexOf(selectedFacility) !== -1;
    var hasDistrict = centreDistricts && centreDistricts.indexOf(selectedDistrict) !== -1;

    if ((selectedFacility === "" || hasFacility) && (selectedDistrict === "" || hasDistrict)) {
      centreDivs[i].style.display = "block";
    } else {
      centreDivs[i].style.display = "none";
    }
  }
}

function openModal(){
  let modal= document.querySelector('#modal-window');
  modal.classList.add("showModal");
}

function closeM(){
    let m= document.querySelector('#modal-window');
  m.classList.remove("showModal");
}
