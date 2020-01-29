<?php

namespace App\Quote;

use App\Entity\Quote;
use Doctrine\Common\Collections\ArrayCollection;

interface QuoteProviderInterface
{
    /**
     * @param string $author
     * @param int $limit
     * @return Quote[]|ArrayCollection
     */
    public function getQuotesByAuthor($author, $limit);

}