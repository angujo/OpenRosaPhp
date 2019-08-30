<?php


namespace Angujo\OpenRosaPhp\Models;


use Angujo\OpenRosaPhp\Core\XMLTag;
use Angujo\OpenRosaPhp\Support\Translation;
use Angujo\OpenRosaPhp\Support\ValueTag;
use Angujo\OpenRosaPhp\Utils\Helper;

/**
 * Class Head
 *
 * @package Angujo\OpenRosaPhp\Models
 */
class Head extends XMLTag
{
    private $_model;
    private $_pinstance;
    private $_title = 'Untitled Form';
    private $_version;
    private $_id;
    private $_itext;
    private $_data_name;
    private $_variables = [];
    private $_submission_url;
    /** @var Translation[] */
    private static $_languages = [];

    public function __construct(&$data_name)
    {
        parent::__construct('head');
        $this->_id       = sha1(uniqid());
        $this->tag_space = 'h';
        $this->setTitle($this->_title);
        $this->_data_name =& $data_name;
        $this->primaryInstance();
    }

    /**
     * @param mixed $version
     *
     * @return Head
     */
    public function setVersion(&$version)
    {
        $this->_version =& $version;
        return $this;
    }

    /**
     * @param mixed $id
     *
     * @return Head
     */
    public function setId(&$id)
    {
        $this->_id = &$id;
        return $this;
    }

    /**
     * @return ValueTag|XMLTag
     * @throws \Angujo\OpenRosaPhp\Core\OException
     */
    private function titleElement()
    {
        if (!$this->hasElement('h:title')) {
            $this->addElementUnq((new ValueTag('title', null))->setTagspace('h'), 'h:title');
        }
        return $this->getElement('h:title');
    }

    public function setVariable($index, $value, $def_value = null)
    {
        $this->_variables[$index] = [$value, $def_value];
        return $this;
    }

    public static function globalLang(Translation $translation)
    {
        self::$_languages[] =& $translation;
    }

    public function setSubmissionUrl(&$url)
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \Exception('Invalid URL for submission!');
        }
        if (0 !== stripos($url, 'http')) {
            throw new \Exception('Submission url is missing protocol!');
        }
        $this->_submission_url = $url;
        return $this;
    }

    /**
     * @param Translation $translation
     *
     * @return $this
     */
    public function setLanguage(Translation $translation)
    {
        self::$_languages[] =& $translation;
        return $this;
    }

    public function setTitle(&$title)
    {
        $this->_title =& $title;
        $this->titleElement()->setContent((string)$title);
        return $this;
    }

    public function getModel()
    {
        if ($this->_model) {
            return $this->_model;
        }
        $this->_model = new HeadModel('model');
        $this->addElementUnq($this->_model);
        return $this->_model;
    }

    public function primaryInstance()
    {
        if ($this->_pinstance) {
            return $this->_pinstance;
        }
        $instance         = new XMLTag('instance');
        $this->_pinstance = new XMLTag($this->_data_name);
        $instance->addElementUnq($this->_pinstance);
        $this->getModel()->addElement($instance);
        return $this->_pinstance;
    }

    public function setPrimaryInstance()
    {
        $this->titleElement()->setContent((string)$this->_title);
        if ($this->_id) {
            $this->primaryInstance()->addAttribute('id', $this->_id);
        }
        if ($this->_version) {
            $this->primaryInstance()->addAttribute('version', $this->_version)->getAttribute('version')->setNamespace('orx');
        }
        $arr = [];
        foreach ($this->_variables as $ns) {
            Helper::array_dot($arr, $ns[0], $ns[1], '/');
        }
        $arr = array_shift($arr);
        $this->loopInstance($this->primaryInstance(), $arr);
    }

    private function loopInstance(XMLTag $parent, $arr)
    {
        foreach ($arr as $index => $item) {
            if (!preg_match('/^[a-z][\w-]+$/i', $index)) {
                continue;
            }
            $elmt = new XMLTag($index);
            $parent->addElementUnq($elmt);
            if (!is_array($item)) {
                $elmt->setContent($item);
            } else {
                $this->loopInstance($elmt, $item);
            }
        }
    }

    private function loopedLanguages()
    {
        $langs = [];
        foreach (self::$_languages as $language) {
            if (!isset($langs[$language->getDef()]) && trim($language->getDefault())) {
                $langs[$language->getDef()][$language->getNode()] = $language->getDefault();
            }
            foreach ($language->getTranslations() as $liso => $translation) {
                if (0 === strcasecmp($liso, $language->getDefault()) || 0 === strcasecmp($liso, $language->getDef())) {
                    // continue;
                }
                $langs[$liso][$language->getNode()] = $translation;
            }
        }
        return $langs;
    }

    public function iText()
    {
        if ($this->_itext) {
            return $this->_itext;
        }
        $this->_itext = new XMLTag('itext');
        $this->getModel()->addElement($this->_itext);
        return $this->_itext;
    }

    public function setItext()
    {
        $arr = $this->loopedLanguages();
        $i   = true;
        foreach ($arr as $lname => $txts) {
            $tr = new XMLTag('translation');
            if ($i) {
                $tr->addAttribute('default', 'true()');
            }
            $tr->addAttribute('lang', $lname);
            foreach ($txts as $cd => $txt) {
                $tr->addElement(LangText::create('/'.$cd, $txt));
            }
            $i = false;
            $this->iText()->addElement($tr);
        }
        self::$_languages = [];
    }

    private function setUrl()
    {
        if (!$this->_submission_url) {
            return;
        }
        $url = new XMLTag('submission');
        $this->getModel()->addElement($url);
        $url->addAttribute('method', 'post');
        $url->addAttribute('action', $this->_submission_url);
    }

    public function setHeader()
    {
        $this->setPrimaryInstance();
        $this->setUrl();
        $this->setItext();
    }
}