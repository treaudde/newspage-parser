<?php

namespace Tests\Unit;

use App\Exceptions\NewsContentNotSupportedException;
use App\Parsers\DRDkParser;
use App\Parsers\ABCEsParser;
use App\Parsers\NRKNoParser;
use PHPUnit\Framework\TestCase;
use App\Parsers\LemondeFrParser;
use App\Parsers\SpiegelDeParser;
use App\Parsers\RepubblicaItParser;
use App\Parsers\VolkskrantNlParser;
use App\Parsers\AftonbladetSeParser;
use App\Parsers\BBCPortugueseParser;
use App\Factories\NewsContentParserFactory;

class NewsContentParserFactoryTest extends TestCase
{
    protected $newsContentParserFactory;

    public function setUp(): void
    {
        parent::setUp();

        $this->newsContentParserFactory = app()->make(NewsContentParserFactory::class);
    }

    /**
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function testGetCorrectParser() : void
    {
        $newsContentParserFactory =

        //LeMonde.fr
        $parser = $this->newsContentParserFactory->getNewsContentParserByUrl('http://lemonde.fr/news_article.html');
        $this->assertTrue(($parser instanceof LemondeFrParser));

        //Abc.es
        $parser = $this->newsContentParserFactory->getNewsContentParserByUrl('http://abc.es/news_article.html');
        $this->assertTrue(($parser instanceof ABCEsParser));

        //Repubblica.it
        $parser = $this->newsContentParserFactory->getNewsContentParserByUrl('http://repubblica.it/news_article.html');
        $this->assertTrue(($parser instanceof RepubblicaItParser));

        //bbc.com/portuguese
        $parser = $this->newsContentParserFactory->getNewsContentParserByUrl('http://bbc.com/portuguese/news_article.html');
        $this->assertTrue(($parser instanceof BBCPortugueseParser));

        //spiegel.de
        $parser = $this->newsContentParserFactory->getNewsContentParserByUrl('http://spiegel.de/news_article.html');
        $this->assertTrue(($parser instanceof SpiegelDeParser));

        //volkskrant.nl
        $parser = $this->newsContentParserFactory->getNewsContentParserByUrl('http://volkskrant.nl/news_article.html');
        $this->assertTrue(($parser instanceof VolkskrantNlParser));

        //dr.dk
        $parser = $this->newsContentParserFactory->getNewsContentParserByUrl('http://dr.dk/news_article.html');
        $this->assertTrue(($parser instanceof DRDkParser));

        //Nrk.no
        $parser = $this->newsContentParserFactory->getNewsContentParserByUrl('http://nrk.no/news_article.html');
        $this->assertTrue(($parser instanceof NRKNoParser));

        //aftonbladet.se
        $parser = $this->newsContentParserFactory->getNewsContentParserByUrl('http://aftonbladet.se/news_article.html');
        $this->assertTrue(($parser instanceof AftonbladetSeParser));
    }

    public function testGetUnsupportedParser() : void
    {
        //unrecognized.com
        $this->expectException(NewsContentNotSupportedException::class);
        $parser = $this->newsContentParserFactory->getNewsContentParserByUrl('http://unrecognized.com/news_article.html');
    }
}
