<?php

namespace App\Service;

use App\Entity\Quote;
use Doctrine\Common\Collections\ArrayCollection;

class ShoutService
{
    /**
     * @var QuoteService
     */
    private $quoteService;

    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }

    /**
     * Retrieves an Article resource
     * @param string $author
     * @param int $limit
     * @return ArrayCollection
     */
    public function getShoutsByAuthor($author, $limit): ArrayCollection
    {
        $quotes = $this->quoteService->getQuotesByAuthor($author, $limit);
        $shouts = new ArrayCollection();
        /** @var Quote $quote */
        foreach ($quotes as $quote) {
            $shouts->add(mb_strtoupper($quote->getQuote()) . '!');

        }

        return $shouts;
    }
}