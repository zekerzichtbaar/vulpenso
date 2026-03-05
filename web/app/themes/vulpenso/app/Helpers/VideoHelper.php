<?php

namespace App\Helpers;

class VideoHelper
{
    /**
     * Extract video ID from URL
     */
    public static function extractVideoId($url, $type)
    {
        if ($type === 'youtube') {
            return preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/)([^&\n?#]+)/', $url, $matches) ? $matches[1] : '';
        }
        
        if ($type === 'vimeo') {
            return preg_match('/(?:vimeo\.com\/|player\.vimeo\.com\/video\/)([0-9]+)/', $url, $matches) ? $matches[1] : '';
        }
        
        return '';
    }

    /**
     * Detect video type from URL
     */
    public static function detectVideoType($url)
    {
        if (preg_match('/(?:youtube\.com|youtu\.be)/', $url)) {
            return 'youtube';
        }
        
        if (preg_match('/vimeo\.com/', $url)) {
            return 'vimeo';
        }
        
        // Check if it's a direct video file URL (including Vimeo progressive)
        if (preg_match('/\.(mp4|webm|ogg|mov)(\?.*)?$/i', $url) || 
            preg_match('/player\.vimeo\.com\/progressive_redirect/', $url)) {
            return 'url';
        }
        
        return 'url'; // Default to URL type
    }

    /**
     * Generate unique video ID
     */
    public static function generateVideoId()
    {
        return 'video-' . uniqid();
    }
} 