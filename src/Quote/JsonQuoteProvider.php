<?php

namespace App\Quote;

use App\Entity\Quotes;
use App\Entity\Quote;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Psr\Cache\InvalidArgumentException;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\Cache\CacheInterface;

class JsonQuoteProvider
{
    /**
     * @var string
     */
    private $jsonFile;
    /**
     * @var SerializerInterface
     */
    private $serializer;
    /**
     * @var CacheInterface
     */
    private $cache;

    /**
     * JsonQuoteProvider constructor.
     * @param SerializerInterface $serializer
     * @param CacheInterface $cache
     */
    public function __construct(SerializerInterface $serializer, CacheInterface $cache)
    {
        $this->serializer = $serializer;
        $this->cache = $cache;
    }

    public function setJsonFile(string $jsonFile)
    {
        $this->jsonFile = $jsonFile;
    }

    /**
     * @param string $author
     * @param int $limit
     * @return Quote[]|ArrayCollection
     */
    public function getQuotesByAuthor(string $author, int $limit = 0): ArrayCollection
    {
        $filteredQuotes = new ArrayCollection();
        try {
            $filteredQuotes = $this->cache->get($author . '_' . $limit,
                function () use ($author, $limit) {
                    $quotes = $this->getQuotesFromFile();

                    $criteria = Criteria::create()
                        ->andWhere(Criteria::expr()->eq('author', ucwords(strtolower($author))))
                        ->setMaxResults($limit);

                    $filteredQuotes = $quotes->matching($criteria);

                    return $filteredQuotes;
                });
        } catch (InvalidArgumentException $e) {

        }

        return $filteredQuotes;
    }

    /**
     * @return Quote[]|ArrayCollection
     */
    private function getQuotesFromFile()
    {
        $finder = new Finder();
        $quotesJsonFile = '';
        $pathInfo = pathinfo($this->jsonFile);
        $finder->files()->in($pathInfo['dirname'])->name($pathInfo['basename']);
        foreach ($finder as $file) {
            $quotesJsonFile = $file->getContents();
        }
        /** @var Quotes $deserializedQuotes */
        $deserializedQuotes = $this->serializer->deserialize(
            $quotesJsonFile, Quotes::class,
            'json', ['allow_extra_attributes' => true]);

        return $deserializedQuotes->getQuotes();
    }

}