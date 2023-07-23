@extends('layout')

@section('content')
<div class="row" style=" max-width: 500px; padding: 5px; margin: auto;">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Nouvelle Montre</h2>
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

<form action="{{ route('montre_client.store') }}" method="POST" id="formulaire_montre" onsubmit="event.preventDefault()" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">
    @csrf


     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12" style="  width: 150px;">
                <div class="form-group">

                <button type="submit" class="btn btn-primary">Valider</button>

                    <strong>formeMontre:</strong>
                    <select class="form-group" aria-label="Default select example" id="id_forme_montre"   name="id_forme_montre"  required>
                    <option value="" >
                @foreach($formeMontres as $formeMontre)
                    <option value="{{$formeMontre ->id_forme_montre}}"  image_forme="{{$formeMontre ->image_forme}}"

                    <?php if(request('id_forme_montre') ==  $formeMontre -> id_forme_montre)
                                            echo "selected"
                                ?>
                    >{{$formeMontre ->libelle_forme}}</option>
                @endforeach

                </select>
                </div>
        </div>

         <div class="col-xs-12 col-sm-12 col-md-12" style="  width: 150px;">
            <div class="form-group">

                <strong>arrière Plan:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_arriere_plan" id="id_arriere_plan"  required>
                <option value="" >
            @foreach($arrierePlanMontres as $arrierePlanMontre)
                <option value="{{$arrierePlanMontre ->id_arriere_plan}}"  image_arriere_plan="{{$arrierePlanMontre ->image_arriere_plan}}"

                <?php if(request('id_arriere_plan') ==  $arrierePlanMontre -> id_arriere_plan)
                                        echo "selected"
                            ?>
                >{{$arrierePlanMontre ->nom_arriere_plan}}</option>
            @endforeach

            </select>
            </div>
        </div>


        <div class="col-xs-12 col-sm-12 col-md-12" style="  width: 150px;">
            <div class="form-group">

                <strong>Index:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_couleur_index" id="id_couleur_index"  required>
                <option value="" >
            @foreach($couleurIndexs as $couleurIndex)
                <option value="{{$couleurIndex ->id_couleur_index}}" image_couleur_index="{{$couleurIndex ->image_couleur_index}}"

                <?php if(request('id_couleur_index') ==  $couleurIndex -> id_couleur_index)
                                        echo "selected"
                            ?>
                >{{$couleurIndex->montrePersoIndex->nom_index}} {{$couleurIndex->nom_couleur}}</option>
            @endforeach

            </select>
            </div>
        </div>

        <!--<div class="col-xs-12 col-sm-12 col-md-12" style="  width: 150px;">
             <div class="form-group">

                <strong>imagePerso:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_image_perso" >
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
        </div>-->
        <div class="col-xs-12 col-sm-12 col-md-12" style="  width: 150px;">
            <div class="form-group">

                <strong>tailleCadran:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_taille_cadran"  id="id_taille_cadran" required>
                <option value="" >
            @foreach($tailleCadrans as $tailleCadran)
                <option value="{{$tailleCadran ->id_taille_cadran}}"  valeur_taille="{{$tailleCadran ->valeur_taille}}"

                <?php if(request('id_taille_cadran') ==  $tailleCadran -> id_taille_cadran)
                                        echo "selected"
                            ?>
                >{{$tailleCadran ->valeur_taille}} mm</option>
            @endforeach

            </select>
            </div>
        </div>
        <!-- <div class="col-xs-12 col-sm-12 col-md-12" style="  width: 150px;">
            <div class="form-group">

                <strong>texteMontre:</strong>
                <select class="form-group" aria-label="Default select example"   name="id_texte_montre" >
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
        </div> -->

        <!-- <div class="col-xs-12 col-sm-12 col-md-12" style="  width: 150px;">
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
        </div> -->



        <div class="col-xs-12 col-sm-12 col-md-12" style="  width: 150px; display: none;">
                <div class="form-group">
                    <strong>quantite:</strong>
                    <input type="text" name="quantite" value ="1" class="form-control" placeholder="quantite" required>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12" style="  width: 150px;  display: none;">
                <div class="form-group">
                    <strong>prix:</strong>
                    <input type="text" name="prix" value ="1" class="form-control" placeholder="prix" required>
                </div>
            </div>






            <div style="margin-top: 5px;">
                        <strong>Taille de l'image</strong>
                        <button type="button" class="btn btn-secondary" id="imageTailleMoins"> - </button>
                        <button type="button" class="btn btn-primary" id="imageTaillePlus"> + </button>

            </div>

            <div style="margin-top: 5px;">
                        <strong>Position de l'image</strong>
                        <button type="button" class="btn btn-primary" id="Image_Pull_Up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"></path>
                            </svg>
                        </button>
                        <button type="button" class="btn btn-secondary" id="Image_Pull_Down">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"></path>
                                </svg>
                        </button>
                        <button type="button" class="btn btn-success" id="Image_Pull_Left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
                            </svg>

                         </button>
                         <button type="button" class="btn btn-primary" id="Image_Pull_Right">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                            </svg>

                         </button>

            </div>


            <div style="margin-top: 5px;">
                        <strong>Taille du texte</strong> &nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-secondary" id="texteTailleMoins"> - </button>
                        <button type="button" class="btn btn-primary" id="texteTaillePlus"> + </button>

            </div>

            <div style="margin-top: 5px;">
                        <strong>Position du texte</strong> &nbsp;&nbsp;&nbsp;
                        <!-- <button type="button" class="btn btn-secondary" id="positionTexteMoins"> - </button>
                        <button type="button" class="btn btn-primary" id="positionTextePlus"> + </button> -->

                        <button type="button" class="btn btn-primary" id="Text_Pull_Up">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"></path>
                            </svg>
                        </button>
                        <button type="button" class="btn btn-secondary" id="Text_Pull_Down">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"></path>
                                </svg>
                        </button>
                        <button type="button" class="btn btn-success" id="Text_Pull_Left">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
                            </svg>

                         </button>
                         <button type="button" class="btn btn-primary" id="Text_Pull_Right">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                            </svg>

                         </button>

            </div>

            <div style="margin-top: 10px;">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Ajouter une image
                        </button>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#texteModal">
                        Ajouter du texte
                        </button>

            </div>

            <div class="col-xs-12 col-sm-12 col-md-12" style="background-color: aqua; position: relative; ">
                <br>

                <div style="width: 100%; position:absolute ;left:0 ; top:0; z-index: 10;">

                    <?php $file_url = url("uploads/forme_montre/20221027133130.png") ; ?>
                    <img src="{{$file_url}}" style="width: 100%;" id="img_forme_montre"  >

                </div>
                <div style="width: 80%; position:absolute ; margin-top: 8%; margin-left: 4%; z-index: 9;">
                        <?php $file_url = url("uploads/couleur_index/20221026180510.png") ; ?>
                        <img src="{{$file_url}}" style="width: 100%;" id="img_index" >

                </div>
                <div style="width: 100%; position:absolute ;left:0 ; top:0; z-index: 8;" id="img_image_perso_div">

                <?php $file_url = url("uploads/image_perso/d.jpg") ; ?>
                <img src="{{$file_url}}" style="width: 100%;" id="img_image_perso">

                </div>
                <div style=" position:absolute; margin-top: 0px; margin-left: 0px; z-index: 7;">

                    <?php $file_url = url("uploads/arriere_plan_montre/20221024013304.jpg");?>
                    <img src="{{$file_url}}" style=" width: 100%; " id="img_arriere_plan">

                </div>

                <div id="texte_montre" style="position:absolute;left:0 ; top:0; margin-top: 40%; margin-left: 4%; z-index: 11;font-size: 15px;">
                    <textarea id="texte_montre_content" rows="10" style="background: transparent; border:none;resize: unset"></textarea>
                </div>

            </div>



    </div>

</form>

    <!-- Modal texte -->
            <div class="modal fade" id="texteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ajouter du texte </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form action="{{ route('upload_image') }}" id="formulaire_text_upload" method="POST" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">
                        @csrf

                            <div class="form-group">
                                <strong>Texte</strong>
                                <textarea name="text_perso_client" id="text_perso_client" class="form-control"></textarea>
                                <!-- <input type="text" name="text_perso_client"  id="text_perso_client" class="form-control"  > -->
                            </div>




                            <div class="form-group">

                            <strong>Style de texte:</strong>
                                <select class="form-group" aria-label="Default select example"   name="id_police" id="id_police" >
                                <option value="" >
                                @foreach($polices as $police)
                                    <option value="{{$police ->id_police}}"

                                    >{{$police ->valeur_police}}</option>
                                @endforeach

                        </select>
                        </div>

                        <div class="form-group">
                                <strong>Couleur du texte</strong>
                                <input type="color" id="text_color" name="text_color"   value="black">
                            </div>

                            <!-- <div class="progress">
                                <div class="bar"></div >
                                <div class="percent">0%</div >
                            </div> -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="close_text_form" data-dismiss="modal">Annuler</button>
                            <button type="button" class="btn btn-primary" id="send_text">Valider</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>


                <!-- Modal Image-->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ajouter une image</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="{{ route('upload_image') }}" id="formulaire_image_upload" method="POST" enctype="multipart/form-data" style=" max-width: 500px; padding: 5px; margin: auto;">
                                @csrf

                                    <div class="form-group">
                                        <strong>image</strong>
                                        <input type="file" name="image_perso"  id="image_perso_client" class="form-control"  required>
                                    </div>
                                    <div class="progress">
                                        <div class="bar"></div >
                                        <div class="percent">0%</div >
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="close_form" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-primary" id="send_image">Valider</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        </div>
@endsection
