<?php
namespace rjapi\extension;

use rjapi\exceptions\AttributesException;
use rjapi\types\ConfigInterface;

class BitMask
{
    private $entity    = [];
    private $field     = null;
    private $isEnabled;

    /**
     * SpellCheck constructor.
     * @param array $params
     */
    public function __construct(array $params)
    {
        $this->entity    = $params;
        $this->field     = key($this->entity);
        $this->isEnabled = empty($this->entity[$this->field][ConfigInterface::ENABLED]) ? false : true;
    }

    /**
     * @return boolean
     */
    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    /**
     * @return mixed|null
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @return mixed
     * @throws AttributesException
     */
    public function getFlags()
    {
        if(empty($this->entity[$this->field][ConfigInterface::FLAGS])) {
            throw new AttributesException('Flags should be preset for bit mask.');
        }
        return $this->entity[$this->field][ConfigInterface::FLAGS];
    }

    public function isHidden(): bool
    {
        return empty($this->entity[$this->field][ConfigInterface::HIDE_MASK]) ? false : true;
    }
}