# Stream :rowboat: [![Travis](https://img.shields.io/travis/willwashburn/stream.svg)](https://travis-ci.org/willwashburn/stream) [![Packagist](https://img.shields.io/packagist/dt/willwashburn/stream.svg)](https://packagist.org/packages/willwashburn/stream) [![Packagist](https://img.shields.io/packagist/v/willwashburn/stream.svg)](https://packagist.org/packages/willwashburn/stream) [![MIT License](https://img.shields.io/packagist/l/willwashburn/stream.svg?style=flat-square)](https://github.com/willwashburn/stream/blob/master/LICENSE)
:rowboat: php class to model a sequence of data elements made available over time

# Usage

Write and read (or peek) from a string of characters.
```PHP
$stream = new \WillWashburn\Stream\Stream();
$stream->write('foo');

$stream->read(3); //foo

$stream->write('bar');
$stream->write('bang');

$stream->read(4); // barb
$stream->peek(3); // ang
$stream->read(3); // ang

```

I mostly use this when buffering responses from curl requests.

 ```PHP

$stream = new WillWashburn\Stream\Stream;
 
curl_setopt($ch, CURLOPT_WRITEFUNCTION, function ($ch, $str) use (& $stream, $url) {
            
    $stream->write($str);
    
    try {
        // do something with the stream
        $characters = $stream->read(100);
        
        // tell curl to stop the transfer when we find what we're looking for
        if(strpos($characters,'string im looking for') !==false) {
            return -1;
        }
    }
    catch (StreamBufferTooSmallException $e) {
        // The buffer ended, so keep getting more
        return strlen($str);
    }
    
    //  We return -1 to abort the transfer when we have enough buffered
    return -1;
});

```

# Installation
Use composer

```composer require willwashburn/stream```

Alternatively, add ```"willwashburn/stream": "~1.0.0"``` to your composer.json

## Change Log
- v1.0.0 - Basic stream model


