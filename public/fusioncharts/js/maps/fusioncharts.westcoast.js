(function(factory){if(typeof module==="object"&&typeof module.exports!=="undefined"){module.exports=factory}else{factory(FusionCharts)}})(function(FusionCharts){(function(modules){var installedModules={};function __webpack_require__(moduleId){if(installedModules[moduleId]){return installedModules[moduleId].exports}var module=installedModules[moduleId]={i:moduleId,l:false,exports:{}};modules[moduleId].call(module.exports,module,module.exports,__webpack_require__);module.l=true;return module.exports}__webpack_require__.m=modules;__webpack_require__.c=installedModules;__webpack_require__.d=function(exports,name,getter){if(!__webpack_require__.o(exports,name)){Object.defineProperty(exports,name,{configurable:false,enumerable:true,get:getter})}};__webpack_require__.r=function(exports){Object.defineProperty(exports,"__esModule",{value:true})};__webpack_require__.n=function(module){var getter=module&&module.__esModule?function getDefault(){return module["default"]}:function getModuleExports(){return module};__webpack_require__.d(getter,"a",getter);return getter};__webpack_require__.o=function(object,property){return Object.prototype.hasOwnProperty.call(object,property)};__webpack_require__.p="";return __webpack_require__(__webpack_require__.s=658)})({658:function(module,exports,__webpack_require__){"use strict";var _fusioncharts=__webpack_require__(659);var _fusioncharts2=_interopRequireDefault(_fusioncharts);function _interopRequireDefault(obj){return obj&&obj.__esModule?obj:{"default":obj}}FusionCharts.addDep(_fusioncharts2["default"])},659:function(module,exports,__webpack_require__){"use strict";exports.__esModule=true;
/**!
 * @license FusionCharts JavaScript Library
 * Copyright FusionCharts, Inc.
 * License Information at <http://www.fusioncharts.com/license>
 *
 * @author FusionCharts, Inc.
 * @meta package_map_pack
 * @id fusionmaps.WestCoast.18.08-17-2012 12:31:21
 */var M="M",L="L",Z="Z",Q="Q",LFT="left",RGT="right",CEN="center",MID="middle",TOP="top",BTM="bottom",geodefinitions=[{name:"WestCoast",revision:18,standaloneInit:true,baseWidth:526,baseHeight:600,baseScaleFactor:10,entities:{1:{outlines:[[M,3281,3030,Q,3265,3062,3253,3077,3246,3087,3208,3120,3180,3144,3178,3165,3176,3170,3144,3212,3147,3225,3119,3253,3128,3279,3103,3298,3071,3319,3058,3328,3023,3355,2998,3421,2944,3418,2894,3481,2844,3545,2790,3545,2789,3553,2785,3567,L,2756,3567,Q,2749,3565,2741,3564,2715,3561,2688,3575,2640,3602,2628,3605,2617,3632,2590,3646,2542,3677,2547,3699,L,2457,3699,2457,3737,Q,2441,3738,2410,3826,2347,3890,2326,3912,2325,3913,2275,3955,2243,3982,2240,4001,2235,4047,2222,4054,2202,4082,2188,4100,2149,4081,2140,4159,L,2094,4159,2092,4184,1988,4184,Q,1996,4206,1959,4224,1922,4241,1934,4267,1903,4257,1900,4277,1899,4288,1900,4314,L,1879,4314,Q,1878,4338,1878,4372,1871,4394,1829,4385,1847,4426,1799,4447,1747,4467,1754,4494,L,1721,4494,1721,4518,1676,4518,1676,4490,1666,4490,1666,4509,Q,1649,4509,1645,4513,1649,4522,1650,4547,L,1629,4548,Q,1598,4549,1568,4561,1531,4575,1497,4576,1473,4576,1451,4610,1425,4648,1403,4657,1309,4697,1190,4818,1150,4861,1090,4912,1069,4935,1048,4956,1046,4975,1021,4981,993,4984,986,4987,958,4998,938,5038,917,5078,887,5094,867,5105,842,5151,814,5186,760,5162,L,760,5195,678,5195,678,5165,645,5165,645,5129,607,5129,607,5154,581,5154,581,5190,506,5190,506,5207,372,5207,372,5261,351,5261,Q,358,5296,344,5329,325,5372,282,5353,281,5357,287,5386,286,5414,252,5415,261,5457,209,5475,202,5482,180,5507,159,5526,144,5517,L,144,5578,117,5578,117,5616,Q,67,5611,42,5612,L,42,5641,Q,59,5637,88,5637,L,88,5655,Q,102,5652,102,5670,L,167,5670,167,5637,219,5637,Q,222,5628,222,5607,L,309,5607,309,5637,372,5637,372,5699,397,5699,397,5733,418,5733,418,5774,443,5774,443,5804,Q,414,5801,385,5801,L,390,5934,372,5934,372,5962,547,5962,547,5921,610,5921,610,5875,670,5875,670,5841,716,5841,716,5801,Q,739,5801,745,5797,L,777,5797,777,5830,849,5830,849,5767,881,5767,883,5726,936,5726,936,5528,969,5528,969,5503,1062,5503,1062,5394,1090,5394,1090,5365,1138,5365,1138,5333,1175,5333,1175,5304,1224,5304,1224,5271,1261,5271,Q,1261,5325,1275,5333,L,1403,5333,1403,5248,Q,1416,5248,1417,5244,L,1455,5244,1455,5304,1483,5304,1483,5328,1534,5328,1534,5300,1575,5300,1575,5262,1616,5262,1616,5233,1662,5233,1662,5177,1739,5177,1739,5081,Q,1767,5082,1846,5091,1917,5088,1892,5024,L,1922,5024,1922,4953,1967,4953,Q,1953,4927,1980,4924,1993,4921,2021,4923,L,2021,4874,2055,4874,2055,4845,2080,4845,2080,4827,2121,4827,Q,2116,4789,2151,4797,L,2151,4718,2202,4718,Q,2206,4693,2206,4623,L,2259,4623,2259,4598,2293,4598,2293,4481,2315,4481,2315,4463,2344,4463,Q,2347,4427,2390,4438,L,2390,4372,2439,4372,2439,4348,2497,4348,2497,4326,2568,4326,2568,4355,2603,4355,2603,4317,2632,4317,Q,2632,4268,2664,4269,2675,4268,2687,4253,2696,4236,2719,4239,L,2719,4206,2756,4206,2756,4184,2808,4184,2812,4213,2877,4213,2877,4154,Q,2905,4164,2905,4136,2904,4101,2940,4102,L,2940,4064,Q,2949,4064,2977,4060,2959,4019,3001,4019,3023,4018,3073,4021,L,3073,3993,3111,3993,Q,3107,3970,3136,3954,3162,3938,3149,3904,L,3186,3904,3186,3879,3211,3879,3211,3854,3249,3854,3249,3879,Q,3282,3870,3299,3870,L,3299,3818,3324,3818,Q,3325,3799,3353,3800,L,3349,3699,Q,3356,3698,3387,3698,3413,3694,3403,3671,L,3441,3671,3442,3649,3503,3649,3503,3628,3545,3628,3545,3532,Q,3590,3542,3579,3492,L,3630,3492,Q,3633,3474,3633,3428,L,3764,3428,3764,3403,3800,3403,3800,3378,3954,3378,3954,3342,4071,3342,4071,3378,4101,3378,4101,3354,4127,3354,4127,3261,4160,3261,Q,4160,3187,4163,3184,4169,3179,4210,3186,4240,3186,4238,3137,4293,3154,4297,3115,4297,3109,4298,3104,L,4206,3104,4206,3131,4155,3131,4155,3161,Q,4105,3161,4084,3165,L,4013,3165,4013,3127,3979,3127,3979,3157,3929,3157,Q,3946,3115,3896,3116,3836,3127,3821,3127,L,3821,3094,3729,3094,Q,3729,3108,3733,3111,L,3733,3137,3679,3137,3679,3161,3641,3161,3641,3127,3616,3127,Q,3630,3101,3604,3095,3574,3088,3574,3081,L,3541,3081,Q,3552,3009,3516,2995,L,3516,2962,Q,3473,2966,3465,2903,3455,2840,3426,2843,3403,2878,3370,2916,3363,2974,3324,2991,Q,3296,3003,3281,3030,Z]],label:"Westland District",shortLabel:"WL",labelPosition:[217,432.2],labelAlignment:[CEN,MID]},2:{outlines:[[M,3959,2072,L,3934,2072,3934,2039,3900,2039,3900,2072,3871,2072,3871,2152,3842,2152,3843,2230,3805,2230,3805,2267,3762,2267,Q,3766,2289,3767,2351,L,3735,2351,3735,2284,3705,2284,3705,2234,3668,2234,3668,2177,3615,2177,Q,3614,2186,3615,2198,3616,2221,3620,2280,L,3620,2356,Q,3620,2378,3606,2384,3595,2388,3601,2405,3601,2444,3590,2456,3574,2472,3568,2509,L,3545,2509,3545,2585,3520,2585,3520,2635,3492,2635,3492,2693,3462,2693,3466,2722,Q,3467,2777,3426,2843,3455,2840,3465,2903,3473,2966,3516,2962,L,3516,2995,Q,3552,3009,3541,3081,L,3574,3081,Q,3574,3088,3604,3095,3630,3101,3616,3127,L,3641,3127,3641,3161,3679,3161,3679,3137,3733,3137,3733,3111,Q,3729,3108,3729,3094,L,3821,3094,3821,3127,Q,3836,3127,3896,3116,3946,3115,3929,3157,L,3979,3157,3979,3127,4013,3127,4013,3165,4084,3165,Q,4105,3161,4155,3161,L,4155,3131,4206,3131,4206,3104,4298,3104,Q,4305,3065,4322,3062,L,4322,2985,4380,2985,4380,2962,4414,2962,4414,2939,4522,2939,4522,2902,4545,2902,Q,4526,2804,4602,2816,L,4602,2789,4643,2789,4643,2722,Q,4632,2722,4602,2722,L,4602,2745,Q,4600,2744,4543,2743,4505,2742,4510,2768,L,4411,2768,4411,2726,4344,2726,4344,2706,4318,2706,4318,2651,4351,2651,4351,2618,4378,2618,4378,2593,4318,2593,4318,2536,4284,2536,4284,2493,4231,2493,4230,2547,4202,2544,4202,2507,4155,2507,Q,4163,2477,4126,2480,L,4126,2459,4064,2459,4064,2431,Q,4035,2444,4038,2394,4009,2408,4009,2379,4009,2338,4e3,2331,3979,2314,3979,2263,L,3959,2263,3959,2234,Q,3929,2245,3929,2210,3933,2167,3929,2154,L,3929,2125,3959,2125,Z]],label:"Grey District",shortLabel:"GR",labelPosition:[395.3,273.7],labelAlignment:[CEN,MID]},3:{outlines:[[M,4643,89,L,4610,89,Q,4618,107,4606,113,4586,124,4585,125,4569,146,4547,150,L,4547,196,4510,196,4510,271,4486,271,4486,309,4515,309,Q,4519,369,4519,575,L,4519,781,Q,4519,814,4497,843,L,4497,937,Q,4497,994,4411,1077,4330,1155,4340,1191,L,4313,1191,Q,4323,1305,4222,1378,4159,1421,4146,1457,4123,1527,4064,1516,L,4064,1542,4005,1542,4005,1574,3767,1574,3767,1808,Q,3739,1813,3739,1851,3740,1873,3729,1876,3716,1879,3712,1893,L,3712,1958,Q,3721,2021,3679,2054,3668,2062,3668,2099,3668,2131,3630,2147,3617,2153,3615,2177,L,3668,2177,3668,2234,3705,2234,3705,2284,3735,2284,3735,2351,3767,2351,Q,3766,2289,3762,2267,L,3805,2267,3805,2230,3843,2230,3842,2152,3871,2152,3871,2072,3900,2072,3900,2039,3934,2039,3934,2072,3959,2072,3959,2125,3929,2125,3929,2154,Q,3933,2167,3929,2210,3929,2245,3959,2234,L,3959,2263,3979,2263,Q,3979,2314,4e3,2331,4009,2338,4009,2379,4009,2408,4038,2394,4035,2444,4064,2431,L,4064,2459,4126,2459,4126,2480,Q,4163,2477,4155,2507,L,4202,2507,4202,2544,4230,2547,4231,2493,4284,2493,4284,2536,4318,2536,4318,2593,4378,2593,4378,2618,4351,2618,4351,2651,4318,2651,4318,2706,4344,2706,4344,2726,4411,2726,4411,2768,4510,2768,Q,4505,2742,4543,2743,4600,2744,4602,2745,L,4602,2722,Q,4632,2722,4643,2722,L,4673,2722,4673,2664,4724,2664,Q,4717,2633,4749,2614,4798,2583,4799,2580,4835,2541,4883,2542,L,4908,2539,4908,2509,4940,2509,4940,2455,4961,2455,4961,2385,4919,2385,4919,2409,Q,4863,2392,4819,2397,L,4819,2301,4789,2301,4789,2181,4689,2181,4689,2147,4652,2147,4652,2117,4561,2117,4561,2083,4535,2083,4535,1997,4510,1996,4510,1958,4482,1954,Q,4471,1933,4472,1900,L,4448,1900,4448,1866,4490,1866,4490,1788,4515,1788,4515,1766,4551,1766,4551,1620,4514,1620,Q,4510,1605,4510,1595,4550,1610,4551,1553,L,4551,1509,4572,1516,4572,1486,4689,1486,4689,1382,Q,4714,1386,4764,1386,L,4764,1349,4803,1349,4803,1282,4766,1282,4766,1253,4798,1253,4798,1182,4841,1182,4841,1154,4883,1154,4883,1040,Q,4927,1035,5021,1035,L,5021,1008,5044,1008,5044,981,5069,981,5069,910,5096,910,5096,856,5073,848,5073,789,5153,789,5154,757,5190,757,5190,735,5211,735,5211,706,5132,706,Q,5129,657,5065,593,5055,583,4987,568,4951,559,4977,501,4959,500,4961,469,L,4961,418,4906,418,Q,4902,434,4902,463,4857,448,4848,422,L,4812,422,4812,489,Q,4789,488,4785,484,L,4785,515,4760,515,4760,369,4785,369,Q,4789,373,4799,377,L,4831,377,Q,4828,342,4848,351,L,4848,317,4808,317,4808,294,4748,292,4748,259,Q,4735,259,4710,251,L,4710,196,4689,196,4689,38,4648,38,Q,4647,75,4643,89,Z]],label:"Buller District",shortLabel:"BU",labelPosition:[441.3,140.3],labelAlignment:[CEN,MID]}}}];exports["default"]={extension:geodefinitions,name:"westcoast",type:"maps"}}})});