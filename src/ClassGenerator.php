<?php

namespace NoraShirokuma\ClassGeneratorPhp;

class ClassGenerator
{
    private string $body = "";

    private int $indentNum = 0;

    private const INDENT = "    ";

    private ?string $nameSpace = null;

    private string $className;

    private ?string $extends = null;

    private bool $abstract = false;

    private array $methods = [];

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    public function generate(): string
    {
        $this->resetCode();
        $this->putCode("<?php");
        $this->putCode("");

        (function() {
            if (is_null($this->nameSpace)) {
                return;
            }
            $this->putCode(sprintf("namespace %s;", $this->nameSpace));
        })();

        (function() {
            $abstract = (function() {
                $abstract = "";
                if ($this->abstract === false) {
                    return $abstract;
                }
                $abstract .= "abstract ";
                return $abstract;
            })();
            $extends = (function() {
                $extends = "";
                if (is_null($this->extends)) {
                    return $extends;
                }
                if ($this->extends === "") {
                    return $extends;
                }
                $extends = sprintf(" extends %s", $this->extends);
                return $extends;
            })();
            $code = sprintf(
                "%sclass %s%s",
                $abstract,
                $this->className,
                $extends
            );
            $this->putCode($code);
        })();

        $this->putCode("{");

        $this->indentUp();

        (function() {
            /** @var Method $method */
            foreach ($this->methods as $key => $method) {

                $newLine = (function() use($key) {
                    if ($key === 0) {
                        return ;
                    }
                    $this->putCode("");
                })();

                $visibility = (function() use ($method) {
                    $visibility = $method->getVisibility();
                    if (is_null($visibility)) {
                        return 'public ';
                    }
                    return sprintf('%s ', $visibility);
                })();

                $args = (function() use ($method) {
                    $code = '';
                    $args = $method->getArguments();
                    /** @var Argument $arg */
                    foreach ($args as $arg) {

                        $separator = (function() use($code) {
                            if (1 <= strlen($code)) {
                                return ', ';
                            }
                            return '';
                        })();

                        $type = (function() use($arg) {
                            $code = '';
                            $nullOk = (function() use($arg) {
                                if (!$arg->isNullOk()) {
                                    return '';
                                }
                                return '?';
                            })();
                            $code = sprintf(
                                '%s%s ',
                                $nullOk,
                                $arg->getType()
                            );
                            return $code;
                        })();

                        $defaultValue = (function() use($arg) {
                            if (!$arg->isEnableDefaultValue() && is_null($arg->getDefaultValue())) {
                                return '';
                            }
                            if (is_null($arg->getDefaultValue())) {
                                return sprintf(" = %s", 'null');
                            }
                            if ($arg->getType() === 'string') {
                                return sprintf(" = '%s'", $arg->getDefaultValue());
                            }
                            return sprintf(" = %s", $arg->getDefaultValue());
                        })();

                        $code = sprintf(
                            '%s%s$%s%s',
                            $separator,
                            $type,
                            $arg->getName(),
                            $defaultValue
                        );
                    }
                    return $code;
                })();

                $returnValue = (function() use($method) {
                    if ($method->getName() === '__construct') {
                        return '';
                    }
                    $returnValue = $method->getReturnValue();
                    if (is_null($returnValue)) {
                        return ': void';
                    }
                    return sprintf(': %s', $returnValue);
                })();

                $code = sprintf(
                    "%sfunction %s(%s)%s",
                    $visibility,
                    $method->getName(),
                    $args,
                    $returnValue
                );
                $this->putCode($code);

                $this->putCode("{");

                $this->indentUp();

                foreach ($method->getBody() as $code) {
                    $this->putCode($code);
                }

                $this->indentDown();

                $this->putCode("}");
            }
        })();

        $this->indentDown();

        $this->putCode("}");

        return $this->body;
    }

    private function indentUp(): void
    {
        $this->indentNum++;
    }

    private function indentDown(): void
    {
        $this->indentNum--;
        if ($this->indentNum < 0) {
            $this->indentNum = 0;
        }
    }

    private function putCode(string $code, bool $newLine = true): void
    {
        $this->body .= $this->indent();
        $this->body .= $code;
        $this->body .= (function($newLine) {
            $body = "";
            if (!$newLine) {
                return $body;
            }
            $body .= "\n";
            return $body;
        })($newLine);
    }

    private function resetCode(): void
    {
        $this->body = "";
    }

    private function indent(): string
    {
        return str_repeat(self::INDENT, $this->indentNum);
    }

    public function setNameSpace(?string $nameSpace): void
    {
        $this->nameSpace = $nameSpace;
    }

    public function setExtends(?string $extends): void
    {
        $this->extends = $extends;
    }

    public function setAbstract(bool $abstract): void
    {
        $this->abstract = $abstract;
    }

    public function addMethod(Method $method): void
    {
        $this->methods[] = $method;
    }
}