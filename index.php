<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Beutl | Text Tool</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
		 folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
	<!-- Morris chart -->
	<link rel="stylesheet" href="bower_components/morris.js/morris.css">
	<!-- jvectormap -->
	<link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
	<!-- Date Picker -->
	<link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<!-- bootstrap wysihtml5 - text editor -->
	<link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

	<style>
		textarea {
			min-height: 250px;
			resize: vertical;
		}
	</style>

	<!-- Google Font -->
	<link rel="stylesheet"
		  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	<header class="main-header">
		<!-- Logo -->
		<a href="index2.html" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>B</b>TL</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><b>B</b>eutl</span>
		</a>
		<!-- Header Navbar: style can be found in header.less -->
		<nav class="navbar navbar-static-top">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
	</header>
	<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<!-- /.search form -->
			<!-- sidebar menu: : style can be found in sidebar.less -->
			<ul class="sidebar-menu" data-widget="tree">
				<li class="header">MAIN NAVIGATION</li>
				<li class="active">
					<a href="#">
						<i class="fa fa-dashboard"></i> <span>Main Application</span>
					</a>
				</li>
			</ul>
		</section>
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				Dashboard
				<small>Main Application</small>
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<form onsubmit="return false;">
					<div class="col-md-12">
						<div class="box box-success">
							<div class="box-header with-border">
								<h3 class="box-title">Rules</h3>
							</div>
							<!-- /.box-header -->
							<!-- form start -->
							<div class="box-body">
								<div class="form-group col-md-4">
									<label>Text Case</label>
									<select class="form-control text-case">
										<option value="0">--</option>
										<option value="1">All to Lowercase</option>
										<option value="2">All to Uppercase</option>
										<option value="3">Capitalize words</option>
									</select>
								</div>
								<div class="form-group col-md-4">
									<label>Spaces</label>
									<select class="form-control space">
										<option value="0">--</option>
										<option value="1">Remove All Spaces</option>
									</select>
								</div>
								<div class="form-group col-md-4">
									<label>Line Breaks</label>
									<select class="form-control line-break">
										<option value="0">--</option>
										<option value="1">Remove All Line Breaks</option>
									</select>
								</div>
								<div class="form-group col-md-4">
									<label>Sort Words</label>
									<select class="form-control sort">
										<option value="0">--</option>
										<option value="1">A - Z or 0 - 9</option>
										<option value="2">Reverse (Z - A or 9 - 0)</option>
									</select>
								</div>
								<div class="form-group col-md-4">
									<label>Show Lines</label>
									<div class="row">
										<div class="col-md-6">
											<input id="show-word-count" type="number" class="form-control"
												   data-toggle="tooltip" data-placement="left" title="Word Count"
												   placeholder="Word Count">
										</div>
										<div class="col-md-6">
											<input id="show-character-count" type="number" class="form-control"
												   data-toggle="tooltip"
												   data-placement="left" title="Character Count"
												   placeholder="Character Count">
										</div>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label>Remove Lines</label>
									<div class="row">
										<div class="col-md-6">
											<input id="remove-word-count" type="number" class="form-control"
												   data-toggle="tooltip" data-placement="left" title="Word Count"
												   placeholder="Word Count">
										</div>
										<div class="col-md-6">
											<input id="remove-character-count" type="number" class="form-control"
												   data-toggle="tooltip"
												   data-placement="left" title="Character Count"
												   placeholder="Character Count">
										</div>
									</div>
								</div>
								<div class="form-group col-md-4">
									<label>Remove (Case Sensitive)</label>
									<div>
										<label class="checkbox-inline">
											<input id="remove-duplicate-lines" type="checkbox" value="">Remove Duplicate
											Lines
										</label>
									</div>
								</div>
							</div>
							<!-- /.box-body -->

							<div class="box-footer">
								<button id="process-btn" type="button" class="btn btn-success"
										data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
									Process Text
								</button>
								<button id="reset-btn" type="button" class="btn btn-danger">
									Reset
								</button>
							</div>
						</div>
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Input</h3>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="form-group">
									<textarea id="input-text" class="form-control" rows="3"
											  placeholder="Enter ..."></textarea>
								</div>
								<div class="box-body" style="">
									Character Count: <h4 id="character-count">0</h4>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
						<div class="box box-primary">
							<div class="box-header with-border">
								<h3 class="box-title">Result</h3>
							</div>
							<!-- /.box-header -->
							<div class="box-body">
								<div class="form-group">
									<textarea id="output-text" class="form-control" rows="3" disabled></textarea>
								</div>
								<div class="box-body" style="">
									Character Count: <h4 id="result-character-count">0</h4>
								</div>
							</div>
							<!-- /.box-body -->
						</div>
					</div>
				</form>
			</div>
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<b>Version</b> 2.4.0
		</div>
		<strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
		reserved.
	</footer>

	<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
		 immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
