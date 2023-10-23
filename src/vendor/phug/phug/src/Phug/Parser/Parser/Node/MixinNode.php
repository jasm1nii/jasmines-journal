<?php

namespace Phug\Parser\Node;

use Phug\Parser\Node;
use Phug\Util\AttributesInterface;
use Phug\Util\AttributesOrderInterface;
use Phug\Util\Partial\AssignmentTrait;
use Phug\Util\Partial\AttributesOrderTrait;
use Phug\Util\Partial\AttributeTrait;
use Phug\Util\Partial\NameTrait;

class MixinNode extends Node implements AttributesInterface, AttributesOrderInterface
{
    use NameTrait;
    use AttributeTrait;
    use AssignmentTrait;
    use AttributesOrderTrait;
}
