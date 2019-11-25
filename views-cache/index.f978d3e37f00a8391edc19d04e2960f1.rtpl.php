<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Painel de Controle
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <!-- Your Page Content Here -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-link"></i></span>

          <div class="info-box-content">
            <span class="info-box-text">Categorias</span>
            <span class="info-box-number"><?php echo htmlspecialchars( $category["COUNT(*)"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
          </div>
          <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-folder-open"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Fornecedores</span>
              <span class="info-box-number"><?php echo htmlspecialchars( $providers["COUNT(*)"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-blue"><i class="fa fa-gamepad"></i></span>
  
              <div class="info-box-content">
                <span class="info-box-text">Produtos</span>
                <span class="info-box-number"><?php echo htmlspecialchars( $products["COUNT(*)"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-external-link-square"></i></span>
    
                <div class="info-box-content">
                  <span class="info-box-text">Pedidos</span>
                  <span class="info-box-number"><?php echo htmlspecialchars( $orders["COUNT(*)"], ENT_COMPAT, 'UTF-8', FALSE ); ?></span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
