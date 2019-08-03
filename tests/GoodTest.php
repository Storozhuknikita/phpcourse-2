<?php

namespace App\tests;


use App\models\entities\Good;
use App\services\StringService;
use PHPUnit\Framework\TestCase;

class GoodTest extends TestCase
{
    /**
     * @param $string
     * @param $count
     * @dataProvider dataForTestGetPreviewInfo
     */
    public function testGetPreviewInfo($string, $count)
    {
        $good = new Good();
        $good->info = $string;
        $result = $good->getPreviewInfo();

        $this->assertTrue(mb_strlen($result) <= 10);
        $this->assertEquals(mb_strlen($result), $count);
    }

    public function dataForTestGetPreviewInfo()
    {
        return [
            ['Тут некий текст, который следует обрезать', 10],
            ['Тут некий текст, ', 10],
            ['Тут ', 4],
        ];
    }

    public function testGetPreviewInfoWithMock()
    {
        $mockStringService = $this->getMockBuilder(StringService::class)
            ->disableOriginalConstructor()
            ->setMethods(['cutString'])
            ->getMock();

        $mockStringService->expects($this->once())
            ->method('cutString')
            ->with('Тут некий текст, который следует обрезать', 10)
            ->willReturn('1234567');


        $mockGood = $this->getMockBuilder(Good::class)
            ->setMethods(['getStringService'])
            ->getMock();

        $mockGood->expects($this->once())
            ->method('getStringService')
            ->willReturn($mockStringService);

        $mockGood->info = 'Тут некий текст, который следует обрезать';
        $result = $mockGood->getPreviewInfo();
        echo $result;
        $this->assertTrue(mb_strlen($result) <= 10);
    }

    /**
     * @throws \ReflectionException
     */
    public function testPrivateProperty()
    {
        $reflectionGoods = new \ReflectionClass(Good::class);
        $reflectionA = $reflectionGoods->getProperty('a');

        $good = new Good();
        $reflectionA->setAccessible(true);
        $reflectionA->setValue($good, 'TestValue');
        $this->assertEquals('TestValue', $good->getA());

        $reflectionMethod = $reflectionGoods->getMethod('getAF');
        $reflectionMethod->setAccessible(true);

        echo $reflectionMethod->invoke($good, '456');
    }
}