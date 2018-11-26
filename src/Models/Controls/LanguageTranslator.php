<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-25
 * Time: 7:26 AM
 */

namespace Angujo\OpenRosaPhp\Models\Controls;

use Angujo\OpenRosaPhp\Config\MyLanguages;
use Angujo\OpenRosaPhp\Libraries\Translation;


/**
 * Class LanguageTranslator
 * @package Angujo\OpenRosaPhp\Models\Controls
 *
 *
 */
class LanguageTranslator extends MyLanguages
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