<?php
require_once("../class/Produto.php");
class ProdutoTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Produto
     */
    protected $object;
    protected function setUp(){$this->object = new Produto();}
    protected function tearDown(){}
    public function testHandleMonetary(){
        $value="R$ 354,12";
                
        $value=$this->object->handleMonetary($value,"goNum",1);
        $this->assertEquals(354.12,$value);
        
        $value=$this->object->handleMonetary($value,"goCur",1);
        $this->assertEquals("R$ 354,12",$value);
        
        $this->object->handleMonetary($value,"goNum");
        $this->assertEquals(354.12,$value);
        
        $this->object->handleMonetary($value,"goCur");
        $this->assertEquals("R$ 354,12",$value);
    }
}
