// alert(1);

$(document).ready(function(){
   
      
    SITEURL = jQuery('meta[name=SITEURL]').attr('content')
   
    // Changement de la forme de la montre
    $('#id_forme_montre').change(function(){

        //alert($('#product_id').val());
        id_forme_montre = $('#id_forme_montre').val();
        if(id_forme_montre!=""){

            //on compose la forme sélectionnée
            ma_chaine='#id_forme_montre option[value="'+id_forme_montre+'"]'
            image_forme = $(ma_chaine).attr('image_forme');
            image_forme_src = SITEURL+"/"+"uploads/forme_montre/"+image_forme
            // Changement de l'image
            $('#img_forme_montre').attr('src',image_forme_src);
        }

    });

        // Changement de l' arriere_plan de la montre
        $('#id_arriere_plan').change(function(){

            //alert($('#product_id').val());
            id_arriere_plan = $('#id_arriere_plan').val();
          
            if(id_arriere_plan!=""){
    
                //on compose la forme sélectionnée
                ma_chaine='#id_arriere_plan option[value="'+id_arriere_plan+'"]'
                image_arriere_plan = $(ma_chaine).attr('image_arriere_plan');
                image_arriere_plan_src = SITEURL+"/"+"uploads/arriere_plan_montre/"+image_arriere_plan
                // alert(image_arriere_plan_src);
                // Changement de l'image
                $('#img_arriere_plan').attr('src',image_arriere_plan_src);
            }
    
        });

         // Changement de l' index de la montre
        $('#id_couleur_index').change(function(){

            //alert($('#product_id').val());
            id_couleur_index = $('#id_couleur_index').val();
          
            if(id_couleur_index!=""){
    
                //on compose la forme sélectionnée
                ma_chaine='#id_couleur_index option[value="'+id_couleur_index+'"]'
                image_couleur_index = $(ma_chaine).attr('image_couleur_index');
                image_couleur_index_src = SITEURL+"/"+"uploads/couleur_index/"+image_couleur_index
                // alert(image_arriere_plan_src);
                // Changement de l'image
                $('#img_index').attr('src',image_couleur_index_src);
            }
    
        });

        var bar = $('.bar');
        var percent = $('.percent');

        $('#formulaire_image_upload').ajaxForm({

            beforeSend: function() {
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            complete: function(xhr) {

                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        var data=xhr.responseText;
                        var jsonResponse = JSON.parse(data);
                    
                        $('#close_form').trigger('click');

                        image_upload = jsonResponse["image"];
                        image_perso_src = SITEURL+"/"+"uploads/image_perso/"+image_upload
                    
                        $('#img_image_perso').attr('src',image_perso_src);
                        
                    }else{
                        alert(xhr.responseText);
                    }
                }
                // alert(xhr.responseText);
                
            }
        });
        // alert(122);
        $('#image_perso_client').change(function(){
            $('#formulaire_image_upload').submit();
        });

        $('#send_text').click(function(){
            
           text = $('#text_perso_client').val()
           //parse; 
          // alert ($('#text_perso_client').text()); 
            // $('#texte_montre').html("<b>"+text+"</b>"); 
            
            // $('#texte_montre').html(text); 
            // $('#texte_montre').css('font-family',$('#text_perso_client').css('font-family'));   
            // $('#texte_montre').css('color',$('#text_perso_client').css('color'));   

            
            $('#texte_montre_content').val(text); 
            $('#texte_montre_content').css('font-family',$('#text_perso_client').css('font-family'));   
            $('#texte_montre_content').css('color',$('#text_perso_client').css('color'));   
            $('#close_text_form').trigger('click');           
       
        });
        $('#imageTailleMoins').click(function(){
            // taille = $('#img_image_perso').css('width');
            // text = $('#img_image_perso').css('width'); 
            taille =document.getElementById('img_image_perso').width;
            //document.getElementById('img_image_perso').style.width = 50;
            taille-=10
            $('#img_image_perso').css('width',taille);
            // alert(taille-10)    ;        
        
         });

         $('#imageTaillePlus').click(function(){
            // taille = $('#img_image_perso').css('width');
            // text = $('#img_image_perso').css('width'); 
            taille =document.getElementById('img_image_perso').width;
            //document.getElementById('img_image_perso').style.width = 50;
            taille+=10
            $('#img_image_perso').css('width',taille);
            // alert(taille-10)    ;        
        
         });
         // Position de l'image
         $('#Image_Pull_Up').click(function(){
          
            css_top_value = document.getElementById('img_image_perso_div').style.top;
            string_end = css_top_value.length -2;
            css_top_value_int = css_top_value.substring(0, string_end);
            css_top_value_int = parseInt(css_top_value_int);
            css_top_value_int -=10; 
            document.getElementById('img_image_perso_div').style.top = css_top_value_int+"px";
        
        
         });

         $('#Image_Pull_Down').click(function(){
          
            css_top_value = document.getElementById('img_image_perso_div').style.top;
            string_end = css_top_value.length -2;
            css_top_value_int = css_top_value.substring(0, string_end);
            css_top_value_int = parseInt(css_top_value_int);
            css_top_value_int +=10; 
            document.getElementById('img_image_perso_div').style.top = css_top_value_int+"px";
        
        
         });

         $('#Image_Pull_Left').click(function(){
          
            css_left_value = document.getElementById('img_image_perso_div').style.left;
            // alert(css_left_value);
            string_end = css_left_value.length -2;
            css_left_value_int = css_left_value.substring(0, string_end);
            css_left_value_int = parseInt(css_left_value_int);
            css_left_value_int -=10; 
            document.getElementById('img_image_perso_div').style.left = css_left_value_int+"px";
        
         });

         $('#Image_Pull_Right').click(function(){
          
            css_left_value = document.getElementById('img_image_perso_div').style.left;
            // alert(css_left_value);
            string_end = css_left_value.length -2;
            css_left_value_int = css_left_value.substring(0, string_end);
            css_left_value_int = parseInt(css_left_value_int);
            css_left_value_int +=10; 
            document.getElementById('img_image_perso_div').style.left = css_left_value_int+"px";
        
         });

         //Fin position de l'image


         $('#texteTailleMoins').click(function(){
            //alert(document.getElementById("texte_montre").style.fontSize);
           // return;
          
            css_fontSize_value = document.getElementById('texte_montre').style.fontSize;
            // alert(css_fontSize_value);
            string_end = css_fontSize_value.length -2;
            css_fontSize_value_int = css_fontSize_value.substring(0, string_end);
            css_fontSize_value_int = parseInt(css_fontSize_value_int);
            css_fontSize_value_int -=10; 
            document.getElementById('texte_montre').style.fontSize = css_fontSize_value_int+"px";
        
         });

         
         $('#texteTaillePlus').click(function(){
            //alert(document.getElementById("texte_montre").style.fontSize);
           // return;
          
            css_fontSize_value = document.getElementById('texte_montre').style.fontSize;
            // alert(css_fontSize_value);
            string_end = css_fontSize_value.length -2;
            css_fontSize_value_int = css_fontSize_value.substring(0, string_end);
            css_fontSize_value_int = parseInt(css_fontSize_value_int);
            css_fontSize_value_int +=10; 
            document.getElementById('texte_montre').style.fontSize = css_fontSize_value_int+"px";
        
         });

        //Position du text

         $('#Text_Pull_Up').click(function(){
          
            css_top_value = document.getElementById('texte_montre').style.top;
            string_end = css_top_value.length -2;
            css_top_value_int = css_top_value.substring(0, string_end);
            css_top_value_int = parseInt(css_top_value_int);
            css_top_value_int -=10; 
            document.getElementById('texte_montre').style.top = css_top_value_int+"px";
        
        
         });

         $('#Text_Pull_Down').click(function(){
          
            css_top_value = document.getElementById('texte_montre').style.top;
            string_end = css_top_value.length -2;
            css_top_value_int = css_top_value.substring(0, string_end);
            css_top_value_int = parseInt(css_top_value_int);
            css_top_value_int +=10; 
            document.getElementById('texte_montre').style.top = css_top_value_int+"px";
        
        
         });

         $('#Text_Pull_Left').click(function(){
          
            css_left_value = document.getElementById('texte_montre').style.left;
            // alert(css_left_value);
            string_end = css_left_value.length -2;
            css_left_value_int = css_left_value.substring(0, string_end);
            css_left_value_int = parseInt(css_left_value_int);
            css_left_value_int -=10; 
            document.getElementById('texte_montre').style.left = css_left_value_int+"px";
        
         });

         $('#Text_Pull_Right').click(function(){
          
            css_left_value = document.getElementById('texte_montre').style.left;
            // alert(css_left_value);
            string_end = css_left_value.length -2;
            css_left_value_int = css_left_value.substring(0, string_end);
            css_left_value_int = parseInt(css_left_value_int);
            css_left_value_int +=10; 
            document.getElementById('texte_montre').style.left = css_left_value_int+"px";
        
         });

        //Fin Position du text


         $('#id_police').change(function(){

           
                font_value = $("#id_police option:selected").text();
                $('#text_perso_client').css('font-family',font_value);

           
            // $( "#id_police option:selected" ).each(function() {
            //     //str += $( this ).text() + " ";
            //     //alert($(this).text());
            //     font_value = $(this).text();
            //     $('#text_perso_client').css('font-family',font_value);

                
            //   } );

            
        });

        $('#text_color').change(function(){

            //alert($(this).val());
            font_color_value = $(this).val();
            $('#text_perso_client').css('color',font_color_value);
        
        });
        

        $('#id_forme_montre').change(function(){

               
            //On vide la liste des indexs si la forme selectionnée est vide
            if($('#id_forme_montre').val()==""){
                $('#id_couleur_index').html("");

            }
            SITEURL = jQuery('meta[name=SITEURL]').attr('content')
            

            // site_url = SITEURL+"/list_index/"+$(this).val()
            site_url = SITEURL+"/list_index/"+$('#id_forme_montre').val();
            // alert( site_url);
            // alert( $('#formulaire_montre').html());


            jQuery.ajax({
                method: "GET",
                data: {
                    //'_method': 'PUT',
                    '_token': jQuery('meta[name=csrf_token]').attr('content'),
                    // avatar: e.target.result,
                },
                url: site_url,
                success: (data) => {
                    $('#id_couleur_index').html(data);
                    
                    //alert(data);

                },
                error(data){
                    
                    //alert(data);
                    

                }
            });


    
    });
         
        $('#formulaire_montre').submit(function(){

                
    
                const form =  $('#formulaire_montre')
    
                alert( $('#formulaire_montre').html());

    
                jQuery.ajax({
                    method: "POST",
                    data: form.serialize(),
                    url: form.attr('action'),
                    success: (data) => {
                   
                        alert(data);
    
                    },
                    error(data){
                        
                        alert(data);
                        
    
                    }
                });
    
    
        
        });

        



         

});