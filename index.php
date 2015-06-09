<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" >
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Less to SCSS Converter</title>
		<link rel="stylesheet" href="/lib/codemirror.css">
		<link rel="stylesheet" href="/style.css">
	</head>
	<body>
		<div class="container-fluid">
			<div class="row-fluid">
				<div class="span12">
					<h1>Less 2 SCSS</h1>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">
					<div class="code-wrap left">
						<h2 class="code-label">Less</h2>
						<textarea name="less" id="less" class="less-input" less-editor><?php if(isset($less)){echo $less;}else{include('grid.less');}?></textarea>
					</div>
				</div>
				<div class="span6">
					<div class="code-wrap right">
						<h2 class="code-label">SCSS</h2>
						<textarea id="scss" class="scss-output" scss-editor><?php if(isset($scss)){ echo $scss;} ?></textarea>
					</div>
				</div>
		</form>
		<script type="text/javascript" src="/lib/codemirror.js"></script>
		<script type="text/javascript" src="/mode/less/less.js"></script>
		<script type="text/javascript" src="/mode/css/css.js"></script>
		<script type="text/javascript" src="script.js"></script>
	</body>
</html>