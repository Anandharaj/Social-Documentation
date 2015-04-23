<html>
<head>
	<title>Welcome page</title>
	<script type="text/javascript" src="/social-documentation/jquery-2.1.3.min.js"></script>
	<style type="text/css">
		textarea {
			float: left;
			width:500px;
			height: 500px;
		}
	</style>
</head>
<body onload="searchFile()">
	<?php
		include("curd_lib.php");
		$sql = new MySqlLib();
		$table_name = "userprofile";
		$sql->connectDB("localhost", "root", "tiger", "mydb");
		$result = $sql->find($table_name, "*", "logged=true");
		$row = mysqli_fetch_assoc($result);
		$list_files = ["file_1.txt", "file_2.txt", "file_3.txt"];
		$userName = $row['userName'];
		echo "<h3>Welcome $userName.....!</h3>";
		echo "<a href='/social-documentation/index.php?userName=$userName&table_name=$table_name'>SignOut</a>";
	?>
<!-- 	<ul>
		<li><button onclick="openFile(this)">file_1.txt</button>
			<br>
			<label>Read</label><input name="mode_1" value="read" checked="checked" type="radio">
			<label>Append</label><input name="mode_1" value="append" type="radio">
			<label>Write</label><input name="mode_1" value="write" type="radio">
		</li>
		<li><button onclick="openFile(this)">file_2.txt</button>
			<br>
			<label>Read</label><input name="mode_2" value="read" checked="checked" type="radio">
			<label>Append</label><input name="mode_2" value="append" type="radio">
			<label>Write</label><input name="mode_2" value="write" type="radio">
		</li>
		<li><button onclick="openFile(this)">file_3.txt</button>
			<br>
			<label>Read</label><input name="mode_3" value="read" checked="checked" type="radio">
			<label>Append</label><input name="mode_3" value="append" type="radio">
			<label>Write</label><input name="mode_3" value="write" type="radio">
		</li>
	</ul> -->
	<textarea id="file_editor"></textarea>
	<button onclick="updateFile(this)">Update</button>
	<script type="text/javascript">
		var mode = null;
		var file_name = null;
		var searchFile = function() {	
			$.ajax({
				type: "GET",
				url: "/social-documentation/file_search.php",
				success:(function(data) {
					data = data.split(',');
					var bodyTag = $('body');
					for (i = 0; i < data.length; i++) {
						bodyTag.append("<li><button onclick='openFile(this)'>"+ data[i] +"</button>" +
							"<label>Read</label><input name='mode_"+ i + "' value='read' checked='checked' type='radio'>" +
							"<label>Append</label><input name='mode_"+ i + "' value='append' type='radio'>" +
							"<label>Write</label><input name='mode_"+ i + "' value='write' type='radio'> " +
							"</li>");
					}
				})
			});
		};
		var openFile = function(instance) {	
			mode = $(instance).siblings('input:radio:checked')[0].value;
			file_name = instance.innerHTML;
			if (mode === "read") {
				$("textarea").attr('readonly', true);
			} else {
				$("textarea").attr('readonly', false);
			}
			$.ajax({
				type: "POST",
				url: "/social-documentation/file_1.php",
				data: {fileDetails: {file_name: file_name, file_mode: mode}},
				success:(function(data) {
					$('#file_editor').val(data);
				})
			});
		};
		var updateFile = function(instance) {	
			var content = $('#file_editor').val() || null;
			if((mode === "write" || mode === "append") && content) {
				$.ajax({
					type: "POST",
					url: "/social-documentation/file_1.php",
					data: {fileUpdate: {file_name: file_name, file_mode: mode, file_content: content}},
					success:(function(data) {
						if (data === "Updated") {
							alert("Record Updated");
						}
					})
				});
			} else {
				alert("You are using Read Mode file can not Update...!");
			}
		};
	</script>
</body>
</html>