<?php
    include 'koneksi.php';
    if (isset($_GET['view'])) 
    {
        $a2=mysqli_query($connect,"SELECT a.kd_pakai, b.kd_obat, b.jenis_obat, b.nama_obat, a.bulan, a.jml_pakai FROM tbl_pakai a, tbl_obat b where a.kd_obat=b.kd_obat and b.kd_obat='".$_GET['view']."' and a.kd_pakai='".$_GET['kd_pakai']."'");
        $data2=mysqli_fetch_object($a2);
        if($data2>0)
        {
            $a2=mysqli_query($connect,"SELECT a.kd_pakai, b.kd_obat, b.jenis_obat, b.nama_obat, a.bulan, a.jml_pakai FROM tbl_pakai a, tbl_obat b where a.kd_obat=b.kd_obat and b.kd_obat='".$_GET['view']."' and a.kd_pakai='".$_GET['kd_pakai']."'");
            $data2=mysqli_fetch_object($a2);
        }else{
            $a2=mysqli_query($connect,"SELECT kd_obat, jenis_obat, nama_obat FROM tbl_obat where kd_obat='".$_GET['view']."'");
            $data2=mysqli_fetch_object($a2);
        }
    }

    if(isset($_POST['simpan']))
    {
        $cek=mysqli_query($connect,"SELECT * FROM tbl_pakai WHERE kd_pakai='".$_GET['kd_pakai']."'");
        $run=mysqli_fetch_object($cek);
        if(count($run)>0)
        {
                $query = 
                " UPDATE tbl_pakai set
                    kd_obat            = '{$_POST['kd_obat']}',
                    bulan             = '{$_POST['bulan']}', 
                    jml_pakai             = '{$_POST['jml_pakai']}'
                    where kd_pakai  = '{$_POST['kd_pakai']}'
                ";
                $proses=mysqli_query($connect,$query);
                echo "<script>alert('Berhasil Memperbaharui Data !');history.go(-1);</script>";
        }
        else
        {
                if (empty($_POST['bulan']) or empty($_POST['jml_pakai'])) 
                {
                    echo "<script>alert('Data Belum Lengkap !');history.go(-1);</script>";
                }
                else
                {
                // Simpan ke Database
                $a="INSERT INTO tbl_pakai values ('".$_POST['kd_pakai']."','".$_POST['kd_obat']."','".$_POST['bulan']."','".$_POST['jml_pakai']."')";
                $proses=mysqli_query($connect,$a);
            
                echo "<script>alert('Data Tersimpan !');</script>";
                }
        }
    }

?>
    <section class="content-header">
      <h1>
        Input Penggunaan
        <small>Penggunaan Obat</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php?id=1"><i class="fa fa-dashboard"></i> Menu Utama</a></li>
        <li><a href="index.php?id=6">Obat</a></li>
        <li><a href="index.php?id=7">Detail Penggunaan</a></li>
        <li><a href="index.php?id=8">Input Penggunaan</a></li>
      </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-info">
                    <div class="box-header with-border"><h3 class="box-title"></h3></div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                    <div class="box-body">

                        <div class="form-group">
                        <label class="col-sm-2 control-label">Jenis Obat</label>
                        <div class="col-sm-8">
                            <input type="text" name="kd_pakai" value="<?php echo $data2->kd_pakai; ?>" hidden="true">
                            <input type="text" name="kd_obat" value="<?php echo $data2->kd_obat; ?>" hidden="true">
                            <input class="form-control" type="text" name="jenis_obat" value="<?php echo $data2->jenis_obat; ?>" placeholder="Jenis Obat" disabled>
                        </div>
                        </div>

                        
                        <div class="form-group">
                        <label class="col-sm-2 control-label">Nama Obat</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" name="nama_obat" value="<?php echo $data2->nama_obat; ?>" placeholder="Nama Obat" disabled>
                        </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Bulan</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="bulan" placeholder="Keterangan">
                                    <option value="<?php echo $data2->bulan; ?>"><?php
                                    if ($data2->bulan==1)
                                    {
                                        echo "Januari";
                                    }
                                    elseif($data2->bulan==2)
                                    {
                                        echo "Februari";
                                    }
                                    elseif($data2->bulan==3)
                                    {
                                        echo "Maret";
                                    }
                                    elseif($data2->bulan==4)
                                    {
                                        echo "April";
                                    }
                                    elseif($data2->bulan==5)
                                    {
                                        echo "Mei";
                                    }
                                    elseif($data2->bulan==6)
                                    {
                                        echo "Juni";
                                    }
                                    elseif($data2->bulan==7)
                                    {
                                        echo "Juli";
                                    }
                                    elseif($data2->bulan==8)
                                    {
                                        echo "Agustus";
                                    }
                                    elseif($data2->bulan==9)
                                    {
                                        echo "September";
                                    }
                                    elseif($data2->bulan==10)
                                    {
                                        echo "Oktober";
                                    }
                                    elseif($data2->bulan==11)
                                    {
                                        echo "November";
                                    }
                                    elseif($data2->bulan==12)
                                    {
                                        echo "Desember";
                                    }
                                    else{
                                        echo "";
                                    }
                                    ?>
                                    </option>
                                    <option>----- Pilih Bulan ------</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jumlah Pakai</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="number" name="jml_pakai" value="<?php echo $data2->jml_pakai; ?>" placeholder="Jumlah Pakai">
                            </div>
                        </div>
                        

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="index.php?id=7&view=<?php echo $data2->kd_obat; ?>" class="btn btn-default">Batal</a>
                        <button type="submit" name="simpan" class="btn btn-info pull-right">Simpan</button>
                    </div>
                    <!-- /.box-footer -->
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>