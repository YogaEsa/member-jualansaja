<div class="content-wrapper"  >
  <div class="row ">
     <div class="col-md-12" style="margin-left:20px;margin-top:20px;margin-bottom:20px;" >
       <div classs="row">
         <div class="card bg-white p-3">
           <form id='formProfile'>
             <div class="form-group row">
       		    <h3 style="margin-left:20px;margin-bottom:20px;">WITHDRAW</h3>
       		   </div>
             <div class="form-group row">
       		    <label for="nama" class="col-sm-2 col-form-label">TANGGAL</label>
       		    <div class="col-sm-4">
       		      <input type="text" class="form-control" id="tanggal" name='tanggal'value='<?=date("d-m-Y");?>' readonly style="border-color: #ced4da;">
       		    </div>
       		   </div>
             <div class="form-group row">
               <label for="nama" class="col-sm-2 col-form-label">JAM</label>
               <div class="col-sm-4">
                 <input type="text" class="form-control" id="jam" name='jam' value='<?=date("H:i:s");?>' readonly style="border-color: #ced4da;">
               </div>
             </div>

             <div class="form-group row">
       		    <label for="nama" class="col-sm-2 col-form-label">NAMA BANK</label>
       		    <div class="col-sm-4">
       		      <input type="text" class="form-control" id="namaBank" name='namaBank' value='<?=$bank;?>' readonly style="border-color: #ced4da;">
       		    </div>
       		   </div>
             <div class="form-group row">
       		    <label for="nama" class="col-sm-2 col-form-label">NOMOR REKENING</label>
       		    <div class="col-sm-4">
       		      <input type="text" class="form-control" id="nomorRekening" name='nomorRekening' value='<?=$nomor_rekening;?>' readonly   style="border-color: #ced4da;">
       		    </div>
       		   </div>
             <div class="form-group row">
       		    <label for="nama" class="col-sm-2 col-form-label">NAMA REKENING</label>
       		    <div class="col-sm-4">
       		      <input type="text" class="form-control" id="namaRekening" name='namaRekening'  value='<?=$nama_pemilik_rekening;?>' readonly style="border-color: #ced4da;">
       		    </div>
       		   </div>
             <div class="form-group row">
       		    <label for="nama" class="col-sm-2 col-form-label">JUMLAH WITHDRAW</label>
       		    <div class="col-sm-4">
       		      <input type="text" class="form-control" id="jumlahWithdraw" name='jumlahWithdraw' value='<?=$saldo;?>'  placeholder="JUMLAH WITHDRAW" style="border-color: #ced4da;">
       		    </div>
       		   </div>
             <div class="form-group row">
       		    <label for="nama" class="col-sm-2 col-form-label"></label>
       		    <div class="col-sm-4">
       		       <button type='button' class='btn btn-primary btn-sm' onClick=saveWithdraw();>SIMPAN</button>
       		    </div>
       		   </div>

           </form>
         </div>
       </div>
     </div>
  </div>

</div>
<script type="text/javascript">
function saveWithdraw(){
  $("#loading").css("display","flex");
  $.ajax({
    type:'POST',
    data : $("#formProfile").serialize(),
    url: '<?php echo base_url();?>'+'dashboard.member/manage/saveWithdraw',
      success: function(data) {
        $("#loading").css("display","none");
          if(data.err==''){
            swal("Success", "Permintaan withdraw akan diproses", "success");
            loadMainContentMember('/dashboard.member/manage');
          }else{
            swal(data.err, "", "warning");
          }
        }
  });
}
</script>
