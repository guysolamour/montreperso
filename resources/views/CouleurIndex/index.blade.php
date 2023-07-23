@extends('layout')
     
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Liste des CouleurIndexs</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('couleur_index.create') }}"> Nouveau CouleurIndex</a>
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
        <th>image_couleur_index </th>
        <th>Index </th>
        <th>Forme </th>
        <th>created_at </th>
        <th>updated_at </th>
        <th width="280px">Action</th> 
    </tr>
    <?php //dd($couleurIndexs[0]->formeMontre)?>
        @foreach ($couleurIndexs as $couleurIndex)
        <tr>
            <td>{{ ++$i }}</td>            <td>{{ $couleurIndex -> nom_couleur }}</td> 
                 <?php $file_url = url("uploads/couleur_index/$couleurIndex->image_couleur_index") ; ?>
            <td> <img src="{{$file_url}}" style="width:20%"></td> 
            <td>{{ $couleurIndex -> montrePersoIndex->nom_index }}</td> 
            <td>{{ $couleurIndex -> formeMontre->libelle_forme }}</td> 
            <td>{{ $couleurIndex -> created_at }}</td> 
            <td>{{ $couleurIndex -> updated_at }}</td> 
            <td>
            <form action="{{ route('couleur_index.destroy',$couleurIndex -> id_couleur_index) }}" method="POST"  id="deleteform{{$i}}">
 
                <a class="btn btn-primary" href="{{ route('couleur_index.edit',$couleurIndex -> id_couleur_index) }}">Modifier</a>
 
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

{!! $couleurIndexs -> links() !!}

    
        
@endsection