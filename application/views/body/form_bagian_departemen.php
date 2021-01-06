			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Sub Department</li>
			</ol>
		</div><!--/.row-->
		
	<br>
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>
<a href="#" style="text-decoration:none">Add Sub Department</a></div>
					<div class="panel-body">
						
					<div class="col-md-6">
					<form method="post" action="<?php echo base_url();?><?php echo $url;?>">

					<input type="hidden" class="form-control" name="id_bagian_dept" value="<?php echo $id_bagian_dept;?>">

					<div class="form-group">
						<label>Sub Department</label>
						<input class="form-control" name="nama_bagian_dept" value="<?php echo $nama_bagian_dept;?>" placeholder="Sub Department" required>
					</div>

					<div class="form-group">
						<label>Department Name</label>
						<?php echo form_dropdown('id_departemen',$dd_departemen, $id_departemen, 'class="form-control"');?>
					</div>

					<button type="submit" class="btn btn-primary">Save</button>
					<a href="<?php echo base_url();?>bagian_departemen/bagian_departemen_list"  class="btn btn-default">Cancel</a>
				    </div>

				     </form>


					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		
