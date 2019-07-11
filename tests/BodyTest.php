<?php


use Angujo\OpenRosaPhp\Models\Body;
use PHPUnit\Framework\TestCase;

class BodyTest extends TestCase
{
    private $body;

    protected function setUp(): void
    {
        $this->body = new Body();
    }

    public function testInputTimeType()
    {
        $this->body->InputText('johndoe');

        $body=$this->body;
    }

    public function testUploadImageNew()
    {

    }

    public function testSelect()
    {

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
}
