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
              <li class="active"><a href="alternatif.php">Data Alternatif</a></li>
			  <li><a href="analisa.php">Hasil Analisa</a></li>
			</ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
		
	<div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="panel panel-success">
		  <!-- Default panel contents -->
		  <div class="panel-heading">Tambah Data Alternatif</div>
		  <div class="panel-body">
										<?php
											include 'configdb.php';
											$kriteria = $mysqli->query("select * from kriteria");
											if(!$kriteria){
												echo $mysqli->connect_errno." - ".$mysqli->connect_error;
												exit();
											}
											$i=0;
											while ($row = $kriteria->fetch_assoc()) {
												@$k[$i] = $row["kriteria"];
												$i++;
											}
										?>
							<form role="form" method="post" action="add.php">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="alternatif">Alternatif</label>
                                            <input type="text" class="form-control" name="alternatif" id="alternatif" placeholder="Alternatif Alat Kontrasepsi">
                                        </div>
										<div class="form-group">
                                            <label for="k1"><?php echo ucwords($k[0]);?></label>
                                            <select class="form-control" name="k1" id="k1">
												<option value='1'>1</option>
												<option value='2'>2</option>
												<option value='3'>3</option>
												<option value='4'>4</option>
												<option value='5'>5</option>
												<option value='6'>6</option>
												<option value='7'>7</option>
												<option value='8'>8</option>
												<option value='9'>9</option>
										    </select>
                                        </div>
										<div class="form-group">
                                            <label for="k2"><?php echo ucwords($k[1]);?></label>
                                           <select class="form-control" name="k2" id="k2">
												<option value='1'>1</option>
												<option value='2'>2</option>
												<option value='3'>3</option>
												<option value='4'>4</option>
												<option value='5'>5</option>
												<option value='6'>6</option>
												<option value='7'>7</option>
												<option value='8'>8</option>
												<option value='9'>9</option>
										    </select>
                                        </div>
										<div class="form-group">
                                            <label for="k3"><?php echo ucwords($k[2]);?></label>
                                            <select class="form-control" name="k3" id="k3">
												<option value='1'>1</option>
												<option value='2'>2</option>
												<option value='3'>3</option>
												<option value='4'>4</option>
												<option value='5'>5</option>
												<option value='6'>6</option>
												<option value='7'>7</option>
												<option value='8'>8</option>
												<option value='9'>9</option>
										    </select>
                                        </div>
										<div class="form-group">
                                            <label for="k4"><?php echo ucwords($k[3]);?></label>
                                           <select class="form-control" name="k4" id="k4">
												<option value='1'>1</option>
												<option value='2'>2</option>
												<option value='3'>3</option>
												<option value='4'>4</option>
												<option value='5'>5</option>
												<option value='6'>6</option>
												<option value='7'>7</option>
												<option value='8'>8</option>
												<option value='9'>9</option>
										    </select>
                                        </div>
										<div class="form-group">
                                            <label for="k5"><?php echo ucwords($k[4]);?></label>
                                           <select class="form-control" name="k5" id="k5">
												<option value='1'>1</option>
												<option value='2'>2</option>
												<option value='3'>3</option>
												<option value='4'>4</option>
												<option value='5'>5</option>
												<option value='6'>6</option>
												<option value='7'>7</option>
												<option value='8'>8</option>
												<option value='9'>9</option>
										    </select>
                                        </div>
									</div><!-- /.box-body -->

									<div class="box-footer">
										<button type="reset" class="btn btn-primary">Reset</button>
										<a href="alternatif.php" type="cancel" class="btn btn-warning">Batal</a>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                            </form>
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
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="ui/js/ie10-viewport-bug-workaround.js"></script>

</body></html>