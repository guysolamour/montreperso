@extends('layout')
  
@section('content')
<div class="row" style=" max-width: 500px; padding: 5px; margin: auto;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edition de MontreClient</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('montre_client.index') }}"> Retour</a>
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
      $id = $montreClient->id_montre_client;
    ?>
    
    <form action="{{ route("montre_client.update",$id) }}" method="POST" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">

        @csrf
        @method('PUT')
     
         <div class="row">
        

            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
           
                <strong>arrierePlanMontre:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_arriere_plant"  required>
                <option value="" >
            @foreach($arrierePlanMontres as $arrierePlanMontre)
                <option value="{{$arrierePlanMontre ->id_arriere_plant}}" 
                                    
                <?php if(request('id_arriere_plant') ==  $arrierePlanMontre -> id_arriere_plant)
                                        echo "selected"
                            ?>        
                >{{$arrierePlanMontre ->id_arriere_plant}}</option>
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
           
                <strong>formeMontre:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_forme_montre"  required>
                <option value="" >
            @foreach($formeMontres as $formeMontre)
                <option value="{{$formeMontre ->id_forme_montre}}" 
                                    
                <?php if(request('id_forme_montre') ==  $formeMontre -> id_forme_montre)
                                        echo "selected"
                            ?>        
                >{{$formeMontre ->id_forme_montre}}</option>
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
           
                <strong>tailleCadran:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_taille_cadran"  required>
                <option value="" >
            @foreach($tailleCadrans as $tailleCadran)
                <option value="{{$tailleCadran ->id_taille_cadran}}" 
                                    
                <?php if(request('id_taille_cadran') ==  $tailleCadran -> id_taille_cadran)
                                        echo "selected"
                            ?>        
                >{{$tailleCadran ->id_taille_cadran}}</option>
            @endforeach
            
            </select>
            </div> 
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
           
                <strong>texteMontre:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_texte_montre"  required>
                <option value="" >
            @foreach($texteMontres as $texteMontre)
                <option value="{{$texteMontre ->id_texte_montre}}" 
                                    
                <?php if(request('id_texte_montre') ==  $texteMontre -> id_texte_montre)
                                        echo "selected"
                            ?>        
                >{{$texteMontre ->id_texte_montre}}</option>
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
                    <strong>id_arriere_plan:</strong>
                    <input type="text" name="id_arriere_plan" value="{{ $montreClient -> id_arriere_plan }}" class="form-control" placeholder="id_arriere_plan" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>quantite:</strong>
                    <input type="text" name="quantite" value="{{ $montreClient -> quantite }}" class="form-control" placeholder="quantite" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>prix:</strong>
                    <input type="text" name="prix" value="{{ $montreClient -> prix }}" class="form-control" placeholder="prix" required>
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top:10px;">
                    <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </div>
     
    </form>
@endsection