<div class="container mb-5">
  <div class="row">
    <div class="col-lg-12 mt-4 ">
      <div class="card stl-card shadow-lg">
        <div class="card-body">
          <h4 class="card-title"><?=$title?>
            <a href="javascript:void(0)" onclick="loadMainContentMember('/shop.member/manage/cart');"
              class="btn btn-sm btn-warning pull-right"> Keranjang </a>
            <a href="javascript:void(0)" onclick="loadMainContentMember('/shop.member/manage');"
              class="btn btn-sm btn-primary pull-right" style="margin-right: 1%;"> Produk </a>
          </h4>
          <div class="mt-2 mb-3 border-bottom"></div>

          <div class="col-md-12">
            <div classs="row">
              <h5 class="card-title"> Data Pembeli </h5>
              <input type="hidden" id='beratTotal' name='beratTotal' value="<?=$beratTotal;?>">
              <div class="form-group row">
                <label for="namaPembeli" class="col-sm-2  col-form-label">Nama</label>
                <div class="col-sm-10">
                  <input type="text" name="namaPembeli" id="namaPembeli" class="form-control" value="<?=$nama;?>">
                </div>
              </div>
              <div class="form-group row">
                <label for="emailPembeli" class="col-sm-2  col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" name="emailPembeli" id="emailPembeli" value="<?=$email;?>" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label for="nomorTelepon" class="col-sm-2  col-form-label">Nomor Telepon</label>
                <div class="col-sm-10">
                  <input type="text" name="nomorTelepon" id="nomorTelepon" value="<?=$nomor_telepon;?>"
                    class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label for="alamatPembeli" class="col-sm-2  col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <textarea name="alamatPembeli" rows="3" id="alamatPembeli"
                    class="form-control"><?=$alamat;?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2  col-form-label">Provinsi</label>
                <div class="col-sm-10">
                  <?=$comboProvinsi;?>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2  col-form-label">Kota</label>
                <div class="col-sm-10">
                  <?=$comboKota;?>
                </div>
              </div>
              <div class="form-group row">
                <label for="alamatPembeli" class="col-sm-2  col-form-label">Kecamatan</label>
                <div class="col-sm-10">
                  <input type="text" name="kecamatanPembeli" id="kecamatanPembeli" class="form-control">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2  col-form-label">Layanan</label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-md-6">
                      <?=$comboExpedisi;?>
                    </div>
                    <div class="col-md-6">
                      <select class="form-control select2" id='servicePengiriman' onchange="getOngkir()">
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2  col-form-label">Sub Total</label>
                <div class="col-sm-10">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="text" name="subTotal" id="subTotal" class="form-control" value="<?=$subTotal;?>"
                        readonly>
                      <label id="estimasiPengiriman"></label>
                    </div>
                    <!-- <div class="col-md-5">
                        
                      </div> -->
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="hargaOngkir" class="col-sm-2  col-form-label">Ongkir</label>
                <div class="col-sm-10">
                  <input type="text" name="hargaOngkir" id="hargaOngkir" class="form-control" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="hargaOngkir" class="col-sm-2  col-form-label">Total</label>
                <div class="col-sm-10">
                  <input type="text" name="totalSemua" id="totalSemua" class="form-control" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="catatanOrder" class="col-sm-2  col-form-label">Catatan</label>
                <div class="col-sm-10">
                  <textarea id='catatanOrder' name='catatanOrder' class='form-control' rows="3"></textarea>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <div id="resultContent"></div>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-2  col-form-label"></label>
                <div class="col-sm-10">
                  <a onclick="submitCheckOut();" class="btn btn-md btn-primary pull-right" style="margin-right: 1%;"
                    id="btnCheckOut">
                    CheckOut </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="HistoryAlamat" tabindex="-1" role="dialog" aria-labelledby="HistoryAlamat"
  aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="HistoryAlamat">History Alamat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding: 1%;background: white;">
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
        <h5 class="modal-title" id="TambahAlamat">Tambahkan Alamat Sebagai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="padding: 1%;background: white;font-size: 13px;">
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
        <a href="javascript:void(0)" onclick="saveAlamat();" class="btn btn-succes">Tambahkan</a>
        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function provinsiChanged() {
    $.ajax({
      type: 'POST',
      data: {
        idProvinsi: $("#idProvinsi").val()
      },
      url: "<?=base_url();?>shop.member/manage/provinsiChanged",
      success: function (data) {
        var resp = eval('(' + data + ')');
        if (resp.err == '') {
          $("#idKota").html(resp.content.idKota);
        } else {}
      }
    });
  }

  function expedisiPengirimanChanged() {
    if ($("#idProvinsi").val() == '') {
      swal("Error", "Pilih Provinsi", "error");
    } else if ($("#idKota").val() == '') {
      swal("Error", "Pilih Kota", "error");
    } else if ($("#idExpedisi").val() == '') {
      swal("Error", "Pilih Expedisi Pengiriman", "error");
    } else {
      $("#loading").css("display", "flex");
      $.ajax({
        type: 'POST',
        data: {
          idProvinsi: $("#idProvinsi").val(),
          idKota: $("#idKota").val(),
          beratTotal: $("#beratTotal").val(),
          idExpedisi: $("#idExpedisi").val(),
        },
        url: "<?=base_url();?>shop.member/manage/expedisiPengirimanChanged",
        success: function (data) {
          var resp = eval('(' + data + ')');
          $("#loading").css("display", "none");
          if (resp.err == '') {
            $("#servicePengiriman").html(resp.content.servicePengiriman);
          } else {
            swal("Error", resp.err, "error");
          }
        }
      });
    }
  }

  function getOngkir() {
    if ($("#servicePengiriman").val() != "") {
      var explodeService = $("#servicePengiriman").val().split(";");
      $("#hargaOngkir").val(explodeService[1]);
    }
    var total;
    var ongkir = parseInt($("#hargaOngkir").val());
    var subTotal = parseInt($("#subTotal").val());
    total = subTotal + ongkir;
    $("#totalSemua").val(total);
  }

  function submitCheckOut() {
    if ($("#namaPembeli").val() == '') {
      swal("Error", "Isi Nama Pembeli", "error");
    } else if ($("#nomorTelepon").val() == '') {
      swal("Error", "Isi Nomor Telepon", "error");
    } else if ($("#idProvinsi").val() == '') {
      swal("Error", "Pilih Provinsi", "error");
    } else if ($("#idKota").val() == '') {
      swal("Error", "Pilih Kota", "error");
    }
    if ($("#alamatPembeli").val() == '') {
      swal("Error", "Isi Alamat Pembeli", "error");
    } else if ($("#idExpedisi").val() == '') {
      swal("Error", "Pilih Expedisi Pengiriman", "error");
    } else if ($("#servicePengiriman").val() == '') {
      swal("Error", "Pilih Service Pengiriman", "error");
    } else {
      $("#loading").css("display", "flex");
      $.ajax({
        type: 'POST',
        data: {
          namaPembeli: $("#namaPembeli").val(),
          emailPembeli: $("#emailPembeli").val(),
          nomorTelepon: $("#nomorTelepon").val(),
          alamatPembeli: $("#alamatPembeli").val(),
          kecamatanPembeli: $("#kecamatanPembeli").val(),
          idProvinsi: $("#idProvinsi").val(),
          idKota: $("#idKota").val(),
          beratTotal: $("#beratTotal").val(),
          idExpedisi: $("#idExpedisi").val(),
          servicePengiriman: $("#servicePengiriman").val(),
          hargaOngkir: $("#hargaOngkir").val(),
          subTotal: $("#subTotal").val(),
          catatanOrder: $("#catatanOrder").val(),
        },
        url: "<?=base_url();?>shop.member/manage/submitCheckOut",
        success: function (data) {
          var resp = eval('(' + data + ')');
          $("#loading").css("display", "none");
          if (resp.err == '') {
            $("#sumCart").text(resp.content.jumlahCart);
            swal("Success", "Transaksi Berhasil silahkan lakukan pembayaran di halaman Transaksi", "succes");
            // loadMainContentMember('/shop.member/manage');
            loadMainContentMember('/order.member/manage/detail?id=' + resp.content.idTransaksi);
          } else {
            swal("Error", resp.err, "error");
          }
        }
      });
    }
  }
</script>