<?php

namespace damianbal\enterium;

use damianbal\enterium\EntityQueryBuilder;

trait EntityRelations
{
    /**
     * Returns entities which are related to that entity
     *
     * @param string|class $entity_class
     * @param string $foreign_key
     * @return QueryBuilder
     */
    public function hasMany($entity_class, $foreign_key) : QueryBuilder
    {
        $entityQueryBuilder = new EntityQueryBuilder();
        $entityQueryBuilder->create($entity_class::$table, $entity_class);
        return $entityQueryBuilder->select()->where($foreign_key, $this->id);
    }

    /**
     * Same as hasMany but returns only one record
     *
     * @param string|class $entity_class
     * @param string $foreign_key
     * @return QueryBuilder
     */
    public function hasOne($entity_class, $foreign_key) : QueryBuilder
    {
        return $this->hasMany($entity_class, $foreign_key)->limit(1);
    }

    /**
     * Returns entities which own that entity
     *
     * @param string|class $entity_class
     * @param string $foreign_key
     * @return QueryBuilder
     */
    public function belongsTo($entity_class, $foreign_key) : QueryBuilder
    {
        $entityQueryBuilder = new EntityQueryBuilder();
        $entityQueryBuilder->create($entity_class::$table, $entity_class);
        return $entityQueryBuilder->select()->where('id', $this->{$foreign_key});
    }
}