<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
    public function testFromFactoryMethod()
    {
        $sample1_1 = EnumSample1::from(EnumSample1::CONST_1);
        $sample1_2 = EnumSample1::from(EnumSample1::CONST_2);
        $sample1_3 = EnumSample1::from(EnumSample1::CONST_3);

        static::assertTrue($sample1_1->eq(EnumSample1::CONST_1));
        static::assertTrue($sample1_2->eq(EnumSample1::CONST_2));
        static::assertTrue($sample1_3->eq(EnumSample1::CONST_3));
    }

    public function testTryFromFactoryMethod()
    {
        $sample1_1 = EnumSample1::tryFrom(EnumSample1::CONST_1);
        $sample1_2 = EnumSample1::tryFrom(EnumSample1::CONST_2);
        $sample1_3 = EnumSample1::tryFrom(EnumSample1::CONST_3);

        static::assertTrue($sample1_1->eq(EnumSample1::CONST_1));
        static::assertTrue($sample1_2->eq(EnumSample1::CONST_2));
        static::assertTrue($sample1_3->eq(EnumSample1::CONST_3));
    }

    public function testCallStaticMagicFactoryMethod()
    {
        $sample1_1 = EnumSample1::CONST_1();
        $sample1_2 = EnumSample1::CONST_2();
        $sample1_3 = EnumSample1::CONST_3();

        static::assertTrue($sample1_1->eq(EnumSample1::CONST_1));
        static::assertTrue($sample1_2->eq(EnumSample1::CONST_2));
        static::assertTrue($sample1_3->eq(EnumSample1::CONST_3));
    }

    public function testUniquenessOfEnumsInstances()
    {
        static::assertSame(EnumSample1::CONST_1(), EnumSample1::CONST_1());
        static::assertTrue(EnumSample1::CONST_1()->is(EnumSample1::CONST_1()));
    }

    public function testEnumsWithSameConstantNamesDoesNotCollide()
    {
        static::assertNotEquals(EnumSample1::CONST_1, EnumSample2::CONST_1);
        static::assertNotEquals(EnumSample1::CONST_2, EnumSample2::CONST_2);
        static::assertNotEquals(EnumSample1::CONST_3, EnumSample2::CONST_3);
        static::assertNotSame(EnumSample1::CONST_1(), EnumSample2::CONST_1());
        static::assertNotSame(EnumSample1::CONST_2(), EnumSample2::CONST_2());
        static::assertNotSame(EnumSample1::CONST_3(), EnumSample2::CONST_3());
    }

    public function testEnumCanBeCastedToString()
    {
        static::assertSame((string) EnumSample1::CONST_1, (string) EnumSample1::CONST_1());
        static::assertSame((string) EnumSample1::CONST_2, (string) EnumSample1::CONST_2());
        static::assertSame((string) EnumSample1::CONST_3, (string) EnumSample1::CONST_3());
    }
}
