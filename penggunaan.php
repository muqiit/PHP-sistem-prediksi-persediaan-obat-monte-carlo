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
                    <input type="text" name="cari" class="form-control pull-right" placeholder="Cari">

                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
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
                  <th>Jumlah</th>
                  <th>Tahun</th>
                  <th></th>
                </tr>
                <?php
                    if (isset($_POST['cari'])) 
                    {
                      $cari = $_POST['cari'];
                      $a=mysqli_query($connect,"SELECT * FROM vw_jml_obat WHERE tahun like '%".$cari."%' or jenis_obat like '%".$cari."%' or nama_obat like '%".$cari."%'");

                    }else{
                      $a = mysqli_query($connect,"Select * from vw_jml_obat");
                    }
  
                  $no =1;
                  while($data = mysqli_fetch_object($a))
                  {
                    ?>
                    <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data->jenis_obat; ?></td>
                    <td><?php echo $data->nama_obat; ?></td>
                    <td><?php echo $data->jumlah_obat; ?></td>
                    <td><?php echo $data->tahun; ?></td>
                    <td><a href="index.php?id=10&view=<?php echo $data->kd_obat; ?>" class="btn btn-primary">
                    <span class="glyphicon glyphicon-edit"></span> Detail</a></td>
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