
<script language="javascript" type="text/javascript">
    
	$(document).ready(function() {

		$("#id_kategori").change(function(){
	 		// Put an animated GIF image insight of content
		
			var data = {id_kategori:$("#id_kategori").val()};
			$.ajax({
					type: "POST",
					url : "<?php echo base_url().'select/select_sub_kategori'?>",				
					data: data,
					success: function(msg){
						$('#div-order').html(msg);
					}
			});
		});   

	});

</script>			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">New Ticket</li>
			</ol>
		</div><!--/.row-->
		
	<br>
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-primary">
					<div class="panel-heading"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>
<a href="#" style="text-decoration:none; font-color:white">Ticket</a></div>
					<div class="panel-body">
						
					<div class="col-md-12">
						<?php echo form_open_multipart(base_url().$url, array('id' => 'form')); ?>

					<input type="hidden" class="form-control" name="id_ticket" value="<?php echo $id_ticket;?>">
					<input type="hidden" class="form-control" name="id_user" value="<?php echo $id_user;?>">

				<div class="panel panel-danger">
					<div class="panel-heading">
						Request from
					</div>
					<div class="panel-body">

						<div class="col-md-6">

						<div class="form-group">
						<label>NIK</label>
						<input class="form-control" name="nama" placeholder="Nama" value="<?php echo $id_user;?>" disabled>
					    </div>

					    <div class="form-group">
						<label>Department</label>
						<input class="form-control" name="departemen" placeholder="Departemen" value="<?php echo $departemen;?>" disabled>
					    </div>

					     </div>

					    <div class="col-md-6">

					    <div class="form-group">
						<label>Name</label>
						<input class="form-control" name="nama" placeholder="Departemen" value="<?php echo $nama;?>" disabled>
					    </div>

					    <div class="form-group">
						<label>Institution</label>
						<input class="form-control" name="departemen" placeholder="Departemen" value="<?php echo $id_institusi.' - '.$institusi;?>" disabled>
					    </div>

					    </div>
						
					</div>
				</div>

				<div class="panel panel-danger">
					<div class="panel-heading">
						Description Problem 
					</div>
					<?php echo $this->session->flashdata("msg");?>
					<div class="panel-body">

						<div class="col-md-6">

						<div class="form-group">
						<label>Category</label>
						<?php echo form_dropdown('id_kategori',$dd_kategori, $id_kategori, ' id="id_kategori" required class="form-control"');?>
					    </div>

					    <div id="div-order">

						<?php if($flag=="edit")
						{

	                     echo form_dropdown('id_sub_kategori',$dd_sub_kategori, $id_sub_kategori, 'required class="form-control"');

						}else{}
					    ?>

					    </div>

					    <div class="form-group">
						<label>Urgently</label>
						<?php echo form_dropdown('id_kondisi',$dd_kondisi, $id_kondisi, ' id="id_kondisi" required class="form-control"');?>
					    </div>

					    

				        </div>

				        <div class="col-md-6">

					    <div class="form-group">
						<label>Subject Problem</label>
						<input class="form-control" name="problem_summary" placeholder="problem_summary" value="<?php echo $problem_summary;?>" required>
					    </div>

					    <div class="form-group">
						<label>Description Problem</label>
						<textarea name="problem_detail" class="form-control" rows="10"><?php echo $problem_detail;?></textarea>
					    </div>

					<!-- upload file area -->
					    <div class="form-group"> 

					    <label for="image">File Upload</label> 
					    <input name="fileuser" accept="image/png,image/jpg,image/jpeg,application/pdf" class="form-control" style="padding:3px;" type="file" size="20" /> 
					    <font color="red">*Maximum Upload file size : 1MB , extention format .pdf .jpg and .png</font>
					    </div> 
					    <!-- end upload file area -->					
		

					<button type="submit" class="btn btn-primary">Save</button>
					<a href="<?php echo base_url();?>list_ticket/ticket_list"  class="btn btn-default">Cancel</a>
				    </div>

				     </form>


					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		

<script type="text/javascript">
	

	    $(document).ready(function(){

     
        $('#form').submit(function(e){
            e.preventDefault(); 

                 $.ajax({
                     url:'<?php echo base_url();?>ticket/save',
                     type:'POST',
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                     dataType: 'JSON',
                     success: function (response) {
                              if (response.success == true) {
                              	window.location = '<?php echo base_url() ?>myticket/myticket_list';
                              }else{
                              	Swal.fire({
                              		icon: 'error',
                              		title: 'Oops...',
  html: response.messages,
  showCloseButton: false,
  showCancelButton: false,
  focusConfirm: false,
  
});

                              	
                              }
                            },
                            error: function (response) {
                            	 Swal.fire({
				  				icon: 'error',
				  				title: 'Oops...',
				  				text: response.messages
							});
                            }
                 });
            });
         
 
    });
</script>