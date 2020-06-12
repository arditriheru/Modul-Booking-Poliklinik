<?php include "views/header.php"; ?>
<body>
  <nav>
    <div id="wrapper">
    </div><!-- /.navbar-collapse -->
  </nav>
  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <?php include "notifikasi1.php"?>
      </div>
    </div><!-- /.row -->
    <div class="row">
      <div class="col-lg-12">
        <?php
        if(isset($_POST['polisubmit'])){
          echo "<script>
          setTimeout(function() {
            swal({
              title: 'Poli',
              text: 'Mendaftar Poli',
              type: 'success'
              }, function() {
                window.location = 'tes';
                });
                }, 10);
                </script>";
              }
              if(isset($_POST['tumbangsubmit'])){
                echo "<script>
                setTimeout(function() {
                  swal({
                    title: 'Tumbang',
                    text: 'Mendaftar Tumbuh Kembang',
                    type: 'success'
                    }, function() {
                      window.location = 'tes';
                      });
                      }, 10);
                      </script>";
                    }
                    ?>
                    <form method="post" action="" role="form">
                      <button type="submit" name="polisubmit" class="btn btn-success">Poli</button>
                      <button type="submit" name="tumbangsubmit" class="btn btn-success">Tumbang</button>
                    </form>
                    </div><br><br><br><?php include "copyright.php";?>
                    <?php include "views/footer.php"; ?>
