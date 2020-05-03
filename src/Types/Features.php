<?php
namespace Romainjeff\Resales\Types;

/**
 * https://webkit.resales-online.com/weblink/xml/V4-2/SearchFeaturesXML.asp?p1={ID}&p2={APIKEY}
 * 
 * Format: < Cat_Type > + < ConfigName > + < Feature attribute value > + ‘_2’
 */
class Features
{
    const CLOSE_TO_GOLF   = '1Setting11_2';
    const CLOSE_TO_SEA    = '1Setting14_2';
    const CLOSE_TO_TOWN   = '1Setting15_2';
    const PRIVATE_POOL    = '1Pool2_2';
    const COMMUNAL_POOL   = '1Pool1_2';
    const SEA_VIEW        = '1Views1_2';
    const MOUNTAIN_VIEW   = '1Views2_2';
    const GOLF_VIEW       = '1Views3_2';
    const PRIVATE_TERRACE = '1Features5_2';
    const REDUCED         = '1Category10_2';
}
