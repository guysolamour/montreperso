@extends('layout')
  
@section('content')
<div class="row" style=" max-width: 500px; padding: 5px; margin: auto;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edition de HorlogeClient</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('horloge_client.index') }}"> Retour</a>
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

    <?php //clé primaire
      $id = $horlogeClient->id_horloge_client;
    ?>
    
    <form action="{{ route("horloge_client.update",$id) }}" method="POST" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">

        @csrf
        @method('PUT')
     
         <div class="row">
        

            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
           
                <strong>texteHorloge:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_texte_horloge"  required>
                <option value="" >
            @foreach($texteHorloges as $texteHorloge)
                <option value="{{$texteHorloge ->id_texte_horloge}}" 
                                    
                <?php if(request('id_texte_horloge') ==  $texteHorloge -> id_texte_horloge)
                                        echo "selected"
                            ?>        
                >{{$texteHorloge ->id_texte_horloge}}</option>
            @endforeach
            
            </select>
            </div> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
           
                <strong>couleurIndex:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_couleur_index"  required>
                <option value="" >
            @foreach($couleurIndexs as $couleurIndex)
                <option value="{{$couleurIndex ->id_couleur_index}}" 
                                    
                <?php if(request('id_couleur_index') ==  $couleurIndex -> id_couleur_index)
                                        echo "selected"
                            ?>        
                >{{$couleurIndex ->id_couleur_index}}</option>
            @endforeach
            
            </select>
            </div> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
           
                <strong>arrierePlanHorloge:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_arriere_plan"  required>
                <option value="" >
            @foreach($arrierePlanHorloges as $arrierePlanHorloge)
                <option value="{{$arrierePlanHorloge ->id_arriere_plan}}" 
                                    
                <?php if(request('id_arriere_plan') ==  $arrierePlanHorloge -> id_arriere_plan)
                                        echo "selected"
                            ?>        
                >{{$arrierePlanHorloge ->id_arriere_plan}}</option>
            @endforeach
            
            </select>
            </div> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
           
                <strong>user:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_user"  required>
                <option value="" >
            @foreach($users as $user)
                <option value="{{$user ->id_user}}" 
                                    
                <?php if(request('id_user') ==  $user -> id_user)
                                        echo "selected"
                            ?>        
                >{{$user ->id_user}}</option>
            @endforeach
            
            </select>
            </div> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
           
                <strong>imagePerso:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_image_perso"  required>
                <option value="" >
            @foreach($imagePersos as $imagePerso)
                <option value="{{$imagePerso ->id_image_perso}}" 
                                    
                <?php if(request('id_image_perso') ==  $imagePerso -> id_image_perso)
                                        echo "selected"
                            ?>        
                >{{$imagePerso ->id_image_perso}}</option>
            @endforeach
            
            </select>
            </div> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
           
                <strong>formeHorloge:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_forme_horloge"  required>
                <option value="" >
            @foreach($formeHorloges as $formeHorloge)
                <option value="{{$formeHorloge ->id_forme_horloge}}" 
                                    
                <?php if(request('id_forme_horloge') ==  $formeHorloge -> id_forme_horloge)
                                        echo "selected"
                            ?>        
                >{{$formeHorloge ->id_forme_horloge}}</option>
            @endforeach
            
            </select>
            </div> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
           
                <strong>positionImagePerso:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_position_image_perso"  required>
                <option value="" >
            @foreach($positionImagePersos as $positionImagePerso)
                <option value="{{$positionImagePerso ->id_position_image_perso}}" 
                                    
                <?php if(request('id_position_image_perso') ==  $positionImagePerso -> id_position_image_perso)
                                        echo "selected"
                            ?>        
                >{{$positionImagePerso ->id_position_image_perso}}</option>
            @endforeach
            
            </select>
            </div> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>id_taille:</strong>
                    <input type="text" name="id_taille" value="{{ $horlogeClient -> id_taille }}" class="form-control" placeholder="id_taille" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>id_text:</strong>
                    <input type="text" name="id_text" value="{{ $horlogeClient -> id_text }}" class="form-control" placeholder="id_text" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>quantite:</strong>
                    <input type="text" name="quantite" value="{{ $horlogeClient -> quantite }}" class="form-control" placeholder="quantite" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>prix:</strong>
                    <input type="text" name="prix" value="{{ $horlogeClient -> prix }}" class="form-control" placeholder="prix" required>
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top:10px;">
                    <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </div>
     
    </form>
@endsection