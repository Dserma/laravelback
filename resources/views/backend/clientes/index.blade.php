@extends('backend.layouts.default')
@section('content')
<section class="content-header">
  <h1>
    Administrativo
    <small>Listagem de Clientes</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{route('backend.home')}}"><i class="fa fa-dashboard"></i> Painel Inicial</a></li>
    <li class="active">Listagem de Clientes</li>
  </ol>
</section>
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Confira abaixo todos os <b>clientes</b> cadastrados!</h3>
      <button class="btn btn-success pull-right btn-novo"><i class="fa fa-plus"></i> Novo Cliente</button>
    </div>
    <div class="box-body table-responsive">
      <table class="clientes-table table table-responsive table-bordered table-striped table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Pessoa</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefones</th>
            <th>Compras</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Pessoa</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Telefones</th>
            <th>Compras</th>
            <th>Ações</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</section>

<div class="modal fade modal-novo" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-xl" role="document">
    <div class="box box-info">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><b>Cadastro de Novo Cliente</b></h4>
        </div>
        <form action="#" role="form" class="form-cadastro" data-url="{{route('backend.clientes.adicionar')}}">
          <div class="modal-body">
            <div class="box-body">
              <div class="col-md-2">
                <div class="col-md-12">
                  <div class="row">
                    <label for="nome"> Pessoa </label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <input type="radio" id="pessoa_n_0" name="pessoa" checked value="0" required />
                    <label for="pessoa_n_0" class="label label-success">FÍSICA</label>
                    <input type="radio" id="pessoa_n_1" name="pessoa" value="1" />
                    <label for="pessoa_n_1" class="label label-primary">JURÍDICA</label>
                  </div>
                </div>
              </div>
              <div class="cpf-field">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="nome">CPF</label>
                    <div class="input-group">
                      <input type="text" class="form-control cpf" name="cpf">
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="nome">RG</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="rg">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="nome">Nome</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="nome">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Data de Nascimento</label>
                    <div class="input-group">
                      <input type="date" class="form-control" name="nascimento">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Profissão</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="profissao">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="nome">Nome do Cônjuge</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="nome_conjuge">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">CPF do Cônjuge</label>
                    <div class="input-group">
                      <input type="text" class="form-control cpf" name="cpf_conjuge">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">RG do Cônjuge</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="rg_conjuge">
                    </div>
                  </div>
                </div>
              </div>
              <div class="cnpj-field not-show">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="nome">CNPJ</label>
                    <div class="input-group">
                      <input type="text" class="form-control cnpj" name="cnpj">
                    </div>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="nome">IE</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="ie">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Razão Social</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="razao">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">Nome Fantasia</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="fantasia">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <hr>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nome">E-mail</label>
                  <div class="input-group">
                    <input type="email" class="form-control" name="email">
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="nome"> Telefones </label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="telefones">
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <hr>
              </div>
              <div class="col-md-12">
                <label for="">Endereço</label>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="nome"> Logradouro </label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="logradouro">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="nome"> Número </label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="numero">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="nome"> Complemento </label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="complemento">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="nome"> Bairro </label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="bairro">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="nome"> Cidade </label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="cidade">
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="nome"> CEP </label>
                  <div class="input-group">
                    <input type="text" class="form-control" name="cep">
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label for="nome"> UF </label>
                  <div class="input-group">
                    <select name="uf" id="" class="form-control select2">
                        <option value="AC">Acre</option>
                        <option value="AL">Alagoas</option>
                        <option value="AP">Amapá</option>
                        <option value="AM">Amazonas</option>
                        <option value="BA">Bahia</option>
                        <option value="CE">Ceará</option>
                        <option value="DF">Distrito Federal</option>
                        <option value="ES">Espírito Santo</option>
                        <option value="GO">Goiás</option>
                        <option value="MA">Maranhão</option>
                        <option value="MT">Mato Grosso</option>
                        <option value="MS">Mato Grosso do Sul</option>
                        <option value="MG">Minas Gerais</option>
                        <option value="PA">Pará</option>
                        <option value="PB">Paraíba</option>
                        <option value="PR">Paraná</option>
                        <option value="PE">Pernambuco</option>
                        <option value="PI">Piauí</option>
                        <option value="RJ">Rio de Janeiro</option>
                        <option value="RN">Rio Grande do Norte</option>
                        <option value="RS">Rio Grande do Sul</option>
                        <option value="RO">Rondônia</option>
                        <option value="RR">Roraima</option>
                        <option value="SC">Santa Catarina</option>
                        <option value="SP">São Paulo</option>
                        <option value="SE">Sergipe</option>
                        <option value="TO">Tocantins</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <hr>
              </div>
              <div class="col-md-12">
                <label for="">Anotações Gerais</label>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="nome"> Observações </label>
                  <div class="input-group">
                    <textarea name="anotacoes" id="" cols="30" rows="10" class="form-control editor-opicional"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade modal-editar" role="dialog" data-backdrop="static">
  <div class="modal-dialog modal-xl" role="document">
    <div class="box box-info">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title"><b>Edição de Cliente</b></h4>
        </div>
        <form action="#" role="form" class="form-editar" data-url="{{route('backend.clientes.salvar')}}">
          <input type="hidden" id="id" name="id">
          <div class="modal-body">
              <div class="box-body">
                <div class="col-md-2">
                  <div class="col-md-12">
                    <div class="row">
                      <label for="nome"> Pessoa </label>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="row">
                      <input type="radio" id="pessoa_0" name="pessoa" checked value="0" required />
                      <label for="pessoa_0" class="label label-success">FÍSICA</label>
                      <input type="radio" id="pessoa_1" name="pessoa" value="1" />
                      <label for="pessoa_1" class="label label-primary">JURÍDICA</label>
                    </div>
                  </div>
                </div>
                <div class="cpf-field">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="nome">CPF</label>
                      <div class="input-group">
                        <input type="text" class="form-control cpf" name="cpf" id="cpf">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="nome">RG</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="rg" id="rg">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nome">Nome</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="nome" id="nome">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nome">Data de Nascimento</label>
                      <div class="input-group">
                        <input type="date" class="form-control" name="nascimento" id="nascimento">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nome">Profissão</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="profissao" id="profissao">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <hr>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="nome">Nome do Cônjuge</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="nome_conjuge" id="nome_conjuge">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nome">CPF do Cônjuge</label>
                      <div class="input-group">
                        <input type="text" class="form-control cpf" name="cpf_conjuge" id="cpf_conjuge">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nome">RG do Cônjuge</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="rg_conjuge" id="rg_conjuge">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="cnpj-field not-show">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="nome">CNPJ</label>
                      <div class="input-group">
                        <input type="text" class="form-control cnpj" name="cnpj" id="cnpj">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <label for="nome">IE</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="ie" id="ie">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nome">Razão Social</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="razao" id="razao">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nome">Nome Fantasia</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="fantasia" id="fantasia">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome">E-mail</label>
                    <div class="input-group">
                      <input type="email" class="form-control" name="email" id="email">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nome"> Telefones </label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="telefones" id="telefones">
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                </div>
                <div class="col-md-12">
                  <label for="">Endereço</label>
                </div>
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="nome"> Logradouro </label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="logradouro" id="logradouro">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nome"> Número </label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="numero" id="numero">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nome"> Complemento </label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="complemento" id="complemento">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nome"> Bairro </label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="bairro" id="bairro">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="nome"> Cidade </label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="cidade" id="cidade">
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="nome"> CEP </label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="cep" id="cep">
                    </div>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="nome"> UF </label>
                    <div class="input-group">
                      <select name="uf" id="uf" class="form-control select2">
                          <option value="AC">Acre</option>
                          <option value="AL">Alagoas</option>
                          <option value="AP">Amapá</option>
                          <option value="AM">Amazonas</option>
                          <option value="BA">Bahia</option>
                          <option value="CE">Ceará</option>
                          <option value="DF">Distrito Federal</option>
                          <option value="ES">Espírito Santo</option>
                          <option value="GO">Goiás</option>
                          <option value="MA">Maranhão</option>
                          <option value="MT">Mato Grosso</option>
                          <option value="MS">Mato Grosso do Sul</option>
                          <option value="MG">Minas Gerais</option>
                          <option value="PA">Pará</option>
                          <option value="PB">Paraíba</option>
                          <option value="PR">Paraná</option>
                          <option value="PE">Pernambuco</option>
                          <option value="PI">Piauí</option>
                          <option value="RJ">Rio de Janeiro</option>
                          <option value="RN">Rio Grande do Norte</option>
                          <option value="RS">Rio Grande do Sul</option>
                          <option value="RO">Rondônia</option>
                          <option value="RR">Roraima</option>
                          <option value="SC">Santa Catarina</option>
                          <option value="SP">São Paulo</option>
                          <option value="SE">Sergipe</option>
                          <option value="TO">Tocantins</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <hr>
                </div>
                <div class="col-md-12">
                  <label for="">Anotações Gerais</label>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="nome"> Observações </label>
                    <div class="input-group">
                      <textarea name="anotacoes" cols="30" rows="10" class="form-control editor-opicional" id="anotacoes"></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Salvar</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div>
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
  $(document).ready(function () {
    $(document).ajaxComplete(function () {
      $('[data-toggle="tooltip"]').tooltip();
    })

    $('#pessoa_n_0, #pessoa_0').on('ifChecked', function(){
      $('.cnpj-field').hide();
      $('.cpf-field').show();
    })

    $('#pessoa_n_1, #pessoa_1').on('ifChecked', function(){
      $('.cpf-field').hide();
      $('.cnpj-field').show();
    })

    tabela = $('.clientes-table').DataTable({
      "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.18/i18n/Portuguese-Brasil.json",
        },
      "ajax": {
        "url": "{{route('backend.clientes.getclientes')}}",
        "data": {
        },
        "type": "GET",
      },
      "columns": [{
          "data": "id"
        },
        {
          "data": "pessoa"
        },
        {
          "data": "nome"
        },
        {
          "data": "email"
        },
        {
          "data": "telefones"
        },
        {
          "data": "cotas"
        },
        {
          "data": "acoes"
        },
      ],
      'paging': true,
      "pageLength": 100,
      'lengthChange': true,
      'searching': true,
      'ordering': true,
      'info': true,
      'autoWidth': false,
      dom: 'lBfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf','print'
      ],
    });
});
</script>
@endsection