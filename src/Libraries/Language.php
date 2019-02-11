<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-23
 * Time: 6:50 AM
 */

namespace Angujo\OpenRosaPhp\Libraries;

/**
 * Class Language
 * @package Angujo\OpenRosaPhp\Libraries
 *
 * @method static Language english()
 * @method static Language afar()
 * @method static Language abkhazian()
 * @method static Language afrikaans()
 * @method static Language amharic()
 * @method static Language arabic()
 * @method static Language assamese()
 * @method static Language aymara()
 * @method static Language azerbaijani()
 * @method static Language bashkir()
 * @method static Language byelorussian()
 * @method static Language bulgarian()
 * @method static Language bihari()
 * @method static Language bislama()
 * @method static Language bengaliBangla()
 * @method static Language tibetan()
 * @method static Language breton()
 * @method static Language catalan()
 * @method static Language corsican()
 * @method static Language czech()
 * @method static Language welsh()
 * @method static Language danish()
 * @method static Language german()
 * @method static Language bhutani()
 * @method static Language greek()
 * @method static Language esperanto()
 * @method static Language spanish()
 * @method static Language estonian()
 * @method static Language basque()
 * @method static Language persian()
 * @method static Language finnish()
 * @method static Language fiji()
 * @method static Language faeroese()
 * @method static Language french()
 * @method static Language frisian()
 * @method static Language irish()
 * @method static Language scotsGaelic()
 * @method static Language galician()
 * @method static Language guarani()
 * @method static Language gujarati()
 * @method static Language hausa()
 * @method static Language hindi()
 * @method static Language croatian()
 * @method static Language hungarian()
 * @method static Language armenian()
 * @method static Language interlingua()
 * @method static Language interlingue()
 * @method static Language inupiak()
 * @method static Language indonesian()
 * @method static Language icelandic()
 * @method static Language italian()
 * @method static Language hebrew()
 * @method static Language japanese()
 * @method static Language yiddish()
 * @method static Language javanese()
 * @method static Language georgian()
 * @method static Language kazakh()
 * @method static Language greenlandic()
 * @method static Language cambodian()
 * @method static Language kannada()
 * @method static Language korean()
 * @method static Language kashmiri()
 * @method static Language kurdish()
 * @method static Language kirghiz()
 * @method static Language latin()
 * @method static Language lingala()
 * @method static Language laothian()
 * @method static Language lithuanian()
 * @method static Language latvianLettish()
 * @method static Language malagasy()
 * @method static Language maori()
 * @method static Language macedonian()
 * @method static Language malayalam()
 * @method static Language mongolian()
 * @method static Language moldavian()
 * @method static Language marathi()
 * @method static Language malay()
 * @method static Language maltese()
 * @method static Language burmese()
 * @method static Language nauru()
 * @method static Language nepali()
 * @method static Language dutch()
 * @method static Language norwegian()
 * @method static Language occitan()
 * @method static Language punjabi()
 * @method static Language polish()
 * @method static Language pashtoPushto()
 * @method static Language portuguese()
 * @method static Language quechua()
 * @method static Language rhaetoRomance()
 * @method static Language kirundi()
 * @method static Language romanian()
 * @method static Language russian()
 * @method static Language kinyarwanda()
 * @method static Language sanskrit()
 * @method static Language sindhi()
 * @method static Language sangro()
 * @method static Language serboCroatian()
 * @method static Language singhalese()
 * @method static Language slovak()
 * @method static Language slovenian()
 * @method static Language samoan()
 * @method static Language shona()
 * @method static Language somali()
 * @method static Language albanian()
 * @method static Language serbian()
 * @method static Language siswati()
 * @method static Language sesotho()
 * @method static Language sundanese()
 * @method static Language swedish()
 * @method static Language swahili()
 * @method static Language tamil()
 * @method static Language tegulu()
 * @method static Language tajik()
 * @method static Language thai()
 * @method static Language tigrinya()
 * @method static Language turkmen()
 * @method static Language tagalog()
 * @method static Language setswana()
 * @method static Language tonga()
 * @method static Language turkish()
 * @method static Language tsonga()
 * @method static Language tatar()
 * @method static Language twi()
 * @method static Language ukrainian()
 * @method static Language urdu()
 * @method static Language uzbek()
 * @method static Language vietnamese()
 * @method static Language volapuk()
 * @method static Language wolof()
 * @method static Language xhosa()
 * @method static Language yoruba()
 * @method static Language chinese()
 * @method static Language zulu()
 * @method static Language kiswahili()
 */
class Language
{
const DEF_ABBR = 'en';
const DEF_NAME = 'English';
    /** @var string */
    protected $name;
    /** @var string */
    protected $iso_abbreviation;
    /** @var Language[] */
    private static $langs = [];
    
    private function __construct()
    {
    
    }
    
    public function isDefault()
    {
        return 0 === strcasecmp(self::DEF_ABBR, $this->iso_abbreviation);
    }
    
    /**
     * @param $method
     * @param $args
     *
     * @return Language|null
     */
    public static function __callStatic($method, $args)
    {
        if ($language = Data::languages($method)) self::$langs[$language->getIsoAbbreviation()] = $language;
        return $language;
    }
    
    /**
     * @param $abbreviation
     * @param $name
     *
     * @return Language
     */
    public static function init($abbreviation, $name)
    {
        return (new self())->setIsoAbbreviation($abbreviation)->setName($name);
    }
    
    /**
     * @param $abbreviation
     * @param $name
     *
     * @return Language
     */
    public static function create($abbreviation, $name)
    {
        if (isset(self::$langs[$abbreviation])) return self::$langs[$abbreviation];
        return self::$langs[$abbreviation] = (new self())->setName($name)->setIsoAbbreviation($abbreviation);
    }
    
    /**
     * @param $abbreviation
     * @param $name
     *
     * @return Language
     */
    public static function add($abbreviation, $name)
    {
        return self::create($abbreviation, $name);
    }
    
    public static function set(Language $language)
    {
        self::$langs[$language->getIsoAbbreviation()] = $language;
        return $language;
    }
    
    /**
     * @param string $abbreviation
     *
     * @return Language|null
     */
    public static function get($abbreviation)
    {
        return self::$langs[$abbreviation] ?? NULL;
    }
    
    /**
     * @return Language[]
     */
    public static function all()
    {
        return self::$langs;
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @param string $name
     *
     * @return Language
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
    
    /**
     * @return string
     */
    public function getIsoAbbreviation()
    {
        return $this->iso_abbreviation;
    }
    
    /**
     * @param string $iso_abbreviation
     *
     * @return Language
     */
    public function setIsoAbbreviation($iso_abbreviation)
    {
        $this->iso_abbreviation = $iso_abbreviation;
        return $this;
    }
}