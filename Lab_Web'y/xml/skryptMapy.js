let latArray = [52.222051, 51.249638, 50.039768];
let lngArray = [20.977549, 22.538693, 21.995904];
const myLatLng = [{ lat: latArray[0], lng: lngArray[0] }, { lat: latArray[1], lng: lngArray[1] }, { lat: latArray[2], lng: lngArray[2] }];

let map;
var xmlDoc;

function loadXMLfile(fileName, callback) {
  var xhttp;
  //For Internet Explorer
  if (window.ActiveXObject) {
    try {
      xhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e1) {
      try {
        xhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch (e2) { }
    }
  }
  //For Chrome, Firefox, Opera, etc.
  else {
    xhttp = new XMLHttpRequest();
  }

  // If we couldn't make one, abort.
  if (!xhttp) {
    window.alert("Brak wsparcia AJAX w twojej przeglądarce!");
    return false;
  }

  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      callback(this);
    }
    else {
      console.log("Błąd wczytania pliku: " + fileName);
    }
  };

  xhttp.open("GET", fileName, true);
  try {
    xhttp.responseType = "msxml-document";
  }
  catch (err) { }  //For Internet Explorer 11
  xhttp.send();
};

function transformXMLDoc(xml, xsl) {
  var xsltProcessor, parser, resultDocument;
  try {
    //For Internet Explorer
    if (window.ActiveXObject || "ActiveXObject" in window || xml.responseType == "msxml-document") {
      resultDocument = new ActiveXObject("MSXML2.DOMDocument");
      resultDocument = xml.transformNode(xsl);
      parser = new DOMParser();
      resultDocument = parser.parseFromString(resultDocument, "text/xml");
    }
    //For Chrome, Firefox, Opera, etc.
    else if (document.implementation && document.implementation.createDocument) {
      xsltProcessor = new XSLTProcessor();
      xsltProcessor.importStylesheet(xsl);
      resultDocument = xsltProcessor.transformToDocument(xml, document);
    }
  }
  catch (err) {
    if (typeof (err) == "object") {
      if (err.message) {
        alert(err.message);
      }
    }
    else {
      alert(err);
    }
  }

  return resultDocument;
};

function initMap() {

  map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: 52, lng: 20 },
    zoom: 6,
  });
  // for (i in myLatLng) {
  //   new google.maps.Marker({
  //     position: myLatLng[i],
  //     map,
  //   });
  // }

  loadXMLfile("./xml/transformacjaXML.xsl", function (xslhttp) {
    loadXMLfile("./xml/siec_salonow.xml", function (xmlhttp) {
      xmlDoc = transformXMLDoc(xmlhttp.responseXML, xslhttp.responseXML);
      var siec_salonow = xmlDoc.documentElement.getElementsByTagName("salon");
      for (var i = 0; i < siec_salonow.length; i++) {
        var lat = siec_salonow[i].getAttribute('lat');
        var lng = siec_salonow[i].getAttribute('lng');
        var latLng = new google.maps.LatLng(lat, lng);
        new google.maps.Marker({
          position: latLng,
          map: map,
          label: siec_salonow[i].name
        })
      }
    });
  });

}

loadXMLfile();
initMap();