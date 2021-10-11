<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Search Districs in England</title>
		<meta charset="UTF-8">
		<style>  
			#mapid { 
				height:520px;
				width: 63%; 
				float: left;
				margin-left:3%;
			}
			#search_content h3{
				color:#d4c9e7;
			}

			#search_content h2{
				color:#d4c9e7;
			}

			#search_content{
				padding:3px;
				color:#fff;

			}
			
			
		</style>

		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
			integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
			crossorigin=""/>
		
		<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
			integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
			crossorigin=""></script>

	    <!-- uses a css file for universal page setings for this website -->	
	    <link rel="stylesheet" href="style.css"/>
	    <?php include("./mapdata2.php"); ?>
		<script src="./England-grid-suicideDataByDistrict.geojson"></script>
		<script src="./maplogics.js"></script>
	</head>


	<body onload="initialise()">
		<header>
			<h1 id="main">Suicide Mortality in 2019's England</h1>
	    </header>

	    
		<div id="mapid">
		<!-- container of the interactive map -->	
		</div>
        
        <!-- filter options in the right side bar -->
	    <div id="right">
	    	<section>
			    <div class="container">
	            <!-- navigation bar -->
					<div class='navmenu'>
						<!-- navigation menu -->
					    <span id='menu'><img src="https://img.icons8.com/material-outlined/32/ffffff/navigation.png" alt="navigation icon"/></span>
					    <nav id='navbar'>
						    <ul class='navbar'>
					            <!-- return to homepage, which contains the map -->
						        <li><a href='map_England_suicide.php'>Home</a></li>
						        <!-- introduction to this site, including datasource,
						             design purpose, contact information, etc.  -->
						        <li><a href='map_source.html'>Introduction</a></li>
						        <!-- term of using this map -->
						        <li><a href='map_use.html'>Term of Use</a></li>
						        <!-- a simple search box and the search result both in text and map-->
							    <li><a href='map_search.php'>Search</a></li>
						    </ul>
					    </nav>
					</div>
					<div style='clear: both;'/>
					</div>
				</div>
			</section>
	        

			<?php  
				/* the only bit of PHP actuially used in this example, just to check
				 * that we are set up properly
				 *
				 * the form should re-load the same page. 
				 * The object $_SERVER is built in, and it contains various fields
				 * of which SCRIPT_NAME gives the URL of the current page */
			?>

            <!-- filter section -->
			

		    <h3 style="font-size:150%;">Search</h3>
		    <form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="get">
				<input type="text" name="search_areaname" value="Input a district" style="width:275px; height:30px; font-size:120%; font-family:'Times New Roman',Georgia,Serif;padding-left:3px"/>
				<br/>
				<input type="submit" value="Search" class="buttom"/>
			
			</form>
			<br/>
			<div id="search_content">

			</div>
		</div>  
        <!-- end of the right side bar -->
        
        

        <!-- footer of the page -->
        <footer>Data sets provided by <a href="https://www.ons.gov.uk/">Office for National Statistics licensed under the Open Government Licence v.3.0</a>; navigation icon by <a href="https://icons8.com/icon/113343/navigation">Icons8</a>; map implemented by the <a href="https://www.leafletjs.com/">Leaflet Library</a> </footer>

        
		<!-- JS code for the pull-down menu and right side bar-->
		<script>
		    document.getElementById('menu').addEventListener('click', function () {
		        var nav = document.getElementsByTagName('nav')[0];
		        if (nav.style.display == 'block') {
		            nav.style.display = 'none';
		        } else {
		            nav.style.display = 'block';
		        }
		    }, false);


		    if(suicideData[0]&&condition){ //if a legitimate result is retrieved by input 

		    	for (item in suicideData){ 
		    	document.getElementById("search_content").innerHTML += "<h3>District Name:</h3>" + suicideData[item].areaname;
		    	document.getElementById("search_content").innerHTML += "<h3>District Population:</h3>" + suicideData[item].population_totals;
		    	document.getElementById("search_content").innerHTML += "<h3>Suicide Number in 2019:</h3>" + suicideData[item].data19;
		    	document.getElementById("search_content").innerHTML += "<h3>Suicide Number in 2018:</h3>" + suicideData[item].data18 + "<br/><br/>";
		    	} // provide basic information for all matching districts
		    	
	        }
            else{ // if something is input but not a district name in England
            	document.getElementById("search_content").innerHTML = "Try another district name, such as 'Leeds'";
            } 
            // if nothing is input the page will be refreshed automatically and nothing appears in the right side bar
          
         
		</script>

	</body>
</html>
