<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title"><?=$title?>
          </h4>
          <hr>
          <input type="hidden" id='beratTotal' name='beratTotal' value="<?=$beratTotal;?>">
          <div classs="row">
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Nama
                <span class="pull-right"> : </span>
              </div>
              <div class="col-md-5" >
                <input type="text" name="namaLeads" id="namaLeads" class="form-control" value="<?=$nama;?>">
              </div>

            </div>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Email
                <span class="pull-right"> : </span>
              </div>
              <div class="col-md-5">
                <input type="text" name="emailLeads" id="emailLeads" value="<?=$email;?>" class="form-control">
              </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Nomor Telepon
                <span class="pull-right"> : </span>
              </div>
              <div class="col-md-5">
                <input type="text" name="nomorTelepon" id="nomorTelepon" value="<?=$nomor_telepon;?>" class="form-control">
              </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Username
                <span class="pull-right"> : </span>
              </div>
              <div class="col-md-5">
                <input type="text" name="usernameLeads" id="usernameLeads" value="<?=$usernameLeads;?>" class="form-control">
              </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Provinsi
                <span class="pull-right"> : </span>
              </div>
              <div class="col-md-5">
                <?=$comboProvinsi;?>
              </div>
            </div>
            <div class="row" style="margin-bottom: 1%;">
              <div class="col-md-3">Kota
                <span class="pull-right"> : </span>
              </div>
              <div class="col-md-5">
                <?=$comboKota;?>
              </div>
            </div>
            <a onclick="save();" class="btn btn-md btn-primary pull-right" style="margin-right: 1%;" id="btnCheckOut">
             SIMPAN </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

 <div class="modal fade" id="HistoryAlamat" tabindex="-1" role="dialog" aria-labelledby="HistoryAlamat" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="HistoryAlamat">History Alamat</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"  style="padding: 1%;background: white;">
          <div class="container-fluid mt-5 d-flex justify-content-center w-100">
            <div class="table-responsive w-100">
                <table class="table">
                  <thead>
                    <tr class="bg-dark text-white">
                        <th>#</th>
                        <th>Nama History</th>
                        <th class="text-left">Alamat</th>
                        <th class="text-left">*</th>
                      </tr>
                  </thead>
                  <tbody id="historyLogAlamat">

                  </tbody>
                </table>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

   <div class="modal fade" id="TambahAlamat" tabindex="-1" role="dialog" aria-labelledby="TambahAlamat" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding: 1%;">
          <h5 class="modal-title" id="TambahAlamat" >Tambahkan Alamat Sebagai</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"  style="padding: 1%;background: white;font-size: 13px;">
          <div class="row">
            <div class="col-md-12">
              <label>Nama Alamat *</label>
              <input type="text" name="namaAlamat" id="namaAlamat" class="form-control">
            </div>
            <div class="col-md-12">
              <label>Alamat</label>
              <textarea name="alamatPembeli" id="alamatPembeli" class="form-control" readonly></textarea>
            </div>
            <div class="col-md-12">
              <label>Provinsi</label>
              <input type="text" name="provinsiAlamat" id="provinsiAlamat" class="form-control" readonly>
            </div>
            <div class="col-md-12">
              <label>Kota</label>
              <input type="text" name="kotaAlamat" id="kotaAlamat" class="form-control" readonly>
            </div>
            <div class="col-md-12">
              <label>Kecamatan</label>
              <input type="text" name="kecamatanAlamat" id="kecamatanAlamat" class="form-control" readonly>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="javascript:void(0)" onclick="saveAlamat();"  class="btn btn-succes">Tambahkan</a>
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
  function provinsiChanged(){
    $.ajax({
      type:'POST',
      data : {
            idProvinsi : $("#idProvinsi").val()
         },
        url:"<?=base_url();?>shop.member/manage/provinsiChanged",
        success: function(data) {
        var resp = eval('(' + data + ')');
          if(resp.err==''){
            $("#idKota").html(resp.content.idKota);
          }else{
          }
        }
    });
 }

 function save(){
  if($("#namaLeads").val() == ''){
   swal("Error", "Isi Nama Leads", "error");
  }else if($("#emailLeads").val() == ''){
    swal("Error", "Isi Email", "error");
  }else if($("#nomorTelepon").val() == ''){
    swal("Error", "Isi Nomor Telepon", "error");
  }else if($("#usernameLeads").val() == ''){
    swal("Error", "Isi Username", "error");
  }else if($("#idKota").val() == ''){
    swal("Error", "Isi Kota", "error");
  }else{
      $("#loading").css("display","flex");
  		$.ajax({
  			type:'POST',
  			data : {
          namaLeads : $("#namaLeads").val(),
          emailLeads : $("#emailLeads").val(),
          nomorTelepon : $("#nomorTelepon").val(),
          usernameLeads : $("#usernameLeads").val(),
          idProvinsi : $("#idProvinsi").val(),
          idKota : $("#idKota").val(),
        },
  		  url:"<?=base_url();?>leads.member/manage/save",
  			success: function(data) {
          var resp = eval('(' + data + ')');
  				$("#loading").css("display","none");
  				if(resp.err==''){
            swal("Success", "Leads Berhasil di tambahkan !", "succes");
            loadMainContentMember('/leads.member/manage');
  				}else{
            swal("Error", resp.err, "error");
  				}
  			}
  		});
  	}
 }
  </script>
