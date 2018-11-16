<?php

namespace App\Http\Controllers\Backend\Banners;

use App\Rules\SemImagem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Backend\Banners\Banner;
Use Validator;

class BannersController extends Controller
{
  public function Index(){
    return view('backend.banners.index');
  }

  public function GetBanners(){
    $data['data'] = Banner::all('id', 'imagem', 'titulo');
    foreach( $data['data'] as $d ){
      $d->imagem = '<img src="'.$d->imagem.'">';
      $d->acoes = '<button class="btn btn-primary btn-editar btn-sm" data-url="'.route("backend.banners.banner", $d->id).'" data-toggle="tooltip" title="Editar / Visualizar '.$d->titulo.'"><i class="fa fa-pencil-square-o"></i></button>
      <button class="btn btn-danger btn-apagar btn-sm" data-url="'.route("backend.banner.apagar", $d->id).'" data-toggle="tooltip" title="Apagar '.$d->titulo.'"><i class="fa fa-trash"></i></button>';
    }
    return response()->json($data);
  }

  public function Adicionar(Request $request){
    $validator = Validator::make($request->all(), $this->regras());
    if ($validator->fails()) {
      return $this->geraErros($validator);
    } else {
      $banner = Banner::create($request->all());
      echo 'OK';
    }
  }

  public function Salvar(Request $request){
    if( $request->id > 0 ){
      $validator = Validator::make($request->all(), $this->regras());
      if ($validator->fails()) {
        return $this->geraErros($validator);
      } else {
        $item = Banner::find($request->id);
        $item->update($request->all());
        echo 'OK';
      }
    }
  }

  public function Apagar(Banner $banner){
    $banner->delete();
    echo 'OK';
  }

  public function Editar(Banner $banner){
    return response()->json($banner);
  }

  protected function regras(){
    return $rules = array(
      'titulo' => 'required|string|min:3',
      'conteudo' => 'required|string|min:20',
      'botao' => 'nullable|string|min:5',
      'link' => 'nullable|string|min:10|required_with:botao',
      'imagem' => new SemImagem(),
    );
  }

}
