function Validar(caracter, type, campo){
                
            document.getElementById(campo).style='background-color: #ffffff;';
                
                if(window.event)
                    
                    //Guarda o ascii da letra digitada pelo usuario
                    
                    var letra = caracter.charCode;
                else
                    var letra = caracter.which;
                
                if(type=='number'){
                    
                    if(letra>=48 && letra<=57){
                        
                    document.getElementById(campo).style='background-color: #fcb0b0;';
                    //cancela a acão da tecla
                    return false;
                    }
                    
                }else if(type == 'caracter'){
                    if(letra < 48 || letra > 57){
                        document.getElementById(campo).style='background-color: #fcb0b0;';
                    //cancela a acão da tecla
                    return false;}
                }
                
            }