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

namespace Sonata\MediaBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Sonata\MediaBundle\Model\Gallery;
use Sonata\MediaBundle\Model\GalleryHasMediaInterface;

/**
 * Bundle\MediaBundle\Document\BaseGallery.
 *
 * @phpstan-template T of GalleryHasMediaInterface
 * @phpstan-extends Gallery<T>
 */
abstract class BaseGallery extends Gallery
{
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->galleryHasMedias = new ArrayCollection();
    }

    /**
     * Pre Persist method.
     */
    public function prePersist()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }

    /**
     * Pre Update method.
     */
    public function preUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
}
