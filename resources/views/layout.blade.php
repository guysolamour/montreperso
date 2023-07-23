<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <meta name="SITEURL" content="{{ URL('/') }}">
        <meta name="csrf_token" content="{{ csrf_token() }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <title>montrePerso</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap Icons-->
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" /> --}}
        <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet" />
        <!-- Google fonts-->
        {{-- <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" /> --}}
        <link href="{{ asset('css/merriweathergfonts.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/merriweathergfontitalic.css') }}" rel="stylesheet" type="text/css" />
        {{-- <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" /> --}}
        <!-- SimpleLightbox plugin CSS-->
        <link href="{{ asset('css/simpleLightbox.css') }}" rel="stylesheet" />
        {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" /> --}}
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href=" {{ asset('css/styles.css')}}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/bootstrap5.css') }}">
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> --}}

        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script> -->
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

        @stack('css')
        <style>
            .progress { position:relative; width:100%; }
            .bar { background-color: #b5076f; width:0%; height:20px; }
            .percent { position:absolute; display:inline-block; left:50%; color: #040608;}
        </style>

    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="/">montrePerso</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0">
<!--
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Collecteurs
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li class="nav-item"><a class="nav-link" href="{{ route('arriere_plan_horloge.index') }}">ArrierePlanHorloge</a></li>
                        <a class="dropdown-item" href="">Liste des Collecteurs</a>

                    </li> -->



                        <li class="nav-item"><a class="nav-link" href="{{ route('arriere_plan_horloge.index') }}">ArrierePlanHorloge</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('arriere_plan_montre.index') }}">ArrierePlanMontre</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('couleur_bracelet.index') }}">CouleurBracelet</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('couleur_index.index') }}">CouleurIndex</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('forme_horloge.index') }}">FormeHorloge</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('forme_montre.index') }}">FormeMontre</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('horloge_client.index') }}">HorlogeClient</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('image_perso.index') }}">ImagePerso</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('montre_client.index') }}">MontreClient</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('montre_perso_index.index') }}">MontrePersoIndex</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('police.index') }}">Police</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('position_image_perso.index') }}">PositionImagePerso</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('position_texte.index') }}">PositionTexte</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('taille_cadran.index') }}">TailleCadran</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('texte_horloge.index') }}">TexteHorloge</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('texte_montre.index') }}">TexteMontre</a></li>


                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="amasthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">

                </div>
            </div>
        </header>


        <div class="container" style="margin-top:90px ;">
            @yield('content')
        </div>

        <!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container px-4 px-lg-5"><div class="small text-center text-muted">Copyright &copy; 2022 - Company Name</div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap5.js') }}"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
        {{-- <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> --}}
        <!-- SimpleLightbox plugin JS-->
        <script src="{{ asset('js/simpleLightbox.js') }}"></script>
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script> --}}
        <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}" ></script>
        {{-- <script src="{{asset('js/Melagne_scripts.js')}}" ></script> --}}
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script  src="{{ asset('js/sbForm.js') }}"></script>
        {{-- <script  src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script> --}}


        <!-- Script Melagne -->
        <!-- <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
        {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
        <!-- Script ajaxForm -->
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script> --}}


        @stack('js')
        <!-- Script ajaxForm -->

        	     <!-- Mon code jQuery  -->
	  <script type="text/JavaScript">
        var SITEURL = "{{URL('/')}}";

        // $(function() {
        //     $(document).ready(function()
        //     {

                //alert(1);


        // $('#send_image').click(function(){

        //     // alert(122);
        //     $.ajax({

        //         url: SITEURL+'/'+'upload_image',
        //         method: "POST",
        //         data: {
        //             '_token': jQuery('meta[name=csrf_token]').attr('content'),
        //             image_perso: $('#image_perso_client').val(),
        //         },
        //         success: function(data) {
        //             alert('ok');
        //                    // ... do something with the data...
        //                  }
        //     });
        // });

                // var bar = $('.bar');
                // var percent = $('.percent');

        // $('form').ajaxForm({
        //     beforeSend: function() {
        //         var percentVal = '0%';
        //         bar.width(percentVal)
        //         percent.html(percentVal);
        //     },
        //     uploadProgress: function(event, position, total, percentComplete) {
        //         var percentVal = percentComplete + '%';
        //         bar.width(percentVal)
        //         percent.html(percentVal);
        //     },
        //     complete: function(xhr) {
        //         alert(xhr.responseText);
        //         //window.location.href = SITEURL +"/"+"upload";
        //     }
        // });
        // });
        // });

        </script>
    </body>
</html>
