<div class="container mb-5">
  <div class="row">
    <div class="col-lg-12 mt-4 ">
      <div class="card stl-card shadow-lg">
        <div class="card-body">
          <div class="d-flex align-items-center mb-3 border-bottom">
            <h4 class="card-title">TEAM ANDA</h4>
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


  function refreshDaftar(pageKe = 1) {
    $.ajax({
      type: "POST",
      data: $("#formDaftar").serialize() + "&" + $("#formFilter").serialize() + "&pageKe=" + pageKe,
      url: "<?=base_url();?>/team.member/manage/daftar",
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
      url: "<?=base_url();?>/team.member/manage/paging",
      success: function (data) {
        $("#pagingTable").html(data);
        refreshDaftar(pageKe);
      }
    });
  }

  function viewTeam(idMember) {
    loadMainContentMember("/team.member/manage/viewTeam?idMember=" + idMember);
  }

  function refreshFilter() {
    $.ajax({
      type: "POST",
      data: $("#formDaftar").serialize() + "&" + $("#formFilter").serialize(),
      url: "<?=base_url();?>/team.member/manage/filter",
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