<?php
require_once("../class/Produto.php");
class ProdutoTest extends PHPUnit_Framework_TestCase
{
    protected $object;
    protected function setUp(){$this->object = new Produto();}
    protected function tearDown(){}
    public function testHandleMonetary(){
        $value="R$ 354,12";
                
        $value=$this->object->handleMonetary($value,"goNum");
        $this->assertEquals(354.12,$value);
        
        $value=$this->object->handleMonetary($value);
        $this->assertEquals("R$ 354,12",$value);
    }
}
