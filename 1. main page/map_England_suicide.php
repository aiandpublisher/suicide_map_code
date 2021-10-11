<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Suicide Mortality in England</title>
		<meta charset="UTF-8">
		<style>
			#mapid { 
				height:520px;
				width: 63%; 
				float: left;
				margin-left:3%;
			}
			.filter h3{
				color:#d4c9e7;
			}
			.filter_content{
				background-color:#333333;
				padding:3px;
			}

		</style>

		<!-- link to the source library, and integrity parameter is for security check -->	
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
			integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
			crossorigin=""/>
		
		<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
			integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
			crossorigin=""></script>

	    <!-- uses a css file for universal page setings for this website -->	
	    <link rel="stylesheet" href="style.css"/>
	    <?php include("./mapdata.php"); ?>
		<script src="./England-grid-suicideDataByDistrict.geojson"></script>
		<script src="./maplogics.js"></script>
		<!-- the js codes used to configure the map are seperated from this document, for easier maintainence -->	
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
					    <span id='menu'>
					    	<img src="https://img.icons8.com/material-outlined/32/ffffff/navigation.png" alt="navigation icon"/>
					    </span>
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
					<div style='clear: both;'>
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
			<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="get">


				<!-- 2019 population dataset is used to calculate suicide rate.
				     this filter considers the population size of each district,
				     which certainly affects suicide number  -->
				<h3 class="filter">Filter about rate & population:</h3>
				<div class="filter_content">
					<input type="radio" name="filter_change" value="0" checked> No filter<br>
					<input type="radio" name="filter_change" value="1"> Higher than average suicide rate<br>
					<input type="radio" name="filter_change" value="2"> Lower than average suicide rate<br>
					<input type="radio" name="filter_change" value="3"> 40 districts with highest suicide rate<br>
					<input type="radio" name="filter_change" value="4"> 40 districts with lowest suicide rate<br>
					<input type="radio" name="filter_change" value="5"> 40 districts with highest population<br>
					<input type="radio" name="filter_change" value="6"> 40 districts with lowest population<br>
	            </div>


				<!-- it compares with the 2018 dataset to see areas where suicide number increases, decreases, increases profoundly, decreases profoundly  -->
				<h3 class="filter">Compare with 2018 suicide data:</h3>
				<div class="filter_content">
					<input type="radio" name="filter_change" value="7"> Suicide deaths > 2018<br>
					<input type="radio" name="filter_change" value="8"> Suicide deaths = 2018<br>
					<input type="radio" name="filter_change" value="9"> Suicide deaths &lt; 2018<br>
				</div>

				<!-- compares with the 2019 well-beings dataset, 
				     this filter shows the relation between public psychological status and suicide data  -->
				<h3 class="filter">Filter about well-beings:</h3>
				<div class="filter_content">

					<input type="radio" name="filter_change" value="10"> 40 most satisfying districts <br>
					<input type="radio" name="filter_change" value="11"> 40 most anxious districts <br>
					<input type="radio" name="filter_change" value="12"> 40 happiest districts <br>
					<input type="radio" name="filter_change" value="13"> 40 most worthwhile districts <br>
			    </div>

				<!-- submit the selected filter  -->
				<input type="submit" value="Submit" class="buttom">	
			</form>
		</div>  
        <!-- end of the right side bar -->
        


        <!-- footer of the page -->
        <footer>Data sets provided by <a href="https://www.ons.gov.uk/">Office for National Statistics licensed under the Open Government Licence v.3.0</a>; navigation icon by <a href="https://icons8.com/icon/113343/navigation">Icons8</a>; map implemented by the <a href="https://www.leafletjs.com/">Leaflet Library</a> </footer>



        <!-- JS code for the pull-down menu -->
		<script>
		    document.getElementById('menu').addEventListener('click', function () {
		        var nav = document.getElementsByTagName('nav')[0];
		        if (nav.style.display == 'block') {
		            nav.style.display = 'none';
		        } else {
		            nav.style.display = 'block';
		        }
		    }, false);
		</script>
	</body>
</html>
