<?php  namespace NinjaMortgage\Classes;


class View
{
    
    public static function makeView($file, $data = array())
    {
        $file = sanitize_file_name($file);
        $file = str_replace('.', DIRECTORY_SEPARATOR, $file);
        extract($data);
        $filePath = NINJA_MORTGAGE_PLUGIN_DIR_PATH . 'views/'.$file.'.php';
        if(!file_exists($filePath)){
            return '';
        }
        ob_start();
        include $filePath;
        return ob_get_clean();
    } 
   
    public static function renderView($file, $data)
    {
        echo self::makeView($file, $data);
    }

}
