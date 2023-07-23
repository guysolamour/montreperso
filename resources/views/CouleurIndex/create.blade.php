@extends('layout')
  
@section('content')
<div class="row" style=" max-width: 500px; padding: 5px; margin: auto;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Nouveau CouleurIndex</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('couleur_index.index') }}"> Retour</a>
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
     
<form action="{{ route('couleur_index.store') }}" method="POST" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">
    @csrf
    
     <div class="row">
        

         <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
           
                <strong>Type d'Index:</strong>
                <select  class="" aria-label="Default select example"   name="id_index"  required>
                <option value="" >
            @foreach($montrePersoIndexs as $montrePersoIndex)
                <option value="{{$montrePersoIndex ->id_index}}" 
                                    
                <?php if(request('id_index') ==  $montrePersoIndex -> id_index)
                                        echo "selected"
                            ?>        
                >{{$montrePersoIndex ->nom_index}}</option>
            @endforeach
            
            </select>
            </div> 
            <br>

        </div>
        <br>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
           
                <strong>forme montre:</strong>
                <select class="" aria-label="Default select example"   name="id_forme_montre"  required>
                <option value="" >
            @foreach($formeMontres as $formeMontre)
                <option value="{{$formeMontre ->id_forme_montre}}" 
                                    
                <?php if(request('id_forme_montre') ==  $formeMontre -> id_forme_montre)
                                        echo "selected"
                            ?>        
                >{{$formeMontre ->libelle_forme}}</option>
            @endforeach
            
            </select>
            </div> 
            <br>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>nom_couleur:</strong>
                    <input type="text" name="nom_couleur" class="form-control" placeholder="nom_couleur" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>image_couleur_index:</strong>
                    <input type="file" name="image_couleur_index" class="form-control" placeholder="image_couleur_index" required>
                </div>
            </div>


        <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top:10px;">
                <button type="submit" class="btn btn-primary">Valider</button>
        </div>
    </div>
     
</form>
@endsection