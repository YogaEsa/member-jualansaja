<div class="col-md-12">
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">Nama</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id='filterNama' name='filterNama' placeholder="Masukan Nama" value='<?=$filterNama?>'>
    </div>
  </div>
</div>
<div class="col-sm-12">
  <div class="form-group row">
    <div class="col-md-2 col-form-label">
      <label>Status</label>
    </div>
    <div class="col-md-10">
      <?=$comboStatus;?>
    </div>
  </div>
</div>
<div class="col-sm-12">
  <div class="form-group row">
    <div class="col-md-2 col-form-label">
      <label>Data / Halaman</label>
    </div>
     <div class="col-md-2">  
      <input type="text" name="jumlahData" id="jumlahData" class="form-control mb-3" value="50">
    </div>
    <div class="col-md-8">
      <input type="button" value="Tampilkan" class="btn btn-primary" style="padding:0.75em 3em" onclick=goToPage(1);>
    </div>
  </div>
</div>