@php
     $query =  'SELECT * FROM arriere_plan_montre ; ' ;
       $arrierePlanMontres = DB::select($query);
       $query =  'SELECT * FROM position_image_perso ; ' ;
              $positionImagePersos = DB::select($query);
       $query =  'SELECT * FROM forme_montre ; ' ;
              $formeMontres = DB::select($query);

       $couleurIndexs = \App\CouleurIndex::get();

       $query =  'SELECT * FROM image_perso ; ' ;
              $imagePersos = DB::select($query);
       $query =  'SELECT * FROM taille_cadran ; ' ;
              $tailleCadrans = DB::select($query);
       $query =  'SELECT * FROM texte_montre ; ' ;
              $texteMontres = DB::select($query);
       $query =  'SELECT * FROM user ; ' ;
        $users = DB::select($query);

        $query =  'SELECT * FROM police ; ' ;
        $polices = DB::select($query);

@endphp



@push('js')
    <script defer src="{{ asset('js/alpine.js') }}" ></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('buildwatch', () => ({
                data: {
                    formeMontres: @json($formeMontres),
                    arrierePlanMontres: @json($arrierePlanMontres),
                    couleurIndexs: @json($couleurIndexs),
                    tailleCadrans: @json($tailleCadrans),
                    polices: @json($polices),
                    userConnecte: @json(auth()->user() ?: []),
                    watch: @json($watch ?? []),

                    uploadImageUrl: "{{ route('upload_image') }}",

                    etape: 1, // 1 formulaire montre 2 formulaire login 3 formulaire inscription

                    form: {
                        forme: '',
                        nom: '',
                        arrierePlan: '',
                        couleurIndex: '',
                        tailleCadran: '',
                        texte: {
                            contenu: '',
                            police: 'serif',
                            couleur: '#000'
                        },
                        previsualisation: '',
                        connection: {
                            email: 'rolandassale@aswebagency.com',
                            password: '12345678',
                            erreur: "",
                            errors: {}
                        },

                        inscription: {
                            nom: '',
                            prenoms: '',
                            contact: '',
                            email: '',
                            password: '',
                            password_confirmation: '',
                            erreur: {}
                        }
                    },
                },
                watch(){
                    this.$watch('data.form.arrierePlan', value => {
                        this.changerPrevisualisationArrierePlan("/uploads/arriere_plan_montre/"+ value)
                    })
                },
                init(){
                    // alert(this.editMode)
                    this.watch()

                    if (!this.editMode){
                        this.data.form.forme        = this.data.formeMontres[0].image_forme
                        this.data.form.arrierePlan  = this.data.arrierePlanMontres[0].image_arriere_plan
                        this.data.form.couleurIndex = this.data.couleurIndexs[0].image_couleur_index
                    }

                    if (this.editMode){
                        // console.log(this.data.watch.couleur_index.image_couleur_index);
                        this.data.form.couleurIndex = this.data.watch.couleur_index.image_couleur_index
                        this.data.form.forme = this.data.watch.forme_montre.image_forme
                        this.data.form.nom = this.data.watch.nom


                        if (!jQuery.isEmptyObject(this.data.watch.texte_fond)){
                            this.changerApparenceTexte(
                                this.data.watch.texte_fond.texte,
                                this.data.watch.texte_fond.police,
                                this.data.watch.texte_fond.couleur
                            )


                            this.changerTailleTexte( this.data.watch.texte_fond.taille)

                            this.changerPositionText('top', this.data.watch.texte_fond.positionX)
                            this.changerPositionText('left', this.data.watch.texte_fond.positionY)
                        }

                        if (!jQuery.isEmptyObject(this.data.watch.image_fond)){
                            console.log(this.data.watch.image_fond.image);
                            this.changerPrevisualisationArrierePlan(this.data.watch.image_fond.image)
                            this.changerPrevisualisationTailleOrange(this.data.watch.image_fond.taille.slice(0, -2)) // pour retirer le px à la fin
                            // console.log(this.data.watch.image_fond.image);
                            // this.data.form.forme = this.data.watch.image_fond.image
                        }else {
                            this.data.arrierePlanMontres[0].image_arriere_plan
                        }

                    }



                    // alert(this.data.uploadImageUrl)

                    console.log(this.$refs['previsualisation']);
                },
                get editMode(){
                    return !jQuery.isEmptyObject(this.data.watch)
                },
                choisirForme(event){
                    const forme = this.data.formeMontres.find(item => item.id_forme_montre == event.target.value)

                    if (!forme){
                        return
                    }
                    this.data.form.forme = forme.image_forme
                },
                choisirArrierePlan(event){
                    const arrierePlan = this.data.arrierePlanMontres.find(item => item.id_arriere_plan == event.target.value)

                    this.changerArrierePlan(arrierePlan.image_arriere_plan)
                },
                changerArrierePlan(url){
                    if (!url){
                        return
                    }

                    alert(url)

                    this.data.form.arrierePlan = url
                },
                choisirCouleurIndex(event){
                    const couleurIndex = this.data.couleurIndexs.find(item => item.id_couleur_index == event.target.value)

                    if (!couleurIndex){
                        return
                    }
                    this.data.form.couleurIndex = couleurIndex.image_couleur_index
                },
                choisirImage(event){

                    let file = event.target.files[0]

                    if (!file){
                        return
                    }

                    if (file.type && !file.type.startsWith('image/')) {
                        alert('File is not an image.', file.type, file);
                        return;
                    }

                    const reader = new FileReader();

                    reader.addEventListener('load', (event) => {
                        this.data.form.previsualisation = event.target.result;
                    });

                    reader.readAsDataURL(file);
                },
                ajouterImage(){
                    // upload de l'image sur le server
                    const image = this.$refs['imageMontre'].files[0]

                    if (!image){
                        return
                    }

                    const data = new FormData();
                    data.append('_token', jQuery('meta[name=csrf_token]').attr('content'));
                    data.append('image_perso', image);

                    // console.log(image);
                    jQuery.ajax({
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data,
                        url: this.data.uploadImageUrl,
                        success: ({image}) => {
                            console.log('success', image);
                            // this.changerArrierePlan("/uploads/image_perso/" + image)

                            this.changerPrevisualisationArrierePlan("/uploads/image_perso/" + image)
                            // this.$refs['previsualisation'].style.backgroundRepeat = "no-repeat"

                            this.cacherModalAjouterImage()

                            // this.$refs['previsualisation'].

                            // this.changerArrierePlan(this.data.form.previsualisation)
                        },
                        error(error){
                            // this.changerArrierePlan("/uploads/image_perso/" + image)
                            console.log('error', error);
                            this.cacherModalAjouterImage()
                        }
                    });
                    // this.cacherModalAjouterImage()

                    // this.changerArrierePlan(this.data.form.previsualisation)
                },
                annulerAjoutImage(){
                    this.data.form.previsualisation = '';
                    this.cacherModalAjouterImage()
                },
                augmenterTailleImage(){
                    const taille = parseInt(this.$refs['previsualisation'].style.backgroundSize.slice(0, -2), 10) + 20
                    this.changerPrevisualisationTailleOrange(taille)
                },
                reduireTailleImage(){
                    const taille = parseInt(this.$refs['previsualisation'].style.backgroundSize.slice(0, -2), 10) - 20
                    this.changerPrevisualisationTailleOrange(taille)
                },
                changerPositionImageVersHaut(){

                },
                changerPositionImageVersBas(){

                },
                changerPositionImageVersGauche(){

                },
                changerPositionImageVersDroite(){

                },
                changerPrevisualisationArrierePlan(chemin){
                    chemin = chemin.startsWith('url(') ? chemin : "url("+ chemin  +")"


                    this.$refs['previsualisation'].style.backgroundImage = chemin
                    this.$refs['previsualisation'].style.backgroundRepeat = "no-repeat"
                },
                changerPrevisualisationTailleOrange(taille){
                    this.$refs['previsualisation'].style.backgroundSize = taille + 'px'
                    this.$refs['previsualisation'].style.backgroundRepeat = "no-repeat"
                },
                cacherModalAjouterTexte(){
                    this.cacherModal('textModal')
                },
                cacherModalAjouterImage(){
                    this.cacherModal('imageModal')
                },
                cacherModal(ref){
                    bootstrap.Modal.getInstance(this.$refs[ref]).hide()
                },
                changerApparenceTexte(contenu, police, couleur){
                    this.data.form.texte.contenu = contenu
                    this.data.form.texte.police  = police
                    this.data.form.texte.couleur = couleur

                    this.$refs['textContenu'].style.fontFamily =  this.data.form.texte.police
                    this.$refs['textContenu'].style.color =  this.data.form.texte.couleur

                    const ajouterTexteForme = jQuery(this.$refs['ajouterTexteForme'])
                    ajouterTexteForme.find("[name=contenu]").val(contenu)
                    ajouterTexteForme.find("[name=police]").val(police)
                    ajouterTexteForme.find("[name=couleur]").val(couleur)
                },
                ajouterTexte(event){
                    // console.log(event);
                    let form = new FormData(event.target)


                    if (!form.get('contenu')){
                        this.cacherModalAjouterTexte()
                    }

                    this.changerApparenceTexte(form.get('contenu'), form.get('police'), form.get('couleur'))

                    // this.data.form.texte.contenu = form.get('contenu')
                    // this.data.form.texte.police  = form.get('police')
                    // this.data.form.texte.couleur = form.get('couleur')
                    // console.log(this.data.form.texte.police);

                    // this.$refs['textContenu'].style.fontFamily =  this.data.form.texte.police
                    // this.$refs['textContenu'].style.color =  this.data.form.texte.couleur

                    this.cacherModalAjouterTexte()

                    // console.log(this.$refs['textModal']);

                    // form.get('police')
                    // form.get('couleur')
                    // console.log(form.get('couleur'));
                    // debugger
                    // alert('submit')
                },
                changerTailleTexte(tailleAvecUnite){
                    this.$refs['textContenu'].style.fontSize = tailleAvecUnite
                },
                augmenterTailleTexte(){
                    const taille = parseInt(this.$refs['textContenu'].style.fontSize.slice(0, -2), 10) + 2
                    this.changerTailleTexte(taille + 'px')
                },
                reduireTailleTexte(){
                    const taille = parseInt(this.$refs['textContenu'].style.fontSize.slice(0, -2), 10) - 2
                    this.changerTailleTexte(taille + 'px')
                },

                changerPositionText(direction, valeur){
                    this.$refs['textContenu'].style[direction] = valeur
                },
                changerPositionTextVersHaut(){
                    let taille = parseInt(this.$refs['textContenu'].style['top'].slice(0, -1), 10) - 2

                    if (taille <= 0){
                        taille = 90;
                    }

                    this.changerPositionText('top', taille + '%')
                },
                changerPositionTextVersBas(){
                    let taille = parseInt(this.$refs['textContenu'].style['top'].slice(0, -1), 10) + 2 || 10

                    if (taille == 100){
                        taille = 10;
                    }
                    this.changerPositionText('top', taille + '%')
                },
                changerPositionTextVersGauche(){
                    let taille = parseInt(this.$refs['textContenu'].style['left'].slice(0, -1), 10) - 2

                    this.changerPositionText('left', taille + '%')
                },
                changerPositionTextVersDroite(){
                    let taille = parseInt(this.$refs['textContenu'].style['left'].slice(0, -1), 10) + 2

                    this.changerPositionText('left', taille + '%')
                },
                estUtilisateurConnecte(){
                    return this.data.userConnecte.id_user > 0
                },
                estEmailValide(email){
                    let regex = new RegExp("([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\"\(\[\]!#-[^-~ \t]|(\\[\t -~]))+\")@([!#-'*+/-9=?A-Z^-~-]+(\.[!#-'*+/-9=?A-Z^-~-]+)*|\[[\t -Z^-~]*])");

                    return regex.test(email);
                },
                estValideMotDePasse(password){
                    return password.length >= 6
                },
                get estValideFormulaireConnection(){
                    return this.estEmailValide(this.data.form.connection.email) &&
                            this.estValideMotDePasse(this.data.form.connection.email)
                },

                seInscrire(event){

                    const url = this.$refs['formulaireInscription'].getAttribute('action')

                    const data = new FormData();
                    data.append('_token', jQuery('meta[name=csrf_token]').attr('content'));
                    data.append('nom', this.data.form.inscription.nom);
                    data.append('prenoms', this.data.form.inscription.prenoms);
                    data.append('contact', this.data.form.inscription.contact);
                    data.append('email', this.data.form.inscription.email);
                    data.append('password', this.data.form.inscription.password);
                    data.append('password_confirmation', this.data.form.inscription.password_confirmation);


                    // console.log(data);

                    // alert(url)

                    // return

                    jQuery.ajax({
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data,
                        url,
                        success: (data) => {
                            this.data.userConnecte = data
                            this.afficherFormulaireDeMontre()
                            console.log('cacher formulaire inscr');
                        },
                        error: (data) => {
                            console.log(data.responseJSON.errors );
                            console.log(data.responseJSON.errors );
                            this.data.form.inscription.erreur = data.responseJSON.errors
                        }
                    });
                },

                seConnecter(event){

                    if (!this.estValideFormulaireConnection){
                        return
                    }

                    const url = this.$refs['formulaireConnection'].getAttribute('action')
                    const data = new FormData();
                    data.append('_token', jQuery('meta[name=csrf_token]').attr('content'));
                    data.append('email', this.data.form.connection.email);
                    data.append('password', this.data.form.connection.password);

                    jQuery.ajax({
                        method: "POST",
                        processData: false,
                        contentType: false,
                        data,
                        url,
                        success: (data) => {
                            this.data.userConnecte = data
                            this.afficherFormulaireDeMontre()
                        },
                        error: (error) => {
                            this.data.form.connection.erreur = true
                        }
                    });
                },

                enregistrerMontre(event){

                    if (!confirm('Avez vous terminé de personnaliser la montre')){
                        return
                    }

                    if (!this.estUtilisateurConnecte()){
                        // alert('user not connected')
                        this.afficherFormulaireDeConnection()
                        return
                    }

                    // verifier si le user est connecte

                    const form = event.target

                    this.ajouterAuFormulaire(form, 'id_user', this.data.userConnecte.id_user)

                    this.ajouterAuFormulaire(form, 'texte_fond', this.convertirEnChaine({
                        texte: this.data.form.texte.contenu,
                        police: this.data.form.texte.police,
                        couleur: this.data.form.texte.couleur,
                        taille:  this.$refs['textContenu'].style.fontSize,
                        positionX:  this.$refs['textContenu'].style.top,
                        positionY: this.$refs['textContenu'].style.left,
                    }))

                    this.ajouterAuFormulaire(form, 'image_fond', this.convertirEnChaine({
                        image: this.$refs['previsualisation'].style.backgroundImage,
                        taille: this.$refs['previsualisation'].style.backgroundSize,
                    }))

                    form.submit()
                },
                convertirEnChaine(data) {
                    return JSON.stringify(data)
                },
                afficherFormulaireDeConnection(){
                    this.data.etape = 2
                },
                afficherFormulaireDeInscription(){
                    this.data.etape = 3
                },
                afficherFormulaireDeMontre(){
                    this.data.etape = 1
                },
                ajouterAuFormulaire(form, name, data){
                    const input  = document.createElement('input')
                    input.type   = 'hidden'
                    input.name   = name
                    input.value  = data
                    form.appendChild(input)
                },
                get forme_image(){
                    return '/uploads/forme_montre/' + this.data.form.forme
                },
                get arriere_plan_image(){
                    return '/uploads/arriere_plan_montre/' + this.data.form.arrierePlan
                },
                get index_image(){
                    const url = this.data.form.couleurIndex

                     return '/uploads/couleur_index/' + url
                }
            }))
        })
    </script>
@endpush
<div class="row" x-data="buildwatch">


<div class="col-md-6">
    <div class="card" x-show='data.etape == 1'>
        <div class="card-body">
            <div class="alert alert-success" x-show="estUtilisateurConnecte">
                Connection effectuée avec succès <b x-text="data.userConnecte.nomComplet"></b>. Veuillez enregistrer la montre à nouveau.
            </div>


            @if(isset($watch) && $watch->getKey())
            <form @submit.prevent="enregistrerMontre" action="{{ route('user.dashboard.watch.update', $watch) }}" method="post" x-ref="enregisterMontreClient">
                @method('PUT')
                @else
            <form @submit.prevent="enregistrerMontre" action="{{ route('enregister_montre_client') }}" method="post" x-ref="enregisterMontreClient">
                @endif
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="">Nom</label>
                            <input type="text" x-model="data.watch.nom" name="nom" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="formeMontre">formeMontre</label>
                            <select name="id_forme_montre" id="formeMontre" class="form-control" @change="choisirForme">
                                <template x-for="formeMontre in data.formeMontres">
                                    <option :value="formeMontre.id_forme_montre" x-text="formeMontre.libelle_forme"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">arrière Plan</label>
                            <select name="id_arriere_plan" class="form-control" @change="choisirArrierePlan">
                                <template x-for="arrierePlanMontre in data.arrierePlanMontres">
                                    <option :value="arrierePlanMontre.id_arriere_plan" x-text="arrierePlanMontre.nom_arriere_plan"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">index</label>
                            <select name="id_couleur_index" class="form-control" @change="choisirCouleurIndex">
                                <template x-for="couleurIndex in data.couleurIndexs">
                                    <option :value="couleurIndex.id_couleur_index" x-text="couleurIndex.nom_couleur"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">tailleCadran</label>
                            <select name="id_taille_cadran"  id="" class="form-control">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-12 text-center">
                        <label>Taille de l'image</label>
                        <div>
                            <button @click.prevent="reduireTailleImage" type="button" class="btn btn-secondary"> - </button>
                            <button @click.prevent="augmenterTailleImage" type="button" class="btn btn-primary"> + </button>
                        </div>
                    </div>
                    {{-- <div class="col-6 text-center">
                        <label>Position de l'image</label>
                        <div>
                            <button @click.prevent="changerPositionImageVersHaut" type="button" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"></path>
                                </svg>
                            </button>
                            <button @click.prevent="changerPositionImageVersBas" type="button" class="btn btn-secondary" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"></path>
                                    </svg>
                            </button>
                            <button @click.prevent="changerPositionImageVersGauche" type="button" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
                                </svg>

                            </button>
                            <button @click.prevent="changerPositionImageVersDroite" type="button" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                </svg>

                            </button>
                        </div>
                    </div> --}}

                    <div class="col-6 text-center mt-3">
                        <label>Taille du texte</label> &nbsp;&nbsp;&nbsp;
                        <div>
                            <button @click.prevent="reduireTailleTexte" type="button" class="btn btn-primary" > - </button>
                            <button @click.prevent="augmenterTailleTexte" type="button" class="btn btn-secondary">+- </button>
                        </div>
                    </div>
                    <div class="col-6 text-center mt-3">
                        <label>Position du texte</label> &nbsp;&nbsp;&nbsp;

                        <div>
                            <button @click.prevent="changerPositionTextVersHaut" type="button" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"></path>
                                </svg>
                            </button>
                            <button @click.prevent="changerPositionTextVersBas" type="button" class="btn btn-secondary" >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"></path>
                                    </svg>
                            </button>
                            <button @click.prevent="changerPositionTextVersGauche" type="button" class="btn btn-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"></path>
                                </svg>

                            </button>
                            <button @click.prevent="changerPositionTextVersDroite" type="button" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                </svg>

                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <hr>
                    <div class="col-12 mt-2">
                        <div class="d-flex justify-content-between">
                                <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#imageModal">
                                Ajouter une image
                                </button>
                                <!-- Button trigger modal -->
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#texteModal">
                                Ajouter du texte
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2 text-center">
                        <hr>
                            <button  type="submit" class="btn btn-success">
                                Enregistrer la montre
                            </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card" x-show='data.etape == 2'>
        <div class="card-body">
            <p class="alert alert-info">
                Merci de vous connecter afin de poursuivre votre achat.
            </p>
            <p class="alert alert-danger" x-show="data.form.connection.erreur">
                Email ou mot de passe incorrects
            </p>
            <form x-ref="formulaireConnection"  action="{{ route('user.login') }}" method="post">
                <div class="mb-3">
                    <label>Email</label>
                    <input x-model="data.form.connection.email" type="text" :class="!estEmailValide(data.form.connection.email) && 'is-invalid'" class="form-control">
                    <div class="invalid-feedback">
                        Email invalid
                    </div>
                </div>
                <div class="mb-3">
                    <label>Mot de passe</label>
                    <input x-model="data.form.connection.password" type="password" :class="data.form.connection.password.length < 6 && 'is-invalid'" class="form-control">
                    <div class="invalid-feedback">
                        Le mot de passe doit faire au moins 6 caracteres
                    </div>
                </div>
                <div class="d-flex justify-content-end mb-3">
                    <button @click.prevent="afficherFormulaireDeInscription" type="button" class="btn btn-link">S'inscrire</button>
                </div>
                <div class="mb-3 text-center">
                    <button @click.prevent="seConnecter" type="button" :disabled="!estValideFormulaireConnection" class="btn btn-primary btn-block">Se connecter</button>
                </div>
            </form>

        </div>
    </div>
    <div class="card" x-show='data.etape == 3'>
        <div class="card-body">
            <p class="alert alert-info">
                Veuillez remplir ce formulaire pour vous inscrire
                Merci de vous connecter afin de poursuivre votre achat.
            </p>
            {{-- <p x-text="JSON.stringify(data.form.inscription)"></p> --}}
            <div class="alert alert-danger" x-show="!jQuery.isEmptyObject(data.form.inscription.erreur)">
                <ul>
                    <template x-for="erreur in data.form.inscription.erreur">
                        <li x-text="erreur[0]"></li>
                    </template>
                </ul>
            </div>
            <form  x-ref="formulaireInscription" action="{{ route('user.register') }}" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Nom</label>
                            <input x-model="data.form.inscription.nom" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label>Prenoms</label>
                            <input x-model="data.form.inscription.prenoms" type="text" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input x-model="data.form.inscription.email" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Contact</label>
                    <input x-model="data.form.inscription.contact" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Mot de passe</label>
                    <input x-model="data.form.inscription.password" type="password" class="form-control">
                </div>
                <div class="mb-3">
                    <label>Confirmation Mot de passe</label>
                    <input  x-model="data.form.inscription.password_confirmation"type="password" class="form-control">
                </div>

                <div class="d-flex justify-content-end mb-3">
                    <button @click.prevent="afficherFormulaireDeConnection" type="button" class="btn btn-link">Se connecter</button>
                </div>

                <div class="mb-3">
                    <button  @click.prevent="seInscrire" type="button" class="btn btn-success btn-block">S'inscrire</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card">
        <div class="card-body text-center">
            {{-- background: url('/uploads/arriere_plan_montre/20221024013304.jpg'); --}}
            <div style="position: relative;   width: 400px;background-position: center;
            background-size: 400px; overflow: hidden" x-ref="previsualisation">
                <img :src="forme_image" clas="img-fluid" alst="forme" style="width: 400px; positcion: relative" id="img_forme_montre">
                <img :src="index_image" style="width: 310px; position: absolute;left: 36px; top: 60px;" id="img_index" >


                <p x-ref="textContenu"
                    x-text='data.form.texte.contenu'
                    style="width: 80%; position: absolute;left: 10%;  top:45%; font-weight: 900; font-size: 20px;"></p>
                {{-- <img src="arriere_plan_image" style="width: 70%; position: absolute;left: 50px; top: 45px;" id="img_index" > --}}
            </div>

            <br>
            <br>
            <br>
            <br>

        </div>
    </div>

</div>


<div class="modal fade" x-ref="textModal" id="texteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter du texte</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="ajouterTexte" method="POST" x-ref="ajouterTexteForme" id="ajouterTexteForme">
                    <div class="mb-3">
                        <label>Texte</label>
                        <textarea name="contenu" class="form-control"></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Style de texte:</label>
                        <select class="form-contol" name="police">
                            <option value="" >
                            @foreach($polices as $police)
                                <option value="{{$police->valeur_police}}">{{$police->valeur_police}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Couleur du texte</label>
                        <input type="color" class="form-control" name="couleur" value="#000">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"  data-dismiss="modal">Annuler</button>
                <button type="submit" form="ajouterTexteForme" class="btn btn-primary" data-dismiss="modal">Valider</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" x-ref="imageModal" id="imageModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter une image</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label for="imageMontre">Choisir l'image</label>
                        <input @input="choisirImage" type="file" x-ref="imageMontre" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <template x-if="data.form.previsualisation">
                            <img :src="data.form.previsualisation"  class="img-fluid" alt="">
                        </template>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button @click.prevent="annulerAjoutImage" type="button" class="btn btn-secondary">Annuler</button>
                <button @click.prevent="ajouterImage" type="submit"  class="btn btn-primary">Valider</button>
            </div>
        </div>
    </div>
</div>
</div>
