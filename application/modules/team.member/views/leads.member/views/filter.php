
    <div class="col-sm-12">
      <div class="row">
        <div class="col-md-2 ">
        NAMA
        </div>
        <div class="col-md-9">
          <input type="text" class="form-control" id='filterNama' name='filterNama' value='<?=$filterNama?>' >
        </div>
      </div>
    </div>
    <div class="col-sm-12">
      <div class="row">
        <div class="col-md-2 ">
        STATUS
        </div>
        <div class="col-md-4">
          <?=$comboStatus;?>
        </div>
      </div>
    </div>
    <div class="col-sm-12 mt-2">
      <div class="row">
        <div class="col-md-2 ">
        DATA/HALAMAN
        </div>
        <div class="col-md-1 ">
         <input type="text" name="jumlahData" id="jumlahData" class="form-control form-control-sm" value="50">
        </div>
        <div class="col-md-1">
          <button type="button" class="btn btn-primary btn-sm text-uppercase" onclick=goToPage(1);>tampilkan</button>
        </div>
      </div>
    </div>
