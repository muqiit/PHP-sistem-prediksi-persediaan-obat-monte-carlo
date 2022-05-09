<?php 
    include 'koneksi.php';
?>
    <section class="content-header">
      <h1>
        Mean Absolute Percentage Error (MAPE)
        <!-- <small>Jaga Kesehatan</small> -->
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
                        <h3 class="box-title">Hasil Akurasi</h3>
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
                    <div class="card-body table-responsive p-0" style="height: 450px;">
                        <table class="table table-head-fixed text-nowrap">
                            <tr>
                            <th>No</th>
                            <th>Jenis Obat</th>
                            <th>Nama Obat</th>
                            <th>Jumlah Stok</th>
                            <th>Hasil Prediksi</th>
                            <th>Tahun</th>
                            <th></th>
                            </tr>
                            <?php
                              $a=mysqli_query($connect,"SELECT a.kd_hasil_pre, b.kd_pakai, b.kd_obat, d.jenis_obat, d.nama_obat, c.jumlah_obat, sum(a.hasil) as jumlah_hasil , d.tahun FROM tbl_hasil_prediksi a, tbl_pakai b, vw_jml_obat c, tbl_obat d WHERE a.kd_pakai=b.kd_pakai and a.kd_obat=c.kd_obat and a.kd_obat=d.kd_obat and d.tahun=2019 GROUP BY a.kd_obat");
        
                            
                            $no =1;
                            while($data = mysqli_fetch_object($a))
                            {
                                ?>
                                <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data->jenis_obat; ?></td>
                                <td><?php echo $data->nama_obat; ?></td>
                                <td><?php echo $data->jumlah_obat; ?></td>
                                <td><?php echo $data->jumlah_hasil; ?></td>
                                <td><?php echo $data->tahun; ?></td>
                                <td><a href="index.php?id=12&view=<?php echo $data->kd_obat; ?>" class="btn btn-primary"><span class="glyphicon glyphicon-upload"></span>Detail</a></td>
                                </tr>
                            <?php
                                $no++;
                            }
                            ?>
                            
                        </table>
                        </div>
                    

            </div>
        </div>
    </section>