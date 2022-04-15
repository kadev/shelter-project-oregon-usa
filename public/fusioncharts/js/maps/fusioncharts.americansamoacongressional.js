(function(factory){if(typeof module==="object"&&typeof module.exports!=="undefined"){module.exports=factory}else{factory(FusionCharts)}})(function(FusionCharts){(function(modules){var installedModules={};function __webpack_require__(moduleId){if(installedModules[moduleId]){return installedModules[moduleId].exports}var module=installedModules[moduleId]={i:moduleId,l:false,exports:{}};modules[moduleId].call(module.exports,module,module.exports,__webpack_require__);module.l=true;return module.exports}__webpack_require__.m=modules;__webpack_require__.c=installedModules;__webpack_require__.d=function(exports,name,getter){if(!__webpack_require__.o(exports,name)){Object.defineProperty(exports,name,{configurable:false,enumerable:true,get:getter})}};__webpack_require__.r=function(exports){Object.defineProperty(exports,"__esModule",{value:true})};__webpack_require__.n=function(module){var getter=module&&module.__esModule?function getDefault(){return module["default"]}:function getModuleExports(){return module};__webpack_require__.d(getter,"a",getter);return getter};__webpack_require__.o=function(object,property){return Object.prototype.hasOwnProperty.call(object,property)};__webpack_require__.p="";return __webpack_require__(__webpack_require__.s=96)})({96:function(module,exports,__webpack_require__){"use strict";var _fusioncharts=__webpack_require__(97);var _fusioncharts2=_interopRequireDefault(_fusioncharts);function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{"default":obj}}FusionCharts.addDep(_fusioncharts2["default"])},97:function(module,exports,__webpack_require__){"use strict";exports.__esModule=true;
/**!
 * @license FusionCharts JavaScript Library
 * Copyright FusionCharts, Inc.
 * License Information at <http://www.fusioncharts.com/license>
 *
 * @author FusionCharts, Inc.
 * @meta package_map_pack
 * @id fusionmaps.AmericanSamoaCongressional.18.08-06-2012 02:41:57
 */var M="M",L="L",Z="Z",Q="Q",LFT="left",RGT="right",CEN="center",MID="middle",TOP="top",BTM="bottom",geodefinitions=[{name:"AmericanSamoaCongressional",revision:18,standaloneInit:true,baseWidth:500,baseHeight:250,baseScaleFactor:10,entities:{98:{outlines:[[M,4798,834,Q,4766,835,4747,840,4728,846,4711,852,4706,861,4699,865,4688,869,4685,875,4683,881,4678,907,4674,933,4679,941,4685,950,4685,962,4685,968,4695,975,4698,977,4706,989,4713,1e3,4725,1002,4744,1007,4750,1015,4753,1020,4774,1020,4788,1020,4816,1016,L,4816,1007,Q,4835,1006,4867,1005,4872,1003,4885,993,4892,988,4899,986,4903,969,4906,965,4912,957,4925,960,4921,958,4922,940,4922,922,4907,903,4892,883,4886,878,4853,847,4841,840,Q,4830,833,4798,834,Z],[M,2891,62,Q,2885,60,2886,68,2886,69,2886,69,2872,65,2871,82,2870,91,2871,107,L,2861,107,2861,152,Q,2861,167,2854,173,2846,179,2842,185,2844,194,2835,202,2824,211,2820,215,2815,242,2795,236,2797,245,2784,253,2769,262,2768,266,L,2737,266,2737,279,2722,279,Q,2720,276,2711,276,2685,281,2675,280,L,2675,318,2596,318,2596,362,2585,362,2585,387,Q,2585,397,2582,399,2579,402,2579,407,2571,415,2562,415,2553,417,2548,416,L,2548,404,2538,404,Q,2539,397,2531,391,2521,384,2520,379,L,2514,379,2514,369,2496,369,Q,2491,386,2476,401,2459,417,2450,427,2450,428,2449,429,L,2384,429,2383,467,Q,2383,480,2389,492,2389,501,2379,509,2366,518,2363,525,2361,532,2345,543,2331,553,2325,554,L,2243,554,Q,2218,551,2210,563,2204,580,2196,590,2195,591,2195,592,2130,673,2114,688,2097,703,2094,719,2091,735,2083,745,2059,774,2057,780,2049,804,2042,816,L,2042,890,Q,2044,892,2051,890,2052,907,2060,905,2057,914,2060,919,2063,921,2069,927,2070,931,2072,941,2074,949,2080,949,L,2080,961,Q,2071,966,2069,966,2066,982,2062,984,2060,985,2038,985,2017,985,2014,983,2008,981,2001,964,1997,956,1986,954,1972,953,1962,943,1959,940,1928,925,1924,923,1914,909,1906,899,1892,899,1888,899,1883,907,1880,915,1875,927,1814,957,1796,992,1778,1028,1747,1044,1705,1047,1691,1048,1684,1049,1673,1057,1662,1066,1653,1068,1640,1072,1631,1078,1623,1086,1616,1089,1611,1092,1578,1118,L,1539,1118,Q,1543,1101,1533,1083,1521,1065,1517,1057,1481,1055,1479,1054,L,1471,1054,1471,1068,1435,1068,1435,1057,1428,1057,1428,985,Q,1418,985,1416,984,L,1397,984,Q,1356,1016,1342,1026,1339,1028,1301,1027,1300,1037,1287,1040,1272,1043,1269,1051,1266,1058,1245,1066,1241,1073,1239,1076,1236,1080,1218,1079,1185,1076,1176,1079,1169,1085,1160,1090,1153,1099,1146,1102,1139,1111,1134,1116,1133,1117,1133,1117,1111,1117,1097,1112,L,1097,1100,Q,1099,1098,1099,1095,L,1092,1095,Q,1086,1074,1086,1069,1086,1064,1089,1057,L,1089,1020,Q,1078,1022,1074,1005,L,1036,1005,Q,1035,1015,1020,1031,1002,1047,997,1048,972,1053,968,1062,966,1065,954,1067,941,1070,936,1076,L,851,1076,Q,847,1060,839,1052,826,1040,824,1036,L,779,1036,Q,779,1038,759,1053,758,1054,745,1068,716,1097,696,1090,L,696,1095,666,1095,Q,658,1151,654,1150,L,643,1149,642,1162,638,1162,Q,573,1196,562,1203,551,1210,544,1221,538,1231,532,1251,L,487,1251,Q,491,1239,469,1223,453,1212,437,1212,421,1212,420,1213,418,1216,411,1232,L,394,1261,Q,389,1268,380,1295,373,1301,341,1321,314,1338,312,1341,308,1347,285,1372,270,1394,262,1402,249,1413,248,1431,248,1433,248,1435,245,1448,229,1487,226,1492,215,1499,209,1505,198,1508,L,172,1523,Q,152,1535,146,1535,128,1533,116,1541,107,1547,78,1554,60,1560,59,1571,L,61,1585,Q,70,1587,79,1589,81,1590,85,1594,91,1599,100,1599,138,1600,156,1605,185,1613,254,1615,294,1623,338,1663,347,1671,358,1673,363,1675,369,1682,375,1690,379,1690,404,1690,412,1695,417,1698,432,1703,433,1703,434,1703,446,1715,455,1719,L,465,1730,Q,468,1732,485,1732,L,515,1731,Q,524,1730,537,1722,542,1703,555,1689,575,1668,581,1659,605,1620,644,1615,683,1610,688,1650,692,1691,691,1699,690,1707,707,1724,725,1742,756,1742,787,1743,791,1740,796,1738,795,1733,L,855,1732,Q,880,1732,951,1776,961,1782,984,1806,1013,1836,1012,1849,L,1011,1900,1007,1900,Q,1004,1919,1004,1936,1004,1981,1012,1991,1025,2006,1032,2011,1035,2014,1035,2036,L,1032,2100,Q,1032,2108,1040,2117,L,1035,2130,Q,1090,2162,1111,2173,1127,2181,1128,2182,1153,2191,1182,2207,1196,2215,1229,2241,1236,2246,1247,2255,1265,2260,1268,2265,L,1299,2265,Q,1297,2261,1297,2255,L,1316,2255,Q,1317,2246,1318,2243,1318,2243,1338,2244,1347,2244,1352,2237,L,1447,2237,1447,2250,Q,1448,2250,1460,2254,1456,2265,1456,2281,L,1448,2281,Q,1451,2281,1451,2285,1451,2298,1424,2317,1415,2321,1415,2332,L,1415,2354,Q,1415,2382,1416,2389,L,1425,2389,Q,1425,2405,1429,2408,1431,2409,1446,2409,1468,2409,1481,2384,1504,2363,1509,2350,1516,2332,1523,2323,1531,2313,1537,2291,L,1557,2220,Q,1574,2200,1583,2190,1598,2173,1615,2173,L,1624,2173,Q,1630,2183,1670,2225,1719,2276,1725,2276,1727,2276,1758,2274,L,1761,2276,Q,1843,2183,1845,2176,1848,2166,1862,2153,1876,2140,1883,2123,1891,2106,1893,2102,1936,2046,1950,2031,1963,2015,1976,2008,1988,2001,2011,1999,2021,1996,2033,1983,2049,1973,2052,1969,2071,1947,2069,1922,2064,1875,2076,1867,2097,1824,2125,1818,2154,1813,2173,1797,2200,1790,2245,1761,2276,1741,2302,1708,2307,1702,2340,1689,2346,1686,2360,1684,2372,1680,2374,1672,L,2376,1672,Q,2378,1670,2396,1658,2398,1656,2400,1649,2404,1643,2412,1646,2412,1640,2414,1637,L,2414,1620,Q,2390,1622,2357,1618,L,2332,1618,2332,1630,2324,1630,Q,2323,1630,2265,1628,2266,1624,2253,1620,2243,1612,2239,1610,2221,1599,2207,1589,2192,1577,2179,1555,2167,1539,2164,1536,2162,1533,2162,1517,2162,1491,2173,1484,2189,1471,2199,1467,2232,1472,2247,1456,2272,1429,2273,1428,2283,1417,2304,1395,2320,1395,2345,1396,2353,1390,2367,1408,2378,1419,2378,1435,2378,1438,2376,1467,2372,1477,2365,1484,2359,1492,2354,1506,2349,1519,2345,1519,2344,1527,2346,1529,2347,1531,2343,1535,2338,1540,2333,1566,2340,1566,2347,1569,L,2363,1569,Q,2364,1560,2375,1550,2381,1545,2390,1526,L,2401,1502,Q,2411,1486,2412,1480,2423,1432,2466,1386,L,2468,1386,Q,2549,1274,2591,1245,2598,1240,2613,1231,2621,1222,2624,1221,2625,1220,2644,1217,2652,1215,2673,1202,2677,1200,2714,1197,2770,1190,2778,1168,L,2778,1161,Q,2785,1161,2789,1162,L,2789,1140,2778,1140,Q,2781,1126,2781,1123,L,2783,1123,Q,2766,1117,2754,1104,2744,1091,2739,1087,2725,1076,2724,1073,2718,1061,2697,1063,2697,1045,2696,1038,2709,1039,2721,1022,2729,1012,2749,1007,2757,1001,2773,987,2784,980,2789,978,2789,974,2789,962,2789,937,2785,933,2782,929,2773,927,2766,927,2763,922,2759,915,2708,913,L,2707,902,2697,902,2697,884,Q,2704,876,2705,853,2706,824,2709,815,L,2709,812,Q,2695,812,2681,808,L,2640,808,Q,2640,813,2640,818,2639,821,2631,821,L,2544,820,2544,809,Q,2515,812,2499,799,2472,778,2468,776,2446,758,2437,751,2431,740,2428,735,2422,726,2408,730,L,2408,718,Q,2413,721,2416,719,2419,717,2417,711,2422,710,2432,708,L,2461,708,2461,717,2644,717,Q,2652,714,2667,703,2681,694,2690,694,2698,685,2735,659,2741,658,2750,656,L,2773,656,Q,2776,656,2807,657,2821,659,2835,672,L,2837,675,Q,2841,678,2845,680,2846,681,2847,681,2848,681,2848,681,L,2851,681,Q,2855,683,2867,687,2871,690,2879,700,2885,709,2931,711,2927,718,2932,720,2951,718,2963,722,2970,725,2981,731,2990,734,2988,752,2987,761,2985,779,L,2985,954,Q,3002,990,3009,1e3,3011,1003,3014,1011,3018,1019,3025,1021,3041,1025,3050,1038,3058,1038,3070,1036,3077,1037,3078,1026,3117,1023,3162,1012,3188,1006,3244,992,L,3250,992,Q,3275,983,3311,977,3316,976,3327,977,3339,976,3345,966,3354,963,3373,957,3374,956,3388,931,3390,926,3403,913,3408,905,3412,882,3417,875,3436,872,L,3500,872,Q,3500,881,3501,886,L,3536,886,Q,3539,883,3548,885,3577,837,3590,827,3602,817,3616,794,L,3667,740,Q,3695,713,3710,705,3726,698,3750,688,3774,678,3791,673,3808,668,3833,666,3854,666,3860,671,3866,676,3886,679,3900,689,3903,692,3927,721,3931,725,3954,743,3949,768,L,3959,768,Q,3959,777,3963,793,L,3962,816,3947,816,Q,3945,836,3945,840,L,3939,840,Q,3939,853,3937,878,3937,889,3941,892,3951,899,3957,908,3964,919,3970,921,3973,922,3989,922,4038,922,4048,918,4058,914,4109,886,4128,878,4164,861,4178,846,4210,830,4229,814,4254,783,4279,763,4322,769,L,4374,769,Q,4385,770,4398,758,4440,737,4442,717,4449,719,4461,716,4471,716,4472,727,4480,720,4509,731,4500,715,4528,715,L,4568,713,Q,4582,706,4600,696,4612,688,4611,665,4611,658,4604,651,L,4604,645,Q,4608,644,4616,644,4617,612,4621,608,4621,611,4623,608,L,4626,579,4623,548,4632,548,4631,544,Q,4642,544,4646,543,L,4646,528,4656,528,4656,515,4649,515,Q,4642,499,4639,492,4639,490,4629,472,4613,446,4613,433,L,4604,434,4604,417,Q,4606,419,4605,413,L,4611,413,Q,4613,391,4614,389,4616,372,4619,366,4632,333,4644,330,L,4644,285,4623,285,Q,4622,290,4620,293,4617,298,4608,300,4594,303,4590,308,4575,325,4555,323,4560,335,4529,348,L,4478,348,Q,4482,341,4468,333,4462,323,4456,320,4430,314,4424,307,L,4375,307,Q,4376,313,4374,316,L,4365,316,Q,4369,335,4359,354,4349,371,4334,377,L,4317,377,4317,375,Q,4317,379,4314,387,4299,389,4289,397,4272,413,4267,416,L,4267,472,Q,4273,475,4277,475,L,4277,513,Q,4266,512,4263,522,4258,535,4254,538,4249,540,4249,544,4249,548,4245,552,4239,556,4232,566,L,4178,566,4178,563,Q,4178,556,4172,547,4167,538,4167,533,4165,514,4165,493,L,4100,493,Q,4097,482,4082,476,4062,470,4050,463,4027,450,4021,446,4013,442,3994,441,3978,441,3972,443,3972,458,3968,462,3966,476,3962,480,3955,485,3955,502,3922,506,3913,505,3906,506,3872,469,3863,453,3858,444,3849,428,3827,420,L,3793,420,Q,3747,453,3700,472,3690,477,3675,487,3657,492,3650,495,3616,511,3599,511,3581,511,3577,507,3558,504,3555,502,3552,500,3540,483,3527,467,3527,462,3527,452,3535,444,3550,431,3552,429,3556,423,3571,417,3576,415,3585,403,3660,363,3660,352,3661,346,3658,339,L,3612,339,Q,3614,345,3600,349,L,3591,349,Q,3535,348,3453,348,3455,335,3439,335,3398,335,3394,339,3394,348,3389,352,3385,354,3385,368,3385,375,3388,393,L,3375,393,Q,3379,406,3368,410,3353,412,3345,416,L,3345,390,3339,390,Q,3334,359,3334,351,L,3316,351,Q,3312,353,3312,357,L,3304,357,Q,3304,371,3301,394,L,3294,394,Q,3293,411,3291,439,3289,442,3263,472,3247,471,3237,479,L,3162,479,3162,443,3181,410,Q,3176,397,3177,390,3184,389,3195,392,L,3195,370,3189,351,Q,3172,349,3162,344,L,3162,358,Q,3149,360,3143,359,3140,367,3118,375,3095,383,3089,392,L,3055,392,3055,348,3066,348,3066,297,Q,3035,295,3032,295,3004,297,2990,297,2994,308,2986,312,2977,315,2972,318,2955,327,2937,338,2921,346,2911,351,2893,361,2885,369,L,2885,370,2830,371,2830,323,Q,2836,322,2840,305,2841,303,2853,284,2860,279,2866,265,L,2873,241,Q,2879,233,2884,217,2888,203,2895,193,2900,186,2900,166,2899,140,2901,130,L,2901,117,2894,117,2894,70,Q,2895,63,2893,62,Q,2892,62,2891,62,Z]],label:"American Samoa nonvoting",shortLabel:"AS",labelPosition:[224.1,111.9],labelAlignment:[CEN,MID]}}}];exports["default"]={extension:geodefinitions,name:"americansamoacongressional",type:"maps"}}})});