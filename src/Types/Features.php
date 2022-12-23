<?php
namespace Romainjeff\Resales\Types;

/**
 * https://webapi.resales-online.com/V6/SearchFeatures?p_apiid={FILTER_ID}&p1={AGENTID}&p2={APIKEY}
 */
class Features
{
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
