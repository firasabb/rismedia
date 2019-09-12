<?php

/*

    Firas Abbas

*/



class Controller{


    // Show files in the log folder => index.php

    public function index_files($dir){

        $files = scandir($dir, 1);
        foreach($files as $key => $value){
            if(substr($value, -3) != 'log'){
                unset($files[$key]);
            }
        }
        return $files;

    }


    // Read the chosen file from the log folder
    // It also deletes the empty lines

    public function read_file($file){

        $file = "logs/" . $file;
        $readFile = fopen($file, 'r');
        $lines = array();
        if($readFile){
            while(!feof($readFile)) {
                $line = fgets($readFile);
                $line = htmlentities($line);
                $lineArr = preg_split('/[\s,]+/', $line);
                foreach($lineArr as $key => $value){
                    if(!$value || $value == '' || $value == ' '){
                        unset($lineArr[$key]);
                    }
                }
                if(empty($lineArr)){
                    unset($lineArr);
                } else {
                    array_push($lines, $lineArr);
                }
            }
            fclose($readFile);
        }
        return $lines;
    }


    // Count how many emails bounced VS deferred

    public function bounces_count($file){
        
        $lines = $this->read_file($file);
        $bounces = 0;
        $deferred = 0;
        $lines_number = 0;
        foreach($lines as $key => $line){
            foreach($line as $key => $text){
                if(strpos($text, 'bounced') != null){
                    $bounces += 1;
                }elseif(strpos($text, 'deferred') != null){
                    $deferred += 1;
                }
            }
        }
        $arr = Array('bounces' => $bounces, 'deferred' => $deferred);
        return $arr ;
    }


    // Show only the bounced emails

    public function bounced_only($file){

        $lines = $this->read_file($file);
        $bouncedOnly = array();
        foreach($lines as $line){
            foreach($line as $key => $value){
                if(strpos($value, 'bounced') != null){
                    array_push($bouncedOnly, $line);
                }
            } 
        }
        return $bouncedOnly;
    }


    // find the wanted keyword in the log line and replace it

    public function findAndReplace($line, $keyword, $keyword_2 = null){

        foreach($line as $key => $value){ 
            if(preg_match('/' . $keyword . '/', $value) != false){
                $value = preg_replace(array('/' . $keyword . '/', '/' . $keyword_2 . '/'), '', $value);
                echo $value;
            }
        }
    }

}
?>