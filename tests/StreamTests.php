<?php

class StreamTests extends PHPUnit_Framework_TestCase
{

    public function test_stream_writes_and_reads()
    {
        $stream = new \WillWashburn\Stream\Stream();
        $stream->write('foo');

        $this->assertEquals('foo', $stream->read(3));

        $stream->write('bar');
        $stream->write('bang');
        $this->assertEquals('bar', $stream->read(3));
        $this->assertEquals('bang', $stream->read(4));
    }

    /**
     * @expectedException \WillWashburn\Stream\Exception\StreamBufferTooSmallException
     */
    public function test_short_stream_throws_exception()
    {

        $stream = new \WillWashburn\Stream\Stream();
        $stream->write('foo bar bang');

        $stream->read(25);
    }

    public function test_reset_pointer_resets()
    {
        $stream = new \WillWashburn\Stream\Stream();
        $stream->write('foo bar bang');

        $this->assertEquals('foo', $stream->read(3));
        $stream->resetPointer();
        $this->assertEquals('foo', $stream->read(3));
    }


    public function test_peek_doesnt_move_pointer()
    {
        $stream = new \WillWashburn\Stream\Stream();
        $stream->write('foo bar bang');

        $this->assertEquals('foo', $stream->peek(3));
        $this->assertEquals('foo', $stream->read(3));
    }

}