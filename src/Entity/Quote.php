<?php


namespace App\Entity;

use Symfony\Component\Serializer\Annotation\SerializedName;

class Quote
{
    /**
     * @var string $quote
     * @SerializedName("quote")
     */
    private $quote;
    /**
     * @var string $author;
     * @SerializedName("author")
     */
    private $author;

    /**
     * @return string
     */
    public function getQuote(): string
    {
        return $this->quote;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Quote constructor.
     * @param string $quote
     * @param string $author
     */
    function __construct($quote, $author)
    {
        $this->quote = $quote;
        $this->author = $author;
    }
}