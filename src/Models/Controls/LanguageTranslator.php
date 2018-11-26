<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-25
 * Time: 7:26 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;

use Angujo\OpenRosaPhp\Libraries\Data;
use Angujo\OpenRosaPhp\Libraries\Language;
use Angujo\OpenRosaPhp\Libraries\Translation;


/**
 * Class LanguageTranslator
 * @package Angujo\OpenRosaPhp\Models\Controls
 *
 * @method LanguageTranslator english(string $translation)
 * @method LanguageTranslator afar(string $translation)
 * @method LanguageTranslator abkhazian(string $translation)
 * @method LanguageTranslator afrikaans(string $translation)
 * @method LanguageTranslator amharic(string $translation)
 * @method LanguageTranslator arabic(string $translation)
 * @method LanguageTranslator assamese(string $translation)
 * @method LanguageTranslator aymara(string $translation)
 * @method LanguageTranslator azerbaijani(string $translation)
 * @method LanguageTranslator bashkir(string $translation)
 * @method LanguageTranslator byelorussian(string $translation)
 * @method LanguageTranslator bulgarian(string $translation)
 * @method LanguageTranslator bihari(string $translation)
 * @method LanguageTranslator bislama(string $translation)
 * @method LanguageTranslator bengaliBangla(string $translation)
 * @method LanguageTranslator tibetan(string $translation)
 * @method LanguageTranslator breton(string $translation)
 * @method LanguageTranslator catalan(string $translation)
 * @method LanguageTranslator corsican(string $translation)
 * @method LanguageTranslator czech(string $translation)
 * @method LanguageTranslator welsh(string $translation)
 * @method LanguageTranslator danish(string $translation)
 * @method LanguageTranslator german(string $translation)
 * @method LanguageTranslator bhutani(string $translation)
 * @method LanguageTranslator greek(string $translation)
 * @method LanguageTranslator esperanto(string $translation)
 * @method LanguageTranslator spanish(string $translation)
 * @method LanguageTranslator estonian(string $translation)
 * @method LanguageTranslator basque(string $translation)
 * @method LanguageTranslator persian(string $translation)
 * @method LanguageTranslator finnish(string $translation)
 * @method LanguageTranslator fiji(string $translation)
 * @method LanguageTranslator faeroese(string $translation)
 * @method LanguageTranslator french(string $translation)
 * @method LanguageTranslator frisian(string $translation)
 * @method LanguageTranslator irish(string $translation)
 * @method LanguageTranslator scotsGaelic(string $translation)
 * @method LanguageTranslator galician(string $translation)
 * @method LanguageTranslator guarani(string $translation)
 * @method LanguageTranslator gujarati(string $translation)
 * @method LanguageTranslator hausa(string $translation)
 * @method LanguageTranslator hindi(string $translation)
 * @method LanguageTranslator croatian(string $translation)
 * @method LanguageTranslator hungarian(string $translation)
 * @method LanguageTranslator armenian(string $translation)
 * @method LanguageTranslator interlingua(string $translation)
 * @method LanguageTranslator interlingue(string $translation)
 * @method LanguageTranslator inupiak(string $translation)
 * @method LanguageTranslator indonesian(string $translation)
 * @method LanguageTranslator icelandic(string $translation)
 * @method LanguageTranslator italian(string $translation)
 * @method LanguageTranslator hebrew(string $translation)
 * @method LanguageTranslator japanese(string $translation)
 * @method LanguageTranslator yiddish(string $translation)
 * @method LanguageTranslator javanese(string $translation)
 * @method LanguageTranslator georgian(string $translation)
 * @method LanguageTranslator kazakh(string $translation)
 * @method LanguageTranslator greenlandic(string $translation)
 * @method LanguageTranslator cambodian(string $translation)
 * @method LanguageTranslator kannada(string $translation)
 * @method LanguageTranslator korean(string $translation)
 * @method LanguageTranslator kashmiri(string $translation)
 * @method LanguageTranslator kurdish(string $translation)
 * @method LanguageTranslator kirghiz(string $translation)
 * @method LanguageTranslator latin(string $translation)
 * @method LanguageTranslator lingala(string $translation)
 * @method LanguageTranslator laothian(string $translation)
 * @method LanguageTranslator lithuanian(string $translation)
 * @method LanguageTranslator latvianLettish(string $translation)
 * @method LanguageTranslator malagasy(string $translation)
 * @method LanguageTranslator maori(string $translation)
 * @method LanguageTranslator macedonian(string $translation)
 * @method LanguageTranslator malayalam(string $translation)
 * @method LanguageTranslator mongolian(string $translation)
 * @method LanguageTranslator moldavian(string $translation)
 * @method LanguageTranslator marathi(string $translation)
 * @method LanguageTranslator malay(string $translation)
 * @method LanguageTranslator maltese(string $translation)
 * @method LanguageTranslator burmese(string $translation)
 * @method LanguageTranslator nauru(string $translation)
 * @method LanguageTranslator nepali(string $translation)
 * @method LanguageTranslator dutch(string $translation)
 * @method LanguageTranslator norwegian(string $translation)
 * @method LanguageTranslator occitan(string $translation)
 * @method LanguageTranslator punjabi(string $translation)
 * @method LanguageTranslator polish(string $translation)
 * @method LanguageTranslator pashtoPushto(string $translation)
 * @method LanguageTranslator portuguese(string $translation)
 * @method LanguageTranslator quechua(string $translation)
 * @method LanguageTranslator rhaetoRomance(string $translation)
 * @method LanguageTranslator kirundi(string $translation)
 * @method LanguageTranslator romanian(string $translation)
 * @method LanguageTranslator russian(string $translation)
 * @method LanguageTranslator kinyarwanda(string $translation)
 * @method LanguageTranslator sanskrit(string $translation)
 * @method LanguageTranslator sindhi(string $translation)
 * @method LanguageTranslator sangro(string $translation)
 * @method LanguageTranslator serboCroatian(string $translation)
 * @method LanguageTranslator singhalese(string $translation)
 * @method LanguageTranslator slovak(string $translation)
 * @method LanguageTranslator slovenian(string $translation)
 * @method LanguageTranslator samoan(string $translation)
 * @method LanguageTranslator shona(string $translation)
 * @method LanguageTranslator somali(string $translation)
 * @method LanguageTranslator albanian(string $translation)
 * @method LanguageTranslator serbian(string $translation)
 * @method LanguageTranslator siswati(string $translation)
 * @method LanguageTranslator sesotho(string $translation)
 * @method LanguageTranslator sundanese(string $translation)
 * @method LanguageTranslator swedish(string $translation)
 * @method LanguageTranslator swahili(string $translation)
 * @method LanguageTranslator tamil(string $translation)
 * @method LanguageTranslator tegulu(string $translation)
 * @method LanguageTranslator tajik(string $translation)
 * @method LanguageTranslator thai(string $translation)
 * @method LanguageTranslator tigrinya(string $translation)
 * @method LanguageTranslator turkmen(string $translation)
 * @method LanguageTranslator tagalog(string $translation)
 * @method LanguageTranslator setswana(string $translation)
 * @method LanguageTranslator tonga(string $translation)
 * @method LanguageTranslator turkish(string $translation)
 * @method LanguageTranslator tsonga(string $translation)
 * @method LanguageTranslator tatar(string $translation)
 * @method LanguageTranslator twi(string $translation)
 * @method LanguageTranslator ukrainian(string $translation)
 * @method LanguageTranslator urdu(string $translation)
 * @method LanguageTranslator uzbek(string $translation)
 * @method LanguageTranslator vietnamese(string $translation)
 * @method LanguageTranslator volapuk(string $translation)
 * @method LanguageTranslator wolof(string $translation)
 * @method LanguageTranslator xhosa(string $translation)
 * @method LanguageTranslator yoruba(string $translation)
 * @method LanguageTranslator chinese(string $translation)
 * @method LanguageTranslator zulu(string $translation)
 * @method LanguageTranslator kiswahili(string $translation)
 */
class LanguageTranslator
{
    /** @var Translation[] */
    private $translatables = [];
    private $id;


    public function __construct($default)
    {
        $this->id = uniqid('trans', true);
        $this->english($default);
    }

    public static function default($translation)
    {
        return new self($translation);
    }

    /**
     * @param $method
     * @param $args
     * @return null
     * @throws \Exception
     */
    public function __call($method, $args)
    {
        if (empty($args) || !\is_string($args[0])) throw new \Exception('Invalid translation!');
        if (!($trans = Translation::set($method, $args[0],$this->id))) return null;
        $this->translatables[$trans->getLanguage()->getIsoAbbreviation()] = $trans;
        return $this;
    }

    /**
     * @return Translation[]
     */
    public function translations()
    {
        return $this->translatables;
    }

    public function changePaths($path)
    {
        foreach ($this->translatables as $translatable) {
            $translatable->setPath($path);
        }
    }
}