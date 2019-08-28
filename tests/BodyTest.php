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
        self::assertTrue(true);
    }

    public function testInputTimeType()
    {
        $this->body->InputText('johndoe')->setLabel('First Name');
    }

    public function testUploadImageNew()
    {
        $this->body->UploadImageNew('nimage')->setLabel('No Image Upload');
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
        $audio->setLabel('Voice Record');
    }

    public function testUploadImageSelfie()
    {
        $this->body->UploadImageSelfie('selfie-pic')->setLabel('Take a selfie');
    }

    public function testUploadSignature()
    {
        $this->body->UploadSignature('signature')->setLabel('Append your signature');
    }


    public function testRepeat()
    {
        $repeats = $this->body->Repeat('performance');
        $repeats->InputNumberDecimal('maize')->getBind()->setReadOnly(true);
        $repeats->InputDateTime('dob')->setLabel('Date of Birth');
    }

    public function testInputBooleanType()
    {
        $this->body->InputBooleanType('yes-no')->setLabel('Do you agree?');
    }

    public function testUploadImage()
    {
        $img = $this->body->UploadImage('uimg');
        $img->getBind()->setRequired(true);
        $img->setLabel('Simple Image upload!');
    }

    public function testSelect1()
    {
    }

    public function testGroup()
    {
        $gr  = $this->body->Group('grp101');
        $gr2 = $gr->Group('grp3');
        $gr2->InputNumberDecimal('amount');
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
        $range = $this->body->Range('ranger', 0, 12, 1)->setLabel('Range or something!');
    }

    public function testRank()
    {
        $rank = $this->body->Rank('ranks');
        $rank->setLabel('The ranks as we see!');
        while (count($rank->getOptions()) <= 5) {
            $option = $rank->addOption($this->faker->countryCode, $this->faker->country);
            $option->translateLabel('kis', $this->faker->companyEmail);
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
