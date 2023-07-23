@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des CouleurBracelets</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('couleur_bracelet.create') }}"> Nouveau CouleurBracelet</a>
            </div>
        </div>
    </div>
    <br>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
     
         <table class="table table-bordered">
         <tr>
        <th>No</th>
        <th>nom_couleur </th>
        <th>image_bracelet_couleur </th>
        <th>created_at </th>
        <th>updated_at </th>
        <th width="280px">Action</th> 
    </tr>
        @foreach ($couleurBracelets as $couleurBracelet)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $couleurBracelet -> nom_couleur }}</td>
                <?php $file_url = url("uploads/couleur_bracelet/$couleurBracelet->image_bracelet_couleur") ; ?>
            <td> <img src="{{$file_url}}" style="width:20%"></td>  
            <td>{{ $couleurBracelet -> created_at }}</td> 
            <td>{{ $couleurBracelet -> updated_at }}</td> 
            <td>
            <form action="{{ route('couleur_bracelet.destroy',$couleurBracelet -> id_couleur_bracelet) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('couleur_bracelet.edit',$couleurBracelet -> id_couleur_bracelet) }}">Modifier</a>
 
                @csrf
                @method('DELETE')
    
                <a class="btn btn-danger" href="#"
                onclick="
                        event.preventDefault(); 
                        if (confirm('Etes vous sûr de supprimer l\'enregistrement ?')){
                            document.getElementById('deleteform{{$i}}').submit()
                        }
                  " 
                >Supprimer</a>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $couleurBracelets -> links() !!}

    
        
@endsection