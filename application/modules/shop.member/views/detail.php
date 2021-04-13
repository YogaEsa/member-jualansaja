<style>
  #sync1 .item {
    margin: 5px;
    color: #FFF;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    text-align: center;
  }

  #sync2 .item {
    padding: 10px 0px;
    margin: 5px;
    color: #FFF;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    text-align: center;
    cursor: pointer;
  }

  #sync2 .item h1 {
    font-size: 18px;
  }

  #sync2 .synced .item {
    border: 4px solid #0c83e7;
  }
</style>
<link rel="stylesheet" href="<?=base_url()."assets/ui-member/vendors/owl-carousel/";?>owl.carousel.min.css">
<link rel="stylesheet" href="<?=base_url()."assets/ui-member/vendors/owl-carousel/";?>owl.theme.default.min.css">
<div class="container mt-4">
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-lg-6 col-md-6 mb-3">
          <div class="card stl-card shadow-lg">
            <div class="card-body">
               <div class="card-title fs-4 mb-0">
                <?=$nama_produk;?>
              </div>
             <div class="fs-3 text-warning fw-bold pb-1 mb-3 border-bottom">Rp . <?=$harga_jual;?></div>
              <div id="sync1" class="slider owl-carousel">
                <div class="item">
                  <h1><img src="<?=$thumbnail;?>" /></h1>
                </div>
                <div class="item">
                  <h1><img src="https://image-cdn.medkomtek.com/cMvsrui5fuo8CzOwvHv7xJqlCao=/640x640/smart/klikdokter-media-buckets/medias/2314836/original/025395800_1589518942-Madu-Dapat-Menjadi-Agen-Antibakteri-shutterstock_1250635237.jpg" /></h1>
                </div>
                <div class="item">
                  <h1><img src="<?=$thumbnail;?>" /></h1>
                </div>
                <div class="item">
                  <h1><img src="https://image-cdn.medkomtek.com/cMvsrui5fuo8CzOwvHv7xJqlCao=/640x640/smart/klikdokter-media-buckets/medias/2314836/original/025395800_1589518942-Madu-Dapat-Menjadi-Agen-Antibakteri-shutterstock_1250635237.jpg" /></h1>
                </div>
              </div>
              <div id="sync2" class="navigation-thumbs owl-carousel">
                <div class="item">
                  <h1><img src="<?=$thumbnail;?>" /></h1>
                </div>
                <div class="item">
                   <h1><img src="https://image-cdn.medkomtek.com/cMvsrui5fuo8CzOwvHv7xJqlCao=/640x640/smart/klikdokter-media-buckets/medias/2314836/original/025395800_1589518942-Madu-Dapat-Menjadi-Agen-Antibakteri-shutterstock_1250635237.jpg" /></h1>
                </div>
                <div class="item">
                  <h1><img src="<?=$thumbnail;?>" /></h1>
                </div>
                <div class="item">
                   <h1><img src="https://image-cdn.medkomtek.com/cMvsrui5fuo8CzOwvHv7xJqlCao=/640x640/smart/klikdokter-media-buckets/medias/2314836/original/025395800_1589518942-Madu-Dapat-Menjadi-Agen-Antibakteri-shutterstock_1250635237.jpg" /></h1>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 mb-3">
          <div class="card stl-card shadow-lg">
            <div class="card-body">
              <div class="card-title fs-4 mb-3">
                Deskripsi Produk
              </div>
              <div class="product-dtl"><?=$deskripsi;?>
                <div style="width:100%" class="d-flex flex-row justify-content-center">
                  <div class="p-2">
                    <input type="number" name='kuantiti' id='kuantiti' value="<?=$kuantiti;?>" class="form-control" style="border: 2px solid #eee; height:100%">
                  </div>
                  <div class="p-2">
                    <button style="cursor:pointer; height:100%" class="btn btn-warning" onClick=updateCart(<?=$id_produk;?>)>
                      ADD TO CART
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="<?=base_url()."assets/ui-member/vendors/owl-carousel/";?>owl.carousel.min.js"></script>
  <script>
    var sync1 = $(".slider");
    var sync2 = $(".navigation-thumbs");

    var thumbnailItemClass = '.owl-item';

    var slides = sync1.owlCarousel({
      video: true,
      startPosition: 12,
      items: 1,
      loop: true,
      margin: 10,
      autoplay: true,
      autoplayTimeout: 6000,
      autoplayHoverPause: false,
      nav: false,
      dots: true
    }).on('changed.owl.carousel', syncPosition);

    function syncPosition(el) {
      $owl_slider = $(this).data('owl.carousel');
      var loop = $owl_slider.options.loop;

      if (loop) {
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - (el.item.count / 2) - .5);
        if (current < 0) {
          current = count;
        }
        if (current > count) {
          current = 0;
        }
      } else {
        var current = el.item.index;
      }

      var owl_thumbnail = sync2.data('owl.carousel');
      var itemClass = "." + owl_thumbnail.options.itemClass;


      var thumbnailCurrentItem = sync2
        .find(itemClass)
        .removeClass("synced")
        .eq(current);

      thumbnailCurrentItem.addClass('synced');

      if (!thumbnailCurrentItem.hasClass('active')) {
        var duration = 300;
        sync2.trigger('to.owl.carousel', [current, duration, true]);
      }
    }
    var thumbs = sync2.owlCarousel({
        startPosition: 12,
        items: 4,
        loop: false,
        margin: 10,
        autoplay: false,
        nav: false,
        dots: false,
        onInitialized: function (e) {
          var thumbnailCurrentItem = $(e.target).find(thumbnailItemClass).eq(this._current);
          thumbnailCurrentItem.addClass('synced');
        },
      })
      .on('click', thumbnailItemClass, function (e) {
        e.preventDefault();
        var duration = 300;
        var itemIndex = $(e.target).parents(thumbnailItemClass).index();
        sync1.trigger('to.owl.carousel', [itemIndex, duration, true]);
      }).on("changed.owl.carousel", function (el) {
        var number = el.item.index;
        $owl_slider = sync1.data('owl.carousel');
        $owl_slider.to(number, 100, true);
      });
  </script>
  <script type="text/javascript">
    function updateCart(idProduk) {
      $("#loading").css("display", "flex");
      $.ajax({
        type: 'POST',
        data: {
          idCart: "<?=$id_cart;?>",
          kuantiti: $("#kuantiti").val(),
          idProduk: idProduk
        },
        url: '<?=base_url();?>' + 'shop.member/manage/updateCart',
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

    $(document).ready(function () {
      var slider = $("#slider");
      var thumb = $("#thumb");
      var slidesPerPage = 4; //globaly define number of elements per page
      var syncedSecondary = true;
      slider
        .owlCarousel({
          items: 1,
          slideSpeed: 2000,
          nav: false,
          autoplay: false,
          dots: false,
          loop: true,
          responsiveRefreshRate: 200,
        })
        .on("changed.owl.carousel", syncPosition);
      thumb
        .on("initialized.owl.carousel", function () {
          thumb.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
          items: slidesPerPage,
          dots: false,
          nav: true,
          item: 4,
          smartSpeed: 200,
          slideSpeed: 500,
          slideBy: slidesPerPage,
          navText: [
            '<button type="button" role="presentation" class="owl-prev"><svg width="18px" height="18px" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg></button>',
            '<button type="button" role="presentation" class="owl-next"><svg width="25px" height="25px" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg></button>',
          ],
          responsiveRefreshRate: 100,
        })
        .on("changed.owl.carousel", syncPosition2);

      function syncPosition(el) {
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);
        if (current < 0) {
          current = count;
        }
        if (current > count) {
          current = 0;
        }
        thumb
          .find(".owl-item")
          .removeClass("current")
          .eq(current)
          .addClass("current");
        var onscreen = thumb.find(".owl-item.active").length - 1;
        var start = thumb.find(".owl-item.active").first().index();
        var end = thumb.find(".owl-item.active").last().index();
        if (current > end) {
          thumb.data("owl.carousel").to(current, 100, true);
        }
        if (current < start) {
          thumb.data("owl.carousel").to(current - onscreen, 100, true);
        }
      }

      function syncPosition2(el) {
        if (syncedSecondary) {
          var number = el.item.index;
          slider.data("owl.carousel").to(number, 100, true);
        }
      }
      thumb.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        slider.data("owl.carousel").to(number, 300, true);
      });

      $(".qtyminus").on("click", function () {
        var now = $(".qty").val();
        if ($.isNumeric(now)) {
          if (parseInt(now) - 1 > 0) {
            now--;
          }
          $(".qty").val(now);
        }
      });
      $(".qtyplus").on("click", function () {
        var now = $(".qty").val();
        if ($.isNumeric(now)) {
          $(".qty").val(parseInt(now) + 1);
        }
      });
    });
  </script>