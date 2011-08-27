<?php

namespace DeBaasMedia\Bundle\HttpEquivalentBundle\Event;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * Response listener that adds http-equiv meta tags to HTML response head tag.
 *
 * @author  Marijn Huizendveld <marijn.huizendveld@gmail.com>
 */
final class KernelResponseListener
{

    /**
     * @var string
     */
    private $_tagSeparator;
    
    /**
     * @var string
     */
    private $_httpEquivalentTagFormat;

    /**
     * Create the listener.
     *
     * @param   string  $arg_tagSeparator             The seperator between the created meta tags.
     * @param   string  $arg_httpEquivalentTagFormat  The http-equiv meta tag format.
     *
     * @return  void
     */
    public function __construct ($arg_tagSeparator = "\n", $arg_httpEquivalentTagFormat = "<meta http-equiv='%name%' content='%value%' />")
    {
        $this->_tagSeparator            = $arg_tagSeparator;
        $this->_httpEquivalentTagFormat = $arg_httpEquivalentTagFormat;
    }

    /**
     * Listener for the kernel.response event.
     *
     * @param   FilterResponseEvent $arg_event
     *
     * @return  void
     */
    public function onKernelResponse (FilterResponseEvent $arg_event)
    {
        $response = $arg_event->getResponse();
        $request  = $arg_event->getRequest();
        $tags     = array();

        foreach ($request->headers->all() as $name => $value) {
            if ( ! $this->_findAndReplaceHttpEquivalentTag($response, $name, $value)) {
                $tags[] = $this->_formatHttpEquivalentTag($name, $value);
            }
        }

        if (0 < count($tags)) {
            $this->_appendTagsToHeadTag($response, $tags);
        }
    }

    /**
     * Find any existing http-equiv header tags in the response and replace the
     * value.
     *
     * @param   Response  $arg_response The response.
     * @param   string    $arg_name     The name of the header.
     * @param   string    $arg_value    The value of of the header
     *
     * @return  void
     */
    private function _findAndReplaceHttpEquivalentTag (Response $arg_response, $arg_name, $arg_value)
    {
        // this I probably best do with DOMDocument... Or CssSelector?
    }

    /**
     * Format an html meta tag.
     *
     * @param   string  $arg_name   The name of the header.
     * @param   string  $arg_value  The value of of the header
     *
     * @return  string
     */
    private function _formatHttpEquivalentTag ($arg_name, $arg_value)
    {
        return strtr($this->_httpEquivalentTagFormat, array('%name%' => $arg_name, '%value%' => $arg_value));
    }

    /**
     * Append the meta tags to the head tag of the response.
     *
     * @param   Response  $arg_response The response.
     * @param   array     $arg_tags     The collection of tags to append.
     *
     * @return  string
     */
    private function _appendTagsToHeadTag (Response $arg_response, $arg_tags)
    {
        // preg match closing head tag and append.

        $tags = implode($this->_tagSeparator, $arg_tags);

        // append tags
    }

}
