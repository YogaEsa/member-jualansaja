<div class="container mb-5">
  <div class="row">
    <div class="col-lg-12 mt-4 ">
      <div class="card stl-card shadow-lg">
        <div class="card-body">
          <h4 class="card-title"><?=$title?>
            <a href="javascript:void(0)" onclick="loadMainContentMember('/shop.member/manage/checkout');"
              class="btn btn-sm btn-primary pull-right"> CheckOut </a>
            <a href="javascript:void(0)" onclick="loadMainContentMember('/shop.member/manage');"
              class="btn btn-sm btn-success pull-right" style="margin-right: 1%;"> Tambah Produk </a>
          </h4>
          <div class="mt-2 mb-5 border-bottom"></div>

          <div class="col-md-12 mt-5">
            <?php
                		$no = 0;
                		foreach($list->result_array() as $row)
                		{
                			$no++;
                      $totalCart+= $row['total'];
                		?>
            <div class='row mx-auto list-cart'>
              <div class='col-lg-3 col-md-5'>
                <a href='#'>
                  <img class='img-fluid rounded mb-3 mb-md-0' alt='' src='http://placehold.it/200x100'>
                </a>
              </div>
              <div class='col-lg-9 col-md-7'>
                <div class='row'>
                  <div class='col-lg-6'>
                    <h3 class='fs-6 fw-bolder'><?=$row['nama_produk']?></h3>
                    <p><b>Harga</b> Rp <?= number_format($row['harga_produk']);?>
                      <br class='mb-1'>
                      <b>Total</b> Rp <?= number_format($row['total']);?>
                    </p>
                  </div>
                  <div class='col-lg-6'>
                    <div class='float-md-right'>
                      <input type='number' min='1' name="jumlahProduk<?= $no; ?>" id="jumlahProduk<?= $no; ?>" readonly
                        value="<?=$row['qty']?>" style='max-width: 85px;' class='form-control  mb-2'>
                      <a style='display: none;' id='btnSave14' class='btn btn-success btn-xs' href='javascript:void(0)'
                        onclick='saveProduk(' 14','1')'>
                        <i class='  icon-doc menu-icon'></i>
                      </a>
                      <a id='btnEdit1' class='btn btn-warning btn-xs' onclick='editProduk(2)'>
                        <i class=' icon-note menu-icon'></i>
                      </a>
                      <a class='btn btn-danger btn-xs' href='javascript:void(0)' onclick='deleteCart(14)'>
                        <i class='icon-trash menu-icon'></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr>
            <?php }?>
            <div class="float-right fw-bolder fs-5 mr-3">
              Rp. <?= number_format($totalCart);?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" src="<?= base_url();?>assets/ui-member/js/freeze-table.js"></script>
<script type="text/javascript">
  function editProduk(idProduk) {
    loadMainContentMember('/shop.member/manage/detail?id=' + idProduk);
  }

  function deleteCart(idCart) {
    $("#loading").css("display", "flex");
    $.ajax({
      type: 'POST',
      data: {
        idCart: idCart
      },
      url: '<?=base_url();?>' + 'shop.member/manage/deleteCart',
      success: function (data) {
        $("#loading").css("display", "none");
        if (data.err == '') {
          $("#sumCart").text(data.content.jumlahCart);
          swal("Success", "Berhasil Menambahkan Keranjang", "success");
          loadMainContentMember('/shop.member/manage/cart');
        } else {
          swal(data.err, "", "warning");
        }
      }
    });
  }

  $(function () {
    TableResponsive();
  });

  function TableResponsive() {
    $('#chart').freezeTable({
      'scrollBar': true,
      'headWrapStyles': {
        'top': '45px',
        'width': '100px'
      },
      'columnNum': 0,
    });
  }
  $(window).resize(function () {
    TableResponsive();
  });
</script>