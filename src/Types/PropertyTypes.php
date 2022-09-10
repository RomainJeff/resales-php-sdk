<?php
namespace Romainjeff\Resales\Types;

/**
 * https://webkit.resales-online.com/weblink/xml/V4-2/SearchPropertyTypesXML.asp?p1={ID}&p2={APIKEY}
 */
class PropertyTypes
{
    const APARTMENT                 = '1-1';
    const APARTMENT_GROUND_FLOOR    = '1-2';
    const APARTMENT_PENTHOUSE       = '1-6';
    const APARTMENT_PENTHOUSE_DUPLEX= '1-7';
    const APARTMENT_DUPLEX          = '1-8';
    const HOUSE                     = '2-1';
    const HOUSE_DETACHED            = '2-2';
    const HOUSE_SEMI_DETACHED       = '2-4';
    const HOUSE_TOWN                = '2-5';
    const HOUSE_FINCA_CORTIJO       = '2-6';
    const HOUSE_TERRACED            = '2-5';
    const PLOT                      = '3-1';
    const COMMERCIAL                = '4-1';
}
