<?php

namespace App\Interfaces;

/**
 * Interface CRUDInterface
 *
 * @author  Luis Macias
 * @package App\Interfaces
 */
interface CRUDInterface
{
    public function create();

    public function read();

    public function update();

    public function delete();
}