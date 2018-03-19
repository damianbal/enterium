<?php

namespace damianbal\enterium;

/**
 * Utility methods for Entity and it's derived classes
 */
trait EntityHelpers
{
    /**
     * Return latest entity 
     *
     * @return mixed
     */
    public static function latest() 
    {
        return static::builder()->order(['id'], 'DESC')->limit(1)->first();
    }

    /**
     * Return entity by ID
     *
     * @param [type] $id
     * @return void
     */
    public static function find($id)
    {
        return static::builder()->where('id', $id, '=')->limit(1)->first();
    }
}