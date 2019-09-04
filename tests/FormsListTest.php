<?php


use Angujo\OpenRosaPhp\FormsList;
use PHPUnit\Framework\TestCase;

class FormsListTest extends TestCase
{
    /** @var \Faker\Generator */
    private $faker;

    protected function setUp(): void
    {
        $this->faker = Faker\Factory::create();self::assertTrue(true);
    }

    public function testList()
    {
        for ($i = 0; $i <= 5; $i++) {
            $form = FormsList::addForm($this->faker->uuid);
            $form->setVersion($this->faker->randomNumber(3));
            $form->setHash($this->faker->sha256);
            $form->setName($this->faker->domainName)->setDownloadUrl($this->faker->url);
        }
        \Angujo\OpenRosaPhp\Response::formList();
    }

    public function testManifest()
    {
        for ($i = 0; $i <= 5; $i++) {
            $form = \Angujo\OpenRosaPhp\Manifest::addMediaFile($this->faker->uuid);
            $form->setFilename($this->faker->countryCode.'.'.$this->faker->fileExtension);
            $form->setHash($this->faker->sha256);
            $form->setDownloadUrl($this->faker->url);
        }
        \Angujo\OpenRosaPhp\Response::manifest();
    }

    public function testSubmission()
    {
        $file=dirname(__FILE__).'/filesubmission.xml';
        $data=\Vyuldashev\XmlToArray\XmlToArray::convert(file_get_contents($file));
        echo $file;
    }
}
