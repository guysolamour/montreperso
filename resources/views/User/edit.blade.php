@extends('layout')
  
@section('content')
<div class="row" style=" max-width: 500px; padding: 5px; margin: auto;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Edition de User</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('user.index') }}"> Retour</a>
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
      $id = $user->id_user;
    ?>
    
    <form action="{{ route("user.update",$id) }}" method="POST" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">

        @csrf
        @method('PUT')
     
         <div class="row">
        

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>nom:</strong>
                    <input type="text" name="nom" value="{{ $user -> nom }}" class="form-control" placeholder="nom" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>prenoms:</strong>
                    <input type="text" name="prenoms" value="{{ $user -> prenoms }}" class="form-control" placeholder="prenoms" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>contact:</strong>
                    <input type="text" name="contact" value="{{ $user -> contact }}" class="form-control" placeholder="contact" required>
                </div>
            </div>
<div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>password:</strong>
                    <input type="text" name="password" value="{{ $user -> password }}" class="form-control" placeholder="password" required>
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-md-12 text-center" style="margin-top:10px;">
                    <button type="submit" class="btn btn-primary">Modifier</button>
            </div>
        </div>
     
    </form>
@endsection