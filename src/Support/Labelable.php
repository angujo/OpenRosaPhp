<?php


namespace Angujo\OpenRosaPhp\Support;


use Angujo\OpenRosaPhp\Core\OException;
use Angujo\OpenRosaPhp\Tag;

trait Labelable
{
    /**
     * @return null|string|int
     */
    public function getLabel()
    {
        return $this->hasElement(Tag::LABEL) && $this->getElement(Tag::LABEL) ? $this->getElement(Tag::LABEL)->getValue() : null;
    }

    /**
     * @return ValueTag
     * @throws OException
     */
    public function getLabelElement()
    {
        if (!$this->hasElement(Tag::LABEL)) {
            $this->addElementUnq(new RefValueTag(Tag::LABEL, null));
        }
        return $this->getElement(Tag::LABEL);
    }

    /**
     * @return Translation
     * @throws OException
     */
    public function getLabelTranslation()
    {
        return $this->getLabelElement()->getTranslation();
    }

    /**
     * @param $lang_iso
     * @param $translation
     *
     * @return Translation
     * @throws OException
     */
    public function translateLabel($lang_iso, $translation)
    {
        if (!$this->hasElement(Tag::LABEL)) {
            $this->setLabel($translation);
        }
        /** @var Translation $trans */
        $trans = $this->getElement(Tag::LABEL)->getTranslation();
        $trans->addTranslation($lang_iso, $translation);
        return $trans;
    }

    /**
     * @param null $label
     *
     * @return Translation
     * @throws OException
     */
    public function setLabel($label)
    {
        return $this->getLabelElement()->setValue($label);
    }

}