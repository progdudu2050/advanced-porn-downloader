<?php
if(@!isset($argv[1])){
    $categoria = 1;
}
else {
    $categoria = $argv[1];
}

if(@!isset($argv[2])){
    $pages = 1;
}
else {
    $pages = $argv[2];
}
for($i=0; $i<=$pages; $i++){
    if($i == 0){
        $url = $argv[4];
    }
    else {
        $url = $argv[5];
    }
    $saida = file_get_contents($url.$i);
//var_dump($saida);
    @$saida = explode('<div class="mozaique', $saida);
 //   @$saida = explode('<div class="pagination ">', $saida[1]);
    $urls = explode("a href=\"", $saida[1]);
    $diretorio_download = $argv[3];
    // echo "<pre>";
    $ultimo = "";
//var_dump($urls);
    foreach($urls as $url){
        // var_dump($url);
        $comeco = substr($url, 0, 6);
        // var_dump($comeco);
        if($comeco == '/video'){
            $url_formatada = explode('"', $url);
            $url_formatada = $url_formatada[0];
            if($url_formatada != $ultimo){
                // var_dump($url_formatada);
                $quebra_url = explode("/", $url_formatada);
                foreach($quebra_url as $url_123){
                    $ultima_url = str_replace(" ", "_",$url_123);
                }
                // var_dump($ultima_url);
                if(strlen($ultima_url) > 78){
                    $ultima_url = substr($ultima_url, 0, 77).'...';
                }

                if(@!file_exists($diretorio_download.'/'.$ultima_url.'.mp4')){
                    $url_completa = "\"https://www.xvideos.com$url_formatada\"";
                    // echo "Baixei $url_completa";
                    // $comando = __DIR__.'/download.sh "'.$diretorio.'" "'.$url_completa.'" "'.$ultima_url.'"';
                    // $executar = shell_exec($comando);

                    echo str_replace('"', "",$url_completa)."\n";




                }



            }

            $ultimo = $url_formatada;
        }
    }

}
