<?php 
    include 'koneksi.php';
?>
    <section class="content-header">
      <h1>
        Penggunaan Obat
        <small>Jaga Kesehatan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?id=1"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
        <li><a href="index.php?id=9">Penggunaan Obat</a></li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Obat</h3>
              
              <div class="box-tools">
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                    <!--  <input type="text" name="cari" class="form-control pull-right" placeholder="Cari"> 
                        -->
                    <div class="input-group-btn">
                        <a href="index.php?id=9" class="btn btn-default">Kembali</a>
                    <!--  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button> -->
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="card-body table-responsive p-0" style="height: 450px;">
              <table class="table table-head-fixed text-nowrap">
                <tr>
                  <th>No</th>
                  <th>Jenis Obat</th>
                  <th>Nama Obat</th>
                  <th>Bulan</th>
                  <th>Jumlah</th>
                </tr>
                <?php
                    
                    $a = mysqli_query($connect,"Select * from tbl_pakai a, tbl_obat b where a.kd_obat=b.kd_obat and a.kd_obat='".$_GET['view']."'");
                  $no =1;
                  while($data = mysqli_fetch_object($a))
                  {
                    ?>
                    <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data->jenis_obat; ?></td>
                    <td><?php echo $data->nama_obat; ?></td>
                    <td><?php 
                    if($data->bulan==1)
                    {
                        echo "Januari";
                    }
                    elseif($data->bulan==2)
                    {
                        echo "Februari";
                    }
                    elseif($data->bulan==3)
                    {
                        echo "Maret";
                    }
                    elseif($data->bulan==4)
                    {
                        echo "April";
                    }
                    elseif($data->bulan==5)
                    {
                        echo "Mei";
                    }
                    elseif($data->bulan==6)
                    {
                        echo "Juni";
                    }
                    elseif($data->bulan==7)
                    {
                        echo "Juli";
                    }
                    elseif($data->bulan==8)
                    {
                        echo "Agustus";
                    }
                    elseif($data->bulan==9)
                    {
                        echo "September";
                    }
                    elseif($data->bulan==10)
                    {
                        echo "Oktober";
                    }
                    elseif($data->bulan==11)
                    {
                        echo "November";
                    }
                    elseif($data->bulan==12)
                    {
                        echo "Desember";
                    }
                     ?></td>
                    <td><?php echo $data->jml_pakai; ?></td>
                    </tr>
                <?php
                    $no++;
                  }
                ?>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>