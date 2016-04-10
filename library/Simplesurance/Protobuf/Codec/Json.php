<?php

namespace Simplesurance\Protobuf\Codec;

use Simplesurance\Protobuf;

/**
 * This codec serializes and unserializes from/to Json strings
 * where the keys represent the field's name.
 *
 * It makes use of the PhpArray codec to do the heavy work to just
 * take care of converting the array to/from Json strings.
 */
class Json extends PhpArray
    implements Protobuf\CodecInterface
{
    /**
     * @param \Simplesurance\Protobuf\Message $message
     * @return string
     */
    public function encode(Protobuf\Message $message)
    {
        $data = $this->encodeMessage($message);
        return json_encode($data);
    }

    /**
     * @param \Simplesurance\Protobuf\Message $message
     * @param string $data
     * @return \Simplesurance\Protobuf\Message
     */
    public function decode(Protobuf\Message $message, $data)
    {
        $data = json_decode($data);
        return $this->decodeMessage($message, $data);
    }

}
