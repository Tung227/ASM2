<?php
require_once ('dbhelp.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Management</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

	
</head>
<body>

	<div class="container" style="background-color: #eaf7ea;">
		<div class="panel panel-primary" >
			<div class="panel-heading" style="background-color: #eaf7ea; color: white; text-align: center; ">
			<img src="img/k1-1.webp"  style="width: 300px; height: 70px; margin-right: 10px;">
				<form method="get">
					<input type="text" name="s" class="form-control" style="margin-top: 10px; margin-bottom: 15px;" placeholder="Tìm kiếm theo tên">
				</form>
			</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>ID</th>
							<th>MaSV</th> <!-- New column added -->
							<th>Student Name</th>
							<th>Age</th>
							<th>Address</th>
							<th width="60px"></th>
							<th width="60px"></th>
						</tr>
					</thead>
					<tbody>
<?php
if (isset($_GET['s']) && $_GET['s'] != '') {
	$sql = 'select * from colleges where fullname like "%'.$_GET['s'].'%"';
} else {
	$sql = 'select * from colleges';
}

$studentList = executeResult($sql);

$index = 1;
foreach ($studentList as $std) {
	echo '<tr>
			<td>'.($index++).'</td>
			<td>'.$std['masv'].'</td>
			<td>'.$std['fullname'].'</td>
			<td>'.$std['age'].'</td>
			<td>'.$std['address'].'</td>
			<td><button class="btn btn-warning" onclick=\'window.open("input.php?id='.$std['id'].'","_self")\'>Edit</button></td>
			<td><button class="btn btn-danger" onclick="deleteStudent('.$std['id'].')">Delete</button></td>
		</tr>';
}
?>
					</tbody>
				</table>
				<button class="btn btn-success" onclick="window.open('input.php', '_self')">Add Student</button>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function deleteStudent(id) {
			option = confirm('Bạn có muốn xoá sinh viên này không')
			if(!option) {
				return;
			}

			console.log(id)
			$.post('delete_student.php', {
				'id': id
			}, function(data) {
				alert(data)
				location.reload()
			})
		}
	</script>
</body>
</html>