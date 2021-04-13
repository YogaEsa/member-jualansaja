<div class="container mb-5">
  <div class="row">
    <div class="col-lg-12 mt-4 ">
      <div class="card stl-card shadow-lg">
        <div class="card-body">
          <div class="d-flex align-items-center mb-3 border-bottom">
            <h4 class="card-title">LEADS ANDA</h4>
            <p class="text-muted ml-auto">
              <input type="button" value="TAMBAH" class="btn btn-primary btn-sm"
                onClick='loadMainContentMember("/leads.member/manage/add");'></p>
          </div>
          <form id='formFilter' name='formFilter'>
            <div class="col-md-12">
              <div class="row" id='filterContent'>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-12 mt-4 ">
      <div id="daftarTable"></div>
      <div id='pagingTable'>
        <?=$paging;?>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function () {

    refreshFilter();
    // refreshDaftar();
    goToPage(1);

  });

  function viewDetail() {
    loadMainContentMember("/leads.member/manage/viewDetail");
  }


  function refreshDaftar(pageKe = 1) {
    $.ajax({
      type: "POST",
      data: $("#formDaftar").serialize() + "&" + $("#formFilter").serialize() + "&pageKe=" + pageKe,
      url: "<?=base_url();?>/leads.member/manage/daftar",
      success: function (data) {
        // var resp = eval("(" + data + ")");
        $("#daftarTable").html(data);
        $('#daftarTable').cardtable();
      }
    });
  }

  function goToPage(pageKe = 1) {
    $.ajax({
      type: "POST",
      data: $("#formDaftar").serialize() + "&" + $("#formFilter").serialize() + "&pageKe=" + pageKe,
      url: "<?=base_url();?>/leads.member/manage/paging",
      success: function (data) {
        $("#pagingTable").html(data);
        refreshDaftar(pageKe);
      }
    });
  }

  function refreshFilter() {
    $.ajax({
      type: "POST",
      data: $("#formDaftar").serialize() + "&" + $("#formFilter").serialize(),
      url: "<?=base_url();?>/leads.member/manage/filter",
      success: function (data) {
        $("#filterContent").html(data);
        var mem = $('#data_1 .date').datepicker({
          todayBtn: "linked",
          format: 'dd-mm-yyyy',
          keyboardNavigation: false,
          forceParse: false,
          calendarWeeks: true,
          autoclose: true
        });
      }
    });
  }
</script>