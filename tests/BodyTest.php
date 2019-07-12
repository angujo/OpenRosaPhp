<?php


use Angujo\OpenRosaPhp\Models\Body;
use PHPUnit\Framework\TestCase;

class BodyTest extends TestCase
{
    /** @var Body */
    private $body;
    /** @var \Faker\Generator */
    private $faker;

    protected function setUp(): void
    {
        $this->body  = new Body('data');
        $this->faker = Faker\Factory::create();
    }

    public function testInputTimeType()
    {
        $this->body->InputText('johndoe');
        $body = $this->body->toXML();
        print_r($body);
    }

    public function testUploadImageNew()
    {
        $this->body->UploadImageNew('nimage');
        $body = $this->body->toXML();
        print_r($body);
    }

    public function testSelect()
    {
        $select = $this->body->Select('countries');
        // $this->faker->country
        while (count($select->getOptions()) <= 5) {
            $select->addOption($this->faker->countryCode, $this->faker->country);
        }
        $body = $this->body->toXML();
        print_r($body);
    }

    public function testToXML()
    {

    }

    public function testUploadAudio()
    {

    }

    public function testUploadImageSelfie()
    {

    }

    public function testUploadSignature()
    {

    }

    public function testRepeat()
    {

    }

    public function testInputBooleanType()
    {

    }

    public function testUploadImage()
    {

    }

    public function testSelect1()
    {

    }

    public function testGroup()
    {

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
}
