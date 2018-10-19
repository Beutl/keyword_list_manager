<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
		  type="text/css">
	<link rel="stylesheet" href="https://v40.pingendo.com/assets/4.0.0/default/theme.css" type="text/css">
</head>

<body>
<form onsubmit="return false;">
	<div class="p-1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="display-4">
						<b style="font-weight: bold;">Keyword List</b>
						<i>Manager</i>
					</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="p-0">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<h3 class="">REMOVE LINES from list #2 IF lines from list #1 are found within lines in list #2</h3>
				</div>
			</div>
		</div>
	</div>
	<div class="p-1">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<div class="accordion" id="accordionExample">
						<div class="card">
							<div class="card-header" id="headingOne">
								<h5 class="mb-0">
									<button class="btn btn-link" type="button" data-toggle="collapse"
											data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										Click HERE to Show Example
									</button>
								</h5>
							</div>

							<div id="collapseOne" class="collapse" aria-labelledby="headingOne"
								 data-parent="#accordionExample">
								<div class="card-body">
									<p>

									</p>
									<div>
										<em><strong>List #1:</strong></em> <span>To use for cleaning list #2</span>
									</div>
									<code>xxx yyy</code><br>
									<code>aaa bbb</code><br>
									<code>zzz</code>
									<div>
										<div>
											<strong><em>List #2:</em></strong> <span>The "Main" List we Use and Clean Up with List #1</span>
										</div>
										<code>aaa bbb ccc</code><br>
										<code>xxx</code><br>
										<code>zzz yyy</code><br>
										<code>ddd eee</code><br>
										<div>
											<em><strong>Output</strong></em> <span>After Top List (#1) Removed From Bottom List (#2)</span>
										</div>
										<code>xxx</code><br>
										<code>ddd eee</code><br>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="p-1">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<p class="lead">List #1</p>
					<div class="form-group">
              <textarea class="form-control form-control-sm" id="toRemove" rows="10">
			  </textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="p-1">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<p class="lead">List #2</p>
					<div class="form-group">
              <textarea class="form-control form-control-sm" id="removeFrom" rows="10">
			  </textarea>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="p-1">
		<div class="container">
			<div class="row">
				<div class="col-md-10">
					<p class="lead">Clean List</p>
					<button id="removeFromListBtn" type="button" class="btn btn-primary">Remove List #1 From List #2
					</button>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
			integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
			crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
			integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
			crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
			integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
			crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</form>
</body>

</html>

<script>
    $(document).ready(function () {
        $("#removeFromListBtn").click(function () {
            $.ajax({
                url: "KeywordListManager.php", //the page containing php script
                type: "post", //request type,
                dataType: 'json',
                data: {toRemove: $('#toRemove').val(), removeFrom: $('#removeFrom').val()},
                success: function (result) {
                    $('#removeFrom').val(result);
                }
            });
        });
    });
</script>