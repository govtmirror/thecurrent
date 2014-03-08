<?php
/**
 * Created by JetBrains PhpStorm.
 * User: optimus
 * Date: 10/27/12
 * Time: 11:30 AM
 * To change this template use File | Settings | File Templates.
 */
abstract class THOR_HostModel// implements IAuditable
{
    protected $title;
    protected $description;

    function __construct($title = null, $description = null) {
        if(isset($title))
        {
            $this->set_title($title);
            //$title = stripSlashesDeep($title);
            // $this->title = addslashes($title);
        }
        if(isset($description))
        {
            $this->set_description($description);
            // $this->description = $description;
        }


    }

    public function get_title() {
        return stripSlashesDeep($this->title);
    }

    public function set_title($title) {
        //$title = stripSlashesDeep($title);
        $this->title = addslashes($title);
    }

    public function get_description() {
        return stripSlashesDeep($this->description);
    }

    public function set_description($description) {
        $this->description = addslashes($description);
    }


    abstract function returnProperties();

    /*
    public function returnPropertiesForAudit($prefix = null) {
        $returnMe = array();
        foreach($this as $key => $value)
        {
            //if($key != 'title' && $key != 'description')
            if(isset($prefix))
            {
                $returnMe[$prefix.'___'.$key] = $value;
            }
            else
            {
                $returnMe[$key] = $value;
            }

        }
        return $returnMe;
    }
    */
}
