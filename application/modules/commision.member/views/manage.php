<div class="container mt-4">
  <h4 class="fs-4 fw-bolder mb-1">
    Commision
  </h4>
  <p>
    History, Commision Anda
  </p>
    <div class="row mt-4">
      <?php
          for ($iDaftar=0; $iDaftar < sizeof($arrayDaftar) ; $iDaftar++) {
              echo "
                  <div class='col-lg-6'>
                    <div class='card stl-card mb-3'>
                        <div class='card-body py-1'>
                            <div class='d-flex flex-row'>
                                <div class='p-2 align-self-center'>
                                    <h4 class='px-2 py-2 bg-main white-text' style='border-radius: 100px;'>#".$arrayDaftar[$iDaftar]['nomor_daftar']."</h4>
                                </div>
                                <div class='p-2 align-self-center mt-0'>
                                    <p class='fs-6 fw-bolder mt-3 mb-0'><b>Id: ".$arrayDaftar[$iDaftar]['nomor_transaksi']."</b></p>
                                    <small class='mb-2 text-muted fw-bolder'>".$arrayDaftar[$iDaftar]['waktu']."<p></p></small>
                                </div>
                                <div class='p-2  align-self-center ml-auto'>
                                    <small class='mb-2 badge badge-outline-success'>".$arrayDaftar[$iDaftar]['jenis']."</small>
                                    <div class='fs-6 fw-bolder'>Rp ".$arrayDaftar[$iDaftar]['total']."</div>
                                </div>
                            </div>
                            <div role='alert' class='alert alert-outline-primary text-center'>
                                <p class='mb-0 d-inline-block'>".$arrayDaftar[$iDaftar]['keterangan']."</p>
                            </div>
                        </div>
                    </div>
                </div>";
                }?>
    </div>
  </div>



<script type="text/javascript">
  $('#daftarTable').cardtable();
</script>