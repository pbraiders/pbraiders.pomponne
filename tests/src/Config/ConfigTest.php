<?php

namespace PbraidersTest\Config;

use PHPUnit\Framework\TestCase;
use Pbraiders\Config\Config;
use Pbraiders\Config\Exception;

class ConfigTest extends TestCase
{
    protected $iniFileConfig;
    protected $iniFileNested;
    public function setUp(): void
    {
        // Arrays representing common config configurations
        $this->all = [
            'hostname' => 'all',
            'name' => 'thisname',
            'db' => [
                'host' => '127.0.0.1',
                'user' => 'username',
                'pass' => 'password',
                'name' => 'live'
            ],
            'one' => [
                'two' => [
                    'three' => 'multi'
                ]
            ]
        ];
        $this->numericData = [
            0 => 34,
            1 => 'test',
        ];
        $this->menuData1 = [
            'button' => [
                'b0' => [
                    'L1' => 'button0-1',
                    'L2' => 'button0-2',
                    'L3' => 'button0-3'
                ],
                'b1' => [
                    'L1' => 'button1-1',
                    'L2' => 'button1-2'
                ],
                'b2' => [
                    'L1' => 'button2-1'
                ]
            ]
        ];
        $this->toCombineA = [
            'foo' => 1,
            'bar' => 2,
            'text' => 'foo',
            'numerical' => [
                'first',
                'second',
                [
                    'third'
                ]
            ],
            'misaligned' => [
                2 => 'foo',
                3 => 'bar'
            ],
            'mixed' => [
                'foo' => 'bar'
            ],
            'replaceAssoc' => [
                'foo' => 'bar'
            ],
            'replaceNumerical' => [
                'foo'
            ]
        ];
        $this->toCombineB = [
            'foo' => 3,
            'text' => 'bar',
            'numerical' => [
                'fourth',
                'fifth',
                [
                    'sixth'
                ]
            ],
            'misaligned' => [
                3 => 'baz'
            ],
            'mixed' => [
                false
            ],
            'replaceAssoc' => null,
            'replaceNumerical' => true
        ];
        $this->leadingdot = ['.test' => 'dot-test'];
        $this->invalidkey = [' ' => 'test', '' => 'test2'];
    }
    public function testLoadSingleSection()
    {
        $config = new Config($this->all, false);
        $this->assertEquals('all', $config->hostname);
        $this->assertEquals('live', $config->db->name);
        $this->assertEquals('multi', $config->one->two->three);
        $this->assertNull($config->nonexistent); // property doesn't exist
    }
    public function testIsset()
    {
        $config = new Config($this->all, false);
        $this->assertFalse(isset($config->notarealkey));
        $this->assertTrue(isset($config->hostname)); // top level
        $this->assertTrue(isset($config->db->name)); // one level down
    }
    public function testModification()
    {
        $config = new Config($this->all, true);
        // overwrite an existing key
        $this->assertEquals('thisname', $config->name);
        $config->name = 'anothername';
        $this->assertEquals('anothername', $config->name);
        // overwrite an existing multi-level key
        $this->assertEquals('multi', $config->one->two->three);
        $config->one->two->three = 'anothername';
        $this->assertEquals('anothername', $config->one->two->three);
        // create a new multi-level key
        $config->does = ['not' => ['exist' => 'yet']];
        $this->assertEquals('yet', $config->does->not->exist);
    }
    public function testNoModifications()
    {
        $this->expectException(Exception\RuntimeException::class);
        $this->expectExceptionMessage('Config is read only');
        $config = new Config($this->all);
        $config->hostname = 'test';
    }
    public function testNoNestedModifications()
    {
        $this->expectException(Exception\RuntimeException::class);
        $this->expectExceptionMessage('Config is read only');
        $config = new Config($this->all);
        $config->db->host = 'test';
    }
    public function testNumericKeys()
    {
        $data = new Config($this->numericData);
        $this->assertEquals('test', $data->{1});
        $this->assertEquals(34, $data->{0});
    }
    public function testCount()
    {
        $data = new Config($this->menuData1);
        $this->assertCount(3, $data->button);
    }

    public function testCountWithDoubleKeys()
    {
        $config = new Config([], true);
        $config->foo = 1;
        $config->foo = 2;
        $this->assertSame(2, $config->foo);
        $this->assertCount(1, $config->toArray());
        $this->assertCount(1, $config);
    }
    public function testIterator()
    {
        // top level
        $config = new Config($this->all);
        $var = '';
        foreach ($config as $key => $value) {
            if (is_string($value)) {
                $var .= "\nkey = $key, value = $value";
            }
        }
        $this->assertStringContainsStringIgnoringCase('key = name, value = thisname', $var);
        // 1 nest
        $var = '';
        foreach ($config->db as $key => $value) {
            $var .= "\nkey = $key, value = $value";
        }
        $this->assertStringContainsStringIgnoringCase('key = host, value = 127.0.0.1', $var);
        // 2 nests
        $config = new Config($this->menuData1);
        $var = '';
        foreach ($config->button->b1 as $key => $value) {
            $var .= "\nkey = $key, value = $value";
        }
        $this->assertStringContainsStringIgnoringCase('key = L1, value = button1-1', $var);
    }
    public function testArray()
    {
        $config = new Config($this->all);
        ob_start();
        print_r($config->toArray());
        $contents = ob_get_contents();
        ob_end_clean();
        $this->assertStringContainsStringIgnoringCase('Array', $contents);
        $this->assertStringContainsStringIgnoringCase('[hostname] => all', $contents);
        $this->assertStringContainsStringIgnoringCase('[user] => username', $contents);
    }
    public function testErrorWriteToReadOnly()
    {
        $this->expectException(Exception\RuntimeException::class);
        $this->expectExceptionMessage('Config is read only');
        $config = new Config($this->all);
        $config->test = '32';
    }
    public function testZF343()
    {
        $config_array = [
            'controls' => [
                'visible' => [
                    'name' => 'visible',
                    'type' => 'checkbox',
                    'attribs' => [], // empty array
                ],
            ],
        ];
        $form_config = new Config($config_array, true);
        $this->assertSame([], $form_config->controls->visible->attribs->toArray());
    }
    public function testZF402()
    {
        $configArray = [
            'data1'  => 'someValue',
            'data2'  => 'someValue',
            'false1' => false,
            'data3'  => 'someValue'
        ];
        $config = new Config($configArray);
        $this->assertEquals(count($configArray), count($config));
        foreach ($config as $key => $value) {
            $this->assertEquals($configArray[$key], $value);
        }
    }
    public function testZf1019HandlingInvalidKeyNames()
    {
        $config = new Config($this->leadingdot);
        $array = $config->toArray();
        $this->assertStringContainsStringIgnoringCase('dot-test', $array['.test']);
    }
    public function testZF1019EmptyKeys()
    {
        $config = new Config($this->invalidkey);
        $array = $config->toArray();
        $this->assertStringContainsStringIgnoringCase('test', $array[' ']);
        $this->assertStringContainsStringIgnoringCase('test', $array['']);
    }
    public function testZF1417DefaultValues()
    {
        $config = new Config($this->all);
        $value = $config->get('notthere', 'default');
        $this->assertEquals('default', $value);
        $this->assertNull($config->notThere);
    }
    public function testUnsetException()
    {
        // allow modifications is off - expect an exception
        $config = new Config($this->all, false);
        $this->assertTrue(isset($config->hostname)); // top level
        $this->expectException(Exception\InvalidArgumentException::class);
        $this->expectExceptionMessage('is read only');
        unset($config->hostname);
    }
    public function testUnset()
    {
        // allow modifications is on
        $config = new Config($this->all, true);
        $this->assertTrue(isset($config->hostname));
        $this->assertTrue(isset($config->db->name));
        unset($config->hostname);
        unset($config->db->name);
        $this->assertFalse(isset($config->hostname));
        $this->assertFalse(isset($config->db->name));
    }

    public function testArrayAccess()
    {
        $config = new Config($this->all, true);
        $this->assertEquals('thisname', $config['name']);
        $config['name'] = 'anothername';
        $this->assertEquals('anothername', $config['name']);
        $this->assertEquals('multi', $config['one']['two']['three']);
        $this->assertTrue(isset($config['hostname']));
        $this->assertTrue(isset($config['db']['name']));
        unset($config['hostname']);
        unset($config['db']['name']);
        $this->assertFalse(isset($config['hostname']));
        $this->assertFalse(isset($config['db']['name']));
    }
    public function testArrayAccessModification()
    {
        $config = new Config($this->numericData, true);
        // Define some values we'll be using
        $poem = [
            'poem' => [
                'line 1' => 'Roses are red, bacon is also red,',
                'line 2' => 'Poems are hard,',
                'line 3' => 'Bacon.',
            ],
        ];
        $bacon = 'Bacon';
        // Add a value
        $config[] = $bacon;
        // Check if bacon now has a key that equals to 2
        $this->assertEquals($bacon, $config[2]);
        // Now let's try setting an array with no key supplied
        $config[] = $poem;
        // This should now be set with key 3
        $this->assertEquals($poem, $config[3]->toArray());
    }
    /**
     * Ensures that toArray() supports objects of types other than Zend_Config
     *
     * @return void
     */
    public function testToArraySupportsObjects()
    {
        $configData = [
            'a' => new \stdClass(),
            'b' => [
                'c' => new \stdClass(),
                'd' => new \stdClass()
            ]
        ];
        $config = new Config($configData);
        $this->assertEquals($config->toArray(), $configData);
        $this->assertInstanceOf('stdClass', $config->a);
        $this->assertInstanceOf('stdClass', $config->b->c);
        $this->assertInstanceOf('stdClass', $config->b->d);
    }
    /**
     * ensure that modification is not allowed after calling setReadOnly()
     *
     */
    public function testSetReadOnly()
    {
        $configData = [
            'a' => 'a'
        ];
        $config = new Config($configData, true);
        $config->b = 'b';
        $config->setReadOnly();
        $this->expectException(Exception\RuntimeException::class);
        $this->expectExceptionMessage('Config is read only');
        $config->c = 'c';
    }
    public function testZF3408countNotDecreasingOnUnset()
    {
        $configData = [
            'a' => 'a',
            'b' => 'b',
            'c' => 'c',
        ];
        $config = new Config($configData, true);
        $this->assertCount(3, $config);
        unset($config->b);
        $this->assertCount(2, $config);
    }

    /**
     * @group ZF-5771a
     *
     */
    public function testUnsettingFirstElementDuringForeachDoesNotSkipAnElement()
    {
        $config = new Config([
            'first'  => [1],
            'second' => [2],
            'third'  => [3]
        ], true);
        $keyList = [];
        foreach ($config as $key => $value) {
            $keyList[] = $key;
            if ($key == 'first') {
                unset($config->$key); // uses magic Zend\Config\Config::__unset() method
            }
        }
        $this->assertEquals('first', $keyList[0]);
        $this->assertEquals('second', $keyList[1]);
        $this->assertEquals('third', $keyList[2]);
    }
    /**
     * @group ZF-5771
     *
     */
    public function testUnsettingAMiddleElementDuringForeachDoesNotSkipAnElement()
    {
        $config = new Config([
            'first'  => [1],
            'second' => [2],
            'third'  => [3]
        ], true);
        $keyList = [];
        foreach ($config as $key => $value) {
            $keyList[] = $key;
            if ($key == 'second') {
                unset($config->$key); // uses magic Zend\Config\Config::__unset() method
            }
        }
        $this->assertEquals('first', $keyList[0]);
        $this->assertEquals('second', $keyList[1]);
        $this->assertEquals('third', $keyList[2]);
    }
    /**
     * @group ZF-5771
     *
     */
    public function testUnsettingLastElementDuringForeachDoesNotSkipAnElement()
    {
        $config = new Config([
            'first'  => [1],
            'second' => [2],
            'third'  => [3]
        ], true);
        $keyList = [];
        foreach ($config as $key => $value) {
            $keyList[] = $key;
            if ($key == 'third') {
                unset($config->$key); // uses magic Zend\Config\Config::__unset() method
            }
        }
        $this->assertEquals('first', $keyList[0]);
        $this->assertEquals('second', $keyList[1]);
        $this->assertEquals('third', $keyList[2]);
    }
    /**
     * @group ZF-4728
     *
     */
    public function testSetReadOnlyAppliesToChildren()
    {
        $config = new Config($this->all, true);
        $config->setReadOnly();
        $this->assertTrue($config->isReadOnly());
        $this->assertTrue($config->one->isReadOnly(), 'First level children are writable');
        $this->assertTrue($config->one->two->isReadOnly(), 'Second level children are writable');
    }
    public function testZF6995toArrayDoesNotDisturbInternalIterator()
    {
        $config = new Config(range(1, 10));
        $config->rewind();
        $this->assertEquals(1, $config->current());
        $config->toArray();
        $this->assertEquals(1, $config->current());
    }
}
