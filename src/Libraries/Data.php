<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-25
 * Time: 6:07 AM
 */

namespace Angujo\OpenRosaPhp\Libraries;


class Data
{

    /**
     * @param null $search
     * @return Language|array|null
     */
    public static function languages($search = null)
    {
        $langs = array(
            'en' => 'English',
            'aa' => 'Afar',
            'ki' => 'Kiswahili',
            'ab' => 'Abkhazian',
            'af' => 'Afrikaans',
            'am' => 'Amharic',
            'ar' => 'Arabic',
            'as' => 'Assamese',
            'ay' => 'Aymara',
            'az' => 'Azerbaijani',
            'ba' => 'Bashkir',
            'be' => 'Byelorussian',
            'bg' => 'Bulgarian',
            'bh' => 'Bihari',
            'bi' => 'Bislama',
            'bn' => 'Bengali/Bangla',
            'bo' => 'Tibetan',
            'br' => 'Breton',
            'ca' => 'Catalan',
            'co' => 'Corsican',
            'cs' => 'Czech',
            'cy' => 'Welsh',
            'da' => 'Danish',
            'de' => 'German',
            'dz' => 'Bhutani',
            'el' => 'Greek',
            'eo' => 'Esperanto',
            'es' => 'Spanish',
            'et' => 'Estonian',
            'eu' => 'Basque',
            'fa' => 'Persian',
            'fi' => 'Finnish',
            'fj' => 'Fiji',
            'fo' => 'Faeroese',
            'fr' => 'French',
            'fy' => 'Frisian',
            'ga' => 'Irish',
            'gd' => 'Scots/Gaelic',
            'gl' => 'Galician',
            'gn' => 'Guarani',
            'gu' => 'Gujarati',
            'ha' => 'Hausa',
            'hi' => 'Hindi',
            'hr' => 'Croatian',
            'hu' => 'Hungarian',
            'hy' => 'Armenian',
            'ia' => 'Interlingua',
            'ie' => 'Interlingue',
            'ik' => 'Inupiak',
            'in' => 'Indonesian',
            'is' => 'Icelandic',
            'it' => 'Italian',
            'iw' => 'Hebrew',
            'ja' => 'Japanese',
            'ji' => 'Yiddish',
            'jw' => 'Javanese',
            'ka' => 'Georgian',
            'kk' => 'Kazakh',
            'kl' => 'Greenlandic',
            'km' => 'Cambodian',
            'kn' => 'Kannada',
            'ko' => 'Korean',
            'ks' => 'Kashmiri',
            'ku' => 'Kurdish',
            'ky' => 'Kirghiz',
            'la' => 'Latin',
            'ln' => 'Lingala',
            'lo' => 'Laothian',
            'lt' => 'Lithuanian',
            'lv' => 'Latvian/Lettish',
            'mg' => 'Malagasy',
            'mi' => 'Maori',
            'mk' => 'Macedonian',
            'ml' => 'Malayalam',
            'mn' => 'Mongolian',
            'mo' => 'Moldavian',
            'mr' => 'Marathi',
            'ms' => 'Malay',
            'mt' => 'Maltese',
            'my' => 'Burmese',
            'na' => 'Nauru',
            'ne' => 'Nepali',
            'nl' => 'Dutch',
            'no' => 'Norwegian',
            'oc' => 'Occitan',
            'om' => '(Afan)/Oromoor/Oriya',
            'pa' => 'Punjabi',
            'pl' => 'Polish',
            'ps' => 'Pashto/Pushto',
            'pt' => 'Portuguese',
            'qu' => 'Quechua',
            'rm' => 'Rhaeto-Romance',
            'rn' => 'Kirundi',
            'ro' => 'Romanian',
            'ru' => 'Russian',
            'rw' => 'Kinyarwanda',
            'sa' => 'Sanskrit',
            'sd' => 'Sindhi',
            'sg' => 'Sangro',
            'sh' => 'Serbo-Croatian',
            'si' => 'Singhalese',
            'sk' => 'Slovak',
            'sl' => 'Slovenian',
            'sm' => 'Samoan',
            'sn' => 'Shona',
            'so' => 'Somali',
            'sq' => 'Albanian',
            'sr' => 'Serbian',
            'ss' => 'Siswati',
            'st' => 'Sesotho',
            'su' => 'Sundanese',
            'sv' => 'Swedish',
            'sw' => 'Swahili',
            'ta' => 'Tamil',
            'te' => 'Tegulu',
            'tg' => 'Tajik',
            'th' => 'Thai',
            'ti' => 'Tigrinya',
            'tk' => 'Turkmen',
            'tl' => 'Tagalog',
            'tn' => 'Setswana',
            'to' => 'Tonga',
            'tr' => 'Turkish',
            'ts' => 'Tsonga',
            'tt' => 'Tatar',
            'tw' => 'Twi',
            'uk' => 'Ukrainian',
            'ur' => 'Urdu',
            'uz' => 'Uzbek',
            'vi' => 'Vietnamese',
            'vo' => 'Volapuk',
            'wo' => 'Wolof',
            'xh' => 'Xhosa',
            'yo' => 'Yoruba',
            'zh' => 'Chinese',
            'zu' => 'Zulu',
        );
        if (null !== $search) {
            $match = array_filter($langs, function ($v) use ($search) {
                $repl = preg_replace('/[^a-z0-9]/i', '', $v);
                return 0 === strcasecmp($search, $repl);
            });
            return $match ? Language::init(array_keys($match)[0], array_values($match)[0]) : null;
        }
        return $langs;
    }
}