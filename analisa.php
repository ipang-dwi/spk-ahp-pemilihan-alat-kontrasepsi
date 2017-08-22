<?php
	session_start();
	include('configdb.php');
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title><?php echo $_SESSION['judul']." - ".$_SESSION['by'];?></title>
	
    <!-- Bootstrap core CSS -->
    <!--link href="ui/css/bootstrap.css" rel="stylesheet"-->
	<link href="ui/css/cosmo.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="ui/css/jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--script src="./index_files/ie-emulation-modes-warning.js"></script-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><?php echo $_SESSION['judul'];?></a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="index.php">Home</a></li>
              <li><a href="kriteria.php">Data Kriteria</a></li>
              <li><a href="alternatif.php">Data Alternatif</a></li>
			  <li class="active"><a href="#">Hasil Analisa</a></li>
			</ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
	<div class="container">
      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-success">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Analisa</div>
		  <div class="panel-body">
			<div>
				<canvas id="canvas"></canvas>
			</div>
			<br />
			<?php
										$arl = 5;	//array lenght, 4 means ordo for 4x4 matrix
										$alternatif = 0;
										$kri = get_kriteria();
										$alt = get_alternatif();
										$mb = create_mx($kri);
										for($i=0;$i<$arl;$i++){
											@$mbk[$i] = create_mx($alt[$i]);
										}
										echo "<center>";
										$k = print_art($mb,$arl,0);
										$al = array(
											0 => print_art($mbk[0],$arl,1),   //
											1 => print_art($mbk[1],$arl,1),   //
											2 => print_art($mbk[2],$arl,1),   //
											3 => print_art($mbk[3],$arl,1),    //
											4 => print_art($mbk[4],$arl,1)    //
										);
										
										$wil = get_alt_name();   //new up 5 lines
										$kriteria = get_kri_name();   //new up 5 lines
										end($wil); $arl2 = key($wil)+1; //new
										for($i=0; $i<$arl2; $i++){ //new
											for($j=0; $j<$arl; $j++){
												@$pha[$i] = $pha[$i] + ($k[$j]*$al[$j][$i]);
											}
											$pha[$i] = round($pha[$i],2);
										}
								?>
								<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <?php
												for($i=0; $i<$arl2; $i++){ //new
													echo "<th>".$wil[$i]."</th>";
												}
												?>
												<th>Prioritas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											for($i=0; $i<$arl; $i++){
												echo "<tr>";
													echo "<td>".$kriteria[$i]." </td>";
													for($j=0; $j<$arl2; $j++){ //new
														echo "<td>".$al[$i][$j]."</td>";
													}
													echo "<td>".$k[$i]."</td>";
												echo "</tr>";
											}
											echo "<tr><td>Jumlah Hasil Perkalian</td>";
											for($i=0; $i<$arl2; $i++){
												echo "<td>".$pha[$i]."</td>";
											}
											echo "<td></td></tr>";
											?>
                                        </tfoot>
                                </table>
								<div class="alert alert-dismissible alert-success">
								<?php
										uasort($pha,'cmp');
										for($i=0;$i<$arl2;$i++){ //new for 8 lines below
											if($i==0)
												echo "<b><i>Dari tabel tersebut dapat disimpulkan bahwa ".$wil[array_search((end($pha)), $pha)]." mempunyai hasil paling tinggi, yaitu ".current($pha);
											elseif($i==$arl2-1)
												echo "</br>Dan terakhir ".$wil[array_search((prev($pha)), $pha)]." dengan nilai ".current($pha).".</i></b>";
											else
												echo "</br>Lalu diikuti dengan ".$wil[array_search((prev($pha)), $pha)]." dengan nilai ".current($pha);
										}
								?>
								</br>
								</div>
								<a href='detail.php' class="text-success" target=_blank>Klik untuk melihat detail proses.</a>
		  </div>
		  <div class="panel-footer"><?php echo $_SESSION['by'];?><div class="pull-right"></div></div>
		</div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="ui/js/jquery-1.10.2.min.js"></script>
	<script src="ui/js/bootstrap.min.js"></script>
	<script src="ui/js/bootswatch.js"></script>
	<script src="ui/js/Chart.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ui/js/ie10-viewport-bug-workaround.js"></script>
	<!-- chart -->
	<script>
	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	var barChartData = {
		labels : [
			<?php 
				for($i=0;$i<$arl2;$i++){
					echo '"'.$wil[$i].'",';
				}
			?>
		],
		datasets : [
			{
				fillColor : "rgba(128,255,128,0.5)",
				strokeColor : "rgba(220,220,220,0.8)",
				highlightFill: "rgba(0,255,0,0.75)",
				highlightStroke: "rgba(220,220,220,1)",
				data : [
					<?php 
						for($i=0;$i<$arl2;$i++){
							echo $pha[$i].',';
						}
					?>
				]
			},
			/*{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
			}*/
		]

	}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
	}

	</script>
</body>
			
<?php
										function cmp($a, $b) {		//function for last sorting
											if ($a == $b) {
												return 0;
											}
											return ($a < $b) ? -1 : 1;
										}
												 
										function print_art(array $x,$arl,$type){	
											global $alternatif;
											end($x); $arl = key($x)+1; //new
											for($i=0; $i<$arl; $i++){	//sum of each column
												for($j=0; $j<$arl; $j++){
														@$jml[$i] = $jml[$i] + $x[$j][$i];
												}
											}
											for($i=0; $i<$arl; $i++){
													for($j=0; $j<$arl; $j++){
														$mnk[$i][$j]=round(($x[$i][$j]/$jml[$j]),2);
														@$jmlnk[$i] = $jmlnk[$i] + $mnk[$i][$j]; 	//sum of each row
													}
													$prio[$i] = round(($jmlnk[$i]/$arl),2);
											}

											for($i=0; $i<$arl; $i++){
													for($j=0; $j<$arl; $j++){
														$mp[$i][$j]=round(($x[$i][$j]*$prio[$i]),2);
														@$jmlp[$i] = $jmlp[$i] + $mp[$i][$j]; 	//sum of each row
													}
											}
											
											for($i=0; $i<$arl; $i++){
													@$hasil[$i] = round(($jmlp[$i] + $prio[$i]),2);
													@$hsl = $hsl + $hasil[$i]; 
											}

											$nmax = round(($hsl/$arl),2);
											$ci = round((($nmax-$arl)/($arl-1)),2);
											$ri = round(((1.98*($arl-2))/$arl),2);
											@$cr = round(($ci/$ri),2);
											
											$alternatif++;
											return $prio;
										}

										function create_mx(array $input){
											end($input); $l = key($input);
											for($i=0;$i<=$l;$i++){
												for($j=0;$j<=$l;$j++){
													@$hsl[$i][$j] = round(($input[$j]/$input[$i]),2);
												}
											}
											//print_ar($hsl);
											return($hsl);
										}

										function get_kriteria(){
											include 'configdb.php';
											$kriteria = $mysqli->query("select * from kriteria");
											if(!$kriteria){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $kriteria->fetch_assoc()) {
												@$kri[$i] = $row["bobot"];
												$i++;
											}
											//print_ar($kri);
											return $kri;
										}

										function get_kri_name(){
											include 'configdb.php';
											$kriteria = $mysqli->query("select * from kriteria");
											if(!$kriteria){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $kriteria->fetch_assoc()) {
												@$kri[$i] = $row["kriteria"];
												$i++;
											}
											//print_ar($kri);
											return $kri;
										}

										function get_alternatif(){
											include 'configdb.php';
											$alternatif = $mysqli->query("select * from alternatif");
											if(!$alternatif){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $alternatif->fetch_assoc()) {
												@$alt[0][$i] = $row["k1"];
												@$alt[1][$i] = $row["k2"];
												@$alt[2][$i] = $row["k3"];
												@$alt[3][$i] = $row["k4"];
												@$alt[4][$i] = $row["k5"];
												$i++;
											}
											//print_ar($alt);
											return $alt;
										}

										function get_alt_name(){
											include 'configdb.php';
											$alternatif = $mysqli->query("select * from alternatif");
											if(!$alternatif){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $alternatif->fetch_assoc()) {
												@$alt[$i] = $row["alternatif"];
												$i++;
											}
											//print_ar($alt);
											return $alt;
										}

										function print_ar(array $x){	//just for print array
											echo "<pre>";
											print_r($x);
											echo "</pre></br>";
										}
										
									?>
</html>