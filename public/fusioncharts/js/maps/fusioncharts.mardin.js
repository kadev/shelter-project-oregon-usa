(function(factory){if(typeof module==="object"&&typeof module.exports!=="undefined"){module.exports=factory}else{factory(FusionCharts)}})(function(FusionCharts){(function(modules){var installedModules={};function __webpack_require__(moduleId){if(installedModules[moduleId]){return installedModules[moduleId].exports}var module=installedModules[moduleId]={i:moduleId,l:false,exports:{}};modules[moduleId].call(module.exports,module,module.exports,__webpack_require__);module.l=true;return module.exports}__webpack_require__.m=modules;__webpack_require__.c=installedModules;__webpack_require__.d=function(exports,name,getter){if(!__webpack_require__.o(exports,name)){Object.defineProperty(exports,name,{configurable:false,enumerable:true,get:getter})}};__webpack_require__.r=function(exports){Object.defineProperty(exports,"__esModule",{value:true})};__webpack_require__.n=function(module){var getter=module&&module.__esModule?function getDefault(){return module["default"]}:function getModuleExports(){return module};__webpack_require__.d(getter,"a",getter);return getter};__webpack_require__.o=function(object,property){return Object.prototype.hasOwnProperty.call(object,property)};__webpack_require__.p="";return __webpack_require__(__webpack_require__.s=586)})({586:function(module,exports,__webpack_require__){"use strict";var _fusioncharts=__webpack_require__(587);var _fusioncharts2=_interopRequireDefault(_fusioncharts);function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{"default":obj}}FusionCharts.addDep(_fusioncharts2["default"])},587:function(module,exports,__webpack_require__){"use strict";exports.__esModule=true;
/**!
 * @license FusionCharts JavaScript Library
 * Copyright FusionCharts, Inc.
 * License Information at <http://www.fusioncharts.com/license>
 *
 * @author FusionCharts, Inc.
 * @meta package_map_pack
 * @id fusionmaps.Mardin.1.02-22-2017 12:07:38
 */var M="M",L="L",Z="Z",Q="Q",LFT="left",RGT="right",CEN="center",MID="middle",TOP="top",BTM="bottom",geodefinitions=[{name:"Mardin",revision:1,standaloneInit:true,baseWidth:700,baseHeight:367,baseScaleFactor:10,entities:{"TR.MR.DA":{outlines:[[M,6671,182,Q,6649,191,6647,192,6635,195,6612,206,6589,216,6559,229,6530,242,6425,283,6418,287,6399,295,6377,306,6368,310,6358,313,6353,314,6347,315,6340,318,6333,321,6322,325,6312,331,6310,331,6272,346,6253,352,6252,353,6240,361,6230,367,6224,368,6216,369,6207,372,6197,374,6191,377,6184,381,6169,386,6152,391,6143,394,6138,395,6130,400,6122,404,6118,405,6117,406,6103,409,6097,411,6086,415,6058,426,6033,439,L,5980,460,Q,5975,462,5969,473,5963,483,5950,495,5937,507,5932,513,5927,518,5925,520,5924,522,5920,527,5918,531,5914,535,5913,535,5913,536,L,5880,572,Q,5859,594,5855,597,5854,598,5838,613,5831,620,5828,628,5826,635,5806,654,5786,673,5778,683,5774,696,5772,697,5769,699,5763,708,5759,714,5754,723,5747,737,5746,739,5723,776,5717,790,5711,803,5687,837,5675,851,5674,860,5672,866,5670,869,5678,887,5716,930,5734,952,5776,996,5801,1027,5838,1046,5870,1063,5918,1075,5931,1075,5937,1078,5941,1080,5946,1082,5950,1084,5956,1084,5967,1083,5975,1085,5979,1085,5986,1089,5994,1093,5999,1094,6009,1095,6011,1095,6014,1097,6017,1102,L,6027,1119,Q,6031,1125,6047,1136,L,6054,1143,Q,6055,1144,6058,1153,6060,1161,6073,1171,6085,1180,6086,1187,6086,1195,6089,1197,6093,1199,6099,1205,6099,1206,6116,1224,6117,1225,6126,1234,6131,1239,6136,1241,6139,1242,6146,1243,6147,1243,6153,1251,6163,1264,6168,1269,6174,1276,6186,1284,6189,1281,6198,1280,6204,1279,6215,1278,6219,1278,6228,1273,6236,1270,6243,1271,6250,1272,6261,1265,L,6267,1262,Q,6270,1262,6276,1262,6282,1260,6292,1256,6302,1252,6311,1253,6326,1253,6348,1246,6368,1241,6377,1241,6383,1241,6397,1234,6401,1232,6411,1231,6412,1231,6419,1231,6427,1231,6428,1230,L,6447,1223,Q,6452,1221,6462,1222,6473,1222,6479,1220,6496,1212,6512,1211,6518,1211,6529,1207,6540,1203,6545,1203,6549,1204,6561,1200,6574,1195,6575,1195,6583,1195,6608,1195,6633,1195,6642,1194,6648,1194,6658,1189,6669,1184,6675,1183,6681,1182,6690,1182,6695,1182,6702,1183,6703,1183,6704,1183,6710,1183,6719,1180,6724,1178,6732,1174,6737,1172,6749,1173,6757,1171,6765,1167,6779,1161,6790,1145,6795,1138,6812,1120,6815,1117,6818,1115,6823,1112,6826,1109,6828,1106,6838,1103,6848,1095,6865,1079,6868,1076,6875,1069,6882,1062,6887,1056,6888,1054,6893,1050,6896,1048,6899,1045,6903,1040,6906,1039,6906,1038,6906,1033,6906,1028,6902,1025,6897,1021,6896,1015,6895,1003,6895,994,6896,989,6892,982,6887,974,6887,969,6886,964,6886,956,6887,950,6887,946,6887,944,6887,942,6887,933,6883,922,6878,906,6877,900,6878,880,6874,873,6867,859,6867,849,6866,842,6867,824,6867,818,6863,810,L,6858,801,Q,6858,784,6856,774,6854,764,6853,763,6852,762,6852,755,6851,748,6853,748,6854,747,6858,740,6862,734,6867,726,6872,718,6874,715,6882,705,6907,676,6916,665,6923,655,6929,646,6944,631,6959,615,6959,607,6959,604,6937,573,6913,539,6910,534,L,6887,502,Q,6869,477,6864,469,6864,468,6863,467,6850,448,6826,411,6795,365,6787,352,6757,312,6743,293,6720,262,6707,232,Q,6675,182,6671,182,Z]],label:"Dargeçit",shortLabel:"DA",labelPosition:[631.4,73.3],labelAlignment:[CEN,MID]},"TR.MR.DE":{outlines:[[M,1030,868,Q,1001,859,992,857,974,849,971,850,958,851,949,849,921,839,912,839,893,839,887,839,877,838,869,834,864,831,824,832,784,833,762,826,740,818,695,823,672,831,641,848,623,858,593,875,583,880,550,905,523,926,499,934,451,949,450,949,419,959,397,961,362,966,338,973,328,976,292,976,265,976,259,975,243,974,233,966,L,167,966,Q,166,966,164,967,148,967,133,966,117,965,106,957,L,35,957,35,969,Q,36,984,35,1014,36,1039,44,1056,54,1079,61,1100,70,1132,75,1145,L,75,1146,Q,91,1182,128,1278,147,1321,181,1400,181,1401,182,1401,195,1431,237,1527,278,1618,307,1671,308,1672,308,1673,333,1728,371,1801,420,1894,438,1929,438,1931,439,1931,451,1961,475,2012,477,2015,487,2033,495,2047,496,2053,502,2073,511,2093,524,2122,553,2182,577,2233,596,2264,L,596,2264,Q,609,2293,671,2435,715,2538,740,2605,744,2618,768,2676,790,2729,798,2753,799,2754,801,2759,807,2754,821,2754,842,2753,850,2751,866,2747,897,2743,900,2743,940,2734,966,2728,996,2725,1017,2724,1052,2722,1082,2720,1104,2715,1124,2711,1153,2704,1179,2699,1205,2696,1234,2693,1250,2686,1261,2681,1272,2680,1295,2675,1297,2675,1330,2666,1413,2652,1468,2640,1524,2620,1562,2606,1617,2580,1619,2579,1621,2579,1632,2574,1647,2562,1662,2551,1679,2540,1696,2530,1709,2521,1722,2512,1759,2478,1797,2444,1805,2432,1812,2420,1842,2392,1872,2364,1888,2349,1890,2347,1910,2331,1924,2319,1932,2309,1948,2291,1953,2282,1961,2270,1960,2250,1961,2239,1968,2223,1973,2200,1978,2189,1978,2182,1983,2167,1988,2152,1988,2148,L,1988,2111,Q,1989,2082,1988,2069,1988,2065,1982,2049,1978,2037,1979,2023,1980,2004,1979,1974,1978,1942,1978,1933,L,1978,1891,Q,1978,1873,1977,1858,1976,1856,1976,1853,L,1967,1853,Q,1957,1856,1942,1856,1932,1856,1931,1857,L,1930,1857,Q,1925,1856,1920,1853,1913,1849,1906,1848,1900,1847,1888,1848,1871,1848,1866,1848,1846,1849,1837,1848,1824,1848,1815,1844,1788,1830,1768,1823,1748,1814,1741,1812,1732,1809,1729,1807,1726,1802,1719,1799,1713,1796,1698,1791,1684,1787,1678,1783,L,1612,1747,Q,1607,1742,1600,1738,1592,1734,1588,1731,1578,1725,1572,1716,1566,1707,1567,1696,1565,1694,1564,1691,1563,1688,1562,1685,1561,1683,1559,1679,1557,1676,1557,1665,1557,1663,1557,1662,1554,1647,1545,1631,1533,1611,1526,1597,1519,1581,1514,1570,1505,1549,1500,1543,1496,1539,1491,1528,1485,1516,1484,1513,L,1474,1501,Q,1471,1497,1467,1496,1467,1495,1463,1492,1457,1488,1449,1482,1441,1476,1437,1473,1434,1469,1425,1461,1419,1456,1416,1451,1416,1449,1415,1448,1414,1446,1411,1446,L,1406,1445,1398,1438,Q,1392,1427,1389,1427,1386,1427,1382,1427,1375,1426,1373,1426,1372,1426,1345,1427,1332,1427,1322,1416,L,1103,1416,Q,1093,1413,1087,1412,1075,1409,1063,1410,1037,1412,1028,1401,1001,1369,997,1365,995,1363,995,1334,L,995,1310,Q,996,1305,999,1300,1002,1294,1003,1290,1004,1272,1004,1242,986,1234,976,1229,965,1223,962,1222,951,1222,946,1219,926,1206,917,1200,915,1198,913,1185,912,1169,912,1168,912,1157,914,1156,918,1153,926,1145,938,1133,943,1127,947,1121,961,1108,979,1093,984,1088,989,1082,999,1066,1010,1049,1013,1044,1020,1024,1024,1019,1029,1009,1037,992,1037,991,1038,989,1039,986,1041,980,L,1042,947,Q,1042,915,1039,909,1036,899,1033,887,1030,874,1031,868,Q,1030,868,1030,868,Z]],label:"Derik",shortLabel:"DE",labelPosition:[101.2,179],labelAlignment:[CEN,MID]},"TR.MR.KI":{outlines:[[M,2696,1791,Q,2657,1788,2613,1788,2598,1788,2590,1788,2575,1788,2569,1786,2545,1777,2531,1777,2504,1778,2491,1777,2483,1776,2477,1774,2472,1780,2467,1782,2461,1784,2459,1785,2457,1786,2450,1786,2442,1786,2437,1791,2419,1800,2416,1800,2413,1800,2409,1800,2405,1800,2393,1801,2381,1802,2353,1801,2324,1799,2313,1799,2270,1800,2249,1800,2229,1800,2207,1798,2177,1799,2148,1805,2127,1809,2092,1819,2083,1822,2078,1824,2070,1826,2063,1826,2059,1826,2052,1831,2041,1838,2039,1839,2022,1849,2012,1853,1994,1862,1977,1858,1978,1873,1978,1891,L,1978,1933,Q,1978,1942,1979,1974,1980,2004,1979,2023,1978,2037,1982,2049,1988,2065,1988,2069,1989,2082,1988,2111,L,1988,2148,Q,1988,2152,1983,2167,1978,2182,1978,2189,1973,2200,1968,2223,1961,2239,1960,2250,1961,2270,1953,2282,1948,2291,1932,2309,1924,2319,1910,2331,1890,2347,1888,2349,1872,2364,1842,2392,1812,2420,1805,2432,1797,2444,1759,2478,1722,2512,1709,2521,1696,2530,1679,2540,1662,2551,1647,2562,1632,2574,1621,2579,1619,2579,1617,2580,1562,2606,1524,2620,1468,2640,1413,2652,1330,2666,1297,2675,1295,2675,1272,2680,1261,2681,1250,2686,1234,2693,1205,2696,1179,2699,1153,2704,1124,2711,1104,2715,1082,2720,1052,2722,1017,2724,996,2725,966,2728,940,2734,900,2743,897,2743,866,2747,850,2751,842,2753,821,2754,807,2754,801,2759,808,2775,834,2836,857,2891,857,2916,857,2933,857,2943,854,2961,852,2992,851,3023,851,3039,852,3056,854,3067,856,3078,862,3103,864,3111,867,3127,871,3142,877,3163,883,3183,893,3206,902,3228,917,3258,L,918,3258,Q,937,3308,976,3365,988,3381,1046,3458,1053,3467,1064,3481,1073,3492,1079,3504,1082,3511,1100,3525,1122,3542,1124,3544,1141,3562,1172,3580,1190,3591,1226,3609,1230,3611,1241,3613,1252,3616,1259,3622,1260,3623,1275,3634,1291,3645,1294,3645,1471,3526,1509,3498,1547,3471,1619,3424,1701,3371,1747,3346,1798,3298,1917,3246,1960,3227,1998,3221,2038,3215,2054,3213,2061,3212,2093,3213,2130,3213,2136,3209,2180,3184,2191,3179,2193,3179,2238,3159,2271,3146,2284,3136,2318,3112,2392,3080,2480,3041,2503,3029,2504,3028,2504,3028,2576,2992,2594,2982,2645,2955,2674,2935,2707,2912,2714,2908,2719,2905,2734,2900,2751,2892,2757,2890,2765,2885,2781,2883,2795,2881,2804,2876,2823,2864,2852,2861,2859,2859,2876,2850,2893,2841,2900,2840,2920,2836,2951,2824,2985,2813,2996,2810,3020,2803,3047,2800,3118,2790,3138,2788,3181,2784,3237,2783,3245,2782,3262,2783,3277,2783,3288,2781,3312,2775,3326,2774,3318,2747,3295,2707,3292,2703,3287,2691,3283,2680,3279,2673,3276,2670,3265,2643,3245,2599,3236,2580,3223,2558,3217,2548,3209,2534,3207,2519,3207,2517,3207,2515,3205,2475,3191,2413,3173,2336,3170,2316,3170,2315,3169,2314,3165,2303,3150,2280,3136,2256,3133,2244,3129,2231,3118,2207,3106,2184,3102,2174,3082,2138,3054,2101,3021,2060,3002,2035,2997,2029,2979,2001,2965,1979,2954,1968,2942,1956,2922,1932,2901,1910,2891,1899,2875,1867,2841,1844,2829,1835,2775,1804,2759,1795,2735,1793,Q,2709,1792,2696,1791,Z]],label:"Kiziltepe",shortLabel:"KI",labelPosition:[206.3,271],labelAlignment:[CEN,MID]},"TR.MR.MR":{outlines:[[M,3469,1431,Q,3459,1424,3457,1420,3449,1409,3445,1402,L,3433,1380,Q,3432,1378,3432,1370,3431,1363,3430,1359,3422,1343,3423,1319,3423,1317,3423,1315,3423,1302,3423,1301,3416,1290,3416,1286,3415,1281,3415,1259,3410,1258,3406,1257,3383,1253,3371,1252,3349,1251,3310,1243,3307,1242,3299,1238,3293,1235,3287,1234,3262,1229,3252,1228,3240,1226,3223,1219,3204,1209,3195,1207,3188,1206,3161,1197,3149,1192,3133,1190,3133,1190,3119,1184,3110,1182,3103,1182,3092,1184,3073,1174,L,2892,1173,Q,2881,1174,2880,1174,2875,1175,2871,1179,L,2852,1194,Q,2845,1203,2834,1202,2816,1202,2806,1202,L,2798,1202,Q,2794,1202,2789,1202,2770,1201,2763,1202,2755,1203,2745,1199,2734,1194,2730,1194,L,2682,1193,Q,2681,1193,2677,1188,2673,1183,2672,1182,L,2653,1182,Q,2653,1193,2652,1195,2650,1197,2645,1201,2642,1203,2642,1205,L,2642,1230,Q,2642,1232,2642,1238,2641,1245,2640,1246,2632,1256,2633,1263,2633,1268,2631,1271,2629,1274,2624,1278,2618,1282,2610,1292,2593,1315,2585,1324,2572,1338,2551,1338,2533,1338,2530,1333,2526,1327,2502,1327,2484,1327,2482,1327,2481,1327,2460,1335,2457,1336,2445,1337,2434,1338,2427,1341,2424,1342,2412,1347,2400,1355,2395,1357,2393,1358,2378,1364,2369,1369,2361,1369,L,2304,1408,Q,2303,1409,2297,1414,2292,1419,2290,1422,L,2290,1439,Q,2291,1446,2287,1460,2285,1466,2283,1474,2282,1475,2282,1476,2279,1520,2281,1534,2281,1539,2291,1553,2303,1573,2304,1574,2309,1584,2318,1594,2323,1599,2333,1610,2339,1618,2358,1646,2436,1736,2457,1762,2465,1770,2477,1774,2483,1776,2491,1777,2504,1778,2531,1777,2545,1777,2569,1786,2575,1788,2590,1788,2598,1788,2613,1788,2657,1788,2696,1791,2709,1792,2735,1793,2759,1795,2775,1804,2829,1835,2841,1844,2875,1867,2891,1899,2901,1910,2922,1932,2942,1956,2954,1968,2965,1979,2979,2001,2997,2029,3002,2035,3021,2060,3054,2101,3082,2138,3102,2174,3106,2184,3118,2207,3129,2231,3133,2244,3136,2256,3150,2280,3165,2303,3169,2314,3170,2315,3170,2316,3173,2336,3191,2413,3205,2475,3207,2515,3207,2517,3207,2519,3209,2534,3217,2548,3223,2558,3236,2580,3245,2599,3265,2643,3276,2670,3279,2673,3283,2680,3287,2691,3292,2703,3295,2707,3318,2747,3326,2774,3333,2773,3338,2773,3349,2774,3366,2770,3391,2764,3393,2764,3420,2759,3446,2761,3457,2761,3464,2762,3464,2762,3465,2762,3466,2761,3466,2762,3475,2762,3512,2762,3520,2762,3527,2764,3531,2766,3541,2771,3546,2773,3576,2782,3583,2784,3593,2784,3606,2785,3612,2786,3618,2787,3652,2797,3680,2806,3686,2805,3692,2804,3702,2809,3713,2815,3720,2814,3725,2813,3737,2814,3751,2815,3756,2814,3765,2812,3768,2817,3773,2822,3784,2824,3792,2825,3801,2829,3810,2834,3816,2833,3821,2833,3829,2835,3842,2839,3846,2840,3853,2842,3865,2842,3876,2842,3881,2843,3964,2872,4016,2872,4021,2874,4039,2879,4044,2880,4054,2883,4062,2887,4070,2888,4077,2890,4095,2892,4112,2894,4122,2898,4134,2902,4157,2908,4178,2914,4184,2916,4188,2917,4198,2919,4207,2921,4211,2922,4221,2925,4239,2935,4255,2940,4294,2950,4322,2957,4348,2967,4360,2973,4401,2984,4436,2993,4457,3004,L,4638,3004,4595,2822,Q,4577,2759,4573,2729,4568,2697,4563,2685,4557,2674,4556,2661,4555,2650,4554,2642,4554,2641,4553,2640,4551,2629,4545,2612,4536,2588,4534,2579,4530,2555,4527,2545,4525,2540,4518,2534,4518,2533,4507,2525,4488,2511,4463,2487,4445,2470,4414,2454,4393,2442,4360,2423,4318,2398,4310,2394,4297,2387,4292,2384,4284,2379,4282,2374,4281,2371,4281,2358,4281,2354,4272,2342,4257,2327,4251,2320,4243,2310,4240,2295,4223,2263,4172,2181,4151,2145,4137,2122,4130,2111,4119,2092,4110,2074,4104,2064,4103,2058,4097,2054,4096,2054,4095,2053,4086,2049,4074,2044,4062,2038,4052,2041,4042,2044,4026,2043,4009,2042,3996,2035,3991,2033,3982,2033,3968,2033,3966,2033,3956,2032,3954,2031,3948,2029,3942,2025,3933,2018,3917,2015,3901,2012,3889,2004,3882,1999,3860,1992,3839,1986,3823,1975,3792,1955,3775,1945,3763,1936,3753,1921,3743,1905,3742,1894,3742,1889,3735,1879,3733,1877,3733,1873,3733,1870,3733,1868,3732,1863,3724,1844,3715,1821,3713,1814,3712,1801,3710,1798,3705,1791,3704,1780,3703,1772,3698,1763,3692,1752,3691,1749,3686,1734,3679,1720,3667,1701,3661,1688,3659,1685,3657,1675,3657,1673,3657,1671,L,3643,1671,Q,3637,1677,3626,1679,3613,1681,3608,1685,3603,1688,3588,1689,3572,1690,3571,1690,3566,1691,3563,1691,3558,1692,3555,1695,3553,1697,3549,1697,3543,1698,3541,1698,3528,1697,3523,1697,3513,1697,3509,1701,3502,1706,3491,1710,3480,1714,3474,1720,3471,1722,3466,1724,3461,1725,3459,1726,3448,1734,3444,1737,3440,1739,3434,1744,3430,1748,3425,1749,L,3408,1749,Q,3371,1749,3368,1749,3324,1749,3321,1747,3309,1729,3280,1695,3272,1687,3274,1666,3275,1637,3275,1636,3273,1618,3268,1606,3265,1598,3265,1585,3265,1575,3274,1570,3284,1564,3285,1556,3285,1549,3291,1539,3298,1525,3299,1522,3303,1511,3322,1498,3332,1490,3353,1478,3368,1466,3384,1466,3396,1466,3400,1466,3408,1464,3417,1458,3421,1456,3431,1455,3437,1455,3448,1455,3453,1454,3460,1450,3464,1448,3471,1442,L,3471,1442,Q,3469,1440,3470,1436,Q,3470,1433,3469,1431,Z]],label:"Mardin",shortLabel:"MR",labelPosition:[345.9,208.8],labelAlignment:[CEN,MID]},"TR.MR.MA":{outlines:[[M,2207,639,Q,2192,629,2177,617,2158,602,2147,594,2132,583,2119,576,2102,566,2097,557,2088,558,2076,558,2060,558,2009,552,1961,545,1937,545,1937,545,1934,546,1930,546,1917,546,1884,546,1880,546,1855,546,1830,552,1815,555,1782,580,1772,587,1758,594,1746,600,1736,608,1708,630,1655,669,1596,712,1569,733,1533,746,1493,786,1446,835,1421,859,1414,866,1402,874,1388,882,1382,886,1348,906,1342,906,1308,905,1287,907,1264,909,1242,909,L,1213,909,Q,1208,909,1200,906,1191,904,1187,903,1173,901,1157,902,1134,902,1132,902,1126,902,1109,894,1088,885,1085,884,1070,881,1062,879,1048,876,1041,869,L,1033,869,Q,1032,868,1031,868,1030,874,1033,887,1036,899,1039,909,1042,915,1042,947,L,1041,980,Q,1039,986,1038,989,1037,991,1037,992,1029,1009,1024,1019,1020,1024,1013,1044,1010,1049,999,1066,989,1082,984,1088,979,1093,961,1108,947,1121,943,1127,938,1133,926,1145,918,1153,914,1156,912,1157,912,1168,912,1169,913,1185,915,1198,917,1200,926,1206,946,1219,951,1222,962,1222,965,1223,976,1229,986,1234,1004,1242,1004,1272,1003,1290,1002,1294,999,1300,996,1305,995,1310,L,995,1334,Q,995,1363,997,1365,1001,1369,1028,1401,1037,1412,1063,1410,1075,1409,1087,1412,1093,1413,1103,1416,L,1322,1416,Q,1332,1427,1345,1427,1372,1426,1373,1426,1375,1426,1382,1427,1386,1427,1389,1427,1392,1427,1398,1438,L,1406,1445,1411,1446,Q,1414,1446,1415,1448,1416,1449,1416,1451,1419,1456,1425,1461,1434,1469,1437,1473,1441,1476,1449,1482,1457,1488,1463,1492,1467,1495,1467,1496,1471,1497,1474,1501,L,1484,1513,Q,1485,1516,1491,1528,1496,1539,1500,1543,1505,1549,1514,1570,1519,1581,1526,1597,1533,1611,1545,1631,1554,1647,1557,1662,1557,1663,1557,1665,1557,1676,1559,1679,1561,1683,1562,1685,1563,1688,1564,1691,1565,1694,1567,1696,1566,1707,1572,1716,1578,1725,1588,1731,1592,1734,1600,1738,1607,1742,1612,1747,L,1678,1783,Q,1684,1787,1698,1791,1713,1796,1719,1799,1726,1802,1729,1807,1732,1809,1741,1812,1748,1814,1768,1823,1788,1830,1815,1844,1824,1848,1837,1848,1846,1849,1866,1848,1871,1848,1888,1848,1900,1847,1906,1848,1913,1849,1920,1853,1925,1856,1930,1857,L,1930,1856,1931,1857,Q,1932,1856,1942,1856,1957,1856,1967,1853,L,1976,1853,Q,1976,1856,1977,1858,1994,1862,2012,1853,2022,1849,2039,1839,2041,1838,2052,1831,2059,1826,2063,1826,2070,1826,2078,1824,2083,1822,2092,1819,2127,1809,2148,1805,2177,1799,2207,1798,2229,1800,2249,1800,2270,1800,2313,1799,2324,1799,2353,1801,2381,1802,2393,1801,2405,1800,2409,1800,2413,1800,2416,1800,2419,1800,2437,1791,2442,1786,2450,1786,2457,1786,2459,1785,2461,1784,2467,1782,2472,1780,2477,1774,2465,1770,2457,1762,2436,1736,2358,1646,2339,1618,2333,1610,2323,1599,2318,1594,2309,1584,2304,1574,2303,1573,2291,1553,2281,1539,2281,1534,2279,1520,2282,1476,2282,1475,2283,1474,2285,1466,2287,1460,2291,1446,2290,1439,L,2290,1422,Q,2292,1419,2297,1414,2303,1409,2304,1408,L,2361,1369,Q,2369,1369,2378,1364,2393,1358,2395,1357,2400,1355,2412,1347,2424,1342,2427,1341,2434,1338,2445,1337,2457,1336,2460,1335,2481,1327,2482,1327,2484,1327,2502,1327,2526,1327,2530,1333,2533,1338,2551,1338,2572,1338,2585,1324,2593,1315,2610,1292,2618,1282,2624,1278,2629,1274,2631,1271,2633,1268,2633,1263,2632,1256,2640,1246,2641,1245,2642,1238,2642,1232,2642,1230,L,2642,1205,Q,2642,1203,2645,1201,2650,1197,2652,1195,2653,1193,2653,1182,2646,1180,2643,1169,2639,1160,2641,1152,2641,1151,2638,1144,2634,1137,2634,1135,L,2632,1116,Q,2632,1111,2626,1101,2619,1088,2617,1084,2615,1078,2613,1067,2612,1057,2611,1053,2604,1040,2597,1016,2589,988,2586,982,2584,977,2581,964,2578,952,2577,949,2566,924,2563,917,2562,909,2553,895,L,2534,868,Q,2526,851,2521,841,2512,825,2499,823,2488,821,2487,821,2481,819,2477,815,2476,814,2449,797,2447,797,2422,786,2405,778,2399,770,L,2346,732,Q,2336,724,2321,716,2303,707,2295,701,2289,697,2271,688,2260,683,2256,681,2250,678,2246,672,2240,663,2228,655,Q,2211,642,2207,639,Z]],label:"Mazidagi",shortLabel:"MA",labelPosition:[178.2,120.2],labelAlignment:[CEN,MID]},"TR.MR.MI":{outlines:[[M,5666,871,Q,5650,870,5642,871,5637,871,5602,877,5581,880,5559,881,5553,881,5538,887,5525,891,5515,890,5508,889,5493,896,5476,902,5468,902,5460,901,5419,904,5415,904,5397,908,5381,911,5373,910,5367,910,5350,916,5333,922,5327,922,5319,921,5304,926,5293,929,5292,930,5281,930,5279,931,L,5170,931,Q,5146,935,5132,939,L,5105,939,Q,5084,940,5074,941,5049,948,5039,948,5009,947,5005,947,4989,948,4963,958,L,4426,958,4424,957,4392,956,Q,4389,956,4381,957,4371,957,4369,954,4344,971,4335,984,4332,989,4327,993,4320,998,4318,1e3,L,4215,1079,Q,4203,1090,4179,1102,4177,1104,4138,1122,4128,1127,4117,1133,4124,1141,4130,1155,4138,1172,4143,1181,4147,1186,4160,1204,4171,1219,4174,1225,4176,1232,4183,1243,4187,1250,4196,1263,4203,1274,4210,1282,4214,1287,4225,1298,4234,1307,4241,1318,4249,1331,4255,1337,4266,1351,4270,1354,4280,1365,4290,1368,4308,1374,4329,1388,4357,1401,4375,1412,4381,1416,4396,1419,4408,1421,4414,1427,4416,1429,4426,1429,4430,1430,4437,1436,4442,1438,4447,1442,4452,1445,4457,1447,4459,1447,4469,1446,4476,1446,4479,1447,4483,1448,4494,1459,4518,1482,4520,1484,4522,1486,4528,1489,4533,1492,4535,1496,4543,1505,4548,1506,4562,1506,4576,1526,4586,1542,4613,1589,4638,1632,4651,1651,4659,1665,4662,1671,4664,1677,4672,1686,4680,1693,4681,1697,4685,1708,4698,1718,4702,1722,4704,1732,L,4712,1742,Q,4716,1747,4720,1755,L,4729,1765,Q,4745,1782,4748,1787,4749,1789,4754,1795,4758,1800,4765,1809,4766,1810,4771,1820,4774,1829,4778,1832,L,4787,1850,Q,4790,1856,4803,1869,4811,1879,4828,1898,4830,1900,4835,1904,4838,1908,4838,1913,4838,1920,4848,1930,L,4880,1957,Q,4885,1961,4897,1976,4907,1990,4912,1993,4920,1999,4929,2004,4940,2009,4946,2013,4957,2020,4985,2032,5017,2049,5025,2050,L,5042,2050,Q,5046,2051,5066,2053,5085,2053,5092,2053,5105,2053,5109,2053,5117,2052,5124,2048,5129,2044,5139,2043,5144,2043,5155,2043,5162,2042,5186,2034,5189,2033,5199,2033,5210,2034,5217,2032,5235,2025,5276,2001,5306,1984,5327,1984,5331,1984,5340,1984,5349,1984,5353,1988,5361,1993,5364,1993,5367,1994,5377,1994,5394,1995,5423,1991,5424,1991,5425,1990,5444,1988,5472,1993,5502,1999,5530,1999,5557,1999,5571,1996,5584,1992,5602,1992,L,5633,1993,Q,5654,1993,5669,1988,5678,1984,5708,1971,5732,1961,5751,1949,5762,1942,5780,1929,5806,1912,5818,1906,5826,1902,5840,1905,5855,1907,5863,1903,5873,1898,5883,1896,5898,1895,5900,1894,5903,1893,5908,1891,5913,1888,5919,1887,5926,1884,5939,1884,5946,1884,5950,1887,5956,1890,5967,1891,5968,1891,5986,1894,5997,1895,6e3,1897,6013,1905,6028,1907,6033,1907,6056,1908,L,6212,1908,Q,6209,1903,6206,1899,6188,1867,6185,1843,6185,1840,6185,1838,L,6185,1284,6186,1284,Q,6174,1276,6168,1269,6163,1264,6153,1251,6147,1243,6146,1243,6139,1242,6136,1241,6131,1239,6126,1234,6117,1225,6116,1224,6099,1206,6099,1205,6093,1199,6089,1197,6086,1195,6086,1187,6085,1180,6073,1171,6060,1161,6058,1153,6055,1144,6054,1143,L,6047,1136,Q,6031,1125,6027,1119,L,6017,1102,Q,6014,1097,6011,1095,6009,1095,5999,1094,5994,1093,5986,1089,5979,1085,5975,1085,5967,1083,5956,1084,5950,1084,5946,1082,5941,1080,5937,1078,5931,1075,5918,1075,5870,1063,5838,1046,5801,1027,5776,996,5734,952,5716,930,5678,887,5670,869,Q,5668,871,5666,871,Z]],label:"Midyat",shortLabel:"MI",labelPosition:[516.4,146.1],labelAlignment:[CEN,MID]},"TR.MR.NU":{outlines:[[M,5708,1971,Q,5678,1984,5669,1988,5654,1993,5633,1993,L,5602,1992,Q,5584,1992,5571,1996,5557,1999,5530,1999,5502,1999,5472,1993,5444,1988,5425,1990,5424,1991,5423,1991,5394,1995,5377,1994,5367,1994,5364,1993,5361,1993,5353,1988,5349,1984,5340,1984,5331,1984,5327,1984,5306,1984,5276,2001,5235,2025,5217,2032,5210,2034,5199,2033,5189,2033,5186,2034,5162,2042,5155,2043,5144,2043,5139,2043,5129,2044,5124,2048,5117,2052,5109,2053,5105,2053,5092,2053,5085,2053,5066,2053,5046,2051,5042,2050,L,5025,2050,Q,5017,2049,4985,2032,4957,2020,4946,2013,4940,2009,4929,2004,4920,1999,4912,1993,4907,1990,4897,1976,4885,1961,4880,1957,L,4848,1930,Q,4838,1920,4838,1913,4838,1908,4835,1904,4830,1900,4828,1898,4811,1879,4803,1869,4790,1856,4787,1850,L,4778,1832,Q,4774,1829,4771,1820,4766,1810,4765,1809,4758,1800,4754,1795,4745,1796,4740,1797,4730,1798,4722,1803,4716,1807,4700,1806,4685,1804,4684,1804,4663,1806,4650,1805,4637,1803,4632,1799,4626,1796,4616,1794,L,4518,1796,Q,4498,1795,4488,1797,4469,1801,4443,1814,4422,1825,4399,1825,4358,1825,4345,1821,4331,1816,4309,1801,4286,1786,4249,1765,4211,1743,4203,1741,4196,1739,4166,1761,4159,1766,4143,1769,4136,1770,4136,1784,4136,1791,4138,1797,4140,1804,4140,1811,4138,1822,4143,1834,4147,1846,4148,1852,4148,1858,4149,1866,4151,1874,4152,1883,4153,1891,4154,1898,4154,1899,4154,1916,4154,1939,4147,1951,4137,1967,4127,1985,4122,1994,4113,2020,4105,2042,4097,2054,4103,2058,4104,2064,4110,2074,4119,2092,4130,2111,4137,2122,4151,2145,4172,2181,4223,2263,4240,2295,4243,2310,4251,2320,4257,2327,4272,2342,4281,2354,4281,2358,4281,2371,4282,2374,4284,2379,4292,2384,4297,2387,4310,2394,4318,2398,4360,2423,4393,2442,4414,2454,4445,2470,4463,2487,4488,2511,4507,2525,4518,2533,4518,2534,4525,2540,4527,2545,4530,2555,4534,2579,4536,2588,4545,2612,4551,2629,4553,2640,4554,2641,4554,2642,4555,2650,4556,2661,4557,2674,4563,2685,4568,2697,4573,2729,4577,2759,4595,2822,L,4638,3004,4648,3004,Q,4672,3004,4724,3004,4772,3004,4797,2999,L,5e3,2999,Q,5010,2991,5030,2989,5038,2988,5072,2988,5083,2988,5105,2985,5128,2982,5136,2982,5238,2982,5324,2979,5366,2978,5410,2971,5454,2964,5488,2962,5521,2960,5565,2955,5608,2950,5610,2949,5626,2944,5651,2941,5675,2937,5695,2934,5715,2930,5744,2925,5772,2920,5787,2916,5802,2912,5836,2902,5859,2894,5883,2892,5900,2890,5934,2883,5960,2876,5982,2877,5986,2877,6023,2868,6030,2865,6042,2863,6056,2861,6062,2859,6084,2852,6143,2843,6164,2839,6229,2825,6272,2815,6302,2813,6304,2813,6305,2813,6320,2810,6345,2803,6372,2795,6386,2793,6386,2793,6426,2788,6452,2785,6468,2780,6481,2775,6508,2769,6539,2763,6550,2760,L,6629,2734,Q,6656,2731,6662,2716,6663,2696,6666,2685,6672,2644,6672,2611,6672,2599,6677,2574,6683,2551,6682,2539,6681,2529,6686,2519,6691,2507,6693,2502,L,6693,2464,Q,6694,2435,6683,2327,6681,2315,6682,2292,6682,2261,6682,2258,6681,2245,6675,2225,6671,2212,6672,2200,L,6672,2199,Q,6672,2197,6672,2196,6668,2166,6655,2135,6638,2099,6628,2078,6626,2074,6624,2064,6622,2054,6618,2047,6612,2037,6611,2035,6608,2030,6606,2018,6604,2008,6596,1990,6589,1973,6588,1964,L,6578,1964,Q,6572,1976,6548,1984,6522,1992,6511,1995,6459,2014,6444,2023,6432,2030,6407,2037,6382,2045,6373,2049,6360,2055,6340,2069,6325,2079,6321,2079,6315,2079,6282,2022,6248,1962,6244,1956,6224,1928,6212,1908,L,6056,1908,Q,6033,1907,6028,1907,6013,1905,6e3,1897,5997,1895,5986,1894,5968,1891,5967,1891,5956,1890,5950,1887,5946,1884,5939,1884,5926,1884,5919,1887,5913,1888,5908,1891,5903,1893,5900,1894,5898,1895,5883,1896,5873,1898,5863,1903,5855,1907,5840,1905,5826,1902,5818,1906,5806,1912,5780,1929,5762,1942,5751,1949,Q,5732,1961,5708,1971,Z]],label:"Nusaybin",shortLabel:"NU",labelPosition:[539.5,237.3],labelAlignment:[CEN,MID]},"TR.MR.OM":{outlines:[[M,4130,1155,Q,4124,1141,4117,1133,4082,1150,4038,1174,4030,1178,3996,1193,3965,1206,3952,1214,3891,1247,3862,1242,3856,1242,3847,1236,3836,1229,3832,1229,3795,1229,3780,1229,3778,1229,3777,1229,3773,1229,3771,1229,3769,1229,3768,1229,3745,1229,3733,1229,3697,1231,3694,1230,3685,1229,3668,1234,3644,1241,3641,1241,3622,1247,3617,1248,3609,1247,3604,1250,3597,1257,3593,1259,3582,1263,3570,1270,3568,1271,3550,1271,3524,1270,3502,1269,3496,1269,3490,1265,3482,1261,3474,1260,3461,1258,3438,1260,3428,1260,3415,1259,3415,1281,3416,1286,3416,1290,3423,1301,3423,1302,3423,1315,3423,1317,3423,1319,3422,1343,3430,1359,3431,1363,3432,1370,3432,1378,3433,1380,L,3445,1402,Q,3449,1409,3457,1420,3459,1424,3469,1431,3470,1433,3470,1436,3469,1440,3471,1442,L,3471,1442,Q,3477,1448,3489,1454,3503,1462,3507,1465,3521,1476,3549,1490,3551,1491,3559,1497,3567,1502,3571,1503,3576,1505,3582,1509,3585,1512,3591,1519,3620,1547,3629,1553,3635,1558,3637,1562,3639,1566,3639,1574,3639,1580,3644,1588,3647,1594,3648,1598,3648,1600,3648,1602,3649,1614,3648,1630,3649,1644,3655,1662,3655,1664,3657,1671,3657,1673,3657,1675,3659,1685,3661,1688,3667,1701,3679,1720,3686,1734,3691,1749,3692,1752,3698,1763,3703,1772,3704,1780,3705,1791,3710,1798,3712,1801,3713,1814,3715,1821,3724,1844,3732,1863,3733,1868,3733,1870,3733,1873,3733,1877,3735,1879,3742,1889,3742,1894,3743,1905,3753,1921,3763,1936,3775,1945,3792,1955,3823,1975,3839,1986,3860,1992,3882,1999,3889,2004,3901,2012,3917,2015,3933,2018,3942,2025,3948,2029,3954,2031,3956,2032,3966,2033,3968,2033,3982,2033,3991,2033,3996,2035,4009,2042,4026,2043,4042,2044,4052,2041,4062,2038,4074,2044,4086,2049,4095,2053,4096,2054,4097,2054,4105,2042,4113,2020,4122,1994,4127,1985,4137,1967,4147,1951,4154,1939,4154,1916,4154,1899,4154,1898,4153,1891,4152,1883,4151,1874,4149,1866,4148,1858,4148,1852,4147,1846,4143,1834,4138,1822,4140,1811,4140,1804,4138,1797,4136,1791,4136,1784,4136,1770,4143,1769,4159,1766,4166,1761,4196,1739,4203,1741,4211,1743,4249,1765,4286,1786,4309,1801,4331,1816,4345,1821,4358,1825,4399,1825,4422,1825,4443,1814,4469,1801,4488,1797,4498,1795,4518,1796,L,4616,1794,Q,4626,1796,4632,1799,4637,1803,4650,1805,4663,1806,4684,1804,4685,1804,4700,1806,4716,1807,4722,1803,4730,1798,4740,1797,4745,1796,4754,1795,4749,1789,4748,1787,4745,1782,4729,1765,L,4720,1755,Q,4716,1747,4712,1742,L,4704,1732,Q,4702,1722,4698,1718,4685,1708,4681,1697,4680,1693,4672,1686,4664,1677,4662,1671,4659,1665,4651,1651,4638,1632,4613,1589,4586,1542,4576,1526,4562,1506,4548,1506,4543,1505,4535,1496,4533,1492,4528,1489,4522,1486,4520,1484,4518,1482,4494,1459,4483,1448,4479,1447,4476,1446,4469,1446,4459,1447,4457,1447,4452,1445,4447,1442,4442,1438,4437,1436,4430,1430,4426,1429,4416,1429,4414,1427,4408,1421,4396,1419,4381,1416,4375,1412,4357,1401,4329,1388,4308,1374,4290,1368,4280,1365,4270,1354,4266,1351,4255,1337,4249,1331,4241,1318,4234,1307,4225,1298,4214,1287,4210,1282,4203,1274,4196,1263,4187,1250,4183,1243,4176,1232,4174,1225,4171,1219,4160,1204,4147,1186,4143,1181,Q,4138,1172,4130,1155,Z]],label:"Ömerli",shortLabel:"OM",labelPosition:[408.5,159.3],labelAlignment:[CEN,MID]},"TR.MR.SA":{outlines:[[M,3583,207,Q,3569,207,3565,210,3560,215,3548,215,3540,215,3535,215,3530,215,3529,216,L,3493,216,Q,3484,215,3471,219,3456,224,3450,224,3427,226,3354,228,3321,228,3306,230,3302,230,3285,234,3272,238,3258,237,3230,234,3215,237,3200,240,3192,243,3186,246,3177,246,L,3158,244,3087,244,Q,3086,245,3085,245,3076,251,3066,253,3060,254,3038,254,3006,254,3001,252,2987,242,2961,226,2951,220,2946,217,2945,216,2941,215,2937,214,2936,213,2935,212,2930,205,2926,198,2913,192,2907,189,2906,179,2905,177,2904,175,2900,167,2885,158,2868,146,2866,138,2864,127,2863,124,2861,118,2855,113,2849,109,2842,107,2835,106,2831,103,2821,101,2815,99,2813,98,2804,92,2798,88,2792,88,2789,88,2776,90,2762,91,2746,86,2725,79,2720,78,2713,77,2689,78,2666,78,2655,76,2645,70,2640,70,L,2624,70,Q,2608,71,2595,68,L,2564,68,Q,2560,68,2551,66,2540,63,2536,62,2526,60,2506,60,2486,61,2478,60,L,2471,54,Q,2464,48,2458,49,L,2438,49,Q,2420,48,2415,43,2409,37,2396,37,2386,37,2382,39,2376,41,2358,54,2355,56,2348,58,2340,60,2337,60,2332,59,2322,66,2320,67,2314,68,2308,69,2306,72,L,2273,120,Q,2255,148,2250,156,L,2243,165,Q,2242,170,2241,173,2230,190,2230,191,2229,193,2231,198,2231,213,2220,233,2222,243,2219,253,2217,258,2213,268,L,2213,283,2214,282,2211,311,Q,2210,314,2207,327,2204,336,2204,341,2205,370,2203,407,L,2203,469,Q,2203,474,2194,480,2185,486,2180,489,2168,497,2157,507,2155,509,2154,511,2131,538,2122,546,2113,554,2097,557,2102,566,2119,576,2132,583,2147,594,2158,602,2177,617,2192,629,2207,639,2211,642,2228,655,2240,663,2246,672,2250,678,2256,681,2260,683,2271,688,2289,697,2295,701,2303,707,2321,716,2336,724,2346,732,L,2399,770,Q,2405,778,2422,786,2447,797,2449,797,2476,814,2477,815,2481,819,2487,821,2488,821,2499,823,2512,825,2521,841,2526,851,2534,868,L,2553,895,Q,2562,909,2563,917,2566,924,2577,949,2578,952,2581,964,2584,977,2586,982,2589,988,2597,1016,2604,1040,2611,1053,2612,1057,2613,1067,2615,1078,2617,1084,2619,1088,2626,1101,2632,1111,2632,1116,L,2634,1135,Q,2634,1137,2638,1144,2641,1151,2641,1152,2639,1160,2643,1169,2646,1180,2653,1182,L,2672,1182,Q,2673,1183,2677,1188,2681,1193,2682,1193,L,2730,1194,Q,2734,1194,2745,1199,2755,1203,2763,1202,2770,1201,2789,1202,2794,1202,2798,1202,L,2799,1202,Q,2799,1202,2802,1202,2806,1201,2806,1202,2816,1202,2834,1202,2845,1203,2852,1194,L,2871,1179,Q,2875,1175,2880,1174,2881,1174,2892,1173,L,3073,1174,Q,3092,1184,3103,1182,3110,1182,3119,1184,3133,1190,3133,1190,3149,1192,3161,1197,3188,1206,3195,1207,3204,1209,3223,1219,3240,1226,3252,1228,3262,1229,3287,1234,3293,1235,3299,1238,3307,1242,3310,1243,3349,1251,3371,1252,3383,1253,3406,1257,3410,1258,3415,1259,3428,1260,3438,1260,3461,1258,3474,1260,3482,1261,3490,1265,3496,1269,3502,1269,3524,1270,3550,1271,3568,1271,3570,1270,3582,1263,3593,1259,3597,1257,3604,1250,3609,1247,3617,1248,3622,1247,3641,1241,3644,1241,3668,1234,3685,1229,3694,1230,3697,1231,3733,1229,3745,1229,3768,1229,3769,1229,3771,1229,3772,1229,3774,1229,3780,1228,3780,1229,3795,1229,3832,1229,3836,1229,3847,1236,3856,1242,3862,1242,3891,1247,3952,1214,3965,1206,3996,1193,4030,1178,4038,1174,4082,1150,4117,1133,4128,1127,4138,1122,4177,1104,4179,1102,4203,1090,4215,1079,L,4318,1e3,Q,4320,998,4327,993,4332,989,4335,984,4344,971,4369,954,4362,948,4360,944,4354,939,4352,933,4342,909,4341,906,4336,894,4336,892,4332,883,4330,879,L,4318,851,Q,4307,832,4303,825,4300,820,4299,811,4298,802,4294,797,4286,788,4282,774,4281,772,4281,771,4277,761,4276,758,L,4268,740,Q,4260,719,4255,705,4243,684,4239,675,4237,667,4234,660,L,4224,642,Q,4213,621,4207,610,4196,591,4186,581,4182,578,4174,567,4163,553,4162,552,L,4139,526,Q,4134,525,4124,514,4113,503,4109,500,4102,496,4095,485,4086,471,4085,470,4079,463,4068,453,4056,443,4053,440,4049,436,4049,430,4048,427,4047,425,4046,424,4044,423,4041,419,4038,415,4035,408,4034,407,L,4001,363,Q,3999,359,3997,355,L,3994,348,Q,3967,305,3954,287,3953,282,3946,273,3936,262,3933,258,3922,247,3913,234,3896,212,3891,204,3883,189,3881,187,3880,186,3865,186,3853,187,3840,188,3839,188,3835,191,3833,195,3832,195,3830,196,3823,198,L,3775,198,Q,3743,198,3736,200,3733,200,3729,202,3724,204,3721,204,L,3665,204,Q,3652,207,3647,208,L,3606,208,Q,3591,207,3583,207,Z]],label:"Savur",shortLabel:"SA",labelPosition:[323.3,65.4],labelAlignment:[CEN,MID]},"TR.MR.YE":{outlines:[[M,3489,1454,Q,3477,1448,3471,1442,3464,1448,3460,1450,3453,1454,3448,1455,3437,1455,3431,1455,3421,1456,3417,1458,3408,1464,3400,1466,3396,1466,3384,1466,3368,1466,3353,1478,3332,1490,3322,1498,3303,1511,3299,1522,3298,1525,3291,1539,3285,1549,3285,1556,3284,1564,3274,1570,3265,1575,3265,1585,3265,1598,3268,1606,3273,1618,3275,1636,3275,1637,3274,1666,3272,1687,3280,1695,3309,1729,3321,1747,3324,1749,3368,1749,3371,1749,3408,1749,L,3425,1749,Q,3430,1748,3434,1744,3440,1739,3444,1737,3448,1734,3459,1726,3461,1725,3466,1724,3471,1722,3474,1720,3480,1714,3491,1710,3502,1706,3509,1701,3513,1697,3523,1697,3528,1697,3541,1698,3543,1698,3549,1697,3553,1697,3555,1695,3558,1692,3563,1691,3566,1691,3571,1690,3572,1690,3588,1689,3603,1688,3608,1685,3613,1681,3626,1679,3637,1677,3643,1671,L,3657,1671,Q,3655,1664,3655,1662,3649,1644,3648,1630,3649,1614,3648,1602,3648,1600,3648,1598,3647,1594,3644,1588,3639,1580,3639,1574,3639,1566,3637,1562,3635,1558,3629,1553,3620,1547,3591,1519,3585,1512,3582,1509,3576,1505,3571,1503,3567,1502,3559,1497,3551,1491,3549,1490,3521,1476,3507,1465,Q,3503,1462,3489,1454,Z]],label:"Yesilli",shortLabel:"YE",labelPosition:[346.1,159.6],labelAlignment:[CEN,MID]}}}];exports["default"]={extension:geodefinitions,name:"mardin",type:"maps"}}})});