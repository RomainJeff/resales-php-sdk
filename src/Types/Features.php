<?php
namespace Romainjeff\Resales\Types;

/**
 * https://webkit.resales-online.com/weblink/xml/V4-2/SearchFeaturesXML.asp?p1={ID}&p2={APIKEY}
 * 
 * Format: < Cat_Type > + < ConfigName > + < Feature attribute value > + ‘_2’
 */
class Features
{
    /* API V4 */
    //const CLOSE_TO_GOLF   = '1Setting11_2';
    //const CLOSE_TO_SEA    = '1Setting14_2';
    //const CLOSE_TO_TOWN   = '1Setting15_2';
    //const PRIVATE_POOL    = '1Pool2_2';
    //const COMMUNAL_POOL   = '1Pool1_2';
    //const SEA_VIEW        = '1Views1_2';
    //const MOUNTAIN_VIEW   = '1Views2_2';
    //const GOLF_VIEW       = '1Views3_2';
    //const PRIVATE_TERRACE = '1Features5_2';
    //const REDUCED         = '1Category10_2';

    /* API V5 */
    const CLOSE_TO_GOLF         = '1Setting11';
    const CLOSE_TO_SEA          = '1Setting14';
    const CLOSE_TO_TOWN         = '1Setting15';
    const PRIVATE_POOL          = '1Pool2';
    const COMMUNAL_POOL         = '1Pool1';
    const SEA_VIEW              = '1Views1';
    const MOUNTAIN_VIEW         = '1Views2';
    const GOLF_VIEW             = '1Views3';
    const PRIVATE_TERRACE       = '1Features5';
    const REDUCED               = '1Category10';
    const UNDERGROUND_PARKING   = '1Parking1';
    const COMMUNAL_PARKING      = '1Parking7';
    const PRIVATE_PARKING       = '1Parking8';
}
