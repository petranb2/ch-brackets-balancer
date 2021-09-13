<?php

namespace App;

use Exception;

/**
 * Class BracketBalancer
 * @package App
 */
class BracketBalancer
{
    private string $string;

    private array $openTokens = [];

    private const OPEN_TOKENS = ['(', '{', '['];

    private const CLOSE_TOKENS = [')', '}', ']'];

    /**
     * BracketBalancer constructor.
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->string = $string;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        $array = str_split($this->string);

        try {

            foreach ($array as $char) {

                if ($this->isOpenToken($char)) {
                    $this->addOpenToken($char);
                    continue;
                }

                if ($this->isCloseToken($char)) {
                    $lastOpenToken = $this->getLastOpenToken();
                    $this->compareTokens($char, $lastOpenToken);
                }
            }

            if (!empty($this->openTokens)) {
                throw new Exception('Error remaining open tokens: ' . implode(',', $this->openTokens));
            }
            return true;

        } catch (Exception $exception) {

            echo '[error]::' . $exception->getMessage().PHP_EOL;
            return false;
        }

    }

    /**
     * @param string $char
     * @return bool
     */
    private function isOpenToken(string $char): bool
    {
        if (in_array($char, self::OPEN_TOKENS)) {
            return true;
        }
        return false;
    }

    /**
     * @param string $char
     * @return bool
     */
    private function isCloseToken(string $char): bool
    {
        if (in_array($char, self::CLOSE_TOKENS)) {
            return true;
        }
        return false;
    }

    public function addOpenToken($char)
    {
        array_push($this->openTokens, $char);
    }

    /**
     * @throws Exception
     */
    public function getLastOpenToken()
    {
        if (empty($this->openTokens)) {
            throw new Exception('No open tokens');
        }
        return array_pop($this->openTokens);
    }

    /**
     * Evaluate the close and the open token if can close each other
     * @throws Exception
     */
    private function compareTokens($closeToken, $openToken): void
    {
        if (array_search($closeToken, self::CLOSE_TOKENS) ===
            array_search($openToken, self::OPEN_TOKENS)) {
            return;
        }
        throw new Exception('Token ' . $openToken . ' cant close- ' . $closeToken . '');
    }
}
