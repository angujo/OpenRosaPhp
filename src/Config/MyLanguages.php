<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-26
 * Time: 4:36 AM
 */

namespace Angujo\OpenRosaPhp\Config;

use Angujo\OpenRosaPhp\Libraries\Data;


/**
 * Class MyLanguages
 * @package Angujo\OpenRosaPhp\Config
 *
 * This class is meant to allow you to add custom languages.
 * These are hardcoded into the system.
 * You can as well add a phpdoc method following pattern below, after it is listed in the list.
 * Remember, to add a language on the fly you need to pass
 * 3rd parameter as boolean TRUE
 *
 * @method MyLanguages english(string $translation)
 * @method MyLanguages afar(string $translation)
 * @method MyLanguages abkhazian(string $translation)
 * @method MyLanguages afrikaans(string $translation)
 * @method MyLanguages amharic(string $translation)
 * @method MyLanguages arabic(string $translation)
 * @method MyLanguages assamese(string $translation)
 * @method MyLanguages aymara(string $translation)
 * @method MyLanguages azerbaijani(string $translation)
 * @method MyLanguages bashkir(string $translation)
 * @method MyLanguages byelorussian(string $translation)
 * @method MyLanguages bulgarian(string $translation)
 * @method MyLanguages bihari(string $translation)
 * @method MyLanguages bislama(string $translation)
 * @method MyLanguages bengaliBangla(string $translation)
 * @method MyLanguages tibetan(string $translation)
 * @method MyLanguages breton(string $translation)
 * @method MyLanguages catalan(string $translation)
 * @method MyLanguages corsican(string $translation)
 * @method MyLanguages czech(string $translation)
 * @method MyLanguages welsh(string $translation)
 * @method MyLanguages danish(string $translation)
 * @method MyLanguages german(string $translation)
 * @method MyLanguages bhutani(string $translation)
 * @method MyLanguages greek(string $translation)
 * @method MyLanguages esperanto(string $translation)
 * @method MyLanguages spanish(string $translation)
 * @method MyLanguages estonian(string $translation)
 * @method MyLanguages basque(string $translation)
 * @method MyLanguages persian(string $translation)
 * @method MyLanguages finnish(string $translation)
 * @method MyLanguages fiji(string $translation)
 * @method MyLanguages faeroese(string $translation)
 * @method MyLanguages french(string $translation)
 * @method MyLanguages frisian(string $translation)
 * @method MyLanguages irish(string $translation)
 * @method MyLanguages scotsGaelic(string $translation)
 * @method MyLanguages galician(string $translation)
 * @method MyLanguages guarani(string $translation)
 * @method MyLanguages gujarati(string $translation)
 * @method MyLanguages hausa(string $translation)
 * @method MyLanguages hindi(string $translation)
 * @method MyLanguages croatian(string $translation)
 * @method MyLanguages hungarian(string $translation)
 * @method MyLanguages armenian(string $translation)
 * @method MyLanguages interlingua(string $translation)
 * @method MyLanguages interlingue(string $translation)
 * @method MyLanguages inupiak(string $translation)
 * @method MyLanguages indonesian(string $translation)
 * @method MyLanguages icelandic(string $translation)
 * @method MyLanguages italian(string $translation)
 * @method MyLanguages hebrew(string $translation)
 * @method MyLanguages japanese(string $translation)
 * @method MyLanguages yiddish(string $translation)
 * @method MyLanguages javanese(string $translation)
 * @method MyLanguages georgian(string $translation)
 * @method MyLanguages kazakh(string $translation)
 * @method MyLanguages greenlandic(string $translation)
 * @method MyLanguages cambodian(string $translation)
 * @method MyLanguages kannada(string $translation)
 * @method MyLanguages korean(string $translation)
 * @method MyLanguages kashmiri(string $translation)
 * @method MyLanguages kurdish(string $translation)
 * @method MyLanguages kirghiz(string $translation)
 * @method MyLanguages latin(string $translation)
 * @method MyLanguages lingala(string $translation)
 * @method MyLanguages laothian(string $translation)
 * @method MyLanguages lithuanian(string $translation)
 * @method MyLanguages latvianLettish(string $translation)
 * @method MyLanguages malagasy(string $translation)
 * @method MyLanguages maori(string $translation)
 * @method MyLanguages macedonian(string $translation)
 * @method MyLanguages malayalam(string $translation)
 * @method MyLanguages mongolian(string $translation)
 * @method MyLanguages moldavian(string $translation)
 * @method MyLanguages marathi(string $translation)
 * @method MyLanguages malay(string $translation)
 * @method MyLanguages maltese(string $translation)
 * @method MyLanguages burmese(string $translation)
 * @method MyLanguages nauru(string $translation)
 * @method MyLanguages nepali(string $translation)
 * @method MyLanguages dutch(string $translation)
 * @method MyLanguages norwegian(string $translation)
 * @method MyLanguages occitan(string $translation)
 * @method MyLanguages punjabi(string $translation)
 * @method MyLanguages polish(string $translation)
 * @method MyLanguages pashtoPushto(string $translation)
 * @method MyLanguages portuguese(string $translation)
 * @method MyLanguages quechua(string $translation)
 * @method MyLanguages rhaetoRomance(string $translation)
 * @method MyLanguages kirundi(string $translation)
 * @method MyLanguages romanian(string $translation)
 * @method MyLanguages russian(string $translation)
 * @method MyLanguages kinyarwanda(string $translation)
 * @method MyLanguages sanskrit(string $translation)
 * @method MyLanguages sindhi(string $translation)
 * @method MyLanguages sangro(string $translation)
 * @method MyLanguages serboCroatian(string $translation)
 * @method MyLanguages singhalese(string $translation)
 * @method MyLanguages slovak(string $translation)
 * @method MyLanguages slovenian(string $translation)
 * @method MyLanguages samoan(string $translation)
 * @method MyLanguages shona(string $translation)
 * @method MyLanguages somali(string $translation)
 * @method MyLanguages albanian(string $translation)
 * @method MyLanguages serbian(string $translation)
 * @method MyLanguages siswati(string $translation)
 * @method MyLanguages sesotho(string $translation)
 * @method MyLanguages sundanese(string $translation)
 * @method MyLanguages swedish(string $translation)
 * @method MyLanguages swahili(string $translation)
 * @method MyLanguages tamil(string $translation)
 * @method MyLanguages tegulu(string $translation)
 * @method MyLanguages tajik(string $translation)
 * @method MyLanguages thai(string $translation)
 * @method MyLanguages tigrinya(string $translation)
 * @method MyLanguages turkmen(string $translation)
 * @method MyLanguages tagalog(string $translation)
 * @method MyLanguages setswana(string $translation)
 * @method MyLanguages tonga(string $translation)
 * @method MyLanguages turkish(string $translation)
 * @method MyLanguages tsonga(string $translation)
 * @method MyLanguages tatar(string $translation)
 * @method MyLanguages twi(string $translation)
 * @method MyLanguages ukrainian(string $translation)
 * @method MyLanguages urdu(string $translation)
 * @method MyLanguages uzbek(string $translation)
 * @method MyLanguages vietnamese(string $translation)
 * @method MyLanguages volapuk(string $translation)
 * @method MyLanguages wolof(string $translation)
 * @method MyLanguages xhosa(string $translation)
 * @method MyLanguages yoruba(string $translation)
 * @method MyLanguages chinese(string $translation)
 * @method MyLanguages zulu(string $translation)
 * @method MyLanguages kiswahili(string $translation)
 * @method MyLanguages __custom__(string $translation, bool $add)
 */
abstract class MyLanguages
{
    /**
     * Add your hard coded language.
     * Format ['abbrev'=>'Name',...]
     * Ensure the abbreviation do not conflict with list set at
     * @see Data
     * which is ISO abbreviated
     *
     * @var array
     */
    protected $_my_languages = [];
}