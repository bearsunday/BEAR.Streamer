<?php
/**
 * This file is part of the BEAR.Streamer package.
 *
 * @license http://opensource.org/licenses/MIT MIT
 */
namespace BEAR\Streamer;

use BEAR\Streamer\Annotation\Stream;

final class Streamer implements StreamerInterface
{
    /**
     * @var resource
     */
    private $stream;

    /**
     * @var array
     */
    private $streams = [];

    /**
     * @Stream
     *
     * @param resource $stream
     */
    public function __construct($stream)
    {
        $this->stream = $stream;
    }

    /**
     * @param resource[] $streams
     */
    public function addStreams(array $streams) : void
    {
        $this->streams += $streams;
    }

    /**
     * Return single root stream
     *
     * @return resource
     */
    public function getStream(string $string)
    {
        $stream = $this->stream;
        rewind($stream);
        $hash = array_keys($this->streams);
        $regex = sprintf('/(%s)/', implode('|', $hash));
        preg_match_all($regex, $string, $match, PREG_SET_ORDER);
        $list = $this->collect($match);
        $bodies = (array) preg_split($regex, $string);
        foreach ($bodies as $body) {
            fwrite($stream, (string) $body);
            $index = array_shift($list);
            if (isset($this->streams[$index])) {
                $popStream = $this->streams[$index];
                rewind($popStream);
                stream_copy_to_stream($popStream, $stream);
            }
        }

        return $stream;
    }

    private function collect(array $match) : array
    {
        $list = [];
        foreach ($match as $item) {
            $list[] = $item[0];
        }

        return $list;
    }
}
