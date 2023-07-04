<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: 600;
		text-decoration: none;
		font-size:30px;
		margin-bottom:25px;
		display:block;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}



	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
		padding:50px;
	}
	.add{
		color:green;
	}
	.get{
		color:red;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to Cost Management sytem!</h1>
	<h2>Our services:</h2>
	<h2 class="add">Add</h2>

<a href="<?php echo base_url('addtype');?>">- Add Payment Type</a>
<a href="<?php echo base_url('addcurrency');?>">- Add Currency</a>
<a href="<?php echo base_url('addpayment');?>">- Add Payment </a>
<h2 class="get">Get</h2>

<a href="<?php echo base_url('gettypes');?>">- Our Payment Types</a>
<a href="<?php echo base_url('getcurrency');?>">- Our Currency</a>
<a href="<?php echo base_url('getpayments');?>">- Our Payments </a>
	
	</div>

</body>
</html>
