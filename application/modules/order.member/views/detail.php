<style>
  table {
    border: 1px solid #ccc;
    border-collapse: collapse;
    margin: 0;
    padding: 0;
    width: 100%;
    table-layout: fixed;
  }

  table caption {
    font-size: 1.5em;
    margin: .5em 0 .75em;
  }

  table tr {
    background-color: #f8f8f8;
    border: 1px solid #ddd;
    padding: .35em;
  }

  table th,
  table td {
    padding: .625em;
    text-align: center;
  }

  table th {
    font-size: .85em;
    letter-spacing: .1em;
    text-transform: uppercase;
  }

  @media screen and (max-width: 600px) {
    table {
      border: 0;
    }

    table caption {
      font-size: 1.3em;
    }

    table thead {
      border: none;
      clip: rect(0 0 0 0);
      height: 1px;
      margin: -1px;
      overflow: hidden;
      padding: 0;
      position: absolute;
      width: 1px;
    }

    table tr {
      border-bottom: 3px solid #ddd;
      display: block;
      margin-bottom: .625em;
    }

    table td {
      border-bottom: 1px solid #ddd;
      display: block;
      font-size: .8em;
      text-align: right;
    }

    table td::before {
      /*
    * aria-label has no advantage, it won't be read inside a table
    content: attr(aria-label);
    */
      content: attr(data-label);
      float: left;
      font-weight: bold;
      text-transform: uppercase;
    }

    table td:last-child {
      border-bottom: 0;
    }
  }
</style>

<div class="container mt-4">
  <div class="card">
    <div class="card-header">
      <h3>Detail Transactions #<?=$dataJSON['idTransaksi'];?></h3>
    </div>
    <div class="card-body">
      <h5 class="d-none d-sm-block font-weight-bold fs-5 text-capitalize text-main mb-4">data customer</h5>

      <!-- desktop -->
      <div class="d-none d-sm-block ml-3">
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <p class="text-capitalize fw-bold">nama</p>
          </div>
          <div class="col-sm-6 col-lg-9">
            <p class="text-capitalize"><?=$dataJSON['nama']?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3">
            <p class="text-capitalize fw-bold">no telepon / wa</p>
          </div>
          <div class="col-lg-9">
            <p class="text-danger"><?=$dataJSON['nomor_telepon']?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-3">
            <p class="text-capitalize fw-bold">alamat</p>
          </div>
          <div class="col-lg-9">
            <p class="text-capitalize text-justify"><?=$dataJSON['alamat']?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-lg-3">
            <p class="text-capitalize fw-bold">tanggal transaksi</p>
          </div>
          <div class="col-sm-6 col-lg-9">
            <p class="text-capitalize"><?=$dataJSON['tanggal']?> <?=$dataJSON['jam']?></p>
          </div>
        </div>


      </div>
      <div class="row d-none d-sm-block">
        <div class="col-lg-12">
          <h5 class="font-weight-bold fs-5 text-capitalize text-main mt-4 mb-4">Detail Pembelian</h5>
        </div>
      </div>
      <!-- end desktop -->

      <!-- mobile -->
     
      <div class="d-block d-sm-none">
        <div class="text-center">
          <h5 class="font-weight-bold fs-5 text-capitalize text-main mb-4">data customer</h5>
        </div>
        <div class="row">
          <div class="col-6">
            <p class="text-capitalize fw-bolder">Nama</p>
          </div>
          <div class="col-6">
            <p class="text-uppercase"><?=$dataJSON['nama']?></p>
            </p>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <p class="text-capitalize fw-bolder">no telepon / wa</p>
          </div>
          <div class="col-6">
            <p class="text-danger"><?=$dataJSON['nomor_telepon']?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <p class="text-capitalize fw-bolder">alamat</p>
          </div>
          <div class="col-6">
            <p class="text-uppercase"><?=$dataJSON['alamat']?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <p class="text-capitalize fw-bolder">tanggal transaksi</p>
          </div>
          <div class="col-6">
            <p class="text-uppercase"><?=$dataJSON['tanggal']?> <?=$dataJSON['jam']?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-12 text-center">
             <h5 class="font-weight-bold fs-5 text-capitalize text-main mt-4 mb-4">Detail Pembelian</h5>
          </div>
        </div>
      </div>
      <!-- end mobile -->

      <div class="row">
        <div class="col-lg-12 table-responsive">
          <table>
            <thead>
              <tr>
                <th scope="col" class="text-uppercase font-weight-bold" style="width: 8%;">no</th>
                <th scope="col" class="text-uppercase font-weight-bold">produk</th>
                <th scope="col" class="text-uppercase font-weight-bold">harga</th>
                <th scope="col" class="text-uppercase font-weight-bold" style="width: 8%;">qty</th>
                <th scope="col" class="text-uppercase font-weight-bold">total</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $nomor = 1;
              $arrayDetailTransaksi = $dataJSON['arrayDetailTransaksi'];
              for ($i=0; $i < sizeof($arrayDetailTransaksi) ; $i++) {
                echo "
                <tr>
                  <td data-label='No'>$nomor</td>
                  <td data-label='Produk'>".$arrayDetailTransaksi[$i]['nama_produk']."</td>
                  <td data-label='Harga'>".$arrayDetailTransaksi[$i]['harga']."</td>
                  <td data-label='Qty'>".$arrayDetailTransaksi[$i]['qty']."</td>
                  <td data-label='Total'>".$arrayDetailTransaksi[$i]['total']."</td>
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
        <div class="row mt-3">
          <div class="col-lg-7"></div>
          <div class="col-lg-3">
            <p class="text-uppercase fw-bolder">sub total</p>
          </div>
          <div class="col-lg-2 text-right">
            <p><?=$dataJSON['sub_total'];?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-7"></div>
          <div class="col-lg-3">
            <p class="text-uppercase fw-bolder">shipping</p>
          </div>
          <div class="col-lg-2 text-right">
            <p><?=$dataJSON['shiping'];?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-7"></div>
          <div class="col-lg-3">
            <p class="text-uppercase fw-bolder">kode unik </p>
          </div>
          <div class="col-lg-2 text-right">
            <p><?=$dataJSON['kode_unik'];?></p>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-7"></div>
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
      <div class="d-block d-sm-none mb-3">
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
      <div class="d-none d-sm-block">
           <h5 class="font-weight-bold fs-5 text-capitalize text-main mb-4 mt-5">Metode Transfer</h5>
      </div>
     <div class="d-block d-sm-none text-center">
           <h5 class="font-weight-bold fs-5 text-capitalize text-main mb-4 mt-4">Metode Transfer</h5>
      </div>
      <div class="row bg-secondary px-2 py-2 pt-5">
        <div class="col-md-4 text-center mb-4">
          <img src="https://i.ibb.co/51bmB77/BCA.png" style="max-width: 120px" />
          <div class="mt-3 fw-bolder fs-6">BCA : 777.246.1529</div>
          <div class="fw-bolder fs-6">a.n Dini Yuliani</div>
        </div>
        <div class="col-md-4 text-center mb-4">
          <img src="https://i.ibb.co/SNt0STp/MANDIRI.png" style="max-width: 140px" />
          <div class="mt-3 fw-bolder fs-6">Mandiri : 130.001.990.9392</div>
          <div class="fw-bolder fs-6">a.n Dini Yuliani</div>
        </div>
        <div class="col-md-4 text-center mb-4">
          <img src="https://i.ibb.co/pr5B4LJ/BRI.png" style="max-width: 150px" />
          <div class="mt-3 fw-bolder fs-6">BRI: 040.501.039.854.505</div>
          <div class="fw-bolder fs-6">a.n Dini Yuliani</div>
        </div>
      </div>
      <div class="text-center"><span class="btn btn-success mt-3" style="cursor:pointer;"
        onclick="konfirmasiOrder(<?=$dataJSON['idTransaksi'];?>)">KONFIRMASI PEMBAYARAN </span></div>        
      
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