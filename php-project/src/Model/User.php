<?php
namespace Vphpw\Model;

/**
 * User model.
 */
class User
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}
