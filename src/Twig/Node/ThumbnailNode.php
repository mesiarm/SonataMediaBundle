<?php

declare(strict_types=1);

/*
 * This file is part of the Sonata Project package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\MediaBundle\Twig\Node;

use Twig\Compiler;
use Twig\Node\Expression\AbstractExpression;
use Twig\Node\Node;

final class ThumbnailNode extends Node
{
    /**
     * @var string
     */
    private $extensionName;

    public function __construct(string $extensionName, AbstractExpression $media, AbstractExpression $format, AbstractExpression $attributes, int $lineno, ?string $tag = null)
    {
        $this->extensionName = $extensionName;

        parent::__construct(['media' => $media, 'format' => $format, 'attributes' => $attributes], [], $lineno, $tag);
    }

    public function compile(Compiler $compiler): void
    {
        $compiler
            ->addDebugInfo($this)
            ->write(sprintf("echo \$this->env->getExtension('%s')->thumbnail(", $this->extensionName))
            ->subcompile($this->getNode('media'))
            ->raw(', ')
            ->subcompile($this->getNode('format'))
            ->raw(', ')
            ->subcompile($this->getNode('attributes'))
            ->raw(");\n");
    }
}
