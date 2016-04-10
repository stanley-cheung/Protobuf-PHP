<?php

namespace Simplesurance\Protobuf;

use Simplesurance\Protobuf;

class Descriptor
{
    /** @var String Holds the class name of the message */
    protected $class;

    /** @var String Holds the original proto name */
    protected $name;

    /** @var \Simplesurance\Protobuf\Field[] */
    protected $fields = array();

    /** @var array - Cache the relation between names and tags */
    protected $names = array();


    /**
     * @param string $class
     * @param string $name
     */
    public function __construct($class, $name = null)
    {
        $this->class = trim($class, '\\ ');
        $this->name = $name ? trim($name, '. ') : NULL;
    }

    /**
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Obtain the list of fields in the message
     *
     * @return \Simplesurance\Protobuf\Field[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Adds a field to the message
     *
     * @param \Simplesurance\Protobuf\Field $field
     * @param bool $isExtension
     */
    public function addField(Protobuf\Field $field, $isExtension = false)
    {
        $field->extension = $isExtension;
        $this->fields[ $field->number ] = $field;
    }

    /**
     * Obtain a field descriptor by its tag number
     *
     * @param int $tag
     * @return \Simplesurance\Protobuf\Field | NULL
     */
    public function getField($tag)
    {
        return isset($this->fields[$tag])
               ? $this->fields[$tag]
               : NULL;
    }

    /**
     * Obtain a field descriptor by its name
     *
     * @param string $name
     * @return \Simplesurance\Protobuf\Field | NULL
     */
    public function getFieldByName($name)
    {
        // Check cached map
        if (isset($this->names[$name])) {
            return $this->getField($this->names[$name]);
        }

        // Loop thru all fields to find it
        foreach ($this->fields as $tag=>$field) {
            // Cache it for next calls
            $fname = $field->getName();
            $this->names[$fname] = $tag;

            if ($name === $fname) {
                return $field;
            }
        }

        return null;
    }

    /**
     * Check if the given tag number matches a field
     *
     * @param int $tag
     * @return bool
     */
    public function hasField($tag)
    {
        return isset($this->fields[$tag]);
    }
}
