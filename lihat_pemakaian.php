<?php 
    include 'koneksi.php';
    if (isset($_GET['view'])) 
    {
   
      $a2="SELECT * FROM tbl_pakai where kd_obat='".$_GET['view']."'";
      $b2=mysqli_query($connect,$a2);
      $data2=mysqli_fetch_object($b2);
    }
  
?>    
    <section class="content-header">
      <h1>
        Detail Penggunaan
        <small>Jaga Kesehatan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?id=1"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
        <li><a href="index.php?id=6">Obat</a></li>
        <li><a href="index.php?id=7">Detail Penggunaan</a></li>
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
                            <div class="input-group input-group-sm hidden-xs" style="width: 80px;">
                                <div class="input-group-btn">
                                    <a href="index.php?id=7&view=<?php echo $_GET['view']; ?>" class="btn btn-default">Refresh</a>
                                    <a href="index.php?id=8&view=<?php echo $_GET['view']; ?>" class="btn btn-primary">Input Penggunaan</a>
                                </div>
                            </div>
                        </form>
                    
                
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>No</th>
                  <th>Jenis Obat</th>
                  <th>Nama Obat</th>
                  <th>Bulan</th>
                  <th>Jumlah Pakai</th>
                  <th></th>
                </tr>
                <?php
                    
                      $a = mysqli_query($connect,"SELECT a.kd_pakai, b.kd_obat, b.jenis_obat, b.nama_obat, a.bulan, a.jml_pakai from tbl_pakai a, tbl_obat b WHERE a.kd_obat=b.kd_obat and a.kd_obat='".$_GET['view']."' ORDER BY a.bulan ASC");
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
                    <td><a href="index.php?id=8&view=<?php echo $data->kd_obat; ?>&kd_pakai=<?php echo $data->kd_pakai; ?>" class="btn btn-primary">
                    <span class="glyphicon glyphicon-edit"></span> Ubah</a></td>
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