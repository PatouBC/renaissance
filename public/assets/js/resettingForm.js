$(document).ready(function(){

    $('#fos_user_resetting_form_plainPassword_first').keyup(function (){
            var validated = true;

            if(this.value.length < 8){
                validated = false;
                if(!/\d/.test(this.value)){
                    validated = false;
                    if(!/[a-z]/.test(this.value)){
                        validated = false;
                        if(!/[A-Z]/.test(this.value)){
                            validated = false;{
                                if(/[^0-9a-zA-Z]/.test(this.value))
                                    validated = false;
                            }
                        }
                    }
                }
            }
            $('.message').text(validated ? "Mot de passe valide" : "Votre mot de passe doit contenir 8 caractères avec au moins une majuscule et un chiffre ");

            if(validated){
                $('.message').attr('style', 'color:green')
            }else{
                $('.message').attr('style', 'color:red')
            }
    });
});

