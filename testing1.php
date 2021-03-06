<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Jadwal
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li class="active">Jadwal</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Custom Tabs (Pulled to the right) -->
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs pull-right">
        <li class="active"><a href="#tab_1-1" data-toggle="tab">Tabel Jadwal</a></li>
        <li><a href="#tab_2-2" data-toggle="tab">Grafik Jadwal</a></li>
        <li class="pull-left header"><i class="fa fa-calendar"></i> Jadwal</li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="tab_1-1">
          <?php
          date_default_timezone_set("Asia/Jakarta");
          $now = date("H:i:s");
          $start = microtime(true);
          set_time_limit(0);
          // get data from database
          if (isset($_POST['genjad'])) {
            // $query = $mysqli->query("SELECT * FROM pengaturan WHERE status=1");
            // $res = $query->fetch_object();
            $bln = $_POST['selbulan'];
            $thn = $_POST['seltahun'];
            $pola = $_POST['selpola'];
            $minshift = $_POST['min'];
            $maxshift = $_POST['max'];
            $bts_shift = 0;

            for ($p=0; $p < 10; $p++) { 
              if ($minshift[$p] > $maxshift[$p]) {
                // echo "batas salah";
                $bts_shift = 1;                
                break;
              }
            }

            include_once 'class_konversi.php';
            $ambln = new Konversi();
            $cekjad = $mysqli->query("SELECT bln, thn FROM jadwal WHERE bln='$bln' AND thn='$thn'");
            $res2 = $cekjad->num_rows;
            if ($res2==1) { ?>
            <script>
            swal({
             title: "Oops, terjadi kesalahan!",
             text: "Jadwal <?= $ambln->cetak_bulan($bln).' '.$thn; ?> sudah ada. Harap hapus terlebih dahulu untuk membuat yang baru.",
             type: "error"
             }, function(){
               window.location.replace("main.php?page=1");
             });
            </script>
            <?php } elseif($bts_shift > 0) {
              echo "<script>
                   swal({
                   title: 'Oops, terjadi kesalahan!',
                   text: 'Batas shift minimal tidak boleh lebih besar dari batas shift maksimal',
                   type: 'error'
                   }, function(){
                     window.location.replace('main.php?page=1');
                   });
                   </script>";
                // $bts_shift = 0;
            } else {
              $thnbln = $thn."-".$bln;
              include_once("class_algen.php");
              $saya = new Algen($bln, $thn, $minshift, $maxshift, $pola);
              // $saya->cek_batas();
              $gen_baru = $saya->gen_array_ind();
              $fit_it = array();
              $y_axis = array();
              $konstan = array();
              $fitness = 0;
              $gnr = 0;
              $sum_kons = 0;

              while ($gnr<=1 && $fitness!=1) {
              // while ($gnr<=3000 && $fitness!=1 && (count($konstan)!=5)) {
              // while ($fitness!=1) {
                $hasil = array();
                if ($gnr==0) {                  
                  $get = $gen_baru;
                } else {
                  $get = $saya->do_algen($gen_baru);
                }

                $hasil = $saya->all_fitness3($get);

                if ($hasil[0]==1) {
                  $fitness = 1;
                  $fit_it[] = $hasil[0];
                  $y_axis[] = $gnr;
                }

                if ($gnr%5==0 and $fitness!=1) {
                  $fit_it[] = $hasil[0];
                  $y_axis[] = $gnr;

                  // if (count($konstan)==0) {
                  //   $konstan[] = end($fit_it);                  
                  // } elseif (end($konstan)==end($fit_it)) {
                  //   $konstan[] = end($fit_it);                  
                  // } else {
                  //   $konstan = array();
                  //   $konstan[] = end($fit_it);                  
                  // }
                }

                $gnr++;
                $gen_baru = $get;
              }
              echo "Nilai Fitness : ".$hasil[0]." || Generasi ke : ".($gnr-1)." || Populasi : ".$saya->jml_ind." || Pc : ".$saya->pc." || Pm : ".$saya->pm."<br/>";
              // echo "<pre>";
              // print_r($hasil);
              // echo "</pre>";
              echo "<form method='post' action='simpanjadwal.php' target='_blank'>";
              echo "<input type='hidden' name='thnbln' value='$thnbln'>";
              $saya->cetak_individu_biasa($gen_baru, 1);
              echo "<button type='submit' class='btn btn-primary' name='savejad'>Ya, simpan!</button>";
              echo "<form><br>";

              $finish = microtime(true) - $start;
              echo 'Waktu eksekusi => '.gmdate("H:i:s", $finish)."<br>";
              echo "Start => $now <br> End => ".date("H:i:s");
              unset($gen_baru);
            }
          }
          ?>
          <audio autoplay>
            <source src="dist/sound/success1.mp3" type="audio/mpeg">
          </audio>
        </div><!-- /.tab-pane -->
        <div class="tab-pane " id="tab_2-2">
          <div class="chart">
            <canvas id="lineChart" style="height:420px"></canvas>
          </div>
        </div>
      </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
