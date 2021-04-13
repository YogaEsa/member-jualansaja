<?php
$getDataDetail = $dataLandingPage->result_array();
?>
<div class="container mt-4">
	<h4 class="fs-4 fw-bolder mb-1">
		Landing Page
	</h4>
	<div class="row mt-4">
		<div class="col-sm-12">
			<div class="card stl-card">
				<div class="card-body">
					<form>
						<div class="form-row align-items-center align-items-middle">
							<div class="col-sm-10">
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">Url</div>
									</div>
									<input type="text" class="form-control" id="link"
										placeholder="Username" value="<?= $getDataDetail[0]['affiliate_link']."?referalCode=".$dataMember['affiliate'];?>">
								</div>
							</div>
							<div class="col-sm-2">
								<button type="button" id="btn-copy" class="btn btn-primary bg-main btn-block mb-2" onclick="CopyLink()">Copy Url</button>
							</div>
						</div>
					</form>
					<div role="alert" class="alert alert-outline-warning mt-2">
						<b>COPYWRITING</b>
						<br><br>
						<?= $getDataDetail[0]['copy_writing'];?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	function CopyLink() {
		/* Get the text field */
		var copyText = document.getElementById("link");

		/* Select the text field */
		copyText.select();
		copyText.setSelectionRange(0, 99999); /* For mobile devices */

		/* Copy the text inside the text field */
		document.execCommand("copy");

		/* Alert the copied text */
		// alert("Copied the text: " + copyText.value);
	}
</script>
<script type="text/javascript">
	$('#landingPageImages').lightGallery({
		thumbnail: true,
		animateThumb: false,
		showThumbByDefault: false
	});
	$('#video-gallery').lightGallery();

	function saveSettingLandingPage() {
		$("#loading").css("display", "flex");
		$.ajax({
			type: 'POST',
			data: {
				pixelId: $("#pixelId").val(),
				pixelEventOnLoad: $("#pixelEventOnLoad").val(),
				pixelEventOnSubmit: $("#pixelEventOnSubmit").val(),
				idLandingPage: $("#idLandingPage").val(),
			},
			url: '<?php echo base_url();?>' + 'landingpage.member/manage/saveSettingLandingPage',
			success: function (data) {
				$("#loading").css("display", "none");
				if (data.err == '') {
					swal("Success", "Data Tersimpan", "success");
				} else {
					swal(data.err, "", "warning");
				}
			}
		});
	}

	function copyToClipboard() {
		$("#textCopyWritingText").select();
		document.execCommand('copy');
	}
</script>