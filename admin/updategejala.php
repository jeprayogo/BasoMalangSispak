<?php 
	session_start()
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dokter - Dashboard</title>
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/font-awesome.min.css" rel="stylesheet">
	<link href="../assets/css/datepicker3.css" rel="stylesheet">
	<link href="../assets/css/styles.css" rel="stylesheet">
	
	<link href="../favicon.ico" rel="shortcut icon">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>SIPARTUS &nbsp;</span>Sistem Pakar Pendeteksi Ancaman Abortus</a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="../assets/img/profile.png" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">Username</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li><a href="dashboard.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="datauser.php"><em class="fa fa-user">&nbsp;</em> Data User</a></li>
			<li class="active"><a href="gejala.php"><em class="fa fa-eye">&nbsp;</em> Gejala</a></li>
			<li><a href="penyakit.php"><em class="fa fa-bug">&nbsp;</em> Penyakit</a></li>
			<li><a href="../logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li>Gejala</li>
				<li class="active">Ubah Gejala</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Ubah Gejala</h1>
			</div>
		</div><!--/.row-->
		<?php 
		  	require_once "../koneksi.php";
    		$kd_gejala = $_GET['kd_gejala'];
    		$data = mysqli_query($koneksi,"SELECT * FROM gejala WHERE kd_gejala='$kd_gejala' ")or die(mysqli_error($koneksi));
    		$baris = mysqli_fetch_array($data);
    	?>
	<form action="updategejala.php?kd_gejala=<?php echo $kd_gejala; ?>" method="post" accept-charset="utf-8">
		<div class="form-group">
			<label for="kd_gejala">Kode Gejala</label>
			<input type="text" name="kd_gejala" class="form-control" value="<?php echo $baris['kd_gejala']; ?>">
		</div>
		<div class="form-group">
			<label for="nama_gejala">Nama Gejala</label>
			<input type="text" name="nama_gejala" class="form-control" value="<?php echo $baris['nama_gejala']; ?>">
		</div>
		<button type="submit" class="btn btn-success" name="ubah">Ubah</button>
	</form>	
	
	<?php 
		require_once "../koneksi.php";

		if (isset($_POST['ubah'])) {
			$kd_oldgejala = $_GET['kd_gejala']; 
			$kd_gejala = $_POST['kd_gejala'];
			$nama_gejala = $_POST['kd_gejala'];

			$query = mysqli_query($koneksi, "UPDATE gejala SET nama_gejala='$nama_gejala'") or die(mysqli_error($koneksi));

			if ($query) {
				header("location: gejala.php");
			} else {
				echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
				echo "<br><a href='updategejala.php'>Kembali Ke Form</a>";
			}
		}

	 ?>

	<script src="../assets/js/jquery-1.11.1.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script src="../assets/js/chart.min.js"></script>
	<script src="../assets/js/chart-data.js"></script>
	<script src="../assets/js/easypiechart.js"></script>
	<script src="../assets/js/easypiechart-data.js"></script>
	<script src="../assets/js/bootstrap-datepicker.js"></script>
	<script src="../assets/js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>
