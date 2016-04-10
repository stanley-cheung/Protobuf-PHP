<?php

namespace Simplesurance\Protobuf;

interface CodecInterface
{
    public function encode(\Simplesurance\Protobuf\Message $message);
    public function decode(\Simplesurance\Protobuf\Message $message, $data);
}
