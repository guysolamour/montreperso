@extends('layout')
  
@section('content')
<div class="row" style=" max-width: 500px; padding: 5px; margin: auto;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edition de ArrierePlanHorloge</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('arriere_plan_horloge.index') }}"> Retour</a>
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
      $id = $arrierePlanHorloge->id_arriere_plan;
    ?>
    
    <form action="{{ route("arriere_plan_horloge.update",$id) }}" method="POST" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">

        @csrf
        @method('PUT')
     
         <div class="row">
        

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>nom_arriere_plan:</strong>
                    <input type="text" name="nom_arriere_plan" value="{{ $arrierePlanHorloge -> nom_arriere_plan }}" class="form-control" placeholder="nom_arriere_plan" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                    
                <div class="form-group">
                <?php $file_url = url("uploads/arriere_plan_horloge/$arrierePlanHorloge->image_arriere_plan") ; ?>
                    <img src="{{$file_url}}" style="width: 100%;" >  
                    <br>
                    <br>
                    <strong>image_arriere_plan:</strong>
                    <input type="file" name="image_arriere_plan" value="" class="form-control" placeholder="image_arriere_plan" >
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top:10px;">
                    <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </div>
     
    </form>
@endsection