<html>
<head>
<title>Uas PPI Cuaca</title>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/
bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/
bootstrap-theme.min.css">
<style>
body {
    font-size: 3em;
	font-family: "Times New Roman", Times, serif;
	background: #800000;
	background-color:#2115C3;
	background-size:cover;
	background-position:center;
}
.elements{
	text-align:center;
	
}
.display{
	color:#ffffff;
}
#button{
	width: 10em;  
}
#text{
		height: 5%;
		width:60%;
		margin-left: auto;
		margin-right: auto;
}
</style>
</head>
<body background = "pic">
<div class="elements">
<font color = "white" >
 <h1><b>Prediksi Cuaca</b></h1></font>
<form action ="index.php" method="post">

<font color = "yellow" >
Berdasarkan:
  <!--<input type ="radio" name="searchby" value="city_name" required> Kota
  <input type ="radio" name="searchby" value="zip_value"> Zip Kode-->
  <br>
  <input type="text" id="text" class="form-control" name="entry" value="" placeholder="Masukkan kota atau Zip kode" required >
  
Centang :  
  <input type="checkbox" name="resultoption" value="five_day"> untuk 5 Hari mendatang<br></font>
  <input type="submit" id="button" class="btn btn-success btn-lg" name ="submit" value="Cek">
  
  </div>
  </form>
  <div class="display">
  <?php
  if (isset($_POST["submit"])) {
	  	echo "You are searching by entering ".$_POST["entry"] ;
			if (isset($_POST["resultoption"]))
				do5day();
			else
				docity();
  }
  
   function docity(){
	   $_POST["entry"] = str_replace(' ', '%20', $_POST["entry"]);
  
   $url = "http://api.openweathermap.org/data/2.5/weather?q=".$_POST["entry"]."&APPID=503830f051e7f1eac47ff727c255e925";
   display_parameters($url);
	
   }
   function display_parameters($url){
	
   $content = file_get_contents($url);
    $json = json_decode($content, TRUE);
	$max_temp = $json['main']['temp_max'] - 273.15;
	$min_temp = $json['main']['temp_min'] - 273.15;
	
	$city = $json['name'];
	$country = $json['sys']['country'];
	if (!(isset($city))){
		echo "Kota yang anda masukkan salah";
	}
	else{
	//echo $city;
	echo "Hasil pencarian di Kota: ".$city.","." $country"."<br />";
	
	
	$weather = array($json['weather']);
	
	$weather2 = array($json['weather']);
	echo "Hasil: ".$weather[0][0]['description']."<br />";
	echo "Temperatur Maximum: ".$max_temp." &deg;C"."<br />";
	echo "Temperatur Minimum: ".$min_temp." &deg;C"."<br />";
	echo "Kelembaban: ".$json['main']['humidity']." %"."<br />";
	echo "Kecepatan Angin: ".$json['wind']['speed']." m/s"."<br />";
	echo "Tekanan: ".$json['main']['pressure']." hpa"."<br />";}
//	echo "urlimage = ".$json ['openweathermap.org/img/w/" + id_icon + ".png"'];}
	
	
   }
   function do5day(){
	$_POST["entry"] = str_replace(' ', '%20', $_POST["entry"]);
	$url = "http://api.openweathermap.org/data/2.5/forecast?q=".$_POST["entry"]."&APPID=97bacb20e0aa8624d3ebc92c87801fae";
	$content = file_get_contents($url);
    $json = json_decode($content, TRUE);
	$city = $json['city']['name'];
	$country = $json['city']['country'];
	
	if (!(isset($city))){
		echo "Kota yang anda masukkan salah";
	}
	
	else{
	echo "Perkiraan cuaca di Kota : ".$city.","." $country"."<br />";
	echo "<strong>"."5 Hari Mendatang"."</strong>"."<br /><br />";
	
echo "<br/>
	
		<br/> 
		<html>
		<head>
		<style>
		table {
			border-collapse: collapse;
			width: 50%;
			color: white;
		}

		th, td {
			padding: 8px;
			text-align: left;
			
			border-bottom: 1px solid #ddd;
		}
		</style>
				
		<table >
		<tr>
		<th >Tanggal</th>
		<th>Hasil</th>
		
		<th>Kelembaban</th>
		
		</tr>
";
	
	
	
	
	for ($x = 0; $x <= 4; $x++) {
		
   echo "<tr> <td> ".$json['list'][$x]['dt_txt']."</td>";
	echo " <td> ".$json['list'][$x]['weather'][0]['description']."</td>";
	echo " <td> ".$json['list'][$x]['main']['humidity']." %"."<br /></td></tr>";
	//echo "Status: ".$json['list'][$x]['weather'][$x]['icon'].".png"."<br /><br />";
	}
	echo 
	
	"</table>"
		;
	
	} 
   }
   
?>
</div>  

</body>
</html>