<?php
return [
    'parsers' => [
        'lemonde.fr' => LemondeFrParser::class,
        'abc.es' => ABCEsParser::class,
        'repubblica.it' => RepubblicaItParser::class,
        'bbc.com/portuguese' => BBCPortugueseParser::class,
        'spiegel.de' => SpiegelDeParser::class, //may need another german news site
        'volkskrant.nl' => VolkskrantNlParser::class,
        'dr.dk' => DRDkParser::class,
        'nrk.no' => NRKNoParser::class,
        'aftonbladet.se' => AftonbladetSeParser::class,
    ],
];
