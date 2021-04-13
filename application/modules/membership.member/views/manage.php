<div class="container mb-5">
<h4 class="fs-4 fw-bolder mt-4 mb-4">
    Membership
  </h4>
  <div class="row">
    <div class="col-lg-12">
      <div class="card stl-card shadow-lg">
        <div class="card-body">
          <h4 class="card-title">Progress Menjadi Agen</h4>
          <div class="row">
            <div class="col-lg-4 ">
               <div class="stl-bar">
              <p class="card-description">Akumulasi Omset Pribadi</p>
              <div class="progress" style="height:15px;">
                <div class="progress-bar progress-bar bg-success" role="progressbar"
                  style="width: <?=$progresOmsetPribadi;?>%" aria-valuenow="<?=$progresOmsetPribadi;?>"
                  aria-valuemin="0" aria-valuemax="100">
                  <?=$progresOmsetPribadi;?>%
                </div>
              </div>
               </div>
            </div>
            <div class="col-lg-4">
              <div class="stl-bar">
              <p class="card-description text-center">Akumulasi Omset Tim</p>
              <div class="progress" style="height:15px;">
                <div class="progress-bar progress-bar bg-warning" role="progressbar"
                  style="width: <?=$progresOmsetTim;?>%" aria-valuenow="<?=$progresOmsetTim;?>" aria-valuemin="0"
                  aria-valuemax="100">
                  <?=$progresOmsetTim;?>%
                </div>
              </div>
              </div>
            </div>
            <div class="col-lg-4">
               <div class="stl-bar">
              <p class="card-description text-center">Reseller</p>
              <div class="progress" style="height:15px;">
                <div class="progress-bar progress-bar bg-info" role="progressbar"
                  style="width: <?=$progressJumlahReseller;?>%" aria-valuenow="<?=$progressJumlahReseller;?>"
                  aria-valuemin="0" aria-valuemax="100">
                  <?=$progressJumlahReseller;?>%
                </div>
              </div>
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 mt-4 align-items-stretch">
      <div class="card stl-card shadow-lg">
        <div class="card-body">
          <h4 class="card-title fs-6">KOMISI REFERAL</h4>
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-inline-block">
              <div class="d-flex">
                <h2 class="mb-0 fs-4 mb-2">Rp <?=$komisiReferal;?></h2>
              </div>
              <small class="text-red mt-2">Dari <?=$jumlahReferal;?> member.</small>
            </div>
            <div class="d-inline-block">
              <div class="bg-success px-1 py-1 rounded">
                <i class="mdi mdi-currency-usd text-white icon-md"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-4 mt-4 align-items-stretch">
      <div class="card stl-card shadow-lg">
        <div class="card-body">
          <h4 class="card-title fs-6">OMSET PERSONAL BULAN INI</h4>
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-inline-block">
              <div class="d-flex">
                <h2 class="mb-0 fs-4 mb-2">Rp <?=$personalOmset;?></h2>
              </div>
              <small class="text-red mt-2">Dari <?=$jumlahTransaksi;?> member.</small>
            </div>
            <div class="d-inline-block">
              <div class="bg-success px-1 py-1 rounded">
                <i class="mdi mdi-currency-usd text-white icon-md"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     <div class="col-md-4 mt-4 align-items-stretch">
      <div class="card stl-card shadow-lg">
        <div class="card-body">
          <h4 class="card-title fs-6">KOMISI PERSONAL BULAN INI</h4>
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-inline-block">
              <div class="d-flex">
                <h2 class="mb-0 fs-4 mb-2">Rp <?=$komisiPeronal;?></h2>
              </div>
              <small class="text-red mt-2">Dari <?=$jumlahTransaksi;?> member.</small>
            </div>
            <div class="d-inline-block">
              <div class="bg-success px-1 py-1 rounded">
                <i class="mdi mdi-currency-usd text-white icon-md"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     <div class="col-md-6 mt-4 align-items-stretch">
      <div class="card stl-card shadow-lg">
        <div class="card-body">
          <h4 class="card-title fs-6">OMSET TIM BULAN INI</h4>
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-inline-block">
              <div class="d-flex">
                <h2 class="mb-0 fs-4 mb-2">Rp <?=$omsetTIM;?></h2>
              </div>
            </div>
             <div class="d-inline-block">
              <div class="bg-warning px-1 py-1 rounded">
                <i class="mdi mdi-credit-card text-white icon-md"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     <div class="col-md-6 mt-4 align-items-stretch">
      <div class="card stl-card shadow-lg">
        <div class="card-body">
          <h4 class="card-title fs-6">KOMISI TIM BULAN INI</h4>
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-inline-block">
              <div class="d-flex">
                <h2 class="mb-0 fs-4 mb-2">Rp <?=$komisiTIM;?></h2>
              </div>
            </div>
             <div class="d-inline-block">
              <div class="bg-warning px-1 py-1 rounded">
                <i class="mdi mdi-credit-card text-white icon-md"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 mt-4 align-items-stretch">
      <div class="card stl-card shadow-lg">
        <div class="card-body" style="min-height: 170px;">
          <h4 class="card-title fs-6">TOTAL KOMISI BULAN INI</h4>
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-inline-block">
              <div class="d-flex">
                <h2 class="mb-0 fs-4 mb-2">Rp <?=$komisiBulanIni;?></h2>
              </div>
            </div>
             <div class="d-inline-block">
              <div class="bg-primary px-1 py-1 rounded">
                <i class="mdi mdi-cart-plus text-white icon-md"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6 mt-4 align-items-stretch">
      <div class="card stl-card shadow-lg">
        <div class="card-body">
          <h4 class="card-title fs-6">KOMISI YANG BELUM DIBAYAR</h4>
          <div class="d-flex justify-content-between align-items-center">
            <div class="d-inline-block">
              <div class="d-flex">
                <h2 class="mb-0 fs-4 mb-2">Rp <?=$komisiBelumBayar;?></h2>
              </div>
            </div>
             <div class="d-inline-block">
              <div class="bg-danger px-1 py-1 rounded">
                <i class="mdi mdi-cart-plus text-white icon-md"></i>
              </div>
            </div>   
          </div>   
        </div>
        <span class="btn btn-primary" onClick="loadMainContentMember('/dashboard.member/manage/withdraw');">WITHDRAW
          SEKARANG</span>
      </div>
    </div>
  </div>
</div>