<div class="content-wrapper"  >
  <h3 style="margin-left:20px;margin-top:20px;margin-bottom:20px;"> LEADS ANDA</h3>

  <div class="col-md-12" style="text-align:right;">


    <input type="button" value="TAMBAH" class="btn btn-primary btn-sm" onClick=loadMainContentMember("/leads.leads.member/manage/add");>

  </div>
  <form id='formFilter' name='formFilter'>
    <div class="col-md-12" style="margin-left:20px;margin-top:20px;margin-bottom:20px;">
        <div class="row" id='filterContent'>
        </div>
    </div>
  </form>

  <div class="card">
    <div class="row show-grid">
      <div class="col-md-12" style="margin-left:20px;margin-top:20px;margin-bottom:20px;">

        <table class="table table-striped table-bordered table-hover" id='daftarTable'>
        </table>
        <div id='pagingTable'>
          <?=$paging;?>
        </div>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

  refreshFilter();
  // refreshDaftar();
  goToPage(1);

});


  function refreshDaftar(pageKe = 1){
    $.ajax({
      type: "POST",
      data: $("#formDaftar").serialize()+"&"+$("#formFilter").serialize()+"&pageKe="+pageKe,
      url: "<?=base_url();?>/leads.member/manage/daftar",
      success: function(data) {
        // var resp = eval("(" + data + ")");
        $("#daftarTable").html(data);
        $('#daftarTable').cardtable();
      }
    });
  }
  function goToPage(pageKe = 1){
    $.ajax({
      type: "POST",
      data: $("#formDaftar").serialize()+"&"+$("#formFilter").serialize()+"&pageKe="+pageKe,
      url: "<?=base_url();?>/leads.member/manage/paging",
      success: function(data) {
        $("#pagingTable").html(data);
        refreshDaftar(pageKe);
      }
    });
  }
  function refreshFilter(){
    $.ajax({
      type: "POST",
      data: $("#formDaftar").serialize()+"&"+$("#formFilter").serialize(),
      url: "<?=base_url();?>/leads.member/manage/filter",
      success: function(data) {
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
