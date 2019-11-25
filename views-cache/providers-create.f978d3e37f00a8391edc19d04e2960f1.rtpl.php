<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Categorias
  </h1>
  <ol class="breadcrumb">
    <li><a href="/admin"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="/admin/providers">Fornecedores</a></li>
    <li class="active"><a href="/admin/providers/create">Cadastrar</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Novo Fornecedor</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/admin/providers/create" method="post">
          <div class="box-body">
            <div class="form-group">
              <label for="descategory">Razão Social</label>
              <input type="text" class="form-control" id="desnamecorporate" name="desnamecorporate" placeholder="Digite a razão social">
            </div>
            <div class="form-group">
              <label for="descategory">CNPJ</label>
              <input type="text" class="form-control" id="descnpj" name="descnpj" placeholder="Digite o CNPJ">
            </div>
            <div class="form-group">
              <label for="descategory">Telefone</label>
              <input type="text" class="form-control" id="destelephone" name="destelephone" placeholder="Digite o Telefone">
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-success">Cadastrar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->