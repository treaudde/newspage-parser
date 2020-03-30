<?php

namespace App\Factories;

use App\Parsers\Parser;
use App\Parsers\DRDkParser;
use App\Parsers\ABCEsParser;
use App\Parsers\NRKNoParser;
use App\Parsers\LemondeFrParser;
use App\Parsers\SpiegelDeParser;
use App\Parsers\RepubblicaItParser;
use App\Parsers\VolkskrantNlParser;
use App\Parsers\AftonbladetSeParser;
use App\Parsers\BBCPortugueseParser;
use App\Exceptions\NewsContentNotSupportedException;
use Illuminate\Contracts\Container\BindingResolutionException;

class NewsContentParserFactory
{
    /**
     * @var array
     */
    protected $parsers;

    /**
     * NewsContentParserFactory constructor.
     */
    public function __construct()
    {
        $this->parsers = [
            'lemonde.fr' => LemondeFrParser::class,
            'abc.es' => ABCEsParser::class,
            'repubblica.it' => RepubblicaItParser::class,
            'bbc.com/portuguese' => BBCPortugueseParser::class,
            'spiegel.de' => SpiegelDeParser::class, //may need another german news site
            'volkskrant.nl' => VolkskrantNlParser::class,
            'dr.dk' => DRDkParser::class,
            'nrk.no' => NRKNoParser::class,
            'aftonbladet.se' => AftonbladetSeParser::class,
        ];
    }

    /**
     * @param string $url
     * @return Parser
     * @throws BindingResolutionException
     */
    public function getNewsContentParserByUrl(string $url) : Parser
    {
        foreach ($this->parsers as $parser => $class) {
            if (strpos($url, $parser)) { //@TODO change to regex or some other way of matching
                return app()->make($class);
            }
        }

        throw new NewsContentNotSupportedException();
    }
}
