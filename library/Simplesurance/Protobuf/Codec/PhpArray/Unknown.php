<?php

namespace Simplesurance\Protobuf\Codec\PhpArray;

class Unknown extends \Simplesurance\Protobuf\Unknown
{
    public function __construct($tag, $type, $data)
    {
        $this->tag = $tag;
        $this->type = $type;
        $this->data = $data;
    }
}
