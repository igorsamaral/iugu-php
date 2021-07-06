<?php

namespace Iugu\Exceptions;

final class IuguException extends \Exception
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $parameterName;

    /**
     * @var string
     */
    private $errorMessage;

    /**
     * @param string $type
     * @param string $parameterName
     * @param string $errorMessage
     */
    public function __construct($type, $parameterName, $errorMessage)
    {
        $this->type = $type;
        $this->paramInvalidJsonExceptioneterName = $parameterName;
        $this->parameterName = $parameterName;
        $this->errorMessage = $errorMessage;

        $exceptionMessage = $this->buildExceptionMessage();

        parent::__construct($exceptionMessage);
    }

    /**
     * @return string
     */
    private function buildExceptionMessage()
    {
        return sprintf(
            'ERROR TYPE: %s. PARAMETER: %s. MESSAGE: %s',
            $this->type,
            $this->parameterName,
            $this->errorMessage
        );
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getParameterName()
    {
        return $this->parameterName;
    }
}
