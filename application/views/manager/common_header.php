<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title><?php echo ADMIN_TITLE?></title>
<link type="text/css" rel="stylesheet" href="/static/admin/admin.css" media="screen" />
<script type="text/javascript" src="/static/js/jquery.min.js"></script>
<script type="text/javascript" src="/static/js/ajaxupload.3.9.js"></script>
<script language="javascript" type="text/javascript" src="/static/js/datepicker/WdatePicker.js"></script>
<script type="text/javascript" src="/static/js/admin/dialog.js"></script>
<script type="text/javascript" src="/static/js/common.js"></script>
<link type="text/css" rel="stylesheet" href="/static/admin/dialog.css" media="screen" />

</head>

<style>
.btn-group p {
	float:none;
}
.upload{ 
	width:70px; 
	height:25px;
}
</style>
<script>
var SITE_CLASS = '<?php echo $siteclass;?>';
var SITE_METHOD = '<?php echo $sitemethod;?>';
var DOMAIN = 'http://' + document.domain + '/';
var doit = false;
<?php 
	if(!empty($msg)){?>
	alert('<?php echo $msg?>');
	<?php } ?>
</script>
<body class="main-body" >
<?php $this->load->view('manager/location');?>