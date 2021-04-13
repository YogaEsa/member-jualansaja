<div class="container mt-4">
  <h4 class="fs-4 fw-bolder mb-1">
    Withraw
  </h4>
  <p>
    History, Withdraw Anda
  </p>
  <div class="row mt-4">
    <?php
        for ($iDaftar=0; $iDaftar < sizeof($arrayDaftar) ; $iDaftar++) {
          if ($arrayDaftar[$iDaftar]['status'] == "COMPLETE") {
            $status = "<div class='fs-6 mt-2 badge badge-outline-success'>".$arrayDaftar[$iDaftar]['status']."</div>";
          }else{
             $status = "<div class='fs-6 mt-2 badge badge-outline-warning'>".$arrayDaftar[$iDaftar]['status']."</div>";
          }
          echo "
              <div class='col-lg-6'>
                <div class='card stl-card mb-3'>
                    <div class='card-body py-1'>
                        <div class='d-flex flex-row'>
                            <div class='p-2 align-self-center'>
                                <h4 class='px-2 py-2 bg-main white-text' style='border-radius: 100px;'>#".$arrayDaftar[$iDaftar]['nomor_daftar']."</h4>
                            </div>
                            <div class='p-2 align-self-center mt-2'>
                                <p class='card-description mb-2'><i
                                        class='icon icon-calendar  icon-sm text-primary mr-2'></i>".$arrayDaftar[$iDaftar]['tanggal']."</p>
                                <p class='card-description mb-2'><i
                                        class='icon icon-clock  icon-sm text-primary mr-2'></i>".$arrayDaftar[$iDaftar]['jam']."</p>
                            </div>
                            <div class='p-2  align-self-center ml-auto'>
                                <div class='fs-6 fw-bolder'>Rp ".$arrayDaftar[$iDaftar]['total']."</div>
                                ".$status."
                            </div>
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

  <script type="text/javascript">
    $('#daftarTable').cardtable();
  </script>