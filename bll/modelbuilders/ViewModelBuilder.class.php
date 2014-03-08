<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewModelBuilder
 *
 * @author kottkedp
 */
abstract class ViewModelBuilder {

    protected $id;
    protected $model;
    protected $modelType;
    protected $repo;
    protected $model_id;


    public function __construct($modelType, $strategy, $id, $repo = null, $args = null) {
        if(is_string($modelType))
        {
            $this->modelType = $modelType;
        }
        else
        {
            throw new Exception("Ineligible model type");
        }
        if(is_numeric($id))
        {
            $this->id = (int)$id;
        }
        else
        {
            throw new Exception("ID must be int");
        }
        if(isset($repo))
        {
            $this->repo = $repo;
        }
        else
        {
            $this->repo = new Repository($strategy);
        }
    }

    protected function generate($args = null)
    {
        if(isset($args))
        {
            extract($args);
        }
        //$strategy = new DashboardStrategy();
        //$repo = new Repository($strategy);
        $id = $this->get_id();

        $getPar = new THOR_GetParameterCapsule(array(), array('entity_id' => $id, 'accessprofile' => new TC_DefaultAccessProfile()), array('overrideUAC' => true));

        $value = $this->repo->getOne($getPar);
        //$resultsArr = $this->repo->getOne(SYSTEM_USER_ID, new TC_DefaultAccessProfile(), $id, array('overrideUAC' => true));

        // foreach($resultsArr AS $key => $value)
        // {
            if(!($value instanceof THOR_EntityModel))
            {
                throw new Exception("getOne returned a non-database entity");
            }
            $returnMe = $value->get_host();
            $this->model_id = $value->get_host_id();
        // }
        if(!$returnMe)
        {
            throw new Exception("getOne returned no results");
        }

        unset($resultsArr);
        unset($id);

        return $returnMe;

    }

    public function getModel()
    {
        if(!(isset($this->model)))
        {

            $this->model = $this->generate();
            if(!$this->verifyModel())
            {
                throw new Exception("generate method generates an incorrect model.");
            }

        }
        return $this->model;
    }

    public function get_modelType()
    {
        if((isset($this->modelType)))
        {

            return $this->modelType;

        }

    }

    public function verifyModel()
    {
        if(!(isset($this->model)))
        {
            return false;
        }
        elseif($this->model instanceof $this->modelType || $this->modelType == 'TC_AmorphousFullSource')
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_id($id)
    {
        unset ($this->model);
        $this->id = $id;
    }

    public function get_model_id()
    {
        return $this->model_id;
    }




}

?>
