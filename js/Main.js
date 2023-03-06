var input1 = document.getElementById("from");
var autocomplete1 = new google.maps.places.Autocomplete(input1);
 
var input2 = document.getElementById("to");
var autocomplete2 = new google.maps.places.Autocomplete(input2);

var myLatLng = {
    lat: 39.172725,
    lng: -86.523295
}

var mapOptions = {
    center: myLatLng,
    zoom: 15,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
}

var map = new google.maps.Map(document.getElementById('googleMap'), mapOptions);
 
//create a DirectionsRenderer object which we will use to display the route
var directionsDisplay = new google.maps.DirectionsRenderer();

//bind the DirectionsRenderer to the map
directionsDisplay.setMap(map);
var directionsService = new google.maps.DirectionsService();

//create a DirectionsRenderer object which we will use to display the route
var directionsDisplay = new google.maps.DirectionsRenderer();

//bind the DirectionsRenderer to the map
directionsDisplay.setMap(map);

//define calcRoute function
function calcRoute() {
  //create request
  var request = {
    origin: document.getElementById("from").value,
    destination: document.getElementById("to").value,
    travelMode: google.maps.TravelMode.DRIVING, //WALKING, BYCYCLING, TRANSIT
    unitSystem: google.maps.UnitSystem.IMPERIAL,
  };

  //pass the request to the route method
  directionsService.route(request, function (result, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      
      //display route
      directionsDisplay.setDirections(result);

      // Fill in the pickup and destination address fields in the survey form
      const start_address = result.routes[0].legs[0].start_address;
      const end_address = result.routes[0].legs[0].end_address;
      
      // Fill in the pickup and destination address fields in the survey form
      document.getElementsByName("start_point")[0].value = start_address;
      document.getElementsByName("destination")[0].value = end_address;
      document.getElementsByName("city_start")[0].value = start_address.split(',')[1].trim();
      document.getElementsByName("city_end")[0].value = end_address.split(',')[1].trim();


      const distance = parseInt(result.routes[0].legs[0].distance.text.replace(/,/g, ''));
      const price = distance * 1.2;

      document.getElementsByName("distance")[0].value = distance;
      document.getElementsByName("price")[0].value = price.toFixed(2);


      // Show the survey form
      document.getElementById("survey-form").style.display = "block"; //show the survey form
      document.querySelector(".form-wrapper").appendChild(document.getElementById("survey-form"));

      document.querySelector('#survey-form').scrollIntoView({ behavior: 'smooth' });

      
    } else {
      //delete route from map
      directionsDisplay.setDirections({ routes: [] });

      map.setCenter(myLatLng);

     }
  });
}

  

