<!DOCTYPE html>
<html>
<div id='loading'
  style='position: fixed !important; left: 0 !important; top: 0 !important; right: 0 !important; bottom: 0 !important; background: rgba(0, 0, 0, 0.5); z-index: 999999; display: none!important;'>
  <img src='assets/images/svg/index.svg' class='my-auto mx-auto'>
</div>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Madad - Member Area Member</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/puse-icons-feather/feather.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- cdn -->
  <!-- end cdn -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.0/css/lightgallery.min.css" />
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/font-awesome/css/font-awesome.min.css" />
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/simple-line-icons/css/simple-line-icons.css" />
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/css-stars.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/bars-1to10.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/bars-horizontal.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/bars-movie.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/bars-pill.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/bars-reversed.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/bars-square.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/bootstrap-stars.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/css-stars.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/examples.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/fontawesome-stars-o.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/fontawesome-stars.css">
  <link rel="stylesheet"
    href="<?= base_url();?>assets/ui-member/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link href="<?= base_url();?>assets/ui-member/css/stacktable.css" rel="stylesheet">
  <link href="<?= base_url();?>assets/ui-member/css/mystyle.css" rel="stylesheet">


  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/vendors/jquery-toast-plugin/jquery.toast.min.css">
  <!-- <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="<?= base_url();?>assets/ui-member/css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" sizes="123x46" href="<?= base_url();?>assets/images/logo-madad.jpeg" />

</head>
<style type="text/css">
  .content-wrapper {
    background: #f4f4f8;
    padding: 0px;
    width: 100%;
    -webkit-flex-grow: 1;
    flex-grow: 1;
    border: 1px solid whitesmoke;
  }

  .sidebar .nav .nav-item .nav-link i {
    color: #3F47D2;
  }

  .main-panel {
    background-color: #F4F4F8;
  }
</style>


<body class="sidebar-fixed">
  <input type="hidden" name="content_now_member" id="content_now_member">
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row navbar-primary"
      style="background-color: #3F47D2;">

      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center"
        style="background:#3F47D2">
        <a class="navbar-brand brand-logo" href="javascript:void(0)"
          onclick="loadMainContentMember('/dashboard.member/manage');">
          <img src="<?= base_url();?>assets/images/logo_jualan.png" alt="logo" />
        </a>
        <div class="navbar-brand brand-logo-mini">
          <a href="javascript:void(0)" onclick="loadMainContentMember('/dashboard.member/manage');">
            <img src="<?= base_url();?>assets/images/minilogo.png" alt="logo" width="28px"/>
          </a>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>

      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
              aria-expanded="true">
              <span class="btn btn-<?=$color;?> btn-xs"><?=$level_member;?></i>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="javascript:void(0)"
              data-toggle="dropdown" aria-expanded="true" onclick="loadMainContentMember('/shop.member/manage/cart')">
              <i class="mdi mdi-cart-outline"></i>

              <span class="count bg-danger" id="sumCart" style="border:1.5px solid #3F47D2"><?=$jumlahCart;?></span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle nav-profile" id="profileDropdown" href="#" data-toggle="dropdown"
              aria-expanded="false">
              <img src="<?= base_url();?>assets/ui-member/images/logo/users.gif" alt="image">
              <span class="d-none d-lg-inline"><?= $this->session->userdata('nama'); ?></span>
            </a>
            <div class="dropdown-menu navbar-dropdown w-100" aria-labelledby="profileDropdown">
              <div class="dropdown-divider"></div>

              <a class="dropdown-item" href="javascript:void(0)" onclick="logout();">
                <i class="mdi mdi-logout mr-2 text-primary"></i>
                Signout
              </a>
            </div>
          </li>
        </ul>

      </div>
    </nav>

    <div class="container-fluid page-body-wrapper">
      <?php echo $this->load->view('member/tpl_sidebar_member'); ?>

      <div class="main-panel" id="main-panel">
        <!--  <div class="content-wrapper">
              <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">DashBoard</h4>

                    </div>
                  </div>
                </div>
              </div>
            </div> -->
      </div>
    </div>

  </div>


  <script src="<?= base_url();?>assets/ui-member/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- cdn -->
  <script type="text/javascript" src="assets/ui-member/js/lightgallery-all.min.js"></script>
  <!-- end cdn -->
  <!-- Plugin js for this page-->
  <script src="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
  <script src="<?= base_url();?>assets/ui-member/vendors/chart.js/Chart.min.js"></script>
  <script src="<?= base_url();?>assets/ui-member/vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
  <script src="<?= base_url();?>assets/ui-member/vendors/jquery-sparkline/jquery.sparkline.min.js"></script>
  <script src="<?= base_url();?>assets/ui-member/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="<?= base_url();?>assets/ui-member/vendors/sweetalert/sweetalert.min.js"></script>
  <script src="<?= base_url();?>assets/ui-member/vendors/select2/select2.min.js"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?= base_url();?>assets/ui-member/js/off-canvas.js"></script>
  <script src="<?= base_url();?>assets/ui-member/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
  <script src="<?= base_url();?>assets/ui-member/js/hoverable-collapse.js"></script>
  <script src="<?= base_url();?>assets/ui-member/js/misc.js"></script>
  <script src="<?= base_url();?>assets/ui-member/js/settings.js"></script>
  <script src="<?= base_url();?>assets/ui-member/js/todolist.js"></script>
  <script src="<?= base_url();?>assets/ui-member/js/toast.js"></script>
  <script src="<?= base_url();?>assets/ui-member/js/bootbox.min.js"></script>
  <script src="<?= base_url();?>assets/ui-member/js/bootbox.locales.min.js"></script>
  <!-- <script src="<?= base_url();?>assets/ui-member/js/bootstrap.min.js"></script> -->
  <script src="<?= base_url();?>assets/custom/js/my_scripts.js"></script>
  <script src="<?= base_url();?>assets/ui-member/js/stacktable.js"></script>

  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?= base_url();?>assets/ui-member/js/dashboard.js"></script>


  <script type="text/javascript">
    $(function () {
      loadMainContentMember('/dashboard.member/manage');
    });



    function logout() {
      $.post(base_url(1) + '/member/member/Logout', function (result) {
        window.location.href = base_url(1);
      }, "json");
    }
  </script>
</body>

</html>