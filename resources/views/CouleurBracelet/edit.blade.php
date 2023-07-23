@extends('layout')
  
@section('content')
<div class="row" style=" max-width: 500px; padding: 5px; margin: auto;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edition de CouleurBracelet</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('couleur_bracelet.index') }}"> Retour</a>
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
      $id = $couleurBracelet->id_couleur_bracelet;
    ?>
    
    <form action="{{ route("couleur_bracelet.update",$id) }}" method="POST" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">

        @csrf
        @method('PUT')
     
         <div class="row">
        

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>nom_couleur:</strong>
                    <input type="text" name="nom_couleur" value="{{ $couleurBracelet -> nom_couleur }}" class="form-control" placeholder="nom_couleur" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">

                 <?php $file_url = url("uploads/couleur_bracelet/$couleurBracelet->image_bracelet_couleur") ; ?>
                    <img src="{{$file_url}}" style="width: 100%;" >  

                    <br>
                    <br>
                    <strong>image_bracelet_couleur:</strong>
                    <input type="file" name="image_bracelet_couleur" value="" class="form-control" placeholder="image_bracelet_couleur" >
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top:10px;">
                    <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </div>
     
    </form>
@endsection