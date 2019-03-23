<?php

namespace App\DB;

interface DB
{
    public function create();

    public function read();

    public function update();

    public function delete();
}
