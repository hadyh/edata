<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> E DATA </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <?php
    include "link_css.php";
  ?>

</head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

 <?php
  include "header.php";
 ?>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
   <?php include "sidebar.php"; ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content container-fluid">
         <div class="box container">
            <div class="box-header">
                <h1> KELAS <?php echo $_GET['nama_kelas']; ?> </h1>
            </div>
           <table class='table table-striped'>
                <thead>
                  <tr>
                    <th> No </th>
                    <th> Nis </th>
                    <th> Nama Siswa </th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include "conf/conn.php";  
                  
                  $kode_kelas = $_GET['kode_kelas'];

                  if (isset($_GET['id'])){
                    $id = $_GET['id'];
                    $db->delete("data_siswa","id='$id'");
                  } 

                  $q = $db->select("*","data_siswa","kode_kelas='".$kode_kelas."'");
                  if ($db->getTableRows($q) === 0){
                     echo "tidak ada data";
                  } else {
                      $i = 1;
                      while ($row = $db->fetch($q)){
                      $i++;
                      echo "<tr>
                              <td>".$i."</td>
                              <td>".$row['nis']."</td>
                              <td>".$row['nama_siswa']."</td>
                              <td>
                               <a href='data_siswa.php?kode_kelas=".$kode_kelas."&id=".$row['id']." ' onClick=\"javascript: return confirm('Apakah anda yakin ? ');\" ><button class='btn btn-danger'> delete </button></a> 
                            </td>";


                      }
                    
                 }
                
                  ?>
                </tbody>
            </table>
        </div>     

      </section>
       
       
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php
  include "footer.php";
  ?>
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


<!-- modal  -->
<!-- Modal -->
<div id="data_kelas" class="modal fade" role="dialog">
  <div class="modal-dialog">
     
  
    <!-- Modal content-->
    <div class="modal-content">
    <form action="" method="post">
     
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit</h4>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_kelas" name="id_kelas">

        <label for="Deskripsi"> Nama Kelas</label>
        <input type="text" id="val1" name="nama_kelas" placeholder="nama kelas "  class="form-control" />

        <label for="Deskripsi"> Kode Kelas</label>
        <input type="text" id="val2" name="kode_kelas" placeholder="kode kelas .."  class="form-control" />
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default" name="update-kelas">Update</button>

        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </form>
      
    </div>

  </div>
</div>
<!-- modal n -->
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/live/3.0/firebase.js"></script>
<script>
  
  $(document).on("click", ".edit_kelas", function () {
     var id = $(this).data('id');
     var arr_id = id.split(",")

     $('#val1').val(arr_id[1]);
     $('#val2').val(arr_id[2]);

     $("#id_kelas").val( arr_id[0] );
    $('#data_kelas').modal('show');
});
</script>
</body>
</html>