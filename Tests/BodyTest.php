<?php

use Angujo\OpenRosaPhp\FormList;
use Angujo\OpenRosaPhp\ODKForm;

/**
 * Created for openrosaphp.
 * User: Angujo Barrack
 * Date: 2018-11-24
 * Time: 1:15 PM
 */
class BodyTest
{
    public function __construct()
    {
        /*Access::authenticateByHA1(function ($username) {
            return md5('john:' . Access::getRealm() . ':does');
        });*/
        header('X-OpenRosa-Version:1.0');
        header('Content-Type:text/xml');
    }

    public static function byteconvert($input)
    {
        preg_match('/(\d+)(\w+)/', $input, $matches);
        $type = strtolower($matches[2]);
        switch ($type) {
            case "b":
                $output = $matches[1];
                break;
            case "k":
            case "kb":
                $output = $matches[1] * 1024;
                break;
            case "m":
            case "mb":
                $output = $matches[1] * 1024 * 1024;
                break;
            case "g":
            case "gb":
                $output = $matches[1] * 1024 * 1024 * 1024;
                break;
            case "t":
            case "tb":
                $output = $matches[1] * 1024 * 1024 * 1024;
                break;
        }
        return $output;
    }

    public static function getBaseUrl($url = '/')
    {
        // output: /myproject/index.php
        $currentPath = $_SERVER['PHP_SELF'];
        // output: Array ( [dirname] => /myproject [basename] => index.php [extension] => php [filename] => index )
        $pathInfo = pathinfo($currentPath);
        // output: localhost
        $hostName = $_SERVER['HTTP_HOST'];
        // output: http://
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
        // return: http://localhost/myproject/
        $base = $protocol . '://' . $hostName . $pathInfo['dirname'] . "/";

        $url = trim(str_ireplace('\\', '/', $url), " \/");
        return $base . $url;
    }

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

        $title = $xform->getBody()->inputText('title');
        $title->label('Title 101');

        $xform->generate();
        echo $xform->XMLify();
    }

    public function odkformlist()
    {
        $formList = new FormList();
        $form1 = $formList->addForm('kemri-wellcome.org:form101', 'another 101 form ever!');
        $form1->setVersion('1.2');
        $form1->setHash('md5:' . md5('abcd1.2'));
        $form1->setDescriptionText('This is a description of this form!');
        $form1->setDownloadUrl(self::getBaseUrl('/?form=yes'));
        //$form1->setManifestUrl('http://myhost.com/url');

        echo $formList->asXML();
    }

    public static function log($content)
    {
        $fp = fopen(__DIR__ . '/log/odkin' . date('dmY') . '.log', 'a+');
        fwrite($fp, date('Y-m-d H:i:s') . ': ' . $content);
        fwrite($fp, "\r\n");
        fclose($fp);
    }

    public function odkform()
    {
        $form = new ODKForm();
        $form->setTitle('build_999911');
        $form->dataElement('data');
        $form->setId('build_Untitled-Form_154402011');

        $gender = $form->selectOne('sex');
        $gender->label('Sex');
        $gender->addOption('Male', 'm');
        $gender->addOption('Female', 'f');

        $fname = $form->inputText('fname');
        $fname->label('First Name');
        $fname->lengthRange(2, 45);
        $sname = $form->inputText('sname');
        $sname->label('Second Name');

        $age = $form->inputInteger('age');
        $age->label('Age');
        $age->range(18, 45, true, 'Should be a youth!');

        $salary = $form->inputDecimal('salary');
        $salary->label('Salary');

        /** @var \Angujo\OpenRosaPhp\Models\Controls\InputText $job */
        $job = $form->addElement(\Angujo\OpenRosaPhp\Models\Controls\InputText::text('job'));
        $job->label('Job');

        $cities = $form->selectMultiple('cities');
        $cities->label('Cities');
        $cities->addOption('Nakuru', 'nx');
        $cities->addOption('Kisumu', 'ks');
        $cities->addOption('Nairobi', 'nr');
        $cities->addOption('Mombasa', 'mb');
        $cities->addOption('Malindi', 'ml');
        $cities->selectionRange(1, 3)->required()->readOnly();

        echo $form->asXML();
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
        //$repeat = $group->repeat('repeats');//->count(2);

        $fname = \Angujo\OpenRosaPhp\Models\Controls\InputText::text('fname');
        $label = $fname->label('First Name');
        $label->language(function (\Angujo\OpenRosaPhp\Models\Controls\LanguageTranslator $translator) { $translator->kiswahili('Jina La Kwanza'); });
        $fname->defaultValue('JohnDoe');
        $fname->hint('Should be in alphabets!')->language(function (\Angujo\OpenRosaPhp\Models\Controls\LanguageTranslator $translator) {
            $translator->kiswahili('Onyesha kwa herufi kubwa!')->chinese('Chiwawa!');
        });

        $address = \Angujo\OpenRosaPhp\Models\Controls\InputText::multiline('address');
        $address->label('Where do you stay?');

        $gender = \Angujo\OpenRosaPhp\Models\Controls\Select1::create('sex');
        $gender->label('Gender');
        $gender->addOption('Male', 'm');
        $gender->addOption('Female', 'f');

        $group->addElement($fname);
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
