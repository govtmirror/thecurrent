<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SidebarWidget
 *
 * @author kottkedp
 */
abstract class TC_SB_SidebarWidget {
    
    private $title;
    private $iconURL;
    private $dashboardModel;
    private $priority;
    private $properties;    
    private $viewType;
    //private $viewTypeVariant;
    
    public function __construct($title, $iconURL, $dashboardModel, $priority = null, $properties = null, $viewType = null)//, $viewTypeVariant = null) 
    {
        if(is_string($title))
        {
            $this->title = $title;            
        }
        else
        {
            throw new Exception("sidebar widget construction failed!");
        }
        if(is_string($iconURL))
        {
            $this->iconURL = $iconURL;
        }
        else
        {
            throw new Exception("sidebar widget construction failed!");
        }
        if(is_string($dashboardModel))
        {
            $this->dashboardModel = $dashboardModel;
        }
        else
        {
            throw new Exception("sidebar widget construction failed!");
        }
        if(isset($priority) && is_numeric($priority))
        {
            $this->priority = $priority;
        }
        elseif(isset($priority))
        {
            throw new Exception("sidebar widget construction failed!");
        }
        if(isset($properties) && is_array($properties))
        {
            $this->properties = $properties;
        }
        elseif(isset($properties))
        {
            throw new Exception("sidebar widget construction failed!");
        }
        if(isset($viewType) && is_string($viewType))
        {
            $this->viewType = $viewType;            
        }
        elseif(isset($viewType))
        {
            throw new Exception("sidebar widget construction failed!");
        }
        //if(isset($viewTypeVariant) && is_string($viewTypeVariant))
        //{
        //    $this->viewTypeVariant = $viewTypeVariant;            
        //}
        //elseif(isset($viewTypeVariant))
        //{
        //    throw new Exception("sidebar widget construction failed!");
        //}
    }
    
    public function get_title()
    {
        return $this->title;
    }
    
    public function get_iconUrl()
    {
        return $this->iconUrl;
    }
    
    public function get_dashboardModel()
    {
        return $this->dashboardModel;
    }
    
    public function get_priority()
    {
        return $this->priority;
    }
    public function set_priority($priority)
    {
        if(isset($priority) && is_numeric($priority))
        {
            $this->priority = $priority;
        }
        elseif(isset($priority))
        {
           return false;
        }       
        
    }
    public function get_properties()
    {
        return $this->properties;
    }
    
    public function get_viewType()
    {
        return $this->viewType;
    }
    //public function get_viewTypeVariant()
    //{
    //    return $this->viewTypeVariant;
    //}
    
}

?>
