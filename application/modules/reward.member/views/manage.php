<div class="container mb-5">
  <h4 class="fs-4 fw-bolder mt-4 mb-4">
    Reward
  </h4>
  <div class="row">
    <?php
      for ($i=0; $i < sizeof($dataReward); $i++) {  ;?>
     <div class="col-md-6 mb-3">
      <div class="card" >
        <div class="card-body">
          <div class="text-center">
            <img src="<?=$dataReward[$i]['thumbnail'];?>" class='img-fluid' style="max-height:164px">
          </div>
          <h5 class="card-title text-center mt-3"><?=$dataReward[$i]['nama_reward'];?></h5>
          <div class='row'>
            <div class="col-md-12">
              AKUMULASI OMSET PRIBADI Rp <?=$dataReward[$i]['omset_pribadi'];?>
              <div class="progress" style="height:15px;">
                <div class="progress-bar bg-success" role="progressbar"
                  style="width: <?=$dataReward[$i]['progresOmsetPribadi'];?>%"
                  aria-valuenow="<?=$dataReward[$i]['progresOmsetPribadi'];?>" aria-valuemin="0" aria-valuemax="100">
                  <?=$dataReward[$i]['progresOmsetPribadi'];?>%
                </div>
              </div>
            </div>
          </div>
          <?php if($dataReward[$i]['statusDapatClaim'] == "BISA"){?>
          <div class='row'>
            <div class="col-md-12 mt-2">
              <span class="btn btn-primary" style="width:100%;"
                onClick=loadMainContentMember('/reward.member/manage/withdraw/?id=<?=$dataReward[$i]['id'];?>');>WITHDRAW
                SEKARANG</span> 
            </div>
          </div> 
          <?php };?> 
        </div>
      </div>
     </div>
     <?php
      };?>
  </div>
</div>