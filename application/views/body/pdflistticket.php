<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Surat Kesepakatan</title>
  <link rel="stylesheet" href="<?php echo base_url(). "assets/";?>css/bootstrap.min.css">
</head>

<body>
<div class="row" align="center">

	<h1>REPORT LIST TICKETING</h1>


	<table style="width: 100%" class="table table-striped" id="tableorder" align="center" border="1" cellpadding="10" cellspacing="0" width="100%">
		<thead>
						    <tr>
						        <th data-field="no" data-sortable="true" width="10px"> No</th>
						        <th data-field="idd3" data-sortable="true">Id Ticket</th>
						        <th data-field="iddds" data-sortable="true">Reported</th>
						        <th data-field="idddXs" data-sortable="true">Dept</th>
						        <th data-field="iddd" data-sortable="true">Tanggal</th>
						        <th data-field="idddd" data-sortable="true">Nama Kategori</th>
						        <th data-field="iddddd" data-sortable="true">Nama Sub Kategori</th>
						        <th data-field="idddddd" data-sortable="true">Status</th>
						         <th data-field="idddddd" data-sortable="true">Feedback</th>
						    </tr>
                            </thead>
                            <tbody>
                            	<?php $no = 0; foreach($datalist_ticket as $row) : $no++;?>
						     <tr>
						        <td data-field="no" width="10px"><?php echo $no;?></td>
						        <td data-field="id"><?php echo $row->id_ticket;?>
						        </td>
						        <td data-field="iddsd"><?php echo $row->nama;?></td>
						        <td data-field="iddsd"><?php echo $row->nama_dept;?></td>
						        <td data-field="id"><?php echo $row->tanggal;?></td>
						        <td data-field="id"><?php echo $row->nama_kategori;?></td>
						        <td data-field="id"><?php echo $row->nama_sub_kategori;?></td>

						        <td data-field="id">
						        <?php 
						        if($row->status==6) { echo "CLOSE";}else{
						        	echo "OPEN";
						        }

						        ?>
						        </td>
						        <td data-field="id"><?php echo $row->deskripsi;?></td>
						    </tr>
						    <?php endforeach;?>
						    </tbody>
						    
						</table>


						</div>
</body>
</html>