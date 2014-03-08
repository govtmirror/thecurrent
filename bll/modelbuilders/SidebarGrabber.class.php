<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SidebarGrabber
 *
 * @author kottkedp
 */
class SidebarGrabber {
    
    public static function getInternalSidebarWidgets()
    {           
        return self::getSidebarWidgets('internal');
        
    }
    
    public static function getExternalSidebarWidgets()
    {           
        return self::getSidebarWidgets('external');
    }
    
    
    public static function getSidebarWidgets( $folder )
    {   
        if(!is_string($folder))
        {
            throw new Exception('folder for sideboard not a valid folder');
        }
        //user id currently not used
        $returnMe = array();        
        
        
        $path = MODEL_PATH.'sidebarwidgets'.DS.$folder;//getcwd();
        $supported_ext = array('class.php');
        $dir = @opendir($path);
        
        while($file = @readdir($dir))
        { 
            if(!is_dir($path.$file))
            {
                $splitted = explode('.', $file);
                if(count($splitted) >2)
                {
                    $ext = strtolower($splitted[count($splitted)-2].".".$splitted[count($splitted)-1]);
                    
                    if(in_array($ext, $supported_ext)) 
                    {
                        
                            $filename = '';
                            for($i=0; $i<count($splitted)-2; $i++)
                            {
                                $filename .= $splitted[$i];
                            }
                             
                            $returnMe[] = new $filename();
                    }
                }
            }            
        }
        
        @closedir($dir);
        //sort($files);
        
        unset($path);
        unset($filename);
        unset($dir);
        unset($ext);
        unset($supported_ext);
        unset($splitted);        
        
        
        return self::arrangeSideboardWidgets($returnMe);
        
    }
    
    public static function arrangeSideboardWidgets($widgets)
    {
        if(!is_array($widgets))
        {
            throw new Exception('Error in arranging sideboard widgets');
        }
        
        usort($widgets, 'self::sideboardWidgetCompare');
        
        return $widgets;
        
    }
    
    public static function sideboardWidgetCompare($a, $b)
    {
        if(!$a instanceof TC_SB_SidebarWidget || !$b instanceof TC_SB_SidebarWidget)
        {
            throw new Exception('comparison only accepts sidebar widgets');
        }
        
        if($a->get_priority() > $b->get_priority())
        {return 1;}
        if($a->get_priority() == $b->get_priority())
        {return 0;}
        if($a->get_priority() < $b->get_priority())
        {return -1;}
        
    }
    
    
    
}

?>
