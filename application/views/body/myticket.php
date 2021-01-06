<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">My Ticket</li>
			</ol>
		</div><!--/.row-->
		
	<br>
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>
						<a href="#" style="text-decoration:none">My Ticket </a>
						<a href="<?php echo base_url();?>myticket/csvmyticket" class="btn btn-success" target="_blank">XLS</a>
<a href="#" style="text-decoration:none"></a> <a href="<?php echo base_url();?>myticket/pdfmyticket" class="btn btn-danger" target="_blank"> PDF</a></div>
					<div class="panel-body"></div>
					<div class="panel-body">
						<table data-toggle="table" data-show-refresh="false" data-show-toggle="true" data-show-columns="true" data-search="true"  data-pagination="true" data-sort-name="name" data-sort-order="desc">
						    <thead>
						    <tr>
						        <th data-field="no" data-sortable="true" width="10px"> No</th>
						        <th data-field="idd" data-sortable="true">Id Ticket</th>
						        <th data-field="iddd" data-sortable="true">Date</th>
						        <th data-field="idddd" data-sortable="true">Category</th>
						        <th data-field="iddddd" data-sortable="true">Sub category</th>
						        <th data-field="idxddddd" data-sortable="true">Progress (%)</th>
						        <th data-field="idddddd" data-sortable="true">Status</th>
						        <th data-field="feedback" data-sortable="true">Feedback</th>
						    </tr>
                            </thead>
                            <tbody>
                           <?php $no = 0; foreach($datamyticket as $row) : $no++;?>
						     <tr>
						        <td data-field="no" width="10px"><?php echo $no;?></td>
						        <td data-field="id">
						        <?php if ($row->id_kondisi == 1) { //HIGH
						        	echo ' <a class="btn btn-danger" href="'.base_url()."myticket/myticket_detail/".$row->id_ticket.'">';
						        }else{
						        	echo ' <a class="btn btn-warning" href="'.base_url()."myticket/myticket_detail/".$row->id_ticket.'">';
						        } ?>
						       <?php echo $row->id_ticket;?></a></td>
						        <td data-field="id"><?php echo $row->tanggal;?></td>
						        <td data-field="id"><?php echo $row->nama_kategori;?></td>
						        <td data-field="id"><?php echo $row->nama_sub_kategori;?></td>
						        <td data-field="id"><?php echo $row->progress;?></td>
						        <td data-field="id">

						        	<?php if($row->status==6) { echo "CLOSE";}else{
						        		echo "OPEN";
						        	}
						        ?>

						        	<!-- <?php if($row->status==1) { echo "WAITING APPROVAL";}
						        else if($row->status==2) { echo "APPROVED";}
						        else if($row->status==0) { echo "TREJECTED";}
						        else if($row->status==3) { echo "WAITING APPROVAL TECHNITION";}
						        else if($row->status==4) { echo "TECHNITION PROCESS";}
						        else if($row->status==5) { echo "PENDING";}
						        else if($row->status==6) { echo "SOLVED";}
						        ?> --></td>
						        <td>
						        	<?php if($row->status==6 AND $row->feedback == "") {?>

						        		<button onclick="feedback('<?php echo base_url();?>myticket/feedback_yes/<?php echo $row->id_ticket;?>/<?php echo $row->id_teknisi;?>')">GIVE FEEDBACK</button>

						      <!--   <a class="ubah btn btn-success btn-xs" href="<?php echo base_url();?>myticket/feedback_yes/<?php echo $row->id_ticket;?>/<?php echo $row->id_teknisi;?>"><span class="glyphicon glyphicon-thumbs-up" ></span></a>

<a title="Hapus Kontak" class="hapus btn btn-danger btn-xs" href="<?php echo base_url();?>myticket/feedback_no/<?php echo $row->id_ticket;?>/<?php echo $row->id_teknisi;?>"><span class="glyphicon glyphicon-thumbs-down"></span></a> -->

									<?php } else if($row->status==6 AND  $row->feedback == 1) { echo "YOU GIVE POSITIVE FEEDBACK";}
										  else if($row->status==6 AND $row->feedback == 0) { echo "YOU GIVE NEGATIVE FEEDBACK";}
										  else
										  {
										  	echo "WAITING STATUS SOLVED FROM TECHNITION";
										  }
									?>
						        </td>
						      
						    </tr>
						    <?php endforeach;?>
						    </tbody>
						    
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		<div class="alert bg-warning" role="alert">
					<svg class="glyph stroked flag"><use xlink:href="#stroked-flag"></use></svg> Give Feeedback Appropriate Technician Performance <a href="#" class="pull-right"><span class="glyphicon glyphicon-remove"></span></a>
				</div>	


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

<script type="text/javascript">
	function feedback(link){
Swal.fire({
  title: '<strong>Give us Feedback</strong>',
  icon: 'info',
  html:'<form action="'+link+'" method="POST"> ' +
    '<input class="form-control" focus required type="text" name="deskripsi"><br><br>' +
     '<input type="hidden" id="statusok" value="" name="feedback">' +
    '<button class="btn btn-success" onclick="myFunction(1)" type="submit" ><i class="glyphicon glyphicon-thumbs-up"></i></button>&nbsp;&nbsp;'+
    '<button class="btn btn-danger" onclick="myFunction(0)" type="submit" ><i class="glyphicon glyphicon-thumbs-down"></i></button>'+
    '<form>',
  showCloseButton: true,
  showCancelButton: false,
  showConfirmButton: false,
  focusConfirm: false,
  confirmButtonText:
    '<i class="glyphicon glyphicon-thumbs-up"></i>',
  confirmButtonAriaLabel: 'Thumbs up, great!',
  cancelButtonText:
    '<i class="glyphicon glyphicon-thumbs-down"></i>',
  cancelButtonAriaLabel: 'Thumbs down'
})
	}
</script>
<script type="text/javascript">
	function myFunction(id) {
		 document.getElementById("statusok").value = id;
	}
</script>







					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		

