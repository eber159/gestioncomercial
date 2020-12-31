<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta name="base_url" content="{{ URL::to('/') }}">
		<meta charset="utf-8" />
		<title>@yield('title-page')</title>
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		
		<style>
			body {
				margin:0;
				font-family:'Lato', sans-serif;
				text-align:center;
				color: #000;
			}
		
			.titulo {
				padding:5px;
				background-color: #1657A2;
				color: white;
				font-family:'Lato', sans-serif;
				text-align:center;
				font-size: 14;
				
			}
			
			.sub-titulo {
				padding:3px;
				font-family:'Lato', sans-serif;
				text-align:center;
				color: #999;
				font-size: 14px;
			}
			
			.logo-1 {
				margin:0;
				font-family:'Lato', sans-serif;
				float:left;
				text-align: left;
				color: #999;
				font-size: 16;
			}
			
			.usuario {
				margin:0;
				font-family:'Lato', sans-serif;
				text-align: right;
				color: #999;
				font-size: 12;
			}
			
			.logo-2 {
				margin:0;
				font-family:'Lato', sans-serif;
				float:left;
				text-align: left;
				color: #999;
				font-size: 12;
			}
			
			.welcome {
				width: 300px;
				height: 200px;
				position: absolute;
				left: 50%;
				top: 50%;
				margin-left: -150px;
				margin-top: -100px;
			}

			a, a:visited {
				text-decoration:none;
			}

			h1 {
				font-size: 32px;
				margin: 16px 0 0 0;
			}
			
			.logotipo {
				height: 70px;
			}
			
			table {
				border-collapse: collapse;
				width: 100%;
				font-family: 'Lato', sans-serif;
				font-size: 11px;
			}

			th, td {
				text-align: left;
				padding: 8px;
			}

			tr:nth-child(even){background-color: #f2f2f2}

			th {
				background-color: #B6B6B6;
				color: white;
			}
			/*
			@page { size: 20cm 7.5cm landscape; }
			*/
		</style>
		


	</head>
	
	<body>
		
		<div style="text-align: left; font-size: 12px"><?php echo Date("d/m/Y H:i:s"); ?></div>

		<div class="titulo">@yield('titulo-rep')</div>
		<div class="sub-titulo">@yield('sub-titulo-rep')</div>
		<br/>
		<div class="reporte">
			@yield('reporte')
		</div>
		
	</body>
	
</html>
