<?php
/**
 * Created by JetBrains PhpStorm.
 * User: optimus
 * Date: 10/27/12
 * Time: 11:00 AM
 * To change this template use File | Settings | File Templates.
 */
abstract class TC_Source extends TC_THOR_HostModel
{
    protected $viewtype;
    
    
    public function __construct($validFields = array(), $title = null, $description = null, $viewtype = null) {
        
        $validFieldsToSubmit = array(
        );
        
        $validFieldsToSubmit = array_merge($validFieldsToSubmit, $validFields);
        
        if(isset($viewtype))
        {
            $this->set_viewtype($viewtype);// = $viewtype;            
        }
        
        
        parent::__construct($validFieldsToSubmit, $title, $description);
    }
    
    public function get_viewtype() {
        return $this->viewtype;
    }

    public function set_viewtype($viewtype) {
        $this->viewtype = $viewtype;
    }

    
    public function returnProperties()
    {

        $props = $this->get_fieldValuePairs();
        $returnMe = array();
        foreach($props as $key => $value)
        {
            //if($key != 'title' && $key != 'description')
                $returnMe[$key] = $value;
        }
        return $returnMe;

    }
}
