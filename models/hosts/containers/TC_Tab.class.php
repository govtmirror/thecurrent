<?php
/**
 * Created by JetBrains PhpStorm.
 * User: optimus
 * Date: 10/27/12
 * Time: 11:01 AM
 * To change this template use File | Settings | File Templates.
 */
abstract class TC_Tab extends TC_THOR_HostModel
{
    
    protected $viewtype;    
    //protected $sources;
    
    
    //possibly implement iterator at some point
    //protected $position = 0;
    
    public function __construct($title = null, $description = null, $viewtype = null) {
        
        
        $validFields = array(
        );
        
        if(isset($viewtype))
        {
            $this->set_viewtype($viewtype);         
        }
        
        
        
        parent::__construct($validFields, $title, $description);
    }
    
    public function get_viewtype() {
        return $this->viewtype;
    }

    public function set_viewtype($viewtype) {
        $this->viewtype = $viewtype;
    }

    

    public function returnProperties()
    {

        $returnMe = array();
        foreach($this as $key => $value)
        {
            //if($key != 'title' && $key != 'description')
                $returnMe[$key] = $value;
        }
        return $returnMe;

    }


}
