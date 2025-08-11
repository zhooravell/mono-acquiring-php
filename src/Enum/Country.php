<?php

declare(strict_types=1);

namespace Monobank\Acquiring\Enum;

/**
 * ISO 3166-1 numeric
 *
 * @see https://www.iso.org/iso-3166-country-codes.html
 */
enum Country: int
{
    case UNKNOWN = 0;
    // A
    case AFGHANISTAN = 4;
    case ALBANIA = 8;
    case ALGERIA = 12;
    case AMERICAN_SAMOA = 16;
    case ANDORRA = 20;
    case ANGOLA = 24;
    case ANGUILLA = 660;
    case ANTARCTICA = 10;
    case ANTIGUA_AND_BARBUDA = 28;
    case ARGENTINA = 32;
    case ARMENIA = 51;
    case ARUBA = 533;
    case AUSTRALIA = 36;
    case AUSTRIA = 40;
    case AZERBAIJAN = 31;
    // B
    case BAHAMAS = 44;
    case BAHRAIN = 48;
    case BANGLADESH = 50;
    case BARBADOS = 52;
    case BELARUS = 112;
    case BELGIUM = 56;
    case BELIZE = 84;
    case BENIN = 204;
    case BERMUDA = 60;
    case BHUTAN = 64;
    case BOLIVIA = 68;
    case BOSNIA_AND_HERZEGOVINA = 70;
    case BOTSWANA = 72;
    case BOUVET_ISLAND = 74;
    case BRAZIL = 76;
    case BRITISH_INDIAN_OCEAN_TERRITORY = 86;
    case BRUNEI_DARUSSALAM = 96;
    case BULGARIA = 100;
    case BURKINA_FASO = 854;
    case BURUNDI = 108;
    // C
    case CAMBODIA = 116;
    case CAMEROON = 120;
    case CANADA = 124;
    case CAPE_VERDE = 132;
    case CAYMAN_ISLANDS = 136;
    case CENTRAL_AFRICAN_REPUBLIC = 140;
    case CHAD = 148;
    case CHILE = 152;
    case CHINA = 156;
    case CHRISTMAS_ISLAND = 162;
    case COCOS_KEELING_ISLANDS = 166;
    case COLOMBIA = 170;
    case COMOROS = 174;
    case CONGO = 178;
    case CONGO_DEMOCRATIC_REPUBLIC = 180;
    case COOK_ISLANDS = 184;
    case COSTA_RICA = 188;
    case COTE_DIVOIRE = 384;
    case CROATIA = 191;
    case CUBA = 192;
    case CYPRUS = 196;
    case CZECH_REPUBLIC = 203;
    // D
    case DENMARK = 208;
    case DJIBOUTI = 262;
    case DOMINICA = 212;
    case DOMINICAN_REPUBLIC = 214;
    // E
    case ECUADOR = 218;
    case EGYPT = 818;
    case EL_SALVADOR = 222;
    case EQUATORIAL_GUINEA = 226;
    case ERITREA = 232;
    case ESTONIA = 233;
    case ETHIOPIA = 231;
    // F
    case FALKLAND_ISLANDS = 238;
    case FAROE_ISLANDS = 234;
    case FIJI = 242;
    case FINLAND = 246;
    case FRANCE = 250;
    case FRENCH_GUIANA = 254;
    case FRENCH_POLYNESIA = 258;
    case FRENCH_SOUTHERN_TERRITORIES = 260;
    // G
    case GABON = 266;
    case GAMBIA = 270;
    case GEORGIA = 268;
    case GERMANY = 276;
    case GHANA = 288;
    case GIBRALTAR = 292;
    case GREECE = 300;
    case GREENLAND = 304;
    case GRENADA = 308;
    case GUADELOUPE = 312;
    case GUAM = 316;
    case GUATEMALA = 320;
    case GUERNSEY = 831;
    case GUINEA = 324;
    case GUINEA_BISSAU = 624;
    case GUYANA = 328;
    // H
    case HAITI = 332;
    case HEARD_ISLAND_AND_MCDONALD_ISLANDS = 334;
    case HOLY_SEE_VATICAN_CITY_STATE = 336;
    case HONDURAS = 340;
    case HONG_KONG = 344;
    case HUNGARY = 348;
    // I
    case ICELAND = 352;
    case INDIA = 356;
    case INDONESIA = 360;
    case IRAN = 364;
    case IRAQ = 368;
    case IRELAND = 372;
    case ISLE_OF_MAN = 833;
    case ISRAEL = 376;
    case ITALY = 380;
    // J
    case JAMAICA = 388;
    case JAPAN = 392;
    case JERSEY = 832;
    case JORDAN = 400;
    // K
    case KAZAKHSTAN = 398;
    case KENYA = 404;
    case KIRIBATI = 296;
    case KOREA_DEMOCRATIC_PEOPLES_REPUBLIC = 408;
    case KOREA_REPUBLIC_OF = 410;
    case KUWAIT = 414;
    case KYRGYZSTAN = 417;
    // L
    case LAO_PEOPLES_DEMOCRATIC_REPUBLIC = 418;
    case LATVIA = 428;
    case LEBANON = 422;
    case LESOTHO = 426;
    case LIBERIA = 430;
    case LIBYA = 434;
    case LIECHTENSTEIN = 438;
    case LITHUANIA = 440;
    case LUXEMBOURG = 442;
    // M
    case MACAO = 446;
    case MACEDONIA = 807;
    case MADAGASCAR = 450;
    case MALAWI = 454;
    case MALAYSIA = 458;
    case MALDIVES = 462;
    case MALI = 466;
    case MALTA = 470;
    case MARSHALL_ISLANDS = 584;
    case MARTINIQUE = 474;
    case MAURITANIA = 478;
    case MAURITIUS = 480;
    case MAYOTTE = 175;
    case MEXICO = 484;
    case MICRONESIA = 583;
    case MOLDOVA = 498;
    case MONACO = 492;
    case MONGOLIA = 496;
    case MONTENEGRO = 499;
    case MONTSERRAT = 500;
    case MOROCCO = 504;
    case MOZAMBIQUE = 508;
    case MYANMAR = 104;
    // N
    case NAMIBIA = 516;
    case NAURU = 520;
    case NEPAL = 524;
    case NETHERLANDS = 528;
    case NETHERLANDS_ANTILLES = 530;
    case NEW_CALEDONIA = 540;
    case NEW_ZEALAND = 554;
    case NICARAGUA = 558;
    case NIGER = 562;
    case NIGERIA = 566;
    case NIUE = 570;
    case NORFOLK_ISLAND = 574;
    case NORTHERN_MARIANA_ISLANDS = 580;
    case NORWAY = 578;
    // O
    case OMAN = 512;
    // P
    case PAKISTAN = 586;
    case PALAU = 585;
    case PALESTINE = 275;
    case PANAMA = 591;
    case PAPUA_NEW_GUINEA = 598;
    case PARAGUAY = 600;
    case PERU = 604;
    case PHILIPPINES = 608;
    case PITCAIRN = 612;
    case POLAND = 616;
    case PORTUGAL = 620;
    case PUERTO_RICO = 630;
    // Q
    case QATAR = 634;
    // R
    case REUNION = 638;
    case ROMANIA = 642;
    case RUSSIAN_FEDERATION = 643;
    case RWANDA = 646;
    // S
    case SAINT_BARTHELEMY = 652;
    case SAINT_HELENA = 654;
    case SAINT_KITTS_AND_NEVIS = 659;
    case SAINT_LUCIA = 662;
    case SAINT_MARTIN = 663;
    case SAINT_PIERRE_AND_MIQUELON = 666;
    case SAINT_VINCENT_AND_THE_GRENADINES = 670;
    case SAMOA = 882;
    case SAN_MARINO = 674;
    case SAO_TOME_AND_PRINCIPE = 678;
    case SAUDI_ARABIA = 682;
    case SENEGAL = 686;
    case SERBIA = 688;
    case SEYCHELLES = 690;
    case SIERRA_LEONE = 694;
    case SINGAPORE = 702;
    case SLOVAKIA = 703;
    case SLOVENIA = 705;
    case SOLOMON_ISLANDS = 90;
    case SOMALIA = 706;
    case SOUTH_AFRICA = 710;
    case SOUTH_GEORGIA_AND_SANDWICH_ISLANDS = 239;
    case SOUTH_SUDAN = 728;
    case SPAIN = 724;
    case SRI_LANKA = 144;
    case SUDAN = 729;
    case SURINAME = 740;
    case SVALBARD_AND_JAN_MAYEN = 744;
    case SWAZILAND = 748;
    case SWEDEN = 752;
    case SWITZERLAND = 756;
    case SYRIAN_ARAB_REPUBLIC = 760;
    // T
    case TAIWAN = 158;
    case TAJIKISTAN = 762;
    case TANZANIA = 834;
    case THAILAND = 764;
    case TIMOR_LESTE = 626;
    case TOGO = 768;
    case TOKELAU = 772;
    case TONGA = 776;
    case TRINIDAD_AND_TOBAGO = 780;
    case TUNISIA = 788;
    case TURKEY = 792;
    case TURKMENISTAN = 795;
    case TURKS_AND_CAICOS_ISLANDS = 796;
    case TUVALU = 798;
    // U
    case UGANDA = 800;
    case UKRAINE = 804;
    case UNITED_ARAB_EMIRATES = 784;
    case UNITED_KINGDOM = 826;
    case UNITED_STATES = 840;
    case UNITED_STATES_MINOR_OUTLYING_ISLANDS = 581;
    case URUGUAY = 858;
    case UZBEKISTAN = 860;
    // V
    case VANUATU = 548;
    case VENEZUELA = 862;
    case VIET_NAM = 704;
    case VIRGIN_ISLANDS_BRITISH = 92;
    case VIRGIN_ISLANDS_US = 850;
    // W
    case WALLIS_AND_FUTUNA = 876;
    case WESTERN_SAHARA = 732;
    // Y
    case YEMEN = 887;
    // Z
    case ZAMBIA = 894;
    case ZIMBABWE = 716;
}
