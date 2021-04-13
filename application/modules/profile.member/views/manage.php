<div class="container mb-5">
	<div class="row mt-4">
		<div class="col-md-4  mt-4">
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Profile</h4>
					<div class="text-center">
						<img alt="" src="https://www.bootstrapdash.com/demo/pearl-admin/jquery/images/faces/face6.jpg"
							style="border-radius:100%">
						<p class="name mt-2"><?=$dataJSON['nama'];?></p>
						<p class="designation">
						</p>
						<div class="badge badge-outline-success"><?=$level_member;?></div>
						<p></p>
						
						<div class="d-block text-center text-dark mb-1"><?=$dataJSON['email'];?></div>
						<div class="d-block text-center text-dark"><?=$dataJSON['nomor_telepon'];?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-8  stretch-card mt-4">
			<div class="card">
				<div class="card-body">
					<div class="wrapper d-block d-sm-flex align-items-center justify-content-between">
						<h4 class="card-title mb-0">Detail</h4>
						<ul class="nav nav-tabs tab-solid tab-solid-primary mb-0" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active show" id="info-tab" data-toggle="tab" href="#info" role="tab"
									aria-controls="info" aria-expanded="true" aria-selected="true">Info</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab"
									aria-controls="security" aria-selected="false">Access</a>
							</li>
						</ul>
					</div>
					<div class="wrapper">
						<hr>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade active show" id="info" role="tabpanel" aria-labelledby="info">
								<form id='formProfile'>
									<div class="form-group">
										<label for="nama">Nama</label>
										<input type="text" class="form-control" id="nama" name='nama' placeholder="Nama"
									value='<?=$dataJSON['nama'];?>' style="border-color: #ced4da;">
									</div>
									<div class="form-group">
										<label for="email">Email</label>
											<input type="text" class="form-control" id="email" name='email' placeholder="Email"
									value='<?=$dataJSON['email'];?>' readonly style="border-color: #ced4da;">
									</div>
									<div class="form-group">
										<label for="nomorTelepon">Nomer Telepon</label>
										<input type="text" class="form-control" id="nomorTelepon" name='nomorTelepon'
									value='<?=$dataJSON['nomor_telepon'];?>' placeholder="NOMOR TELEPON"
									style="border-color: #ced4da;">
									</div>
									<div class="form-group">
										<label for="upline">Upline Anda</label>
										<input type="text" class="form-control" id="upline" value='<?=$usernameUpline;?>' readonly
									style="border-color: #ced4da;">
									</div>
									<div class="form-group">
										<label for="affiliateCode">Affiliate Code</label>
										<input type="text" class="form-control" id="affiliateCode" name="affiliateCode"
									value='<?=$affiliate;?>' readonly style="border-color: #ced4da;">
									</div>
									<div class="form-group">
										<label for="levelmember">Level Member</label>
										<input type="text" id="levelmember" class="form-control" value='<?=$level_member;?>' readonly
									style="border-color: #ced4da;">
									</div>
									<div class="form-group">
										<label>Provinsi</label>
										<?=$comboProvinsi;?>
									</div>
									<div class="form-group">
										<label>Kota</label>
										<?=$comboKota;?>
									</div>
									<div class="form-group">
										<label for="alamat">Affiliate Code</label>
										<textarea class="form-control" id='alamat' row="3" name='alamat'><?=$alamat;?></textarea>
									</div>
									<div class="form-group">
										<label for="namaBank">Nama Bank</label>
										<input type="text" class="form-control" id="namaBank" name='namaBank'
									value='<?=$bank;?>' style="border-color: #ced4da;">
									</div>
									<div class="form-group">
										<label for="nomorRekening">Nomer Rekening</label>
										<input type="text" class="form-control" id="nomorRekening" name='nomorRekening'
									value='<?=$dataJSON['nomor_rekening'];?>' style="border-color: #ced4da;">
									</div>
									<div class="form-group">
										<label for="namaRekening">Nama Rekening</label>
										<input type="text" class="form-control" id="namaRekening" name='namaRekening'
									value='<?=$nama_pemilik_rekening;?>' style="border-color: #ced4da;">
									</div>
									<div class="form-group mt-5">
										<button type="submit" class="btn btn-success mr-2" onClick=saveProfile();>Simpan</button>
										<button type="reset" class="btn btn-outline-danger">Cancel</button>
									</div>
								</form>
							</div><!-- tab content ends -->
							<div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
								<form id='formAccess'>
									<div class="form-group">
										<label for="email">Email</label>
										<input type="text" class="form-control" id="email" name='email'
									value='<?=$dataJSON['email'];?>' placeholder="Email" readonly
									style="border-color: #ced4da;">
									</div>
									<div class="form-group">
										<label for="old_pass">Password Lama</label>
										<input type="password" class="form-control" id="old_pass" name='old_pass'
									placeholder="Password" style="border-color: #ced4da;">
									</div>
									<div class="form-group">
										<label for="new_pass">Password Baru</label>
											<input type="password" class="form-control" id="new_pass" name='new_pass'
									placeholder="Password" style="border-color: #ced4da;">
									</div>
									<div class="form-group">
										<label for="kon_pass">Ketik Ulang Password Baru</label>
										<input type="password" class="form-control" id="kon_pass" name='kon_pass'
									placeholder="Re-Type Password" style="border-color: #ced4da;">
									</div>
									<div class="form-group mt-5">
										<button type='button' class='btn btn-success'
									onClick=saveAccess();>SIMPAN</button>
										<button type="reset" class="btn btn-outline-danger">Batal</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function saveProfile() {
		$("#loading").css("display", "flex");
		$.ajax({
			type: 'POST',
			data: $("#formProfile").serialize(),
			url: '<?php echo base_url();?>' + 'profile.member/manage/saveProfile',
			success: function (data) {
				$("#loading").css("display", "none");
				if (data.err == '') {
					swal("Success", "Data Tersimpan", "success");
					loadMainContentMember('/dashboard.member/manage');
				} else {
					swal(data.err, "", "warning");
				}
			}
		});
	}

	function saveAccess() {
		$("#loading").css("display", "flex");
		$.ajax({
			type: 'POST',
			data: $("#formAccess").serialize(),
			url: '<?php echo base_url();?>' + 'profile.member/manage/saveAccess',
			success: function (data) {
				$("#loading").css("display", "none");
				if (data.err == '') {
					swal("Success", "Data Tersimpan", "success");
					loadMainContentMember('/dashboard.member/manage');
				} else {
					swal(data.err, "", "warning");
				}
			}
		});
	}

	function provinsiChanged() {
		$.ajax({
			type: 'POST',
			data: {
				idProvinsi: $("#idProvinsi").val()
			},
			url: "<?=base_url();?>profile.member/manage/provinsiChanged",
			success: function (data) {
				var resp = eval('(' + data + ')');
				if (resp.err == '') {
					$("#idKota").html(resp.content.idKota);
				} else {}
			}
		});
	}
</script>