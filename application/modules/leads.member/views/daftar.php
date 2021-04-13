<div id="daftarTable">
  <div class="row">
    <?php
        for ($iDaftar=0; $iDaftar < sizeof($arrayDaftar) ; $iDaftar++) {
          if ($arrayDaftar[$iDaftar]["status"] == "RESELLER") {
            $status = '<div class="badge badge-outline-primary">'.$arrayDaftar[$iDaftar]["status"].'</div>';
          }elseif ($arrayDaftar[$iDaftar]["status"] == "LEADS") {
            $status = '<div class="badge badge-outline-success">'.$arrayDaftar[$iDaftar]["status"].'</div>';
          }else{
            $status = '<div class="badge badge-outline-warning">'.$arrayDaftar[$iDaftar]["status"].'</div>';
          }
          echo'
    <div class="col-lg-4 col-md-6 mt-2 mb-2 stretch-card">
      <div class="card stl-card shadow-lg">
        <div class="card-body p-3" >
          <div class="d-flex align-items-center mb-3 border-bottom">
            <h4 class="card-title">'.$arrayDaftar[$iDaftar]["nama"].'</h4>
            <div class="text-muted ml-auto">
              '.$status.'
            </div>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-inline-block">
              <div class="d-flex mt-2">
                <p class="font-weight-normal text-wrap">
                  <div class="badge badge-pill badge-outline-primary mr-3"><i class="icon-user"></i></div>'.$arrayDaftar[$iDaftar]["username"].'
                </p>
              </div>
              <div class="d-flex mt-2">
                <div class="badge badge-pill badge-outline-info mr-3"><i class="icon-mail"></i></div>
               <span class="font-weight-normal text-wrap">'.$arrayDaftar[$iDaftar]["email"].'</span>
              </div>
              <div class="d-flex mt-2">
                <p class="text-wrap">
                  <div class="badge badge-pill badge-outline-success mr-3"><i class="icon-phone"></i></div>
                  '.$arrayDaftar[$iDaftar]["nomor_telepon"].'
                </p>
              </div>
            </div>
          </div>
          <div class="d-flex text-center mt-3 border-top stretched-link">
            <button type="button" class="btn btn-sm py-2 px-4 mx-auto btn-success mt-3" onClick=viewDetail()><i
                class="mdi mdi-eye"></i>Lihat</button>
          </div>
        </div>
      </div>
    </div>';
        }
        ?>
  </div>
</div>
