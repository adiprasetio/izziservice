<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script type="text/javascript">
			var Password = {
 
  _pattern : /[a-zA-Z0-9]/,
  
  
  _getRandomByte : function()
  {
    // http://caniuse.com/#feat=getrandomvalues
    if(window.crypto && window.crypto.getRandomValues) 
    {
      var result = new Uint8Array(1);
      window.crypto.getRandomValues(result);
      return result[0];
    }
    else if(window.msCrypto && window.msCrypto.getRandomValues) 
    {
      var result = new Uint8Array(1);
      window.msCrypto.getRandomValues(result);
      return result[0];
    }
    else
    {
      return Math.floor(Math.random() * 256);
    }
  },
  
  generate : function(length)
  {
    return Array.apply(null, {'length': length})
      .map(function()
      {
        var result;
        while(true) 
        {
          result = String.fromCharCode(this._getRandomByte());
          if(this._pattern.test(result))
          {
            return result;
          }
        }        
      }, this)
      .join('');  
  }    
    
};
			</script>
<script language="javascript" type="text/javascript">

	$(document).ready(function() {
    $('.select2').select2();
});
    
	$(document).ready(function() {

		$("#id_departemen").change(function(){
	 		// Put an animated GIF image insight of content
		
			var data = {id_departemen:$("#id_departemen").val()};
			$.ajax({
					type: "POST",
					url : "<?php echo base_url().'select/select_bagian_departemen'?>",				
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
				<li class="active">Client</li>
			</ol>
		</div><!--/.row-->
		
	<br>
				
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg>
<a href="#" style="text-decoration:none">Add Data Client</a></div>
					<div class="panel-body">
						
					<div class="col-md-6">
					<form method="post" action="<?php echo base_url('superuser/save');?>">

					<input type="hidden" class="form-control" name="nik" value="<?php echo $nik;?>">

					<div class="form-group">
						<label>Name</label>
						<input class="form-control" name="nama" placeholder="Name" value="<?php echo $nama;?>" required>
					</div>

					<div class="form-group">
						<label>Email</label>
						<input class="form-control" name="email" placeholder="Email" value="<?php echo $email;?>" required>
					</div>

					<div class="form-group">
						<label>Password</label>
						<input id="password" type="name" class="form-control" name="password" value="<?php echo $password;?>">
						<a class="btn btn-info" onclick='document.getElementById("password").value = Password.generate(16)' >Generate Password</a>
					</div>


					<div class="form-group">
						<label>Gender</label>
						<?php echo form_dropdown('id_jk',$dd_jk, $id_jk, ' id="id_jk" required class="form-control"');?>
					</div>

					<div class="form-group">
						<label>Address</label>
						<textarea name="alamat" class="form-control" required><?php echo $alamat;?></textarea>
					</div>

				<!-- 	<div class="form-group">
						<label>Institutional Code</label>
						

						<select class="form-control select2" name="id_institusi" id="id_institusi">
							<?php if ($this->uri->segment(2) =="edit") {?>
								<?php foreach ($dd_kodeinstitusi_edit as $key => $dd_kodeinstitusi_edit) {?>
							<option value="<?php echo $dd_kodeinstitusi_edit['id_institusi']; ?>"><?php echo $dd_kodeinstitusi_edit['kode_institusi'].' - '.$dd_kodeinstitusi_edit['nama_institusi']; ?></option>
							<?php } ?>

							<?php foreach ($dd_kodeinstitusi as $key => $dd_kodeinstitusi) {?>
							<option value="<?php echo $dd_kodeinstitusi['id_institusi']; ?>"><?php echo $dd_kodeinstitusi['kode_institusi'].' - '.$dd_kodeinstitusi['nama_institusi']; ?></option>
							<?php }} ?>
							<option>-- SELECT --</option>
							<?php foreach ($dd_kodeinstitusi as $key => $dd_kodeinstitusi) {?>
							<option value="<?php echo $dd_kodeinstitusi['id_institusi']; ?>"><?php echo $dd_kodeinstitusi['kode_institusi'].' - '.$dd_kodeinstitusi['nama_institusi']; ?></option>
							<?php } ?>
						</select>
					</div> -->

					<div class="form-group">
						<label>Department</label>
						<?php echo form_dropdown('id_departemen',$dd_departemen, $id_departemen, ' id="id_departemen" required class="form-control"');?>
					</div>

					<!-- <div id="div-order">

						<?php if($flag=="edit")
						{

	                     echo form_dropdown('id_bagian_departemen',$dd_bagian_departemen, $id_bagian_departemen, 'required class="form-control"');

						}else{}
					?>

					</div> -->

					<div class="form-group">
						<label>Position</label>
						<?php echo form_dropdown('id_jabatan',$dd_jabatan, $id_jabatan, 'required class="form-control"');?>
					</div>

					<div class="form-group">
						<label>Level</label>
						<?php echo form_dropdown('id_level',$dd_level, $id_level, ' id="id_level" required class="form-control"');?>
					</div>

					<button type="submit" class="btn btn-primary">Save</button>
					<a href="<?php echo base_url();?>superuser/list_user"  class="btn btn-default">Cancel</a>
				    </div>

				     </form>


					</div>
				</div>
			</div>
		</div><!--/.row-->	
		
		
