<?php

namespace App\Entity;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Doctrine\Common\Collections\ArrayCollection;

class Quotes
{
    /**
     * @var Quote[]|ArrayCollection $quotes
     * @SerializedName("quotes")
     */
    private $quotes;

    /**
     * @return Quote[]|ArrayCollection
     */
    public function getQuotes(): ArrayCollection
    {
        return $this->quotes;
    }

    /**
     * Quotes constructor.
     * @param Quote[]|ArrayCollection $quotes
     */
    public function __construct($quotes)
    {
        $this->quotes = new ArrayCollection($quotes);
    }
}