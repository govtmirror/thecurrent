<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetStrategy
 *
 * @author Dan Kottke
 */
abstract class GetStrategy implements IGetStrategy{

    //protected $filter;
    //protected $order;
    protected $dataSource;

    function __construct($dataSource = null) {

        $this->set_dataSource($dataSource);

    }

    public function get_dataSource() {
        return $this->dataSource;
    }

    public function set_dataSource($dataSource) {
        $this->dataSource = $dataSource;
    }

    /*
    public function get_filter()
    {
        return $this->filter;

    }
    public function set_filter( $filter)
    {
           if($filter instanceof QueryCondition || $filter == null)
            $this->filter = $filter;

    }
    public function clearFilter()
    {
        unset($this->filter);
    }
    public function get_order()
    {
        return $this->order;

    }
    public function clearOrder()
    {
        unset($this->order);
    }
    public function set_order( $order)
    {
           if($order instanceof QueryOrder || $order == null)
            $this->order = $order;

    }
     *
     */
    /*
    public function get($caller = null, AccessProfile $accessProfile = null, $args = null)
    {

        $this->clearFilter();
        $this->clearOrder();
    }
    public  function getOne($caller = null, AccessProfile $accessProfile = null, $id = null, $args = null)
    {

        $this->set_filter(new QueryCondition(DB_NAME.".".pullIndex($this->get_entities(), 'id'), ValidSQLComparisons::EQUALS, $id));

        return $this->get($caller, $accessProfile, $args);
    }

    public  function getIDs($caller = null, AccessProfile $accessProfile = null, $args = null)
    {

        $this->clearFilter();
        $this->clearOrder();

    }
    */
}

?>
