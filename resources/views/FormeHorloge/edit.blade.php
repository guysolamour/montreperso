@extends('layout')
  
@section('content')
<div class="row" style=" max-width: 500px; padding: 5px; margin: auto;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edition de FormeHorloge</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('forme_horloge.index') }}"> Retour</a>
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
      $id = $formeHorloge->id_forme_horloge;
    ?>
    
    <form action="{{ route("forme_horloge.update",$id) }}" method="POST" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">

        @csrf
        @method('PUT')
     
         <div class="row">
        

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>libelle_forme:</strong>
                    <input type="text" name="libelle_forme" value="{{ $formeHorloge -> libelle_forme }}" class="form-control" placeholder="libelle_forme" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <br>
                    <?php $file_url = url("uploads/forme_horloge/$formeHorloge->image_forme") ; ?>
                    <img src="{{$file_url}}" style="width: 100%;" >  
                    <br>
                    <br>
                    <strong>image_forme:</strong>
                    <input type="file" name="image_forme"  class="form-control" placeholder="image_forme" >
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top:10px;">
                    <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </div>
     
    </form>
@endsection