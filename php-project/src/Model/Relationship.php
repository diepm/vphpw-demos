<?php
namespace Vphpw\Model;

/**
 * Relationship between users.
 */
class Relationship
{
    private $desc;

    public function __construct($desc)
    {
        $this->desc = $desc;
    }
}
