			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">My Assignment Ticket</li>
			</ol>
		</div><!--/.row-->
		
	<br>
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>
					<a href="#" style="text-decoration:none">My Assignment Ticket</a></div>
					<div class="panel-body">
						<table data-toggle="table" data-show-refresh="false" data-show-toggle="true" data-show-columns="true" data-search="true"  data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="no" data-sortable="true" width="10px"> No</th>
						        <th data-field="idd" data-sortable="true">Id Ticket</th>
						        <th data-field="iddd" data-sortable="true">Date</th>
						        <th data-field="idddd" data-sortable="true">Category</th>
						        <th data-field="iddddd" data-sortable="true">Sub Category</th>
						        <th data-field="idddddC" data-sortable="true">Progress (%)</th>
								<th data-field="idddddX" data-sortable="true">Status</th>						        
						        <th data-field="idddddd" data-sortable="true">#</th>
						    </tr>
                            </thead>
                            <tbody>
                           <?php $no = 0; foreach($datamyassignment as $row) : $no++;?>
						     <tr>
						        <td data-field="no" width="10px"><?php echo $no;?></td>
						        <td data-field="id">
						        <?php if($row->status==4)
						        {?>
						        	<?php if ($row->id_kondisi == 1) { //HIGH
						        	echo ' <a class="btn btn-danger" href="'.base_url()."myassignment/ticket_detail/".$row->id_ticket.'">
						        	'.$row->id_ticket.'</a>';
						        }else{
						        	echo ' <a class="btn btn-warning" href="'.base_url()."myassignment/ticket_detail/".$row->id_ticket.'">
						        	'.$row->id_ticket.'</a>'; } ?>
						     
						        <?php } else {
						        echo $row->id_ticket;
						        }
						        ?>
						    	</td>
						        <td data-field="id"><?php echo $row->tanggal;?></td>
						        <td data-field="id"><?php echo $row->nama_kategori;?></td>
						        <td data-field="id"><?php echo $row->nama_sub_kategori;?></td>
						        <td data-field="id"><?php echo $row->progress;?></td>
						         <td data-field="id">
						         	<?php if ($row->status == 6) {
						         		echo "<p style='color:red;'>CLOSE</p>";
						         	}else{
						         		echo "<p style='color:green;'>OPEN</p>";
						         	} ;?></td>
						        <td data-field="id">

	 
	 <?php if($row->status==4)
	 {?>

	 <?php } else if($row->status==3){?>
	 <a class="ubah btn btn-success btn-xs" href="<?php echo base_url();?>myassignment/terima/<?php echo $row->id_ticket;?>"><span class="glyphicon glyphicon-thumbs-up" ></span></a>
	 <a class="ubah btn btn-danger btn-xs" href="<?php echo base_url();?>myassignment/pending/<?php echo $row->id_ticket;?>"><span class="glyphicon glyphicon-minus-sign" ></span></a>
     <?php } else if($row->status==5) { ?>
<a class="ubah btn btn-success btn-xs" href="<?php echo base_url();?>myassignment/terima/<?php echo $row->id_ticket;?>"><span class="glyphicon glyphicon-thumbs-up" ></span></a>
<?php }?>
						        </td>
						    </tr>
						    <?php endforeach;?>
						    </tbody>
						    
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->	


		<?php echo $this->session->flashdata("msg");?>

	
						<script>
						    $(function () {
						        $('#hover, #striped, #condensed').click(function () {
						            var classes = 'table';
						
						            if ($('#hover').prop('checked')) {
						                classes += ' table-hover';
						            }
						            if ($('#condensed').prop('checked')) {
						                classes += ' table-condensed';
						            }
						            $('#table-style').bootstrapTable('destroy')
						                .bootstrapTable({
						                    classes: classes,
						                    striped: $('#striped').prop('checked')
						            });
						        });
						    });
						
						    function rowStyle(row, index) {
						        var classes = ['active', 'success', 'info', 'warning', 'danger'];
						
						        if (index % 2 === 0 && index / 2 < classes.length) {
						            return {
						                classes: classes[index / 2]
						            };
						        }
						        return {};
						    }
						</script>


<?php $this->load->view('konfirmasi');?>

<script type="text/javascript">
$(document).ready(function(){

$(".hapus").click(function(){
var id = $(this).data('id');

$(".modal-body #mod").text(id);

});

});
</script>







					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		
