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
          <div class="mt-2 mb-3 border-bottom"></div>

          <div class="col-md-12">
            <div class="table-with-scrollbar" id="chart" style='width: 100%;'>
              <table class="table table-bordered table-hover menu">
                <thead>
                  <tr>
                    <th style="width: 1%; font-weight: bold;">No </th>
                    <th style="font-weight: bold;">Nama</th>
                    <th style="font-weight: bold;">Harga</th>
                    <th style="font-weight: bold; width: 13%">Jumlah</th>
                    <th style="font-weight: bold;">Total</th>
                    <th style="width: 15%; font-weight: bold;">#</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                		$no = 0;
                		foreach($list->result_array() as $row)
                		{
                			$no++;
                      $totalCart+= $row['total'];
                		?>
                  <tr>
                    <td><?= $no?></td>
                    <td><?=$row['nama_produk']?></td>
                    <td style="text-align:right;"><?= number_format($row['harga_produk']);?></td>
                    <td><input type="number" min='1' name="jumlahProduk<?= $no; ?>" id="jumlahProduk<?= $no; ?>"
                        class="form-control" readonly value="<?=$row['qty']?>"></td>
                    <td style="text-align:right;"><?= number_format($row['total']);?></td>
                    <td>
                      <a style="display: none;" id="btnSave<?= $row['id']; ?>" class="btn btn-success btn-xs"
                        href="javascript:void(0)" onclick="saveProduk('<?= $row['id']; ?>','<?= $no; ?>')">
                        <i class="  icon-doc menu-icon"></i>
                      </a>
                      <a id="btnEdit<?= $no; ?>" class="btn btn-warning btn-xs"
                        onclick="editProduk(<?= $row['id_produk']; ?>)">
                        <i class=" icon-note menu-icon"></i>
                      </a>
                      <a class="btn btn-danger btn-xs" href="javascript:void(0)"
                        onclick="deleteCart(<?= $row['id']; ?>)">
                        <i class="icon-trash menu-icon"></i>
                      </a>
                    </td>
                  </tr>
                  <?php }?>
                  <td colspan="4"></td>
                  <td style="text-align:right;"><?= number_format($totalCart);?></td>
                </tbody>
              </table>
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