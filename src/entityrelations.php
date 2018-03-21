<?php

namespace damianbal\enterium;

use damianbal\enterium\EntityQueryBuilder;

trait EntityRelations
{
    /**
     * Returns related entites
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
}