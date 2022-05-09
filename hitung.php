
<section class="content-header">
      <h1>
        Data Obat
        <small>Semoga Lekas Sembuh</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?id=1"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
        <li><a href="index.php?id=2">Prediksi Obat</a></li>
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
                  <th>Nama Obat</th>
                  <th>Jumlah Pakai</th>
                  <th>Frekuensi</th>
                  <th>Distribusi Probabilitas</th>
                  <th>Probabilitas Kumulatif</th>
                  <th>Interval Angka</th>
                </tr>

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
                          $obat = $_GET['view'];
                          $awal = number_format(($dari/100),2);
                          $akhir = number_format(($sampai/100),2);
                          $prob_kumulatif = number_format($fre,2);
                          $random = number_format(mt_random_float(0, 1),2);
                          $kode=$d->kd_pakai;
                          array_push($jmlpakai,$d->jml_pakai);
                          array_push($jmlkomulatif,$prob_kumulatif);
                          array_push($jmlrnd,$random);

                        
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $d->nama_obat; ?></td>
                  <td><?php echo $d->jml_pakai; ?></td>
                  <td><?php echo number_format($d->frekuensi,2); ?></td>
                  <td><?php echo number_format($d->frekuensi/$e->total,2); ?></td>
                  <td><?php echo $prob_kumulatif; ?></td>
                  <td><?php echo $awal." sampai ".$akhir ?></td>
                </tr>
                <?php
                        // $user = [ 'kd_pakai' => $d->kd_pakai,  'kd_obat' => $d->kd_obat, 'jml_pakai' => $d->jml_pakai, 'prob_kumulatif' => $prob_kumulatif ];
                        // foreach ($user as $key => $value)
                        //   {
                        //     echo '<tr>
                        //             <td>'. $key .'</td>
                        //             <td>'. $value .'</td>
                        //           </tr>';
                        //   }
                          $cek=mysqli_query($connect,"SELECT * FROM tbl_hasil WHERE kd_pakai=$d->kd_pakai");
                          $run=mysqli_fetch_object($cek);
                          if(count($run)>0)
                          {
                            $up="UPDATE tbl_hasil SET kd_pakai=$d->kd_pakai, kd_obat=$obat, jml_pakai=$d->jml_pakai, prob_kumulatif=$prob_kumulatif WHERE kd_hasil=$run->kd_hasil";
                            $proses=mysqli_query($connect, $up);
                            //echo $up;
                          }else{
                            $in="INSERT INTO tbl_hasil values ('',$d->kd_pakai, $obat, $d->jml_pakai, $prob_kumulatif)";
                            $proses=mysqli_query($connect,$in);
                            // echo $in; 
                          }
                      
                    }
                ?>
                <tr>
                  <td><a href="index.php?id=2" class="btn btn-default">Kembali</a></td>
                  <td colspan="2" align="right">Jumlah :</td>
                  <td><?php echo number_format($e->total,2); ?></td>
                  <?php 
                    $w = mysqli_query($connect,"SELECT * from tbl_pakai WHERE kd_obat='".$_GET['view']."'");
                    $j = mysqli_fetch_object($w);
                    if($j>0)
                    {
                      ?>
                      <td colspan="2"><a href="index.php?id=4&view=<?php echo $_GET['view'] ?>" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-upload"></span> Hasil</a></td>
                    <?php
                    }else{

                    }
                   ?>
                  
                    
                  	
                </tr>
              </table>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
<!--
              <table class="table">

                    <tr>
                      <td>random</td>     
                      <td>hasil</td>
                    </tr>
                    <?php
                    // for($i=0;$i<count($jmlrnd);$i++){
                    //   $a3="SELECT * FROM tbl_hasil where prob_kumulatif <= $jmlrnd[$i] and kd_obat='".$_GET['view']."' order by prob_kumulatif desc";
                    //   $b3=mysqli_query($connect,$a3);
                    //   $data2 = mysqli_fetch_array($b3);
                    //   if(count($data2)>=0){
                    //     $a4="SELECT * FROM tbl_hasil where prob_kumulatif >= $jmlrnd[$i] and kd_obat='".$_GET['view']."' order by prob_kumulatif asc limit 1";
                    //     $b4=mysqli_query($connect,$a4);
                    //     $data4 = mysqli_fetch_array($b4);
                    //     $hasil=$data4['jml_pakai'];
                    //   }else{
                    //     $hasil=$data2['jml_pakai'];
                    //   }
                    ?>
                         <tr>
                             <td><?php // echo $jmlrnd[$i]; ?></td>
                             <td><?php // echo $hasil; ?>
                             </td>
                         </tr>
                    <?php 
                   // }   
                    ?>

              </table> -->
        </div>
      </div>
      <!-- /.row (main row) -->

    </section>