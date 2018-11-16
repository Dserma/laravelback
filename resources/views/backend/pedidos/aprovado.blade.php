@extends('backend.layouts.default')
@section('content')
<section class="content-header">
  <h1>
    Administrativo
    <small>Pedido Aprovado</small>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="{{route('backend.home')}}">
        <i class="fa fa-dashboard"></i> Painel Inicial</a>
    </li>
    <li>
      <a href="{{route('backend.pedidos')}}">
        <i class="fa fa-pencil-square-o"></i> Pedidos</a>
    </li>
    <li class="active">Pedido Aprovado</li>
  </ol>
</section>
<section class="content">
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">Confira abaixo os dados do Pedido # {{$pedido->id}} {{$pedido->cota->tipo == '1' ? '- Imóveis' : ' - Automóveis'}}</h3>
    </div>
    <div class="box-body">
      <div class="box box-primary">
        <div class="box-body">
          <div class="col-md-6">
            <div class="form-group">
              <label for="nome">Cliente</label>
              <input type="text" class="form-control" value="{{$pedido->cliente->nome}}" readonly>
            </div>
          </div>
          <div class="col-md-6 padding-top-25">
            <button class="btn btn-primary btn-editar btn-sm" data-url="{{route('backend.clientes.cliente', $pedido->cliente->id)}}">
              <i class="fa fa-eye"></i>&nbsp; Ver Cliente
            </button>
          </div>
        </div>
      </div>
      <div class="box box-danger">
        <div class="box-header">
          <b>Cota {{ $pedido->cota->agrupada == 1 ? 'Agrupada' : ''}}</b>
        </div>
        <div class="box-body">
          <div class="col-xs-12 table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Administradora</th>
                  <th>Investidor(es)</th>
                  <th>Crédito</th>
                  <th>Entrada</th>
                  @if( $pedido->cota->agrupada == 1 )
                  <th>Entrada Opcional</th>
                  @endif
                  @if( $pedido->cota->agrupada != 1 )
                  <th>Grupo</th>
                  <th>Cota</th>
                  @endif
                  <th>Saldo Devedor</th>
                  <th>Parcelas</th>
                  @if( $pedido->cota->agrupada != 1 )
                  <th>Ações</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{$pedido->cota->id}}</td>
                  <td>{{$pedido->cota->administradora->nome}}</td>
                  <td>
                    @php
                    if( $pedido->cota->agrupada == 1 ){
                    echo '-- Agrupada';
                    }else{
                    unset($inv);
                    $inv = array();
                    foreach( $pedido->cota->investidores as $i ){
                    $inv[] = $i->nome;
                    }
                    echo implode(',', $inv);
                    }
                    @endphp
                  </td>
                  <td>{{currencyToApp($pedido->cota->credito)}}</td>
                  <td>{{currencyToApp($pedido->cota->entrada)}}</td>
                  @if( $pedido->cota->agrupada == 1 )
                  <td>{{currencyToApp($pedido->cota->entrada_opicional)}}</td>
                  @endif
                  @if( $pedido->cota->agrupada != 1 )
                  <td>{{$pedido->cota->grupo}}</td>
                  <td>{{$pedido->cota->cota}}</td>
                  @endif
                  <td>{{currencyToApp($pedido->cota->devedor)}}</td>
                  <td>
                    @foreach( $pedido->cota->parcelas as $p )
                    {{$p->parcelas}} X {{currencyToApp($p->valor_parcela)}}<br>
                    @endforeach
                  </td>
                  @if( $pedido->cota->agrupada != 1 )
                  <td>
                      <button class="btn btn-primary btn-sm btn-altera" data-url="{{route('backend.cota.cota-grupo', $pedido->cota->id)}}"
                        data-toggle="tooltip" title="Editar Cota / Grupo"><i class="fa fa-pencil-square"></i></button>
                    </td>
                  @endif
                </tr>
              </tbody>
            </table>
          </div>
          @if( $pedido->cota->agrupada == 1 )
          <div class="box-header">
            <b>Composição da Cota</b>
          </div>
          <div class="col-xs-12 table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Administradora</th>
                  <th>Investidor(es)</th>
                  <th>Crédito</th>
                  <th>Entrada</th>
                  <th>Grupo</th>
                  <th>Cota</th>
                  <th>Saldo Devedor</th>
                  <th>Parcelas</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                @foreach( $pedido->cota->cotas as $cota )
                <tr>
                  <td>{{$cota->id}}</td>
                  <td>{{$cota->administradora->nome}}</td>
                  <td>
                    @php
                    unset($inv);
                    $inv = array();
                    foreach( $cota->investidores as $i ){
                    $inv[] = $i->nome;
                    }
                    echo implode(',', $inv);
                    @endphp
                  </td>
                  <td>{{$cota->credito}}</td>
                  <td>{{$cota->entrada}}</td>
                  <td>{{$cota->grupo}}</td>
                  <td>{{$cota->cota}}</td>
                  <td>{{currencyToApp($cota->devedor)}}</td>
                  <td>
                    @foreach( $cota->parcelas as $p )
                    {{$p->parcelas}} X {{$p->valor_parcela}}<br>
                    @endforeach
                  </td>
                  <td>
                    <button class="btn btn-primary btn-sm btn-altera" data-url="{{route('backend.cota.cota-grupo', $cota->id)}}"
                      data-toggle="tooltip" title="Editar Cota / Grupo"><i class="fa fa-pencil-square"></i></button>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          @endif
        </div>
      </div>
      <form action="#" role="form" class="form-editar-aprovado" data-url="{{route('backend.pedido.aprovado.salvar',$pedido->id)}}">
        <div class="box box-info">
          <div class="box-header">
            <b>Dados do Pedido</b>
          </div>
          <div class="box-body">
            <div class="col-md-3">
              <div class="form-group">
                <label for="nome">Entrada Negociada</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">R$</span>
                  <input type="text" class="form-control valor" name="entrada_negociada" value="{{currencyToApp($pedido->entrada_negociada)}}">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="nome">Data do Sinal</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                  <input type="date" class="form-control" name="data_sinal" value="{{dateToApp($pedido->data_sinal)}}">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="nome">Valor do Sinal</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">R$</span>
                  <input type="text" class="form-control valor" name="valor_sinal" value="{{currencyToApp($pedido->valor_sinal)}}">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="nome">Data do Pagamento Final</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                  <input type="date" class="form-control" name="data_pagamento_final" value="{{dateToApp($pedido->data_pagamento_final)}}">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="nome">Valor do Pagamento Final</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">R$</span>
                  <input type="text" class="form-control valor" name="valor_pagamento_final" value="{{currencyToApp($pedido->valor_pagamento_final)}}">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="nome">Data da Entrega da Transferência</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                  <input type="date" class="form-control" name="data_entrega_transferencia" value="{{dateToApp($pedido->data_entrega_transferencia)}}">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="nome">Sedex</label>
                <div class="input-group">
                  <input type="text" class="form-control" name="sedex" value="{{$pedido->sedex}}">
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="nome">Valor da Comissão</label>
                <div class="input-group">
                  <span class="input-group-addon" id="basic-addon1">R$</span>
                  <input type="text" class="form-control valor" name="valor_comissao" value="{{currencyToApp($pedido->valor_comissao)}}">
                </div>
              </div>
            </div>
            <div class="col-xs-12">
              <hr>
            </div>
            <div class="col-xs-12">
              <div class="form-group">
                <label for="nome">Observações</label>
                <div class="input-group">
                  <textarea name="observacoes" id="" cols="30" rows="10" class="form-control">{{$pedido->observacoes}}</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="box-footer">
            <div class="col-xs-6">
              <a class="btn btn-danger" onclick="javascript:history.back(1);"><i class="fa fa-arrow-left"></i> &nbsp;
                Voltar</a>
            </div>
            <div class="col-xs-6">
              <button class="btn btn-success pull-right" type="submit"><i class="fa fa-check"></i> &nbsp; Salvar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
</section>

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

<div class="modal fade modal-editar-cota" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
      <div class="box box-info">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><b>Edição de Cota</b></h4>
          </div>
          <form action="#" role="form" class="form-editar-cota" data-url="{{route('backend.cota.cota-grupo.salvar')}}">
            <input type="hidden" id="id" name="id">
            <div class="modal-body">
                <div class="box-body">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nome"> Grupo </label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="grupo" id="grupo">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="nome">Cota</label>
                      <div class="input-group">
                        <input type="text" class="form-control" name="cota" id="cota">
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

<script src="{{assets('js/backend/pedidos.js')}}"></script>
<script>
  $(document).ready(function () {
    $(document).ajaxComplete(function () {
      $('[data-toggle="tooltip"]').tooltip();
    })
  })
</script>
@endsection