<?php

declare(strict_types=1);

/*
 * This file is part of the Superdesk Web Publisher Content Bundle.
 *
 * Copyright 2019 Sourcefabric z.ú. and contributors.
 *
 * For the full copyright and license information, please see the
 * AUTHORS and LICENSE files distributed with this source code.
 *
 * @copyright 2019 Sourcefabric z.ú
 * @license http://www.superdesk.org/license
 */

namespace SWP\Bundle\ContentBundle\Processor;

use SWP\Bundle\ContentBundle\Model\ArticleMediaInterface;

interface EmbeddedImageProcessorInterface extends ArticleBodyProcessorInterface
{
    public function setDefaultImageRendition(string $renditionName): void;

    public function applyByline(ArticleMediaInterface $articleMedia): string;
}
