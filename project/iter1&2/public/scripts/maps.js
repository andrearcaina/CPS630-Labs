
// Function to initalize the map
function initMap() {
  //Uses the geolocation API to get the current location of the user
  navigator.geolocation.getCurrentPosition(function (position) {
    var location = { lat: position.coords.latitude, lng: position.coords.longitude };
    console.log(location);


    //Create a map centered at the user's location
    var map = new google.maps.Map(document.getElementById("map"),
      {
        zoom: 12,
        center: location,
        gestureHandling: 'greedy'
      });

    //Create marker for the user's location
    var userLocation = new google.maps.Marker( //User location
      { position: location, map: map });


    //Create marker tag for the user's location
    var infoWindow = new google.maps.InfoWindow(
      { content: "<h1> Your Location </h1>" });
    userLocation.addListener("click", function () { infoWindow.open(map, userLocation); });


    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();
    directionsRenderer.setMap(map);


    //Updates the marker to the store's location
    function updateMarker(storeLocation) {
      map.setCenter(storeLocation);
      calculateAndDisplayRoute(directionsService, directionsRenderer, location, storeLocation);
    }

    function calculateAndDisplayRoute(directionsService, directionsRenderer, location, storeLocation) {
      directionsService.route(
        {
          origin: storeLocation,
          destination: location,
          travelMode: google.maps.TravelMode.DRIVING,
        },
        (response, status) => {
          if (status === "OK") {
            directionsRenderer.setDirections(response);
          } else {
            window.alert("Failed to make directions request due to: " + status);
          }
        }
      );
    }



    //Automatically sets defualt store location to first store in the dropdown
    setTimeout(() => { //wait until the dropdown is populated, uses delays to avoid errors
      var defaultStore = $("#lang").val(); //gets the defualt store location id
      var defaultStoreLocation = getStoreLocation(defaultStore); //gets coordinates of default store id
      updateMarker(defaultStoreLocation); //updates the marker location
    }, 500);

    //Listen for change events on the dropdown to change store Location on the map
    $("#lang").change(function () {
      var selectedStore = $(this).val(); //gets the updated store id
      var selectedStoreLocation = getStoreLocation(selectedStore); //gets coordinates of updated store id
      updateMarker(selectedStoreLocation); //updates the marker location
    });

  });
}
//Gets the id of the store and returns the coordinates
function getStoreLocation(storeName) { 
  var storeLocations = {
    1: { lat: 43.775944, lng: -79.257790 }, //Scarborough Town Center
    2: { lat: 43.65456237089744, lng: -79.38073158911679 }, //Eaton Center
    3: { lat: 43.593125426667825, lng: -79.64247856441756 }, //Fairview Mall
    4: { lat: 43.72524783129945, lng: -79.45267995658686 }, //Scarborough Town Center
  }
  return storeLocations[storeName]; //associative array to give back coordinates
}