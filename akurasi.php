<?php 
    include 'koneksi.php';
?>
    <section class="content-header">
      <h1>
        Akurasi Hasil Prediksi
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?id=1"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
        <li><a href="index.php?id=13">Akurasi</a></li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Confusion Matrix</h3>
                        <div class="box-tools">
                            <!-- <form action="" method="POST" enctype="multipart/form-data">
                                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                                     <input type="text" name="cari" class="form-control pull-right" placeholder="Tahun"> 
                                    
                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button> 
                                    </div>
                                </div>
                            </form> -->
                        </div>
                    </div>
                    <div class="body table-responsive">
                            <table class="table table-striped">
                               <tr align="center">
                                    <td rowspan="2"><h4>Data Asli</h4></td>
                                    <td colspan="3"><h5>Hasil Prediksi</h5></td>
                                   
                               </tr>
                               <tr align="center">
                                    <td>Kurang</td>
                                    <td>Lebih</td>
                                    <td>Sama</td>
                               </tr>
                               <tr align="center">
                                    <td>Kurang</td>
                                    <?php
                                       

                                        function akurasi($a1,$a2,$a3,$a4,$a5,$a6,$a7,$a8,$a9)
                                        {
                                            $p1 = $a1 + $a2 + $a3;
                                            $p2 = $a1 + $a2 + $a3 + $a4 + $a5 +  $a6 + $a7 + $a8 + $a9;
                                            $p3 = $p1 / $p2;
                                            $p4 = $p3 * 100;

                                            $hasil = $p4;
                                            return round($hasil,2);
                                        }

                                        $krg = mysqli_query($connect,"SELECT COUNT(jumlah_hasil) as kurang FROM `vw_conf_mat` where total_pakai<jumlah_obat and jumlah_hasil<total_pakai");
                                        $row = mysqli_fetch_array($krg);
                                        $krg = $row['kurang']; // Use something like this to get the result
                                        echo "<td>".$krg."</td>"; 

                                        $krglhb = mysqli_query($connect,"SELECT COUNT(jumlah_hasil) as krg_lbh FROM `vw_conf_mat` where total_pakai<jumlah_obat and jumlah_hasil>total_pakai");
                                        $row = mysqli_fetch_array($krglhb);
                                        $krglhb = $row['krg_lbh']; // Use something like this to get the result
                                        echo "<td>".$krglhb."</td>"; 

                                        $krgsm = mysqli_query($connect,"SELECT COUNT(jumlah_hasil) as krg_sm FROM `vw_conf_mat` where total_pakai<jumlah_obat and jumlah_hasil=total_pakai");
                                        $row = mysqli_fetch_array($krgsm);
                                        $krgsm = $row['krg_sm']; // Use something like this to get the result
                                        echo "<td>".$krgsm."</td>"; 
                                    ?>
                               </tr>
                               <tr align="center">
                                    <td>Lebih</td>
                                    <?php
                                        $lbhkrg = mysqli_query($connect,"SELECT COUNT(jumlah_hasil) as lbh_krg FROM `vw_conf_mat` where total_pakai>jumlah_obat and jumlah_hasil<total_pakai");
                                        $row = mysqli_fetch_array($lbhkrg);
                                        $lbhkrg = $row['lbh_krg']; // Use something like this to get the result
                                        echo "<td>".$lbhkrg."</td>"; 

                                        $lbhlbh = mysqli_query($connect,"SELECT COUNT(jumlah_hasil) as lbh_lbh FROM `vw_conf_mat` where total_pakai>jumlah_obat and jumlah_hasil>total_pakai");
                                        $row = mysqli_fetch_array($lbhlbh);
                                        $lbhlbh = $row['lbh_lbh']; // Use something like this to get the result
                                        echo "<td>".$lbhlbh."</td>"; 

                                        $lbhsm = mysqli_query($connect,"SELECT COUNT(jumlah_hasil) as lbh_sm FROM `vw_conf_mat` where total_pakai>jumlah_obat and jumlah_hasil=total_pakai");
                                        $row = mysqli_fetch_array($lbhsm);
                                        $lbhsm = $row['lbh_sm']; // Use something like this to get the result
                                        echo "<td>".$lbhsm."</td>"; 
                                    ?>
                               </tr>
                               <tr align="center">
                                    <td>Sama</td>
                                    <?php
                                        $smkrg = mysqli_query($connect,"SELECT COUNT(jumlah_hasil) as sm_krg FROM `vw_conf_mat` where total_pakai=jumlah_obat and jumlah_hasil<total_pakai");
                                        $row = mysqli_fetch_array($smkrg);
                                        $smkrg = $row['sm_krg']; // Use something like this to get the result
                                        echo "<td>".$smkrg."</td>"; 

                                        $smsm = mysqli_query($connect,"SELECT COUNT(jumlah_hasil) as sm_sm FROM `vw_conf_mat` where total_pakai=jumlah_obat and jumlah_hasil=total_pakai");
                                        $row = mysqli_fetch_array($smsm);
                                        $smsm = $row['sm_sm']; // Use something like this to get the result
                                        echo "<td>".$smsm."</td>"; 

                                        $smlbh = mysqli_query($connect,"SELECT COUNT(jumlah_hasil) as sm_lbh FROM `vw_conf_mat` where total_pakai=jumlah_obat and jumlah_hasil>total_pakai");
                                        $row = mysqli_fetch_array($smlbh);
                                        $smlbh = $row['sm_lbh']; // Use something like this to get the result
                                        echo "<td>".$smlbh."</td>"; 
                                    ?>
                               </tr>
                            </table>
                            <br>

                            <?php
                                echo "<h4>Akurasi =".akurasi($krg,$lbhlbh,$smsm,$krglhb,$krgsm,$lbhkrg,$lbhsm,$smkrg,$smlbh)." % </h4>";
                            ?> 
                        </div>
                    

            </div>
        </div>
    </section>