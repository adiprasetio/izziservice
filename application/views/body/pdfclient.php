<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
</head>

<body>
<div class="row" align="center">

	<h1>REPORT DATA CLIENT</h1>


	<table style="width: 100%" class="table table-striped" id="tableorder" align="center" border="1" cellspacing="0">

						    <thead>
						    <tr>
						        <th data-field="no" width="10px">No</th>
						        <th data-field="id">Nik</th>
						        <th data-field="nama">Name</th>
						        <th data-field="alamat">Address</th>
						        <th data-field="jenis_kelamin">Gender</th>
						        <th data-field="departemen">Department</th>
						         <th data-field="institusi">Institusi</th>
						        <th data-field="jabatan">Level</th>
						    </tr>
                            </thead>
                            <tbody>
                           <?php $no = 0; foreach($datakaryawan as $row) : $no++;?>
						     <tr>
						        <td data-field="no" width="10px"><?php echo $no;?></td>
						        <td data-field="nik"><?php echo $row->nik;?></td>
						        <td data-field="nama" width="400px"><?php echo $row->nama;?></td>
						        <td data-field="alamat"><?php echo $row->alamat;?></td>
						        <td data-field="jk"><?php echo $row->jk;?></td>
						        <td data-field="id_departemen"><?php echo $row->nama_dept;?></td>
						        <td data-field="institusi" width="350px;"><?php echo $row->nama_institusi;?></td>
						        <td data-field="nama_jabatan"><?php echo $row->nama_jabatan;?></td>
						        
						    </tr>
						    <?php endforeach;?>
						    </tbody>
						</table>
						</div>
</body>
</html>