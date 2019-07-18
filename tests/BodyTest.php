<?php


use Angujo\OpenRosaPhp\Models\Body;
use Angujo\OpenRosaPhp\ODKForm;
use PHPUnit\Framework\TestCase;

class BodyTest extends TestCase
{
    /** @var Body */
    private $body;
    /** @var \Faker\Generator */
    private $faker;

    protected function setUp(): void
    {
        $this->body  = ODKForm::body();
        $this->faker = Faker\Factory::create();
    }

    public function testInputTimeType()
    {
        $this->body->InputText('johndoe');
    }

    public function testUploadImageNew()
    {
        $this->body->UploadImageNew('nimage');
    }

    public function testSelect()
    {
        $select = $this->body->Select('countries');
        $select->setLabel('Countries as we know them');
        // $this->faker->country
        while (count($select->getOptions()) <= 5) {
            $select->addOption($this->faker->email, $this->faker->firstNameFemale, $this->faker->countryCode);
        }
    }

    public function testUploadAudio()
    {
        $audio = $this->body->UploadAudio('voicerecording');
        $audio->getBind()->setRequired(true);
    }

    public function testUploadImageSelfie()
    {
        $this->body->UploadImageSelfie('selfie-pic');
    }

    public function testUploadSignature()
    {
        $this->body->UploadSignature('signature');
    }


    public function testRepeat()
    {
        $repeats = $this->body->Repeat('performance');
        $repeats->InputNumberDecimal('maize')->getBind()->setReadOnly(true);
        $repeats->InputDateTime('dob');
    }

    public function testInputBooleanType()
    {
        $this->body->InputBooleanType('yes-no');
    }

    public function testUploadImage()
    {
        $img = $this->body->UploadImage('uimg');
        $img->getBind()->setRequired(true);
    }

    public function testSelect1()
    {

    }

    public function testGroup()
    {
        $gr = $this->body->Group('grp101');
        $gr->InputNumberDecimal('amount');
    }

    public function testInputText()
    {

    }

    public function testUploadAnnotation()
    {

    }

    public function testInputDateTime()
    {

    }

    public function testUploadDrawing()
    {

    }

    public function testInputDateType()
    {

    }

    public function testRange()
    {
        $range = $this->body->Range('ranger', 0, 12, 1);
    }

    public function testRank()
    {
       $rank = $this->body->Rank('ranks');
         while (count($rank->getOptions()) <= 5) {
            $rank->addOption($this->faker->countryCode, $this->faker->country, $this->faker->countryCode);
        }
    }

    public function testInputNumberDecimal()
    {

    }

    public function testInputNumberInteger()
    {

    }

    public function testUploadVideo()
    {

    }

    public function testInputBarcode()
    {

    }

    public function testUploadVideoSelfie()
    {

    }

    public function tearDown(): void
    {
        $this->body = null;
    }

    public static function tearDownAfterClass(): void
    {
        print_r(ODKForm::toXML());
    }
}
