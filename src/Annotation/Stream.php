<?php

declare(strict_types=1);

namespace BEAR\Streamer\Annotation;

use Attribute;
use Ray\Di\Di\Qualifier;

#[Attribute(Attribute::TARGET_METHOD)]
#[Qualifier]
final class Stream
{
}
