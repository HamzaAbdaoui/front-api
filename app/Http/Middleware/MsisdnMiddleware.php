<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class MsisdnMiddleware
{
    private $blockedNumbers = [
	 50013232,50011517,50011059,50011007,50011317,50012123,50012611,50013080,50012109,50012060,50011982,50011981,50012811,50012828,50012401,50015001,50011018,50012014,50011025,50011010,50011466,50013400,50011452,50012061,50012405,50011118,50011717,50013303,50019050,50013120,50011525,50012700,50011052,50012224,50011200,50013003,50013355,50012525,50011213,50011707,50011816,50013001,50012311,50013222,50011437,50013439,50011505,50011204,50011512,50011911,50011092,50011750,50011104,50012575,50011003,50013310,50011097,50011930,50011819,50012900,50011877,50013200,50012800,50012025,50012316,50012034,50011699,50011244,50012313,50013031,50012506,50011006,50011446,50012308,50012042,50012508,50013444,50011449,50013399,50012035,50012227,50012728,50011589,50012318,50012332,50012319,50011065,50011704,50011091,50012789,50012505,50013184,50011205,50011980,50011919,50011825,50013113,50015000,50013101,50011112,50012701,50012514,50011184,50013002,50011278,50011269,50013220,50012500,50012889,50011309,50012626,50012718,50012131,50013082,50013033,50013456,50011101,50012255,50012808,50012609,50011081,50013008,50013009,50011275,50011410,50011047,50012175,50012345,50011541,50011534,50012406,50011544,50011533,50011068,50011539,50011051,50012001,50013108,50012912,50012349,50012303,50012412,50011234,50011318,50012342,50011983,50013230,50012150,50013377,50011125,50013212,50011319,50012809,50011321,50012709,50011959,50012601,50011020,50012099,50012804,50011324,50012379,50012411,50012079,50012403,50013141,50012550,50011801,50011701,50015050,50011603,50012553,50012623,50011325,50013413,50013017,50012877,50011090,50012987,50012036,50011720,50011074,50011084,50012017,50012355,50012051,50011075,50011311,50011160,50011078,50011083,50011532,50011089,50011093,50011094,50011105,50011136,50011139,50011143,50011146,50011147,50011148,50011149,50011151,50011153,50011156,50011599,50011157,50011159,50011161,50011162,50011167,50011172,50011173,50011175,50011176,50011178,50011181,50011186,50011187,50011191,50011192,50011193,50011194,50011196,50011198,50011209,50011216,50011219,50011225,50011227,50011228,50011229,50011795,50011002,50011412,50013011,50012840,50012324,50013123,50013121,50011249,50011250,50011507,50013050,50011407,50013213,50015100,50011441,50012333,50011022,50012444,50013231,50012125,50013122,50012024,50012215,50011063,50011048,50011057,50011049,50011662,50011169,50012780,50011130,50011710,50012302,50011550,50011099,50013301,50011254,50012607,50011256,50012301,50012314,50012322,50011257,50011258,50011261,50011262,50011263,50011264,50011230,50011268,50011270,50011271,50011272,50011273,50011276,50011277,50013233,50011280,50011282,50012367,50012907,50011079,50011455,50011977,50012012,50011221,50013023,50011180,50011190,50011085,50011036,50012910,50011453,50011457,50011283,50011285,50011286,50011287,50011288,50011290,50011291,50011292,50011293,50011295,50011296,50011302,50011305,50011306,50011307,50011265,50012225,50011334,50011026,50011336,50011337,50011338,50011340,50011342,50011344,50011347,50011350,50011352,50011353,50011354,50011356,50011357,50011358,50011359,50011360,50011364,50012578,50011367,50011368,50011369,50011370,50011371,50012122,50011375,50011377,50011382,50011383,50011384,50011386,50011387,50011388,50011391,50011392,50011394,50011395,50011396,50011397,50011398,50011399,50011402,50011404,50011406,50011408,50012323,50011415,50011417,50011423,50011424,50011429,50011431,50011526,50011432,50011267,50011474,50011475,50011308,50011434,50011605,50011312,50011478,50011458,50011620,50011459,50011461,50011480,50012080,50011462,50011464,50011601,50011465,50011607,50011609,50011612,50011632,50011881,50011633,50011634,50011631,50011635,50011640,50011650,50011331,50011665,50011672,50011777,50011677,50012351,50011504,50011488,50011499,50011134,50011683,50011695,50011688,50011689,50011691,50011715,50011719,50013311,50011752,50011722,50015002,50011726,50011728,50011729,50011734,50011730,50011740,50011738,50011739,50011644,50011745,50011747,50011751,50011754,50011756,50011765,50011762,50011755,50011760,50011764,50011758,50011763,50011648,50011767,50011769,50011772,50011530,50012315,50011774,50011781,50011798,50011783,50011787,50011788,50011790,50011791,50011792,50011793,50011794,50011491,50012352,50011797,50011815,50011814,50011834,50011831,50011835,50011832,50011830,50011822,50011776,50011823,50011518,50011494,50012707,50011320,50011037,50013010,50012037,50011998,50012267,50011303,50012366,50012102,50012404,50012185,50011948,50011899,50012055,50011021,50012200,50011042,50013327,50011972,50011223,50011611,50011617,50011222,50011444,50012424,50011174,50011220,50012802,50011114,50011203,50011985,50011955,50012818,50013465,50011557,50011986,50012226,50012205,50012211,50011848,50011484,50011949,50011483,50011486,50011976,50011800,50011503,50011882,50012203,50011556,50012263,50012686,50011563,50011519,50012600,50011066,50011558,50012003,50011678,50011711,50011436,50012084,50011171,50011561,50011581,50011824,50011936,50011937,50011840,50011839,50011841,50011843,50011845,50011846,50011988,50011828,50011991,50011993,50011995,50011996,50011997,50012039,50012044,50012041,50012048,50012043,50012049,50012047,50011485,50011510,50012348,50011126,50011889,50011440,50011496,50012810,50011693,50011119,50011939,50011513,50011915,50011862,50011144,50011514,50011082,50011901,55322410,50012062,50012059,50012234,50011906,50012999,50011182,50011606,50012221,50012067,50012108,50011427,50012071,50011501,50011232,50012082,50012075,50012081,50012078,50012088,50012076,50012091,50011799,50012095,50012104,50011041,50012066,50015006,50012169,50012171,50012170,50011898,50011874,50011923,50011855,50011887,50011895,50011856,50011934,50011863,50012172,50012193,50012194,50012196,50012197,50011891,50011969,50011872,50011965,50012176,50012199,50012217,50012207,50012208,50012209,50012210,50012213,50012214,50011913,50011875,50011847,50011851,50012238,50012240,50012264,50012268,50012269,50012272,50012273,50012275,50012278,50011879,50012257,50012259,50012260,50012261,50012262,50011876,50012249,50012247,50012243,50012245,50012242,50012282,50011960,50012285,50012286,50011858,50011892,50012094,50011864,50012290,50012292,50012296,50012374,50012381,50012880,50012230,50012390,50012164,50012384,50012388,50012392,50012430,50012433,50012435,50012436,50011924,50011897,50011894,50011893,50011966,50011944,50011933,50011956,50012439,50011870,50011703,50011931,50012452,50012031,50011028,50012481,50012490,50012491,50012492,50012493,50012494,50012495,50012497,50012498,50012499,50012515,50012502,50012511,50012516,50011921,50012135,50011896,50012408,50012581,50011127,50011867,50012562,50012538,50012540,50012555,50012554,50012556,50012563,50012565,50012566,50012156,50012138,50011962,50011702,50013111,50011622,50011545,50012407,50013366,50011245,50013229,50011571,50011639,50012294,50012231,50012975,50012363,50011926,50012115,50011992,50011883,50012191,50011885,50011917,50011034,50011189,50011164,50012187,50012186,50012901,50011165,50011335,50012111,50011403,50011226,50011435,50012434,50012114,50012118,50012173,50011552,50012373,50012385,50012083,50012387,50012009,50012524,50012558,50011069,50012486,50012557,50012437,50012454,50012053,50012429,50013300,50011243,50011316,50012054,50011400,50013601,50011859,50011880,50011929,50012180,50011952,50012163,50012184,50012143,50011908,50012126,50011958,50012141,50011857,50012134,50011854,50011878,50011645,50012561,50011951,50011549,50013603,50013615,50011132,50012568,50011593,50012527,50012457,50013619,50013620,50012572,50012534,50012398,50012362,50011562,50013630,50012206,50012569,50013639,50011679,50011671,50011670,50013641,50012144,50011122,50013644,50011247,50013016,50012419,50012117,50012116,50011968,50012167,50012142,50012182,50013654,50013655,50012402,50012341,50011183,50013651,50012574,50012395,50012465,50012542,50012113,50012473,50012417,50012420,50012464,50013669,50013680,50013684,50013685,50013687,50013688,50011142,50011714,50012400,50011008,50011040,50011017,50011043,50011137,50011170,50013314,50012343,50015003,50011363,50011373,50011654,50011669,50015005,50011073,50012159,50012190,50012306,50012329,50012336,50012339,50012354,50012368,50012414,50012471,50012456,50012450,50012467,50012453,50012421,50012489,50013672,50012390,50012560,50011861,50011789,50011821,50011741,50011658,50012124,50011641,50011657,50011098,50011208,50012320,50011579,50012469,50012531,50011166,50012532,50012188,50012533,50012551,50012591,50013032,50012445,50011585,50011140,50012543,50011389,50011578,50113643,50013857,50013695,50013656,50013631,50011451,50013665,50012038,50011102,50011274,50011013,50013302,50012151,50011655,50011903,50011044,50011055,50011053,50012362,50012359,50011596,50011071,50012583,50011613,50011614,50011422,50011595,50011994,50012232,50011116,50011096,50011782,50013006,50011489,50011323,50011592,50011618,50011393,50011314,50011509,50011666,50012588,50012460,50012472,50012360,50011145,50011343,50013649,50011642,50011016,50011045,50011038,50011062,50013425,50011214,50011217,50011224,50011698,50011700,50011697,50011773,50011779,50011233,50011241,50011240,50011239,50011940,50011932,50011852,50011853,50011780,50011833,50011796,50011802,50011806,50011807,50011818,50011576,50011621,50011248,50011259,50012331,50012327,50012317,50012361,50012356,50012337,50012396,50012410,50012463,50012446,50012455,50012451,50012530,50012547,50011100,50011355,50011361,50011076,50012549,50012790,50012580,50012590,50011716,50011266,50011597,50017031,50011442,50013344,50012128,50011328,50011332,50011405,50011516,50011583,50012112,50011129,50012119,50011000,50011067,50011686,50011086,50011646,50011242,50011121,50011246,50011087,50011925,50011946,50011950,50011445,50011971,50011943,50011973,50011957,50011961,50011964,50011967,50011970,50011559,50011351,50011616,50011770,50011706,50011439,50011443,50011447,50011366,50011731,50011456,50011469,50011470,50011685,50011692,50011732,50011727,50011709,50011753,50011421,50011072,50013210,50011421,50011664,50011569,50011572,50011004,50011289,50011428,50011681,50011682,50011684,50012132,50011713,50011721,50012458,50011724,50012008,50012007,50012045,50012015,50012174,50012168,50012389,50012386,50011298,50012376,50011582,50012136,50012153,50011061,50011115,50011326,50011128,50011235,50011463,50011548,50011574,50011468,50012011,50013673,50011827,50012539,50012006,50011476,50013007,50011999,50011380,50011135,50012970,50012468,50011508,50011904,50012086,50011989,50011810,50013021,50011522,50012070,50012399,50011523,50012347,50011575,50011524,50013157,50011554,50011031,50011900,50011560,50012888,50011567,50012297,50012576,50012571,50012985
,50018368,50018375,50018377,50018403,50018413,50018422,50018221,50018229,50018233,50018313,50018323,50018045,50018192,50018059,50018066,50018085,50018190,50018157,50018324,50018197,50018164,50018438,50018021,50018249,50018050,50018019,50018312,50018158,50018003,50018297,50018206,50018010,50018315,50018262,50018006,50018171,50018170,50018130 ,50018245,50018024,50018274,50018344,50018308,50018381,50018351,50018144,50018443,50018548,50018227,50018295,50018094,50018070,50018063,50018131,50018134,50018012,50018099,50018258,50018402,50018477,50018237,50018023,50012278,50011795,50012286,50012390,50011262,50011677,50012249,50011002,50011839,50011191,50011518,50011622,50011144,50012257,50011285,50011192,50011965,50012296,50011756,50011757];
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (preg_match('/stores/', $request->path())) {
            return  $next($request);
        }

        $msisdn = $request->header('x-wassup-msisdn');
        if(!$msisdn)
            // Return unauthorized - Missing Header param
            return response()->json([
                'status'    => Response::HTTP_UNAUTHORIZED,
                'message'   => 'Missing Header parameter for MSISDN!',
                'data'      => [],
                'error'     => true
            ], Response::HTTP_UNAUTHORIZED);
            
        if(!preg_match('/^216(\d){8}$/', $msisdn))
            // Return unauthorized - not an Orange number
            return response()->json([
                'status'    => Response::HTTP_UNAUTHORIZED,
                'message'   => 'The provided MSISDN in not valid!',
                'data'      => [],
                'error'     => true
            ], Response::HTTP_UNAUTHORIZED);
        if(in_array($msisdn-21600000000, $this->blockedNumbers))
            // Number STAFF - not authorized
            return response()->json([
                'status'    => Response::HTTP_UNAUTHORIZED,
                'message'   => "Orange Go n'est pas disponible aux collaborateurs Orange Tunisie",
                'data'      => [],
                'error'     => true
            ], Response::HTTP_UNAUTHORIZED);
        
        return $next($request);
    }
}