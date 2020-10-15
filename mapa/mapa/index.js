let map = L.map('map', {renderer: L.canvas()}).setView([49.196340,16.614005], 200);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

function loadXMLDoc() {
  let xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      xmlToMap(this);
    }
  };
  xmlhttp.open("GET", "sample4.xml", true);
  xmlhttp.send();
}

function xmlToMap(xml) {
  let xmlDoc = xml.responseXML;
  let txt = "";
  let coordinatesTxt = xmlDoc.getElementsByTagName("coordinates");
  for (let i = 0; i < coordinatesTxt.length; i++) {
    txt += (coordinatesTxt[i].childNodes[0].nodeValue);
  }
  
  let coordinates = txt.split("\n");
  coordinates.splice(0,1);
  coordinates.splice(-1,1);
  coordinates.forEach(i => {
    i = i.toString().trim().slice(0, -4);
  });

  for (i = 0; i < coordinates.length; i++) {
    element = coordinates[i].split(",");
    element[1] = element[1].toString();
    element[0] = element[0].toString();
    coordinates[i] = [];
    coordinates[i].push(Number(element[1]));
    coordinates[i].push(Number(element[0]));
  }

  var polyline = L.polyline(coordinates, {color: 'red'}).addTo(map);
  map.fitBounds(polyline.getBounds());
  L.marker(coordinates[0]).addTo(map).bindPopup('Začátek');
  L.marker(coordinates[coordinates.length-1]).addTo(map).bindPopup('Konec');
}

window.onload = loadXMLDoc();