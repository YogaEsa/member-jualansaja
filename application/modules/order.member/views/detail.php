<div class="container mt-4">
  <div class="card">
    <div class="card-header">
      <h3>Detail Transactions #<?=$dataJSON['idTransaksi'];?></h3>
    </div>
    <div class="card-body">
      <h5 class="font-weight-bold text-uppercase">data customer</h5>

      <!-- desktop -->
      <div class="d-none d-sm-block">
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <p class="text-uppercase">nama</p>
          </div>
          <div class="col-sm-6 col-lg-9">
            <p class="text-uppercase"><?=$dataJSON['nama']?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3">
            <p class="text-uppercase">no telepon / wa</p>
          </div>
          <div class="col-lg-9">
            <p class="text-danger"><?=$dataJSON['nomor_telepon']?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3">
            <p class="text-uppercase">alamat</p>
          </div>
          <div class="col-lg-9">
            <p class="text-uppercase"><?=$dataJSON['alamat']?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <p class="text-uppercase">tanggal transaksi</p>
          </div>
          <div class="col-sm-6 col-lg-9">
            <p class="text-uppercase"><?=$dataJSON['tanggal']?> <?=$dataJSON['jam']?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <p class="font-weight-bold text-uppercase">produk</p>
          </div>
        </div>
      </div>
      <!-- end desktop -->

      <!-- mobile -->
      <div class="d-block d-sm-none">
        <div class="row">
          <div class="col-6">
            <p class="text-uppercase">nama</p>
          </div>
          <div class="col-6 text-right">
            <p class="text-uppercase"><?=$dataJSON['nama']?></p>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <p class="text-uppercase">no telepon / wa</p>
          </div>
          <div class="col-6 text-right">
            <p class="text-danger"><?=$dataJSON['nomor_telepon']?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <p class="text-uppercase">alamat</p>
          </div>
          <div class="col-6 text-right">
            <p class="text-uppercase"><?=$dataJSON['alamat']?></p>
          </div>
        </div>

        <div class="row">
          <div class="col-6">
            <p class="text-uppercase">tanggal transaksi</p>
          </div>
          <div class="col-6 text-right">
            <p class="text-uppercase"><?=$dataJSON['tanggal']?> <?=$dataJSON['jam']?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <p class="font-weight-bold text-uppercase">produk</p>
          </div>
        </div>
      </div>
      <!-- end mobile -->

      <div class="row">
        <div class="col-lg-12 table-responsive">
          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th class="text-uppercase font-weight-bold" style="width: 1%;">no</th>
                <th class="text-uppercase font-weight-bold">produk</th>
                <th class="text-uppercase font-weight-bold">harga</th>
                <th class="text-uppercase font-weight-bold" style="width: 1%;">qty</th>
                <th class="text-uppercase font-weight-bold">total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $nomor = 1;
              $arrayDetailTransaksi = $dataJSON['arrayDetailTransaksi'];
              for ($i=0; $i < sizeof($arrayDetailTransaksi) ; $i++) {
                echo "
                <tr>
                  <td>$nomor</td>
                  <td>".$arrayDetailTransaksi[$i]['nama_produk']."</td>
                  <td >".$arrayDetailTransaksi[$i]['harga']."</td>
                  <td >".$arrayDetailTransaksi[$i]['qty']."</td>
                  <td >".$arrayDetailTransaksi[$i]['total']."</td>
                </tr>
                ";
                $nomor += 1;
              }
            ?>
            </tbody>
          </table>
        </div>
      </div>

      <!-- desktop -->
      <div class="d-none d-sm-block">
        <div class="row pt-4">
          <div class="col-lg-12">
            <p class="font-weight-bold text-uppercase">bill</p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3">
            <p class="text-uppercase">sub total</p>
          </div>
          <div class="col-lg-2 text-right">
            <p><?=$dataJSON['sub_total'];?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3">
            <p class="text-uppercase">shipping</p>
          </div>
          <div class="col-lg-2 text-right">
            <p><?=$dataJSON['shiping'];?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3">
            <p class="text-uppercase">kode unik </p>
          </div>
          <div class="col-lg-2 text-right">
            <p><?=$dataJSON['kode_unik'];?></p>
          </div>
        </div>
        <div class="row .d-none .d-sm-block">
          <div class="col-lg-3">
            <p class="text-uppercase font-weight-bold">total</p>
          </div>
          <div class="col-lg-2 text-right">
            <p class="font-weight-bold"><?=$dataJSON['total'];?></p>
          </div>
        </div>
      </div>
      <!-- end desktop -->

      <!-- mobile -->
      <div class="d-block d-sm-none">
        <div class="row pt-4">
          <div class="col-lg-12">
            <p class="font-weight-bold text-uppercase">bill</p>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <p class="text-uppercase">sub total</p>
          </div>
          <div class="col-6 text-right">
            <p><?=$dataJSON['sub_total'];?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <p class="text-uppercase">shipping</p>
          </div>
          <div class="col-6 text-right">
            <p><?=$dataJSON['shiping'];?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <p class="text-uppercase">coupon <span
                class="badge badge-warning text-uppercase"><?=$dataJSON['coupon_code'];?></span></p>
          </div>
          <div class="col-6 text-right">
            <p><?=$dataJSON['discount'];?></p>
          </div>
        </div>
        <div class="row .d-none .d-sm-block">
          <div class="col-6">
            <p class="text-uppercase font-weight-bold">total</p>
          </div>
          <div class="col-6 text-right">
            <p class="font-weight-bold"><?=$dataJSON['total'];?></p>
          </div>
        </div>
      </div>
      <!-- end mobile -->

      <span class="btn btn-success" style="cursor:pointer;"
        onclick="konfirmasiOrder(<?=$dataJSON['idTransaksi'];?>)">KONFIRMASI PEMBAYARAN </span>
    </div>
  </div>
</div>

<script type="text/javascript">
  function konfirmasiOrder(idTransaksi) {
    $.ajax({
      type: 'POST',
      data: {
        idTransaksi: idTransaksi,
      },
      url: "<?=base_url();?>order.member/manage/konfirmasiOrder",
      success: function (data) {
        var resp = eval('(' + data + ')');
        if (resp.err == '') {
          window.open(resp.content.url, "_blank");
        } else {
          swal("Error", resp.err, "error");
        }
      }
    });
  }
</script>