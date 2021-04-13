<div class="container mt-4">
  <h4 class="fs-4 fw-bolder mb-1">
    Landing Page
  </h4>
  <div class="row mt-4">
    <?php
         $no=0;
         foreach($dataJSON->result_array() as $row)
             {
               $no++;
          ?>
    <div class="col-sm-12 col-md-6 col-lg-4 d-flex align-items-stretch">
      <div class="card stl-card">
        <div class="card-body stl-card" style="cursor: pointer;" onClick=loadMainContentMember('/landingpage.member/manage/detail?id=<?= $row['id'];?>');>
          <img class="card-img-top" src="<?= $row['thumbnail'];?>" style="min-height: 270px;">
          <h4 class="card-subtitle py-1 mb-2 fs-5 fw-bolder text-center text-white" style="background: rgba(63, 71, 210, 1);"><?= $row['judul'];?></h4>
        </div>
      </div>
    </div> 
    <?php
         }
       ?>
  </div>
</div>
