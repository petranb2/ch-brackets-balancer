<?php
declare(strict_types=1);

use App\BracketBalancer;
use PHPUnit\Framework\TestCase;

/**
 * Class BracketBalancerTest
 */
final class BracketBalancerTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testNoOpenTokensToClose(): void
    {
        // Arrange ( sut -> system under test)
        $sut = new BracketBalancer('(asfd{s})))))');
        // Act
        $result = $sut->validate();
        // Assert
        $this->assertEquals(false, $result);

    }

    /**
     * @throws Exception
     */
    public function testTokenCantClose(): void
    {
        // Arrange ( sut -> system under test)
        $sut = new BracketBalancer('(asfd[s)');
        // Act
        $result = $sut->validate();
        // Assert
        $this->assertEquals(false, $result);

    }

    /**
     * @throws Exception
     */
    public function testRemainingOpenTokens(): void
    {
        // Arrange ( sut -> system under test)
        $sut = new BracketBalancer('(asfd(s)');
        // Act
        $result = $sut->validate();
        // Assert
        $this->assertEquals(false, $result);

    }

    /**
     * @dataProvider validStringsProvider
     */
    public function testStringIsValid($string): void
    {
        // Arrange ( sut -> system under test)
        $sut = new BracketBalancer($string);
        // Act
        $result = $sut->validate();
        // Assert
        $this->assertEquals(true, $result);

    }

    /**
     * @return string[][]
     */
    public function validStringsProvider(): array
    {
        return [
            ['(asfd(s))'],
            ['(asfd{sdf}gfg[sdf]sdf)'],
            ['asdf(fd[asfdsfd{safdsfd}svcxwe]wqsdf)asdf']
        ];
    }
}