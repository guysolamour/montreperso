@extends('layout')
  
@section('content')
<div class="row" style=" max-width: 500px; padding: 5px; margin: auto;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Nouveau TexteHorloge</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('texte_horloge.index') }}"> Retour</a>
        </div>
    </div>
</div>
     
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> Problème avec les données saisies.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
     
<form action="{{ route('texte_horloge.store') }}" method="POST" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">
    @csrf
    
     <div class="row">
        

         <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>id_police:</strong>
                    <input type="text" name="id_police" class="form-control" placeholder="id_police" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>taille_police:</strong>
                    <input type="text" name="taille_police" class="form-control" placeholder="taille_police" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>id_couleur:</strong>
                    <input type="text" name="id_couleur" class="form-control" placeholder="id_couleur" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>id_position_texte:</strong>
                    <input type="text" name="id_position_texte" class="form-control" placeholder="id_position_texte" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>contenu_texte:</strong>
                    <input type="text" name="contenu_texte" class="form-control" placeholder="contenu_texte" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>id_horloge_client:</strong>
                    <input type="text" name="id_horloge_client" class="form-control" placeholder="id_horloge_client" required>
                </div>
            </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top:10px;">
                <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </div>
     
</form>
@endsection