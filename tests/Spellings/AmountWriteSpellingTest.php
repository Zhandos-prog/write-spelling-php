<?php

namespace ZhandosProg\WriteSpelling\Spellings;

use PHPUnit\Framework\TestCase;
use ZhandosProg\WriteSpelling\Exceptions\NotSupportedException;
use ZhandosProg\WriteSpelling\Exceptions\ValidationException;

class AmountWriteSpellingTest extends TestCase
{

    public function testGenerateRu(): void
    {
        $expected = 'двенадцать тенге девяносто девять тиын';
        $actual = (new AmountWriteSpelling())->generate(12.99,'ru');
        $this->assertEquals($expected, $actual);
    }

    public function testGenerateKz(): void
    {
        $expected = 'он екі теңге тоқсан тоғыз тиын';
        $actual = (new AmountWriteSpelling())->generate(12.99);
        $this->assertEquals($expected, $actual);
    }

    public function testGenerateValidationException(): void
    {
        $amountWriteSpelling = new AmountWriteSpelling();

        $this->expectException(ValidationException::class);
        $this->expectErrorMessage('Incorrect number format!');

        $amountWriteSpelling->generate('1asd');
    }

    public function testGenerateNotSupportedException(): void
    {
        $locale = 'en';
        $amountWriteSpelling = new AmountWriteSpelling();

        $this->expectException(NotSupportedException::class);
        $this->expectErrorMessage('Localization '. strtoupper($locale) .' not supported!');

        $amountWriteSpelling->generate(12, $locale);
    }
}
