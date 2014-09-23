<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>Product</title>

<link href="<?php echo base_url(); ?>res/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	base_url = '<?php echo base_url();?>';	
</script>

<script src="<?php echo base_url(); ?>res/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>res/js/script.js"></script>


</head>
<body>
	<div class="content">
		<h1><?php echo $title; ?></h1>
		<form method="post" action="<?php echo $action; ?>">
		<div class="data">
		<table>
			
			<input type="hidden" name="id" value="<?php echo set_value('id',$this->form_data->id); ?>"/>
			<tr>
				<td valign="top">Name<span style="color:red;">*</span></td>
				<td><input type="text" name="name" id="name" class="text" value="<?php echo set_value('name',$this->form_data->name); ?>"/>

				</td>
			</tr>

			<tr>
				<td valign="top">Description<span style="color:red;">*</span></td>
				<td><textarea id="description" name="description"><?php echo trim($this->form_data->description); ?></textarea>
					
				</td>
			</tr>

			<tr>
				<td valign="top">Country<span style="color:red;">*</span></td>
				<td><?php echo form_dropdown('cbcountry', (isset($country_list) ? $country_list : array('0' => 'Select a Country')), (isset($selectedcountry) ? $selectedcountry : ''), 'id="cbcountry"'); ?>
			
				</td>
			</tr>

			<tr>
				<td valign="top">State<span style="color:red;">*</span></td>
				<td><?php echo form_dropdown('cbstate',(isset($state_list) ? $state_list : array('0' => 'Select a State')), ( isset($selectedstate) ? $selectedstate : ''), 'id="cbstate"'); ?>
				
				</td>
			</tr>

			<tr>
				<td valign="top">City<span style="color:red;">*</span></td>
				<td><?php echo form_dropdown('cbcity', (isset($cities_list) ? $cities_list : array('0' => 'Select a City')), ( isset($selectedcity) ? $selectedcity : ''), 'id="cbcity"'); ?>
				
				</td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" value="Save"/></td>
			</tr>
		</table>
		</div>
		</form>
		
	</div>
</body>
</html>