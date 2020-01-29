<?php

namespace App\Tests;

use App\Entity\Quote;
use App\Service\QuoteService;
use App\Service\ShoutService;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class ShoutTest extends TestCase
{

    public function testShoutServiceCreate()
    {
        $em = $this->getMockBuilder(ShoutService::class)
            ->disableOriginalConstructor()
            ->getMock();

        //$shoutService = new ShoutService(new JsonQuoteProvider());
        $this->assertInstanceOf(ShoutService::class, $em);

    }

    public function testShout()
    {
        $quotes = new ArrayCollection();
        $quotes->add(new Quote('Your time is limited, so don’t waste it living someone else’s life!', 'Steve Jobs'));

        /** @var QuoteService|PHPUnit_Framework_MockObject_MockObject $quoteService */
        $quoteService = $this->createMock(QuoteService::class);
        $quoteService->method('getQuotesByAuthor')
            ->willReturn($quotes);

        $shoutService = new ShoutService($quoteService);

        $shouts = $shoutService->getShoutsByAuthor('Steve Jobs', 1);

        $this->assertCount(1, $shouts);
        $this->assertEquals('YOUR TIME IS LIMITED, SO DON’T WASTE IT LIVING SOMEONE ELSE’S LIFE!!', $shouts->first());
    }

    public function testManyShout()
    {
        $quotes = new ArrayCollection();
        $quotes->add(new Quote('Your time is limited, so don’t waste it living someone else’s life!', 'Steve Jobs'));
        $quotes->add(new Quote('The only way to do great work is to love what you do.', 'Steve Jobs'));

        /** @var QuoteService|PHPUnit_Framework_MockObject_MockObject $quoteService */
        $quoteService = $this->createMock(QuoteService::class);
        $quoteService->method('getQuotesByAuthor')
            ->willReturn($quotes);

        $shoutService = new ShoutService($quoteService);

        $shouts = $shoutService->getShoutsByAuthor('Steve Jobs', 1);

        $this->assertCount(2, $shouts);
        $this->assertEquals('YOUR TIME IS LIMITED, SO DON’T WASTE IT LIVING SOMEONE ELSE’S LIFE!!', $shouts->first());
        $this->assertEquals('THE ONLY WAY TO DO GREAT WORK IS TO LOVE WHAT YOU DO.!', $shouts->next());
    }

}