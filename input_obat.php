<?php
  include 'koneksi.php';
  if(isset($_POST['simpan']))
  {
    $cek=mysqli_query($connect,"SELECT * FROM tbl_obat WHERE kd_obat=".$_POST['kd_obat']."");
    $run=mysqli_fetch_object($cek);
    if(count($run)>0)
    {
      $query = 
      " UPDATE tbl_obat set
        jenis_obat            = '{$_POST['jenis_obat']}',
        nama_obat             = '{$_POST['nama_obat']}', 
        stok_obat             = '{$_POST['stok_obat']}',
        ket_stok              = '{$_POST['ket_stok']}',
        satuan_obat           = '{$_POST['satuan_obat']}',
        ket_satuan            = '{$_POST['ket_satuan']}',
        tahun                 = '{$_POST['tahun']}'
        where kd_obat  = '{$_POST['kd_obat']}'
      ";
      $proses=mysqli_query($connect,$query);
       echo "<script>alert('Berhasil Memperbaharui Data !');history.go(-1);</script>";
    }else{
      if (empty($_POST['jenis_obat']) or empty($_POST['nama_obat']) or empty($_POST['stok_obat']) or empty($_POST['satuan_obat']) or empty($_POST['tahun'])) 
      {
        echo "<script>alert('Data Belum Lengkap !');history.go(-1);</script>";
      }
      else
      {
      // Simpan ke Database
      $a="INSERT INTO tbl_obat values ('".$_POST['kd_obat']."','".$_POST['jenis_obat']."','".$_POST['nama_obat']."','".$_POST['stok_obat']."','".$_POST['ket_stok']."','".$_POST['satuan_obat']."','".$_POST['ket_satuan']."','".$_POST['tahun']."')";
      $proses=mysqli_query($connect,$a);
  
      echo "<script>alert('Data Tersimpan !');</script>";
      }
    }
  }

  if (isset($_GET['view'])) 
  {
 
    $a2="SELECT * FROM tbl_obat where kd_obat='".$_GET['view']."'";
    $b2=mysqli_query($connect,$a2);
    $data2=mysqli_fetch_object($b2);
  }



?>
<!-- Main content -->
<section class="content">
      <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border"><h3 class="box-title">Input Obat</h3></div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <div class="box-body">

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Jenis Obat</label>
                    <div class="col-sm-8">
                        <input type="text" name="kd_obat" value="<?php echo $data2->kd_obat; ?>" hidden="true">
                        <input class="form-control" type="text" name="jenis_obat" value="<?php echo $data2->jenis_obat; ?>" placeholder="Jenis Obat">
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Obat</label>
                    <div class="col-sm-8">
                        <input class="form-control" type="text" name="nama_obat" value="<?php echo $data2->nama_obat; ?>" placeholder="Nama Obat">
                    </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Jumlah Obat</label>
                      <div class="col-sm-4">
                          <input class="form-control" type="number" name="stok_obat" value="<?php echo $data2->stok_obat; ?>" placeholder="Jumlah Obat">
                      </div>
                      <label  class="col-sm-1 control-label">Keterangan</label>
                      <div class="col-sm-3">
                        <select class="form-control" name="ket_stok" placeholder="Keterangan">
                          <option value="<?php echo $data2->ket_stok; ?>"><?php
                          if ($data2->ket_stok==1)
                          {
                            echo "Botol";
                          }
                          elseif($data2->ket_stok==2)
                          {
                            echo "Tube";
                          }
                          elseif($data2->ket_stok==3)
                          {
                            echo "Liter";
                          }
                          elseif($data2->ket_stok==4)
                          {
                            echo "Bungkus";
                          }
                          elseif($data2->ket_stok==5)
                          {
                            echo "Dus";
                          }
                          elseif($data2->ket_stok==6)
                          {
                            echo "Pot";
                          }
                          elseif($data2->ket_stok==7)
                          {
                            echo "Drigen";
                          }
                          elseif($data2->ket_stok==8)
                          {
                            echo "Sachet";
                          }
                          elseif($data2->ket_stok==9)
                          {
                            echo "Box";
                          }
                          else{
                            echo "";
                          }
                          ?>
                          </option>
                          <option>----- Pilih Keterangan ------</option>
                          <option value="1">Botol</option>
                          <option value="2">Tube</option>
                          <option value="3">Liter</option>
                          <option value="4">Bungkus</option>
                          <option value="5">Dus</option>
                          <option value="6">Pot</option>
                          <option value="7">Drigen</option>
                          <option value="8">Sachet</option>
                          <option value="9">Box</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Satuan</label>
                      <div class="col-sm-4">
                          <input class="form-control" type="number" name="satuan_obat" value="<?php echo $data2->satuan_obat; ?>" placeholder="Satuan">
                      </div>
                      <label  class="col-sm-1 control-label">Keterangan</label>
                      <div class="col-sm-3">
                        <select class="form-control" name="ket_satuan" placeholder="Keterangan">
                        <option value="<?php echo $data2->ket_satuan; ?>"><?php
                          if($data2->ket_satuan==1)
                          {
                            echo "ml";
                          }
                          elseif($data2->ket_satuan==2)
                          {
                            echo "tube";
                          }
                          elseif($data2->ket_satuan==3)
                          {
                            echo "bungkus";
                          }
                          elseif($data2->ket_satuan==4)
                          {
                            echo "kaplet";
                          }
                          elseif($data2->ket_satuan==5)
                          {
                            echo "pot";
                          }
                          elseif($data2->ket_satuan==6)
                          {
                            echo "gr";
                          }
                          elseif($data2->ket_satuan==7)
                          {
                            echo "botol";
                          }
                          elseif($data2->ket_satuan==8)
                          {
                            echo "bolus";
                          }
                          elseif($data2->ket_satuan==9)
                          {
                            echo "strip";
                          }
                          else{
                            echo "";
                          }
                          ?>
                          </option>
                          <option>----- Pilih Keterangan ------</option>
                          <option value="1">ml</option>
                          <option value="2">tube</option>
                          <option value="3">bungkus</option>
                          <option value="4">kaplet</option>
                          <option value="5">pot</option>
                          <option value="6">gr</option>
                          <option value="7">botol</option>
                          <option value="8">bolus</option>
                          <option value="9">strip</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">Tahun</label>
                    <div class="col-sm-2">
                        <input class="form-control" type="text" name="tahun" value="<?php echo $data2->tahun; ?>" placeholder="Tahun">
                    </div>
                    </div>

                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="index.php?id=5" class="btn btn-default">Batal</a>
                    <button type="submit" name="simpan" class="btn btn-info pull-right">Simpan</button>
                </div>
                <!-- /.box-footer -->
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>

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
                  <th>Satuan</th>
                  <th>Tahun</th>
                  <th></th>
                </tr>
                <?php
                    if (isset($_POST['cari'])) 
                    {
                      $cari = $_POST['cari'];
                      $a=mysqli_query($connect,"SELECT * FROM tbl_obat WHERE tahun like '%".$cari."%' or jenis_obat like '%".$cari."%' or nama_obat like '%".$cari."%'");

                    }else{
                      $a = mysqli_query($connect,"Select * from tbl_obat");
                    }
  
                  $no =1;
                  while($data = mysqli_fetch_object($a))
                  {
                    ?>
                    <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data->jenis_obat; ?></td>
                    <td><?php echo $data->nama_obat; ?></td>
                    <td><?php echo $data->stok_obat; 
                              echo " ";
                              if ($data->ket_stok==1)
                              {
                                echo "Botol";
                              }
                              elseif($data->ket_stok==2)
                              {
                                echo "Tube";
                              }
                              elseif($data->ket_stok==3)
                              {
                                echo "Liter";
                              }
                              elseif($data->ket_stok==4)
                              {
                                echo "Bungkus";
                              }
                              elseif($data->ket_stok==5)
                              {
                                echo "Dus";
                              }
                              elseif($data->ket_stok==6)
                              {
                                echo "Pot";
                              }
                              elseif($data->ket_stok==7)
                              {
                                echo "Drigen";
                              }
                              elseif($data->ket_stok==7)
                              {
                                echo "Sachet";
                              }
                              elseif($data->ket_stok==8)
                              {
                                echo "Box";
                              }
                              else{
                                echo "";
                              }
                        ?>
                    </td>
                    <td><?php echo $data->satuan_obat; 
                              echo " ";
                              if($data->ket_satuan==1)
                              {
                                echo "ml";
                              }
                              elseif($data->ket_satuan==2)
                              {
                                echo "tube";
                              }
                              elseif($data->ket_satuan==3)
                              {
                                echo "bungkus";
                              }
                              elseif($data->ket_satuan==4)
                              {
                                echo "kaplet";
                              }
                              elseif($data->ket_satuan==5)
                              {
                                echo "pot";
                              }
                              elseif($data->ket_satuan==6)
                              {
                                echo "gr";
                              }
                              elseif($data->ket_satuan==7)
                              {
                                echo "botol";
                              }
                              elseif($data->ket_satuan==8)
                              {
                                echo "bolus";
                              }
                              elseif($data->ket_satuan==9)
                              {
                                echo "strip";
                              }
                              else{
                                echo "";
                              }
                        ?>
                    </td>
                    <td><?php echo $data->tahun; ?></td>
                    <td><a href="index.php?id=5&view=<?php echo $data->kd_obat; ?>" class="btn btn-primary">
                    <span class="glyphicon glyphicon-edit"></span> Ubah
                    </a></td>
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