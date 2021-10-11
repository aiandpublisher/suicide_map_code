function initialise() {
	
	// create the tile layer with correct attribution
	var osmUrl='https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png';
	var osmAttrib='Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
	var osm = new L.TileLayer(osmUrl, {minZoom: 4, maxZoom: 12, attribution: osmAttrib});		
  
  // create the main map object
	myMap = new L.Map('mapid');  
	myMap.setView(new L.LatLng(53, -2),6);  // start the map according to the following location and zoom level
	myMap.addLayer(osm);  


  // another layer draws polygons, although it is more recommendable to put the declarations first, 
  // here the variables are defined in seperate parts for more readability
  var geojson;
  geojson=L.geoJSON(myPolys,{style: style,onEachFeature: eachPoly,filter:filter});
  geojson.addTo(myMap); 


  // information feature shows the district name when the mouse moves over the area
  var info = L.control();
  info.onAdd = function (myMap) {
    this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
    this.update();
    return this._div;
  };
  info.update = function (props) {   // update the control based on feature properties
    this._div.innerHTML = '<h2>「 District Name 」</h2>' +  
    (props ? '<h3>' + props.LAD20NM + '</h3>': '<h3>Hover over an area</h3>');
  }; 
  info.addTo(myMap);


  // adds the color lengend
  var legend = L.control({position: 'bottomleft'});
  
  legend.onAdd = function (a) {
      var div = L.DomUtil.create('div', 'info legend'),
          grades = [0, 10, 20, 30, 40, 50, 60, 70, 80, 90, 100],
          labels = [];
          div.innerHTML += 'Suicide<br/>Death<br/>Numbers<br/>';
      // loops through the choosen intervals and creates a label with the color for each interval
      for (var i = 0; i < grades.length; i++) {
          div.innerHTML +=
              '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
              grades[i] + '<br>';
      } 
      return div;
  };

  legend.addTo(myMap);


  // leaflet styling function for the polygons
	function style(feature) {
		return {
			fillColor: getColor(feature.properties.DistrictSuicideData_2019),
			//the color depends on the suicide data it retrieved,
			weight: 0.8,
			opacity: 1,
			color: '#051140',
			dashArray: '3',
			fillOpacity: 0.8
		};
	}


  // adjust the color by the value of suicide number
  function getColor(d) {
    return d > 100 ? '#3401A8' :
           d > 90 ? '#4415ae' :
           d > 80 ? '#5429b5' :
           d > 70 ? '#643dbb' :
           d > 60 ? '#7451c1' :
           d > 50 ? '#8465c8' :
           d > 40 ? '#a48dd4' :
           d > 30 ? '#b4a1da' :
           d > 20 ? '#c4b5e1' : 
           d > 10 ? '#d4c9e7' :
           d > 0  ? '#f2f0f5' :
           '#000000'
           ;
  }


  // adds popup for each polygon
  function eachPoly(feature, layer) {
    layer.on({
          mouseover: highlightFeature,
          mouseout: resetHighlight,
      });
      var name = feature.properties.LAD20NM;
      var code = feature.properties.LAD20CD;
      var num = feature.properties.DistrictSuicideData_2019;
    
      var popupContent = "<div class='popup'><h2>" + name + "</h2><h3>" + code + "</h3><h3>Suicide Number: <span style='color:blue'>"+String(num)+"</span></h3></div>";

      layer.bindPopup(popupContent);
  }


  // when the mouse is moved out, the highlight effect will be reset
  function resetHighlight(e) {
    geojson.resetStyle(e.target);
    info.update();
  }


  // when the mouse is moved over, the highlight effect will be trigged
  function highlightFeature(e) {
    var layer = e.target;
    layer.setStyle({
        weight: 4,
        dashArray: '',
        fillOpacity: 1
    });

    //avoid have clash risks due to browsers
    if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
        layer.bringToFront();
    }
    info.update(layer.feature.properties);
  }


  // filter the map data
  function filter(feature) {
    var code = feature.properties.LAD20CD;
    var string;

    for (item in suicideData){
      if (code === suicideData[item].areacode){
        string = true;
        }
    }
    return string; // returns true if the areacode exists in the result json array
  }

}
