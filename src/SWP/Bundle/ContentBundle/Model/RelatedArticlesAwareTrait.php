<?php

declare(strict_types=1);

/*
 * This file is part of the Superdesk Publisher Content Bundle.
 *
 * Copyright 2019 Sourcefabric z.ú. and contributors.
 *
 * For the full copyright and license information, please see the
 * AUTHORS and LICENSE files distributed with this source code.
 *
 * @copyright 2019 Sourcefabric z.ú
 * @license http://www.superdesk.org/license
 */

namespace SWP\Bundle\ContentBundle\Model;

use Doctrine\Common\Collections\Collection;

trait RelatedArticlesAwareTrait
{
    /**
     * @var RelatedArticleInterface[]|Collection
     */
    protected $relatedArticles;

    public function addRelatedArticle(RelatedArticleInterface $relatedArticle): void
    {
        if (!$this->hasRelatedArticle($relatedArticle)) {
            $relatedArticle->setRelatesTo($this);
            $this->relatedArticles->add($relatedArticle);
        }
    }

    public function removeRelatedArticle(RelatedArticleInterface $relatedArticle): void
    {
        if ($this->hasRelatedArticle($relatedArticle)) {
            $relatedArticle->setRelatesTo(null);
            $this->relatedArticles->removeElement($relatedArticle);
        }
    }

    public function hasRelatedArticle(RelatedArticleInterface $relatedArticle): bool
    {
        return $this->relatedArticles->contains($relatedArticle);
    }

    public function getRelatedArticles(): ?Collection
    {
        return $this->relatedArticles;
    }
}
