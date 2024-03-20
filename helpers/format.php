<?php
class Format{
    public function formatDate($date){
        return date('F j, Y, g:i a', strtotime($date));
    }

    public function textshorten($text,$limit){
        
        $text = $text . " ";
        $text = substr($text,0,$limit);
        $text = substr($text,0,strrpos($text, ' '));
        $text = $text . "....";
        return $text;
    }

    public function textshortenAd($text,$limit){
        
        $text = $text . " ";
        $text = substr($text,0,$limit);
        $text = substr($text,0,strrpos($text, ' '));
        
        return $text;
    }

    public function validation($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripcslashes($data);
        return $data;
    }

    public function title(){
            $path = $_SERVER['SCRIPT_FILENAME'];
            $title = basename($path,'.php');
            if($title=='index'){
                $title = "Home";
            }
            else if($title=='contact'){
                $title = "Contact";
            }
            return $title;
    }
    
}

?>