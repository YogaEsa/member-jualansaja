<div class="container mb-5">
  <div class="row mt-4">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center mb-4 pb-0 border-bottom">
            <h4 class="card-title">Withdraw</h4>
          </div>
          <div class="table-responsive-md">
            <table class="table table-striped table-bordered table-hover" id='daftarTable'>
              <thead class="bg-light">
                <tr>
                  <th class="text-center align-middle" style="width: 1%;">NO</th>
                  <th class="align-middle">TANGGAL</th>
                  <th class="align-middle">JAM</th>
                  <th class="align-middle">JUMLAH</th>
                  <th class="align-middle">STATUS</th>
                </tr>
              </thead>
              <tbody>
                <?php
                for ($iDaftar=0; $iDaftar < sizeof($arrayDaftar) ; $iDaftar++) {
                  echo "
                  <tr>
                    <td style='text-align:center;'>".$arrayDaftar[$iDaftar]['nomor_daftar']."</td>
                    <td>".$arrayDaftar[$iDaftar]['tanggal']."</td>
                    <td>".$arrayDaftar[$iDaftar]['jam']."</td>
                    <td style='text-align:right;'>".$arrayDaftar[$iDaftar]['total']."</td>
                    <td>".$arrayDaftar[$iDaftar]['status']."</td>
                  </tr>
                  ";
                }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $('#daftarTable').cardtable();
  </script>

  <script type="text/javascript">
    $('#daftarTable').cardtable();
  </script>