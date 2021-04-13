<table class="table table-striped table-bordered table-hover"  id='daftarTable'>
  <thead class="bg-light">
    <tr>
      <th class="text-center align-middle" style="width: 1%;">NO</th>
      <th class="align-middle">TANGGAL/JAM</th>
      <th class="align-middle">NAMA</th>
      <th class="align-middle">NOMOR TELEPON</th>
      <th class="align-middle">EMAIL</th>
      <th class="align-middle">USERNAME</th>
      <th class="align-middle">PROVINSI/KOTA</th>
      <th class="align-middle">STATUS</th>
    </tr>
  </thead>
  <tbody>
      <?php
        for ($iDaftar=0; $iDaftar < sizeof($arrayDaftar) ; $iDaftar++) {
          echo "
          <tr>
            <td style='text-align:center;'>".$arrayDaftar[$iDaftar]['nomor_daftar']."</td>
            <td>".$arrayDaftar[$iDaftar]['waktu']."</td>
            <td>".$arrayDaftar[$iDaftar]['nama']."</td>
            <td><a target='_blank' href='http://api.whatsapp.com/send?phone=".$arrayDaftar[$iDaftar]['nomor_telepon']."&text=Halo ".$arrayDaftar[$iDaftar]['nama']."' >".$arrayDaftar[$iDaftar]['nomor_telepon']."</a></td>
            <td>".$arrayDaftar[$iDaftar]['email']."</td>
            <td>".$arrayDaftar[$iDaftar]['username']."</td>
            <td>".$arrayDaftar[$iDaftar]['provinsi_kota']."</td>
            <td>".$arrayDaftar[$iDaftar]['status']."</td>
          </tr>
          ";
        }
      ?>

  </tbody>
</table>
