<?php

namespace App\Service;

use App\Entity\Quote;
use App\Quote\JsonQuoteProvider;
use App\Quote\QuoteProviderInterface;
use Doctrine\Common\Collections\ArrayCollection;

class QuoteService
{
    /**
     * @var QuoteProviderInterface
     */
    private $quoteProvider;

    public function __construct(JsonQuoteProvider $quoteProvider)
    {
        $this->quoteProvider = $quoteProvider;
        $quoteProvider->setJsonFile(__DIR__.'/../../var/quote/quotes.json');
    }

    /**
     * @param string $author
     * @param int $limit
     * @return Quote[]|ArrayCollection
     */
    public function getQuotesByAuthor($author, $limit): ArrayCollection
    {
        return $this->quoteProvider->getQuotesByAuthor($author, $limit);
    }
}