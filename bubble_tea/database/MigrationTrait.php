<?php

namespace Database;

use Illuminate\Database\Schema\Blueprint;

/**
 * @author Gilles MARIE-SAINTE <marie-_g@etna-alternance.net>
 */
trait MigrationTrait
{
    /**
     * Helper method to add an id field to a table in order to prevent
     * the "General error: 1215 Cannot add foreign key constraint" error
     * when using the default $table->id() method.
     */
    public function addIdPrimaryKey(Blueprint $table): void
    {
        $table->engine = 'InnoDB';
        $table->unsignedInteger('id')->autoIncrement();
    }
}
