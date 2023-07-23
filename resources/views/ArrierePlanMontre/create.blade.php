@extends('layout')
  
@section('content')
<div class="row" style=" max-width: 500px; padding: 5px; margin: auto;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Nouveau ArrierePlanMontre</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('arriere_plan_montre.index') }}"> Retour</a>
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
     
<form action="{{ route('arriere_plan_montre.store') }}" method="POST" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">
    @csrf
    
     <div class="row">
        

         <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>nom_arriere_plan:</strong>
                    <input type="text" name="nom_arriere_plan" class="form-control" placeholder="nom_arriere_plan" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>image_arriere_plan:</strong>
                    <input type="file" name="image_arriere_plan" class="form-control" placeholder="image_arriere_plan" required>
                </div>
            </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top:10px;">
                <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </div>
     
</form>
@endsection