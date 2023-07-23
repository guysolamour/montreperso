@extends('layout')
  
@section('content')
<div class="row" style=" max-width: 500px; padding: 5px; margin: auto;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Nouveau MontrePersoIndex</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('montre_perso_index.index') }}"> Retour</a>
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
     
<form action="{{ route('montre_perso_index.store') }}" method="POST" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">
    @csrf
    
     <div class="row">
        

         <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>nom_index:</strong>
                    <input type="text" name="nom_index" class="form-control" placeholder="nom_index" required>
                </div>
            </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top:10px;">
                <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </div>
     
</form>
@endsection