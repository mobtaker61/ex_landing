<?php
/**
 * Helper functions for RoniPlus
 */

function getTours() {
    $toursDir = __DIR__ . '/../tours';
    $tours = [];

    if (is_dir($toursDir)) {
        $folders = array_filter(scandir($toursDir), function($item) use ($toursDir) {
            return is_dir($toursDir . '/' . $item) && !in_array($item, ['.', '..']);
        });

        foreach ($folders as $folderName) {
            $folderPath = $toursDir . '/' . $folderName;
            $indexHtml = $folderPath . '/index.html';
            $indexHtm = $folderPath . '/index.htm';
            $thumbnail = $folderPath . '/thumbnail.png';

            $hasIndex = file_exists($indexHtml) || file_exists($indexHtm);
            $hasThumbnail = file_exists($thumbnail);

            if ($hasIndex) {
                $indexFile = file_exists($indexHtml) ? 'index.html' : 'index.htm';
                $tours[] = [
                    'id' => $folderName,
                    'name' => $folderName,
                    'thumbnail' => $hasThumbnail ? "tours/{$folderName}/thumbnail.png" : null,
                    'path' => "tours/{$folderName}/{$indexFile}"
                ];
            }
        }
    }

    return $tours;
}

/**
 * Extract YouTube video ID from various YouTube URL formats
 */
function extractYouTubeId($url) {
    if (empty($url)) {
        return null;
    }
    
    // Remove whitespace
    $url = trim($url);
    
    // Patterns for different YouTube URL formats
    $patterns = [
        '/youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/',
        '/youtu\.be\/([a-zA-Z0-9_-]+)/',
        '/youtube\.com\/embed\/([a-zA-Z0-9_-]+)/',
        '/youtube\.com\/v\/([a-zA-Z0-9_-]+)/',
    ];
    
    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }
    }
    
    // If no pattern matches, check if it's already just an ID
    if (preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
        return $url;
    }
    
    return null;
}

/**
 * Get YouTube URL from file
 */
function getYouTubeUrl($folderPath) {
    $youtubeFiles = ['youtube.txt', 'youtube.url', 'youtube.txt'];
    
    foreach ($youtubeFiles as $file) {
        $filePath = $folderPath . '/' . $file;
        if (file_exists($filePath)) {
            $url = trim(file_get_contents($filePath));
            if (!empty($url)) {
                return $url;
            }
        }
    }
    
    return null;
}

function getMedia() {
    $mediaDir = __DIR__ . '/../media';
    $media = [];

    if (is_dir($mediaDir)) {
        $folders = array_filter(scandir($mediaDir), function($item) use ($mediaDir) {
            return is_dir($mediaDir . '/' . $item) && !in_array($item, ['.', '..']);
        });

        foreach ($folders as $folderName) {
            $folderPath = $mediaDir . '/' . $folderName;
            $thumbnail = $folderPath . '/thumbnail.png';
            
            // Check for YouTube URL first
            $youtubeUrl = getYouTubeUrl($folderPath);
            $youtubeId = $youtubeUrl ? extractYouTubeId($youtubeUrl) : null;
            
            // Check for video files (common formats)
            $videoFiles = glob($folderPath . '/*.{mp4,webm,ogg,mov}', GLOB_BRACE);
            $hasVideo = !empty($videoFiles);
            $hasThumbnail = file_exists($thumbnail);

            // Include if has YouTube URL OR video file
            if ($youtubeId || $hasVideo) {
                $mediaItem = [
                    'id' => $folderName,
                    'name' => $folderName,
                    'thumbnail' => $hasThumbnail ? "media/{$folderName}/thumbnail.png" : null,
                    'type' => $youtubeId ? 'youtube' : 'file',
                ];
                
                if ($youtubeId) {
                    $mediaItem['youtube_id'] = $youtubeId;
                    $mediaItem['youtube_url'] = $youtubeUrl;
                    // Use YouTube thumbnail if no custom thumbnail
                    if (!$hasThumbnail) {
                        $mediaItem['thumbnail'] = "https://img.youtube.com/vi/{$youtubeId}/maxresdefault.jpg";
                    }
                } else {
                    $videoFile = basename($videoFiles[0]);
                    $mediaItem['video'] = "media/{$folderName}/{$videoFile}";
                }
                
                $media[] = $mediaItem;
            }
        }
    }

    return $media;
}
?>
