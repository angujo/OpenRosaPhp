<?php
/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 1:15 PM
 */

class BodyTest
{
    public function testXml()
    {
        $body = \Angujo\OpenRosaPhp\Models\Body::create();
        $body->setAttribute('click', 'clickableItem');
        echo $body->XMLify();
    }

    public function testXFormxx()
    {
        $xform = \Angujo\OpenRosaPhp\Models\Xform::init();
        $xform->id('build12323');
        $xform->dataElement('data');

        $title=$xform->getBody()->inputText('title');
        $title->label('Title 101');

        $xform->generate();
        echo $xform->XMLify();
    }

    public function testXForm()
    {
        $xform = \Angujo\OpenRosaPhp\Models\Xform::init();
        $xform->title('Form 101');
        $xform->id('1111111');
        $xform->dataElement('data');
       // $xform->getMeta()->deviceID()->timeStart()->timeEnd()->userID();
        $body = $xform->getBody();
        $group = $body->group('grouped');
        $repeat = $group->repeat('repeats');//->count(2);

        $fname = \Angujo\OpenRosaPhp\Models\Controls\InputText::text('fname');
        $label = $fname->label('First Name');
        $label->language(function (\Angujo\OpenRosaPhp\Models\Controls\LanguageTranslator $translator) { $translator->kiswahili('Jina La Kwanza'); });
        $fname->defaultValue('JohnDoe');
        $fname->hint('Should be in alphabets!')->language(function (\Angujo\OpenRosaPhp\Models\Controls\LanguageTranslator $translator) {
            $translator->kiswahili('Onyesha kwa herufi kubwa!');
        });

        $address = \Angujo\OpenRosaPhp\Models\Controls\InputText::multiline('address');
        $address->label('Where do you stay?');

        $gender = \Angujo\OpenRosaPhp\Models\Controls\Select1::create('sex');
        $gender->label('Gender');
        $gender->addOption('Male', 'm');
        $gender->addOption('Female', 'f');

        //$group->addElement($fname);
        $body->addElement($address);
        $body->addElement($gender);

        $xform->generate();
        echo $xform->XMLify();
    }

    public function testInput()
    {
        $kiswahili = \Angujo\OpenRosaPhp\Libraries\Language::add('ks', 'Kiswahili');
        $body = \Angujo\OpenRosaPhp\Models\Body::create();
        $fname = \Angujo\OpenRosaPhp\Models\Controls\InputText::text('fname');
        $fname->label('First Name')->translate($kiswahili, 'Jina La Kwanza');
        $fname->defaultValue('JohnDoe');
        $fname->hint('Should be in alphabets!')->translate($kiswahili, 'Onyesha kwa herufi kubwa!');
        $fname->hint('Will replicate!');

        $address = \Angujo\OpenRosaPhp\Models\Controls\InputText::multiline('address');
        $address->label('Where do you stay?');
        $body->addElement($fname);
        $body->addElement($address);

        echo $body->XMLify();
    }

    public function testGroups()
    {
        /** @var \Angujo\OpenRosaPhp\Models\Body $body */
        $body = \Angujo\OpenRosaPhp\Models\Body::create();
        $group1 = $body->group('group1');
        $group1->repeat('repeater')->count(2);
        $group1->inputText('fname')->label('First Name');
        echo $body->XMLify();
    }
}