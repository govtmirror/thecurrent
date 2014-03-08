<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Repository
 *
 * @author KottkeDP
 */
class Repository implements Iterator {
    protected $strategy;
    protected $pool = array();
    private $position = 0;

    public function __construct(IRepositoryStrategy $strategy = null) {
        if(isset($strategy))
        {
            $this->set_strategy($strategy);
        }
    }

    // <editor-fold desc="iterator implementation">
    function rewind()
    {
        $this->position = 0;
    }

    function current()
    {
        return $this->pool[$this->position];
    }

    function key()
    {
        return $this->position;
    }

    function next()
    {
        ++$this->position;
    }

    function valid()
    {
        $temp = $this->pool[$this->position];
        return isset($temp);

    }
    // </editor-fold>

    public function resetRepository()
    {
        $this->emptyPool();
        $this->rewind();
    }

    public function get_strategy()
    {
        return $this->strategy;
    }

    public function set_strategy(IRepositoryStrategy $strategy)
    {
        $this->resetRepository();
        $this->strategy = $strategy;
    }

    protected function emptyPool()
    {
        if(isset($this->pool))
        {
            unset($this->pool);
        }
        $this->pool = array() ;
    }

    public function get_pool()
    {
        return $this->pool;
    }
    public function set_pool(array $pool)
    {
        $this->emptyPool();
        foreach ($pool as $key => $value)
        {
            //if($item instanceof IPersistable)
            //{
                //$value->set_is_dirty(true);
                array_push($this->pool, $value);
            //}
        }
    }



    //public function save($caller = null, $accessGroup_id = null, $args = null)
    public function save(ISetParameterModel $params)
    {
        $returnMe = array();

        foreach($this->get_pool() as $item)
        {
                $params->set_Item($item);

                $tempRet = $this->get_strategy()->save($params);

                $returnMe[] = clone $tempRet;

        }
        $this->emptyPool();

        return $returnMe;
        //return $tempRet;
    }

    public function get(IGetParameterModel $params)
    {
        // TODO alter the following line
        $this->set_pool($this->get_strategy()->get($params)->get_outputCollection());

        return $this->get_pool();
    }

    public function getAndAppend(IGetParameterModel $params)
    {
        // TODO alter the following line
        $this->appendToPool($this->get_strategy()->get($params)->get_outputCollection());

        return $this->get_pool();

    }


    public function getOne(IGetParameterModel $params)
    {
        // TODO alter the following line
        $pool = $this->get_strategy()->get($params)->get_outputCollection();
        $arr = array();
        if(!empty($pool))
        {
            $single = array_pop($pool);
            $arr[] = $single;

        }
        $this->set_pool($arr);
        return $single;



    }

    public function getAndAppendOne(IGetParameterModel $params)
    {
        // TODO alter the following line
        $pool = $this->get_strategy()->get($params)->get_outputCollection();
        // $arr = array();
        if(!empty($pool))
        {
            $single = array_pop($pool);
            // $arr[] = $single;
            $this->loadEntity($single);
        }

        return $this->get_pool();
    }

    public function getIDs(IGetParameterModel $params)
    {
        // TODO alter the following line
        return $this->get_strategy()->get($params)->get_outputReferenceIDs();
    }
    /*
    public function getProperty($caller = null, AccessProfile $accessProfile = null, $id = null, $property = null, $args = null)
    {
        return $this->get_strategy()->getProperty($caller, $accessProfile, $id, $property, $args);
    }
    */
    public function loadEntity($entity)
    {
        /*
        if(!$this->get_pool())
        {
            $this->set_pool(array());
        }
         *
         */
        //$entity->set_is_dirty(true);// = true;
        //$entity->set_is_active(true);// = true;
        array_push($this->pool, $entity);

    }

    public function appendToPool(array $subPool)
    {
        /*
        if(!$this->get_pool())
        {
            $this->set_pool(array());
        }
         *
         */
        foreach ($subPool as $key => $value)
        {
            $this->loadEntity($value);
            /*
            $value->set_is_dirty(true);// = true;
            //$value->set_is_active(true);// = true;
            array_push($this->pool, $value);
             *
             */
        }


    }



}

?>
