<?php

/**
 * Rss/Atom Bundle for Symfony 2.
 *
 *
 * @license http://opensource.org/licenses/lgpl-3.0.html LGPL
 * @copyright (c) 2013, Alexandre Debril
 */
namespace Debril\RssAtomBundle\Protocol\Formatter;

use Debril\RssAtomBundle\Protocol\FeedFormatter;
use Debril\RssAtomBundle\Protocol\FeedOutInterface;
use Debril\RssAtomBundle\Protocol\ItemOutInterface;

/**
 * Class FeedRssFormatter.
 */
class FeedRssFormatter extends FeedFormatter
{
    /**
     * @return \DomDocument
     */
    public function getRootElement()
    {
        $dom = new \DOMDocument('1.0', 'utf-8');
        $dom->formatOutput = true;

        $rss = $dom->createElement('rss');
        $rss->setAttribute('version', '2.0');
        $channel = $dom->createElement('channel');
        $rss->appendChild($channel);
        $dom->appendChild($rss);

        return $dom;
    }

    /**
     * @param \DomDocument $document
     * @param FeedOutInterface      $content
     */
    public function setMetas(\DOMDocument $document, FeedOutInterface $content)
    {
        $elements = array();
        $elements[] = $document->createElement('title', htmlspecialchars($content->getTitle()));
        $elements[] = $document->createElement('description', htmlspecialchars($content->getDescription()));
        $elements[] = $document->createElement('link', $content->getLink());

        $elements[] = $document->createElement('lastBuildDate', $content->getLastModified()->format(\DateTime::RSS));
        $elements[] = $document->createElement('pubDate', $content->getLastModified()->format(\DateTime::RSS));

        foreach ($elements as $element) {
            $document->documentElement->firstChild->appendChild($element);
        }
    }

    /**
     * @param \DomDocument $document
     * @param ItemOutInterface      $item
     */
    protected function addEntry(\DomDocument $document, ItemOutInterface $item)
    {
        $entry = $document->createElement('item');

        $elements = array();
        $elements[] = $document->createElement('title', htmlspecialchars($item->getTitle()));

        $elements[] = $document->createElement('link', $item->getLink());
        $elements[] = $document->createElement('guid', $item->getPublicId());
        $elements[] = $document->createElement('pubDate', $item->getUpdated()->format(\DateTime::RSS));
        $elements[] = $document->createElement('comments', $item->getComment());
        $elements[] = $document->createElement('description', htmlspecialchars($item->getDescription(), ENT_COMPAT, 'UTF-8'));

        if (!is_null($item->getAuthor())) {
            $elements[] = $document->createElement('author', $item->getAuthor());
        }
        foreach ($elements as $element) {
            $entry->appendChild($element);
        }

        $document->documentElement->firstChild->appendChild($entry);
    }
}
