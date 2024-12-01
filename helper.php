<?php 
if(!function_exists('require_file')){
    function require_file($pathFolder){
    //    $files = scandir($pathFolder) ; //hàm load các file 
    //    $files =array_diff($files,['.','..']) ;

     $files =array_diff(scandir($pathFolder),['.','..']) ;


     foreach($files as $file){
        require_once $pathFolder  . $file ; 
     }
    //    debug($files) ; 
    }
}

if(!function_exists('debug')){
    function debug($data){
        echo "<pre>" ; 
        print_r($data) ;
        die ; 
    }
}
if(!function_exists('e404')){
    function e404($data){
        echo " 404 - Not Fountd" ; 
        // print_r($data) ;
        die ; 
    }
}

if (!function_exists('upload_file')) {
    function upload_file($folder, $file)
    {
        $targetFile = $folder . '/' . time() . '-' . $file["name"];

        if (move_uploaded_file($file["tmp_name"], PATH_ASSETS_UPLOADS . $targetFile)) {
            return $targetFile;
        }

        throw new Exception('Upload file không thành công!');
    }
}
// if (!function_exists('upload_file')) {
//     function upload_file($folder, $file)
//     {
//         $targetFile = $folder . '/' . time() . '-' .$file["name"];
        

//         if (move_uploaded_file($file["tmp_name"], PATH_ASSETS_UPLOADS . $targetFile)) {
           
//             return $targetFile;
            
//         }else{
//             return debug($targetFile ); 
//         }

//         // throw new Exception('Upload file không thành công!');
//     }
// }
// if(!function_exists('upload_file')){
//     function upload_file($folder,$file){
//         $imagePath = $folder . '/'. time() . '-' . basename($file['name']) ; 
//         // $imagePath = $folder .'/'. time() . '-' . basename($file['name']) ; 
//         // debug( PATH_UPLOAD.  $imagePath) ; 
//         if(move_uploaded_file($file['tmp_name'], PATH_UPLOAD .  $imagePath)){
//             return $imagePath ; 
//         } ; 
//         // return null ; 
//         throw new Exception('Upload file không thành công !') ;
//     }
        
// }

if(!function_exists('get_file_upload')){
    function get_file_upload($field,$default = null){
       if(isset($_FILES[$field]) && $_FILES[$field]['size'] >0 ){
        return $_FILES[$field] ; 
       }
        return $default?? null ; 
    }
}
   
// if(!function_exists('middleware_auth_check')){
//     function middleware_auth_check($act){
//        if($act == 'login' ){
//         if(!empty($_SESSION['user'])){
//             header('Location: ' .BASE_URL_ADMIN) ; 
//             exit() ; 

//         }else if(empty($_SESSION['user'])){
//             header('Location: ' .BASE_URL_ADMIN .'?act=login') ; 
//             exit() ; 
//         }

//     }
//     }
// }

// if(!function_exists('settings')){
//     function settings(){
//        $settings = listAll('settings') ; 

//        $keys = array_column($settings,'key')  ; 
//        $values = array_column($settings,'value') ; 
//        $data= array_combine($keys,$values) ; 
//        return $data ; 
//     //    file_get_contents(PATH_UPLOAD.'/uploads/settings.json',json_encode($data)) ; 
// }
// } 
     

