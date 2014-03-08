<?php


class TC_CorridorUserSource extends TC_Source{

    //protected $content_type;
    //protected $groupID;

    public function __construct($title = null, $description = null, $viewtype = null, $content_type = null, $groupID = null) {
        $validFieldsToSubmit = array(
            'content_type',
            'groupID'
        );
        parent::__construct($validFieldsToSubmit, $title, $description, $viewtype);

        if(isset($content_type) && is_string($content_type))
        {
            $this->set_content_type($content_type);// = $content_type;
        }
        if(isset($groupID) && is_numeric($groupID))
        {
            $this->set_groupID($groupID);// = $groupID;
        }



    }

    public function get_content_type() {
        $pairs = $this->get_fieldValuePairs();
        if(array_key_exists('content_type', $pairs))
        {
            return $pairs['content_type'];
        }
        else
        {
            return false;
        }
    }

    public function set_content_type($content_type) {
        $pairs = $this->get_fieldValuePairs();
        $pairs['content_type'] = $content_type;
        $this->set_fieldValuePairs($pairs);
        //$this->content_type = $content_type;
    }

    public function get_groupID() {
        $pairs = $this->get_fieldValuePairs();
        if(array_key_exists('groupID', $pairs))
        {
            return $pairs['groupID'];
        }
        else
        {
            return false;
        }
    }

    public function set_groupID($groupID) {
        $pairs = $this->get_fieldValuePairs();
        $pairs['groupID'] = $groupID;
        $this->set_fieldValuePairs($pairs);
        //$this->groupID = $groupID;
    }



}



?>

