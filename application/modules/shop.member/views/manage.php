 <div class="container mt-4">
   <h4 class="fs-4 fw-bolder mb-1">
     Shop
   </h4>
   <div class="row mt-4">
     <?php
       $no=0;
       // foreach($dataJSON->result_array() as $row)
       for ($i=0; $i < sizeof($dataJSON) ; $i++) {
             $no++;
        ?>
     <div class="col-sm-12 col-md-6 col-lg-4 d-flex align-items-stretch">
       <div class="card yellow-border">
         <img class="card-img-top" src="<?=$dataJSON[$i]['thumbnail'];?>" style="min-height: 334px;">
         <div class="card-body text-center py-1">
           <h4 class="card-title mb-2"><?= $dataJSON[$i]['nama_produk'];?></h4>
          
           <div class="fs-5 text-warning fw-bold mb-2">Rp. <?=$dataJSON[$i]['harga_jual'];?></div>
         </div>
         <div class="row mt-1 px-3">
           <div style="width:100%" class="d-flex flex-row justify-content-center">
             <div class="p-2">
               <input type="number" value="1" placeholder="0" class="form-control" style="border: 2px solid #eee;">
             </div>
             <div class="p-2">
               <button style="cursor:pointer; height:100%" class="btn btn-warning"
                 onClick=addToCart(<?= $dataJSON[$i]['id'];?>)>
                 ADD TO CART
               </button>
             </div>
           </div>
         </div>
         <div class="card-footer mt-2" style="background: #3F47D2;">
           <div class="row mt-1 px-3">
             <span style="!important;cursor:pointer;" class="btn btn-primary btn-block"
               onClick=detailProduk(<?= $dataJSON[$i]['id'];?>)>
               DETAIL
             </span>
           </div>
         </div>
       </div>
     </div>
     <?php
       }
     ?>
   </div>
 </div>

 <script type="text/javascript">
   function addToCart(idProduk) {
     $("#loading").css("display", "flex");
     $.ajax({
       type: 'POST',
       data: {
         idProduk: idProduk
       },
       url: '<?=base_url();?>' + 'shop.member/manage/addToCart',
       success: function (data) {
         $("#loading").css("display", "none");
         if (data.err == '') {
           swal("Success", "Berhasil Menambahkan Keranjang", "success");
           $("#sumCart").text(data.content.jumlahCart);
         } else {
           swal(data.err, "", "warning");
         }
       }
     });
   }

   function detailProduk(idProduk) {
     loadMainContentMember('/shop.member/manage/detail?id=' + idProduk);
   }
 </script>