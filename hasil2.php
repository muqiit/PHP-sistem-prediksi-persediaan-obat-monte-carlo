<?php
  include('koneksi.php');
  function mt_random_float($min, $max) 
  {
    $float_part = mt_rand(0, mt_getrandmax())/mt_getrandmax();
    $integer_part = mt_rand($min, $max - 1);
    return $integer_part + $float_part;
  }
  $a=mysqli_query($connect,"SELECT a.kd_pakai, b.kd_obat, b.nama_obat, a.jml_pakai, COUNT(a.jml_pakai) AS frekuensi FROM `tbl_pakai` a, `tbl_obat` b WHERE a.kd_obat=b.kd_obat AND a.kd_obat='".$_GET['view']."' GROUP BY a.jml_pakai ORDER BY a.bulan ASC");
  $b = mysqli_query($connect,"SELECT sum(frekuensi) as total FROM vw_frekuensi WHERE kd_obat='".$_GET['view']."'");
  $e = mysqli_fetch_object($b);
  
  $no=1;
  $fre=0;
  $dari=0;
  $sampai=0;
  $jmlpakai = array();
  $jmlkomulatif =array();
  $jmlrnd = array();
  while($d = mysqli_fetch_object($a))
  {
  $fre+=$d->frekuensi/$e->total;
  $arrfre = explode(".",number_format($fre,2));
  $sampai = $arrfre[1]=='0'?'100':$arrfre[1];
  $dari = explode(".",number_format($fre-$d->frekuensi/$e->total,2));
  $dari = $no==1?0:$dari[1]+1;

  $kode=$d->kd_pakai;
  $kdobat=$d->kd_obat;
  $awal = number_format(($dari/100),2);
  $akhir = number_format(($sampai/100),2);
  $prob_kumulatif = number_format($fre,2);
  //$random = number_format(mt_random_float(0, 1),2);
  array_push($jmlpakai,$d->jml_pakai);
  array_push($jmlkomulatif,$prob_kumulatif);
  //array_push($jmlrnd,$random);
  }
  for($i=0;$i<$e->total;$i++)
                    {
                      
                      $random = number_format(mt_random_float(0, 1),2);
                      array_push($jmlrnd,$random);

                    }
?>
    <section class="content-header">
      <h1>
        Data Obat
        <small>Semoga Lekas Sembuh</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?id=1"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
        <li><a href="index.php?id=2">Obat</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>

              <div class="box-tools">
                    
            <!--<div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div> -->

              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>No</th>
                  <th>Jenis Obat</th>
                  <th>Nama Obat</th>
                  <th>Angka Random</th>     
                  <th>Hasil Prediksi</th>
                </tr>
                  <?php
                    // include('koneksi.php');
                    $a5="SELECT * FROM tbl_hasil a, tbl_obat b WHERE a.kd_obat=b.kd_obat and a.kd_obat='".$_GET['view']."'";
                    $b5=mysqli_query($connect,$a5);
                    $c5=mysqli_fetch_array($b5);
                    //   
                    for($i=0;$i<$e->total;$i++)
                    {
                      $a3="SELECT * FROM tbl_hasil where prob_kumulatif <= $jmlrnd[$i] and kd_obat='".$_GET['view']."' order by prob_kumulatif desc";
                      $b3=mysqli_query($connect,$a3);
                      $data2 = mysqli_fetch_array($b3);
                      $random=$jmlrnd[$i];
                      if(count($data2)>=0){
                        $a4="SELECT * FROM tbl_hasil where prob_kumulatif >= $jmlrnd[$i] and kd_obat='".$_GET['view']."' order by prob_kumulatif asc limit 1";
                        $b4=mysqli_query($connect,$a4);
                        $data4 = mysqli_fetch_array($b4);
                        $hasil=$data4['jml_pakai'];

                        
                        $q = mysqli_query($connect,"SELECT *, COUNT(kd_obat) as jml FROM tbl_hasil_prediksi where kd_obat='".$_GET['view']."'");
                        $run =mysqli_fetch_object($q);
                        if($run->jml<12)
                        {
                          $q2=mysqli_query($connect,"INSERT INTO tbl_hasil_prediksi VALUES ('','".$data4['kd_pakai']."','".$data4['kd_obat']."', $random, $hasil)");
                          
                        }else{
                          $q1=mysqli_query($connect,"UPDATE tbl_hasil_prediksi SET kd_pakai=$kode, kd_obat='".$_GET['view']."', random=$random, hasil=$hasil WHERE kd_hasil_pre=$run->kd_hasil_pre");
                        }
                          // $q2=mysqli_query($connect,"INSERT INTO tbl_hasil_prediksi VALUES ('','".$data4['kd_pakai']."','".$data4['kd_obat']."', $random, $hasil)");
                          //echo "simpan";
                      }else{
                        $hasil=$data2['jml_pakai'];

                        $q = mysqli_query($connect,"SELECT *, COUNT(kd_obat) as jml FROM tbl_hasil_prediksi where kd_obat='".$_GET['view']."'");
                        $run =mysqli_fetch_object($q);
                        if($run->jml<12)
                        {
                          $q2=mysqli_query($connect,"INSERT INTO tbl_hasil_prediksi VALUES ('','".$data4['kd_pakai']."','".$data4['kd_obat']."', $random, $hasil)");
                          
                        }else{
                          $q1=mysqli_query($connect,"UPDATE tbl_hasil_prediksi SET kd_pakai=$kode, kd_obat='".$_GET['view']."', random=$random, hasil=$hasil WHERE kd_hasil_pre=$run->kd_hasil_pre");
                        }
                    
                          // $q2=mysqli_query($connect,"INSERT INTO tbl_hasil_prediksi VALUES ('','".$data4['kd_pakai']."','".$data4['kd_obat']."', $random, $hasil)");
                          //echo "simpan";
                        }
                      
                     
                    ?>
                         <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $c5['jenis_obat']; ?></td>
                            <td><?php echo $c5['nama_obat']; ?></td>
                             <td><?php echo $jmlrnd[$i]; ?></td>
                             <td><?php echo $hasil; ?>
                             </td>
                         </tr>
                  <?php 
                  $no++;
                        // if(isset($_POST['simpan']))
                        // {
                        //   $q = mysqli_query($connect,"SELECT * FROM tbl_hasil_prediksi WHERE kd_pakai=$kode");
                        //   $run =mysqli_fetch_object($q);
                        //   if($run>0)
                        //   {
                        //     $q1=mysqli_query($connect,"UPDATE tbl_hasil_prediksi SET kd_pakai=$kode, kd_obat='".$_GET['view']."', random=$random, hasil=$hasil WHERE kd_hasil_pre=$run->kd_hasil_pre");
                        //     //echo "update";
                        //   }
                        //   else
                        //   {
                        //     $q2=mysqli_query($connect,"INSERT INTO tbl_hasil_prediksi VALUES ('',$kode,'".$_GET['view']."', $random, $hasil)");
                        //     //echo "simpan";
                        //   }
                        // }
                    
                    }
                    
                  ?>
                <tr>
                  <td colspan="3">
                  <form action="" method="POST" enctype="multipart/form-data">
                    <a href="index.php?id=3&view=<?php echo $_GET['view'] ?>" class="btn btn-default">Kembali</a>
                    <!-- <button class="btn btn-primary pull-right" name="simpan">Simpan</button> -->
                  </form>
                  </td>
                </tr>
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>