<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Fornecedores
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Editar Fornecedor</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/providers/<?php echo htmlspecialchars( $providers["idprovider"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="desnamecorporate">Razão Social</label>
              <input type="text" class="form-control" id="desnamecorporate" name="desnamecorporate" placeholder="Digite o nome da categoria" value="<?php echo htmlspecialchars( $providers["desnamecorporate"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="descnpj">CNPJ</label>
              <input type="text" class="form-control" id="descnpj" name="descnpj" placeholder="Digite o nome da categoria" value="<?php echo htmlspecialchars( $providers["descnpj"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
            <div class="form-group">
              <label for="destelephone">Telefone</label>
              <input type="text" class="form-control" id="destelephone" name="destelephone" placeholder="Digite o nome da categoria" value="<?php echo htmlspecialchars( $providers["destelephone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->