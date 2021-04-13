<div class="container mt-4">
  <h4 class="fs-4 fw-bolder mb-1">
    Transaksi
  </h4>
<?php
    for ($i=0; $i < sizeof($dataJSON) ; $i++) {
        ?>
      <div class="row" onclick=loadMainContentMember('/order.member/manage/detail?id=<?=$dataJSON[$i]['idTransaksi'];?>');>
        <div class="col-lg-12 mx-auto">
            <!-- List group-->
            <ul class="list-group shadow">
                <!-- list group item-->
                <li class="list-group-item">
                    <!-- Custom content-->
                    <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                        <div class="media-body order-2 order-lg-1 w-100">
                            <div class="row">
                              <div class="col-6">
                                NOMOR TRANSAKSI #<?=$dataJSON[$i]['idTransaksi'];?>
                                <h5 class="mt-0 font-weight-bold mb-2"><?=$dataJSON[$i]['nama'];?></h5><br>
                                <h5 class="mt-0 font-weight-bold mb-2">Rp. <?=$dataJSON[$i]['total'];?></h5><br>
                              </div>
                              <div class="col-6 text-right">
                                <p><?=$dataJSON[$i]['tanggal'];?> <?=$dataJSON[$i]['jam'];?></p>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-6">
                                <p class="mb-0 small text-dark font-weight-bold"><?=$dataJSON[$i]['nomor_telepon'];?></p>
                              </div>
                              <div class="col-6 text-right">
                                <?php
                                  if($dataJSON[$i]['status_order'] == 'PENDING'){
                                    $statusTransaksi = "<button class='btn btn-secondary btn-xs'>PENDING</button>";
                                  }elseif($dataJSON[$i]['status_order'] == 'PAID'){
                                    $statusTransaksi = "<button class='btn btn-primary btn-xs'>PAID</button>";
                                  }elseif($dataJSON[$i]['status_order'] == 'PROCESSING'){
                                    $statusTransaksi = "<button class='btn btn-info btn-xs'>PROCESSING</button>";
                                  }elseif($dataJSON[$i]['status_order'] == 'SHIPING'){
                                    $statusTransaksi = "<button class='btn btn-warning btn-xs'>SHIPING</button>";
                                  }elseif($dataJSON[$i]['status_order'] == 'COMPLETE'){
                                    $statusTransaksi = "<button class='btn btn-success btn-xs'>COMPLETE</button>";
                                  }
                                ?>
                                <?=$statusTransaksi;?>
                              </div>
                            </div>
                        </div>
                    </div> <!-- End -->
                </li> <!-- End -->
            </ul> <!-- End -->
        </div>
      </div>
<?php
}
?>
</div>

<script type="text/javascript">
function openInNewTab(url) {
  var win = window.open(url, '_blank');
  win.focus();
}
</script>
