<?php
    
    //PUXANDO A FOTO

    function imagens($item){
        $foto = $item['name'];
        $tamanho_foto = $item['size'];
        $tamanho_foto = round($tamanho_foto/1024);
        $ext_foto = strrchr($foto, ".");
        $nome_foto = pathinfo($foto, PATHINFO_FILENAME);
        $nome_foto = md5(uniqid(time()).$nome_foto);
        $diretorio = "upload/";
        $extensao = array(".jpg",".png",".jpeg");
        
        
        //ESTA PARTE AINDA NÃO ESTA PRONTA CHAME O PROFESSOR DPS DE ENTENDER O POR QUE NÃO DEU CERTO
        
        if(in_array($ext_foto, $extensao)){
            if($tamanho_foto<=2000){
                $foto_tmp = $item['tmp_name'];
                $arquivo = $diretorio.$nome_foto.$ext_foto;
                
                if(move_uploaded_file($foto_tmp, $arquivo)){
                    
                    return $arquivo;
                    
                }else{
                    $arquivo = null;
                    return $arquivo;
                }
            }
        }
    }
        
        

?>
