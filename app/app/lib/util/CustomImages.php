<?php
class CustomImages
{
   
    public static function compress($source, $destination, $quality=75)
    {
        //Get file extension
        $exploding = explode(".",$source);
        $ext = end($exploding);
        $finfo         = new finfo(FILEINFO_MIME_TYPE);
        switch ($finfo->file($source)) 
        {
            case 'image/jpeg':
                $img = imagecreatefromjpeg($source);
                break;
            case 'image/webp':
                $img = imagecreatefromwebp($source);
                break;
            case 'image/png':
                $img = imagecreatefrompng($source);
                break;
            default:
                throw new Exception('Formato não suportado.');
                break;
        }   
    
//         switch($ext){
//             case "png":
//                 $img = imagecreatefrompng($source);
//             break;
//             case "jpeg":
//             case "jpg":
//                 $img = imagecreatefromjpeg($source);
//             break;
//             case "gif":
//                 $img = imagecreatefromgif($source);
//             break;
//              case "webp":
//                  $img = imagecreatefromwebp($source);
//                  break;
//             default:
//                 $img = imagecreatefromjpeg($source);
//             break;
//         }
    
        imagepalettetotruecolor($img);
        imagealphablending($img, true);
        imagesavealpha($img, true);
        //imagewebp($img, $destination, $quality);
        
        imagejpeg($img, $destination, $quality);
        imagedestroy($img);
    
        return $destination;
              
    }
}


