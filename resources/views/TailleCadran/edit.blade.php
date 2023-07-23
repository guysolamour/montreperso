@extends('layout')
  
@section('content')
<div class="row" style=" max-width: 500px; padding: 5px; margin: auto;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edition de TailleCadran</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('taille_cadran.index') }}"> Retour</a>
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
      $id = $tailleCadran->id_taille_cadran;
    ?>
    
    <form action="{{ route("taille_cadran.update",$id) }}" method="POST" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">

        @csrf
        @method('PUT')
     
         <div class="row">
        

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>valeur_taille:</strong>
                    <input type="text" name="valeur_taille" value="{{ $tailleCadran -> valeur_taille }}" class="form-control" placeholder="valeur_taille" required>
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top:10px;">
                    <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </div>
     
    </form>
@endsection